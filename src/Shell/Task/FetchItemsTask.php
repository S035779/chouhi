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
    $datas = $asins->find();
    foreach($datas as $data) {
      $response = $this->insertItem($data->asin, $data->marketplace);
      sleep(3);
    }
    return true;
  }

  private function insertItem($asin)
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
      , 'condition'                           => true
      , 'total_reviews'                       => true
      , 'average_rating'                      => true
      , 'total_votes'                         => true
      , 'product_group'                       => true
      , 'quantity'                            => true
      //, 'quantity_allocated'                  => false
      //, 'status'                              => false
      , 'marketplace'                         => true
      , 'detail_page_url'                     => true
      , 'small_image_url'                     => true
      , 'medium_image_url'                    => true
      , 'large_image_url'                     => true
    );
    $items = TableRegistry::get('Items');
    $datas = $this->setItems($this->lookup($asin), $header, $marketolace);
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

  private function upsertItem($asin)
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
      , 'condition'                           => true
      , 'total_reviews'                       => true
      , 'average_rating'                      => true
      , 'total_votes'                         => true
      , 'product_group'                       => true
      , 'quantity'                            => true
      //, 'quantity_allocated'                  => false
      //, 'status'                              => false
      , 'marketplace'                         => true
      , 'detail_page_url'                     => true
      , 'small_image_url'                     => true
      , 'medium_image_url'                    => true
      , 'large_image_url'                     => true
    );
    $items = TableRegistry::get('Items');
    $datas = $this->setItems($this->lookup($asin), $header, $marketplace);
    foreach($datas as $data) {
      $entity = $items->newEntity($data);
      $item = $items->find()
        ->where(['asin' => $entity->asin])
        ->first();
      if($item) {
        unset($data['created']);
        $entity = $items->patchEntity($item, $data);
      }
      if(!$items->save($entity)) {
        $this->logError($items->errors());
        return false;
      }
    }
    return true;
  }

  private function logError($message)
  {
    $this->log(print_r($message, true), LOG_DEBUG);
  }

  private function setItems($items, $header, $marketplace)
  {
    $datas = array();
    $datetime = date('Y-m-d H:i:s');
    foreach($items as $item) {
      $data['asin'                                ] = $item['Items']['Item']['ASIN'];
      $data['title'                               ] = $item['Items']['Item']['ItemAttributes']['Title'];
      $data['is_eligible_prime'                   ] = $item['Items']['Item']['Offers']['Offer']['OfferListing']['IsEligibleForPrime'];
      $data['is_eligible_for_supersaver_shipping' ] = $item['Items']['Item']['Offers']['Offer']['OfferListing']['IsEligibleForSuperSaverShipping'];
      $data['item_height'                         ] = $item['Items']['Item']['ItemAttributes']['ItemDimensions']['Height'];
      $data['item_length'                         ] = $item['Items']['Item']['ItemAttributes']['ItemDimensions']['Length'];
      $data['item_weight'                         ] = $item['Items']['Item']['ItemAttributes']['ItemDimensions']['Weight'];
      $data['item_width'                          ] = $item['Items']['Item']['ItemAttributes']['ItemDimensions']['Width'];
      $data['package_height'                      ] = $item['Items']['Item']['ItemAttributes']['PackageDimensions']['Height'];
      $data['package_length'                      ] = $item['Items']['Item']['ItemAttributes']['PackageDimensions']['Length'];
      $data['package_weight'                      ] = $item['Items']['Item']['ItemAttributes']['PackageDimensions']['Weight'];
      $data['package_width'                       ] = $item['Items']['Item']['ItemAttributes']['PackageDimensions']['Width'];
      $data['list_price'                          ] = $item['Items']['Item']['ItemAttributes']['ListPrice']['Amount'];
      $data['list_price_currency'                 ] = $item['Items']['Item']['ItemAttributes']['ListPrice']['CurrencyCode'];
      $data['lowest_price'                        ] = $item['Items']['Item']['OfferSummary']['LowestNewPrice']['Amount'];
      $data['lowest_price_currency'               ] = $item['Items']['Item']['OfferSummary']['LowestNewPrice']['CurrencyCode'];
      $data['lowest_used_price'                   ] = $item['Items']['Item']['OfferSummary']['LowestUsedPrice']['Amount'];
      $data['lowest_used_price_currency'          ] = $item['Items']['Item']['OfferSummary']['LowestUsedPrice']['CurrencyCode'];
      $data['lowest_collectible_price'            ] = $item['Items']['Item']['OfferSummary']['LowestCollectiblePrice']['Amount'];
      $data['lowest_collectible_price_currency'   ] = $item['Items']['Item']['OfferSummary']['LowestCollectiblePrice']['CurrencyCode'];
      $data['offer_listing_price'                 ] = $item['Items']['Item']['Offers']['Offer']['OfferListing']['Price']['Amount'];
      $data['offer_listing_price_currency'        ] = $item['Items']['Item']['Offers']['Offer']['OfferListing']['Price']['CurrencyCode'];
      $data['offer_listing_saved_price'           ] = $item['Items']['Item']['Offers']['Offer']['OfferListing']['AmountSaved']['Amount'];
      $data['offer_listing_saved_price_currency'  ] = $item['Items']['Item']['Offers']['Offer']['OfferListing']['AmountSaved']['CurrencyCode'];
      $date['sales_ranking'                       ] = $item['Items']['Item']['SalesRank'];
      $date['ean'                                 ] = $item['Items']['Item']['ItemAttributes']['EAN'];
      $date['release_date_at'                     ] = $item['Items']['Item']['ItemAttributes']['ReleaseDate'];
      $date['publication_date_at'                 ] = $item['Items']['Item']['ItemAttributes']['PublicationDate'];
      $date['original_release_date_at'            ] = $item['Items']['Item']['ItemAttributes']['OriginalReleaseDate'];
      $date['condition'                           ] = $item['Items']['Item']['Offers']['Offer']['OfferAttributes']['Condition'];
      $date['total_reviews'                       ] = $item['Items']['Item']['CustomerReviews']['TotalReviews'];
      $date['average_rating'                      ] = $item['Items']['Item']['CustomerReviews']['AverageRating'];
      $date['total_votes'                         ] = $item['Items']['Item']['CustomerReviews']['TotalVotes'];
      $date['product_group'                       ] = $item['Items']['Item']['ItemAttributes']['ProductGroup'];
      $data['quantity'                            ] = $item['Items']['Item']['Cart']['Quantity'];
      //$data['status'                              ] = $item['Items']['Item']['Status'];
      //$data['quantity_allocated'                  ] = $item['Items']['Item']['QuantityAllocated'];
      $data['detail_page_url'                     ] = $item['Items']['Item']['DetailPageURL'];
      $data['small_image_url'                     ] = $item['Items']['Item']['SmallImage']['URL'];
      $data['medium_image_url'                    ] = $item['Items']['Item']['MediumImage']['URL'];
      $data['large_image_url'                     ] = $item['Items']['Item']['LargeImage']['URL'];
      $data['marketplace'                         ] = $marketplace;
      $data['created'                             ] = $datetime;
      $data['modified'                            ] = $datetime;    
      array_push($datas, $data);
    }
    return $datas;
  }

  private function lookup($asin) {
    $conf = new GenericConfiguration();
    $client = new \GuzzleHttp\Client();
    $request = new \ApaiIO\Request\GuzzleRequest($client);
    try {
      $conf
        ->setCountry(Country::JAPAN)
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
    $lookup->setResponseGroup(array('Large'));
    return $apaiIo->runOperation($lookup);
  }

}
