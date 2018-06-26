<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use ApaiIO\Configuration\GenericConfiguration;
use ApaiIO\Configuration\Country;
use ApaiIO\Operations\Search;
use ApaiIO\Operations\SimilarityLookup;
use ApaiIO\Operations\Lookup;
use ApaiIO\Operations\BrowseNodeLookup;
use ApaiIO\ResponseTransformer\XmlToArray;
use ApaiIO\ApaiIO;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\TransferException;

/**
 * AmazonPA component
 */
class AmazonPAComponent extends Component
{

  /**
   * Default configuration.
   *
   * @var array
   */
  protected $_defaultConfig = [];

  public function search() {
    // Amazon Item Search
    $conf = new GenericConfiguration();
    $client = new \GuzzleHttp\Client();
    $request = new \ApaiIO\Request\GuzzleRequest($client);
    try {
      $conf
        ->setCountry(Country::JAPAN)
        ->setAccessKey($this->access_key)
        ->setSecretKey($this->secret_key)
        ->setAssociateTag($this->associ_tag)
        ->setRequest($request)
        ->setResponseTransformer(new XmlToArray())
      ;
    } catch (\Exception $e) {
      echo $e->getMessage();
    }
    $apaiIo = new ApaiIO($conf);
    $search = new Search();
    $search->setCategory('DVD');
    $search->setActor('Bruce Willis');
    $search->setKeywords('Die Hard');
    $search->setPage(3);
    $search->setResponseGroup(array('Large', 'Small'));
    $response = $apaiIo->runOperation($search);
    return $response;
  }

  public function similarity() {
    // Amazon Simple Similarity Lookup
    $conf = new GenericConfiguration();
    $client = new \GuzzleHttp\Client();
    $request = new \ApaiIO\Request\GuzzleRequest($client);
    try {
      $conf
        ->setCountry(Country::JAPAN)
        ->setAccessKey($this->access_key)
        ->setSecretKey($this->secret_key)
        ->setAssociateTag($this->associ_tag)
        ->setRequest($request)
        ->setResponseTransformer(new XmlToArray())
      ;
    } catch (\Exception $e) {
      echo $e->getMessage();
    }
    $apaiIo = new ApaiIO($conf);
    $lookup = new SimilarityLookup();
    $lookup->setItemId('B01NCXFWIZ');
    $lookup->setResponseGroup(array('Large', 'Small'));
    $response = $apaiIo->runOperation($lookup);
    return $response;
  }

  public function lookup() {
    // Amazon Simple Lookup
    $conf = new GenericConfiguration();
    $client = new \GuzzleHttp\Client();
    $request = new \ApaiIO\Request\GuzzleRequest($client);
    try {
      $conf
        ->setCountry(Country::JAPAN)
        ->setAccessKey($this->access_key)
        ->setSecretKey($this->secret_key)
        ->setAssociateTag($this->associ_tag)
        ->setRequest($request)
        ->setResponseTransformer(new XmlToArray())
      ;
    } catch (\Exception $e) {
      echo $e->getMessage();
    }
    $apaiIo = new ApaiIO($conf);
    $lookup = new Lookup();
    $lookup->setItemId('B01NCXFWIZ');
    $lookup->setResponseGroup(array('Large', 'Small'));
    $response = $apaiIo->runOperation($lookup);
    return $response
  }

  public function nodelookup() {
    // Amazon Browse Node Lookup
    $conf = new GenericConfiguration();
    $client = new \GuzzleHttp\Client();
    $request = new \ApaiIO\Request\GuzzleRequest($client);
    try {
      $conf
        ->setCountry(Country::JAPAN)
        ->setAccessKey($this->access_key)
        ->setSecretKey($this->secret_key)
        ->setAssociateTag($this->associ_tag)
        ->setRequest($request)
        ->setResponseTransformer(new XmlToArray())
      ;
    } catch (\Exception $e) {
      echo $e->getMessage();
    }
    $apaiIo = new ApaiIO($conf);
    $nodelookup = new BrowseNodeLookup();
    $nodelookup->setNodeId(637872);
    $response = $apaiIo->runOperation($nodelookup);
    return $response;
  }

  public function getmatchingproductforid() {
    // Amazon Get Matching Product For Id
    $jobType = 1;
    $params=array();
    $params['AWSAccessKeyId']   = $this->mws_access_key;
    $params['Action']           = 'GetMatchingProductForId';
    $params['SellerId']         = $this->mws_seller_id;
    $params['SignatureMethod']  = 'HmacSHA256';
    $params['SignatureVersion'] = '2';
    $params['Timestamp']        = gmdate('Y-m-d\TH:i:s\Z');
    $params['Version']          = '2010-10-01';
    $params['MarketplaceId']    = $this->marketplace_id;
    $params['IdType']           = 'ASIN';
    $params['IdList.Id.1']      = 'B00JPYHRQ2';
    $baseurl = $this->mws_base_url . 'Products/' . $params['Version'];
    $response = $this->AmazonMWS
        ->fetchMatchingProductForId($params, $baseurl, $this->mws_secret_key, $jobType);
    $this->Flash->success(__('Success: MWS GetMatchingProductForId completed!'));
    return $response;
  }

