<?php
// Amazon MWS Sample Program
// PHP Amazonライブラリ未使用
// 出品/価格・在庫改定処理
// H27.10.14

include_once ('.config.inc.php');

// MARKETPLACE BASEURL
define("MWS_MARKETPLACE_JP", 'A1VC38T7YXB528');                     // JP
define("MWS_BASEURL_JP",     'https://mws.amazonservices.jp/');     // JP
define("MWS_MARKETPLACE_AU", 'A39IBJ37TRP1C6');                     // AU
define("MWS_BASEURL_US",     'https://mws.amazonservices.com.au/'); // AU
define("MWS_MARKETPLACE_US", 'ATVPDKIKX0DER');                      // US
define("MWS_BASEURL_US",     'https://mws.amazonservices.com/');    // US

// HTTPアクセスに関する設定（任意に変更してください）
define("HTTP_TRY_TIMER",    30);
define("HTTP_TRY_NUM",     10);

$access_key_id      = AWS_ACCESS_KEY_ID;
$secret_access_key  = AWS_SECRET_ACCESS_KEY;
$merchant_id        = MERCHANT_ID;
$marketplace_id     = MWS_MARKETPLACE_JP;
//$marketplace_id     = MWS_MARKETPLACE_AU;
//$marketplace_id     = MWS_MARKETPLACE_US;
$baseurl            = MWS_BASEURL_JP;
//$baseurl            = MWS_BASEURL_AU;
//$baseurl            = MWS_BASEURL_US;

// 1:_POST_FLAT_FILE_INVLOADER_DATA_
// 2:_POST_FLAT_FILE_PRICEANDQUANTITYONLY_UPDATE_DATA_
// 3:_POST_FLAT_FILE_LISTINGS_DATA_
$jobType = 2;
$currentDir = getcwd();
define("DIR_DATA_UPLD",     $currentDir);
define("AllListChange",     0);             // 完全上書き：1、追加修正：0
$csvFile = 'csvFileUs.csv';
// Log file.
$resultFile = sprintf('%s/%s_RESULT_%s.txt', DIR_DATA_UPLD, $country, date('Ymd') );
// Read file.
$fullName = DIR_DATA_UPLD . "/" . $csvFile;
if ( !$feed = file_get_contents($fullName) ) {
    printf ( "MWS[SubmitFeed]にてファイル読み込み失敗=%s\n", $fullName );
}
// Count line number.
if ( $jobType == 3 ) {
    $fileCount = 1;
} else {
    $fileCount = count( file( $fullName ) ) - 1;
}

// ***************** SubmitFeed ****************
$params=array();
$params['AWSAccessKeyId']         = $access_key_id;
$params['Merchant']               = $merchant_id;
$params['SignatureMethod']        = 'HmacSHA256';
$params['SignatureVersion']       = '2';
$params['Version']                = '2009-01-01';
$params['Timestamp']              = gmdate('Y-m-d\TH:i:s\Z');    // Timeは毎回Checkされる【ISO8601,UTC(GMT)】
$params['Action']                 = 'SubmitFeed';
$params['MarketplaceIdList.Id.1'] = $marketplace_id;

if ( $jobType == 1 ) {
    $params['FeedType']      = '_POST_FLAT_FILE_INVLOADER_DATA_';
    if ( AllListChange == 1 ) {
        $params['PurgeAndReplace']       = 'true';
        } else {
        $params['PurgeAndReplace']       = 'false';
        }
} elseif( $jobType == 2 ) {
        $params['FeedType'] = '_POST_FLAT_FILE_PRICEANDQUANTITYONLY_UPDATE_DATA_';
        $params['PurgeAndReplace']       = 'false';
} elseif( $jobType == 3 ) {
        $params['FeedType'] = '_POST_FLAT_FILE_LISTINGS_DATA_';
        $params['PurgeAndReplace']       = 'false';
}

// URLの作成
$url = makeUrl($params, $baseurl, $secret_access_key, 2);

// ファイルハンドルへの記載
$feedHandle = @fopen('php://temp', 'rw+');
fwrite($feedHandle, $feed);
rewind($feedHandle);

// Headerの情報の作成
$culc_md5 = base64_encode(md5(stream_get_contents($feedHandle), true));
rewind($feedHandle);
$headParam = array(
    "Expect: ",
    "Accept: ",
    "Transfer-Encoding: chunked",
    "Content-MD5: $culc_md5",
    "Content-Type: application/octet-stream"
);

