<?php
/** 
 *  Marketplace Web Service PHP5 Library
 *  Generated: Thu May 07 13:07:36 PDT 2009
 */

include_once ('.config.inc.php');

// 現在のディレクトリ（パス）を取得する
$path = getcwd();

// ディレクトリを指定する。
// 今回は現在のディレクトリ配下に"List"というフォルダに入れる。（ディレクトリは作成済）
$outBaseDir = $path . "/_JP"; // JP
//$outBaseDir = $path . "/_AU"; // AU
//$outBaseDir = $path . "/_US"; // US

$dirName = $path . 'csv'; 

// USのAmazonに出品しているのでUSのエンドポイントを設定
$serviceUrl = "https://mws.amazonservices.jp";
//$serviceUrl = "https://mws.amazonservices.com.au"; 
//$serviceUrl = "https://mws.amazonservices.com";

// HTTPの設定
$config = array (
  'ServiceURL' => $serviceUrl,
  'ProxyHost' => null,
  'ProxyPort' => -1,
  'MaxErrorRetry' => 3,
);

// ****************************基本パラメータ設定***************************
 $service = new MarketplaceWebService_Client(
     AWS_ACCESS_KEY_ID, 
     AWS_SECRET_ACCESS_KEY, 
     $config,
     APPLICATION_NAME,
     APPLICATION_VERSION);
 $marketplaceIdArray = array("Id" => array('A1VC38T7YXB528')); // JP
 //$marketplaceIdArray = array("Id" => array('A39IBJ37TRP1C6')); // AU
 //$marketplaceIdArray = array("Id" => array('ATVPDKIKX0DER')); // US

// ★★★★★★★★★★★★★★★★★★★SubmitFeed★★★★★★★★★★★★★★★★★★★★
// ****************************送信パラメータ取得***************************
//ディレクトリ・ハンドルをオープン
$res_dir = opendir( $dirName );

$dateWord = date('Ymd');
//ディレクトリ内のファイル名を１つずつを取得
while( $file_name = readdir( $res_dir ) ){
  // 今回は日付（例：20140202）と"_AddDel_"と入っているファイル名を送信する
  if ( strstr($file_name, $dateWord) and strstr($file_name, "_AddDel_") ) {  //■■適宜修正■■
    $fullName = $dirName . "/" . $file_name;
    $feed = file_get_contents($fullName);
    // 送信済のファイルを移動する。
    $dstFullName = $dirName . "/" . $dateWord . "loaded/" .$file_name;
    rename($fullName, $dstFullName);
  }
  // 今回は日付（例：20140202）と"_revPrice_"と入っているファイル名を送信する
  if ( strstr($file_name, $dateWord) and strstr($file_name, "_revPrice_") ) {  //■■適宜修正■■
    $fullName = $dirName . "/" . $file_name;
    $feed2 = file_get_contents($fullName);
    // 送信済のファイルを移動する。
    $dstFullName = $dirName . "/" . $dateWord . "loaded/" .$file_name;
    rename($fullName, $dstFullName);
  }
}

//ディレクトリ・ハンドルをクローズ
closedir( $res_dir );

/*****************************Start 追加削除**********************************/
$feedHandle = @fopen('php://temp', 'rw+');
fwrite($feedHandle, $feed);
rewind($feedHandle);

$request = new MarketplaceWebService_Model_SubmitFeedRequest();
$request->setMerchant(MERCHANT_ID);
$request->setMarketplaceIdList($marketplaceIdArray);
$request->setFeedType('_POST_FLAT_FILE_INVLOADER_DATA_');
$request->setContentMd5(base64_encode(md5(stream_get_contents($feedHandle), true)));
rewind($feedHandle);
$request->setPurgeAndReplace(false);
$request->setFeedContent($feedHandle);
rewind($feedHandle);

$addSubFeedId = invokeSubmitFeed($service, $request);

@fclose($feedHandle);
/*****************************End 追加削除**********************************/


