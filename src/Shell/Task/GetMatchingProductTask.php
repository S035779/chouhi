<?php
namespace App\Shell\Task;

use Cake\Console\Shell;
use Cake\ORM\TableRegistry;
use Cake\Log\Log;
use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use App\Controller\Component\CommonComponent;
use App\Controller\Component\AmazonMWSComponent;
use React\Promise;
use React\EventLoop;

/**
 * GetMatchingProdust shell task.
 */
class GetMatchingProductTask extends Shell
{
  public function initialize()
  {
    $this->AmazonMWS = new AmazonMWSComponent(new ComponentRegistry());
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
    debug("first:" . memory_get_usage(true)       / (1024 * 1024) . " MB");
    $this->ids = $this->setAsins();
    $result = $this->execGetMatchingProduct();
    debug("peak :" . memory_get_peak_usage(true)  / (1024 * 1024) . " MB");
    debug("last :" . memory_get_usage(true)       / (1024 * 1024) . " MB");
    return $result;
  }

  private function setAsins()
  {
    $asins = TableRegistry::get('Asins');
    $datas = $asins->find()->where(['suspended' => false])
      ->all();
    $ids = array();
    foreach($datas as $data) {
      array_push($ids, ['asin' => $data->asin, 'ean' => $data->ean]);
    }
    return $ids;
  }

  private function execGetMatchingProduct()
  {
    $tokens = TableRegistry::get('Tokens');
    $datas  = $tokens->find()->contain(['Sellers'])
      ->where(['suspended' => false])
      ->all();
    $request = array();
    foreach($datas as $data) {
      array_push($request, [
        'seller'      => $data->seller->seller
      , 'marketplace' => $data->seller->marketplace
      , 'access_key'  => $data->access_key
      , 'secret_key'  => $data->secret_key
      ]);
    }
    if(!$this->upsertMatchingProduct($request)) {
      return false;
    }
    return true;
  }

  private function insertMatchingProduct($request)
  {
    $header = array(
        'asin'                                => true
      , 'title'                               => true
      , 'is_eligible_prime'                   => false
      , 'is_eligible_for_supersaver_shipping' => false
      , 'item_height'                         => true
      , 'item_length'                         => true
      , 'item_weight'                         => true
      , 'item_width'                          => true
      , 'package_height'                      => true
      , 'package_length'                      => true
      , 'package_weight'                      => true
      , 'package_width'                       => true
      , 'list_price'                          => false
      , 'list_price_currency'                 => false
      , 'lowest_price'                        => false
      , 'lowest_price_currency'               => false
      , 'lowest_used_price'                   => false
      , 'lowest_used_price_currency'          => false
      , 'lowest_collectible_price'            => false
      , 'lowest_collectible_price_currency'   => false
      , 'offer_listing_price'                 => false
      , 'offer_listing_price_currency'        => false
      , 'offer_listing_saved_price'           => false
      , 'offer_listing_saved_price_currency'  => false
      , 'sales_ranking'                       => false
      , 'ean'                                 => false
      , 'release_date_at'                     => false
      , 'publication_date_at'                 => false
      , 'original_release_date_at'            => false
      , 'condition_status'                    => false
      , 'total_reviews'                       => false
      , 'average_rating'                      => false
      , 'total_votes'                         => false
      , 'product_group'                       => true
      , 'quantity'                            => true
      , 'quantity_allocated'                  => false
      , 'status'                              => false
      , 'detail_page_url'                     => true
      , 'small_image_url'                     => true
      , 'medium_image_url'                    => true
      , 'large_image_url'                     => true
      , 'total_new'                           => false
      , 'total_used'                          => false
      , 'total_collectible'                   => false
      , 'total_refurbished'                   => false
      , 'customer_reviews_url'                => false
      , 'marketplace'                         => true
      , 'created'                             => true
      , 'modified'                            => true
    );
    $items = TableRegistry::get('Items');

    $results = $this->setMatchingProducts($header, $request);

    $query = $items->query();
    $query->insert(array_keys($header));
    foreach($results as $result) {
      $query->values($result);
    }
    if(!$query->execute()) {
      $this->Common->log_debug($query->errors(), 'crons');
      return false;
    }

    return true;
  }

