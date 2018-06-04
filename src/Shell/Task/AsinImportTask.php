<?php
namespace App\Shell\Task;

use Cake\Console\Shell;
use Cake\ORM\TableRegistry;
use Cake\Log\Log;
use ApaiIO\Configuration\GenericConfiguration;
use ApaiIO\Configuration\Country;
use ApaiIO\Operations\Lookup;
use ApaiIO\ResponseTransformer\XmlToArray;
use ApaiIO\ApaiIO;
use React\Promise;

/**
 * AsinImport shell task.
 */
class AsinImportTask extends Shell
{

  public function initialize() 
  {
    $this->access_keys_jp = array(
      'access_key' => env('AMZ_PA_ACCESSKEY_JP', '')
    , 'secret_key' => env('AMZ_PA_SECRETKEY_JP', '')
    , 'associ_tag' => env('AMZ_PA_ASSOCITAG_JP', '')
    );
    $this->access_keys_au = array(
      'access_key' => env('AMZ_PA_ACCESSKEY_AU', '')
    , 'secret_key' => env('AMZ_PA_SECRETKEY_AU', '')
    , 'associ_tag' => env('AMZ_PA_ASSOCITAG_AU', '')
    );
    $this->access_keys_us = array(
      'access_key' => env('AMZ_PA_ACCESSKEY_US', '')
    , 'secret_key' => env('AMZ_PA_SECRETKEY_US', '')
    , 'associ_tag' => env('AMZ_PA_ASSOCITAG_US', '')
    );
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
    $this->execAsinImport();
  }

  private function execAsinImport() 
  {
    $asins = TableRegistry::get('Asins');
    $datas = $asins->find()->where(['suspended' => false]);
    $request = array();
    foreach($datas as $data) {
      array_push($request, ['asin' => $data->asin, 'marketplace' => $data->marketplace]);
    }
    if(!$this->upsertAsin($request)) {
      return false;
    }
    return true;
  }

  private function insertAsin($request)
  {
    $header = array(
      'asin'        => true
    , 'ean'         => true
    , 'isbn'        => true
    , 'sku'         => true
    , 'upc'         => true
    , 'marketplace' => true
    , 'created'     => true
    , 'modified'    => true
    , 'suspended'   => true
    );
    $asins = TableRegistry::get('Asins');

    $results = $this->setAsins($header, $request);

    $query = $asins->query();
    $query->insert(array_key($header));
    foreach($results as $result) {
      $query->values($result);
    }
    if(!$query->execute()) {
      $this->log_error($query->errors());
      return false;
    }
    return true;
  }

  private function upsertAsin($request) 
  {
    $header = array(
      'asin'        => true
    , 'ean'         => true
    , 'isbn'        => true
    , 'sku'         => true
    , 'upc'         => true
    , 'marketplace' => true
    , 'created'     => true
    , 'modified'    => true
    , 'suspended'   => true
    );
    $asins = TableRegistry::get('Asins');

    $results = $this->setAsins($header, $request);

    foreach($results as $result) {
      $entity = $asins->newEntity($result);
      $asin = $asins->find()
        ->where(['asin' => $entity->asin, 'marketplace' => $entity->marketplace])
        ->first();
      if($asin) {
        unset($result['created']);
        $entity = $asins->patchEntity($asin, $result);
      }
      if(!$asins->save($entity)) {
        $this->log_error($entity->errors());
        return false;
      }
    }
    return true;
  }

  private function setAsins($header, $request)
  {
    $datas = array();
    $datetime = date('Y-m-d H:m:i');
    $keys     = array_keys($header);
    $vals     = array_values($header);

    $_response = $this->fetchAsins($request);
    //debug($_response);

    foreach($_response as $response) {
      $operation    = $response['fetchAsin']['OperationRequest'];
      $parameter    = $response['fetchAsin']['Items']['Request'];
      $_items       = $response['fetchAsin']['Items']['Item'];
      $items        = array_values($_items) === $_items ? $_items : [$_items];
      $marketplace  = $response['marketplace'];
      $data = array();
      foreach($items as $item) {
        if($item) {
          if($vals[0]) $data[$keys[0]] = $item['ASIN'] ?? 'N/A';
          if($vals[1]) $data[$keys[1]] = $item['ItemAttributes']['EAN']   ?? 'N/A';
          if($vals[2]) $data[$keys[2]] = $item['ItemAttributes']['ISBN']  ?? 'N/A';
          if($vals[3]) $data[$keys[3]] = $item['ItemAttributes']['SKU']   ?? 'N/A'; 
          if($vals[4]) $data[$keys[4]] = $item['ItemAttributes']['UPC']   ?? 'N/A'; 
          if($vals[5]) $data[$keys[5]] = $marketplace;
          if($vals[6]) $data[$keys[6]] = $datetime;
          if($vals[7]) $data[$keys[7]] = $datetime;
          if($vals[8]) $data[$keys[8]] = 0;
          array_push($datas, $data);
        }
      }
    }
    //debug($datas);
    return $datas;
  }

