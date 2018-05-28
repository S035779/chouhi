<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Form\UploadFilesForm;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * Bootstrap Controller
 *
 *
 * @method \App\Model\Entity\Bootstrap[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BootstrapController extends AppController
{
  public $helpers =['Paginator' => ['templates' => 'paginator-templates']];
  
  public function initialize()
  {
    parent::initialize();
    $this->viewBuilder()->setLayout('dashboard');
    $this->loadComponent('Common');
  }

  public function beforeFilter(Event $event)
  {
    parent::beforeFilter($event);
  }

  public function isAuthorized($user) {
    $this->user = $user;
    return true;
  }

  /**
   * Index method
   *
   * @return \Cake\Http\Response|void
   */
  public function index()
  {
    $title = 'Dashboard of AmazonMWS tools';
    $this->set(compact('title'));
  }

  /**
   * Token method
   *
   * @return \Cake\Http\Response|void
   */
  public function token()
  {
    $title = 'Token registration for AmazonMWS tools';
    $tokens = TableRegistry::get('Tokens'); 
    $token = $tokens->find()->contain(['Sellers'])
      ->where(['Sellers.email' => $this->user['email']])
      ->first();

    if ($this->request->is(['patch', 'post', 'put'])) {
      $request = $this->request->getData();
      if (isset($this->request->data['registration'])) {
        if ($token) {
          $entity = $tokens->patchEntity($token, $request);
        } else {
          $request['suspended'] = 0;
          $request['seller']['email'] = $this->user['email'];
          $entity = $tokens->newEntity($request);
        }
        if ($tokens->save($entity)) {
          $this->Flash->success(__('The token has been saved.'));
          return $this->redirect(['action' => 'index']);
        }
        $this->Common->debug($entity->errors());
        $this->Flash->error(__('The token cound not be saved. Please, try again.'));
      } elseif (isset($this->request->data['confirmation'])) {
        switch($request['seller']['marketplace']) {
          case 'JP':
            $mws_base_url = $this->Common::MWS_BASEURL_JP;
            $mws_marketId = $this->Common::MWS_MARKETPLACE_JP;
            break;
          case 'AU':
            $mws_base_url = $this->Common::MWS_BASEURL_AU;
            $mws_marketId = $this->Common::MWS_MARKETPLACE_AU;
            break;
          case 'US':
            $mws_base_url = $this->Common::MWS_BASEURL_US;
            $mws_marketId = $this->Common::MWS_MARKETPLACE_US;
            break;
        }
        //$jobType = 1;
        $params=array();
        $params['AWSAccessKeyId']   = $request['access_key'];
        $params['AWSSecretKey']     = $request['secret_key'];
        $params['SellerId']         = $request['seller']['seller'];
        $params['BaseURL']          = $mws_base_url;
        $response = $this->Common->listMarketplaceParticipations($params);
        $suspended = '';
        foreach($response['Result']['Participations'] as $participations) {
          if($participations['MarketplaceId'] === $mws_marketId
            && $participations['SellerId'] === $request['seller']['seller']) {
            $suspended = $participations['Suspended'];
          } 
        }
        if($suspended === 'No') {
          $this->Flash->success(__('The token has been confirmed.'));
        } else {
          $this->Common->debug($entity->errors());
          $this->Flash->error(__('The token cound not be confirmed. Please, try again.'));
        }
      }
    }
    $this->set(compact('title', 'token'));
  }

  /**
   * Search method
   *
   * @return \Cake\Http\Response|void
   */
  public function search()
  {
    $title = 'Search Amazon items';
    $offers = TableRegistry::get('Offers'); 

    if($this->request->is('get')) {
      $request = $this->request->getData();

      $conditions = array();

      if(!empty($request['period'])) {
        $timestamp = strtotime('-' . $request['period']. ' day');
        $conditions['Offers.created >='] = new DateTime($timestamp);
      }

      if(!empty($request['riserate'])) {
      //  $request['riserate'] >=
      //    $stopprice->lowest_price / $startPrice->lowest_price * 100 - 100;
      }

      if(!empty($request['profitrange'])) {
      //  $request['profitrange'] >=
      //    $stopprice->lowest_price - $startprice->lowest_price;
      }

      $query    = $offers->find()->contain(['Items']);
      $subquery = $offers->find();
      $query
        ->select([
          'id'                              => 'items.id'
        , 'title'                           => 'items.title'
        , 'asin'                            => 'offers.asin'
        , 'detail_page_url'                 => 'items.detail_page_url'
        , 'total_new'                       => 'items.total_new'
        , 'total_used'                      => 'items.total_used'
        , 'customer_reviews_url'            => 'items.customer_reviews_url'
        , 'average_sales_ranking'           => $query->func()->avg('offers.sales_ranking')
        , 'product_group'                   => 'items.product_group'
        , 'sales_ranking'                   => 'items.sales_ranking'
        , 'lowest_price'                    => 'items.lowest_price'
        , 'lowest_price_currency'           => 'items.lowest_price_currency'
        , 'average_lowest_price'            => $query->func()->avg('offers.lowest_price')
        , 'average_lowest_price_currency'   => 'items.lowest_price_currency'
        , 'original_release_date_at'        => 'items.original_release_date_at'
        , 'release_date_at'                 => 'items.release_date_at'
        , 'publication_date_at'             => 'items.publication_date_at'
        , 'large_image_url'                 => 'items.large_image_url'
        , 'created'                         => $query->func()->max('offers.created')
        ])
        //->where(function($e, $q) use ($subquery) {
        //  $q->select(['created_max' => $subquery->func()->max('Offers2.created')])
        //    ->from(['Offers2' => 'offers'])
        //    ->first();
        //  return $e->eq('Offers.created', $q);
        //})
        ->where(function($e) {
          return $e->gte('Offers.created', '2018-05-27');
        })
        //->where(function($e, $q) use ($subquery) {
        //  $start_date = $subquery->func()->min('created');
        //  $stop_date  = $subquery->func()->max('created');

        //  $start_price = $q->select(['lowest_price'])
        //    ->where(['Offers.created' => $subquery
        //      ->select(['create_max' => $start_date])
        //      ->where(['Offers.asin' => 'asin'])
        //      ->first()
        //    ])
        //    ->first();

        //  $stop_price = $q->select(['lowest_price'])
        //    ->where(['Offers.created' => $subquery
        //      ->select(['create_max' => $stop_date])
        //      ->where(['Offers.asin' => 'asin'])
        //      ->first()
        //    ])
        //    ->first();
        //  debug($start_price);
        //  debug($stop_price);
        //  $exp1 = $q->newExpr()->add($stop_price.' / '.$start_price.' * 100 - 100');
        //  $exp2 = $q->newExpr()->add($stop_price.' - '.$start_prife);
        //  return $e->add(exp1)->add(exp2);

        //})
        ->group(['Offers.asin','Items.id'])
        ->all();

      // START PRICE
      // 
      // SELECT *
      // FROM テーブル名 テーブル別名
      // WHERE 取引日付 = (
      //   SELECT MIN(取引日付)
      //    FROM テーブル名 
      //    WHERE 銘柄コード= テーブル別名.銘柄コード
      //   )
      //
      // STOP PRICE
      // 
      // SELECT *
      // FROM テーブル名 テーブル別名
      // WHERE 取引日付 = (
      //   SELECT MAX(取引日付)
      //    FROM テーブル名 
      //    WHERE 銘柄コード= テーブル別名.銘柄コード
      //   )
    }

    $offers = $this->paginate($query);
    //debug($offers);
    $this->set(compact('title', 'offers'));
  }

  /**
   * Market method
   *
   * @return \Cake\Http\Response|void
   */
  public function market()
  {
    $title = 'Amazon market listing';
    $this->set(compact('title'));
  }

  /**
   * Setting method
   *
   * @return \Cake\Http\Response|void
   */
  public function setting()
  {
    $title = 'User setting';
    $users = TableRegistry::get('Users'); 
    $user = $users->find()
      ->where(['email' => $this->user['email']])
      ->first();

    if ($this->request->is(['patch', 'post', 'put'])) {
      $request = $this->request->getData();
      if($user && $request['password'] === $request['confirm_password']) {
        $entity = $users->patchEntity($user, $request);
        if ($users->save($entity)) {
          $this->Flash->success(__('The password has been changed.'));
          return $this->redirect(['action' => 'index']);
        }
      }
      $this->Common->debug($entity->errors());
      $this->Flash->error(__('The password cound not be changed. Please, try again.'));
    }
    $this->set(compact('title', 'user'));
  }

  /**
   * ASIN registration method
   *
   * @return \Cake\Http\Response|void
   */
  public function registration()
  {
    $title = 'ASIN registration';
    $fileform = new UploadFilesForm();
    if($this->request->is('post')) {
      if($fileform->validate($this->request->data)) {
        $tmp_file = $this->request->data['upload_file']['tmp_name'];
        $new_file = sprintf(ROOT.'\storage\%s'
          , $this->request->data['upload_file']['name'] . '_' . time());
        move_uploaded_file($tmp_file, $new_file);
        if($this->upsertAsin($new_file, FALSE)) {
          $this->Flash->success(__('The csv file has been uploaded.'));
        } else {
          $this->Flash->error(__('The csv file did not complete the upload.'));
        }
      }
    }
    $this->set(compact('title', 'fileform'));
  }

  /**
   * Suspened ASIN registration method
   *
   * @return \Cake\Http\Response|void
   */
  public function suspension()
  {
    $title = 'Suspened ASIN registration';
    $fileform = new UploadFilesForm();
    if($this->request->is('post')) {
      if($fileform->validate($this->request->data)) {
        $tmp_file = $this->request->data['upload_file']['tmp_name'];
        $new_file = sprintf(ROOT.'\storage\%s'
          , $this->request->data['upload_file']['name'] . '_' . time());
        move_uploaded_file($tmp_file, $new_file);
        if($this->upsertAsin($new_file, TRUE)) {
          $this->Flash->success(__('The csv file has been uploaded.'));
        } else {
          $this->Flash->error(__('The csv file did not complete the upload.'));
        }
      }
    }
    $this->set(compact('title', 'fileform'));
  }

  /**
   * Calculation method
   *
   * @return \Cake\Http\Response|void
   */
  public function calculation()
  {
    $title = 'Price calculation';
    $this->set(compact('title'));
  }

  private function insertAsin($filename, $suspended)
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
      $this->logError($query->errors());
      return false;
    }
    return true;
  }

  private function upsertAsin($filename, $suspended)
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
        $this->logError($asins->errors());
        return false;
      }
    }
    return true;
  }

  private function logError($message)
  {
    $this->log(print_r($message, true),LOG_DEBUG);
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
            $_body = $this->e($row[$idx]);
            $idx += 1;
          }
          $_idx += 1;
        } else {
          $_body = 'N/A';
          $_idx += 1;
        }
        $data[$_header] = $_body;
      }
      array_push($datas, $data);
    }
    flock($org_file, LOCK_UN);
    fclose($org_file);
    return $datas;
  }

  private function e($str)
  {
    return mb_convert_encoding($str, 'utf8', 'sjis-win');
  }

}