  private function upsertMatchingProduct($request)
  {
    $header = array(
        'asin'                                => true
      , 'title'                               => true
      , 'is_eligible_prime'                   => false
      , 'is_eligible_for_supersaver_shipping' => false
      , 'item_height'                         => true
      , 'item_length'                         => true
      , 'item_weight'                         => true
      , 'item_width'                          => true
      , 'package_height'                      => true
      , 'package_length'                      => true
      , 'package_weight'                      => true
      , 'package_width'                       => true
      , 'list_price'                          => false
      , 'list_price_currency'                 => false
      , 'lowest_price'                        => false
      , 'lowest_price_currency'               => false
      , 'lowest_used_price'                   => false
      , 'lowest_used_price_currency'          => false
      , 'lowest_collectible_price'            => false
      , 'lowest_collectible_price_currency'   => false
      , 'offer_listing_price'                 => false
      , 'offer_listing_price_currency'        => false
      , 'offer_listing_saved_price'           => false
      , 'offer_listing_saved_price_currency'  => false
      , 'sales_ranking'                       => false
      , 'ean'                                 => false
      , 'release_date_at'                     => false
      , 'publication_date_at'                 => false
      , 'original_release_date_at'            => false
      , 'condition_status'                    => false
      , 'total_reviews'                       => false
      , 'average_rating'                      => false
      , 'total_votes'                         => false
      , 'product_group'                       => true
      , 'quantity'                            => true
      , 'quantity_allocated'                  => false
      , 'status'                              => false
      , 'detail_page_url'                     => true
      , 'small_image_url'                     => true
      , 'medium_image_url'                    => true
      , 'large_image_url'                     => true
      , 'total_new'                           => false
      , 'total_used'                          => false
      , 'total_collectible'                   => false
      , 'total_refurbished'                   => false
      , 'customer_reviews_url'                => false
      , 'marketplace'                         => true
      , 'created'                             => true
      , 'modified'                            => true
    );
    $items = TableRegistry::get('Items');

    $results = $this->setMatchingProducts($header, $request);

    foreach($results as $result) {
      $entity = $items->newEntity($result);
      $item = $items->find()
        ->where(['asin' => $entity->asin, 'marketplace' => $entity->marketplace])
        ->orWhere(['ean' => $entity->ean, 'marketplace' => $entity->marketplace])
        ->first();
      if($item) {
        unset($result['created']);
        $entity = $items->patchEntity($item, $result);
      }
      //print_r($entity);
      if(!$items->save($entity)) {
        $this->Common->log_debug($entity->errors(), 'crons');
        return false;
      }
    }
    return true;
  }

