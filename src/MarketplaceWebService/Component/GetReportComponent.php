<?php
namespace MarketplaceWebService\Component;

include_once dirname(__FILE__) . '/../Samples/.config.inc.php';

use MarketplaceWebService\MarketplaceWebService_Client;
use MarketplaceWebService\MarketplaceWebService_Interface;
use MarketplaceWebService\MarketplaceWebService_Exception;
use MarketplaceWebService\Model\MarketplaceWebService_Model_RequestReportRequest;
use MarketplaceWebService\Model\MarketplaceWebService_Model_GetReportRequestListRequest;
use MarketplaceWebService\Model\MarketplaceWebService_Model_GetReportRequest;

class GetReportComponent
{
  private const MWS_MARKETPLACE_JP = 'A1VC38T7YXB528';
  private const MWS_MARKETPLACE_US = 'ATVPDKIKX0DER';
  private const MWS_MARKETPLACE_AU = 'A39IBJ37TRP1C6';

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

  public function fetch() {
    $config = array (
      'ServiceURL' => $this->service_url,
      'ProxyHost' => null,
      'ProxyPort' => -1,
      'MaxErrorRetry' => 3,
    );
    $service = new MarketplaceWebService_Client(
      $this->access_key, 
      $this->secret_key, 
      $config,
      $this->app_name,
      $this->app_version
    );
    $request_id     = $this->getRequestId($service);
    $generated_id   = $this->getGeneratedId($service, $request_id);
    $content        = $this->getRequestResult($service, $generated_id);
    $filename       = $this->createFile($content);
    $result         = $this->setReport($content);
    printf('Filename:'    . $filename . "\n");
    printf('Generate ID:' . $generated_id . "\n");
    printf('Request  ID:' . $request_id . "\n");
    //print_r($result);
    return $result;
  }

  private function getRequestId($service)
  {
    $marketplaceIdArray = array(
      "Id"                => array($this->marketplace)
    );
    $parameters = array (
      'Merchant'          => $this->seller_id
    , 'MarketplaceIdList' => $marketplaceIdArray
    , 'ReportType'        => '_GET_MERCHANT_LISTINGS_DATA_'
    , 'ReportOptions'     => 'ShowSalesChannel=true'
    //, 'StartDate'         => '2018-05-26T00:00:00',
    //  'EndDate'           => '2018-05-31T00:00:00'
    );
    $request = new MarketplaceWebService_Model_RequestReportRequest($parameters);
    return $this->invokeRequestReport($service, $request);
  }

  private function getGeneratedId($service, $request_id) {
    $parameters = array (
      'Merchant'          => $this->seller_id
    );
    $request = new MarketplaceWebService_Model_GetReportRequestListRequest($parameters);
    while (true){
      list($request_status, $generated_id)
        = $this->invokeGetReportRequestList($service, $request, $request_id);
      if ( $request_status === "_DONE_") break;
      sleep(180);
    }
    return $generated_id;
  }

  private function getRequestResult($service, $generated_id)
  {
    $parameters = array (
      'Merchant'          => $this->seller_id,
      'Report'            => @fopen('php://memory', 'rw+'),
      'ReportId'          => $generated_id,
    );
    $request = new MarketplaceWebService_Model_GetReportRequest($parameters);
    $getReportCont = $this->invokeGetReport($service, $request);
    return $getReportCont;
  }

