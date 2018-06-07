<?php
namespace App\Shell\Task;

use Cake\Console\Shell;
use Cake\ORM\TableRegistry;
use Cake\Log\Log;
use ApaiIO\Configuration\GenericConfiguration;
use ApaiIO\Configuration\Country;
use ApaiIO\Operations\Lookup;
use ApaiIO\ResponseTransformer\XmlToArray;
use ApaiIO\ApaiIO;
use React\Promise;

/**
 * FetchOfferItems shell task.
 */
class FetchOfferItemsTask extends Shell
{
  public function initialize()
  {
    $this->access_keys_jp = array(
      'access_key' => env('AMZ_PA_ACCESSKEY_JP', '')
    , 'secret_key' => env('AMZ_PA_SECRETKEY_JP', '')
    , 'associ_tag' => env('AMZ_PA_ASSOCITAG_JP', '')
    );
    $this->access_keys_au = array(
      'access_key' => env('AMZ_PA_ACCESSKEY_AU', '')
    , 'secret_key' => env('AMZ_PA_SECRETKEY_AU', '')
    , 'associ_tag' => env('AMZ_PA_ASSOCITAG_AU', '')
    );
    $this->access_keys_us = array(
      'access_key' => env('AMZ_PA_ACCESSKEY_US', '')
    , 'secret_key' => env('AMZ_PA_SECRETKEY_US', '')
    , 'associ_tag' => env('AMZ_PA_ASSOCITAG_US', '')
    );
  }

  /**
   * Manage the available sub-commands along with their arguments and help
   *
   * @see http://book.cakephp.org/3.0/en/console-and-shells.html#configuring-options-and-generating-help
   * @return \Cake\Console\ConsoleOptionParser
   */
  public function getOptionParser()
  {
    $parser = parent::getOptionParser();
    return $parser;
  }

  /**
   * main() method.
   *
   * @return bool|int|null Success or error code.
   */
  public function main()
  {
    $this->execOfferItemLookup();
  }

  private function execOfferItemLookup()
  {
    $asins = TableRegistry::get('Asins');
    $datas = $asins->find()->where(['suspended' => false]);
    $request = array();
    foreach($datas as $data) {
      array_push($request, ['asin' => $data->asin, 'marketplace' => $data->marketplace]);
    }
    if(!$this->insertOfferItem($request)) {
      return false;
    }
    return true;
  }

  private function insertOfferItem($request)
  {
    $header = array(
      'asin'                                => true // varchar(255)
    , 'availability'                        => true // varchar(1024)
    , 'average_feedback_rating'             => true // integer
    , 'condition_status'                    => true // varchar(255)
    , 'condition_status_note'               => true // varchar(4095)
    , 'country'                             => true // varchar(255)
    , 'exchange_identifier'                 => true // varchar(255)
    , 'is_eligible_for_supersaver_shipping' => true // tinyint(1)
    , 'offer_listing_identifier'            => true // varchar(255)
    , 'price'                               => true // integer
    , 'price_currency'                      => true // varchar(255)
    , 'state'                               => true // varchar(255)
    , 'seller_identifier'                   => true // varchar(255)
    , 'sub_condition_status'                => true // varchar(255)
    , 'total_feedback'                      => true // integer
    , 'sales_ranking'                       => true // integer
    , 'lowest_price'                        => true // integer
    , 'lowest_price_currency'               => true // varchar(255)
    , 'created'                             => true // date
    , 'modified'                            => true // date
    );

    $offers = TableRegistry::get('Offers');
    $items  = TableRegistry::get('Items');

    $results  = $this->setOffers($header, $request);

    foreach($results as $result) {
      //print_r($result);
      $item = $items->find()
        ->where([
          'asin'        => $result['Headers']['asin']
        , 'marketplace' => $result['Headers']['marketplace']])
        ->first();
      if($item) {
        $result['Results']['item']['asin']        = $result['Headers']['asin'];
        $result['Results']['item']['marketplace'] = $result['Headers']['marketplace'];
        $result['Results']['item_id']             = $item->id;
        $entity = $offers->newEntity($result['Results']);
      }
      //print_r($entity);
      if(!$offers->save($entity)) {
        $this->log_error($entity->errors());
        return false;
      }
    }

    return true;
  }

