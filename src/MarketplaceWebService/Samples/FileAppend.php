<?php
$path = getcwd();
$country = 'US';
$header = array('商品名','item-description','出品ID','出品者SKU','価格','数量','出品日','image-url','item-is-marketplace','商品IDタイプ','zshop-shipping-fee','コンディション説明','コンディション','zshop-category1','zshop-browse-path','zshop-storefront-feature','asin1','asin2','asin3','国外へ配送可','迅速な配送','zshop-boldface','商品ID','bid-for-featured-placement','add-delete','在庫数','フルフィルメント・チャンネル','merchant-shipping-group','ポイント');

switch($country) {
case 'JP':
  $column = array(TRUE, FALSE, TRUE, TRUE, TRUE, TRUE, TRUE, FALSE, FALSE, TRUE, FALSE, TRUE, TRUE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, TRUE, TRUE, FALSE, TRUE, FALSE, FALSE, TRUE, TRUE, FALSE, TRUE);
  $requestId = '20180514';  $generatedId = '081111';  $date = '2018';
  $file = sprintf('/%s/List_%s_%s.csv', $date, $requestId, $generatedId);
  $filename = $path . "/_JP" . $file; // JP
  break;
case 'AU':
  $column = array(TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, FALSE);
  $requestId = '20180514';  $generatedId = '084042';  $date = '2018';
  $file = sprintf('/%s/List_%s_%s.csv', $date, $requestId, $generatedId);
  $filename = $path . "/_AU" . $file; // AU
  break;
case 'US':
  $column = array(TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, TRUE, FALSE);
  $requestId = '20180514';  $generatedId = '083258';  $date = '2018';
  $file = sprintf('/%s/List_%s_%s.csv', $date, $requestId, $generatedId);
  $filename = $path . "/_US" . $file; // US
  break;
}

$org_file = fopen('test.csv', 'rb');
$tmp_file = fopen('test.tmp', 'wb');
flock($org_file, LOCK_SH);
flock($tmp_file, LOCK_EX);
fputs($tmp_file, date('Y/m/d H:i:s')."\t");
fputs($tmp_file, 'name'."\t");
fputs($tmp_file, 'message'."\n");
while($row = $fgets($org_file)) {
  $fputs($tmp_file, $row);
}
flock($tmp_file, LOCK_UN);
flock($org_file, LOCK_UN);
fclose($tmp_file);
fclose($org_file);
unlink('test.csv');
rename('test.tmp', 'test.csv');
?>
