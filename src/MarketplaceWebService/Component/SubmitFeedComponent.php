<?php
namespace MarketplaceWebService\Component;

include_once dirname(__FILE__) . '/../Sample/.config.inc.php';

use MarketplaceWebService\MarketplaceWebService_Client;
use MarketplaceWebService\MarketplaceWebService_Interface;
use MarketplaceWebService\MarketplaceWebService_Exception;
use MarketplaceWebService\Model\MarketplaceWebService_Model_SubmitFeedRequest;
use MarketplaceWebService\Model\MarketplaceWebService_Model_GetFeedSubmissionListRequest;
use MarketplaceWebService\Model\MarketplaceWebService_Model_StatusList;
use MarketplaceWebService\Model\MarketplaceWebService_Model_GetFeedSubmissionResultRequest;

class SubmitFeedComponent
{
  public function __construct($params) 
  {
    $this->service_url = $params['BaseURL'];
    $this->marketplace = $params['Marketplace'];
    $this->seller_id   = $params['SellerId'];
    $this->access_key  = $params['AWSAccessKeyId'];
    $this->secret_key  = $params['AWSSecretKeyId'];
    $this->app_name    = env('APP_NAME');
    $this->app_version = env('APP_VERSION');
  }

  public function addDel()
  {
    $config = array (
      'ServiceURL' => $this->service_url
    , 'ProxyHost' => null
    , 'ProxyPort' => -1
    , 'MaxErrorRetry' => 3,
    );
    $service = new MarketplaceWebService_Client(
      $this->access_key
    , $this->secret_key
    , $config
    , $this->app_name
    , $this->app_version
    );
    $feed = $this->readFile('_AddDel_');
    $feedId = $this->addDelMerchant($service, $feed);
    $listId = $this->getSubmitFeedList($service, $feedId); 
    $result = $this->getSubmitFeedResult($service, $listId);
    return $result;
  }

  public function update()
  {
    $config = array (
      'ServiceURL' => $this->service_url
    , 'ProxyHost' => null
    , 'ProxyPort' => -1
    , 'MaxErrorRetry' => 3,
    );
    $service = new MarketplaceWebService_Client(
      $this->access_key
    , $this->secret_key
    , $config
    , $this->app_name
    , $this->app_version
    );
    $feed = $this->readFile('_revPrice_');
    $feedId  = $this->reviseMerchant($service, $feed);
    $listId = $this->getSubmitFeedList($service, $feedId); 
    $result = $this->getSubmitFeedResult($service, $listId);
    return $result;
  }

  private function readFile($request)
  {
    $path       = getcwd();
    $outBaseDir = $path . "/storage";
    $dirName    = $path . 'csv'; 
    $res_dir    = opendir( $dirName );
    $dateWord   = date('Ymd');
    while( $file_name = readdir( $res_dir ) ){
      if ( strstr($file_name, $dateWord) and strstr($file_name, $request) ) {
        $fullName = $dirName . "/" . $file_name;
        $feed = file_get_contents($fullName);
        $dstFullName = $dirName . "/" . $dateWord . "loaded/" .$file_name;
        rename($fullName, $dstFullName);
      }
    }
    closedir( $res_dir );
    return $feed;
  }

  private function addDelMerchant($service, $feed)
  {
    $marketplaceIdArray = array(
      "Id" => array($this->marketplace)
    );
    $feedHandle = @fopen('php://temp', 'rw+');
    fwrite($feedHandle, $feed);
    rewind($feedHandle);
    $request = new MarketplaceWebService_Model_SubmitFeedRequest();
    $request->setMerchant($this->seller_id);
    $request->setMarketplaceIdList($marketplaceIdArray);
    $request->setFeedType('_POST_FLAT_FILE_INVLOADER_DATA_');
    $request->setContentMd5(base64_encode(md5(stream_get_contents($feedHandle), true)));
    rewind($feedHandle);
    $request->setPurgeAndReplace(false);
    $request->setFeedContent($feedHandle);
    rewind($feedHandle);
    $addSubFeedId = invokeSubmitFeed($service, $request);
    @fclose($feedHandle);
    return $addSubFeedId;
  }

