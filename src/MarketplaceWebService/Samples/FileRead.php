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

$org_file = @fopen($filename, 'rb') or die("File can not opend.\n");
flock($org_file, LOCK_SH);
print("sol>>>\n");
while($row = fgetcsv($org_file, 1024, "\t")) {
  $idx = 0; $_idx = 0;
  foreach($header as $_header) {
    if($column[$_idx]) {
      $_body = e($row[$idx]);
      $idx += 1;
      $_idx += 1;
    } else {
      $_body = 'N/A';
      $_idx += 1;
    }
    print($_header . ':' . '[' . $_body . ']' . "\n");
  }
}
print("eol>>>\n");
flock($org_file, LOCK_UN);
fclose($org_file);

function e($str) {
  return mb_convert_encoding($str, 'utf8', 'sjis-win');
};

?>