  private function upsertOfferItem($request) 
  {
    $header = array(
      'asin'                                => true // varchar(255)
    , 'availability'                        => true // varchar(1024)
    , 'average_feedback_rating'             => true // integer
    , 'condition_status'                    => true // varchar(255)
    , 'condition_status_note'               => true // varchar(4095)
    , 'country'                             => true // varchar(255)
    , 'exchange_identifier'                 => true // varchar(255)
    , 'is_eligible_for_supersaver_shipping' => true // tinyint(1)
    , 'offer_listing_identifier'            => true // varchar(255)
    , 'price'                               => true // integer
    , 'price_currency'                      => true // varchar(255)
    , 'state'                               => true // varchar(255)
    , 'seller_identifier'                   => true // varchar(255)
    , 'sub_condition_status'                => true // varchar(255)
    , 'total_feedback'                      => true // integer
    , 'sales_ranking'                       => true // integer
    , 'lowest_price'                        => true // integer
    , 'lowest_price_currency'               => true // varchar(255)
    , 'created'                             => true // date
    , 'modified'                            => true // date
    );

    $offers = TableRegistry::get('Offers');
    $items  = TableRegistry::get('Items');

    $results  = $this->setOffers($header, $request);

    foreach($results as $result) {
      $item = $items->find()
        ->where([
          'asin'        => $result['Headers']['asin']
        , 'marketplace' => $result['Headers']['marketplace']])
        ->first();
      if($item) {
        $offer = $offers->find()->contain(['Items'])
          ->where([
            'Items.asin'        => $result['Headers']['asin']
          , 'Items.marketplace' => $result['Headers']['marketplace']])
          ->first();
        if($offer) {
          unset($result['Results']['created']);
          $entity = $offers->patchEntity($offer, $result['Results']);
        } else {
          $result['Results']['item']['asin']        = $result['Headers']['asin'];
          $result['Results']['item']['marketplace'] = $result['Headers']['marketplace'];
          $result['Results']['item_id']             = $item->id;
          $entity = $offers->newEntity($result['Results']);
        }
      }
      if(!$offers->save($entity)) {
        $this->log_error($entity->errors());
        return false;
      }
    }

    return true;
  } 

