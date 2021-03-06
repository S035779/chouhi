<?php
namespace MarketplaceWebServiceProducts\Component;

require_once dirname(__FILE__) . '/../Samples/.config.inc.php';

use MarketplaceWebServiceProducts\MarketplaceWebServiceProducts_Client;
use MarketplaceWebServiceProducts\Model\MarketplaceWebServiceProducts_Model_GetMatchingProductForIdRequest;
use MarketplaceWebServiceProducts\Model\MarketplaceWebServiceProducts_Model_IdListType;
use MarketplaceWebServiceProducts\MarketplaceWebServiceProducts_Interface;

class GetMatchingProductForIdComponent
{
  public function __construct($params) 
  {
    $this->service_url = $params['BaseURL'] . 'Products/2011-10-01';
    $this->access_key  = $params['AWSAccessKeyId'];
    $this->secret_key  = $params['AWSSecretKeyId'];
    $this->app_name    = env('APP_NAME');
    $this->app_version = env('APP_VERSION');
    $this->marketplace = $params['Marketplace'];
    $this->seller_id   = $params['SellerId'];
    $this->id          = $params['Id'];
    $this->id_type     = $params['IdType'];
  }

  public function fetch() {
    $config = array (
      'ServiceURL' => $this->service_url,
      'ProxyHost' => null,
      'ProxyPort' => -1,
      'ProxyUsername' => null,
      'ProxyPassword' => null,
      'MaxErrorRetry' => 3,
    );
    $service = new MarketplaceWebServiceProducts_Client(
      $this->access_key,
      $this->secret_key,
      $this->app_name,
      $this->app_version,
      $config
    );
    return $this->getResult($service);
  }

  private function getResult($service) {
    $request = new MarketplaceWebServiceProducts_Model_GetMatchingProductForIdRequest();
    $request->setSellerId($this->seller_id);
    $request->setMarketplaceId($this->marketplace);
    $idList = new MarketplaceWebServiceProducts_Model_IdListType();
    $idList->setId($this->id);
    $request->setIdList($idList);
    $request->setIdType($this->id_type);
    return $this->invokeGetMatchingProductForId($service, $request);
  }

