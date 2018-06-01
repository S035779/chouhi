<?php
// Amazon MWS Sample Program
// PHP Amazonライブラリ未使用
// 商品の最低価格取得
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

    $access_key_id        = AWS_ACCESS_KEY_ID;
    $secret_access_key    = AWS_SECRET_ACCESS_KEY;
    $merchant_id          = MERCHANT_ID;
    $marketplace_id       = MWS_MARKETPLACE_JP;
    //$marketplace_id       = MWS_MARKETPLACE_AU;
    //$marketplace_id       = MWS_MARKETPLACE_US;
    $baseurl              = MWS_BASEURL_JP;
    //$baseurl              = MWS_BASEURL_AU;
    //$baseurl              = MWS_BASEURL_US;

// ***************** RequestReport ****************
$params=array();
$params['AWSAccessKeyId']    = $access_key_id;
$params['SellerId']          = $merchant_id;
$params['SignatureMethod']   = 'HmacSHA256';
$params['SignatureVersion']  = '2';
$params['Version']           = '2011-10-01';
$params['Timestamp']         = gmdate('Y-m-d\TH:i:s\Z');    // Timeは毎回Checkされる【ISO8601,UTC(GMT)】
$params['Action']            = 'GetLowestOfferListingsForASIN';
$params['MarketplaceId']     = $marketplace_id;
$params['ItemCondition']     = 'New';
$params['ASINList.ASIN.1']   = 'B00JPYHRQ2';

$baseurl = $baseurl . 'Products/' . $params['Version'];

// URLの作成
$url = makeUrl($params, $baseurl, $secret_access_key, 1);
// HTMLアクセスを行う
$amazon_xml    = accessHttp( $url, 0 );        // 0:XML解析要

foreach($amazon_xml->GetLowestOfferListingsForASINResult as $response){

    $getLowestPrice = 0;
    foreach($response->Product->LowestOfferListings->LowestOfferListing as $lowOffer){
        if ( $getLowestPrice <= 0 OR $getLowestPrice > $lowOffer->Price->LandedPrice->Amount ) {
            $getLowestPrice = $lowOffer->Price->LandedPrice->Amount;
        }
    }

}

printf ("SUCCESS : MWS GetLowestPrice completed! LowestPrice=%s\n", $getLowestPrice );

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
