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
 * FetchItems shell task.
 */
class FetchItemsTask extends Shell
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
    $this->execItemLookup();
  }


  private function execItemLookup() {
    $asins = TableRegistry::get('Asins');
    $datas = $asins->find()->where(['suspended' => false]);
    $request = array();
    foreach($datas as $data) {
      array_push($request, ['asin' => $data->asin, 'marketplace' => $data->marketplace]);
    }
    if(!$this->upsertItem($request)) {
      return false;
    }
    return true;
  }

  private function insertItem($request)
  {
    $header = array(
        'asin'                                => true
      , 'title'                               => true
      , 'is_eligible_prime'                   => true
      , 'is_eligible_for_supersaver_shipping' => true
      , 'item_height'                         => true
      , 'item_length'                         => true
      , 'item_weight'                         => true
      , 'item_width'                          => true
      , 'package_height'                      => true
      , 'package_length'                      => true
      , 'package_weight'                      => true
      , 'package_width'                       => true
      , 'list_price'                          => true
      , 'list_price_currency'                 => true
      , 'lowest_price'                        => true
      , 'lowest_price_currency'               => true
      , 'lowest_used_price'                   => true
      , 'lowest_used_price_currency'          => true
      , 'lowest_collectible_price'            => true
      , 'lowest_collectible_price_currency'   => true
      , 'offer_listing_price'                 => true
      , 'offer_listing_price_currency'        => true
      , 'offer_listing_saved_price'           => true
      , 'offer_listing_saved_price_currency'  => true
      , 'sales_ranking'                       => true
      , 'ean'                                 => true
      , 'release_date_at'                     => true
      , 'publication_date_at'                 => true
      , 'original_release_date_at'            => true
      , 'condition_status'                    => true
      , 'total_reviews'                       => false
      , 'average_rating'                      => false
      , 'total_votes'                         => false
      , 'product_group'                       => true
      , 'quantity'                            => false
      , 'quantity_allocated'                  => false
      , 'status'                              => false
      , 'detail_page_url'                     => true
      , 'small_image_url'                     => true
      , 'medium_image_url'                    => true
      , 'large_image_url'                     => true
      , 'total_new'                           => true
      , 'total_used'                          => true
      , 'total_collectible'                   => true
      , 'total_refurbished'                   => true
      , 'customer_reviews_url'                => true
      , 'marketplace'                         => true
      , 'created'                             => true
      , 'modified'                            => true
    );
    $items = TableRegistry::get('Items');

    $results = $this->setItems($header, $request);

    $query = $items->query();
    $query->insert(array_keys($header));
    foreach($results as $result) {
      $query->values($result);
    }
    if(!$query->execute()) {
      $this->log_error($query->errors());
      return false;
    }

    return true;
  }

  private function upsertItem($request)
  {
    $header = array(
        'asin'                                => true
      , 'title'                               => true
      , 'is_eligible_prime'                   => true
      , 'is_eligible_for_supersaver_shipping' => true
      , 'item_height'                         => true
      , 'item_length'                         => true
      , 'item_weight'                         => true
      , 'item_width'                          => true
      , 'package_height'                      => true
      , 'package_length'                      => true
      , 'package_weight'                      => true
      , 'package_width'                       => true
      , 'list_price'                          => true
      , 'list_price_currency'                 => true
      , 'lowest_price'                        => true
      , 'lowest_price_currency'               => true
      , 'lowest_used_price'                   => true
      , 'lowest_used_price_currency'          => true
      , 'lowest_collectible_price'            => true
      , 'lowest_collectible_price_currency'   => true
      , 'offer_listing_price'                 => true
      , 'offer_listing_price_currency'        => true
      , 'offer_listing_saved_price'           => true
      , 'offer_listing_saved_price_currency'  => true
      , 'sales_ranking'                       => true
      , 'ean'                                 => true
      , 'release_date_at'                     => true
      , 'publication_date_at'                 => true
      , 'original_release_date_at'            => true
      , 'condition_status'                    => true
      , 'total_reviews'                       => false
      , 'average_rating'                      => false
      , 'total_votes'                         => false
      , 'product_group'                       => true
      , 'quantity'                            => false
      , 'quantity_allocated'                  => false
      , 'status'                              => false
      , 'detail_page_url'                     => true
      , 'small_image_url'                     => true
      , 'medium_image_url'                    => true
      , 'large_image_url'                     => true
      , 'total_new'                           => true
      , 'total_used'                          => true
      , 'total_collectible'                   => true
      , 'total_refurbished'                   => true
      , 'customer_reviews_url'                => true
      , 'marketplace'                         => true
      , 'created'                             => true
      , 'modified'                            => true
    );
    $items = TableRegistry::get('Items');

    $results = $this->setItems($header, $request);
    //debug($results);

    foreach($results as $result) {
      $entity = $items->newEntity($result);
      $item = $items->find()
        ->where(['asin' => $entity->asin, 'marketplace' => $entity->marketplace])
        ->first();
      if($item) {
        unset($result['created']);
        $entity = $items->patchEntity($item, $result);
      }
      //print_r($entity);
      if(!$items->save($entity)) {
        $this->log_error($entity->errors());
        return false;
      }
    }
    return true;
  }

  private function setItems($header, $request)
  { 
    $datas = array();
    $datetime = date('Y-m-d H:i:s');
    $deftime  = date('Y-m-d H:i:s', 0);
    $keys     = array_keys($header);
    $vals     = array_values($header);

    $responses = $this->fetchItems($request);
    //debug($responses);

    foreach($responses as $response) {
      //print_r($response);
      $operation    = $response['fetchItem']['OperationRequest'];
      $parameter    = $response['fetchItem']['Items']['Request'];
      $_items       = $response['fetchItem']['Items']['Item'];
      $items        = array_values($_items) === $_items ? $_items : [$_items];
      $marketplace  = $response['marketplace'];
      $data = array();
      foreach($items as $item) {
        if($item) {
          //print_r($item);
          if($vals[ 0]) $data[$keys[ 0]] = $item['ASIN']                            ?? 'N/A';
          if($vals[ 1]) $data[$keys[ 1]] = $item['ItemAttributes']['Title']         ?? 'N/A';
          if($vals[ 2]) $data[$keys[ 2]]
            = $item['Offers']['Offer']['OfferListing']['IsEligibleForPrime']        ?? 0;
          if($vals[ 3]) $data[$keys[ 3]]
            = $item['Offers']['Offer']['OfferListing']['IsEligibleForSuperSaverShipping']
                                                                                    ?? 0;
          if($vals[ 4]) $data[$keys[ 4]]
            = isset($item['ItemAttributes']['ItemDimensions']['Height'])
              ? $this->getLocalLength($item['ItemAttributes']['ItemDimensions']['Height']
              , 'inches')
              : 0;
          if($vals[ 5]) $data[$keys[ 5]]
            = isset($item['ItemAttributes']['ItemDimensions']['Length'])
              ? $this->getLocalLength($item['ItemAttributes']['ItemDimensions']['Length']
                , 'inches')
              : 0;
          if($vals[ 6]) $data[$keys[ 6]]
            = isset($item['ItemAttributes']['ItemDimensions']['Weight'])
              ? $this->getLocalWeight($item['ItemAttributes']['ItemDimensions']['Weight']
              , 'pounds')
              : 0;
          if($vals[ 7]) $data[$keys[ 7]]
            = isset($item['ItemAttributes']['ItemDimensions']['Width'])
              ? $this->getLocalLength($item['ItemAttributes']['ItemDimensions']['Width']
              , 'inches')
              : 0;
          if($vals[ 8]) $data[$keys[ 8]]
            = isset($item['ItemAttributes']['PackageDimensions']['Height'])
              ? $this->getLocalLength($item['ItemAttributes']['PackageDimensions']['Height']
                , 'inches')
              : 0;
          if($vals[ 9]) $data[$keys[ 9]]
            = isset($item['ItemAttributes']['PackageDimensions']['Length'])
              ? $this->getLocalLength($item['ItemAttributes']['PackageDimensions']['Length']
                , 'inches')
              : 0;
          if($vals[10]) $data[$keys[10]]
            = isset($item['ItemAttributes']['PackageDimensions']['Weight'])
              ? $this->getLocalWeight($item['ItemAttributes']['PackageDimensions']['Weight']
                , 'pounds')
              : 0;
          if($vals[11]) $data[$keys[11]]
            = isset($item['ItemAttributes']['PackageDimensions']['Width'])
              ? $this->getLocalLength($item['ItemAttributes']['PackageDimensions']['Width']
                , 'inches')
              : 0;
          if($vals[12]) $data[$keys[12]]
            = isset($item['ItemAttributes']['ListPrice']['Amount'])
              ? $this->getLocalPrice(
                  $item['ItemAttributes']['ListPrice']['Amount']
                , $item['ItemAttributes']['ListPrice']['CurrencyCode']
                )
              : 0;
          if($vals[13]) $data[$keys[13]]
            = $item['ItemAttributes']['ListPrice']['CurrencyCode']                  ?? 'N/A';
          if($vals[14]) $data[$keys[14]]
            = isset($item['OfferSummary']['LowestNewPrice']['Amount'])
              ? $this->getLocalPrice(
                  $item['OfferSummary']['LowestNewPrice']['Amount']
                , $item['OfferSummary']['LowestNewPrice']['CurrencyCode']
                )
              : 0;
          if($vals[15]) $data[$keys[15]]
            = $item['OfferSummary']['LowestNewPrice']['CurrencyCode']               ?? 'N/A';
          if($vals[16]) $data[$keys[16]]
            = isset($item['OfferSummary']['LowestUsedPrice']['Amount'])
              ? $this->getLocalPrice(
                  $item['OfferSummary']['LowestUsedPrice']['Amount']
                , $item['OfferSummary']['LowestUsedPrice']['CurrencyCode']
                )
              : 0;
          if($vals[17]) $data[$keys[17]]
            = $item['OfferSummary']['LowestUsedPrice']['CurrencyCode']              ?? 'N/A';
          if($vals[18]) $data[$keys[18]]
            = isset($item['OfferSummary']['LowestCollectiblePrice']['Amount'])
              ? $this->getLocalPrice(
                  $item['OfferSummary']['LowestCollectiblePrice']['Amount']
                , $item['OfferSummary']['LowestCollectiblePrice']['CurrencyCode']
                )
              : 0;
          if($vals[19]) $data[$keys[19]]
            = $item['OfferSummary']['LowestCollectiblePrice']['CurrencyCode']       ?? 'N/A';
          if($vals[20]) $data[$keys[20]]
            = isset($item['Offers']['Offer']['OfferListing']['Price']['Amount'])
              ? $this->getLocalPrice(
                  $item['Offers']['Offer']['OfferListing']['Price']['Amount']
                , $item['Offers']['Offer']['OfferListing']['Price']['CurrencyCode']
                )
              : 0;
          if($vals[21]) $data[$keys[21]]
            = $item['Offers']['Offer']['OfferListing']['Price']['CurrencyCode']     ?? 'N/A';
          if($vals[22]) $data[$keys[22]]
            = isset($item['Offers']['Offer']['OfferListing']['AmountSaved']['Amount'])
              ? $this->getLocalPrice(
                  $item['Offers']['Offer']['OfferListing']['AmountSaved']['Amount']
                , $item['Offers']['Offer']['OfferListing']['AmountSaved']['CurrencyCode']
                )
              : 0;
          if($vals[23]) $data[$keys[23]] = 
            $item['Offers']['Offer']['OfferListing']['AmountSaved']['CurrencyCode'] ?? 'N/A';
          if($vals[24]) $data[$keys[24]] = $item['SalesRank']                       ?? 0;
          if($vals[25]) $data[$keys[25]] = $item['ItemAttributes']['EAN']           ?? 'N/A';
          if($vals[26]) $data[$keys[26]]
            = isset($item['ItemAttributes']['ReleaseDate'])
              ? $this->getTimeStamp($item['ItemAttributes']['ReleaseDate']) : $deftime;
          if($vals[27]) $data[$keys[27]]
            = isset($item['ItemAttributes']['PublicationDate'])
              ? $this->getTimeStamp($item['ItemAttributes']['PublicationDate']) : $deftime;
          if($vals[28]) $data[$keys[28]]
            = isset($item['ItemAttributes']['OriginalReleaseDate']) ?
              $this->getTimeStamp($item['ItemAttributes']['OriginalReleaseDate']) : $deftime;
          if($vals[29]) $data[$keys[29]]
            = $item['Offers']['Offer']['OfferAttributes']['Condition']              ?? 'N/A';
          if($vals[30]) $data[$keys[30]] = $item['CustomerReviews']['TotalReviews'] ?? 0;
          if($vals[31]) $data[$keys[31]] = $item['CustomerReviews']['AverageRating'] ?? 0;
          if($vals[32]) $data[$keys[32]] = $item['CustomerReviews']['TotalVotes']   ?? 0;
          if($vals[33]) $data[$keys[33]] = $item['ItemAttributes']['ProductGroup']  ?? 'N/A';
          if($vals[34]) $data[$keys[34]] = $item['Cart']['Quantity']                ?? 0;
          if($vals[35]) $data[$keys[35]] = $item['Status']                          ?? 0;
          if($vals[36]) $data[$keys[36]] = $item['QuantityAllocated']               ?? 0;
          if($vals[37]) $data[$keys[37]] = $item['DetailPageURL']                   ?? 'N/A';
          if($vals[38]) $data[$keys[38]] = $item['SmallImage']['URL']               ?? 'N/A';
          if($vals[39]) $data[$keys[39]] = $item['MediumImage']['URL']              ?? 'N/A';
          if($vals[40]) $data[$keys[40]] = $item['LargeImage']['URL']               ?? 'N/A';
          if($vals[41]) $data[$keys[41]] = $item['OfferSummary']['TotalNew']        ?? 0;
          if($vals[42]) $data[$keys[42]] = $item['OfferSummary']['TotalUsed']       ?? 0;
          if($vals[43]) $data[$keys[43]] = $item['OfferSummary']['TotalCollectible'] ?? 0;
          if($vals[44]) $data[$keys[44]] = $item['OfferSummary']['TotalRefurbished'] ?? 0;
          if($vals[45]) $data[$keys[45]] = $item['CustomerReviews']['IFrameURL']    ?? 'N/A';
          if($vals[46]) $data[$keys[46]] = $marketplace;
          if($vals[47]) $data[$keys[47]] = $datetime;
          if($vals[48]) $data[$keys[48]] = $datetime;    
          array_push($datas, $data);
        }
      }
    }
    return $datas;
  }

  private function fetchItems($request)
  {
    $response = [];
    Promise\all($this->_fetchItems($request))
      ->done(function($result) use (&$response) {
        $response = $result;
      }, function($error) {
        $this->log_error($error);
      });
    return $response;
  }

  private function _fetchItems($request)
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
        if($this->isKey('JP')) array_push($asins_jp, $_request['asin']);
        if(count($asins_jp) > 10) {
          array_push($response, $this->fetchItem(implode(',', $asins_jp), 'JP'));
          $asins_jp = array();
        }
        break;
      case 'AU':
        if($this->isKey('AU')) array_push($asins_au, $_request['asin']);
        if(count($asins_au) > 10) {
          array_push($response, $this->fetchItem(implode(',', $asins_au), 'AU'));
          $asins_au = array();
        }
        break;
      case 'US':
        if($this->isKey('US')) array_push($asins_us, $_request['asin']);
        if(count($asins_us) > 10) {
          array_push($response, $this->fetchItem(implode(',', $asins_us), 'US'));
          $asins_us = array();
        }
        break;
      }
      if($idx === $eol - 1) {
        if(count($asins_jp) !== 0)
          array_push($response, $this->fetchItem(implode(',', $asins_jp), 'JP'));
        if(count($asins_au) !== 0)
          array_push($response, $this->fetchItem(implode(',', $asins_au), 'AU'));
        if(count($asins_us) !== 0)
          array_push($response, $this->fetchItem(implode(',', $asins_us), 'US'));
      }
      $idx += 1;
    }
    return $response;
  }

  private function fetchItem($asin, $marketplace) {
    $deferred = new Promise\Deferred();
    $this->_fetchItem(function($error, $response) use ($deferred) {
      if($error) {
        $this->log_error($error);
        $deferred->reject($error);
      }
      $deferred->resolve($response);
    }, $asin, $marketplace);
    return $deferred->promise();
  }

  private function _fetchItem($callback, $asin, $marketplace) 
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
    $lookup->setCondition('All');
    $lookup->setMerchantId('All');
    $lookup->setResponseGroup(array(
      'Images', 'ItemAttributes', 'OfferListings', 'OfferSummary', 'SalesRank', 'Reviews'
    ));

    $callback(null, [
      'fetchItem'   => $apaiIo->runOperation($lookup)
    , 'marketplace' => $marketplace
    ]);
  }

  private function getTimeStamp($str)
  {
    return \DateTime::createFromFormat('Y-m-d', $str)->format('Y/m/d H:i:s');
  }

  private function getLocalLength($length, $units) 
  {
    $rate = 0;
    switch($units) {
    case 'inches':
      $rate = 25.4;
      break;
    default:
      $rate = 1;
      break;
    }
    return (float)($length * $rate / 100);
  }

  private function getLocalWeight($weight, $units)
  {
    $rate = 0;
    switch($units) {
    case 'pounds':
      $rate = 0.45359237;
      break;
    default:
      break;
    }
    return (float)($weight * $rate / 100);
  }

  private function getLocalPrice($price, $currency)
  {
    $rate = 0;
    switch($currency) {
    case 'AUD':
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