/********************************Start 価格改定********************************/
$feedHandle = @fopen('php://temp', 'rw+');
fwrite($feedHandle, $feed2);
rewind($feedHandle);

$request = new MarketplaceWebService_Model_SubmitFeedRequest();
$request->setMerchant(MERCHANT_ID);
$request->setMarketplaceIdList($marketplaceIdArray);
$request->setFeedType('_POST_FLAT_FILE_PRICEANDQUANTITYONLY_UPDATE_DATA_');
$request->setContentMd5(base64_encode(md5(stream_get_contents($feedHandle), true)));
rewind($feedHandle);
$request->setPurgeAndReplace(false);
$request->setFeedContent($feedHandle);
rewind($feedHandle);

$revSubFeedId = invokeSubmitFeed($service, $request);

@fclose($feedHandle);
/**********************************End 価格改定*******************************/

// ★★★★★★★★★★★★★★★★★GetSubmitFeedList★★★★★★★★★★★★★★★★★★
$request = new MarketplaceWebService_Model_GetFeedSubmissionListRequest();
$request->setMerchant(MERCHANT_ID);

$statusList = new MarketplaceWebService_Model_StatusList();
$request->setFeedProcessingStatusList($statusList->withStatus('_DONE_'));

/******************追加削除の状態が完了するまで調査***********************/
while (true){
	print date( "★★★Y年n月j日  G時i分s秒\t追加削除の状態を取得 ID=" ) . $addSubFeedId . "★★★";
	$getSubId = invokeGetFeedSubmissionList($service, $request, $addSubFeedId);
	if ( $addSubFeedId == $getSubId) break;
	sleep(180);
}

/******************価格改定の状態が完了するまで調査***********************/
while (true){
	print date( "★★★Y年n月j日  G時i分s秒\t価格改定の状態を取得 ID=" ) . $addSubFeedId . "★★★";
	$getSubId = invokeGetFeedSubmissionList($service, $request, $revSubFeedId);
	if ( $revSubFeedId == $getSubId) break;
	sleep(180);
}

// ★★★★★★★★★★★★★★★★★GetSubmitFeedResult★★★★★★★★★★★★★★★★★★
// ファイルを開き結果を保存する。
$outDir = sprintf('%s/%s', $outBaseDir, date('Y'));
if (!is_dir($outDir)) {
	if (!mkdir($outDir, 0777, true)) {
		die('Failed to create output Directory [makdir]...');
	}
}
$filename = sprintf('%s/Result_%s_%s.txt', $outDir, date('Ymd'), date('His'));  //■■適宜修正■■

$resultFilname = @fopen($filename, 'a+');

/******************追加削除の実行状態を取得***********************/
$request = new MarketplaceWebService_Model_GetFeedSubmissionResultRequest();
$request->setMerchant(MERCHANT_ID);
$request->setFeedSubmissionId($addSubFeedId);

$request->setFeedSubmissionResult($resultFilname);

print date( "★★★Y年n月j日  G時i分s秒\t追加削除の結果を取得 ID=" ) . $addSubFeedId . "★★★";
invokeGetFeedSubmissionResult($service, $request);

/******************価格改定の実行状態を取得***********************/
$request = new MarketplaceWebService_Model_GetFeedSubmissionResultRequest();
$request->setMerchant(MERCHANT_ID);
$request->setFeedSubmissionId($revSubFeedId);

$request->setFeedSubmissionResult($resultFilname);

print date( "★★★Y年n月j日  G時i分s秒\t価格改定の結果を取得 ID=" ) . $revSubFeedId . "★★★";
invokeGetFeedSubmissionResult($service, $request);

@fclose($filename);