  private function reviseMerchant($service, $feed)
  {
    $marketplaceIdArray = array(
      "Id" => array($this->marketplace)
    );
    $feedHandle = @fopen('php://temp', 'rw+');
    fwrite($feedHandle, $feed);
    rewind($feedHandle);
    $request = new MarketplaceWebService_Model_SubmitFeedRequest();
    $request->setMerchant($this->seller_id);
    $request->setMarketplaceIdList($marketplaceIdArray);
    $request->setFeedType('_POST_FLAT_FILE_PRICEANDQUANTITYONLY_UPDATE_DATA_');
    $request->setContentMd5(base64_encode(md5(stream_get_contents($feedHandle), true)));
    rewind($feedHandle);
    $request->setPurgeAndReplace(false);
    $request->setFeedContent($feedHandle);
    rewind($feedHandle);
    $revSubFeedId = invokeSubmitFeed($service, $request);
    @fclose($feedHandle);
    return $revSubFeedId;
  }

  private function getSubmitFeedList($service, $feedId)
  {
    $request = new MarketplaceWebService_Model_GetFeedSubmissionListRequest();
    $request->setMerchant($this->seller_id);
    $statusList = new MarketplaceWebService_Model_StatusList();
    $request->setFeedProcessingStatusList($statusList->withStatus('_DONE_'));
    while (true){
      print date( "Y年n月j日  G時i分s秒\t ID=" ) . $feedId;
      $getSubId = $this->invokeGetFeedSubmissionList($service, $request, $feedId);
      if ($feedId === $getSubId) break;
      sleep(180);
    }
    return $getSubId;
  }

  private function getSubmitFeedResult($service, $listId)
  {
    $outDir = sprintf('%s/%s', $outBaseDir, date('Y'));
    if (!is_dir($outDir)) {
      if (!mkdir($outDir, 0777, true)) {
        die('Failed to create output Directory [makdir]...');
      }
    }
    $filename = sprintf('%s/Result_%s_%s.txt', $outDir, date('Ymd'), date('His'));
    $resultFilename = @fopen($filename, 'a+');
    $request = new MarketplaceWebService_Model_GetFeedSubmissionResultRequest();
    $request->setMerchant($this->seller_id);
    $request->setFeedSubmissionId($listId);
    $request->setFeedSubmissionResult($resultFilename);
    print date( "Y年n月j日  G時i分s秒\t ID=" ) . $listId;
    $resopnse = $this->invokeGetFeedSubmissionResult($service, $request);
    @fclose($filename);
    return $response;
  }

