<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Form\UploadFilesForm;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;

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
    $this->viewBuilder()->setLayout('dashboard_'.env('APP_TEMPLATE'));
    $this->loadComponent('Common');
    $this->loadComponent('AmazonMWS');
    $this->loadModel('Users');
    $this->loadModel('Sellers');
    $this->loadModel('Merchants');
    $this->loadModel('Asins');
  }

  public function beforeFilter(Event $event)
  {
    parent::beforeFilter($event);
  }

  public function isAuthorized($user) {
    if(in_array($this->request->getParam('action'), ['token', 'setting', 'calculation'])) {
      $this->Common->log_debug('enter the free_area.');
      return true;
    }

    if(
      in_array($this->request->getParam('action')
      , ['index', 'search', 'market', 'asins', 'registration', 'suspension'])
    ) {
      if($this->Sellers->hasToken($user['email'])) {
        $this->Common->log_debug('enter the user_area.');
        return true;
      }
    }
    $this->Common->log_debug('unknown area.');
    return parent::isAuthorized($user);
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
      ->where(['Sellers.email' => $this->Auth->user('email')])
      ->first();

    if ($this->request->is(['patch', 'post', 'put'])) {
      $request = $this->request->getData();
      if (isset($this->request->data['registration'])) {
        if ($token) {
          $entity = $tokens->patchEntity($token, $request);
        } else {
          $request['suspended'] = 0;
          $request['seller']['email'] = $this->Auth->user('email');
          $entity = $tokens->newEntity($request);
        }
        if ($tokens->save($entity)) {
          $this->Flash->success(__('The token has been saved.'));
          return $this->redirect(['action' => 'token']);
        }
        $this->Common->log_error($entity->errors());
        $this->Flash->error(__('The token cound not be saved. Please, try again.'));
      } elseif (isset($this->request->data['confirmation'])) {
        switch($request['seller']['marketplace']) {
          case 'JP':
            $mws_base_url = $this->AmazonMWS::MWS_BASEURL_JP;
            $mws_marketId = $this->AmazonMWS::MWS_MARKETPLACE_JP;
            break;
          case 'AU':
            $mws_base_url = $this->AmazonMWS::MWS_BASEURL_AU;
            $mws_marketId = $this->AmazonMWS::MWS_MARKETPLACE_AU;
            break;
          case 'US':
            $mws_base_url = $this->AmazonMWS::MWS_BASEURL_US;
            $mws_marketId = $this->AmazonMWS::MWS_MARKETPLACE_US;
            break;
        }
        $params=array();
        $params['AWSAccessKeyId']   = $request['access_key'];
        $params['AWSSecretKeyId']   = $request['secret_key'];
        $params['SellerId']         = $request['seller']['seller'];
        $params['BaseURL']          = $mws_base_url;
        $response = $this->AmazonMWS->listMarketplaceParticipations($params);
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
    $connection = ConnectionManager::get('default');
    $avg_hours = 0;
    $bck_hours = 24 * 1;
    $rise_rate = 0;
    $profit_range = 0;
    $offers = array();
    if($this->request->is('post')) {
      $request = $this->request->getData();
      if(!empty($request['period'       ]))  $avg_hours    = intval(   $request['period'      ]) * 24; 
      if(!empty($request['rise_rate'    ]))  $rise_rate    = floatval( $request['rise_rate'   ]);
      if(!empty($request['profit_range' ]))  $profit_range = intval(   $request['profit_range']);
      if($profit_range  < 0)  $_profit_range = 'profit_range <= :_profit_range';
      else                    $_profit_range = 'profit_range >= :_profit_range'; 
      if($rise_rate     < 0)  $_rise_rate = 'rise_rate <= :_rise_rate';
      else                    $_rise_rate = 'rise_rate >= :_rise_rate';
      $_offers = $connection
        ->execute('
          SELECT
            time1                                     AS created,
            Offers1.asin                              AS asin,
            Offers1.items_id                          AS id,
            Offers1.items_title                       AS title,
            Offers1.items_detail_page_url             AS detail_page_url,
            Offers1.items_total_new                   AS total_new,
            Offers1.items_total_used                  AS total_used,
            Offers1.items_customer_reviews_url        AS customer_reviews_url,
            Offers1.items_product_group               AS product_group,
            Offers1.items_sales_ranking               AS sales_ranking,
            Offers1.items_lowest_price                AS lowest_price,
            Offers1.items_lowest_price_currency       AS lowest_price_currency,
            Offers1.items_lowest_price_currency       AS average_lowest_price_currency,
            Offers1.items_original_release_date_at    AS original_release_date_at,
            Offers1.items_release_date_at             AS release_date_at,
            Offers1.items_publication_date_at         AS publication_date_at,
            Offers1.items_large_image_url             AS large_image_url, 
            COUNT(CASE WHEN time1 = time2 THEN Offers1.items_id ELSE NULL END)    AS time_event_count,
            SUM(Offers1.items_sales_ranking) / :_avg_hours                        AS average_sales_ranking,
            SUM(Offers1.items_lowest_price) / :_avg_hours                         AS average_lowest_price,
            Offers1.items_lowest_price - SUM(Offers1.lowest_price) / :_avg_hours  AS profit_range,
            MAX(Offers1.items_lowest_price) / MIN(Offers1.items_lowest_price) * 100 - 100 AS rise_rate
          FROM (
            (SELECT 
              timestamp(now() - INTERVAL FLOOR(series_numbers.number / :_avg_hours) hour) AS time1,
              timestamp(now() - INTERVAL FLOOR(series_numbers.number / :_avg_hours)
                + series_numbers.number % :_avg_hours hour)                               AS time2
              FROM (
                SELECT @num := 0 AS number UNION ALL 
                SELECT @num := @num + 1 FROM information_schema.COLUMNS LIMIT ' . $bck_hours . '
              ) AS series_numbers
            ) AS date_map
            LEFT JOIN 
              (SELECT 
                items.id                            AS items_id,
                items.title                         AS items_title,
                offers.asin                         AS asin,
                items.detail_page_url               AS items_detail_page_url,
                items.total_new                     AS items_total_new,
                items.total_used                    AS items_total_used,
                items.customer_reviews_url          AS items_customer_reviews_url,
                offers.sales_ranking                AS sales_ranking,
                items.product_group                 AS items_product_group,
                items.sales_ranking                 AS items_sales_ranking,   
                items.lowest_price                  AS items_lowest_price,
                items.lowest_price_currency         AS items_lowest_price_currency,
                offers.lowest_price                 AS lowest_price,
                offers.lowest_price_currency        AS lowest_price_currency,
                items.original_release_date_at      AS items_original_release_date_at,
                items.release_date_at               AS items_release_date_at,
                items.publication_date_at           AS items_publication_date_at,
                items.large_image_url               AS items_large_image_url,
                offers.created                      AS created
              FROM offers 
              INNER JOIN items 
              ON items.id = offers.item_id )        AS Offers1 
            ON Offers1.created BETWEEN date_map.time2 AND date_map.time2 + interval 1 hour )
          GROUP BY time1, Offers1.asin, Offers1.items_id
          HAVING ' . $_rise_rate . ' AND ' . $_profit_range . '
          ORDER BY profit_range,rise_rate LIMIT 100 OFFSET 0;'
        , ['_avg_hours' => $avg_hours, '_rise_rate' => $rise_rate, '_profit_range' => $profit_range])
        ->fetchAll('assoc');

      foreach($_offers as $offer) {
        if(isset($offer['asin'])) {
          array_push($offers, $offer);
        }
      }
    }
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

    $seller = $this->Sellers->find()->where(['email' => $this->Auth->user('email')])->first();

    $query      = $this->Merchants->find();
    $datas      = $query->where(['seller_identifier' => $seller['seller']]);
    $merchants = $this->paginate($datas);
    $all        = $datas->count('*');
    $add        = $datas->where(['add_delete' => 'a'])->count('*');
    $delete     = $datas->where(['add_delete' => 'd'])->count('*');
    $plus       = $datas->where(['add_delete' => 'p'])->count('*');
    $progress   = 0;
    if($all) $progress   = (1 - ($add + $delete + $plus) / $all) * 100;
    $this->set(compact('title', 'merchants', 'progress'));
  }

  /**
   * Asins method
   *
   * @return \Cake\Http\Response|void
   */
  public function asins()
  {
    $title = 'Asin listing';
    $result = $this->Asins->find();
    $asins = $this->paginate($result);
    $this->set(compact('title', 'asins'));
  }

  /**
   * Setting method
   *
   * @return \Cake\Http\Response|void
   */
  public function setting()
  {
    $title = 'User setting';
    $user = $this->Users->find()
      ->where(['email' => $this->Auth->user('email')])
      ->first();

    if ($this->request->is(['patch', 'post', 'put'])) {
      $request = $this->request->getData();
      if($user && $request['password'] === $request['confirm_password']) {
        $entity = $this->Users->patchEntity($user, $request);
        if ($this->Users->save($entity)) {
          $this->Flash->success(__('The password has been changed.'));
          return $this->redirect(['action' => 'setting']);
        }
      }
      $this->Common->log_error($entity->errors());
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
        $new_file = sprintf(ROOT.DIRECTORY_SEPARATOR.'storage'.DIRECTORY_SEPARATOR.'%s'
          , $this->request->data['upload_file']['name'] . '_' . time());
        move_uploaded_file($tmp_file, $new_file);
        $result = $this->AmazonMWS->upsertAsin($new_file, false);
        switch($result['error']) {
        case 0:
          $this->Flash->success(__('The CSV file has been uploaded.'));
          break;
        case 1:
          $this->Flash
            ->error(__('The CSV file did not complete the upload because the cause exceeds 1000 lines.'));
          break;
        default:
          $this->Flash->error(__('The CSV file did not complete the upload. line: ' . $result['line']));
          break;
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
        $new_file = sprintf(ROOT.DIRECTORY_SEPARATOR.'storage'.DIRECTORY_SEPARATOR.'%s'
          , $this->request->data['upload_file']['name'] . '_' . time());
        move_uploaded_file($tmp_file, $new_file);
        $result = $this->AmazonMWS->upsertAsin($new_file, true);
        switch($result['error']) {
        case 0:
          $this->Flash->success(__('The CSV file has been uploaded.'));
          break;
        case 1:
          $this->Flash
            ->error(__('The CSV file did not complete the upload because the cause exceeds 1000 lines.'));
          break;
        default:
          $this->Flash->error(__('The CSV file did not complete the upload. line: ' . $result['line']));
          break;
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
    $title = 'Price calculation for AmazonMWS tools';
    $ships = TableRegistry::get('Ships'); 
    $ship = $ships->find()->first();

    if ($this->request->is(['patch', 'post', 'put'])) {
      $request = $this->request->getData();
      if (isset($this->request->data['calculation'])) {
        if ($ship) {
          $entity = $ships->patchEntity($ship, $request);
        } else {
          $entity = $ships->newEntity($request);
        }
        if ($ships->save($entity)) {
          $this->Flash->success(__('The price calculation has been saved.'));
          return $this->redirect(['action' => 'calculation']);
        }
        $this->Common->log_error($entity->errors());
        $this->Flash->error(__('The price calculation cound not be saved. Please, try again.'));
      }
    }
    $this->set(compact('title', 'ship'));
  }
}
