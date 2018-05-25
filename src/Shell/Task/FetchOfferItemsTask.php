<?php
namespace App\Shell\Task;

use Cake\Console\Shell;
use Cake\ORM\TableRegistry;
use ApaiIO\Configuration\GenericConfiguration;
use ApaiIO\Configuration\Country;
use ApaiIO\Operations\Search;
use ApaiIO\Operations\SimilarityLookup;
use ApaiIO\Operations\Lookup;
use ApaiIO\Operations\BrowseNodeLookup;
use ApaiIO\ResponseTransformer\XmlToArray;
use ApaiIO\ApaiIO;

/**
 * FetchOfferItems shell task.
 */
class FetchOfferItemsTask extends Shell
{
  public function initialize()
  {
    $this->access_key = env('AMZ_PA_ACCESSKEY_JP', '');
    $this->secret_key = env('AMZ_PA_SECRETKEY_JP', '');
    $this->associ_tag = env('AMZ_PA_ASSOCITAG_JP', '');
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
    , 'created'                             => true // date
    , 'modified'                            => true // date
    );
    $offers = TableRegistry::get('Offers');
    $items = TableRegistry::get('Items');
    $datas  = $this->setOffers($header, $request);
    foreach($datas as $data) {
      $item = $items->find()
        ->where(['asin' => $data['asin'], 'marketplace' => $data['marketplace']])
        ->first();
      $data['item_id'] = $item->id;
      $entity = $offers->newEntity($data);
      if(!$offers->save($entity)) {
        $this->logError($query->errors());
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
    , 'created'                             => true // date
    , 'modified'                            => true // date
    );
    $offers = TableRegistry::get('Offers');
    $datas  = $this->setOffers($header, $request);
    foreach($datas as $data) {
      $entity = $offers->newEntity($data);
      $offer = $offers->find()->contain(['Items'])
        ->where([
          'offer_listing_identifier' => $entity->offer_listing_identifier
        , 'Items.asin' => $entity->asin
        ])
        ->first();
      if($offer) {
        unset($data['created']);
        $entity = $offers->patchEntity($offer,$data);
      } else {
        $data['item']['asin'] = $data['asin'];
        $data['item']['marketplace'] = $data['marketplace'];
        $entity = $offers->newEntity($data);
      }
      if(!$offers->save($entity)) {
        $this->logError($entity->errors());
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

    $response = $this->fetchOffers($request);

    //print_r($response);
    foreach($response as $_response) {
      $operation = $_response['fetchOffer']['OperationRequest'];
      $parameter = $_response['fetchOffer']['Items']['Request'];
      $items     = array_values($_response['fetchOffer']['Items']['Item'])
        === $_response['fetchOffer']['Items']['Item']
          ? $_response['fetchOffer']['Items']['Item']
          : [$_response['fetchOffer']['Items']['Item']];
      foreach($items as $item) {
        //print_r($item);
        if($item) {
          $asin         = $item['ASIN'];
          $new          = $item['OfferSummary']['TotalNew'];
          $used         = $item['OfferSummary']['TotalUsed'];
          $collectible  = $item['OfferSummary']['TotalCollectible'];
          $refurbished  = $item['OfferSummary']['TotalRefurbished'];
          $total        = $item['Offers']['TotalOffers'];
          $offers       = array_values($item['Offers']['Offer']) === $item['Offers']['Offer']
            ? $item['Offers']['Offer'] : [$item['Offers']['Offer']];
          foreach($offers as $offer) {
            //print_r($offer);
            if($vals[ 0]) $data[$keys[ 0]] = $asin ?? 'N/A';
            if($vals[ 1]) $data[$keys[ 1]] = $offer['OfferListing']['Availability']
              ?? 'N/A';
            if($vals[ 2]) $data[$keys[ 2]] = $offer['Seller']['AverageFeedbackRating']
              ?? 0;
            if($vals[ 3]) $data[$keys[ 3]] = $offer['OfferAttributes']['Condition']
              ?? 'N/A';
            if($vals[ 4]) $data[$keys[ 4]] = $offer['OfferAttributes']['ConditionNote']
              ?? 'N/A';
            if($vals[ 5]) $data[$keys[ 5]] = $offer['OfferAttributes']['Country']
              ?? 'N/A';
            if($vals[ 6]) $data[$keys[ 6]] = $offer['OfferListing']['ExchangeId']
              ?? 'N/A';
            if($vals[ 7]) $data[$keys[ 7]]
              = $offer['OfferListing']['IsEligibleForSuperSaverShipping']
              ?? 0;
            if($vals[ 8]) $data[$keys[ 8]] = $offer['OfferListing']['OfferListingId']
              ?? 'N/A';
            if($vals[ 9]) $data[$keys[ 9]] = $offer['OfferListing']['Price']['Amount']
              ?? 0;
            if($vals[10]) $data[$keys[10]] = $offer['OfferListing']['Price']['CurrencyCode']
              ?? 'N/A';
            if($vals[11]) $data[$keys[11]] = $offer['OfferAttributes']['State']
              ?? 'N/A';
            if($vals[12]) $data[$keys[12]] = $offer['Seller']['SellerId']
              ?? 'N/A';
            if($vals[13]) $data[$keys[13]] = $offer['OfferAttributes']['SubCondition']
              ?? 'N/A';
            if($vals[14]) $data[$keys[14]] = $offer['Seller']['TotalFeedback']
              ?? 0;
            if($vals[15]) $data[$keys[15]] = $datetime;
            if($vals[16]) $data[$keys[16]] = $datetime;
            array_push($datas, $data);
          }
        }
      }
    }
    return $datas;
  }

  private function fetchOffers($request)
  {
    $response = array();
    $asins_jp = array();
    $asins_au = array();
    $asins_us = array();
    $eol = count($request);
    $idx = 0;
    foreach($request as $_request) {
      switch($_request['marketplace']) {
      case 'JP':
        array_push($asins_jp, $_request['asin']);
        if(count($asins_jp) > 10 || $idx === $eol - 1) {
          array_push($response, ['fetchOffer' => $this->fetchOffer(implode(',', $asins_jp), 'JP')
            , 'marketplace' => 'JP']);
          $asins_jp = array();
        }
        break;
      case 'AU':
        array_push($asins_au, $_request['asin']);
        if(count($asins_au) > 10 || $idx === $eol - 1 ) {
          array_push($response, ['fetchOffer' => $this->fetchOffer(implode(',', $asins_au), 'AU')
            , 'marketplace' => 'AU']);
          $asins_au = array();
        }
        break;
      case 'US':
        array_push($asins_us, $_request['asin']);
        if(count($asins_us) > 10 || $idx === $eol - 1) {
          array_push($response, ['fetchOffer' => $this->fetchOffer(implode(',', $asins_us), 'US')
            , 'marketplace' => 'US']);
          $asins_us = array();
        }
        break;
      }
      $idx += 1;
    }
    return $response;
  }

  private function fetchOffer($asin, $marketplace) {
    $conf = new GenericConfiguration();
    $client = new \GuzzleHttp\Client();
    $request = new \ApaiIO\Request\GuzzleRequest($client);
    switch($marketplace) {
      case 'JP':  $country = Country::JAPAN;          break;
      case 'US':  $country = Country::INTERNATIONAL;  break;
      case 'AU':  $country = Country::AUSTRALIA;      break;
      default:    $country = Country::JAPAN;          break;
    }
    sleep(5);
    try {
      $conf
        ->setCountry($country)
        ->setAccessKey($this->access_key)
        ->setSecretKey($this->secret_key)
        ->setAssociateTag($this->associ_tag)
        ->setRequest($request)
        ->setResponseTransformer(new XmlToArray())
      ;
    } catch (\Exception $e) {
      echo $e->getMessage();
    }
    $apaiIo = new ApaiIO($conf);
    $lookup = new Lookup();
    $lookup->setItemId($asin);
    $lookup->setResponseGroup(array('OfferFull'));
    $lookup->setCondition('All');
    return $apaiIo->runOperation($lookup);
  }

  private function getTimeStamp($str)
  {
    return \DateTime::createFromFormat('Y-m-d', $str)->format('Y/m/d H:i:s');
  }

  private function logError($message)
  {
    $this->log(print_r($message, true), LOG_ERROR);
  }

  private function logDebug($message)
  {
    $this->log(print_r($message, true), LOG_DEBUG);
  }

}
