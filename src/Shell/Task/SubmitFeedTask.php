<?php
namespace App\Shell\Task;

use Cake\Console\Shell;
use Cake\Log\Log;
use Cake\ORM\TableRegistry;
use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use App\Controller\Component\AmazonMWSComponent;
use React\Promise;

/**
 * SubmitFeed shell task.
 */
class SubmitFeedTask extends Shell
{
  public function initialize()
  {
    $this->AmazonMWS = new AmazonMWSComponent(new ComponentRegistry()); 
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
        'sku'                          => $this->isStr($merchant['seller_sku'                ])
      , 'product-id'                   => $this->isStr($merchant['product_identifier'        ])
      , 'product-id-type'              => $this->isStr($merchant['product_id_type'           ])
      , 'price'                        => $this->isNum($merchant['price'                     ])
      , 'minimum-seller-allowed-price' => $this->isNum($merchant['minimum_seller_allow_price'])
      , 'maximum-seller-allowed-price' => $this->isNum($merchant['maximum_seller_allow_price'])
      , 'item-condition'               => $this->isStr($merchant['item_condition'            ])
      , 'quantity'                     => $this->isNum($merchant['quantity'                  ])
      , 'add-delete'                   => $this->isStr($merchant['add_delete'                ])
      , 'will-ship-internationally'    => $this->isStr($merchant['will_ship_internationally' ])
      , 'expedited-shipping'           => $this->isStr($merchant['expedited_shipping'        ])
      , 'standard-plus'                => $this->isStr($merchant['standard_plus'             ])
      , 'item-note'                    => $this->isStr($merchant['item_note'                 ])
      , 'fulfillment-center-id'        => $this->isStr($merchant['fullfillment_channel'      ])
      , 'product-tax-code'             => $this->isStr($merchant['product_tax_code'          ])
      , 'leadtime-to-ship'             => $this->isNum($merchant['leadtime_to_ship'          ])
      );
      break;
    case $this->AmazonMWS::MWS_UPDATE_FEED:
      $feed = array(
        'sku'                          => $this->isStr($merchant['seller_sku'                ])
      , 'price'                        => $this->isNum($merchant['price'                     ])
      , 'minimum-seller-allowed-price' => $this->isNum($merchant['minimum_seller_allow_price'])
      , 'maximum-seller-allowed-price' => $this->isNum($merchant['maximum_seller_allow_price'])
      , 'quantity'                     => $this->isNum($merchant['quantity'                  ])
      , 'leadtime-to-ship'             => $this->isNum($merchant['leadtime_to_ship'          ])
      );
      break;
    case $this->AmazonMWS::MWS_CREATE_FEED:
      $feed = array(
        'sku'                          => $this->isStr($merchant['seller_sku'                ])
      , 'Currency'                     => $this->isStr($merchant['currency'                  ])
      , 'ShipOption1'                  => $this->isStr($merchant['shipping_option_1'         ])
      , 'ShippingAmt1'                 => $this->isStr($merchant['shipping_amount_1'         ])
      , 'Type1'                        => $this->isStr($merchant['type_1'                    ])
      , 'IsShippingRestricted1'        => $this->isStr($merchant['is_shipping_restricted_1'  ])
      , 'ShipOption2'                  => $this->isStr($merchant['shipping_option_2'         ])
      , 'ShippingAmt2'                 => $this->isStr($merchant['shipping_amount_2'         ])
      , 'Type2'                        => $this->isStr($merchant['type_2'                    ])
      , 'IsShippingRestricted2'        => $this->isStr($merchant['is_shipping_restricted_2'  ])
      , 'ShipOption3'                  => $this->isStr($merchant['shipping_option_3'         ])
      , 'ShippingAmt3'                 => $this->isStr($merchant['shipping_amount_3'         ])
      , 'Type3'                        => $this->isStr($merchant['type_3'                    ])
      , 'IsShippingRestricted3'        => $this->isStr($merchant['is_shipping_restricted_3'  ])
      , 'ShipOption4'                  => $this->isStr($merchant['shipping_option_4'         ])
      , 'ShippingAmt4'                 => $this->isStr($merchant['shipping_amount_4'         ])
      , 'Type4'                        => $this->isStr($merchant['type_4'                    ])
      , 'IsShippingRestricted4'        => $this->isStr($merchant['is_shipping_restricted_4'  ])
      , 'ShipOption5'                  => $this->isStr($merchant['shipping_option_5'         ])
      , 'ShippingAmt5'                 => $this->isStr($merchant['shipping_amount_5'         ])
      , 'Type5'                        => $this->isStr($merchant['type_5'                    ])
      , 'IsShippingRestricted5'        => $this->isStr($merchant['is_shipping_restricted_5'  ])
      , 'ShipOption6'                  => $this->isStr($merchant['shipping_option_6'         ])
      , 'ShippingAmt6'                 => $this->isStr($merchant['shipping_amount_6'         ])
      , 'Type6'                        => $this->isStr($merchant['type_6'                    ])
      , 'IsShippingRestricted6'        => $this->isStr($merchant['is_shipping_restricted_6'  ])
      , 'UpdateDelete'                 => $this->isStr($merchant['update_delete'             ])
      );
      break;
    }
    return array('feedType' => $feedType, 'feed' => $feed);
  }
  
  private function isStr($str) 
  {
    return $str === 'N/A' || $str === null ? null : $str;
  }
  
  private function isNum($num)
  {
    return $num === 0 || $num === null ? 0 : $num;
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
        $this->log_error($entity->errors());
        return false;
      }
    }
    return true;
  }

  private function setMerchants($header, $request) 
  {
    //debug($request);
    $datas = array();
    $datetime = date('Y-m-d H:i:s');
    $deftime  = date('Y-m-d H:i:s', 0);
    $keys     = array_keys($header);
    $vals     = array_values($header);

    $response = $this->submitMerchants($request);
    //debug($response);

    foreach($response as $_response) {
      $merchants = $_response['submitFeed'];
      $_merchants  = array_values($merchants) === $merchants ? $merchants : [$merchants];
      $data = array();
      foreach($_merchants as $merchant) {
        if($merchant) {
          if($vals[ 8]) $data[$keys[ 8]] = $merchant['add-delete'                ] ?? 'N/A';
          if($vals[16]) $data[$keys[16]] = $_response['seller_sku'               ] ?? 'N/A';
          if($vals[42]) $data[$keys[42]] = $merchant['update-delete'             ] ?? 'N/A';
          if($vals[60]) $data[$keys[60]] = $_response['seller'];
          if($vals[61]) $data[$keys[61]] = $_response['marketplace'];
          if($vals[62]) $data[$keys[62]] = $datetime;
          if($vals[63]) $data[$keys[63]] = $datetime;
          array_push($datas, $data);
        }
      }
    }
    return $datas;
  }

  private function submitMerchants($request)
  {
    $response = array();
    Promise\all($this->_submitMerchants($request))
      ->done(function($result) use (&$response) {
        $response = $result;
        //debug($result);
      }, function ($error) {
        $this->log_error($error);
      });
    return $response;
  } 

  private function _submitMerchants($request) 
  {
    $response = array();
    foreach($request as $_request) {
      foreach($_request['feedSets'] as $feedSet) {
        //debug($feedSet);
        array_push($response, $this->submitMerchant($_request['config'], $feedSet));
      }
    }
    return $response;
  }

  private function submitMerchant($config, $feedSet)
  {
    $deferred = new Promise\Deferred();
    $this->_submitMerchant(function($error, $response) use ($deferred) {
      if($error) {
        $this->log_error($error);
        $deferred->reject($error);
      }
      $deferred->resolve($response);
    }, $config, $feedSet);
    return $deferred->promise();
  }

  private function _submitMerchant($callback, $config, $feedSet)
  {
    $response = array();
    $access_key   = $config['access_key'];
    $secret_key   = $config['secret_key'];
    $seller       = $config['seller'];
    $marketplace  = $config['marketplace'];
    $data         = $feedSet['feed'];
    $seller_sku   = $feedSet['feed']['sku'];
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
    sleep(5);
    try {
      switch($feedSet['feedType']) {
      case $this->AmazonMWS::MWS_CREATE_FEED:
        $response = $this->AmazonMWS->create([
          'Marketplace'     => $market_id
        , 'SellerId'        => $seller
        , 'AWSSecretKeyId'  => $secret_key
        , 'AWSAccessKeyId'  => $access_key
        , 'BaseURL'         => $country
        , 'Data'            => array($data)
        ]) ? ['update-delete' => 'Success'] : ['update-delete' => 'Failure'];
        break;
      case $this->AmazonMWS::MWS_ADDDEL_FEED:
        $response = $this->AmazonMWS->adddel([
          'Marketplace'     => $market_id
        , 'SellerId'        => $seller
        , 'AWSSecretKeyId'  => $secret_key
        , 'AWSAccessKeyId'  => $access_key
        , 'BaseURL'         => $country
        , 'Data'            => array($data)
        ]) ? ['add-delete' => 'Success'] : ['add-delete' => 'Failure'];
        break;
      case $this->AmazonMWS::MWS_UPDATE_FEED:
        $response = $this->AmazonMWS->update([
          'Marketplace'     => $market_id
        , 'SellerId'        => $seller
        , 'AWSSecretKeyId'  => $secret_key
        , 'AWSAccessKeyId'  => $access_key
        , 'BaseURL'         => $country
        , 'Data'            => array($data)
        ]) ? ['add-delete' => 'Success'] : ['add-delete' => 'Failure'];
        break;
      }
    } catch (\Exception $e) {
      $callback($e->getMessage(), []);
    }
    //debug($response);
    $callback(null, [
      'submitFeed'          => $response
    , 'marketplace'         => $marketplace
    , 'seller'              => $seller
    , 'seller_sku'          => $seller_sku
    ]);
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
