<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Form\UploadFilesForm;
use Cake\Event\Event;

/**
 * Bootstrap Controller
 *
 *
 * @method \App\Model\Entity\Bootstrap[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BootstrapController extends AppController
{

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
        define('SITE_ROOT', realpath(dirname(__FILE__)));
        move_uploaded_file(
          $this->request->data['upload_file']['tmp_name']
          , sprintf(SITE_ROOT.'\..\..\storage\%s', $this->request->data['upload_file']['name'])
        );
        $this->Flash->flash(__('The csv file has been uploaded.'), [
          'params' => [
            'class' => 'alert alert-success'
          , 'role'  => 'alert'
          ]
        ]);
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
        define('SITE_ROOT', realpath(dirname(__FILE__)));
        move_uploaded_file(
          $this->request->data['upload_file']['tmp_name']
          , sprintf(SITE_ROOT.'\..\..\storage\%s', $this->request->data['upload_file']['name'])
        );
        $this->Flash->flash(__('The csv file has been uploaded.'), [
          'params' => [
            'class' => 'alert alert-success'
          , 'role'  => 'alert'
          ]
        ]);
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
}