  private function invokeGetMatchingProductForId(
    MarketplaceWebServiceProducts_Interface $service, $request
  ) {
    try {
      $result = array();
      $response = $service->GetMatchingProductForId($request);
      $getMatchingProductForIdResultList = $response->getGetMatchingProductForIdResult();
      $idx1 = 0;
      foreach ($getMatchingProductForIdResultList as $getMatchingProductForIdResult) {
        $result[$idx1] = array();
        if ($getMatchingProductForIdResult->isSetId()) {
          $result[$idx1]['Id'] = $getMatchingProductForIdResult->getId();
        } 
        if ($getMatchingProductForIdResult->isSetIdType()) {
          $result[$idx1]['IdType'] = $getMatchingProductForIdResult->getIdType();
        } 
        if ($getMatchingProductForIdResult->isSetStatus()) {
          $result[$idx1]['status'] = $getMatchingProductForIdResult->getStatus();
        } 
        if ($getMatchingProductForIdResult->isSetProducts()) { 
          $result[$idx1]['products'] = array();
          $products = $getMatchingProductForIdResult->getProducts();
          $productList = $products->getProduct();
          $idx2 = 0;
          foreach ($productList as $product) {
            $result[$idx1]['products'][$idx2] = array();
            if ($product->isSetIdentifiers()) { 
              $result[$idx1]['products'][$idx2]['Identifiers'] = array();
              $identifiers = $product->getIdentifiers();
              if ($identifiers->isSetMarketplaceASIN()) { 
                $result[$idx1]['products'][$idx2]['Identifiers']['MarketplaceASIN'] = array();
                $marketplaceASIN = $identifiers->getMarketplaceASIN();
                if ($marketplaceASIN->isSetMarketplaceId()) {
                  $result[$idx1]['products'][$idx2]['Identifiers']['MarketplaceASIN']['MarketplaceId'] = $marketplaceASIN->getMarketplaceId();
                }
                if ($marketplaceASIN->isSetASIN()) {
                  $result[$idx1]['products'][$idx2]['Identifiers']['MarketplaceASIN']['ASIN'] = $marketplaceASIN->getASIN();
                }
              } 
              if ($identifiers->isSetSKUIdentifier()) { 
                $result[$idx1]['products'][$idx2]['Identifiers']['SKUIdentifier'] = array();
                $SKUIdentifier = $identifiers->getSKUIdentifier();
                if ($SKUIdentifier->isSetMarketplaceId()) {
                  $result[$idx1]['products'][$idx2]['Identifiers']['SKUIdentifier']['MarketplaceId'] = $SKUIdentifier->getMarketplaceId();
                }
                if ($SKUIdentifier->isSetSellerId()) {
                  $result[$idx1]['products'][$idx2]['Identifiers']['SKUIdentifier']['SellerId'] = $SKUIdentifier->getSellerId();
                }
                if ($SKUIdentifier->isSetSellerSKU()) {
                  $result[$idx1]['products'][$idx2]['Identifiers']['SKUIdentifier']['SellerSKU'] = $SKUIdentifier->getSellerSKU();
                }
              } 
            } 
            if ($product->isSetAttributeSets()) {
              $result[$idx1]['products'][$idx2]['AttributeSets'] = array();
              $attributeSets = $product->getAttributeSets();
              if ($attributeSets->isSetAny()){
                $result[$idx1]['products'][$idx2]['AttributeSets']['Any']
                  = $this->toArray($attributeSets->getAny());
              }
            }
            if ($product->isSetRelationships()) {
              $result[$idx1]['products'][$idx2]['Relationships'] = array();
              $relationships = $product->getRelationships();
              if ($relationships->isSetAny()){
                $result[$idx1]['products'][$idx2]['Relationships']['Any']
                  = $this->toArray($relationships->getAny());
              }
            }
            if ($product->isSetCompetitivePricing()) { 
              $result[$idx1]['products'][$idx2]['CompetitivePricing'] = array();
              $competitivePricing = $product->getCompetitivePricing();
              if ($competitivePricing->isSetCompetitivePrices()) { 
                $result[$idx1]['products'][$idx2]['CompetitivePricing']['ConpetitivePrices'] = array();
                $competitivePrices = $competitivePricing->getCompetitivePrices();
                $competitivePriceList = $competitivePrices->getCompetitivePrice();
                $idx3 = 0;
                foreach ($competitivePriceList as $competitivePrice) {
                  $result[$idx1]['products'][$idx2]['ConpetitivePricing']['COnpetiticePrices'][$idx3] = array();
                  if ($competitivePrice->isSetCondition()) {
                    $result[$idx1]['products'][$idx2]['CompetitivePricing']['ConpetitivePrices'][$idx3]['condition'] = $competitivePrice->getCondition();
                  } 
                  if ($competitivePrice->isSetSubcondition()) {
                    $result[$idx1]['products'][$idx2]['CompetitivePricing']['ConpetitivePrices'][$idx3]['subcondition'] = $competitivePrice->getSubcondition();
                  } 
                  if ($competitivePrice->isSetBelongsToRequester()) {
                    $result[$idx1]['products'][$idx2]['CompetitivePricing']['ConpetitivePrices'][$idx3]['belongsToRequester'] = $competitivePrice->getBelongsToRequester();
                  } 
                  if ($competitivePrice->isSetCompetitivePriceId()) {
                    $result[$idx1]['products'][$idx2]['CompetitivePricing']['ConpetitivePrices'][$idx3]['CompetitivePriceId'] = $competitivePrice->getCompetitivePriceId();
                  }
                  if ($competitivePrice->isSetPrice()) { 
                    $price = $competitivePrice->getPrice();
                    $result[$idx1]['products'][$idx2]['CompetitivePricing']['ConpetitivePrices'][$idx3]['Price'] = array();
                    if ($price->isSetLandedPrice()) { 
                      $landedPrice = $price->getLandedPrice();
                      $result[$idx1]['products'][$idx2]['CompetitivePricing']['ConpetitivePrices'][$idx3]['Price']['LandedPrice'] = array();
                      if ($landedPrice->isSetCurrencyCode()) {
                        $result[$idx1]['products'][$idx2]['CompetitivePricing']['ConpetitivePrices'][$idx3]['Price']['LandedPrice']['CurrencyCode'] = $landedPrice->getCurrencyCode();
                      }
                      if ($landedPrice->isSetAmount()) {
                        $result[$idx1]['products'][$idx2]['CompetitivePricing']['ConpetitivePrices'][$idx3]['Price']['LandedPrice']['Amount'] = $landedPrice->getAmount();
                      }
                    } 
                    if ($price->isSetListingPrice()) { 
                      $listingPrice = $price->getListingPrice();
                      $result[$idx1]['products'][$idx2]['CompetitivePricing']['ConpetitivePrices'][$idx3]['Price']['ListingPrice'] = array();
                      if ($listingPrice->isSetCurrencyCode()) {
                        $result[$idx1]['products'][$idx2]['CompetitivePricing']['ConpetitivePrices'][$idx3]['Price']['ListingPrice']['CurrencyCode'] = $listingPrice->getCurrencyCode();
                      }
                      if ($listingPrice->isSetAmount()) {
                        $result[$idx1]['products'][$idx2]['CompetitivePricing']['ConpetitivePrices'][$idx3]['Price']['ListingPrice']['Amount'] = $listingPrice->getAmount();
                      }
                    } 
                    if ($price->isSetShipping()) { 
                      $shipping = $price->getShipping();
                      $result[$idx1]['products'][$idx2]['CompetitivePricing']['ConpetitivePrices'][$idx3]['Price']['Shipping'] = array();
                      if ($shipping->isSetCurrencyCode()) {
                        $result[$idx1]['products'][$idx2]['CompetitivePricing']['ConpetitivePrices'][$idx3]['Price']['Shipping']['CurrencyCode'] = $shipping->getCurrencyCode();
                      }
                      if ($shipping->isSetAmount()) {
                        $result[$idx1]['products'][$idx2]['CompetitivePricing']['ConpetitivePrices'][$idx3]['Price']['Shipping']['Amount'] = $shipping->getAmount();
                      }
                    } 
                  } 
                  $idx3 += 1;
                }
              } 
              if ($competitivePricing->isSetNumberOfOfferListings()) { 
                $result[$idx1]['products'][$idx2]['CompetitivePricing']['NumberOfOfferListings'] = array();
                $numberOfOfferListings = $competitivePricing->getNumberOfOfferListings();
                $offerListingCountList = $numberOfOfferListings->getOfferListingCount();
                $idx4 = 0;
                foreach ($offerListingCountList as $offerListingCount) {
                  $result[$idx1]['products'][$idx2]['CompetitivePricing']['NumberOfOfferListings'][$idx4] = array();
                  if ($offerListingCount->isSetCondition()) {
                    $result[$idx1]['products'][$idx2]['CompetitivePricing']['NumberOfOfferListings'][$idx4]['condition']= $offerListingCount->getCondition();
                  } 
                  if ($offerListingCount->isSetValue()) {
                    $result[$idx1]['products'][$idx2]['CompetitivePricing']['NumberOfOfferListings'][$idx4]['Value'] = $offerListingCount->getValue();
                  } 
                  $idx4 += 1;
                }
              } 
              if ($competitivePricing->isSetTradeInValue()) { 
                $result[$idx1]['products'][$idx2]['CompetitivePricing']['TradeInValue'] = array();
                $tradeInValue = $competitivePricing->getTradeInValue();
                if ($tradeInValue->isSetCurrencyCode()) {
                  $result[$idx1]['products'][$idx2]['CompetitivePricing']['TradeInValue']['CurrencyCode'] = $tradeInValue->getCurrencyCode();
                }
                if ($tradeInValue->isSetAmount()) {
                  $result[$idx1]['products'][$idx2]['CompetitivePricing']['TradeInValue']['Amount'] = $tradeInValue->getAmount();
                }
              } 
            } 
            if ($product->isSetSalesRankings()) { 
              $result[$idx1]['products'][$idx2]['SalesRankings'] = array();
              $salesRankings = $product->getSalesRankings();
              $salesRankList = $salesRankings->getSalesRank();
              $idx5 = 0;
              foreach ($salesRankList as $salesRank) {
                $result[$idx1]['products'][$idx2]['SalesRankings'][$idx5] = array();
                if ($salesRank->isSetProductCategoryId()) {
                  $result[$idx1]['products'][$idx2]['SalesRankings'][$idx5]['ProductCategoryId'] = $salesRank->getProductCategoryId();
                }
                if ($salesRank->isSetRank()) {
                  $result[$idx1]['products'][$idx2]['SalesRankings'][$idx5]['Rank'] = $salesRank->getRank();
                }
                $idx5 += 1;
              }
            } 
            if ($product->isSetLowestOfferListings()) { 
              $result[$idx1]['products'][$idx2]['LowestOfferListings'] = array();
              $lowestOfferListings = $product->getLowestOfferListings();
              $lowestOfferListingList = $lowestOfferListings->getLowestOfferListing();
              $idx6 = 0;
              foreach ($lowestOfferListingList as $lowestOfferListing) {
                $result[$idx1]['products'][$idx2]['LowestOfferListings'][$idx6] = array();
                if ($lowestOfferListing->isSetQualifiers()) { 
                  $result[$idx1]['products'][$idx2]['LowestOfferListings'][$idx6]['Qualifiers'] = array();
                  $qualifiers = $lowestOfferListing->getQualifiers();
                  if ($qualifiers->isSetItemCondition()) {
                    $result[$idx1]['products'][$idx2]['LowestOfferListings'][$idx6]['Qualifiers']['ItemCondition'] = $qualifiers->getItemCondition();
                  }
                  if ($qualifiers->isSetItemSubcondition()) {
                    $result[$idx1]['products'][$idx2]['LowestOfferListings'][$idx6]['Qualifiers']['ItemSubcondition'] = $qualifiers->getItemSubcondition();
                  }
                  if ($qualifiers->isSetFulfillmentChannel()) {
                    $result[$idx1]['products'][$idx2]['LowestOfferListings'][$idx6]['Qualifiers']['FulfillmentChannel'] = $qualifiers->getFulfillmentChannel();
                  }
                  if ($qualifiers->isSetShipsDomestically()) {
                    $result[$idx1]['products'][$idx2]['LowestOfferListings'][$idx6]['Qualifiers']['ShipsDomestically'] = $qualifiers->getShipsDomestically();
                  }
                  if ($qualifiers->isSetShippingTime()) { 
                    $result[$idx1]['products'][$idx2]['LowestOfferListings'][$idx6]['Qualifiers']['ShippingTime'] = array();
                    $shippingTime = $qualifiers->getShippingTime();
                    if ($shippingTime->isSetMax()) {
                      $result[$idx1]['products'][$idx2]['LowestOfferListings'][$idx6]['Qualifiers']['ShippingTime']['Max'] = $shippingTime->getMax();
                    }
                  } 
                  if ($qualifiers->isSetSellerPositiveFeedbackRating()) {
                    $result[$idx1]['products'][$idx2]['LowestOfferListings'][$idx6]['Qualifiers']['SellerPositiveFeedbackRating'] = $qualifiers->getSellerPositiveFeedbackRating();
                  }
                } 
                if ($lowestOfferListing->isSetNumberOfOfferListingsConsidered()) {
                  $result[$idx1]['products'][$idx2]['LowestOfferListings'][$idx6]['NumberOfOfferListingsConsidered'] = $lowestOfferListing->getNumberOfOfferListingsConsidered();
                }
                if ($lowestOfferListing->isSetSellerFeedbackCount()) {
                  $result[$idx1]['products'][$idx2]['LowestOfferListings'][$idx6]['SellerFeedbackCount'] = $lowestOfferListing->getSellerFeedbackCount();
                }
                if ($lowestOfferListing->isSetPrice()) { 
                  $result[$idx1]['products'][$idx2]['LowestOfferListings'][$idx6]['Price'] = array();
                  $price1 = $lowestOfferListing->getPrice();
                  if ($price1->isSetLandedPrice()) { 
                    $result[$idx1]['products'][$idx2]['LowestOfferListings'][$idx6]['Price']['LandedPrice'] = array();
                    $landedPrice1 = $price1->getLandedPrice();
                    if ($landedPrice1->isSetCurrencyCode()) {
                      $result[$idx1]['products'][$idx2]['LowestOfferListings'][$idx6]['Price']['LandedPrice']['CurrencyCode'] = $landedPrice1->getCurrencyCode();
                    }
                    if ($landedPrice1->isSetAmount()) {
                      $result[$idx1]['products'][$idx2]['LowestOfferListings'][$idx6]['Price']['LandedPrice']['Amount'] = $landedPrice1->getAmount();
                    }
                  } 
                  if ($price1->isSetListingPrice()) { 
                    $result[$idx1]['products'][$idx2]['LowestOfferListings'][$idx6]['ListingPrice'] = array();
                    $listingPrice1 = $price1->getListingPrice();
                    if ($listingPrice1->isSetCurrencyCode()) {
                      $result[$idx1]['products'][$idx2]['LowestOfferListings'][$idx6]['ListingPrice']['CurrencyCode'] = $listingPrice1->getCurrencyCode();
                    }
                    if ($listingPrice1->isSetAmount()) {
                      $result[$idx1]['products'][$idx2]['LowestOfferListings'][$idx6]['ListingPrice']['Amount'] = $listingPrice1->getAmount();
                    }
                  } 
                  if ($price1->isSetShipping()) { 
                    $result[$idx1]['products'][$idx2]['LowestOfferListings'][$idx6]['Shipping'] = array();
                    $shipping1 = $price1->getShipping();
                    if ($shipping1->isSetCurrencyCode()) {
                      $result[$idx1]['products'][$idx2]['LowestOfferListings'][$idx6]['Shipping']['CurrencyCode'] = $shipping1->getCurrencyCode();
                    }
                    if ($shipping1->isSetAmount()) {
                      $result[$idx1]['products'][$idx2]['LowestOfferListings'][$idx6]['Shipping']['Amount'] = $shipping1->getAmount();
                    }
                  } 
                } 
                if ($lowestOfferListing->isSetMultipleOffersAtLowestPrice()) {
                  $result[$idx1]['products'][$idx2]['LowestOfferListings'][$idx6]['MultipleOffersAtLowestPrice'] = $lowestOfferListing->getMultipleOffersAtLowestPrice();
                }
                $idx6 += 1;
              }
            } 
            if ($product->isSetOffers()) { 
              $result[$idx1]['products'][$idx2]['Offers'] = array();
              $offers = $product->getOffers();
              $offerList = $offers->getOffer();
              $idx7 = 0;
              foreach ($offerList as $offer) {
                $result[$idx1]['products'][$idx2]['Offers'][$idx7] = array();
                if ($offer->isSetBuyingPrice()) { 
                  $result[$idx1]['products'][$idx2]['Offers'][$idx7]['BuyingPrice'] = array();
                  $buyingPrice = $offer->getBuyingPrice();
                  if ($buyingPrice->isSetLandedPrice()) { 
                    $result[$idx1]['products'][$idx2]['Offers'][$idx7]['BuyingPrice']['LandedPrice'] = array();
                    $landedPrice2 = $buyingPrice->getLandedPrice();
                    if ($landedPrice2->isSetCurrencyCode()) {
                      $result[$idx1]['products'][$idx2]['Offers'][$idx7]['BuyingPrice']['LandedPrice']['CurrencyCode'] = $landedPrice2->getCurrencyCode();
                    }
                    if ($landedPrice2->isSetAmount()) {
                      $result[$idx1]['products'][$idx2]['Offers'][$idx7]['BuyingPrice']['LandedPrice']['Amount'] = $landedPrice2->getAmount();
                    }
                  } 
                  if ($buyingPrice->isSetListingPrice()) { 
                    $result[$idx1]['products'][$idx2]['Offers'][$idx7]['BuyingPrice']['ListingPrice'] = array();
                    $listingPrice2 = $buyingPrice->getListingPrice();
                    if ($listingPrice2->isSetCurrencyCode()) {
                      $result[$idx1]['products'][$idx2]['Offers'][$idx7]['BuyingPrice']['ListingPrice']['CurrencyCode'] = $listingPrice2->getCurrencyCode();
                    }
                    if ($listingPrice2->isSetAmount()) {
                      $result[$idx1]['products'][$idx2]['Offers'][$idx7]['BuyingPrice']['ListingPrice']['Amount'] = $listingPrice2->getAmount();
                    }
                  } 
                  if ($buyingPrice->isSetShipping()) { 
                    $result[$idx1]['products'][$idx2]['Offers'][$idx7]['BuyingPrice']['Shipping'] = array();
                    $shipping2 = $buyingPrice->getShipping();
                    if ($shipping2->isSetCurrencyCode()) {
                      $result[$idx1]['products'][$idx2]['Offers'][$idx7]['BuyingPrice']['Shipping']['CurrencyCode'] = $shipping2->getCurrencyCode();
                    }
                    if ($shipping2->isSetAmount()) {
                      $result[$idx1]['products'][$idx2]['Offers'][$idx7]['BuyingPrice']['Shipping']['Amount'] = $shipping2->getAmount();
                    }
                  } 
                } 
                if ($offer->isSetRegularPrice()) { 
                  $result[$idx1]['products'][$idx2]['Offers'][$idx7]['RegularPrice'] = array();
                  $regularPrice = $offer->getRegularPrice();
                  if ($regularPrice->isSetCurrencyCode()) {
                    $result[$idx1]['products'][$idx2]['Offers'][$idx7]['RegularPrice']['CurrencyCode'] = $regularPrice->getCurrencyCode();
                  }
                  if ($regularPrice->isSetAmount()) {
                    $result[$idx1]['products'][$idx2]['Offers'][$idx7]['RegularPrice']['Amount'] = $regularPrice->getAmount();
                  }
                } 
                if ($offer->isSetFulfillmentChannel()) {
                  $result[$idx1]['products'][$idx2]['Offers'][$idx7]['FulfillmentChannel'] = $offer->getFulfillmentChannel();
                }
                if ($offer->isSetItemCondition()) {
                  $result[$idx1]['products'][$idx2]['Offers'][$idx7]['ItemCondition'] = $offer->getItemCondition();
                }
                if ($offer->isSetItemSubCondition()) {
                  $result[$idx1]['products'][$idx2]['Offers'][$idx7]['ItemSubCondition'] = $offer->getItemSubCondition();
                }
                if ($offer->isSetSellerId()) {
                  $result[$idx1]['products'][$idx2]['Offers'][$idx7]['SellerId'] = $offer->getSellerId();
                }
                if ($offer->isSetSellerSKU()) {
                  $result[$idx1]['products'][$idx2]['Offers'][$idx7]['SellerSKU'] = $offer->getSellerSKU();
                }
                $idx7 += 1;
              }
            } 
            $idx2 += 1;
          }
        } 
        if ($getMatchingProductForIdResult->isSetError()) { 
          $result[$idx1]['Error'] = array();
          $error = $getMatchingProductForIdResult->getError();
          if ($error->isSetType()) {
            $result[$idx1]['Error']['Type'] = $error->getType();
          }
          if ($error->isSetCode()) {
            $result[$idx1]['Error']['Code'] = $error->getCode();
          }
          if ($error->isSetMessage()) {
            $result[$idx1]['Error']['Message'] = $error->getMessage();
          }
        } 
        $idx1 += 1;
      }
      $metadata = array();
      if ($response->isSetResponseMetadata()) { 
        $metadata['ResponseMetadata'] = array();
        $responseMetadata = $response->getResponseMetadata();
        if ($responseMetadata->isSetRequestId()) {
          $metadata['ResponseMetadata']['RequestId'] = $responseMetadata->getRequestId();
        }
      } 
      $headerMetadata = array();
      $headerMetadata['ResponseHeaderMetadata'] = $response->getResponseHeaderMetadata();
      $results = array(
        'Result'         => $result
      , 'Metadata'       => $metadata
      , 'HeaderMetadata' => $headerMetadata
      );
    } catch (MarketplaceWebServiceProducts_Exception $ex) {
      echo("Caught Exception: " . $ex->getMessage() . "\n");
      echo("Response Status Code: " . $ex->getStatusCode() . "\n");
      echo("Error Code: " . $ex->getErrorCode() . "\n");
      echo("Error Type: " . $ex->getErrorType() . "\n");
      echo("Request ID: " . $ex->getRequestId() . "\n");
      echo("XML: " . $ex->getXML() . "\n");
      echo("ResponseHeaderMetadata: " . $ex->getResponseHeaderMetadata() . "\n");
    }
    return $results;
  }

