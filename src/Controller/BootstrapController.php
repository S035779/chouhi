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
  }

  public function beforeFilter(Event $event)
  {
    parent::beforeFilter($event);
  }

  public function isAuthorized($user) {
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
    $this->set(compact('title'));
  }

  /**
   * Search method
   *
   * @return \Cake\Http\Response|void
   */
  public function search()
  {
    $title = 'Search Amazon items';
    $this->set(compact('title'));
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
    $this->set(compact('title'));
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
