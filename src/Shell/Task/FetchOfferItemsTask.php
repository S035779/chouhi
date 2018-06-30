<?php
namespace App\Shell\Task;

use Cake\Console\Shell;
use Cake\ORM\TableRegistry;
use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use App\Controller\Component\CommonComponent;
use Cake\Log\Log;
use ApaiIO\Configuration\GenericConfiguration;
use ApaiIO\Configuration\Country;
use ApaiIO\Operations\Lookup;
use ApaiIO\ResponseTransformer\XmlToArray;
use ApaiIO\ApaiIO;
use React\Promise;
use React\EventLoop;

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
    $this->Common = new CommonComponent(new ComponentRegistry());
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
    $datas = $asins
      ->find()
      ->where(['OR' => ['suspended' => false, 'modified >' => new \DateTime('-10 days')]])
      ->order(['modified' => 'ASC'])
      ->limit(1000)
    ;
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
    //debug(count($results));

    foreach($results as $result) {
      $item = $items->find()
        ->where([
          'asin'        => $result['Headers']['asin']
        , 'marketplace' => $result['Headers']['marketplace']])
        ->first();
      //debug($item);
      if($item) {
        $result['Results']['item']['asin']        = $result['Headers']['asin'];
        $result['Results']['item']['marketplace'] = $result['Headers']['marketplace'];
        $result['Results']['item_id']             = $item->id;
        $entity = $offers->newEntity($result['Results']);
        if(!$offers->save($entity)) {
          //debug($result['Results']);
          $this->Common->log_debug($entity->errors(), 'crons');
          return false;
        }
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
    //debug($result);

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
        if(!$offers->save($entity)) {
          $this->Common->log_error($entity->errors(), __FILE__, __LINE__, 'crons');
          return false;
        }
      }
    }

    return true;
  } 

  private function setOffers($header, $request)
  { 
    $datas = array();
    $datetime = date('Y-m-d H:i:s');
    $keys     = array_keys($header);
    $vals     = array_values($header);

    $_response = $this->fetchOffers($request);
    //debug($_response);

    foreach($_response as $response) {
      if($response) {
        $operation = $response['fetchOffer']['OperationRequest'];
        $parameter = $response['fetchOffer']['Items']['Request'];
        $_items = isset($response['fetchOffer']['Items']['Item']) 
          ? $response['fetchOffer']['Items']['Item'] : [];
        $items = array_values($_items) === $_items ? $_items : [$_items];
        $idx = 0;
        //debug($items);
        foreach($items as $item) {
          if($item) {
            $asin         = $item['ASIN'] ?? 'N/A';
            $new          = $item['OfferSummary']['TotalNew'] ?? 0;
            $used         = $item['OfferSummary']['TotalUsed'] ?? 0;
            $collectible  = $item['OfferSummary']['TotalCollectible'] ?? 0;
            $refurbished  = $item['OfferSummary']['TotalRefurbished'] ?? 0;
            $_offers = isset($item['Offers']['Offer']) ? $item['Offers']['Offer'] : [];
            $offers  = array_values($_offers) === $_offers ? $_offers : [$_offers];
            $salesRanking = $item['SalesRank'] ?? 0;
            $_lowestPrice = $item['OfferSummary']['LowestNewPrice']['Amount'] ?? 0;
            $lowestPriceCurrency = $item['OfferSummary']['LowestNewPrice']['CurrencyCode'] ?? 'N/A';
            $lowestPrice
              = isset($_lowestPrice) ? $this->Common->getLocalPrice($_lowestPrice, $lowestPriceCurrency) : 0;
            $total        = $item['Offers']['TotalOffers'] ?? 0;
            //debug($offers);
            foreach($offers as $offer) {
              if($offer) {
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
                $data = array();
                if($vals[ 0]) $data[$keys[ 0]] = $asin ?? 'N/A';
                if($vals[ 1]) $data[$keys[ 1]] = $offer['OfferListing']['Availability'] ?? 'N/A';
                if($vals[ 2]) $data[$keys[ 2]] = $offer['Seller']['AverageFeedbackRating']?? 0;
                if($vals[ 3]) $data[$keys[ 3]] = $offer['OfferAttributes']['Condition'] ?? 'N/A';
                if($vals[ 4]) $data[$keys[ 4]] = $offer['OfferAttributes']['ConditionNote']?? 'N/A';
                if($vals[ 5]) $data[$keys[ 5]] = $offer['OfferAttributes']['Country'] ?? 'N/A';
                if($vals[ 6]) $data[$keys[ 6]] = $offer['OfferListing']['ExchangeId'] ?? 'N/A';
                if($vals[ 7]) $data[$keys[ 7]] =
                  $offer['OfferListing']['IsEligibleForSuperSaverShipping'] ?? 0;
                if($vals[ 8]) $data[$keys[ 8]] = $offer['OfferListing']['OfferListingId'] ?? 'N/A';
                if($vals[ 9]) $data[$keys[ 9]] = isset($offer['OfferListing']['Price']['Amount'])
                  ? $this->Common->getLocalPrice($offer['OfferListing']['Price']['Amount']
                    , $offer['OfferListing']['Price']['CurrencyCode'])
                  : 0;
                if($vals[10]) $data[$keys[10]] = $offer['OfferListing']['Price']['CurrencyCode'] ?? 'N/A';
                if($vals[11]) $data[$keys[11]] = $offer['OfferAttributes']['State'] ?? 'N/A';
                if($vals[12]) $data[$keys[12]] = $offer['Seller']['SellerId'] ?? 'N/A';
                if($vals[13]) $data[$keys[13]] = $offer['OfferAttributes']['SubCondition'] ?? 'N/A';
                if($vals[14]) $data[$keys[14]] = $offer['Seller']['TotalFeedback'] ?? 0;
                if($vals[15]) $data[$keys[15]] = $salesRanking;
                if($vals[16]) $data[$keys[16]] = $lowestPrice;
                if($vals[17]) $data[$keys[17]] = $lowestPriceCurrency;
                if($vals[18]) $data[$keys[18]] = $datetime;
                if($vals[19]) $data[$keys[19]] = $datetime;
                array_push($datas, array('Headers' => $metadata, 'Results' => $data));
              }
            }
          }
          $idx++;
        }
      }
    }
    //debug($datas);
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
        $this->Common->log_error($error, __FILE__, __LINE__, 'crons');
      });
    return $response;
  }

  private function _fetchOffers($request)
  {
    $loop = EventLoop\Factory::create();
    $response = array();
    $asins_jp = array();
    $asins_au = array();
    $asins_us = array();
    $eol = count($request);
    $idx = 0;
    $max_count = 10;
    //debug($request);
    foreach($request as $_request) {
      switch($_request['marketplace']) {
      case 'JP':
        if($this->Common->isKey('JP')) array_push($asins_jp, $_request['asin']);
        if(count($asins_jp) >= $max_count) {
          array_push($response, $this->retryOffer(implode(',', $asins_jp), 'JP', $loop));
          $asins_jp = array();
        }
        break;
      case 'AU':
        if($this->Common->isKey('AU')) array_push($asins_au, $_request['asin']);
        if(count($asins_au) >= $max_count) {
          array_push($response, $this->retryOffer(implode(',', $asins_au), 'AU', $loop));
          $asins_au = array();
        }
        break;
      case 'US':
        if($this->Common->isKey('US')) array_push($asins_us, $_request['asin']);
        if(count($asins_us) >= $max_count) {
          array_push($response, $this->retryOffer(implode(',', $asins_us), 'US', $loop));
          $asins_us = array();
        }
        break;
      }
      if($idx === $eol - 1) {
        if(count($asins_jp) !== 0) {
         array_push($response, $this->retryOffer(implode(',', $asins_jp), 'JP', $loop));
        }
        if(count($asins_au) !== 0) {
          array_push($response, $this->retryOffer(implode(',', $asins_au), 'AU', $loop));
        }
        if(count($asins_us) !== 0) {
          array_push($response, $this->retryOffer(implode(',', $asins_us), 'US', $loop));
        }
      }
      $idx += 1;
    }
    //debug($response);
    $loop->run();
    return $response;
  }

  private function retryOffer($asin, $marketplace, $loop) 
  {
    return $this->Common->retry($loop, function() use ($asin, $marketplace, $loop) {
      return $this->fetchOffer(['asin' => $asin, 'marketplace' => $marketplace]);
    })
    ->otherwise(
      function($updated) {
        if($updated) $this->Common->log_error($updated, __FILE__, __LINE__, 'crons');
      })
    ;
  }

  private function fetchOffer($request) 
  {
    $deferred = new Promise\Deferred();
    $this->_fetchOffer(function($error, $result) use ($deferred) {
      if($error) {
        $deferred->reject($error);
      } else {
        $deferred->resolve($result);
      }
    }, $request['asin'], $request['marketplace']);
    return $deferred->promise();
  }

  private function _fetchOffer($callback, $asin, $marketplace)
  {
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
    sleep(2);
    try {
      $conf
        ->setCountry($country)
        ->setAccessKey($access_key)
        ->setSecretKey($secret_key)
        ->setAssociateTag($associ_tag)
        ->setRequest($request)
        ->setResponseTransformer(new XmlToArray())
      ;
      $apaiIO = new ApaiIO($conf);
      $lookup = new Lookup();
      $lookup->setItemId($asin);
      $lookup->setCondition('New');
      $lookup->setMerchantId('All');
      $lookup->setResponseGroup(array('OfferFull', 'SalesRank'));
      $response = $apaiIO->runOperation($lookup);
    } catch (\Exception $e) {
      return $callback($e->getMessage(), null);
    }
    //debug($response);
    $callback(null, [
      'fetchOffer'  => $response
    , 'marketplace' => $marketplace
    ]);
  }
}