  private function toString($nodeList)
  {
    foreach ($nodeList as $domNode){
      $domDocument =  new \DOMDocument();
      $domDocument->preserveWhiteSpace = false;
      $domDocument->formatOutput = true;
      $nodeStr = $domDocument->saveXML($domDocument->importNode($domNode,true));
      return $nodeStr;
    }
  }

  private function toArray($nodeList)
  {
    foreach ($nodeList as $domNode){
      return $this->xml_to_array($domNode);
    }
  }

  private function xml_to_array($root)
  {
    $result = array();
    if ($root->hasAttributes()) {
      $attrs = $root->attributes;
      foreach ($attrs as $attr) {
        $result['@attributes'][$attr->name] = $attr->value;
      }
    }

    if ($root->hasChildNodes()) {
      $children = $root->childNodes;
      if ($children->length == 1) {
        $child = $children->item(0);
        if ($child->nodeType == XML_TEXT_NODE) {
          $result['_value'] = $child->nodeValue;
          return count($result) == 1
            ? $result['_value']
            : $result;
        }
      }
      $groups = array();
      foreach ($children as $child) {
        if (!isset($result[$child->nodeName])) {
          $result[$child->nodeName] = $this->xml_to_array($child);
        } else {
          if (!isset($groups[$child->nodeName])) {
            $result[$child->nodeName] = array($result[$child->nodeName]);
            $groups[$child->nodeName] = 1;
          }
          $result[$child->nodeName][] = $this->xml_to_array($child);
        }
      }
    }

    return $result;
  }
}

