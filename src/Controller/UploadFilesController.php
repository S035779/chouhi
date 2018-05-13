<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Form\UploadFilesForm;
use Cake\Event\Event;

/**
 * UploadFiles Controller
 *
 *
 * @method \App\Model\Entity\UploadFile[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UploadFilesController extends AppController
{
  public function beforeFilter(Event $event)
  {
    parent::beforeFilter($event);
    //$this->AUth->allow(['']);
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
    $fileform = new UploadFilesForm();
    if($this->request->is('post')) {
      if($fileform->validate($this->request->data)) {
        define('SITE_ROOT', realpath(dirname(__FILE__)));
        move_uploaded_file(
          $this->request->data['upload_file']['tmp_name']
        , sprintf(SITE_ROOT . '\..\..\storage\%s', $this->request->data['upload_file']['name'])
        );
        $this->Flash->success(__('The csv file has been uploaded.'));
      }
    }
    $this->set(compact('fileform'));
  }
}