  private function setOffers($header, $request)
  { 
    $datas = array();
    $datetime = date('Y-m-d H:i:s');
    $deftime  = date('Y-m-d H:i:s', 0);
    $keys     = array_keys($header);
    $vals     = array_values($header);

    $_response = $this->fetchOffers($request);

    //debug($_response);
    foreach($_response as $response) {
      $operation = $response['fetchOffer']['OperationRequest'];
      $parameter = $response['fetchOffer']['Items']['Request'];
      $_items    = $response['fetchOffer']['Items']['Item'];
      $items     = array_values($_items) === $_items ? $_items : [$_items];
      foreach($items as $item) {
        //debug($item);
        if($item) {
          $asin         = $item['ASIN'];
          $new          = $item['OfferSummary']['TotalNew'];
          $used         = $item['OfferSummary']['TotalUsed'];
          $collectible  = $item['OfferSummary']['TotalCollectible'];
          $refurbished  = $item['OfferSummary']['TotalRefurbished'];
          $salesRanking = $item['SalesRank'];
          $lowestPrice  = $item['OfferSummary']['LowestNewPrice']['Amount'];
          $lowestPriceCurrency = $item['OfferSummary']['LowestNewPrice']['CurrencyCode'];
          $total        = $item['Offers']['TotalOffers'];
          $offers       = isset($item['Offers']['Offer'])
            ? (array_values($item['Offers']['Offer']) === $item['Offers']['Offer']
              ? $item['Offers']['Offer'] : [$item['Offers']['Offer']])
            : [];
          $data = array();
          foreach($offers as $offer) {
            //print_r($offer);
            $metadata = array(
              'operation'   => $operation
            , 'parameter'   => $parameter
            , 'asin'        => $asin
            , 'marketplace' => $response['marketplace']
            , 'totalNew'    => $new
            , 'totalUsed'   => $used
            , 'totalCollectible' => $collectible
            , 'totalRefurbished' => $refurbished
            , 'totalOffers' => $total
            , 'salesRanking' => $salesRanking
            , 'lowestPrice' => $lowestPrice
            , 'lowestPriceCurrency' => $lowestPriceCurrency
            );
            if($vals[ 0]) $data[$keys[ 0]] = $asin                                  ?? 'N/A';
            if($vals[ 1]) $data[$keys[ 1]] = $offer['OfferListing']['Availability'] ?? 'N/A';
            if($vals[ 2]) $data[$keys[ 2]]
              = $offer['Seller']['AverageFeedbackRating']                           ?? 0;
            if($vals[ 3]) $data[$keys[ 3]] = $offer['OfferAttributes']['Condition'] ?? 'N/A';
            if($vals[ 4]) $data[$keys[ 4]]
              = $offer['OfferAttributes']['ConditionNote']                          ?? 'N/A';
            if($vals[ 5]) $data[$keys[ 5]] = $offer['OfferAttributes']['Country']   ?? 'N/A';
            if($vals[ 6]) $data[$keys[ 6]] = $offer['OfferListing']['ExchangeId']   ?? 'N/A';
            if($vals[ 7]) $data[$keys[ 7]]
              = $offer['OfferListing']['IsEligibleForSuperSaverShipping']           ?? 0;
            if($vals[ 8]) $data[$keys[ 8]]
              = $offer['OfferListing']['OfferListingId']                            ?? 'N/A';
            if($vals[ 9]) $data[$keys[ 9]] = isset($offer['OfferListing']['Price']['Amount'])
              ? $this->getLocalPrice(
                  $offer['OfferListing']['Price']['Amount']
                , $offer['OfferListing']['Price']['CurrencyCode']
                )
              : 0;
            if($vals[10]) $data[$keys[10]]
              = $offer['OfferListing']['Price']['CurrencyCode']                     ?? 'N/A';
            if($vals[11]) $data[$keys[11]] = $offer['OfferAttributes']['State']     ?? 'N/A';
            if($vals[12]) $data[$keys[12]] = $offer['Seller']['SellerId']           ?? 'N/A';
            if($vals[13]) $data[$keys[13]] 
              = $offer['OfferAttributes']['SubCondition']                           ?? 'N/A';
            if($vals[14]) $data[$keys[14]] = $offer['Seller']['TotalFeedback']      ?? 0;
            if($vals[15]) $data[$keys[15]] = $salesRanking                          ?? 0;
            if($vals[16]) $data[$keys[16]] = isset($lowestPrice)
              ? $this->getLocalPrice($lowestPrice, $lowestPriceCurrency) : 0;
            if($vals[17]) $data[$keys[17]] = $lowestPriceCurrency                   ?? 'N/A';
            if($vals[18]) $data[$keys[18]] = $datetime;
            if($vals[19]) $data[$keys[19]] = $datetime;
            array_push($datas, array('Headers' => $metadata, 'Results' => $data));
          }
        }
      }
    }
    //print_r($datas);
    return $datas;
  }

  private function fetchOffers($request)
  {
    $response = [];
    Promise\all($this->_fetchOffers($request))
      ->done(function($result) use (&$response) {
        //debug($result);
        $response = $result;
      }, function($error) {
        //debug($error);
        $this->log_error($error);
      });
    return $response;
  }

  private function _fetchOffers($request)
  {
    $response = array();
    $asins_jp = array();
    $asins_au = array();
    $asins_us = array();
    $eol = count($request);
    $idx = 0;
    //debug($request);
    foreach($request as $_request) {
      switch($_request['marketplace']) {
      case 'JP':
        if($this->isKey('JP')) array_push($asins_jp, $_request['asin']);
        if(count($asins_jp) > 10) {
          array_push($response, $this->fetchOffer(implode(',', $asins_jp), 'JP'));
          $asins_jp = array();
        }
        break;
      case 'AU':
        if($this->isKey('AU')) array_push($asins_au, $_request['asin']);
        if(count($asins_au) > 10) {
          array_push($response, $this->fetchOffer(implode(',', $asins_au), 'AU'));
          $asins_au = array();
        }
        break;
      case 'US':
        if($this->isKey('US')) array_push($asins_us, $_request['asin']);
        if(count($asins_us) > 10) {
          array_push($response, $this->fetchOffer(implode(',', $asins_us), 'US'));
          $asins_us = array();
        }
        break;
      }
      if($idx === $eol - 1) {
        if(count($asins_jp) !== 0)
          array_push($response, $this->fetchOffer(implode(',', $asins_jp), 'JP'));
        if(count($asins_au) !== 0)
          array_push($response, $this->fetchOffer(implode(',', $asins_au), 'AU'));
        if(count($asins_us) !== 0)
          array_push($response, $this->fetchOffer(implode(',', $asins_us), 'US'));
      }
      $idx += 1;
    }
    return $response;
  }