  private function invokeRequestReport(MarketplaceWebService_Interface $service, $request)
  {
    try {
      $response = $service->requestReport($request);
      //print_r($response);
      if ($response->isSetRequestReportResult()) { 
        $requestReportResult = $response->getRequestReportResult();
        if ($requestReportResult->isSetReportRequestInfo()) {
          $reportRequestInfo = $requestReportResult->getReportRequestInfo();
          if ($reportRequestInfo->isSetReportRequestId()) {
            print date( "Y" ) . "年" . date( "n月j日  G時i分s秒\t" );
            printf("ReportRequestId\t");
            printf($reportRequestInfo->getReportRequestId() . "\n");
          }
        }
      }
      return $reportRequestInfo->getReportRequestId();
    } catch (MarketplaceWebService_Exception $ex) {
      print ("** invoke RequestReport !**\n");
      print date( "Y" ) . "年" . date( "n月j日  G時i分s秒\n" );
      printf("Caught Exception: " . $ex->getMessage() . "\n");
      printf("Response Status Code: " . $ex->getStatusCode() . "\n");
      printf("Error Code: " . $ex->getErrorCode() . "\n");
      printf("Error Type: " . $ex->getErrorType() . "\n");
      printf("Request ID: " . $ex->getRequestId() . "\n");
      printf("XML: " . $ex->getXML() . "\n");
      printf("ResponseHeaderMetadata: " . $ex->getResponseHeaderMetadata() . "\n");
    }
  }

  private function invokeGetReportRequestList(
    MarketplaceWebService_Interface $service, $request, $procRequestId
  ) {
    try {
      $curStatus = '';
      $response = $service->getReportRequestList($request);
      if ($response->isSetGetReportRequestListResult()) { 
        $getReportRequestListResult = $response->getGetReportRequestListResult();
        $reportRequestInfoList = $getReportRequestListResult->getReportRequestInfoList();
        foreach ($reportRequestInfoList as $reportRequestInfo) {
          if ($reportRequestInfo->isSetReportRequestId()) {
            $curRequestId = $reportRequestInfo->getReportRequestId();
            if ( $curRequestId == $procRequestId ) {
              printf("ReportRequestId\t");
              printf($reportRequestInfo->getReportRequestId() );
              if ($reportRequestInfo->isSetReportProcessingStatus()) {
                print "\t" . date( "Y" ) . "年" . date( "n月j日  G時i分s秒\t" );
                printf("\tReportProcessingStatus\t");
                printf($reportRequestInfo->getReportProcessingStatus() . "\n");
                $curStatus = $reportRequestInfo->getReportProcessingStatus();
              }
              if ($reportRequestInfo->isSetGeneratedReportId()) {
                print "\t" . date( "Y" ) . "年" . date( "n月j日  G時i分s秒\t" );
                printf("GeneratedReportId\t");
                printf($reportRequestInfo->getGeneratedReportId() . "\n");
                $curGeneratedReportId = $reportRequestInfo->getGeneratedReportId();
              }
            }
          }
        }
      }
      debug($curStatus);
      if (isset($curGeneratedReportId)){
        return array($curStatus, $curGeneratedReportId);
      } else {
        return array($curStatus, 1);
      }
    } catch (MarketplaceWebService_Exception $ex) {
      print ("** invoke GetReportRequestList !**\n");
      print date( "Y" ) . "年" . date( "n月j日  G時i分s秒\n" );
      printf("Caught Exception: " . $ex->getMessage() . "\n");
      printf("Response Status Code: " . $ex->getStatusCode() . "\n");
      printf("Error Code: " . $ex->getErrorCode() . "\n");
      printf("Error Type: " . $ex->getErrorType() . "\n");
      printf("Request ID: " . $ex->getRequestId() . "\n");
      printf("XML: " . $ex->getXML() . "\n");
      printf("ResponseHeaderMetadata: " . $ex->getResponseHeaderMetadata() . "\n");
    }
  }

  private function invokeGetReport(MarketplaceWebService_Interface $service, $request)
  {
    try {
      $response = $service->getReport($request);
      if ( $response->getResponseHeaderMetadata() ) {
        print date( "Y" ) . "年" . date( "n月j日  G時i分s秒\n" );
        printf("ResponseHeaderMetadata: " . $response->getResponseHeaderMetadata() . "\n");
      }
      return stream_get_contents($request->getReport());
    } catch (MarketplaceWebService_Exception $ex) {
      print ("** invoke GetReport !**\n");
      print date( "Y" ) . "年" . date( "n月j日  G時i分s秒\n" );
      printf("Caught Exception: " . $ex->getMessage() . "\n");
      printf("Response Status Code: " . $ex->getStatusCode() . "\n");
      printf("Error Code: " . $ex->getErrorCode() . "\n");
      printf("Error Type: " . $ex->getErrorType() . "\n");
      printf("Request ID: " . $ex->getRequestId() . "\n");
      printf("XML: " . $ex->getXML() . "\n");
      printf("ResponseHeaderMetadata: " . $ex->getResponseHeaderMetadata() . "\n");
    }
  }

