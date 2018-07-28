<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Log\Log;
use React\Promise;
use React\EventLoop;

/**
 * Common component
 */
class CommonComponent extends Component
{
  /**
   * Default configuration.
   *
   * @var array
   */
  protected $_defaultConfig = [];

  public function retry($loop, $callback, $interval=3, $maximum=3, $retry=0, $deferred=null) 
  {
    $deferred = $deferred ?: new Promise\Deferred();
    $promise = $callback();
    $promise
      ->then(
        function($value) use ($deferred) {
          print('-');
          $deferred->resolve($value);
        },
        function($reason) use ($loop, $callback, $interval, $maximum, $retry, $deferred) {
          if($retry++ >= $maximum) {
            print('x');
            return $deferred->reject($reason);
          }
          $loop->addTimer($interval, function($timer)
            use ($loop, $callback, $interval, $maximum, $retry, $deferred) {
            print($retry);
            $this->retry($loop, $callback, $interval, $maximum, $retry, $deferred);
          });
        });
    return $deferred->promise();
  }

  public function getTimeStamp($str)
  {
    //debug($str);
    if(preg_match('/^([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})$/', $str, $matches)) {
      $str = $matches[1]."-".$matches[2]."-".$matches[3]." 00:00:00";
    } else if(preg_match('/^([0-9]{4})-([0-9]{1,2})$/', $str, $matches)) {
      $str = $matches[1]."-".$matches[2]."-01 00:00:00";
    } else if(preg_match('/^([0-9]{4})$/', $str, $matches)) {
      $str = $matches[1]."-01-01 00:00:00";
    }
    $date = \DateTime::createFromFormat('Y-m-d H:i:s', $str);
    return $date->format('Y/m/d H:i:s');
  }

  public function getLocalLength($length, $ship) 
  {
    $rate = $ship->us_length;
    return (float)($length * $rate / 100);
  }

  public function getLocalWeight($weight, $ship)
  {
    $rate = $ship->us_weight;
    return (float)($weight * $rate / 100);
  }

  public function getLocalPrice($price, $currency)
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

  public function getTimeStamp2 ($date, $marketplace)
  {
    $format = 'd/m/Y H:i:s T';
    switch($marketplace) {
    case 'JP':
      $format = 'Y/m/d H:i:s T';
      break;
    case 'AU':
    case 'US':
      $format = 'd/m/Y H:i:s T';
      break;
    }
    return \DateTime::createFromFormat($format, $date)->format('Y/m/d H:i:s');
  }

  public function getLocalLength2($length, $units, $ship)
  {
    $rate = 0;
    switch($units) {
    case 'inches':
      $rate = $ship->us_length;
      break;
    default:
      $rate = $ship->jp_length;
      break;
    }
    $result = (float)($length * $rate);
    return $result;
  }

  public function getLocalWeight2($weight, $units, $ship)
  {
    $rate = 0;
    switch($units) {
    case 'pounds':
      $rate = $ship->us_weight;
      break;
    default:
      $rate = $ship->jp_weight;
      break;
    }
    $result = (float)($weight * $rate);
    return $result;
  }

  public function getArea($marketplace)
  { 
    switch($marketplace) {
    case 'JP':
      $area = 'ASIA';
      break;
    case 'AU':
      $area = 'OCEANIA';
      break;
    case 'US':
      $area = 'NORTH_AMERICA';
      break;
    }
    return $area;
  }

  private function toJPY($price, $currency, $ship)
  {
    $rate = 0;
    switch ($currency) {
    case 'JPY':
      $rate = $ship->jpy_price;
      break;
    case 'USD':
      $rate = $ship->usd_price;
      break;
    case 'AUD':
      $rate = $ship->aud_price;
      break;
    }
    return (float)($price * $rate);
  }

  public function getAddDel($count)
  {
    return (int)$count < 1 ? 'd' : 'a';
  }

  public function getSellerSKU($asin, $marketplace)
  {
    return 'WN001JP-' .  $asin . '-0' . $marketplace . '01';
  }

  public function getSalesPrice($price, $currency, $marketplace, $shipping, $ship)
  {
    $price_jpy = $this->toJPY($price, $currency, $ship);

    $isPt1 = $price_jpy < $ship->price_criteria_1;
    $isPt2 = $price_jpy < $ship->price_criteria_2 && $ship->price_criteria_1 < $price_jpy;
    $isPt3 = $price_jpy < $ship->price_criteria_3 && $ship->price_criteria_2 < $price_jpy;
    $isPt4 = $price_jpy < $ship->price_criteria_4 && $ship->price_criteria_3 < $price_jpy;

    if($isPt1) {
      $sales_price = $price_jpy * (int)$ship->sales_rate_1 / 100 + $ship->sales_price_1;
    } else if($isPt2) {
      $sales_price = $price_jpy * (int)$ship->sales_rate_2 / 100 + $ship->sales_price_2;
    } else if($isPt3) {
      $sales_price = $price_jpy * (int)$ship->sales_rate_3 / 100 + $ship->sales_price_3;
    } else if($isPt4) {
      $sales_price = $price_jpy * (int)$ship->sales_rate_4 / 100 + $ship->sales_price_4;
    } else {
      $sales_price = $price_jpy * (int)$ship->sales_rate_5 / 100 + $ship->sales_price_5;
    }
 
    $total_price = $sales_price + $shipping;

    $rate = 0;
    switch($marketplace) {
    case 'JP':
      $rate = $ship->jpy_price;
      break;
    case 'US':
      $rate = $ship->usd_price;
      break;
    case 'AU':
      $rate = $ship->aud_price;
      break;
    }
    return (float)($total_price / $rate);
  }

  public function getQuantity($count, $ship)
  {
    $rate  = (int)$ship->pending_quantity_rate / 100;
    $added = (int)$ship->pending_quantity;
    return (int)$count * $rate + $added;
  }

  public function getCondition($status) 
  {
    switch($status) {
    case 'New':
      $condition = 11;
      break;
    case 'Used':
      $condition = 1;
      break;
    default:
      $condition = 11;
      break;
    }
    return $condition;
  }

  public function isKey($marketplace)
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
    //print_r($isKey . "\n");
    return $isKey;
  }

  public function isStr($str) 
  {
    return $str === 'N/A' || $str === null ? null : $str;
  }
  
  public function isNum($num)
  {
    return $num === 0 || $num === null ? 0 : $num;
  }

  public function log_debug($message, $scope="apps")
  {
    $displayName = '[' . get_class($this) . '] ';
    Log::debug($displayName . print_r($message, true),  ['scope' => [$scope]]);
  }

  public function log_error($message, $file, $line, $scope="apps")
  {
    $displayName = '[' . get_class($this) . '] ';
    Log::error($displayName . sprintf('%s in %s at %d.', $message, $file, $line) ,  ['scope' => [$scope]]);
  }
}
