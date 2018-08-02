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
          WITH 
            Offers AS (
              SELECT 
                offers.asin                           AS asin,
                offers.customer_reviews_url           AS customer_reviews_url,
                offers.sales_ranking                  AS sales_ranking,
                offers.lowest_price                   AS lowest_price,
                offers.lowest_price_currency          AS lowest_price_currency,
                offers.created                        AS created,
                items.id                              AS items_id,
                items.title                           AS items_title,
                items.detail_page_url                 AS items_detail_page_url,
                items.large_image_url                 AS items_large_image_url,
                items.total_new                       AS items_total_new,
                items.total_used                      AS items_total_used,
                items.product_group                   AS items_product_group,
                items.original_release_date_at        AS items_original_release_date_at,
                items.release_date_at                 AS items_release_date_at,
                items.publication_date_at             AS items_publication_date_at
              FROM offers INNER JOIN items ON items.id = offers.item_id 
            ) 
          , Latest AS (
              SELECT 
                asin                                  AS asin
              , customer_reviews_url                  AS customer_reviews_url
              , sales_ranking                         AS sales_ranking
              , lowest_price                          AS lowest_price
              , lowest_price_currency                 AS lowest_price_currency
              FROM offers AS OffersA 
                INNER JOIN (
                  SELECT asin AS latest_asin, MAX(created) AS latest_created FROM offers GROUP BY asin
                ) AS OffersB 
                ON OffersA.asin = OffersB.latest_asin AND OffersA.created = OffersB.latest_created
            )
          , Maps AS (
              SELECT 
                timestamp(now() - INTERVAL FLOOR(series_numbers.number / :_avg_hours) hour) AS time1,
                timestamp(now() - INTERVAL FLOOR(series_numbers.number / :_avg_hours)
                  + series_numbers.number % :_avg_hours hour)                               AS time2
              FROM (
                SELECT @num := 0 AS number UNION ALL 
                SELECT @num := @num + 1 FROM information_schema.COLUMNS LIMIT ' . $bck_hours * $avg_hours . '
              ) AS series_numbers
            )
          SELECT
            Offers.asin                               AS asin,
            Offers.items_id                           AS id,
            Offers.items_title                        AS title,
            Offers.items_detail_page_url              AS detail_page_url,
            Offers.items_large_image_url              AS large_image_url,
            Offers.items_total_new                    AS total_new,
            Offers.items_total_used                   AS total_used,
            Offers.items_product_group                AS product_group,
            Offers.items_original_release_date_at     AS original_release_date_at,
            Offers.items_release_date_at              AS release_date_at,
            Offers.items_publication_date_at          AS publication_date_at,
            AVG(Offers.sales_ranking)                 AS average_sales_ranking,
            AVG(Offers.lowest_price)                  AS average_lowest_price,
            MAX(Offers.created)                       AS created,
            Latest.sales_ranking                      AS sales_ranking,
            Latest.lowest_price                       AS lowest_price,
            Latest.lowest_price_currency              AS lowest_price_currency,
            Latest.customer_reviews_url               AS customer_reviews_url,
            Latest.lowest_price - AVG(Offers.lowest_price)
                                                      AS profit_range,
            (((Latest.lowest_price - AVG(Offers.lowest_price)) / AVG(Offers.lowest_price)) * 100)    
                                                      AS rise_rate
          FROM Maps 
            LEFT JOIN Offers ON Offers.created BETWEEN Maps.time2 AND Maps.time2 + interval 1 hour
            LEFT JOIN Latest ON Offers.asin = Latest.asin
          GROUP BY Offers.asin, Offers.items_id
          HAVING    ' . $_rise_rate . ' AND ' . $_profit_range . '
          ORDER BY  profit_range DESC, rise_rate DESC LIMIT 100 OFFSET 0;'
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