// UserAgentの作成
$userAgent = APPLICATION_NAME . '/' . APPLICATION_VERSION;
$userAgent .= ' (';
$userAgent .= 'Language=PHP/' . phpversion();
$userAgent .= '; ';
$userAgent .= 'Platform=' . php_uname('s') . '/' . php_uname('m') . '/' . php_uname('r');
$userAgent .= '; ';
$userAgent .= 'MWSClientVersion=2011-08-01';

// HTTPアクセスを行う処理（HTTP_TRY_NUM回のリトライを行う）
for ($i=1; $i <= HTTP_TRY_NUM; $i++) {

    // CURLの設定
    $curlOpts_arry = array(
        CURLOPT_POST              => true ,
        CURLOPT_USERAGENT         => $userAgent ,
        CURLOPT_VERBOSE           => true ,
        CURLOPT_RETURNTRANSFER    => true ,
        CURLOPT_SSL_VERIFYPEER    => true ,
        CURLOPT_SSL_VERIFYHOST    => 2 ,
        CURLOPT_URL               => $url ,
        CURLOPT_HTTPHEADER        => $headParam ,
        CURLOPT_INFILE            => $feedHandle ,
        CURLOPT_UPLOAD            => true ,
        CURLOPT_CUSTOMREQUEST     => "POST"
    );

    $curlOpts = curl_init();
    curl_setopt_array($curlOpts, $curlOpts_arry);

    // HTMLアクセスを行う（送受信する）
    if( $contents = curl_exec($curlOpts) ) { 
        break; 
    }
    printf ( "SubmitFeedでcurl_exeエラー=%s\n", curl_error($curlOpts));
    trigger_error(curl_error($curlOpts));
    if( $i == HTTP_TRY_NUM ) { 
        exit;
    } 
    curl_close($curlOpts);
}

$amazon_xml = simplexml_load_string($contents);

// レスポンスヘッダを確認する
if (isset($amazon_xml
  ->SubmitFeedResult->FeedSubmissionInfo->FeedSubmissionId)) {
  $FeedSubmissionId = $amazon_xml
    ->SubmitFeedResult->FeedSubmissionInfo->FeedSubmissionId;
} else {
    printf ( "SubmitFeedで正常なレスポンスがありません\n" );
    exit;
}

// ログに記載
printf ( "MWS[SubmitFeed]にてファイルUPLOAD完了 FeedSubmissionId=%s 送信数=%s\n", $FeedSubmissionId, $fileCount);


// ***************** GetFeedSubmissionList ****************

// DONEになるまで繰り返す
while(true) {
    $params=array();
    $params['AWSAccessKeyId']    = $access_key_id;
    $params['Merchant']          = $merchant_id;
    $params['SignatureMethod']   = 'HmacSHA256';
    $params['SignatureVersion']  = '2';
    $params['Version']           = '2009-01-01';
    $params['Timestamp']         = gmdate('Y-m-d\TH:i:s\Z');
    // Timeは毎回Checkされる【ISO8601,UTC(GMT)】
    $params['Action']            = 'GetFeedSubmissionList';
    $params['FeedSubmissionIdList.Id.1']    = $FeedSubmissionId;

    // URLの作成
    $url = makeUrl($params, $baseurl, $secret_access_key, 1);

    // HTMLアクセスを行う
    $amazon_xml    = accessHttp( $url, 0 );

    // FeedProcessingStatusの取得
    if (isset($amazon_xml->GetFeedSubmissionListResult->FeedSubmissionInfo
      ->FeedProcessingStatus)) {
      $FeedProcessingStatus = $amazon_xml
        ->GetFeedSubmissionListResult->FeedSubmissionInfo
        ->FeedProcessingStatus;
    } else {
        printf( "GetFeedSubmissionListで正常な応答がありません\n" );
        exit;
    }

    if ( $FeedProcessingStatus == '_DONE_') {
        // ログに記載
      printf( "MWS[GetFeedSubmissionList]にて「_DONE_」を確認 FeedSubmissionId=%s\n", $FeedSubmissionId);
        // ループを抜ける
      break;
    }
    sleep(180);
}

// ***************** GetFeedSubmissionResult ****************