  public function getlowestofferlistingsforasin()
  {
    $jobType = 1;
    $params=array();
    $params['AWSAccessKeyId']   = $this->mws_access_key;
    $params['Action']           = 'GetLowestOfferListingsForASIN';
    $params['SellerId']         = $this->mws_seller_id;
    $params['SignatureMethod']  = 'HmacSHA256';
    $params['SignatureVersion'] = '2';
    $params['Timestamp']        = gmdate('Y-m-d\TH:i:s\Z');
    $params['Version']          = '2011-10-01';
    $params['MarketplaceId']    = $this->marketplace_id;
    $params['ItemCondition']    = 'New';
    $params['ASINList.ASIN.1']  = 'B00JPYHRQ2';
    $baseurl = $this->mws_base_url . 'Products/' . $params['Version'];
    $response
      = $this->AmazonMWS->fetch($params, $baseurl, $this->mws_secret_key, $jobType);
    foreach($response->GetLowestOfferListingsForASINResult as $products) {
      $getLowestPrice = 0;
      foreach($products->Product->LowestOfferListings->LowestOfferListing as $lowOffer) {
        $getLowestPrice = $lowOffer->Price->LandedPrice->Amount;
      }
    }
    $this->Flash->success(__('Success: MWS GetLowestOfferListingForASIN completed!'));
    $this->set(compact(''));
    return $getLowestPrice;
  }

  public function requestreport() {
    $jobType = 2;
    $reportType = 1;
    $params=array();
    $params['AWSAccessKeyId']         = $this->mws_access_key;
    $params['Action']                 = 'RequestReport';
    $params['SellerId']               = $this->mws_seller_id;
    $params['SignatureMethod']        = 'HmacSHA256';
    $params['SignatureVersion']       = '2';
    $params['Timestamp']              = gmdate('Y-m-d\TH:i:s\Z');
    $params['Version']                = '2009-01-01';
    $params['MarketplaceIdList.Id.1'] = $this->marketplace_id;
    $params['ReportType']             = $this->AmazonMWS->getReportType($reportType);
    $response
      = $this->AmazonMWS->fetch($params, $this->mws_base_url, $this->mws_secret_key, $jobType);
    if(isset($response->RequestReportResult->ReportRequestInfo->ReportRequestId)) {
      $this->Flash->success(__('Success: MWS RequestReport completed!'));
      $ReportRequestId = $response->RequestReportResult->ReportRequestInfo->ReportRequestId;
    } else {
      $this->Flash->error(__('Error: MWS RequestReport can\'t get RequestId.'));
    }
    return $ReportRequestId;
  }

  public function getreportrequestlist() {
    $jobtype = 2;
    $params = array();
    $params['AWSAccessKeyId']           = $this->mws_access_key;
    $params['Action']                   = 'GetReportRequestList';
    $params['SellerId']                 = $this->mws_seller_id;
    $params['SignatureMethod']          = 'HmacSHA256';
    $params['SignatureVersion']         = '2';
    $params['Timestamp']                = gmdate('Y-m-d\TH:i:s\Z');
    $params['Version']                  = '2009-01-01';
    $params['ReportRequestIdList.Id.1'] = '';
    $response
      = $this->AmazonMWS->fetch($params, $this->mws_base_url, $this->mws_secret_key, $jobType);
    if(isset($response->GetReportRequestListResult->ReportRequestInfo->ReportProcessingStatus)) {
      $ReportProcessingStatus
        = $response->GetReportRequestListResult->ReportRequestInfo->ReportProcessingStatus;
      if($ReportProcessingStatus == '_DONE_') {
        $this->Flash->success(__('Success: MWS GetReportRequestList completed!'));
        $GeneratedReportId
          = $response->GetReportRequestListResult->ReportRequestInfo->GeneratedReportId;
      }
    } else {
      $this->Flash
        ->error(__('Error: MWS GetReportRequestList con\'t get ReportProcessingStatus.'));
    }
    return $GeneratedReportId;
  }

  public function getreport() {
    $jobtype = 2;
    $params = array();
    $params['AWSAccessKeyId']   = $this->mws_access_key;
    $params['Action']           = 'GetReport';
    $params['SellerId']         = $this->mws_seller_id;
    $params['SignatureMethod']  = 'HmacSHA256';
    $params['SignatureVersion'] = '2';
    $params['Timestamp']        = gmdate('Y-m-d\TH:i:s\Z');
    $params['Version']          = '2009-01-01';
    $params['ReportId']         = '';
    $response
      = $this->AmazonMWS->fetch($params, $this->mws_base_url, $this->mws_secret_key, $jobType);
    if($response == 1) {
      $this->Flash->success(__('Success: MWS GetReport completed!'));
    } else {
      $this->Flash->error(__('Error: MWS GetReport con\'t get status.'));
    }
    return $response;
  }

