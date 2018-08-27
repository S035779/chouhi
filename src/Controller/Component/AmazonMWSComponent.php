<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\ORM\TableRegistry;
use Cake\Log\Log;
use MarketplaceWebServiceProducts\Component\GetMatchingProductForIdComponent;
use MarketplaceWebServiceSellers\Component\ListMarketplaceParticipationsComponent;
use MarketplaceWebService\Component\GetReportComponent;
use MarketplaceWebService\Component\SubmitFeedComponent;
use Goodby\CSV\Import\Standard\LexerConfig;
use Goodby\CSV\Import\Standard\Interpreter;
use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Export\Standard\Exporter;
use Goodby\CSV\Export\Standard\ExporterConfig;
use Goodby\CSV\Export\Standard\Collection\CallbackCollection;

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

  public function fetchDeliverys($filename) 
  {
    $head = array('id', 'method', 'area', 'price', 'length', 'total_length', 'weight', 'duedate');
    $deliverys = TableRegistry::get('Deliverys');
    $datas = $deliverys->find()
      ->select($head)
      ->hydrate(false)->toArray();
    $collection = new CallbackCollection($datas, function($row) { return $row; });

    $config = new ExporterConfig();
    $exporter = new Exporter($config);

    $exporter->export($filename, $collection);
    return true;
  }

  public function upsertDeliverys($filename) 
  {
    $idx = 0;
    $error = 0;
    $deliverys = TableRegistry::get('Deliverys');
    $config = new LexerConfig();
    $config
      ->setDelimiter(',')
      ->setEnclosure('"')
      ->setEscape('\\')
      ->setIgnoreHeaderLine(false);
    $lexer = new Lexer($config);
    $interpreter = new Interpreter();
    $interpreter->addObserver(function(array $row) use ($deliverys, &$idx, &$error) {
      if($idx > 1000) {
        $error = 1;
        return;
      }
      $head = array(
        'id' => true
      , 'method' => true
      , 'area' => true
      , 'price' => true
      , 'length' => true
      , 'total_length' => true
      , 'weight' => true
      , 'duedate' => true
      , 'created' => true
      , 'modified' => true
      );
      $data = $this->setDelivery($head, $row);
      $entity = $deliverys->newEntity($data);
      $delivery = $deliverys->get($data['id']);
      if($delivery) {
        unset($data['created']);
        $entity = $deliverys->patchEntity($delivery, $data);
      }
      if(!$deliverys->save($entity)) {
        $this->log_debug($entity->errors());
        $error = 99;
        return;
      }
      $idx += 1;
    });
    $lexer->parse($filename, $interpreter);
    return ['error' => $error, 'line' => $idx];
  }

  private function setDelivery($head, $row) {
    $keys = array_keys($head);
    $vals = array_values($head);
    $idx = 0; $_idx = 0;
    $data = array();
    foreach($keys as $_head) {
      if($vals[$_idx]) {
        switch($_head) {
        case 'created':
        case 'modified':
          $_body = date('Y-m-d H:i:s');
          break;
        default:
          $_body = $this->encode($row[$idx]);
          $idx += 1;
          break;
        }
        $data[$_head] = $_body;
      }
      $_idx += 1;
    }
    return $data;
  }

  public function fetchAsin()
  {
    $fp = fopen('php://output', 'w');
    stream_filter_append($fp, 'convert.iconv.UTF-8/CP932', STREAM_FILTER_WRITE);
    $asin_list=[[
      'ASIN','Brand','Title','Category','Description','WordCount','Rating','ListPrice','Price','Discount'
      , 'Shipping','TotalPrice','ParentASIN','ChildASIN','Available','Fulfilled','Thumbnail','URL'
      , 'AffiateLink','Images','EAN','UPC','SalesRank','Prime','ReviewCount'
    ]];
    foreach($asin_list as $asin) {
      fputcsv($fp, $asin);
    }
    fclose($fp);
  }

  public function upsertAsin($filename, $suspended) 
  {
    $idx = 0;
    $error= 0;
    $asins = TableRegistry::get('Asins');
    $config = new LexerConfig();
    $config
      ->setDelimiter(',')
      ->setEnclosure('"')
      ->setEscape('\\')
      ->setIgnoreHeaderLine(true);
    $lexer = new Lexer($config);
    $interpreter = new Interpreter();
    $interpreter->addObserver(function(array $row) use ($suspended, $asins, &$idx, &$error) {
      if($idx > 1000) {
        $error = 1;
        return;
      }
      $head = count($row) <= 2
        ? array('asin' => true, 'marketplace' => true
          , 'suspended' => true, 'created' => true, 'modified' => true)
        : array('asin' => true, 'brand' => true, 'title' => true, 'category' => true
          , 'description' => true, 'wordcount' => true, 'rating' => true, 'listprice' => true
          , 'price' => true, 'discount' => true, 'shipping' => true, 'totalprice' => true
          , 'parentasin' => true, 'childasin' => true, 'available' => true, 'fulfilled' => true
          , 'thumbnail' => true,	'url' => true, 'affiatelink' => true, 'images' => true
          , 'ean' => true, 'upc' => true, 'salesrank' => true, 'prime' => true, 'reviewcount' => true
          , 'suspended' => true, 'created' => true, 'modified' => true);
      $data = $this->setAsin($head, $row, $suspended);
      $entity = $asins->newEntity($data);
      $asin = $asins->find()
        ->where(['asin' => $entity->asin, 'marketplace' => $entity->marketplace])
        ->first();
      if($asin) {
        unset($data['created']);
        $entity = $asins->patchEntity($asin, $data);
      }
      if(!$asins->save($entity)) {
        $this->log_debug($entity->errors());
        $error = 99;
        return;
      }
      $idx += 1;
    });
    $lexer->parse($filename, $interpreter);
    return ['error' => $error, 'line' => $idx];
  }

  private function setAsin($head, $row, $suspended) 
  {
    $keys = array_keys($head);
    $vals = array_values($head);
    $idx = 0; $_idx = 0;
    $data = array();
    foreach($keys as $_head) {
      if($vals[$_idx]) {
        switch ($_head) {
        case 'created':
        case 'modified':
          $_body = date('Y-m-d H:i:s');
          break;
        case 'suspended':
          $_body = $suspended ? 1 : 0;
          break;
        case 'url':
          $_head = 'marketplace';
          if(strpos($row[$idx],self::MWS_BASEURL_JP) === 0) {
            $_body ='JP'; 
          } elseif (strpos($row[$idx],self::MWS_BASEURL_US) === 0) {
            $_body ='US';
          } elseif (strpos($row[$idx],self::MWS_BASEURL_AU) === 0) {
            $_body ='AU'; 
          } else {
            $_body ='JP';
          }
          $idx += 1;
          break;
        case 'marketplace':
          $_body = $row[$idx] ?? 'JP';
          $idx += 1;
          break;
        default:
          $_body = $this->encode($row[$idx]);
          $idx += 1;
          break;
        }
        $data[$_head] = $_body;
      }
      $_idx += 1;
    }
    return $data;
  }

  private function encode($str)
  {
    return mb_convert_encoding($str, 'utf8', 'sjis-win');
  }

  public function log_error($message)
  {
    $displayName = '[' . __CLASS__ . '] ';
    Log::error($displayName . print_r($message, true), ['scope' => ['apps']]);
  }

  public function log_debug($message)
  {
    $displayName = '[' . __CLASS__ . '] ';
    Log::debug($displayName . print_r($message, true), ['scope' => ['apps']]);
  }
}