$params=array();
$params['AWSAccessKeyId']    = $access_key_id;
$params['Merchant']          = $merchant_id;
$params['SignatureMethod']   = 'HmacSHA256';
$params['SignatureVersion']  = '2';
$params['Version']           = '2009-01-01';
$params['Timestamp']         = gmdate('Y-m-d\TH:i:s\Z');
// Timeは毎回Checkされる【ISO8601,UTC(GMT)】
$params['Action']            = 'GetFeedSubmissionResult';
$params['FeedSubmissionId']  = $FeedSubmissionId;

// URLの作成
$url = makeUrl($params, $baseurl, $secret_access_key, 1);

// HTMLアクセスを行う
$get_contents    = accessHttp( $url, 1 );

// ファイルに書き込み
$fp = fopen( $resultFile , 'a');
$tmpWord = "\n------------------------------- [ UploadFile = $csvFile ]--------------------------------\n";
fwrite($fp, $tmpWord);
fwrite($fp, $get_contents);
fclose($fp);

// ログに記載
printf ( "MWS[GetFeedSubmissionResult]にて結果ファイル作成完了 File=%s\n", $resultFile );

exit;

// ***************** 関数の処理 ****************

// HTTPアクセスを行う処理（HTTP_TRY_NUM回のリトライを行う）
function accessHttp( $url, $jobType ) {
    for ($i=1; $i <= HTTP_TRY_NUM; $i++) {
        $http_response_header = null;
        $response = @file_get_contents( $url );
        // HTTPエラーの検出
        $pos = strpos($http_response_header[0], '200');
        if ($pos === false) {
            // エラー処理
            if (strstr($http_response_header[0], '400 Bad Request')) {
                // ERROR
                printf ("ERROR : HTTP ACCESS 400!\n");
                exit;
            } elseif (strstr($http_response_header[0], '403 Forbidden')) {
                // ERROR
                printf ("ERROR : HTTP ACCESS 403!\n");
                exit;
            } elseif (strstr($http_response_header[0], '404 NotFound')) {
                printf ("ERROR : HTTP ACCESS 404!\n");
                // 404はサーバ負荷により発生する可能性あり
                //      exit;
            }
            if ( $i == HTTP_TRY_NUM ){
                exit;
            }
        // HTTPがOK時
        } else {
            // XML解析不要時   "$jobType = 1"
            if ( $jobType == 1 ) {
                return $response;
            }
            // MWSエラーのチェック
            $response = preg_replace("/ns2:/", "ns2_", $response);
            $amazon_xml = simplexml_load_string($response);
            if ( isset($amazon_xml->Error->Message) ) {
                // エラー処理
                printf ("ERROR : HTTP ACCESS MWS i=%d!\n", $i );
                // ERROR
                if ( $i == HTTP_TRY_NUM ){
                    exit;
                }
            } else {
                return $amazon_xml;
            }
        }
        // Sleep (HTTP_TRY_TIMER) Seconds
        sleep(HTTP_TRY_TIMER);
    }
}


// URLを作る処理
function makeUrl($params, $baseurl, $secret_access_key, $jobType) {

    // パラメータの順序を昇順に並び替えます
    ksort($params);
    // URLの追加部分を作成します
    $option_string = '';
    foreach ($params as $k => $v) {
        // URLの追加部分をURLエンコードして&でつなげる。
        $option_string .= '&'.urlencode_rfc3986($k).'='.urlencode_rfc3986($v);
    }
    // 最初の"&"のみ削除
    $option_string = substr($option_string, 1);
    // URL作成
    $parsed_url     = parse_url($baseurl);
    if ( $jobType == 2 ){
        $string_to_sign = "POST\n{$parsed_url['host']}\n{$parsed_url['path']}\n{$option_string}";
    }else{
        $string_to_sign = "GET\n{$parsed_url['host']}\n{$parsed_url['path']}\n{$option_string}";
    }
    // - HMAC-SHA256 を計算し、BASE64 エンコード
    $signature      = base64_encode(hash_hmac('sha256', $string_to_sign, $secret_access_key, true));
    // - リクエストの末尾に署名を追加
    $url            = $baseurl.'?'.$option_string.'&Signature='.urlencode_rfc3986($signature);
    // URLを返す
    return $url;
}

// RFC3986 形式で URL エンコードする関数
function urlencode_rfc3986($str){
    return str_replace('%7E', '~', rawurlencode($str));
}

?>