  private function invokeSubmitFeed (
    MarketplaceWebService_Interface $service, $request
  ) {
    $getFeedSubId_f = 0;
    try {
      $response = $service->submitFeed($request);
      printf ("Service Response\n");
      printf ("================\n");
      print date( "Y" ) . "年" . date( "n月j日  G時i分s秒\t" );
      printf("SubmitFeedResponse\n");
      if ($response->isSetSubmitFeedResult()) { 
        printf("SubmitFeedResult\n");
        $submitFeedResult = $response->getSubmitFeedResult();
        if ($submitFeedResult->isSetFeedSubmissionInfo()) { 
          printf("FeedSubmissionInfo\n");
          $feedSubmissionInfo = $submitFeedResult->getFeedSubmissionInfo();
          if ($feedSubmissionInfo->isSetFeedSubmissionId()) 
          {
            printf("FeedSubmissionId\n");
            printf($feedSubmissionInfo->getFeedSubmissionId()."\n");
            $getFeedSubId_f = $feedSubmissionInfo->getFeedSubmissionId();
          }
          if ($feedSubmissionInfo->isSetFeedType()) 
          {
            printf("FeedType\n");
            printf($feedSubmissionInfo->getFeedType()."\n");
          }
          if ($feedSubmissionInfo->isSetSubmittedDate()) 
          {
            printf("SubmittedDate\n");
            printf($feedSubmissionInfo->getSubmittedDate()
              ->format(DATE_FORMAT)."\n");
          }
          if ($feedSubmissionInfo->isSetFeedProcessingStatus()) 
          {
            printf("FeedProcessingStatus\n");
            printf($feedSubmissionInfo->getFeedProcessingStatus()."\n");
          }
          if ($feedSubmissionInfo->isSetStartedProcessingDate()) 
          {
            printf("StartedProcessingDate\n");
            printf($feedSubmissionInfo->getStartedProcessingDate()
              ->format(DATE_FORMAT)."\n");
          }
          if ($feedSubmissionInfo->isSetCompletedProcessingDate()) 
          {
            printf("CompletedProcessingDate\n");
            printf($feedSubmissionInfo->getCompletedProcessingDate()
              ->format(DATE_FORMAT)."\n");
          }
        } 
      } 
      if ($response->isSetResponseMetadata()) { 
        printf("ResponseMetadata\n");
        $responseMetadata = $response->getResponseMetadata();
        if ($responseMetadata->isSetRequestId()) 
        {
          printf("RequestId\n");
          printf("" . $responseMetadata->getRequestId() . "\n");
          printf("RequestId\t");
          printf($responseMetadata->getRequestId() . "\n");
        }
      } 
      printf("ResponseHeaderMetadata: " . $response->getResponseHeaderMetadata() . "\n");
      return $getFeedSubId_f;
    } catch (MarketplaceWebService_Exception $ex) {
      printf("Caught Exception: " . $ex->getMessage() . "\n");
      printf("Response Status Code: " . $ex->getStatusCode() . "\n");
      printf("Error Code: " . $ex->getErrorCode() . "\n");
      printf("Error Type: " . $ex->getErrorType() . "\n");
      printf("Request ID: " . $ex->getRequestId() . "\n");
      printf("XML: " . $ex->getXML() . "\n");
      printf("ResponseHeaderMetadata: " . $ex->getResponseHeaderMetadata() . "\n");
    }
  }