  public function submitfeed() {
    $jobType = 2;
    $allChange = false;
    $params = array();
    $params['AWSAccessKeyId']         = $this->mws_access_key;
    $params['Action']                 = 'SubmitFeed';
    $params['SellerId']               = $this->mws_seller_id;
    $params['SignatureMethod']        = 'HmacSHA256';
    $params['SignatureVersion']       = '2';
    $params['Timestamp']              = gmdate('Y-m-d\TH:i:s\Z');
    $params['Version']                = '2009-01-01';
    $params['MarkerplaceIdList.Id.1'] = $this->marketplace_id;
    $params['FeedType']               = $this->AmazonMWS->getFeedType($jobType);
    $params['PurgeAndReplace']        = $this->AmazonMWS->getPurgeAndReplace($jobType, $allChange);
    $response
      = $this->AmazonMWS->upload($params, $this->mws_base_url, $this->mws_secret_key, $jobType);
    if(isset($response->SubmitFeedResult->FeedSubmitInfo->FeedSubmissionId)) {
      $this->Flash->success(__('Success: MWS SubmitFeed completed!'));
      $FeedSubmissionId = $response->SubmitFeedResult->FeedSubmissionInfo->FeedSubmissionId;
    } else {
      $this->Flash->error(__('Error: MWS SubmitFeed con\'t get response.'));
    }
    return $FeedSubmissionId;
  }


  public function getfeedsubmissionlist()
  {
    $jobType = 1;
    $params = array();
    $params['AWSAccessKeyId']             = $this->mws_access_key;
    $params['Action']                     = 'GetFeedSubmissionList';
    $params['SellerId']                   = $this->mws_seller_id;
    $params['SignatureMethod']            = 'HmacSHA256';
    $params['SignatureVersion']           = '2';
    $params['Timestamp']                  = gmdate('Y-m-d\TH:i:s\Z');
    $params['Version']                    = '2009-01-01';
    $params['FeedSubmissionIdList.Id.1']  = '';
    $response
      = $this->AmazonMWS->fetch($params, $this->mws_base_url, $this->mws_secret_key, $jobType);
    if(isset($response->GetFeedSubmissionListResult->FeedSubmissionInfo->FeedProcessingStatus)) {
      $FeedProcessingStatus
        = $response->GetFeedSubmissionListResult->FeedSubmissionInfo->FeedProcessingStatus;
      if($FeedProcessingStatus == '_DONE_') {
        $this->Flash->success(__('Success: MWS GetFeedSubmittionList completed!'));
      }
    } else {
      $this->Flash->error(__('Error: MWS GetFeedSubmissionList con\'t get response.'));
    }
    return $FeedProcessingStatus;
  }

  public function getfeedsubmissionresult()
  {
    $jobType = 1;
    $params = array();
    $params['AWSAccessKeyId']    = $this->mws_access_key;
    $params['Action']            = 'GetFeedSubmissionResult';
    $params['SellerId']          = $this->mws_seller_id;
    $params['SignatureMethod']   = 'HmacSHA256';
    $params['SignatureVersion']  = '2';
    $params['Timestamp']         = gmdate('Y-m-d\TH:i:s\Z');
    $params['Version']           = '2009-01-01';
    $params['FeedSubmissionId']  = '';
    $response
      = $this->AmazonMWS->upload($params, $this->mws_base_url, $this->mws_secret_key, $jobType);
    $this->Flash->success(__('Success: MWS GetFeedSubmissionResult completed!'));
    return $response;
  }

  public function listorders()
  {
    $jobType = 1;
    $fromGetDat = 3;
    $params = array();
    $params['AWSAccessKeyId']         = $this->mws_access_key;
    $params['Action']                 = 'ListOrders';
    $params['SellerId']               = $this->mws_seller_id;
    $params['SignatureMethod']        = 'HmacSHA256';
    $params['SignatureVersion']       = '2';
    $params['Timestamp']              = gmdate('Y-m-d\TH:i:s\Z');
    $params['Version']                = '2013-09-01';
    $params['MarkerplaceIdList.Id.1'] = $this->marketplace_id;
    $params['LastUpdatedAfter']       = gmdate('Y-m-d\TH:i:s\Z', strtotime("- $fromGetDay day"));
    $baseurl = $this->mws_base_url . 'Orders/' . $params['Version'];
    $response
      = $this->AmazonMWS->fetch($params, $baseurl, $this->mws_secret_key, $jobType);
    $getOrderId = '';
    foreach($response->ListOrdersResult->Orders->Order as $Order) {
      $getOrderId = $getOrderId . $Order->AmazonOrderId . ':';
    }
    $this->Flash->success(__('Success: MWS ListOrders completed!'));
    return $getOrderId;
  }
  
  public function upload($params, $baseurl, $secret_key, $jobType=0)
  {
    $query = $this->create_query($params);
    $signature = $this->create_signature($baseurl, $query, $secret_key, $jobType);
    $url = $this->create_url($baseurl, $query, $signature);
    $handle = $this->openfile();
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

  private function openfile()
  {
    $handleFile = @open('php://temp', 'rw+');
    fwirte($handleFile);
    return $handleFile;
  }
}
