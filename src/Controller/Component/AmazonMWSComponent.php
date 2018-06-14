<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\ORM\TableRegistry;
use MarketplaceWebServiceProducts\Component\GetMatchingProductForIdComponent;
use MarketplaceWebServiceSellers\Component\ListMarketplaceParticipationsComponent;
use MarketplaceWebService\Component\GetReportComponent;
use MarketplaceWebService\Component\SubmitFeedComponent;

/**
 * AmazonMWS component
 */
class AmazonMWSComponent extends Component
{
  // Market Place Endpoint.
  public const MWS_MARKETPLACE_JP = 'A1VC38T7YXB528';
  public const MWS_BASEURL_JP     = 'https://mws.amazonservices.jp/';
  public const MWS_MARKETPLACE_US = 'ATVPDKIKX0DER';
  public const MWS_BASEURL_US     = 'https://mws.amazonservices.com/';
  public const MWS_MARKETPLACE_AU = 'A39IBJ37TRP1C6';
  public const MWS_BASEURL_AU     = 'https://mws.amazonservices.com.au/';
  public const MWS_CREATE_FEED    = '_POST_FLAT_FILE_LISTINGS_DATA_';
  public const MWS_ADDDEL_FEED    = '_POST_FLAT_FILE_INVLOADER_DATA_';
  public const MWS_UPDATE_FEED    = '_POST_FLAT_FILE_PRICEANDQUANTITYONLY_UPDATE_DATA_';

  /**
   * Default configuration.
   *
   * @var array
   */
  protected $_defaultConfig = [];

  /**
   *
   * Amazon MWS ListMarketplaceParticipations(1) / GetServiceStatus(2)
   * 
   * (1) max request quota = 15 request / 60 request per hour.
   * (2) max request quota =  2 request /  1 request per 5mini.
   * response: ListParticipations, ListMarketplaces.
   *
   */
  public function listMarketplaceParticipations($params)
  {
    $amazon = new ListMarketplaceParticipationsComponent($params);
    return $amazon->fetch();
  }

  /**
   *
   * Amazon MWS RequestReport(1) / GetReportRequestList(2) / GetReportRequest(3)
   * 
   * (1) max request quota = 15 request / 60 request per hour, recovery rate = 1 count/min.
   * (2) max request quota = 10 request / 80 request per hour, recovery rate = 1 count/45sec.
   * (3) max request quota = 10 request / 80 request per hour, reconery rate = 1 count/45sec.
   * response: RequestReport, GetReportRequestList, GetReportRequest.
   *
   */
  public function GetReport($params) 
  {
    $amazon = new GetReportComponent($params);
    return $amazon->fetch();
  }

  /**
   * Amazon MWS GetMatchingProductForIdRequest(1)
   *
   * (1) max request quota = 20 request / 18000 request per hour, recovery rate = 5 item/1sec.
   * response: GetMatchingProductForId.
   */
  public function GetMatchingProduct($params)
  {
    $amazon = new GetMatchingProductForIdComponent($params);
    return $amazon->fetch();
  }

  /**
   * Amazon MWS SubmitFeed(1) / GetSubmissionList(2) / GetFeedSubmissionResult(3)
   *
   * (1) max request quota = 15 request / 30 request per hour, recovery rate = 1 count/2min.
   * (2) max request quota = 10 request / 80 request per hour, recovery rate = 1 count/45sec.
   * (3) max request quota = 15 request / 60 request per hour, recovery rate = 1 count/min.
   */
  public function create($params)
  {
    $amazon = new SubmitFeedComponent($params);
    return $amazon->create();
  }

  public function adddel($params)
  {
    $amazon = new SubmitFeedComponent($params);
    return $amazon->adddel();
  }

  public function update($params)
  {
    $amazon = new SubmitFeedComponent($params);
    return $amazon->update();
  }

  public function insertAsin($filename, $suspended)
  {
    $header = array(
      'asin' => true
    , 'marketplace' => true
    , 'created' => true
    , 'modified' => true
    , 'suspended' => true
    );
    $asins = TableRegistry::get('Asins');
    $datas = $this->setAsin($filename, $header, $suspended);
    $query = $asins->query();
    $query->insert(array_keys($header));
    foreach($datas as $data) {
      $query->values($data);
    }
    if(!$query->execute()) {
      $this->error($query->errors());
      return false;
    }
    return true;
  }

  public function upsertAsin($filename, $suspended)
  {
    $header = array(
      'asin' => true
    , 'marketplace' => true
    , 'created' => true
    , 'modified' => true
    , 'suspended' => true
    );
    $asins = TableRegistry::get('Asins');
    $datas = $this->setAsin($filename, $header, $suspended);
    foreach($datas as $data) {
      $entity = $asins->newEntity($data);
      $asin = $asins->find()
        ->where(['asin' => $entity->asin, 'marketplace' => $entity->marketplace])
        ->first();
      if($asin) {
        unset($data['created']);
        $entity = $asins->patchEntity($asin, $data);
      }
      if(!$asins->save($entity)) {
        $this->error($asins->errors());
        return false;
      }
    }
    return true;
  }

  private function setAsin($filename, $header, $suspended)
  {
    $datas = array();
    $datetime = date('Y-m-d H:i:s');
    $org_file = @fopen($filename, 'rb') or die("File can not opened.\n");
    flock($org_file, LOCK_SH);
    while($row = fgetcsv($org_file, 1024, "\t")) {
      $idx = 0; $_idx = 0;
      foreach(array_keys($header) as $_header) {
        if(array_values($header)[$_idx]) {
          if($_header === 'created' || $_header === 'modified') {
            $_body = $datetime;
          } else if($_header === 'suspended' && $suspended === FALSE) {
            $_body = 0;
          } else if($_header === 'suspended' && $suspended === TRUE) {
            $_body = 1;
          } else {
            $_body = $this->encode($row[$idx]);
            $idx += 1;
          }
          $_idx += 1;
        } else {
          $_body = 'N/A';
          $_idx += 1;
        }
        $data[$_header] = $_body;
      }
      debug($data);
      array_push($datas, $data);
    }
    flock($org_file, LOCK_UN);
    fclose($org_file);
    return $datas;
  }

  public function error($message)
  {
    $this->log(print_r($message, true), LOG_DEBUG);
  }
}
