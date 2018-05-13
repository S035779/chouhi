<dl>
  <dt>ASIN</dt>
  <dd><?= h($response['Items']['Item']['ASIN'])?></dd>
  <dt>Title</dt>
  <dd><?= h($response['Items']['Item']['ItemAttributes']['Title'])?></dd>
  <dt>isEligiblePrime</dt>
  <dd><?= h($response['Items']['Item']['Offers']['Offer']['OfferListing']['IsEligibleForPrime'])?></dd>
  <dt>isEligibleForSuperSaberShipping</dt>
  <dd><?= h($response['Items']['Item']['Offers']['Offer']['OfferListing']['IsEligibleForSuperSaverShipping']) ?></dd>
  <dt>Item Height</dt>
  <dd><?= h($response['Items']['Item']['ItemAttributes']['ItemDimensions']['Height'])?></dd>
  <dt>Item Length</dt>
  <dd><?= h($response['Items']['Item']['ItemAttributes']['ItemDimensions']['Length'])?></dd>
  <dt>Item Weight</dt>
  <dd><?= h($response['Items']['Item']['ItemAttributes']['ItemDimensions']['Weight'])?></dd>
  <dt>Item Width</dt>
  <dd><?= h($response['Items']['Item']['ItemAttributes']['ItemDimensions']['Width'])?></dd>
  <dt>Package Heighyt</dt>
  <dd><?= h($response['Items']['Item']['ItemAttributes']['PackageDimensions']['Height'])?></dd>
  <dt>Package Length</dt>
  <dd><?= h($response['Items']['Item']['ItemAttributes']['PackageDimensions']['Length'])?></dd>
  <dt>Package Weight</dt>
  <dd><?= h($response['Items']['Item']['ItemAttributes']['PackageDimensions']['Weight'])?></dd>
  <dt>Package Width</dt>
  <dd><?= h($response['Items']['Item']['ItemAttributes']['PackageDimensions']['Width']) ?></dd>
  <dt>List Price</dt>
  <dd><?= h($response['Items']['Item']['ItemAttributes']['ListPrice']['Amount'])?></dd>
  <dt>List Price Currency Code</dt>
  <dd><?= h($response['Items']['Item']['ItemAttributes']['ListPrice']['CurrencyCode'])?></dd>
  <dt>Lowest Price</dt>
  <dd><?= h($response['Items']['Item']['OfferSummary']['LowestNewPrice']['Amount'])?></dd>
  <dt>Lowest Price Currency Code</dt>
  <dd><?= h($response['Items']['Item']['OfferSummary']['LowestNewPrice']['CurrencyCode'])?></dd>
  <dt>Lowest Used Price</dt>
  <dd><?= h($response['Items']['Item']['OfferSummary']['LowestUsedPrice']['Amount'])?></dd>
  <dt>Lowest Used Price Currency Code</dt>
  <dd><?= h($response['Items']['Item']['OfferSummary']['LowestUsedPrice']['CurrencyCode'])?></dd>
  <dt>Lowest Collectible Price</dt>
  <dd><?= h($response['Items']['Item']['OfferSummary']['LowestCollectiblePrice']['Amount'])?></dd>
  <dt>Lowest Collectible Currency Code</dt>
  <dd><?= h($response['Items']['Item']['OfferSummary']['LowestCollectiblePrice']['CurrencyCode'])?></dd>
  <dt>Offer Listing Price</dt>
  <dd><?= h($response['Items']['Item']['Offers']['Offer']['OfferListing']['Price']['Amount'])?></dd>
  <dt>Offer Listing Currency Code</dt>
  <dd><?= h($response['Items']['Item']['Offers']['Offer']['OfferListing']['Price']['CurrencyCode'])?></dd>
  <dt>Offer Listing Saved Price</dt>
  <dd><?= h($response['Items']['Item']['Offers']['Offer']['OfferListing']['AmountSaved']['Amount'])?></dd>
  <dt>Offer Listing Saved Currency Code</dt>
  <dd><?= h($response['Items']['Item']['Offers']['Offer']['OfferListing']['AmountSaved']['CurrencyCode'])?></dd>
</dl>
<?php var_dump($response); ?>
