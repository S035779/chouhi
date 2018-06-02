<?php
namespace App\Shell\Task;

use Cake\Console\Shell;
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
    $request = array();
    foreach($datas as $data) {
      array_push($request, [
        'seller'      => $data->seller->seller
      , 'marketplace' => $data->seller->marketplace
      , 'access_key'  => $data->access_key
      , 'secret_key'  => $data->secret_key
      ]);
    }
    if(!$this->selectMerchant($request)) {
      return false;
    }
    return true;
  }

  private function selectMerchant($request) 
  {
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
    $access_key = $request['access_key'];
    $secret_key = $request['secret_key'];
    $seller     = $request['seller'];
    switch($request['marketplace']) {
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
      $resopnse = $this->AmazonMWS->addDelFeed([
        'Marketplace'     => $market_id
      , 'SellerId'        => $seller
      , 'AWSSecretKeyId'  => $secret_key
      , 'AWSAccessKeyId'  => $access_key
      , 'BaseURL'         => $country
      ]);
      $response = $this->AmazonMWS->updateFeed([
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
      'submitFeed'  => $response
    , 'marketplace' => $request['marketplace']
    , 'seller'      => $request['seller']
    ]);
  }

  private function log_error($message) 
  {
    $this->log(print_r($message, true), LOG_DEBUG);
  }
}
