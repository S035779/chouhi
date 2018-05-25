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
 * FetchItems shell task.
 */
class FetchItemsTask extends Shell
{

  public function initialize()
  {
    $this->access_key       = env('AMZ_PA_ACCESSKEY_JP', '');
    $this->secret_key       = env('AMZ_PA_SECRETKEY_JP', '');
    $this->associ_tag       = env('AMZ_PA_ASSOCITAG_JP', '');
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
    $datas = $asins->find()->where(['asin' => false]);
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
    $datas = $this->setItems($header, $request);
    $query = $items->query();
    $query->insert(array_keys($header));
    foreach($datas as $data) {
      $query->values($data);
    }
    if(!$query->execute()) {
      $this->logError($query->errors());
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
    $datas = $this->setItems($header, $request);
    foreach($datas as $data) {
      $entity = $items->newEntity($data);
      $item = $items->find()
        ->where(['asin' => $entity->asin, 'marketplace' => $entity->marketplace])
        ->first();
      if($item) {
        unset($data['created']);
        $entity = $items->patchEntity($item, $data);
      }
      if(!$items->save($entity)) {
        $this->logError($entity->errors());
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

    $response = $this->fetchItems($request);

    foreach($response as $_response) {
      $operation    = $_response['fetchItem']['OperationRequest'];
      $parameter    = $_response['fetchItem']['Items']['Request'];
      $items        = $_response['fetchItem']['Items']['Item'];
      $marketplace  = $_response['marketplace'];
      foreach($items as $item) {
        if($item) {
          //print_r($item);
          if($vals[ 0]) $data[$keys[ 0]] = $item['ASIN'] ?? 'N/A';
          if($vals[ 1]) $data[$keys[ 1]] = $item['ItemAttributes']['Title'] ?? 'N/A';
          if($vals[ 2]) $data[$keys[ 2]] = $item['Offers']['Offer']['OfferListing']
            ['IsEligibleForPrime'] ?? 0;
          if($vals[ 3]) $data[$keys[ 3]] = $item['Offers']['Offer']['OfferListing']
            ['IsEligibleForSuperSaverShipping'] ?? 0;
          if($vals[ 4]) $data[$keys[ 4]]
            = $item['ItemAttributes']['ItemDimensions']['Height'] ?? 0;
          if($vals[ 5]) $data[$keys[ 5]]
            = $item['ItemAttributes']['ItemDimensions']['Length'] ?? 0;
          if($vals[ 6]) $data[$keys[ 6]]
            = $item['ItemAttributes']['ItemDimensions']['Weight'] ?? 0;
          if($vals[ 7]) $data[$keys[ 7]]
            = $item['ItemAttributes']['ItemDimensions']['Width'] ?? 0;
          if($vals[ 8]) $data[$keys[ 8]]
            = $item['ItemAttributes']['PackageDimensions']['Height'] ?? 0;
          if($vals[ 9]) $data[$keys[ 9]]
            = $item['ItemAttributes']['PackageDimensions']['Length'] ?? 0;
          if($vals[10]) $data[$keys[10]]
            = $item['ItemAttributes']['PackageDimensions']['Weight'] ?? 0;
          if($vals[11]) $data[$keys[11]]
            = $item['ItemAttributes']['PackageDimensions']['Width'] ?? 0;
          if($vals[12]) $data[$keys[12]] = $item['ItemAttributes']['ListPrice']['Amount'] ?? 0;
          if($vals[13]) $data[$keys[13]]
            = $item['ItemAttributes']['ListPrice']['CurrencyCode'] ?? 'N/A';
          if($vals[14]) $data[$keys[14]]
            = $item['OfferSummary']['LowestNewPrice']['Amount'] ?? 0;
          if($vals[15]) $data[$keys[15]]
            = $item['OfferSummary']['LowestNewPrice']['CurrencyCode'] ?? 'N/A';
          if($vals[16]) $data[$keys[16]]
            = $item['OfferSummary']['LowestUsedPrice']['Amount'] ?? 0;
          if($vals[17]) $data[$keys[17]]
            = $item['OfferSummary']['LowestUsedPrice']['CurrencyCode'] ?? 'N/A';
          if($vals[18]) $data[$keys[18]]
            = $item['OfferSummary']['LowestCollectiblePrice']['Amount'] ?? 0;
          if($vals[19]) $data[$keys[19]]
            = $item['OfferSummary']['LowestCollectiblePrice']['CurrencyCode'] ?? 'N/A';
          if($vals[20]) $data[$keys[20]]
            = $item['Offers']['Offer']['OfferListing']['Price']['Amount'] ?? 0;
          if($vals[21]) $data[$keys[21]]
            = $item['Offers']['Offer']['OfferListing']['Price']['CurrencyCode'] ?? 'N/A';
          if($vals[22]) $data[$keys[22]]
            = $item['Offers']['Offer']['OfferListing']['AmountSaved']['Amount'] ?? 0;
          if($vals[23]) $data[$keys[23]]
            = $item['Offers']['Offer']['OfferListing']['AmountSaved']['CurrencyCode'] ?? 'N/A';
          if($vals[24]) $data[$keys[24]] = $item['SalesRank'] ?? 0;
          if($vals[25]) $data[$keys[25]] = $item['ItemAttributes']['EAN'] ?? 'N/A';
          if($vals[26]) $data[$keys[26]] = isset($item['ItemAttributes']['ReleaseDate'])
            ? $this->getTimeStamp($item['ItemAttributes']['ReleaseDate'])         : $deftime;
          if($vals[27]) $data[$keys[27]] = isset($item['ItemAttributes']['PublicationDate'])
            ? $this->getTimeStamp($item['ItemAttributes']['PublicationDate'])     : $deftime;
          if($vals[28]) $data[$keys[28]] = isset($item['ItemAttributes']['OriginalReleaseDate'])
            ? $this->getTimeStamp($item['ItemAttributes']['OriginalReleaseDate']) : $deftime;
          if($vals[29]) $data[$keys[29]]
            = $item['Offers']['Offer']['OfferAttributes']['Condition'] ?? 'N/A';
          if($vals[30]) $data[$keys[30]] = $item['CustomerReviews']['TotalReviews'] ?? 0;
          if($vals[31]) $data[$keys[31]] = $item['CustomerReviews']['AverageRating'] ?? 0;
          if($vals[32]) $data[$keys[32]] = $item['CustomerReviews']['TotalVotes'] ?? 0;
          if($vals[33]) $data[$keys[33]] = $item['ItemAttributes']['ProductGroup'] ?? 'N/A';
          if($vals[34]) $data[$keys[34]] = $item['Cart']['Quantity'] ?? 0;
          if($vals[35]) $data[$keys[35]] = $item['Status'] ?? 0;
          if($vals[36]) $data[$keys[36]] = $item['QuantityAllocated'] ?? 0;
          if($vals[37]) $data[$keys[37]] = $item['DetailPageURL'] ?? 'N/A';
          if($vals[38]) $data[$keys[38]] = $item['SmallImage']['URL'] ?? 'N/A';
          if($vals[39]) $data[$keys[39]] = $item['MediumImage']['URL'] ?? 'N/A';
          if($vals[40]) $data[$keys[40]] = $item['LargeImage']['URL'] ?? 'N/A';
          if($vals[41]) $data[$keys[41]] = $item['OfferSummary']['TotalNew'] ?? 0;        
          if($vals[42]) $data[$keys[42]] = $item['OfferSummary']['TotalUsed'] ?? 0;       
          if($vals[43]) $data[$keys[43]] = $item['OfferSummary']['TotalCollectible'] ?? 0;
          if($vals[44]) $data[$keys[44]] = $item['OfferSummary']['TotalRefurbished'] ?? 0;
          if($vals[45]) $data[$keys[45]] = $item['CustomerReviews']['IFrameURL'] ?? 'N/A';
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
          array_push($response, ['fetchItem' => $this->fetchItem(implode(',', $asins_jp), 'JP')
            , 'marketplace' => 'JP']);
          $asins_jp = array();
        }
        break;
      case 'AU':
        array_push($asins_au, $_request['asin']);
        if(count($asins_au) > 10 || $idx === $eol - 1 ) {
          array_push($response, ['fetchItem' => $this->fetchItem(implode(',', $asins_au), 'AU')
            , 'marketplace' => 'AU']);
          $asins_au = array();
        }
        break;
      case 'US':
        array_push($asins_us, $_request['asin']);
        if(count($asins_us) > 10 || $idx === $eol - 1) {
          array_push($response, ['fetchItem' => $this->fetchItem(implode(',', $asins_us), 'US')
            , 'marketplace' => 'US']);
          $asins_us = array();
        }
        break;
      }
      $idx += 1;
    }
    return $response;
  }

  private function fetchItem($asin, $marketplace) {
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
    $lookup->setResponseGroup(array(
      'Images', 'ItemAttributes', 'OfferListings', 'OfferSummary', 'SalesRank', 'Reviews'
    ));
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