  private function setMatchingProducts($header, $request)
  { 
    $datas = array();
    $datetime = date('Y-m-d H:i:s');
    $deftime  = date('Y-m-d H:i:s', 0);
    $keys     = array_keys($header);
    $vals     = array_values($header);

    $ships = TableRegistry::get('Ships');
    $ship = $ships->find()->first();

    $responses = $this->fetchMatchingProducts($request);

    foreach($responses as $response) {
      if($response) {
        //print_r($response);
        $result         = $response['fetchMatchingProduct']['Result'];
        $metadata       = $response['fetchMatchingProduct']['Metadata'];
        $headermetadata = $response['fetchMatchingProduct']['HeaderMetadata'];
        $marketplace    = $response['marketplace'];
        $ean            = $response['id_type'] === 'EAN' ? $response['id'] : null;
        foreach($result as $_result) {
          if($_result['status'] === 'Success') {
            $_products = $_result['products'];
            $products = array_values($_products) === $_products ? $_products : [$_products];
            $data = array();
            foreach($products as $product) {
              if($product) {
                //print_r($product); 
                $asin = $product['Identifiers']['MarketplaceASIN'];
                $attr = $product['AttributeSets']['Any'];
                if($vals[ 0]) $data[$keys[ 0]] = $asin['ASIN']                         ?? 'N/A';
                if($vals[ 1]) $data[$keys[ 1]] = $attr['ns2:Title']                    ?? 'N/A';
                if($vals[ 2]) $data[$keys[ 2]] = 0;
                if($vals[ 3]) $data[$keys[ 3]] = 0;
                if($vals[ 4]) $data[$keys[ 4]]
                  = isset($attr['ns2:ItemDimensions']['ns2:Height']['_value'])
                    ? $this->Common->getLocalLength2(
                        $attr['ns2:ItemDimensions']['ns2:Height']['_value']
                      , $attr['ns2:ItemDimensions']['ns2:Height']['@attributes']['Units']
                      , $ship)
                    : 0;
                if($vals[ 5]) $data[$keys[ 5]]
                  = isset($attr['ns2:ItemDimensions']['ns2:Length']['_value'])
                    ? $this->Common->getLocalLength2(
                        $attr['ns2:ItemDimensions']['ns2:Length']['_value']
                      , $attr['ns2:ItemDimensions']['ns2:Length']['@attributes']['Units']
                      , $ship)
                    : 0;
                if($vals[ 6]) $data[$keys[ 6]]
                  = isset($attr['ns2:ItemDimensions']['ns2:Weight']['_value'])
                    ? $this->Common->getLocalWeight2(
                        $attr['ns2:ItemDimensions']['ns2:Weight']['_value']
                      , $attr['ns2:ItemDimensions']['ns2:Weight']['@attributes']['Units']
                      , $ship)
                    : 0;
                if($vals[ 7]) $data[$keys[ 7]]
                  = isset($attr['ns2:ItemDimensions']['ns2:Width']['_value'])
                    ? $this->Common->getLocalLength2(
                        $attr['ns2:ItemDimensions']['ns2:Width']['_value']
                      , $attr['ns2:ItemDimensions']['ns2:Width']['@attributes']['Units']
                      , $ship)
                    : 0;
                if($vals[ 8]) $data[$keys[ 8]]
                  = isset($attr['ns2:PackageDimensions']['ns2:Height']['_value'])
                    ? $this->Common->getLocalLength2(
                        $attr['ns2:PackageDimensions']['ns2:Height']['_value']
                      , $attr['ns2:PackageDimensions']['ns2:Height']['@attributes']['Units']
                      , $ship)
                    : 0;
                if($vals[ 9]) $data[$keys[ 9]]
                  = isset($attr['ns2:PackageDimensions']['ns2:Length']['_value'])
                    ? $this->Common->getLocalLength2(
                        $attr['ns2:PackageDimensions']['ns2:Length']['_value']
                      , $attr['ns2:PackageDimensions']['ns2:Length']['@attributes']['Units']
                      , $ship)
                    : 0;
                if($vals[10]) $data[$keys[10]]
                  = isset($attr['ns2:PackageDimensions']['ns2:Weight']['_value'])
                    ? $this->Common->getLocalWeight2(
                        $attr['ns2:PackageDimensions']['ns2:Weight']['_value']
                      , $attr['ns2:PackageDimensions']['ns2:Weight']['@attributes']['Units']
                      , $ship)
                    : 0;
                if($vals[11]) $data[$keys[11]]
                  = isset($attr['ns2:PackageDimensions']['ns2:Width']['_value'])
                    ? $this->Common->getLocalLength2(
                        $attr['ns2:PackageDimensions']['ns2:Width']['_value']
                      , $attr['ns2:PackageDimensions']['ns2:Width']['@attributes']['Units']
                      , $ship)
                    : 0;
                if($vals[12]) $data[$keys[12]] = 0;
                if($vals[13]) $data[$keys[13]] = 'N/A';
                if($vals[14]) $data[$keys[14]] = 0;
                if($vals[15]) $data[$keys[15]] = 'N/A';
                if($vals[16]) $data[$keys[16]] = 0;
                if($vals[17]) $data[$keys[17]] = 'N/A';
                if($vals[18]) $data[$keys[18]] = 0;
                if($vals[19]) $data[$keys[19]] = 'N/A';
                if($vals[20]) $data[$keys[20]] = 0;
                if($vals[21]) $data[$keys[21]] = 'N/A';
                if($vals[22]) $data[$keys[22]] = 0;
                if($vals[23]) $data[$keys[23]] = 'N/A';
                if($vals[24]) $data[$keys[24]] = 0;
                if($vals[25]) $data[$keys[25]] = $ean                                  ?? 'N/A';
                if($vals[26]) $data[$keys[26]] = $deftime;
                if($vals[27]) $data[$keys[27]] = $deftime;
                if($vals[28]) $data[$keys[28]] = $deftime;
                if($vals[29]) $data[$keys[29]] = 'N/A';
                if($vals[30]) $data[$keys[30]] = 0;
                if($vals[31]) $data[$keys[31]] = 0;
                if($vals[32]) $data[$keys[32]] = 0;
                if($vals[33]) $data[$keys[33]] = $attr['ns2:ProductGroup']             ?? 'N/A';
                if($vals[34]) $data[$keys[34]] = $attr['ns2:PackageQuantity']          ?? 0;
                if($vals[35]) $data[$keys[35]] = 0;
                if($vals[36]) $data[$keys[36]] = 0;
                if($vals[37]) $data[$keys[37]] = $attr['ns2:DetailPageURL']            ?? 'N/A';
                if($vals[38]) $data[$keys[38]] = $attr['ns2:SmallImage']['ns2:URL']    ?? 'N/A';
                if($vals[39]) $data[$keys[39]] = $attr['ns2:MediumImage']['ns2:URL']   ?? 'N/A';
                if($vals[40]) $data[$keys[40]] = $attr['ns2:LargeImage']['ns2:URL']    ?? 'N/A';
                if($vals[41]) $data[$keys[41]] = 0;
                if($vals[42]) $data[$keys[42]] = 0;
                if($vals[43]) $data[$keys[43]] = 0;
                if($vals[44]) $data[$keys[44]] = 0;
                if($vals[45]) $data[$keys[45]] = 'N/A';
                if($vals[46]) $data[$keys[46]] = $marketplace;
                if($vals[47]) $data[$keys[47]] = $datetime;
                if($vals[48]) $data[$keys[48]] = $datetime;    
                array_push($datas, $data);
              }
            }
          }
        }
      }
    }
    return $datas;
  }

