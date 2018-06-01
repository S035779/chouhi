<?php
namespace App\Shell\Task;

use Cake\Console\Shell;
use Cake\ORM\TableRegistry;
use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use App\Controller\Component\AmazonMWSComponent;
use React\Promise;

/**
 * GetReport shell task.
 */
class GetReportTask extends Shell
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
    $this->execGetReport();
  }

  private function execGetReport()
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

  private function insertMerchant($request) 
  {
    $header = array(                          //                n   p   s
      'item_name'                     => true // string(255)    o
    , 'product_identifier'            => true // string(255)    o
    , 'product_id_type'               => true // integer(11)    o   
    , 'price'                         => true // integer(11)    o   o
    , 'minimum_seller_allow_price'    => true // integer(11)    o   o
    , 'maximum_seller_allow_price'    => true // integer(11)    o   o
    , 'item_condition'                => true // integer(11)    o
    , 'quantity'                      => true // integer(11)    o   o
    , 'add_delete'                    => true // string(255)    o
    , 'will_ship_internationally'     => true // string(255)    o
    , 'expedited_shipping'            => true // string(255)    o
    , 'standard_plus'                 => true // string(255)    o
    , 'item_note'                     => true // string(2047)   o
    , 'fullfillment_channel'          => true // string(1024)   o   o
    , 'product_tax_code'              => true // string(255)    o
    , 'leadtime_to_ship'              => true // integer(11)    o   o
    , 'seller_sku'                    => true // string(255)        o   o
    , 'currency'                      => true // string(255)            o
    , 'shipping_option_1'             => true // string(255)            o
    , 'shipping_option_2'             => true // string(255)            o
    , 'shipping_option_3'             => true // string(255)            o
    , 'shipping_option_4'             => true // string(255)            o
    , 'shipping_option_5'             => true // string(255)            o
    , 'shipping_option_6'             => true // string(255)            o
    , 'shipping_amount_1'             => true // integer(11)            o
    , 'shipping_amount_2'             => true // integer(11)            o
    , 'shipping_amount_3'             => true // integer(11)            o
    , 'shipping_amount_4'             => true // integer(11)            o
    , 'shipping_amount_5'             => true // integer(11)            o
    , 'shipping_amount_6'             => true // integer(11)            o
    , 'type_1'                        => true // string(255)            o
    , 'type_2'                        => true // string(255)            o
    , 'type_3'                        => true // string(255)            o
    , 'type_4'                        => true // string(255)            o
    , 'type_5'                        => true // string(255)            o
    , 'type_6'                        => true // string(255)            o
    , 'is_shipping_restricted_1'      => true // tinyint(1)             o
    , 'is_shipping_restricted_2'      => true // tinyint(1)             o
    , 'is_shipping_restricted_3'      => true // tinyint(1)             o
    , 'is_shipping_restricted_4'      => true // tinyint(1)             o
    , 'is_shipping_restricted_5'      => true // tinyint(1)             o
    , 'is_shipping_restricted_6'      => true // tinyint(1)             o
    , 'update_delete'                 => true // string(255)            o
    , 'item_description'              => true // string(1023)
    , 'listing_identifier'            => true // string(255)
    , 'open_date'                     => true // datetime
    , 'image_url'                     => true // string(2048)
    , 'item_is_marketplace'           => true // string(255)
    , 'zshop_shipping_fee'            => true // integer(11)
    , 'zshop_category1'               => true // string(255)
    , 'zshop_browse_path'             => true // string(255)
    , 'zshop_storefront_feature'      => true // string(255)
    , 'asin1'                         => true // string(255)
    , 'asin2'                         => true // string(255)
    , 'asin3'                         => true // string(255)
    , 'zshop_boldface'                => true // string(255)
    , 'bid_for_featured_placement'    => true // string(255)
    , 'pending_quantity'              => true // integer(11)
    , 'merchant_shipping_group'       => true // string(255)
    , 'point'                         => true // integer(11)
    , 'seller_identifier'             => true // string(255)
    , 'marketplace'                   => true // string(255)
    , 'created'                       => true // datetime
    , 'modified'                      => true // datetime
    );
    $merchants = TableRegistry::get('Merchants');

    $results = $this->setMerchants($header, $request);

    debug($request);
    $query = $merchants->query();
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

  private function upsertMerchant($request)
  {
    $header = array(                          //                n   p   s
      'item_name'                     => true // string(255)    o
    , 'product_identifier'            => true // string(255)    o
    , 'product_id_type'               => true // integer(11)    o   
    , 'price'                         => true // integer(11)    o   o
    , 'minimum_seller_allow_price'    => true // integer(11)    o   o
    , 'maximum_seller_allow_price'    => true // integer(11)    o   o
    , 'item_condition'                => true // integer(11)    o
    , 'quantity'                      => true // integer(11)    o   o
    , 'add_delete'                    => true // string(255)    o
    , 'will_ship_internationally'     => true // string(255)    o
    , 'expedited_shipping'            => true // string(255)    o
    , 'standard_plus'                 => true // string(255)    o
    , 'item_note'                     => true // string(2047)   o
    , 'fullfillment_channel'          => true // string(1024)   o   o
    , 'product_tax_code'              => true // string(255)    o
    , 'leadtime_to_ship'              => true // integer(11)    o   o
    , 'seller_sku'                    => true // string(255)        o   o
    , 'currency'                      => true // string(255)            o
    , 'shipping_option_1'             => true // string(255)            o
    , 'shipping_option_2'             => true // string(255)            o
    , 'shipping_option_3'             => true // string(255)            o
    , 'shipping_option_4'             => true // string(255)            o
    , 'shipping_option_5'             => true // string(255)            o
    , 'shipping_option_6'             => true // string(255)            o
    , 'shipping_amount_1'             => true // integer(11)            o
    , 'shipping_amount_2'             => true // integer(11)            o
    , 'shipping_amount_3'             => true // integer(11)            o
    , 'shipping_amount_4'             => true // integer(11)            o
    , 'shipping_amount_5'             => true // integer(11)            o
    , 'shipping_amount_6'             => true // integer(11)            o
    , 'type_1'                        => true // string(255)            o
    , 'type_2'                        => true // string(255)            o
    , 'type_3'                        => true // string(255)            o
    , 'type_4'                        => true // string(255)            o
    , 'type_5'                        => true // string(255)            o
    , 'type_6'                        => true // string(255)            o
    , 'is_shipping_restricted_1'      => true // tinyint(1)             o
    , 'is_shipping_restricted_2'      => true // tinyint(1)             o
    , 'is_shipping_restricted_3'      => true // tinyint(1)             o
    , 'is_shipping_restricted_4'      => true // tinyint(1)             o
    , 'is_shipping_restricted_5'      => true // tinyint(1)             o
    , 'is_shipping_restricted_6'      => true // tinyint(1)             o
    , 'update_delete'                 => true // string(255)            o
    , 'item_description'              => true // string(1023)
    , 'listing_identifier'            => true // string(255)
    , 'open_date'                     => true // datetime
    , 'image_url'                     => true // string(2048)
    , 'item_is_marketplace'           => true // string(255)
    , 'zshop_shipping_fee'            => true // integer(11)
    , 'zshop_category1'               => true // string(255)
    , 'zshop_browse_path'             => true // string(255)
    , 'zshop_storefront_feature'      => true // string(255)
    , 'asin1'                         => true // string(255)
    , 'asin2'                         => true // string(255)
    , 'asin3'                         => true // string(255)
    , 'zshop_boldface'                => true // string(255)
    , 'bid_for_featured_placement'    => true // string(255)
    , 'pending_quantity'              => true // integer(11)
    , 'merchant_shipping_group'       => true // string(255)
    , 'point'                         => true // integer(11)
    , 'seller_identifier'             => true // string(255)
    , 'marketplace'                   => true // string(255)
    , 'created'                       => true // datetime
    , 'modified'                      => true // datetime
    );
    $merchants = TableRegistry::get('Merchants');

    $results = $this->setMerchants($header, $request);

    //debug($request);
    foreach($results as $result) {
      $entity = $merchants->newEntity($reslut);
      $merchant = $merchants->find()
        ->where(['seller' => $entity->seller, 'marketplace' => $entity->marketplace])
        ->first();
      if($merchant) {
        unset($result['created']);
        $entity = $merchant->patchEntity($merchant, $result);
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
    $datas = array();
    $datetime = date('Y-m-d H:i:s');
    $deftime  = date('Y-m-d H:i:s', 0);
    $keys     = array_keys($header);
    $vals     = array_values($header);

    //debug($request);
    $_response = $this->fetchMerchants($request);

    foreach($_response as $response) {
      $data = array();
      foreach($merchants as $merchant) {
        if($merchant) {
          if($vals[ 0]) $data[$keys[ 0]] = $merchant['item_name'                 ] ?? 'N//A';
          if($vals[ 1]) $data[$keys[ 1]] = $merchant['product_identifier'        ] ?? 'N//A';
          if($vals[ 2]) $data[$keys[ 2]] = $merchant['product_id_type'           ] ?? 0;
          if($vals[ 3]) $data[$keys[ 3]] = $merchant['price'                     ] ?? 0;
          if($vals[ 4]) $data[$keys[ 4]] = $merchant['minimum_seller_allow_price'] ?? 0;
          if($vals[ 5]) $data[$keys[ 5]] = $merchant['maximum_seller_allow_price'] ?? 0;
          if($vals[ 6]) $data[$keys[ 6]] = $merchant['item_condition'            ] ?? 0;
          if($vals[ 7]) $data[$keys[ 7]] = $merchant['quantity'                  ] ?? 0;
          if($vals[ 8]) $data[$keys[ 8]] = $merchant['add_delete'                ] ?? 'N//A';
          if($vals[ 9]) $data[$keys[ 9]] = $merchant['will_ship_internationally' ] ?? 'N//A';
          if($vals[10]) $data[$keys[10]] = $merchant['expedited_shipping'        ] ?? 'N//A';
          if($vals[11]) $data[$keys[11]] = $merchant['standard_plus'             ] ?? 'N//A';
          if($vals[12]) $data[$keys[12]] = $merchant['item_note'                 ] ?? 'N//A';
          if($vals[13]) $data[$keys[13]] = $merchant['fullfillment_channel'      ] ?? 'N//A';
          if($vals[14]) $data[$keys[14]] = $merchant['product_tax_code'          ] ?? 'N//A';
          if($vals[15]) $data[$keys[15]] = $merchant['leadtime_to_ship'          ] ?? 0;
          if($vals[16]) $data[$keys[16]] = $merchant['seller_sku'                ] ?? 'N//A';
          if($vals[17]) $data[$keys[17]] = $merchant['currency'                  ] ?? 'N//A';
          if($vals[18]) $data[$keys[18]] = $merchant['shipping_option_1'         ] ?? 'N//A';
          if($vals[19]) $data[$keys[19]] = $merchant['shipping_option_2'         ] ?? 'N//A';
          if($vals[20]) $data[$keys[20]] = $merchant['shipping_option_3'         ] ?? 'N//A';
          if($vals[21]) $data[$keys[21]] = $merchant['shipping_option_4'         ] ?? 'N//A';
          if($vals[22]) $data[$keys[22]] = $merchant['shipping_option_5'         ] ?? 'N//A';
          if($vals[23]) $data[$keys[23]] = $merchant['shipping_option_6'         ] ?? 'N//A';
          if($vals[24]) $data[$keys[24]] = $merchant['shipping_amount_1'         ] ?? 0;
          if($vals[25]) $data[$keys[25]] = $merchant['shipping_amount_2'         ] ?? 0;
          if($vals[26]) $data[$keys[26]] = $merchant['shipping_amount_3'         ] ?? 0;
          if($vals[27]) $data[$keys[27]] = $merchant['shipping_amount_4'         ] ?? 0;
          if($vals[28]) $data[$keys[28]] = $merchant['shipping_amount_5'         ] ?? 0;
          if($vals[29]) $data[$keys[29]] = $merchant['shipping_amount_6'         ] ?? 0;
          if($vals[30]) $data[$keys[30]] = $merchant['type_1'                    ] ?? 'N//A';
          if($vals[31]) $data[$keys[31]] = $merchant['type_2'                    ] ?? 'N//A';
          if($vals[32]) $data[$keys[32]] = $merchant['type_3'                    ] ?? 'N//A';
          if($vals[33]) $data[$keys[33]] = $merchant['type_4'                    ] ?? 'N//A';
          if($vals[34]) $data[$keys[34]] = $merchant['type_5'                    ] ?? 'N//A';
          if($vals[35]) $data[$keys[35]] = $merchant['type_6'                    ] ?? 'N//A';
          if($vals[36]) $data[$keys[36]] = $merchant['is_shipping_restricted_1'  ] ?? 0;
          if($vals[37]) $data[$keys[37]] = $merchant['is_shipping_restricted_2'  ] ?? 0;
          if($vals[38]) $data[$keys[38]] = $merchant['is_shipping_restricted_3'  ] ?? 0;
          if($vals[39]) $data[$keys[39]] = $merchant['is_shipping_restricted_4'  ] ?? 0;
          if($vals[40]) $data[$keys[40]] = $merchant['is_shipping_restricted_5'  ] ?? 0;
          if($vals[41]) $data[$keys[41]] = $merchant['is_shipping_restricted_6'  ] ?? 0;
          if($vals[42]) $data[$keys[42]] = $merchant['update_delete'             ] ?? 'N//A';
          if($vals[43]) $data[$keys[43]] = $merchant['item_description'          ] ?? 'N//A';
          if($vals[44]) $data[$keys[44]] = $merchant['listing_identifier'        ] ?? 'N//A';
          if($vals[45]) $data[$keys[45]] = isset($merchant['open_date'])
            ? $this->getTimeStamp($merchant['open_date']) : $deftime;
          if($vals[46]) $data[$keys[46]] = $merchant['image_url'                 ] ?? 'N//A';
          if($vals[47]) $data[$keys[47]] = $merchant['item_is_marketplace'       ] ?? 'N//A';
          if($vals[48]) $data[$keys[48]] = $merchant['zshop_shipping_fee'        ] ?? 0;
          if($vals[49]) $data[$keys[49]] = $merchant['zshop_category1'           ] ?? 'N//A';
          if($vals[50]) $data[$keys[50]] = $merchant['zshop_browse_path'         ] ?? 'N//A';
          if($vals[51]) $data[$keys[51]] = $merchant['zshop_storefront_feature'  ] ?? 'N//A';
          if($vals[52]) $data[$keys[52]] = $merchant['asin1'                     ] ?? 'N//A';
          if($vals[53]) $data[$keys[53]] = $merchant['asin2'                     ] ?? 'N//A';
          if($vals[54]) $data[$keys[54]] = $merchant['asin3'                     ] ?? 'N//A';
          if($vals[55]) $data[$keys[55]] = $merchant['zshop_boldface'            ] ?? 'N//A';
          if($vals[56]) $data[$keys[56]] = $merchant['bid_for_featured_placement'] ?? 'N//A';
          if($vals[57]) $data[$keys[57]] = $merchant['pending_quantity'          ] ?? 0;
          if($vals[58]) $data[$keys[58]] = $merchant['merchant_shipping_group'   ] ?? 'N//A';
          if($vals[59]) $data[$keys[59]] = $merchant['point'                     ] ?? 0;
          if($vals[60]) $data[$keys[60]] = $response['seller_identifier'];
          if($vals[61]) $data[$keys[61]] = $response['marketplace'];
          if($vals[62]) $data[$keys[62]] = $datetime;
          if($vals[63]) $data[$keys[63]] = $datetime;
          array_push($datas, $data);
        }
      }
    }
    return $datas;
  }

  private function fetchMerchants($request) 
  {
    //debug($request);
    $response = [];
    Promise\all($this->_fetchMerchants($request))
      ->then(function($result) use (&$respose) {
        $response = $result;
        //debug($result);
      }, function($error) {
        //debug($result);
        $this->log_error($error);
      });
    return $response;
  }
  
  private function _fetchMerchants($request) 
  {
    $response = array();
    foreach($request as $_request) {
      //debug($_request);
      array_push($response, $this->fetchMerchant($_request));
    }
    return $response;
  }

  private function fetchMerchant($request) 
  {
    $deferred = new Promise\Deferred();
    $this->_fetchMerchant(function($error, $response) use ($deferred) {
      if($error) {
        $this->log_error($error);
        $deferred->reject($error);
      }
      $deferred->resolve($response);
    }, $request);
    return $deferred->promise();
  }

  private function _fetchMerchant($callback, $request)
  {
    $response = [];
    $access_key = $request['access_key'];
    $secret_key = $request['secret_key'];
    $seller     = $request['seller'];
    switch($request['marketplace']) {
    case 'JP':
      $market_id = $this->AmazonMWS::MWS_MARKETPLACE_JP;
      $country   = $this->AmazonMWS::MWS_BASEURL_JP;
      break;
    case 'AU':
      $market_id = $this->AmazonMWS::MWS_MAEKETPLACE_AU;
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
      $response = $this->AmazonMWS->GetReport([
        'Marketplace'     => $market_id
      , 'SellerId'        => $seller
      , 'AWSSecretKeyId'  => $secret_key
      , 'AWSAccessKeyId'  => $access_key
      , 'BaseURL'         => $country
      ]);
    } catch (\Exception $e) {
      $callback($e->getMessage(), []);
    }

    $callback(null, [
      'getReport'   => $response
    , 'marketplace' => $request['marketplace']
    , 'seller'      => $request['seller']
    ]);
  }
  
  private function getTimeStamp ($str)
  {
    return \DataTime::createFromFormat('Y-m-d H:i:s', $str)->format('Y/m/d H:i:s');
  }

  private function log_error($message) 
  {
    $this->log(print_r($message, true), LOG_DEBUG);
  }
}
