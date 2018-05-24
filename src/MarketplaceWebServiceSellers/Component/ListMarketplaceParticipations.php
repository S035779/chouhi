<?php
namespace MarketplaceWebServiceSellers\Component;

require_once dirname(__FILE__) . '/../Samples/.config.inc.php';

use MarketplaceWebServiceSellers\MarketplaceWebServiceSellers_Client;
use MarketplaceWebServiceSellers\Model\MarketplaceWebServiceSellers_Model_ListMarketplaceParticipationsRequest;
use MarketplaceWebServiceSellers\MarketplaceWebServiceSellers_Interface;
use MarketplaceWebServiceSellers\MarketplaceWebServiceSellers_Exception;

class ListMarketplaceParticipations {

  public function fetch($params) {
    $config = array (
      'ServiceURL' => $params['BaseURL'] . 'Sellers/2011-07-01',
      'ProxyHost' => null,
      'ProxyPort' => -1,
      'ProxyUsername' => null,
      'ProxyPassword' => null,
      'MaxErrorRetry' => 3,
    );
    $service = new MarketplaceWebServiceSellers_Client(
      $params['AWSAccessKeyId'],
      $params['AWSSecretKey'],
      env('APP_NAME'),
      env('APP_VERSION'),
      $config
    );
    $request = new MarketplaceWebServiceSellers_Model_ListMarketplaceParticipationsRequest();
    $request->setSellerId($params['SellerId']);
    return $this->invokeListMarketplaceParticipations($service, $request);
  }

  private function invokeListMarketplaceParticipations(MarketplaceWebServiceSellers_Interface $service, $request) {
    try {
      $response = $service->ListMarketplaceParticipations($request);
      $result = array();
      if($response->isSetListMarketplaceParticipationsResult()) {
        $listMarketplaceParticipationsResult
          = $response->getListMarketplaceParticipationsResult();
        if($listMarketplaceParticipationsResult->isSetNextToken()) {
          $result['NextToken'] = $listMarketplaceParticipationsResult->getNextToken();
        }
        if($listMarketplaceParticipationsResult->isSetListParticipations()) {
          $listParticipations
            = $listMarketplaceParticipationsResult->getListParticipations();
          $participations = $listParticipations->getParticipation();
          $result['Participations'] = array();
          $idx1 = 0;
          foreach($participations as $participation) {
            $result['Participations'][$idx1]['MarketplaceId']
              = $participation->getMarketplaceId();
            $result['Participations'][$idx1]['SellerId']
              = $participation->getSellerId();
            $result['Participations'][$idx1]['Suspended']
              = $participation->getHasSellerSuspendedListings();
            $idx1 += 1;
          }
        }
        $result['Marketplaces'] = array();
        $idx2 = 0;
        if($listMarketplaceParticipationsResult->isSetListMarketplaces()) {
          $listMarketplaces = $listMarketplaceParticipationsResult->getListMarketplaces();
          $marketplaces = $listMarketplaces->getMarketplace();
          foreach($marketplaces as $marketplace) {
            $result['Marketplaces'][$idx2]['MarketplaceId']
              = $marketplace->getMarketplaceId();
            $result['Marketplaces'][$idx2]['Name']
              = $marketplace->getName();
            $result['Marketplaces'][$idx2]['CountryCode']
              = $marketplace->getDefaultCountryCode();
            $result['Marketplaces'][$idx2]['DomainName']
              = $marketplace->getDomainName();
            $idx2 += 1;
          }
        }
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
    } catch (MarketplaceWebServiceSellers_Exception $ex) {
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
}