  private function fetchAsins($request) {
    $response = [];
    Promise\all($this->_fetchAsins($request))
      ->done(function($result) use (&$response) {
          //debug($result);
          $response = $result;
        }, function($error) {
          $this->log_error($error);
        });
    return $response;
  }

  private function _fetchAsins($request) 
  {
    $response = array();
    $asins_jp = array();
    $asins_au = array();
    $asins_us = array();
    $eol = count($request);
    $idx = 0;
    //debug($request);
    foreach($request as $_request) {
      switch($_request['marketplace']) {
      case 'JP':
        if($this->isKey('JP')) array_push($asins_jp, $_request['asin']);
        if(count($asins_jp) > 10) {
          array_push($response, $this->fetchAsin(implode(',', $asins_jp), 'JP'));
          $asins_jp = array();
        }
        break;
      case 'AU':
        if($this->isKey('AU')) array_push($asins_au, $_request['asin']);
        if(count($asins_au) > 10) {
          array_push($response, $this->fetchAsin(implode(',', $asins_au), 'AU'));
          $asins_au = array();
        }
        break;
      case 'US':
        if($this->isKey('US')) array_push($asins_us, $_request['asin']);
        if(count($asins_us) > 10) {
          array_push($response, $this->fetchAsin(implode(',', $asins_us), 'US'));
          $asins_us = array();
        }
        break;
      }
      if($idx === $eol - 1) {
        if(count($asins_jp) !== 0)
          array_push($response, $this->fetchAsin(implode(',', $asins_jp), 'JP'));
        if(count($asins_au) !== 0) 
          array_push($response, $this->fetchAsin(implode(',', $asins_au), 'AU'));
        if(count($asins_us) !== 0) 
          array_push($response, $this->fetchAsin(implode(',', $asins_us), 'US'));
      }
      $idx += 1;
    }
    //debug($response);
    return $response;
  }

  private function fetchAsin($asin, $marketplace)
  {
    $deferred = new Promise\Deferred();
    $this->_fetchAsin(function($error, $response) use ($deferred){
      if($error) {
        $this->log_error($error);
        $deferred->reject($error);
      }
      $deferred->resolve($response);
    }, $asin, $marketplace);
    return $deferred->promise();
  }

  private function _fetchAsin($callback, $asin, $marketplace)
  {
    $conf = new GenericConfiguration();
    $client = new \GuzzleHttp\Client();
    $request = new \ApaiIO\Request\GuzzleRequest($client);
    switch($marketplace) {
    case 'JP':
      $country = Country::JAPAN;
      $access_key = $this->access_keys_jp['access_key'];
      $secret_key = $this->access_keys_jp['secret_key'];
      $associ_tag = $this->access_keys_jp['associ_tag'];
      break;
    case 'AU':
      $country = Country::AUSTRALIA;
      $access_key = $this->access_keys_au['access_key'];
      $secret_key = $this->access_keys_au['secret_key'];
      $associ_tag = $this->access_keys_au['associ_tag'];
      break;
    case 'US':
      $country = Country::INTERNATIONAL;
      $access_key = $this->access_keys_us['access_key'];
      $secret_key = $this->access_keys_us['secret_key'];
      $associ_tag = $this->access_keys_us['associ_tag'];
      break;
    default:
      $country = Country::JAPAN;
      $access_key = $this->access_keys_jp['access_key'];
      $secret_key = $this->access_keys_jp['secret_key'];
      $associ_tag = $this->access_keys_jp['associ_tag'];
      break;
    }
    sleep(5);
    try {
      $conf
        ->setCountry($country)
        ->setAccessKey($access_key)
        ->setSecretKey($secret_key)
        ->setAssociateTag($associ_tag)
        ->setRequest($request)
        ->setResponseTransformer(new XmlToArray())
      ;
    } catch(\Exception $e) {
      $callback($e->getMessage(), []);
    }
    $apaiIO = new ApaiIO($conf);
    $lookup = new Lookup();
    $lookup->setItemId($asin);
    $lookup->setCondition('All');
    $lookup->setMerchantId('All');
    $lookup->setResponseGroup(array('ItemAttributes'));

    $callback(null, [
      'fetchAsin'   => $apaiIO->runOperation($lookup)
    , 'marketplace' => $marketplace
    ]);
  }
  
  private function isKey($marketplace)
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

  private function log_debug($messate)
  {
    $displayName = '[' . get_class($this) . '] ';
    Log::debug($displayName . print_r($message, true),  ['scope' => ['crons']]);
  }

  private function log_error($messate)
  {
    $displayName = '[' . get_class($this) . '] ';
    Log::error($displayName . print_r($message, true),  ['scope' => ['crons']]);
  }
}