  private function fetchOffer($asin, $marketplace) 
  {
    $deferred = new Promise\Deferred();
    $this->_fetchOffer(function($error, $response) use ($deferred) {
      if($error) {
        $this->log_error($error);
        $deferred->reject($error);
      }
      $deferred->resolve($response);
    }, $asin, $marketplace);
    return $deferred->promise();
  }

  private function _fetchOffer($callback, $asin, $marketplace) {
    $conf = new GenericConfiguration();
    $client = new \GuzzleHttp\Client();
    $request = new \ApaiIO\Request\GuzzleRequest($client);
    switch($marketplace) {
    case 'JP':
      $country = Country::JAPAN;
      $access_key = $this->access_keys_jp['access_key'];
      $secret_key = $this->access_keys_jp['secret_key'];
      $associ_tag = $this->access_keys_jp['associ_tag'];
      break;
    case 'AU':
      $country = Country::AUSTRALIA;
      $access_key = $this->access_keys_au['access_key'];
      $secret_key = $this->access_keys_au['secret_key'];
      $associ_tag = $this->access_keys_au['associ_tag'];
      break;
    case 'US':
      $country = Country::INTERNATIONAL;
      $access_key = $this->access_keys_us['access_key'];
      $secret_key = $this->access_keys_us['secret_key'];
      $associ_tag = $this->access_keys_us['associ_tag'];
      break;
    default:
      $country = Country::JAPAN;
      $access_key = $this->access_keys_jp['access_key'];
      $secret_key = $this->access_keys_jp['secret_key'];
      $associ_tag = $this->access_keys_jp['associ_tag'];
      break;
    }
    sleep(5);
    try {
      $conf
        ->setCountry($country)
        ->setAccessKey($access_key)
        ->setSecretKey($secret_key)
        ->setAssociateTag($associ_tag)
        ->setRequest($request)
        ->setResponseTransformer(new XmlToArray())
      ;
    } catch (\Exception $e) {
      $callback($e->getMessage(), []);
    }
    $apaiIo = new ApaiIO($conf);
    $lookup = new Lookup();
    $lookup->setItemId($asin);
    $lookup->setResponseGroup(array('OfferFull', 'SalesRank'));
    $lookup->setCondition('New');
    $lookup->setMerchantId('All');

    $callback(null, [
      'fetchOffer'  => $apaiIo->runOperation($lookup)
    , 'marketplace' => $marketplace
    ]);
  }

  private function getLocalPrice($price, $currency)
  {
    $rate = 0;
    switch($currency) {
    case 'USD':
      $rate = 0.01;
      break;
    default:
      $rate = 1;
      break;
    }
    return (float)($price * $rate);
  }

  private function isKey($marketplace)
  {
    $isKey = false;
    switch($marketplace) {
    case 'JP':
      if(   $this->access_keys_jp['access_key'] !== ''
        &&  $this->access_keys_jp['secret_key'] !== ''
        &&  $this->access_keys_jp['associ_tag'] !== ''
      ) $isKey = true;
      break;
    case 'AU':
      if(   $this->access_keys_au['access_key'] !== ''
        &&  $this->access_keys_au['secret_key'] !== ''
        &&  $this->access_keys_au['associ_tag'] !== ''
      ) $isKey = true;
      break;
    case 'US':
      if(   $this->access_keys_us['access_key'] !== ''
        &&  $this->access_keys_us['secret_key'] !== ''
        &&  $this->access_keys_us['associ_tag'] !== ''
      ) $isKey = true;
      break;
    }
    return $isKey;
  }

  private function log_debug($message)
  {
    $displayName = '[' . __CLASS__ . '] ';
    Log::debug($displayName . print_r($message, true), ['scope' => ['crons']]);
  }

  private function log_error($message)
  {
    $displayName = '[' . __CLASS__ . '] ';
    Log::error($displayName . print_r($message, true), ['scope' => ['crons']]);
  }

}
