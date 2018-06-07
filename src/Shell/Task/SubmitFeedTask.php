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
          'marketplace' => $_config['marketplace']
        , 'seller'      => $_config['seller']
        ])->all();
      array_push($request, [
        'merchant' => $this->setMerchants($merchant)
      , 'config'   => $_config
      ]);
    }
    if(!$this->upsertMerchant($request)) {
      return false;
    }
    return true;
  }

  private function setMerchants($merchant) 
  {
    $data = array();
    foreach($merchant->data as $_merchant) {
      if($_merchant->add_delete === 'a' || $_merchant->add_delete === 'd') {
        array_push($data
          , $this->setFeedType('_POST_FLAT_FILE_INVLOADER_DATA_', $_merchant));
      } else
      if($_merchant->add_delete === 'r') {
        array_push($data
          , $this->setFeedType('_POST_FLAT_FILE_PRICEANDQUANTITYONLY_UPDATE_DATA_'
            , $_merchant));
      } else
      if($_merchant->update_delete === 'New' || $_merchant->update_delete === 'Delete'
        || $_merchant->update_delete === 'Update') {
        array_push($data
          , $this->setFeedType('_POST_FLAT_FILE_LISTINGS_DATA_', $_merchant));
      }
    }
    return $data;
  }

  private function setFeedType($type, $merchant)
  {
    $feed = array();
    switch($type) {
    case '_POST_FLAT_FILE_INVLOADER_DATA_':
      $feed = array(
        'sku'                           => $merchant['seller_sku'                ]
      , 'product-id'                    => $merchant['product_identifier'        ]
      , 'product-id-type'               => $merchant['product_id_type'           ]
      , 'price'                         => $merchant['price'                     ]
      , 'minimum-seller-allowed-price'  => $merchant['minimum_seller_allow_price']
      , 'maximum-seller-allowed-price'  => $merchant['maximum_seller_allow_price']
      , 'item-condition'                => $merchant['item_condition'            ]
      , 'quantity'                      => $merchant['quantity'                  ]
      , 'add-delete'                    => $merchant['add_delete'                ]
      , 'will-ship-internationally'     => $merchant['will_ship_internationally' ]
      , 'expedited-shipping'            => $merchant['expedited_shipping'        ]
      , 'standard-plus'                 => $merchant['standard_plus'             ]
      , 'item-note'                     => $merchant['item_note'                 ]
      , 'fulfillment-center-id'         => $merchant['fullfillment_channel'      ]
      , 'product-tax-code'              => $merchant['product_tax_code'          ]
      , 'leadtime-to-ship'              => $merchant['leadtime_to_ship'          ]
      );
      break;
    case '_POST_FLAT_FILE_PRICEANDQUANTITYONLY_UPDATE_DATA_':
      $feed = array(
        'sku'                           => $merchant['seller_sku'                         ]
      , 'price'                         => $merchant['price'                     ]
      , 'minimum-seller-allowed-price'  => $merchant['minimum_seller_allow_price']
      , 'maximum-seller-allowed-price'  => $merchant['maximum_seller_allow_price']
      , 'quantity'                      => $merchant['quantity'                  ]
      , 'leadtime-to-ship'              => $merchant['leadtime_to_ship'          ]
      );
      break;
    case '_POST_FLAT_FILE_LISTINGS_DATA_':
      $feed = array(
        'sku'                           => $merchant['seller_sku'                ]
      , 'Currency'                      => $merchant['currency'                  ]
      , 'ShipOption1'                   => $merchant['shipping_option_1'         ]
      , 'ShippingAmt1'                  => $merchant['shipping_amount_1'         ]
      , 'Type1'                         => $merchant['type_1'                    ]
      , 'IsShippingRestricted1'         => $merchant['is_shipping_restricted_1'  ]
      , 'ShipOption2'                   => $merchant['shipping_option_2'         ]
      , 'ShippingAmt2'                  => $merchant['shipping_amount_2'         ]
      , 'Type2'                         => $merchant['type_2'                    ]
      , 'IsShippingRestricted2'         => $merchant['is_shipping_restricted_2'  ]
      , 'ShipOption3'                   => $merchant['shipping_option_3'         ]
      , 'ShippingAmt3'                  => $merchant['shipping_amount_3'         ]
      , 'Type3'                         => $merchant['type_3'                    ]
      , 'IsShippingRestricted3'         => $merchant['is_shipping_restricted_3'  ]
      , 'ShipOption4'                   => $merchant['shipping_option_4'         ]
      , 'ShippingAmt4'                  => $merchant['shipping_amount_4'         ]
      , 'Type4'                         => $merchant['type_4'                    ]
      , 'IsShippingRestricted4'         => $merchant['is_shipping_restricted_4'  ]
      , 'ShipOption5'                   => $merchant['shipping_option_5'         ]
      , 'ShippingAmt5'                  => $merchant['shipping_amount_5'         ]
      , 'Type5'                         => $merchant['type_5'                    ]
      , 'IsShippingRestricted5'         => $merchant['is_shipping_restricted_5'  ]
      , 'ShipOption6'                   => $merchant['shipping_option_6'         ]
      , 'ShippingAmt6'                  => $merchant['shipping_amount_6'         ]
      , 'Type6'                         => $merchant['type_6'                    ]
      , 'IsShippingRestricted6'         => $merchant['is_shipping_restricted_6'  ]
      , 'UpdateDelete'                  => $merchant['update_delete'             ]
      );
      break;
    }
    return array('feedType' => $type, 'feed' => $_merchant);
  }
  
  private function upsertMerchant($request) 
  {
    $merchants = TableRegistry::get('Merchants');

    $result = $this->requestMerchants($request);

    foreach($result as $_result) {
      $entity = $merchants->newEntity($_result);
      $merchant = $merchants->find()
        ->where([
          'marketplace'         => $entity->marketplace
        , 'seller'              => $entity->seller_identifier
        , 'listing_identifier'  => $entity->listing_identifier
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

  private function requestMerchants($request)
  {
    $response = array();
    Promise\all($this->_requestMerchants($request))
      ->done(function($result) use (&$response) {
        $response = $result;
      }, function ($error) {
        $this->log_error($error);
      });
    return $response;
  } 

  private function _requestMerchants($request) 
  {
    $response = array();
    foreach($request as $_request) {
      array_push($response, $this->requestMerchant($_request));
    }
    return $response;
  }

  private function requestMerchant($request)
  {
    $deferred = new Promise\Deferred();
    $this->_requestMerchant(function($error, $response) use ($deferred) {
      if($error) {
        $this->log_error($error);
        $deferred->reject($error);
      }
      $deferred->resolve($response);
    }, $request);
    return $deferred->promise();
  }

  private function _requestMerchant($callback, $request)
  {
    $response = array();
    $access_key = $request['config']['access_key'];
    $secret_key = $request['config']['secret_key'];
    $seller     = $request['config']['seller'];
    $data       = $request['merchant']['feed'];
    switch($request['config']['marketplace']) {
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
      switch($request['merchant']['feedType']) {
      case '_POST_FLAT_FILE_LISTINGS_DATA_':
        $resopnse = $this->AmazonMWS->create([
          'Marketplace'     => $market_id
        , 'SellerId'        => $seller
        , 'AWSSecretKeyId'  => $secret_key
        , 'AWSAccessKeyId'  => $access_key
        , 'BaseURL'         => $country
        , 'Data'            => $data
        ]);
        break;
      case '_POST_FLAT_FILE_INVLOADER_DATA_':
        $resopnse = $this->AmazonMWS->adddel([
          'Marketplace'     => $market_id
        , 'SellerId'        => $seller
        , 'AWSSecretKeyId'  => $secret_key
        , 'AWSAccessKeyId'  => $access_key
        , 'BaseURL'         => $country
        , 'Data'            => $data
        ]);
        break;
      case '_POST_FLAT_FILE_PRICEANDQUANTITYONLY_UPDATE_DATA_':
        $response = $this->AmazonMWS->update([
          'Marketplace'     => $market_id
        , 'SellerId'        => $seller
        , 'AWSSecretKeyId'  => $secret_key
        , 'AWSAccessKeyId'  => $access_key
        , 'BaseURL'         => $country
        , 'Data'            => $data
        ]);
        break;
      }
    } catch (\Exception $e) {
      $callback($e->getMessage(), []);
    }

    $callback(null, [
      'submitFeed'  => $response
    , 'marketplace' => $request['marketplace']
    , 'seller'      => $request['seller']
    ]);
  }

  private function log_debug($message) 
  {
    $displayName = '[' . get_class($this) . '] ';
    Log::debug($displayName . print_r($message, true), ['scope' => ['crons']]);
  }

  private function log_error($message) 
  {
    $displayName = '[' . get_class($this) . '] ';
    Log::error($displayName . print_r($message, true), ['scope' => ['crons']]);
  }
}
