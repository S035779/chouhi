<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\TransferException;
use MarketplaceWebServiceProducts\Component\GetMatchingProductForIdComponent;
use MarketplaceWebServiceSellers\Component\ListMarketplaceParticipations;

/**
 * Common component
 */
class CommonComponent extends Component
{
  // Market Place Endpoint.
  public const MWS_MARKETPLACE_JP = 'A1VC38T7YXB528';
  public const MWS_BASEURL_JP     = 'https://mws.amazonservices.jp/';
  public const MWS_MARKETPLACE_US = 'ATVPDKIKX0DER';
  public const MWS_BASEURL_US     = 'https://mws.amazonservices.com/';
  public const MWS_MARKETPLACE_AU = 'A39IBJ37TRP1C6';
  public const MWS_BASEURL_AU     = 'https://mws.amazonservices.com.au/';

  /**
   * Default configuration.
   *
   * @var array
   */
  protected $_defaultConfig = [];

  /**
   * Amazon MWS ListMarketplaceParticipations/GetServiceStatus
   * 
   * Slotling = 15 counts. recovery rate = 1 count/min.
   * response: NestToken, ListParticipations, ListMarketplaces.
   */
  public function listMarketplaceParticipations($params)
  {
    $amazon = new ListMarketplaceParticipations();
    return $amazon->fetch($params);
  }

  public function fetchMatchingProductForId($params, $baseurl, $secret_key)
  {
    $amazon =  new GetMatchingProductForIdComponent();
    return $amazon->fetch($params, $baseurl, $secret_key);
  }

  public function debug($message)
  {
    $this->log(print_r($message, true), LOG_DEBUG);
  }

  public function error($message)
  {
    $this->log(print_r($message, true), LOG_ERROR);
  }

  public function getFeedType($jobType)
  {
    switch($jobType) {
      case 1:
        return '_POST_FLAT_FILE_INVLOADER_DATA_';
      case 2:
        return '_POST_FLAT_FILE_PRICEANDQUANTITYONLY_UPDATE_DATA_';
      case 3:
        return '_POST_FLAT_FILE_LISTING_DATA_';
    }
  }

  public function getReportType($reportType)
  {
    switch($reportType) {
    case 1:
      return '_GET_FLAT_FILE_OPEN_LISTINGS_DATA_';
    }
  }

  public function getPurgeAndReplace($jobType, $allChange) {
    switch($jobType) {
      case 1:
        if ($allChange) {
          return 'true';
        } else {
          return 'false';
        }
      case 2:
        return 'false';
      case 3:
        return 'false';
    }
  }

  public function upload($params, $baseurl, $secret_key, $jobType=0)
  {
    $query = $this->create_query($params);
    $signature = $this->create_signature($baseurl, $query, $secret_key, $jobType);
    $url = $this->create_url($baseurl, $query, $signature);
    $handle = $this->openfile();
    //
  }

  public function fetch($params, $baseurl, $secret_key, $jobType=0)
  {
    $query = $this->create_query($params);
    $signature = $this->create_signature($baseurl, $query, $secret_key, $jobType);
    $url = $this->create_url($baseurl, $query, $signature);
    $client = new \GuzzleHttp\Client();
    try {
      $response = $client->post($url);
    } catch (TransferException $e) {
      echo Psr7\str($e->getRequest());
      if ($e->hasResponse()) {
        echo Psr7\str($e->getResponse());
      }
    }
    return $this->parseXml($response);
  }

  private function openfile()
  {
    $handleFile = @open('php://temp', 'rw+');
    fwirte($handleFile);
    return $handleFile;
  }

  private function create_query($params)
  {
    ksort($params);
    $query = '';
    foreach ($params as $key => $value) {
      $query .= $key . '=' . $this->urlencode_rfc3986($value) . '&';
    }
    return substr($query, 0, -1);
  }

  private function create_signature($baseurl, $query, $secret_key, $jobType)
  {
    $parsed_url = parse_url($baseurl);
    if($jobType == 2) {
      $string_to_sign = 'POST'  . "\n"
        . $parsed_url['host']   . "\n"
        . $parsed_url['path']   . "\n"
        . $query;
    } else {
      $string_to_sign = 'GET'   . "\n" 
        . $parsed_url['host']   . "\n"
        . $parsed_url['path']   . "\n"
        . $query;
    }
    return base64_encode(hash_hmac('sha256', $string_to_sign, $secret_key, true));
  }

  private function create_url($baseurl, $query, $signature) {
    return $baseurl . '?'
      . $query . '&' . 'Signature' . '=' . $this->urlencode_rfc3986($signature);
  }

  private function urlencode_rfc3986($string) {
    return rawurlencode($string);
  }

  private function parseXml($response) {
    $xml = simplexml_load_string($response);
    if(isset($xml->Error->Message)) {
      echo "Error:" . $xml->Error->Message;
    } else if(!$xml) {
      $xml = 'No contents.';
    } 
    return $xml;
  }
}
