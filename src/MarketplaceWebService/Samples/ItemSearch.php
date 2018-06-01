<?php

// Amazon API Sample
// h26.1.20


include_once ('.config.inc.php');

$access_key_id      = ACCESS_KEY;
$AssociateTag       = ASSOCI_TAG;
$secret_access_key  = SECRET_KEY;

$params=array();
$params['Service'       ] = 'AWSECommerceService';
$params['AWSAccessKeyId'] = $access_key_id;
$params['Version'       ] = '2011-08-02';
$params['AssociateTag'  ] = $AssociateTag;
$params['Timestamp'     ] = gmdate('Y-m-d\TH:i:s\Z');
$params['ResponseGroup' ]  = 'Large';

// ItemAttribute search
//$params['ResponseGroup' ] = 'ItemAttributes';

// Ketword search
//$params['Operation'     ] = 'ItemSearch';
//$params['SearchIndex'   ] = 'All';
//$params['Keywords'      ] = 'GUNDAM';
//$params['ItemPage'      ] = 1;

// ASIN search
$params['Operation'     ] = 'ItemLookup';
$params['ItemId'        ] = 'B00CPDCZWG';

ksort($params);
$baseurl = 'http://ecs.amazonaws.jp/onca/xml';
$option_string = '';
foreach ($params as $k => $v) {
  $option_string .= '&'.urlencode_rfc3986($k).'='.urlencode_rfc3986($v);
}

$option_string = substr($option_string, 1);
$parsed_url = parse_url($baseurl);
$string_to_sign = "GET\n{$parsed_url['host']}\n{$parsed_url['path']}\n{$option_string}";
$signature = base64_encode(hash_hmac('sha256', $string_to_sign, $secret_access_key, true));
$url = $baseurl.'?'.$option_string.'&Signature='.urlencode_rfc3986($signature);
$get_contents = file_get_contents($url);
$amazon_xml= simplexml_load_string($get_contents);
foreach($amazon_xml->Items->Item as $item){
  $getdata = array();
  $getdata['titlename'  ] = $item->ItemAttributes->Title;
  $getdata['maker'      ] = $item->ItemAttributes->Manufacturer;
  $getdata['asin'       ] = $item->ASIN;
  $getdata['listprice'  ] = $item->ItemAttributes->ListPrice->Amount;
  $getdata['newprice'   ] = $item->OfferSummary->LowestNewPrice->Amount;
  $getdata['usedprice'  ] = $item->OfferSummary->LowestUsedPrice->Amount;
  $getdata['p_category' ] = $item->BrowseNodes->BrowseNode->Name;
  $getdata['newstock'   ] = $item->OfferSummary->TotalNew;
  $getdata['usedstock'  ] = $item->OfferSummary->TotalUsed;
  $getdata['dim_hight'  ] = $item->ItemAttributes->PackageDimensions->Height;
  $getdata['dim_length' ] = $item->ItemAttributes->PackageDimensions->Length;
  $getdata['dim_width'  ] = $item->ItemAttributes->PackageDimensions->Width;
  $getdata['weight'     ] = $item->ItemAttributes->PackageDimensions->Weight;
  $getdata['ean'        ] = $item->ItemAttributes->EAN;
  $getdata['isbn'       ] = $item->ItemAttributes->ISBN;
  $getdata['upc'        ] = $item->ItemAttributes->UPC;
  $getdata['p_release'  ] = $item->ItemAttributes->PublicationDate;
  $getdata['producturl' ] = $item->DetailPageURL;

  $curDate = sprintf ("%04d%02d%02d", date("Y"), date("n"), date("j"))
    . "_" . sprintf ("%02d%02d%02d", date("G"), date("i"), date("s"));
  $temWord = mb_convert_encoding( $getdata['titlename'], "SJIS", "UTF-8");
  printf ("Time=[%s], ASIN=[%s], Title=[%s], Price=[%s]\n",
    $curDate, $getdata['asin'], $temWord, $getdata['newprice']);
}

function urlencode_rfc3986($str){
  return str_replace('%7E', '~', rawurlencode($str));
}

?>
