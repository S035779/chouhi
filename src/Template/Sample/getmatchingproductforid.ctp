<dl>
  <dt>GetMatchingProductForIdResult</dt>
  <dd><?= h($response['Result'][0]['Id'])?></dd>
  <dd><?= h($response['Result'][0]['IdType'])?></dd>
  <dd><?= h($response['Result'][0]['status'])?></dd>
  <dd><?= h($response['Result'][0]['products'][0]['Identifiers']['MarketplaceASIN']['MarketplaceId'])?></dd>
  <dd><?= h($response['Result'][0]['products'][0]['Identifiers']['MarketplaceASIN']['ASIN'])?></dd>
  <dd><?= h($response['Result'][0]['products'][0]['AttributeSets']['Any'])?></dd>
  <dd><?= h($response['Result'][0]['products'][0]['SalesRankings'][0]['ProductCategoryId'])?></dd>
  <dd><?= h($response['Result'][0]['products'][0]['SalesRankings'][0]['Rank'])?></dd>
  <dd><?= h($response['Result'][0]['products'][0]['SalesRankings'][1]['ProductCategoryId'])?></dd>
  <dd><?= h($response['Result'][0]['products'][0]['SalesRankings'][1]['Rank'])?></dd>
  <dt>ResponseMetadata</dt>
  <dd><?= h($response['Metadata']['ResponseMetadata']['RequestId'])?></dd>
  <dt>ResponseHeaderMetadata</dt>
  <dd><?= h($response['HeaderMetadata']['ResponseHeaderMetadata'])?></dd>
</dl>
<?php var_dump($response); ?>
