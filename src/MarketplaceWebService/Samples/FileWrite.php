<?php
$path = getcwd();
$country = 'US';
$header = array('商品名','item-description','出品ID','出品者SKU','価格','数量','出品日','image-url','item-is-marketplace','商品IDタイプ','zshop-shipping-fee','コンディション説明','コンディション','zshop-category1','zshop-browse-path','zshop-storefront-feature','asin1','asin2','asin3','国外へ配送可','迅速な配送','zshop-boldface','商品ID','bid-for-featured-placement','add-delete','在庫数','フルフィルメント・チャンネル','merchant-shipping-group','ポイント');
$requestId = date('Ymd');
$generatedId = date('His');
$date = date('Y');
$file = sprintf('/%s/List_%s_%s.csv', $date, $requestId, $generatedId);

switch($country) {
case 'JP':
  $column = array(TRUE, FALSE, TRUE, TRUE, TRUE, TRUE, TRUE, FALSE, FALSE, TRUE, FALSE, TRUE, TRUE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, TRUE, TRUE, FALSE, TRUE, FALSE, FALSE, TRUE, TRUE, FALSE, TRUE);
  $filename = $path . "/_JP" . $file; // JP
  break;
case 'AU':
  $column = array(TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, FALSE);
  $filename = $path . "/_AU" . $file; // AU
  break;
case 'US':
  $column = array(TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, FALSE);
  $filename = $path . "/_US" . $file; // US
  break;
}

$new_file = fopen($filename, 'ab');
flock($new_file, LOCK_EX);
foreach($header as $_header) {
  fputs($new_file, e($_header)."\t");
}
fputs($new_file, "\n");
flock($new_file, LOCK_UN);
fclose($new_file);

function e($str) {
  return mb_convert_encoding($str, 'sjis-win', 'utf8');
};

?>
