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
          $deferred->resolve($value);
        },
        function($reason) use ($loop, $callback, $interval, $maximum, $retry, $deferred) {
          if($reason) $this->log_error($reason, __FILE__, __LINE__, 'crons');
          if($retry++ >= $maximum) return $deferred->reject($reason);
          $loop->addTimer($interval, function($timer)
            use ($loop, $callback, $interval, $maximum, $retry, $deferred) {
            $this->retry($loop, $callback, $interval, $maximum, $retry, $deferred);
          });
        })
      ->otherwise(
        function($updated) {
          if($updated) $this->log_error($updated, __FILE__, __LINE__, 'crons');
        })
      ;
    return $deferred->promise();
  }

  public function getTimeStamp($str)
  {
    return \DateTime::createFromFormat('Y-m-d', $str)->format('Y/m/d H:i:s');
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
