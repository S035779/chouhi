<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use ApaiIO\Configuration\GenericConfiguration;
use ApaiIO\Configuration\Country;
use ApaiIO\Operations\Search;
use ApaiIO\Operations\SimilarityLookup;
use ApaiIO\Operations\Lookup;
use ApaiIO\Operations\BrowseNodeLookup;
use ApaiIO\ResponseTransformer\XmlToArray;
use ApaiIO\ApaiIO;

/**
 * Sample Controller
 */
class SampleController extends AppController
{

  //public $helpers = [
  //  'Form' => [
  //    'templates' => 'Templates/form-templates'
  //  , 'widgets'   => ['datepicker' => ['DatePicker']]
  //  ]
  //];

  public function initialize()
  {
    parent::initialize();
    $this->viewBuilder()->setLayout('default');
    //$this->loadComponent('Common', ['className' => 'MyHoge']);
    $this->loadComponent('Common');
    $this->loadComponent('AmazonMWS');
    $this->access_key       = env('AMZ_PA_ACCESSKEY_JP2', '');
    $this->secret_key       = env('AMZ_PA_SECRETKEY_JP2', '');
    $this->associ_tag       = env('AMZ_PA_ASSOCITAG_JP2', '');
    $this->mws_access_key   = env('AMZ_MWS_ACCESSKEY_JP2', '');
    $this->mws_secret_key   = env('AMZ_MWS_SECRETKEY_JP2', '');
    $this->mws_seller_id    = env('AMZ_MWS_SELLER_ID_JP2', '');
    $this->marketplace_id   = $this->Common::MWS_MARKETPLACE_JP;
    $this->mws_base_url     = $this->Common::MWS_BASEURL_JP;
    //echo ("<p>MWS AccessKey" . $this->mws_access_key . "</p>");
    //echo ("<p>MWS SecretKey" . $this->mws_secret_key . "</p>");
  }

  public function beforeFilter(Event $event)
  {
    parent::beforeFilter($event);
    //$this->AUth->allow(['']);
  }

  public function isAuthorized($user) {
    $this->user = $user;
    return true;
  }

  public function getUser() {
    return $this->user;
  }

  public function index()
  {
    $title = "WatchNote!! Start Page.";
    //$this->viewBuilder()->getLayout(false);
    //$this->autoLayout = false;
    $maxim_en = 'I will prepare and some day my chance will come.';
    $maxim_jp = '準備しておこう。チャンスはいつか訪れるものだ。';
    $maxim_person = 'Abraham Lincoln （エイブラハム・リンカーン）';
    $this->set(compact('title', 'maxim_en', 'maxim_jp', 'maxim_person'));

    //$number = 20;
    //$ret1 = $this->AmazonMWS->abcd($number);
    //$ret2 = $this->AmazonMWS->efgh()['name'];
    //$ret3 = $this->AmazonMWS->plusMethod();
    //print_r($ret1);
    //print_r($ret2);
    //print_r($ret3);

  }

  public function search() {
    $title = "Amazon Item Search";
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
    $this->set(compact('title', 'response'));
  }

  public function similarity() {
    $title = "Amazon Simple Similarity Lookup";
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
    $this->set(compact('title', 'response'));
  }

  public function lookup() {
    $title = "Amazon Simple Lookup";
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
    $this->set(compact('title', 'response'));
  }

  public function nodelookup() {
    $title = "Amazon Browse Node Lookup";
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
    $this->set(compact('title', 'response'));
  }

  public function getmatchingproductforid() {
    $title = "Amazon Get Matching Product For Id";
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
    $this->set(compact('title', 'response'));
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
    $this->set(compact('getLowestPrice'));
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
    $this->set(compact('ReportRequestId'));
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
    $this->set(compact('GeneratedReportId'));
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
    $this->set(compact('response'));
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
    $this->set(compact('FeedSubmissionId'));
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
    $this->set(compact('FeedProcessingStatus'));
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
    $this->set(compact('response'));
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
    $this->set(compact('getOrderId'));
  }
}