  private function invokeGetFeedSubmissionList(
    MarketplaceWebService_Interface $service, $request, $recFeedSubId
  ) {
    $checkSubFeedId = 0;
    try {
      $response = $service->getFeedSubmissionList($request);
      printf ("Service Response\n");
      printf ("================\n");
      printf ("GetFeedSubmissionListResponse\n");
      if ($response->isSetGetFeedSubmissionListResult()) { 
        printf("GetFeedSubmissionListResult\n");
        $getFeedSubmissionListResult = $response->getGetFeedSubmissionListResult();
        if ($getFeedSubmissionListResult->isSetNextToken()) 
        {
          printf("NextToken\n");
          printf($getFeedSubmissionListResult->getNextToken() . "\n");
        }
        if ($getFeedSubmissionListResult->isSetHasNext()) 
        {
          printf("HasNext\n");
          printf($getFeedSubmissionListResult->getHasNext() . "\n");
        }
        $feedSubmissionInfoList = $getFeedSubmissionListResult->getFeedSubmissionInfoList();
        foreach ($feedSubmissionInfoList as $feedSubmissionInfo) {
          printf("FeedSubmissionInfo\n");
          if ($feedSubmissionInfo->isSetFeedSubmissionId()) 
          {
            printf("FeedSubmissionId\n");
            printf($feedSubmissionInfo->getFeedSubmissionId() . "\n");
            if ( $recFeedSubId == $feedSubmissionInfo->getFeedSubmissionId() ) {
              $checkSubFeedId = $feedSubmissionInfo->getFeedSubmissionId();
            }
          }
          if ($feedSubmissionInfo->isSetFeedType()) 
          {
            printf("FeedType\n");
            printf($feedSubmissionInfo->getFeedType() . "\n");
          }
          if ($feedSubmissionInfo->isSetSubmittedDate()) 
          {
            printf("SubmittedDate\n");
            printf($feedSubmissionInfo->getSubmittedDate()->format(DATE_FORMAT) . "\n");
          }
          if ($feedSubmissionInfo->isSetFeedProcessingStatus()) 
          {
            printf("FeedProcessingStatus\n");
            printf($feedSubmissionInfo->getFeedProcessingStatus() . "\n");
          }
          if ($feedSubmissionInfo->isSetStartedProcessingDate()) 
          {
            printf("StartedProcessingDate\n");
            printf($feedSubmissionInfo->getStartedProcessingDate()->format(DATE_FORMAT)."\n");
          }
          if ($feedSubmissionInfo->isSetCompletedProcessingDate()) 
          {
            printf("CompletedProcessingDate\n");
            printf($feedSubmissionInfo->getCompletedProcessingDate()
              ->format(DATE_FORMAT)."\n");
          }
        }
      } 
      if ($response->isSetResponseMetadata()) { 
        printf("ResponseMetadata\n");
        $responseMetadata = $response->getResponseMetadata();
        if ($responseMetadata->isSetRequestId()) 
        {
          printf("RequestId\n");
          printf($responseMetadata->getRequestId() . "\n");
        }
      } 
      printf("ResponseHeaderMetadata: " . $response->getResponseHeaderMetadata() . "\n");
      return $checkSubFeedId;
    } catch (MarketplaceWebService_Exception $ex) {
      printf("Caught Exception: " . $ex->getMessage() . "\n");
      printf("Response Status Code: " . $ex->getStatusCode() . "\n");
      printf("Error Code: " . $ex->getErrorCode() . "\n");
      printf("Error Type: " . $ex->getErrorType() . "\n");
      printf("Request ID: " . $ex->getRequestId() . "\n");
      printf("XML: " . $ex->getXML() . "\n");
      printf("ResponseHeaderMetadata: " . $ex->getResponseHeaderMetadata() . "\n");
    }
  }
 
  private function invokeGetFeedSubmissionResult(
    MarketplaceWebService_Interface $service, $request
  ) {
    try {
      $response = $service->getFeedSubmissionResult($request);
      printf ("Service Response\n");
      printf ("================\n");
      printf("GetFeedSubmissionResultResponse\n");
      if ($response->isSetGetFeedSubmissionResultResult()) {
        $getFeedSubmissionResultResult = $response->getGetFeedSubmissionResultResult(); 
        printf ("GetFeedSubmissionResult");
        if ($getFeedSubmissionResultResult->isSetContentMd5()) {
          printf ("ContentMd5");
          printf ($getFeedSubmissionResultResult->getContentMd5() . "\n");
        }
      }
      if ($response->isSetResponseMetadata()) { 
        printf("ResponseMetadata\n");
        $responseMetadata = $response->getResponseMetadata();
        if ($responseMetadata->isSetRequestId()) 
        {
          printf("RequestId\n");
          printf($responseMetadata->getRequestId() . "\n");
        }
      } 
      printf("ResponseHeaderMetadata: " . $response->getResponseHeaderMetadata() . "\n");
    } catch (MarketplaceWebService_Exception $ex) {
      printf("Caught Exception: " . $ex->getMessage() . "\n");
      printf("Response Status Code: " . $ex->getStatusCode() . "\n");
      printf("Error Code: " . $ex->getErrorCode() . "\n");
      printf("Error Type: " . $ex->getErrorType() . "\n");
      printf("Request ID: " . $ex->getRequestId() . "\n");
      printf("XML: " . $ex->getXML() . "\n");
      printf("ResponseHeaderMetadata: " . $ex->getResponseHeaderMetadata() . "\n");
    }
  }
}
