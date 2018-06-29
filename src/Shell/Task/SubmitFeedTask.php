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
 * SubmitFeed shell task.
 */
class SubmitFeedTask extends Shell
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
    $this->execSubmitFeed();
  }

  private function execSubmitFeed()
  {
    $tokens = TableRegistry::get('Tokens');
    $datas = $tokens->find()->contain(['Sellers'])
      ->where(['suspended' => false])->all();
    $config = array();
    foreach($datas as $data) {
      array_push($config, [
        'seller'      => $data->seller->seller
      , 'marketplace' => $data->seller->marketplace
      , 'access_key'  => $data->access_key
      , 'secret_key'  => $data->secret_key
      ]);
    }
    if(!$this->fetchMerchants($config)) {
      return false;
    }
    return true;
  }

  private function fetchMerchants($config) 
  {
    $merchants = TableRegistry::get('Merchants');
    $request = array();
    foreach($config as $_config) {
      $merchant = $merchants->find()
        ->where([
          'marketplace'       => $_config['marketplace']
        , 'seller_identifier' => $_config['seller']
        ])->all();
      array_push($request, [
        'feedSets' => $this->setFeed($merchant)
      , 'config'   => $_config
      ]);
    }
    //debug($request);
    if(!$this->upsertMerchant($request)) {
      return false;
    }
    return true;
  }

  private function setFeed($merchant) 
  {
    $data = array();
    foreach($merchant as $_merchant) {
      if($_merchant->add_delete === 'a' || $_merchant->add_delete === 'd') {
        array_push($data, $this->setFeedType($this->AmazonMWS::MWS_ADDDEL_FEED, $_merchant));
      } else
      if($_merchant->add_delete === 'p') {
        array_push($data, $this->setFeedType($this->AmazonMWS::MWS_UPDATE_FEED, $_merchant));
      } else
      if($_merchant->update_delete === 'Update' || $_merchant->update_delete === 'Delete') {
        array_push($data, $this->setFeedType($this->AmazonMWS::MWS_CREATE_FEED, $_merchant));
      }
    }
    return $data;
  }

  private function setFeedType($feedType, $merchant)
  {
    $feed = array();
    switch($feedType) {
    case $this->AmazonMWS::MWS_ADDDEL_FEED:
      $feed = array(
        'sku'                          => $this->Common->isStr($merchant['seller_sku'                ])
      , 'product-id'                   => $this->Common->isStr($merchant['product_identifier'        ])
      , 'product-id-type'              => $this->Common->isStr($merchant['product_id_type'           ])
      , 'price'                        => $this->Common->isNum($merchant['price'                     ])
      , 'minimum-seller-allowed-price' => $this->Common->isNum($merchant['minimum_seller_allow_price'])
      , 'maximum-seller-allowed-price' => $this->Common->isNum($merchant['maximum_seller_allow_price'])
      , 'item-condition'               => $this->Common->isStr($merchant['item_condition'            ])
      , 'quantity'                     => $this->Common->isNum($merchant['quantity'                  ])
      , 'add-delete'                   => $this->Common->isStr($merchant['add_delete'                ])
      , 'will-ship-internationally'    => $this->Common->isStr($merchant['will_ship_internationally' ])
      , 'expedited-shipping'           => $this->Common->isStr($merchant['expedited_shipping'        ])
      , 'standard-plus'                => $this->Common->isStr($merchant['standard_plus'             ])
      , 'item-note'                    => $this->Common->isStr($merchant['item_note'                 ])
      , 'fulfillment-center-id'        => $this->Common->isStr($merchant['fullfillment_channel'      ])
      , 'product-tax-code'             => $this->Common->isStr($merchant['product_tax_code'          ])
      , 'leadtime-to-ship'             => $this->Common->isNum($merchant['leadtime_to_ship'          ])
      );
      break;
    case $this->AmazonMWS::MWS_UPDATE_FEED:
      $feed = array(
        'sku'                          => $this->Common->isStr($merchant['seller_sku'                ])
      , 'price'                        => $this->Common->isNum($merchant['price'                     ])
      , 'minimum-seller-allowed-price' => $this->Common->isNum($merchant['minimum_seller_allow_price'])
      , 'maximum-seller-allowed-price' => $this->Common->isNum($merchant['maximum_seller_allow_price'])
      , 'quantity'                     => $this->Common->isNum($merchant['quantity'                  ])
      , 'leadtime-to-ship'             => $this->Common->isNum($merchant['leadtime_to_ship'          ])
      );
      break;
    case $this->AmazonMWS::MWS_CREATE_FEED:
      $feed = array(
        'sku'                          => $this->Common->isStr($merchant['seller_sku'                ])
      , 'Currency'                     => $this->Common->isStr($merchant['currency'                  ])
      , 'ShipOption1'                  => $this->Common->isStr($merchant['shipping_option_1'         ])
      , 'ShippingAmt1'                 => $this->Common->isStr($merchant['shipping_amount_1'         ])
      , 'Type1'                        => $this->Common->isStr($merchant['type_1'                    ])
      , 'IsShippingRestricted1'        => $this->Common->isStr($merchant['is_shipping_restricted_1'  ])
      , 'ShipOption2'                  => $this->Common->isStr($merchant['shipping_option_2'         ])
      , 'ShippingAmt2'                 => $this->Common->isStr($merchant['shipping_amount_2'         ])
      , 'Type2'                        => $this->Common->isStr($merchant['type_2'                    ])
      , 'IsShippingRestricted2'        => $this->Common->isStr($merchant['is_shipping_restricted_2'  ])
      , 'ShipOption3'                  => $this->Common->isStr($merchant['shipping_option_3'         ])
      , 'ShippingAmt3'                 => $this->Common->isStr($merchant['shipping_amount_3'         ])
      , 'Type3'                        => $this->Common->isStr($merchant['type_3'                    ])
      , 'IsShippingRestricted3'        => $this->Common->isStr($merchant['is_shipping_restricted_3'  ])
      , 'ShipOption4'                  => $this->Common->isStr($merchant['shipping_option_4'         ])
      , 'ShippingAmt4'                 => $this->Common->isStr($merchant['shipping_amount_4'         ])
      , 'Type4'                        => $this->Common->isStr($merchant['type_4'                    ])
      , 'IsShippingRestricted4'        => $this->Common->isStr($merchant['is_shipping_restricted_4'  ])
      , 'ShipOption5'                  => $this->Common->isStr($merchant['shipping_option_5'         ])
      , 'ShippingAmt5'                 => $this->Common->isStr($merchant['shipping_amount_5'         ])
      , 'Type5'                        => $this->Common->isStr($merchant['type_5'                    ])
      , 'IsShippingRestricted5'        => $this->Common->isStr($merchant['is_shipping_restricted_5'  ])
      , 'ShipOption6'                  => $this->Common->isStr($merchant['shipping_option_6'         ])
      , 'ShippingAmt6'                 => $this->Common->isStr($merchant['shipping_amount_6'         ])
      , 'Type6'                        => $this->Common->isStr($merchant['type_6'                    ])
      , 'IsShippingRestricted6'        => $this->Common->isStr($merchant['is_shipping_restricted_6'  ])
      , 'UpdateDelete'                 => $this->Common->isStr($merchant['update_delete'             ])
      );
      break;
    }
    return array('feedType' => $feedType, 'feed' => $feed);
  }
  
  private function upsertMerchant($request) 
  {
    $header = array(                           //                New Upd Etc
      'item_name'                     => false // string(255)    o
    , 'product_identifier'            => false // string(255)    o
    , 'product_id_type'               => false // integer(11)    o   
    , 'price'                         => false // integer(11)    o   o
    , 'minimum_seller_allow_price'    => false // integer(11)    o   o
    , 'maximum_seller_allow_price'    => false // integer(11)    o   o
    , 'item_condition'                => false // integer(11)    o
    , 'quantity'                      => false // integer(11)    o   o
    , 'add_delete'                    => true  // string(255)    o
    , 'will_ship_internationally'     => false // string(255)    o
    , 'expedited_shipping'            => false // string(255)    o
    , 'standard_plus'                 => false // string(255)    o
    , 'item_note'                     => false // string(2047)   o
    , 'fullfillment_channel'          => false // string(1023)   o   o
    , 'product_tax_code'              => false // string(255)    o
    , 'leadtime_to_ship'              => false // integer(11)    o   o
    , 'seller_sku'                    => true  // string(255)        o   o
    , 'currency'                      => false // string(255)            o
    , 'shipping_option_1'             => false // string(255)            o
    , 'shipping_option_2'             => false // string(255)            o
    , 'shipping_option_3'             => false // string(255)            o
    , 'shipping_option_4'             => false // string(255)            o
    , 'shipping_option_5'             => false // string(255)            o
    , 'shipping_option_6'             => false // string(255)            o
    , 'shipping_amount_1'             => false // integer(11)            o
    , 'shipping_amount_2'             => false // integer(11)            o
    , 'shipping_amount_3'             => false // integer(11)            o
    , 'shipping_amount_4'             => false // integer(11)            o
    , 'shipping_amount_5'             => false // integer(11)            o
    , 'shipping_amount_6'             => false // integer(11)            o
    , 'type_1'                        => false // string(255)            o
    , 'type_2'                        => false // string(255)            o
    , 'type_3'                        => false // string(255)            o
    , 'type_4'                        => false // string(255)            o
    , 'type_5'                        => false // string(255)            o
    , 'type_6'                        => false // string(255)            o
    , 'is_shipping_restricted_1'      => false // tinyint(1)             o
    , 'is_shipping_restricted_2'      => false // tinyint(1)             o
    , 'is_shipping_restricted_3'      => false // tinyint(1)             o
    , 'is_shipping_restricted_4'      => false // tinyint(1)             o
    , 'is_shipping_restricted_5'      => false // tinyint(1)             o
    , 'is_shipping_restricted_6'      => false // tinyint(1)             o
    , 'update_delete'                 => true  // string(255)            o
    , 'item_description'              => false // string(1023)
    , 'listing_identifier'            => false // string(255)
    , 'open_date_at'                  => false // datetime
    , 'image_url'                     => false // string(2048)
    , 'item_is_marketplace'           => false // string(255)
    , 'zshop_shipping_fee'            => false // integer(11)
    , 'zshop_category1'               => false // string(255)
    , 'zshop_browse_path'             => false // string(255)
    , 'zshop_storefront_feature'      => false // string(255)
    , 'asin1'                         => false // string(255)
    , 'asin2'                         => false // string(255)
    , 'asin3'                         => false // string(255)
    , 'zshop_boldface'                => false // string(255)
    , 'bid_for_featured_placement'    => false // string(255)
    , 'pending_quantity'              => false // integer(11)
    , 'merchant_shipping_group'       => false // string(255)
    , 'point'                         => false // integer(11)
    , 'seller_identifier'             => true  // string(255)
    , 'marketplace'                   => true  // string(255)
    , 'created'                       => true  // datetime
    , 'modified'                      => true  // datetime
    );
    $merchants = TableRegistry::get('Merchants');

    $result = $this->setMerchants($header, $request);
    //debug($result);

    foreach($result as $_result) {
      $entity = $merchants->newEntity($_result);
      $merchant = $merchants->find()
        ->where([
          'seller_identifier'   => $entity->seller_identifier
        , 'marketplace'         => $entity->marketplace
        , 'seller_sku'          => $entity->seller_sku
        ]) 
        ->first();
      if($merchant) {
        unset($_result['created']);
        $entity = $merchants->patchEntity($merchant, $_result);
      }
      if(!$merchants->save($entity)) {
        $this->Common->log_debug($entity->errors(), 'crons');
        return false;
      }
    }
    return true;
  }

  private function setMerchants($header, $request) 
  {
    $datas = array();
    $datetime = date('Y-m-d H:i:s');
    $keys     = array_keys($header);
    $vals     = array_values($header);

    $_response = $this->submitMerchants($request);
    //debug($response);

    foreach($_response as $response) {
      if($response) {
        $merchants   = $response['submitFeed'];
        $_merchants  = array_values($merchants) === $merchants ? $merchants : [$merchants];
        $marketplace = $response['marketplace'];
        $data = array();
        foreach($_merchants as $merchant) {
          if($merchant) {
            $feeds  = $merchant['feeds'];
            $_feeds = array_values($feeds) === $feeds ? $feeds : [$feeds];
            foreach($_feeds as $feed) {
              if($feed) {
                if($vals[ 8]) $data[$keys[ 8]] = $merchant['add-delete']    ?? 'N/A';
                if($vals[16]) $data[$keys[16]] = $feed['sku']               ?? 'N/A';
                if($vals[42]) $data[$keys[42]] = $merchant['update-delete'] ?? 'N/A';
                if($vals[60]) $data[$keys[60]] = $response['seller'];
                if($vals[61]) $data[$keys[61]] = $marketplace;
                if($vals[62]) $data[$keys[62]] = $datetime;
                if($vals[63]) $data[$keys[63]] = $datetime;
                array_push($datas, $data);
              }
            }
          }
        }
      }
    }
    //debug($datas);
    return $datas;
  }

  private function submitMerchants($request)
  {
    $response = array();
    Promise\all($this->_submitMerchants($request))
      ->done(function($result) use (&$response) {
        //debug($result);
        $response = $result;
      }, function ($error) {
        $this->log_error($error, __FILE__, __LINE__, 'crons');
      });
    return $response;
  } 

  private function _submitMerchants($request) 
  {
    $loop = EventLoop\Factory::create();
    $response     = array();
    $feeds_create = array();
    $feeds_adddel = array();
    $feeds_update = array();
    $eol = count($request);
    $max_count = 50;
    //debug($request);
    foreach($request as $_request) {
      $feedSets = $_request['feedSets'];
      $config   = $_request['config'];
      if($_request) {
        $idx = 0;
        foreach($feedSets as $feedSet) {
          $feedType = $feedSet['feedType'];
          $feed     = $feedSet['feed'];
          switch($feedType) {
            case $this->AmazonMWS::MWS_CREATE_FEED:
              array_push($feeds_create, $feed);
              if(count($feeds_create) >= $max_count) {
                array_push($response, $this->retryMerchant($config, $feeds_create, $feedType, $loop));
                $feeds_create = array();
              }
              break;
            case $this->AmazonMWS::MWS_ADDDEL_FEED:
              array_push($feeds_adddel, $feed);
              if(count($feeds_adddel) >= $max_count) {
                array_push($response, $this->retryMerchant($config, $feeds_adddel, $feedType, $loop));
                $feeds_adddel = array();
              }
              break;
            case $this->AmazonMWS::MWS_UPDATE_FEED:
              array_push($feeds_update, $feed);
              if(count($feeds_update) >= $max_count) {
                array_push($response, $this->retryMerchant($config, $feeds_update, $feedType, $loop));
                $feeds_update = array();
              }
              break;
          }
          if($idx === $eol - 1) {
            if(count($feeds_create) !== 0) {
              array_push($response, $this->retryMerchant($config, $feeds_create, $feedType, $loop));
            } 
            if(count($feeds_adddel) !== 0) {
              array_push($response, $this->retryMerchant($config, $feeds_adddel, $feedType, $loop));
            } 
            if(count($feeds_update) !== 0) {
              array_push($response, $this->retryMerchant($config, $feeds_update, $feedType, $loop));
            }
          }
          $idx += 1;
        }
      }
    }
    $loop->run();
    //debug($response);
    return $response;
  }

  private function retryMerchant($config, $feeds, $feedType, $loop) 
  {
    return $this->Common->retry($loop, function() use ($config, $feeds, $feedType, $loop) {
        return $this->submitMerchant($config, $feeds, $feedType);
      })
      ->otherwise(function($updated) {
        if($updated) $this->Common->log_error($updated, __FILE__, __LINE__, 'crons');
      });
  }

  private function submitMerchant($config, $feeds, $feedType)
  {
    $deferred = new Promise\Deferred();
    $this->_submitMerchant(function($error, $result) use ($deferred) {
      if($error) {
        $deferred->reject($error);
      } else { 
        $deferred->resolve($result);
      }
    }, $config, $feeds, $feedType);
    return $deferred->promise();
  }

  private function _submitMerchant($callback, $config, $feeds, $feedType)
  {
    $access_key   = $config['access_key'];
    $secret_key   = $config['secret_key'];
    $seller       = $config['seller'];
    $marketplace  = $config['marketplace'];
    switch($marketplace) {
    case 'JP':
      $market_id = $this->AmazonMWS::MWS_MARKETPLACE_JP;
      $country   = $this->AmazonMWS::MWS_BASEURL_JP;
      break;
    case 'AU':
      $market_id = $this->AmazonMWS::MWS_MARKETPLACE_AU;
      $country   = $this->AmazonMWS::MWS_BASEURL_AU;
      break;
    case 'US':
      $market_id = $this->AmazonMWS::MWS_MARKETPLACE_US;
      $country   = $this->AmazonMWS::MWS_BASEURL_US;
      break;
    default:
      $market_id = $this->AmazonMWS::MWS_MARKETPLACE_JP;
      $country   = $this->AmazonMWS::MWS_BASEURL_JP;
      break;
    }
    try {
      switch($feedType) {
      case $this->AmazonMWS::MWS_CREATE_FEED:
        $response = $this->AmazonMWS->create([
          'Marketplace'     => $market_id
        , 'SellerId'        => $seller
        , 'AWSSecretKeyId'  => $secret_key
        , 'AWSAccessKeyId'  => $access_key
        , 'BaseURL'         => $country
        , 'Data'            => $feeds
        ])
        ? ['update-delete' => 'OK', 'feeds'       => $feeds] 
        : ['update-delete' => 'NG', 'feeds'       => $feeds];
    
        break;
      case $this->AmazonMWS::MWS_ADDDEL_FEED:
        $response = $this->AmazonMWS->adddel([
          'Marketplace'     => $market_id
        , 'SellerId'        => $seller
        , 'AWSSecretKeyId'  => $secret_key
        , 'AWSAccessKeyId'  => $access_key
        , 'BaseURL'         => $country
        , 'Data'            => $feeds
        ]) 
        ? ['add-delete' => 'OK', 'feeds'       => $feeds] 
        : ['add-delete' => 'NG', 'feeds'       => $feeds];
        break;
      case $this->AmazonMWS::MWS_UPDATE_FEED:
        $response = $this->AmazonMWS->update([
          'Marketplace'     => $market_id
        , 'SellerId'        => $seller
        , 'AWSSecretKeyId'  => $secret_key
        , 'AWSAccessKeyId'  => $access_key
        , 'BaseURL'         => $country
        , 'Data'            => $feeds
        ]) 
        ? ['add-delete' => 'OK', 'feeds'       => $feeds] 
        : ['add-delete' => 'NG', 'feeds'       => $feeds];
        break;
      }
    } catch (\Exception $e) {
      return $callback($e->getMessage(), null);
    }

    $callback(null, [
      'submitFeed'  => $response
    , 'marketplace' => $marketplace
    , 'seller'      => $seller
    ]);
  }
}