  private function fetchMatchingProducts($request)
  {
    $response = array();
    Promise\all($this->_fetchMatchingProducts($request))
      ->done(function($result) use (&$response) {
        //print_r($result);
        $response = $result;
      }, function($error) {
        $this->Common->log_error($error, __FILE__, __LINE__, 'crons');
      });
    return $response;
  }

  private function _fetchMatchingProducts($request)
  {
    $loop = EventLoop\Factory::create();
    $response = array();
    foreach($request as $_request) {
      foreach($this->ids as $_ids) {
        //debug($_ids);
        array_push($response, $this->retryMatchingProduct([
          'id' => $_ids['asin'], 'id_type' => 'ASIN'
        , 'access_key'  => $_request['access_key']
        , 'secret_key'  => $_request['secret_key']
        , 'seller'      => $_request['seller']
        , 'marketplace' => $_request['marketplace']
        ], $loop));
        if($_ids['ean'] && $_ids['ean'] !== 'N/A') {
          array_push($response, $this->retryMatchingProduct([
            'id' => $_ids['ean'],  'id_type' => 'EAN'
          , 'access_key'  => $_request['access_key']
          , 'secret_key'  => $_request['secret_key']
          , 'seller'      => $_request['seller']
          , 'marketplace' => $_request['marketplace']
          ], $loop));
        }
      }
    }
    $loop->run();
    return $response;
  }

  private function retryMatchingProduct($request, $loop) 
  {
    return $this->Common->retry($loop, function() use ($request, $loop) {
        return $this->fetchMatchingProduct($request);
      })
      ->otherwise(function($updated) {
        if($updated) $this->Common->log_error($updated, __FILE__, __LINE__, 'crons');
      });
  }

  private function fetchMatchingProduct($request)
  {
    $deferred = new Promise\Deferred();
    $this->_fetchMatchingProduct(function($error, $result) use ($deferred) {
      if($error) {
        $deferred->reject($error);
      } else {
        $deferred->resolve($result);
      }
    }, $request);
    return $deferred->promise();
  }

  private function _fetchMatchingProduct($callback, $request) 
  {
    $response = array();
    $access_key = $request['access_key'];
    $secret_key = $request['secret_key'];
    $seller     = $request['seller'];
    switch($request['marketplace']) {
    case 'JP':
      $market_id = $this->AmazonMWS::MWS_MARKETPLACE_JP;
      $country = $this->AmazonMWS::MWS_BASEURL_JP;
      break;
    case 'AU':
      $market_id = $this->AmazonMWS::MWS_MARKETPLACE_AU;
      $country = $this->AmazonMWS::MWS_BASEURL_AU;
      break;
    case 'US':
      $market_id = $this->AmazonMWS::MWS_MARKETPLACE_US;
      $country = $this->AmazonMWS::MWS_BASEURL_US;
      break;
    default:
      $market_id = $this->AmazonMWS::MWS_MARKETPLACE_JP;
      $country = $this->AmazonMWS::MWS_BASEURL_JP;
      break;
    }
    try {
      //debug($request);
      $response = $this->AmazonMWS->GetMatchingProduct([
        'Marketplace'     => $market_id
      , 'SellerId'        => $seller
      , 'AWSSecretKeyId'  => $secret_key
      , 'AWSAccessKeyId'  => $access_key
      , 'BaseURL'         => $country
      , 'IdType'          => $request['id_type']
      , 'Id'              => $request['id']
      ]);
    } catch (\Exception $e) {
      return $callback($e->getMessage(), null);
    }

    $callback(null, [
      'fetchMatchingProduct' => $response
    , 'marketplace' => $request['marketplace']
    , 'id_type'     => $request['id_type']
    , 'id'          => $request['id']
    ]);
  }
}
