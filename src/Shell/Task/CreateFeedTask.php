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
 * CreateFeed shell task.
 */
class CreateFeedTask extends Shell
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
    $result = $this->execCreateFeed();
    debug("peak :" . memory_get_peak_usage(true)  / (1024 * 1024) . " MB");
    debug("last :" . memory_get_usage(true)       / (1024 * 1024) . " MB");
    return $result;
  }

  private function execCreateFeed()
  {
    $tokens = TableRegistry::get('Tokens');
    $datas  = $tokens->find()->contain(['Sellers'])
      ->where(['suspended' => false])->all();
    $request = array();
    foreach($datas as $data) {
      array_push($request, [
        'seller'      => $data->seller->seller
      , 'marketplace' => $data->seller->marketplace
      , 'access_key'  => $data->access_key
      , 'secret_key'  => $data->secret_key
      ]);
    }
    if(!$this->upsertMerchant($request)) {
      return false;
    }
    return true;
  }

  private function upsertMerchant($request)
  {
    $header = array(
      'item_name'                     => true  // string(255)    o
    , 'product_identifier'            => true  // string(255)    o
    , 'product_id_type'               => true  // integer(11)    o   
    , 'price'                         => true  // integer(11)    o   o
    , 'minimum_seller_allow_price'    => true  // integer(11)    o   o
    , 'maximum_seller_allow_price'    => true  // integer(11)    o   o
    , 'item_condition'                => true  // integer(11)    o
    , 'quantity'                      => true  // integer(11)    o   o
    , 'add_delete'                    => true  // string(255)    o
    , 'will_ship_internationally'     => true  // string(255)    o
    , 'expedited_shipping'            => true  // string(255)    o
    , 'standard_plus'                 => true  // string(255)    o
    , 'item_note'                     => true  // string(2047)   o
    , 'fullfillment_channel'          => false // string(1023)   o   o
    , 'product_tax_code'              => false // string(255)    o
    , 'leadtime_to_ship'              => true  // integer(11)    o   o
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
    , 'update_delete'                 => false // string(255)            o
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

    foreach($result as $_result) {
      $entity = $merchants->newEntity($_result);
      $merchant = $merchants->find()
        ->where([
          'seller_identifier'   => $entity->seller_identifier
        , 'marketplace'         => $entity->marketplace
        , 'product_identifier'  => $entity->product_identifier
        , 'product_id_type'     => $entity->product_id_type
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
    $deftime  = date('Y-m-d H:i:s', 0);
    $keys     = array_keys($header);
    $vals     = array_values($header);

    $response = $this->fetchItems($request);

    foreach($response as $_response) {
      $merchants = $_response['getItems'];
      $_merchants  = array_values($merchants) === $merchants ? $merchants : [$merchants];
      $data = array();
      foreach($_merchants as $merchant) {
        if($merchant) {
          if($vals[ 0]) $data[$keys[ 0]] = $merchant['item-name'                 ] ?? 'N/A';
          if($vals[ 1]) $data[$keys[ 1]] = $merchant['product-id'                ] ?? 'N/A';
          if($vals[ 2]) $data[$keys[ 2]] = $merchant['product-id-type'           ] ?? 0;
          if($vals[ 3]) $data[$keys[ 3]] = $merchant['price'                     ] ?? 0;
          if($vals[ 4]) $data[$keys[ 4]] = $merchant['minimum-seller-allow-price'] ?? 0;
          if($vals[ 5]) $data[$keys[ 5]] = $merchant['maximum-seller-allow-price'] ?? 0;
          if($vals[ 6]) $data[$keys[ 6]] = $merchant['item-condition'            ] ?? 0;
          if($vals[ 7]) $data[$keys[ 7]] = $merchant['quantity'                  ] ?? 0;
          if($vals[ 8]) $data[$keys[ 8]] = $merchant['add-delete'                ] ?? '';
          if($vals[ 9]) $data[$keys[ 9]] = $merchant['will-ship-internationally' ] ?? 'N/A';
          if($vals[10]) $data[$keys[10]] = $merchant['expedited-shipping'        ] ?? 'N/A';
          if($vals[11]) $data[$keys[11]] = $merchant['standard-plus'             ] ?? 'N/A';
          if($vals[12]) $data[$keys[12]] = $merchant['item-note'                 ] ?? 'N/A';
          if($vals[13]) $data[$keys[13]] = $merchant['fullfillment-channel'      ] ?? 'N/A';
          if($vals[14]) $data[$keys[14]] = $merchant['product-tax-code'          ] ?? 'N/A';
          if($vals[15]) $data[$keys[15]] = $merchant['leadtime-to-ship'          ] ?? 0;
          if($vals[16]) $data[$keys[16]] = $merchant['seller-sku'                ] ?? 'N/A';
          if($vals[17]) $data[$keys[17]] = $merchant['currency'                  ] ?? 'N/A';
          if($vals[18]) $data[$keys[18]] = $merchant['shipping-option-1'         ] ?? 'N/A';
          if($vals[19]) $data[$keys[19]] = $merchant['shipping-option-2'         ] ?? 'N/A';
          if($vals[20]) $data[$keys[20]] = $merchant['shipping-option-3'         ] ?? 'N/A';
          if($vals[21]) $data[$keys[21]] = $merchant['shipping-option-4'         ] ?? 'N/A';
          if($vals[22]) $data[$keys[22]] = $merchant['shipping-option-5'         ] ?? 'N/A';
          if($vals[23]) $data[$keys[23]] = $merchant['shipping-option-6'         ] ?? 'N/A';
          if($vals[24]) $data[$keys[24]] = $merchant['shipping-amount-1'         ] ?? 0;
          if($vals[25]) $data[$keys[25]] = $merchant['shipping-amount-2'         ] ?? 0;
          if($vals[26]) $data[$keys[26]] = $merchant['shipping-amount-3'         ] ?? 0;
          if($vals[27]) $data[$keys[27]] = $merchant['shipping-amount-4'         ] ?? 0;
          if($vals[28]) $data[$keys[28]] = $merchant['shipping-amount-5'         ] ?? 0;
          if($vals[29]) $data[$keys[29]] = $merchant['shipping-amount-6'         ] ?? 0;
          if($vals[30]) $data[$keys[30]] = $merchant['type-1'                    ] ?? 'N/A';
          if($vals[31]) $data[$keys[31]] = $merchant['type-2'                    ] ?? 'N/A';
          if($vals[32]) $data[$keys[32]] = $merchant['type-3'                    ] ?? 'N/A';
          if($vals[33]) $data[$keys[33]] = $merchant['type-4'                    ] ?? 'N/A';
          if($vals[34]) $data[$keys[34]] = $merchant['type-5'                    ] ?? 'N/A';
          if($vals[35]) $data[$keys[35]] = $merchant['type-6'                    ] ?? 'N/A';
          if($vals[36]) $data[$keys[36]] = $merchant['is-shipping-restricted-1'  ] ?? 0;
          if($vals[37]) $data[$keys[37]] = $merchant['is-shipping-restricted-2'  ] ?? 0;
          if($vals[38]) $data[$keys[38]] = $merchant['is-shipping-restricted-3'  ] ?? 0;
          if($vals[39]) $data[$keys[39]] = $merchant['is-shipping-restricted-4'  ] ?? 0;
          if($vals[40]) $data[$keys[40]] = $merchant['is-shipping-restricted-5'  ] ?? 0;
          if($vals[41]) $data[$keys[41]] = $merchant['is-shipping-restricted-6'  ] ?? 0;
          if($vals[42]) $data[$keys[42]] = $merchant['update-delete'             ] ?? '';
          if($vals[43]) $data[$keys[43]] = $merchant['item-description'          ] ?? 'N/A';
          if($vals[44]) $data[$keys[44]] = $merchant['listing-id'                ] ?? 'N/A';
          if($vals[45]) $data[$keys[45]] = isset($merchant['open-date'])
            ? $this->getTimeStamp($merchant['open-date'], $_response['marketplace'])
            : $deftime;
          if($vals[46]) $data[$keys[46]] = $merchant['image-url'                 ] ?? 'N/A';
          if($vals[47]) $data[$keys[47]] = $merchant['item-is-marketplace'       ] ?? 'N/A';
          if($vals[48]) $data[$keys[48]] = $merchant['zshop-shipping-fee'        ] ?? 0;
          if($vals[49]) $data[$keys[49]] = $merchant['zshop-category1'           ] ?? 'N/A';
          if($vals[50]) $data[$keys[50]] = $merchant['zshop-browse-path'         ] ?? 'N/A';
          if($vals[51]) $data[$keys[51]] = $merchant['zshop-storefront-feature'  ] ?? 'N/A';
          if($vals[52]) $data[$keys[52]] = $merchant['asin1'                     ] ?? 'N/A';
          if($vals[53]) $data[$keys[53]] = $merchant['asin2'                     ] ?? 'N/A';
          if($vals[54]) $data[$keys[54]] = $merchant['asin3'                     ] ?? 'N/A';
          if($vals[55]) $data[$keys[55]] = $merchant['zshop-boldface'            ] ?? 'N/A';
          if($vals[56]) $data[$keys[56]] = $merchant['bid-for-featured-placement'] ?? 'N/A';
          if($vals[57]) $data[$keys[57]] = $merchant['pending-quantity'          ] ?? 0;
          if($vals[58]) $data[$keys[58]] = $merchant['merchant-shipping-group'   ] ?? 'N/A';
          if($vals[59]) $data[$keys[59]] = $merchant['point'                     ] ?? 0;
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

  private function fetchItems($request)
  {
    $response = array();
    Promise\all($this->promisedCreateFeeds($request))
      ->then(function($feeds){
        return Promise\all($this->promisedSetInternationals($feeds));
      })
      ->then(function($feeds){
        return Promise\all($this->promisedSetSalesPrices($feeds));
      })
      ->then(function($feeds){
        return Promise\all($this->promisedPatchFeeds($feeds));
      })
      ->done(function($result) use (&$response) {
        //debug($result);
        $response = $result;
      }, function($error) {
        $this->Common->log_error($error, __FILE__, __LINE__, 'crons');
      });
    return $response;
  }

  private function promisedCreateFeeds($request)
  {
    $loop = EventLoop\Factory::create();
    $response = array();
    foreach($request as $_request) {
      array_push($response, $this->retryCreateFeed($_request, $loop));
    }
    $loop->run();
    return $response;
  }

  private function promisedSetInternationals($request)
  {
    $loop = EventLoop\Factory::create();
    $response = array();
    foreach($request as $_request) {
      array_push($response, $this->retrySetInternational($_request, $loop));
    }
    $loop->run();
    return $response;
  }

  private function promisedSetSalesPrices($request)
  {
    $loop = EventLoop\Factory::create();
    $response = array();
    foreach($request as $_request) {
      array_push($response, $this->retrySetSalesPrice($_request, $loop));
    }
    $loop->run();
    return $response;
  }

  private function promisedPatchFeeds($request)
  {
    $loop = EventLoop\Factory::create();
    $response = array();
    foreach($request as $_request) {
      array_push($response, $this->retryPatchFeed($_request, $loop));
    }
    $loop->run();
    return $response;
  }

  private function retryCreateFeed($request, $loop)
  { 
    return $this->Common->retry($loop, function() use ($request, $loop) {
        return $this->promisedCreateFeed($request);
      })
      ->otherwise(function($updated) {
        if($updated) $this->Common->log_error($updated, __FILE__, __LINE__, 'crons');
      });
  }

  private function retrySetInternational($request, $loop)
  {
    return $this->Common->retry($loop, function() use ($request, $loop) {
        return $this->promisedSetInternational($request);
      })
      ->otherwise(function($updated) {
        if($updated) $this->Common->log_error($updated, __FILE__, __LINE__, 'crons');
      });
  }

  private function retrySetSalesPrice($request, $loop) 
  {
    return $this->Common->retry($loop, function() use ($request, $loop) {
        return $this->promisedSetSalesPrice($request);
      })
      ->otherwise(function($updated) {
        if($updated) $this->Common->log_error($updated, __FILE__, __LINE__, 'crons');
      });
  }

  private function retryPatchFeed($request,$loop)
  {
    return $this->Common->retry($loop, function() use ($request, $loop) {
        return $this->promisedPatchFeed($request);
      })
      ->otherwise(function($updated) {
        if($updated) $this->Common->log_error($updated, __FILE__, __LINE__, 'crons');
      });
  }

  private function promisedCreateFeed($request)
  {
    $deferred = new Promise\Deferred();
    $this->createFeed(function($error, $result) use ($deferred) {
      if($error) {
        $deferred->reject($error);
      } else {
        $deferred->resolve($result);
      }
    }, $request);
    return $deferred->promise();
  }
 
  private function promisedSetInternational($request)
  {
    $deferred = new Promise\Deferred();
    $this->setInternational(function($error, $result) use ($deferred) {
      if($error) {
        $deferred->reject($error);
      } else {
        $deferred->resolve($result);
      }
    }, $request);
    return $deferred->promise();
  }

  private function promisedSetSalesPrice($request)
  {
    $deferred = new Promise\Deferred();
    $this->setSalesPrice(function($error, $result) use ($deferred) {
      if($error) {
        $deferred->reject($error);
      } else { 
        $deferred->resolve($result);
      }
    }, $request);
    return $deferred->promise();
  }

  private function promisedPatchFeed($request)
  {
    $deferred = new Promise\Deferred();
    $this->patchFeed(function($error, $result) use ($deferred) {
      if($error) {
        $deferred->reject($error);
      } else { 
        $deferred->resolve($result);
      }
    }, $request);
    return $deferred->promise();
  }

  private function createFeed($callback, $request)
  {
    $items = TableRegistry::get('Items');
    $items = $items->find()->where(['marketplace' => 'JP'])->all();
    $datas = array();
    foreach($items as $item) {
      $data['item-name'                 ] = $item['title'];
      $data['product-id'                ] = $item['asin'];
      $data['product-id-type'           ] = 1;
      $data['price'                     ] = $item['lowest_price'];
      $data['minimum-seller-allow-price'] = $item['lowest_price'];
      $data['maximum-seller-allow-price'] = $item['lowest_price'];
      $data['currency'                  ] = $item['lowest_price_currency'];
      $data['item-condition'            ] = $this->Common->getCondition($item['condition_status']);
      $data['quantity'                  ] = $item['total_new'];
      $data['add-delete'                ] = $this->Common->getAddDel($item['total_new']);
      $data['will-ship-internationally' ] = 'n';
      $data['expedited-shipping'        ] = 'International';
      $data['standard-plus'             ] = 'N';
      $data['item-note'                 ] = 'Welcome to our shop. BRAND NEW, NO FAKE items. Ships from Japan. Expeditiously and Very Carefully packed. Thank you!';
      $data['seller-sku'                ] = $this->Common->getSellerSKU($item['asin']
        , $request['marketplace']);
      $data['pending-quantity'          ] = 0;
      $data['ean'                       ] = $item['ean'];
      $data['height'                    ] = $item['package_height'];
      $data['length'                    ] = $item['package_length'];
      $data['weight'                    ] = $item['package_weight'];
      $data['width'                     ] = $item['package_width'];
      array_push($datas, $data);
    }
    $callback(null, [
      'getItems'    => $datas
    , 'marketplace' => $request['marketplace']
    , 'seller'      => $request['seller']
    ]);
  }

  private function setInternational($callback, $request)
  {
    $items = TableRegistry::get('Items');
    $items_us = $items->find()
      ->where(['marketplace' => 'US'])
      ->all();
    $items_own = $items->find()
      ->where(['marketplace' => $request['marketplace']])
      ->all();
    $datas = array();
    foreach($request['getItems'] as $getItem) {
      $data = array_merge(array(), $getItem);
      foreach($items_us as $item) {
        if($item->asin === $data['product-id'] && $item->ean === $data['ean']) {
          $data['item-name'                 ] = $item['title'];
          break;
        }
      }
      foreach($items_own as $item) {
        if($item->asin === $data['product-id']) {
          $data['item-name'                 ] = $item['title'];
          break;
        }
      }
      array_push($datas, $data);
    }
    $callback(null, [
      'getItems'    => $datas
    , 'marketplace' => $request['marketplace']
    , 'seller'      => $request['seller']
    ]);
  }

  private function setSalesPrice($callback, $request) 
  {
    $leadtime = 5;
    $area = $this->Common->getArea($request['marketplace']);
    $ships = TableRegistry::get('Ships');
    $ship = $ships->find()->first();
    $deliverys = TableRegistry::get('Deliverys');
    $datas = array();
    foreach($request['getItems'] as $getItem) {
      $data = array_merge(array(), $getItem);
      $delivery = $deliverys->find()->where([
        'length >='       => $data['length']
      , 'total_length >=' => $data['height'] + $data['length'] + $data['width']
      , 'weight >='       => $data['weight']
      , 'duedate <='      => $leadtime
      , 'area'            => $area
      ])->first();
      $delivery_price = $delivery->price;
      $data['price'                     ] = $this->Common->getSalesPrice(
        $data['price']
      , $data['currency']
      , $request['marketplace']
      , $delivery_price
      , $ship
      );
      $data['minimum-seller-allow-price'] = $this->Common->getPurchasePrice(
        $data['minimum-seller-allow-price']
      , $data['currency']
      , $request['marketplace']
      , $delivery_price
      , $ship
      );
      $data['maximum-seller-allow-price'] = $this->Common->getMaxSalesPrice(
        $data['maximum-seller-allow-price']
      , $data['currency']
      , $request['marketplace']
      , $delivery_price
      , $ship
      );
      $data['quantity'                  ] = $this->Common->getQuantity($data['quantity'], $ship);
      $data['leadtime-to-ship'          ] = $leadtime;
      array_push($datas, $data);
    }
    $callback(null, [
      'getItems'    => $datas
    , 'marketplace' => $request['marketplace']
    , 'seller'      => $request['seller']
    ]);
  }

  private function patchFeed($callback, $request)
  {
    $items = TableRegistry::get('Items');
    $_items = $items->find()
      ->where(['marketplace' => $request['marketplace']])->all();
    $datas = array();
    foreach($request['getItems'] as $getItem) {
      $data = array_merge(array(), $getItem);
      foreach($_items as $item) {
        if($item->asin === $data['product-id']) {
          array_push($datas, $data);
          break;
        }
      }
    }
    $callback(null, [
      'getItems'    => $datas
    , 'marketplace' => $request['marketplace']
    , 'seller'      => $request['seller']
    ]);
  }
}
