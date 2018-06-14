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
    $this->viewBuilder()->setLayout('dashboard');
    $this->loadComponent('Common');
    $this->loadComponent('AmazonMWS');
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
    $bck_hours = 6;
    $rise_rate = 0;
    $profit_range = 0;
    $offers = array();

    if($this->request->is('post')) {
      $request = $this->request->getData();

      if(!empty($request['period'])) {
        $avg_hours = intval($request['period']) * 24; 
      }

      if(!empty($request['rise_rate'])) {
        $rise_rate = floatval($request['rise_rate']);
      }

      if(!empty($request['profit_range'])) {
        $profit_range = intval($request['profit_range']);
      }

      $_offers = $connection
        ->execute('
          SELECT
            time1                                   as created,
            Offers1.asin                            as asin,
            COUNT(CASE WHEN time1 = time2 THEN Offers1.items_id ELSE NULL END) 
                                                    as time_event_count,
            Offers1.items_id                        as id,
            Offers1.items_title                     as title,
            Offers1.items_detail_page_url           as detail_page_url,
            Offers1.items_total_new                 as total_new,
            Offers1.items_total_used                as total_used,
            Offers1.items_customer_reviews_url      as customer_reviews_url,
            avg(Offers1.sales_ranking)              as average_sales_ranking,
            Offers1.items_product_group             as product_group,
            Offers1.items_sales_ranking             as sales_ranking,
            Offers1.items_lowest_price              as lowest_price,
            Offers1.items_lowest_price_currency     as lowest_price_currency,
            avg(Offers1.lowest_price)               as average_lowest_price,
            Offers1.items_lowest_price_currency     as average_lowest_price_currency,
            Offers1.items_original_release_date_at  as original_release_date_at,
            Offers1.items_release_date_at           as release_date_at,
            Offers1.items_publication_date_at       as publication_date_at,
            Offers1.items_large_image_url           as large_image_url, 
            (
              (select lowest_price from offers 
                where created = max(Offers1.created) and asin = Offers1.asin ) /
              (select lowest_price from offers 
                where created = min(Offers1.created) and asin = Offers1.asin ) * 100 - 100
            ) as rise_rate,
            (
              (select lowest_price from offers 
                where created = max(Offers1.created) and asin = Offers1.asin ) -
              (select lowest_price from offers 
                where created = min(Offers1.created) and asin = Offers1.asin )
            ) as profit_range
          FROM 
            (
              (
                SELECT
                  timestamp(now() - INTERVAL FLOOR(series_numbers.number / :n) 
                    hour) AS time1,
                  timestamp(now() - INTERVAL FLOOR(series_numbers.number / :n)
                    + series_numbers.number % :n hour) AS time2
                FROM 
                  (
                    SELECT @num := 0 AS number
                    UNION ALL
                    SELECT @num := @num + 1 FROM information_schema.COLUMNS
                    LIMIT ' . $bck_hours . '
                  ) AS series_numbers
              ) AS date_map
              LEFT JOIN 
                (
                  SELECT 
                    items.id                       as items_id,
                    items.title                    as items_title,
                    offers.asin                    as asin,
                    items.detail_page_url          as items_detail_page_url,
                    items.total_new                as items_total_new,
                    items.total_used               as items_total_used,
                    items.customer_reviews_url     as items_customer_reviews_url,
                    offers.sales_ranking           as sales_ranking,
                    items.product_group            as items_product_group,
                    items.sales_ranking            as items_sales_ranking,   
                    items.lowest_price             as items_lowest_price,
                    items.lowest_price_currency    as items_lowest_price_currency,
                    offers.lowest_price            as lowest_price,
                    offers.lowest_price_currency   as lowest_price_currency,
                    items.original_release_date_at as items_original_release_date_at,
                    items.release_date_at          as items_release_date_at,
                    items.publication_date_at      as items_publication_date_at,
                    items.large_image_url          as items_large_image_url,
                    offers.created                 as created
                  FROM offers
                  inner join items 
                  on items.id = offers.item_id
                ) AS Offers1
              ON 
                Offers1.created between date_map.time2 and date_map.time2 + interval 1 hour
            )
          GROUP BY time1, Offers1.asin, Offers1.items_id
          order by time1 desc;', ['n' => $avg_hours])
        ->fetchAll('assoc');

      foreach($_offers as $offer) {
        //debug($offer);
        if($offer['asin']) {
          if($offer['rise_rate'] >= $rise_rate && $offer['profit_range'] >= $profit_range) { 
            //debug($offer);
            array_push($offers, $offer);
          }
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
        $new_file = sprintf(ROOT.'\storage\%s'
          , $this->request->data['upload_file']['name'] . '_' . time());
        move_uploaded_file($tmp_file, $new_file);
        if($this->AmazonMWS->upsertAsin($new_file, FALSE)) {
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
        if($this->AmazonMWS->upsertAsin($new_file, TRUE)) {
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
          return $this->redirect(['action' => 'index']);
        }
        $this->Common->log_error($entity->errors());
        $this->Flash->error(__('The price calculation cound not be saved. Please, try again.'));
      }
    }
    $this->set(compact('title', 'ship'));
  }
}