// ●●●●●●●●●●●●●●●● サブ関数 ●●●●●●●●●●●●●●●●
/**
  * Invoke Feed Submission Action Sample
  */
  function invokeSubmitFeed(MarketplaceWebService_Interface $service, $request) 
  {
      $getFeedSubId_f = 0;
      try {
              $response = $service->submitFeed($request);
              
                printf ("Service Response\n");
                printf ("=============================================================================\n");
				print date( "Y" ) . "年" . date( "n月j日  G時i分s秒\t" );
                printf("        SubmitFeedResponse\n");
                if ($response->isSetSubmitFeedResult()) { 
                    printf("            SubmitFeedResult\n");
                    $submitFeedResult = $response->getSubmitFeedResult();
                    if ($submitFeedResult->isSetFeedSubmissionInfo()) { 
                        printf("                FeedSubmissionInfo\n");
                        $feedSubmissionInfo = $submitFeedResult->getFeedSubmissionInfo();
                        if ($feedSubmissionInfo->isSetFeedSubmissionId()) 
                        {
                            printf("                    FeedSubmissionId\n");
                            printf("                        " . $feedSubmissionInfo->getFeedSubmissionId() . "\n");
							$getFeedSubId_f = $feedSubmissionInfo->getFeedSubmissionId();
                        }
                        if ($feedSubmissionInfo->isSetFeedType()) 
                        {
                            printf("                    FeedType\n");
                            printf("                        " . $feedSubmissionInfo->getFeedType() . "\n");
                        }
                        if ($feedSubmissionInfo->isSetSubmittedDate()) 
                        {
                            printf("                    SubmittedDate\n");
                            printf("                        " . $feedSubmissionInfo->getSubmittedDate()->format(DATE_FORMAT) . "\n");
                        }
                        if ($feedSubmissionInfo->isSetFeedProcessingStatus()) 
                        {
                            printf("                    FeedProcessingStatus\n");
                            printf("                        " . $feedSubmissionInfo->getFeedProcessingStatus() . "\n");
                        }
                        if ($feedSubmissionInfo->isSetStartedProcessingDate()) 
                        {
                            printf("                    StartedProcessingDate\n");
                            printf("                        " . $feedSubmissionInfo->getStartedProcessingDate()->format(DATE_FORMAT) . "\n");
                        }
                        if ($feedSubmissionInfo->isSetCompletedProcessingDate()) 
                        {
                            printf("                    CompletedProcessingDate\n");
                            printf("                        " . $feedSubmissionInfo->getCompletedProcessingDate()->format(DATE_FORMAT) . "\n");
                        }
                    } 
                } 
                if ($response->isSetResponseMetadata()) { 
                    printf("            ResponseMetadata\n");
                    $responseMetadata = $response->getResponseMetadata();
                    if ($responseMetadata->isSetRequestId()) 
                    {
                        printf("                RequestId\n");
                        printf("                    " . $responseMetadata->getRequestId() . "\n");
						printf("RequestId\t");
						printf($responseMetadata->getRequestId() . "\n");
                    }
                } 

                printf("            ResponseHeaderMetadata: " . $response->getResponseHeaderMetadata() . "\n");

                // FeedSubmissionId を返す
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

/**
  * Get Feed Submission List Action Sample
  */
  function invokeGetFeedSubmissionList(MarketplaceWebService_Interface $service, $request, $recFeedSubId) 
  {
      $checkSubFeedId = 0;
      try {
              $response = $service->getFeedSubmissionList($request);
              
                printf ("Service Response\n");
                printf ("=============================================================================\n");
                printf("        GetFeedSubmissionListResponse\n");
                if ($response->isSetGetFeedSubmissionListResult()) { 
                    printf("            GetFeedSubmissionListResult\n");
                    $getFeedSubmissionListResult = $response->getGetFeedSubmissionListResult();
                    if ($getFeedSubmissionListResult->isSetNextToken()) 
                    {
                        printf("                NextToken\n");
                        printf("                    " . $getFeedSubmissionListResult->getNextToken() . "\n");
                    }
                    if ($getFeedSubmissionListResult->isSetHasNext()) 
                    {
                        printf("                HasNext\n");
                        printf("                    " . $getFeedSubmissionListResult->getHasNext() . "\n");
                    }
                    $feedSubmissionInfoList = $getFeedSubmissionListResult->getFeedSubmissionInfoList();
                    foreach ($feedSubmissionInfoList as $feedSubmissionInfo) {
                        printf("                FeedSubmissionInfo\n");
                        if ($feedSubmissionInfo->isSetFeedSubmissionId()) 
                        {
                            printf("                    FeedSubmissionId\n");
                            printf("                        " . $feedSubmissionInfo->getFeedSubmissionId() . "\n");
							if ( $recFeedSubId == $feedSubmissionInfo->getFeedSubmissionId() ) {
								$checkSubFeedId = $feedSubmissionInfo->getFeedSubmissionId();
							}
                        }
                        if ($feedSubmissionInfo->isSetFeedType()) 
                        {
                            printf("                    FeedType\n");
                            printf("                        " . $feedSubmissionInfo->getFeedType() . "\n");
                        }
                        if ($feedSubmissionInfo->isSetSubmittedDate()) 
                        {
                            printf("                    SubmittedDate\n");
                            printf("                        " . $feedSubmissionInfo->getSubmittedDate()->format(DATE_FORMAT) . "\n");
                        }
                        if ($feedSubmissionInfo->isSetFeedProcessingStatus()) 
                        {
                            printf("                    FeedProcessingStatus\n");
                            printf("                        " . $feedSubmissionInfo->getFeedProcessingStatus() . "\n");
                        }
                        if ($feedSubmissionInfo->isSetStartedProcessingDate()) 
                        {
                            printf("                    StartedProcessingDate\n");
                            printf("                        " . $feedSubmissionInfo->getStartedProcessingDate()->format(DATE_FORMAT) . "\n");
                        }
                        if ($feedSubmissionInfo->isSetCompletedProcessingDate()) 
                        {
                            printf("                    CompletedProcessingDate\n");
                            printf("                        " . $feedSubmissionInfo->getCompletedProcessingDate()->format(DATE_FORMAT) . "\n");
                        }
                    }
                } 
                if ($response->isSetResponseMetadata()) { 
                    printf("            ResponseMetadata\n");
                    $responseMetadata = $response->getResponseMetadata();
                    if ($responseMetadata->isSetRequestId()) 
                    {
                        printf("                RequestId\n");
                        printf("                    " . $responseMetadata->getRequestId() . "\n");
                    }
                } 

                printf("            ResponseHeaderMetadata: " . $response->getResponseHeaderMetadata() . "\n");

				// CheckしているSubFeedIdが存在したら、その値を返す
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
 
/**
  * Get Feed Submission Result Action Sample
  */
  function invokeGetFeedSubmissionResult(MarketplaceWebService_Interface $service, $request) 
  {
      try {
              $response = $service->getFeedSubmissionResult($request);
              
                printf ("Service Response\n");
                printf ("=============================================================================\n");
                printf("        GetFeedSubmissionResultResponse\n");
                if ($response->isSetGetFeedSubmissionResultResult()) {
                  $getFeedSubmissionResultResult = $response->getGetFeedSubmissionResultResult(); 
                  printf ("            GetFeedSubmissionResult");
                  
                  if ($getFeedSubmissionResultResult->isSetContentMd5()) {
                    printf ("                ContentMd5");
                    printf ("                " . $getFeedSubmissionResultResult->getContentMd5() . "\n");
                  }
                }
                if ($response->isSetResponseMetadata()) { 
                    printf("            ResponseMetadata\n");
                    $responseMetadata = $response->getResponseMetadata();
                    if ($responseMetadata->isSetRequestId()) 
                    {
                        printf("                RequestId\n");
                        printf("                    " . $responseMetadata->getRequestId() . "\n");
                    }
                } 

                printf("            ResponseHeaderMetadata: " . $response->getResponseHeaderMetadata() . "\n");
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
?>