  private function createFile($content)
  {
    $path = getcwd();
    $basedir = $path . "/storage";   // JP
    $outDir = sprintf('%s/%s', $basedir, date('Y'));
    if (!is_dir($outDir)) {
      if (!mkdir($outDir, 0777, true)) {
        die('Failed to create output Directory [mkdir]...');
      }
    }
    $filename = sprintf('%s/List_%s_%s.csv', $outDir, date('Ymd'), date('His'));
    $fp = fopen( $filename , 'w');
    fwrite($fp, $this->encode($content));
    fclose($fp);
    return $filename;
  }
 
  private function setReport($content)
  {
    $datas = array();
    $header = array(               //     JP  AU  US
      'item-name'                  //     o   o   o
    , 'item-description'           //     -   o   o
    , 'listing-id'                 //     o   o   o
    , 'seller-sku'                 //     o   o   o
    , 'price'                      //     o   o   o
    , 'quantity'                   //     o   o   o
    , 'open-date'                  //     o   o   o
    , 'image-url'                  //     -   o   o
    , 'item-is-marketplace'        //     -   o   o
    , 'product-id-type'            //     o   o   o
    , 'zshop-shipping-fee'         //     -   o   o
    , 'item-note'                  //     o   o   o
    , 'item-condition'             //     o   o   o
    , 'zshop-category1'            //     -   o   o
    , 'zshop-browse-path'          //     -   o   o
    , 'zshop-storefront-feature'   //     -   o   o
    , 'asin1'                      //     -   o   o
    , 'asin2'                      //     -   o   o
    , 'asin3'                      //     -   o   o
    , 'will-ship-internationally'  //     o   o   o
    , 'expedited-shipping'         //     o   o   o
    , 'zshop-boldface'             //     -   o   o
    , 'product-id'                 //     o   o   o
    , 'bid-for-featured-placement' //     -   o   o
    , 'add-delete'                 //     -   o   o
    , 'pending-quantity'           //     o   o   o
    , 'fulfillment-channel'        //     o   o   o
    , 'merchant-shipping-group'    //     -   o   o
    , 'point'                      //     o   -   -
    );

    switch($this->marketplace) {
    case self::MWS_MARKETPLACE_JP:
      $column = array(
         TRUE,FALSE, TRUE, TRUE, TRUE, TRUE, TRUE,FALSE,FALSE, TRUE,FALSE, TRUE, TRUE
      , FALSE,FALSE,FALSE,FALSE,FALSE,FALSE, TRUE, TRUE,FALSE, TRUE,FALSE,FALSE, TRUE
      ,  TRUE,FALSE, TRUE
      );
      break;
    case self::MWS_MARKETPLACE_AU:
      $column = array(
         TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE
      ,  TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE
      ,  TRUE, TRUE,FALSE
      );
      break;
    case self::MWS_MARKETPLACE_US:
      $column = array(
         TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE
      ,  TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE
      ,  TRUE, TRUE,FALSE
      );
      break;
    default:
      return $datas;
    }
    
    $record = str_getcsv($content, "\n");
    unset($record[0]);
    foreach($record as $_record) {
      $data = array();
      $row = str_getcsv($_record, "\t");
      $idx = 0; $_idx = 0;
      foreach($header as $_header) {
        if($column[$_idx]) {
          $body = $row[$idx] !== '' ? $this->encode($row[$idx]) : null;
          $idx += 1;
          $_idx += 1;
        } else {
          $body = null;
          $_idx += 1;
        }
        //printf("header: [ %s ],\t value: [ %s ].\n", $_header, $body);
        $data[$_header] = $body;
      }
      array_push($datas, $data);
    }
    return $datas;
  }

  private function encode($content)
  {
    return mb_convert_encoding($content, 'utf8', 'sjis-win');
  }
};
