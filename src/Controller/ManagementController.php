<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Management Controller
 */
class ManagementController extends AppController
{
  public function initialize()
  {
    parent::initialize();
    $this->viewBuilder()->setLayout('management_' . env('APP_TEMPLATE'));
    $this->loadComponent('Common');
  }

  public function beforeFilter(Event $event)
  {
    parent::beforeFilter($event);
  }

  public function isAuthorized($user) {
    if($this->request->getParam('action') === 'index') {
      if($user['role'] === 1) {
        $this->Common->log_debug('enter the admin_area.');
        return true;
      }
    }
    $this->Common->log_debug('unknown area.');
    return parent::isAuthorized($user);
  }

  public function index()
  {
    $title = 'Management of AmazonMWS Tools';
    $this->set(compact('title'));
  }

}
