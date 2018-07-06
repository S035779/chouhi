<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Form\UploadFilesForm;
use Cake\Event\Event;

/**
 * Deliverys Controller
 *
 * @property \App\Model\Table\DeliverysTable $Deliverys
 *
 * @method \App\Model\Entity\Delivery[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DeliverysController extends AppController
{
  public $helpers = ['Paginator' => ['templates' => 'paginator-templates']];

  public function initialize()
  {
    parent::initialize();
    $this->viewBuilder()->setLayout('dataview');
    $this->loadComponent('Common');
    $this->loadComponent('AmazonMWS');
  }

  public function beforeFilter(Event $event)
  {
    parent::beforeFilter($event);
  }

  public function isAuthorized($user)
  {
    return parent::isAuthorized($user);
  }

  /**
   * Index method
   *
   * @return \Cake\Http\Response|void
   */
  public function index()
  {
    $deliverys = $this->paginate($this->Deliverys);

    $this->set(compact('deliverys'));
  }

  /**
   * View method
   *
   * @param string|null $id Delivery id.
   * @return \Cake\Http\Response|void
   * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
   */
  public function view($id = null)
  {
    $delivery = $this->Deliverys->get($id, [
      'contain' => []
    ]);

    $this->set('delivery', $delivery);
  }

  /**
   * Add method
   *
   * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
   */
  public function add()
  {
    $delivery = $this->Deliverys->newEntity();
    if ($this->request->is('post')) {
      $delivery = $this->Deliverys->patchEntity($delivery, $this->request->getData());
      if ($this->Deliverys->save($delivery)) {
        $this->Flash->success(__('The delivery has been saved.'));

        return $this->redirect(['action' => 'index']);
      }
      $this->Flash->error(__('The delivery could not be saved. Please, try again.'));
    }
    $this->set(compact('delivery'));
  }

  /**
   * Edit method
   *
   * @param string|null $id Delivery id.
   * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
   * @throws \Cake\Network\Exception\NotFoundException When record not found.
   */
  public function edit($id = null)
  {
    $delivery = $this->Deliverys->get($id, [
      'contain' => []
    ]);
    if ($this->request->is(['patch', 'post', 'put'])) {
      $delivery = $this->Deliverys->patchEntity($delivery, $this->request->getData());
      if ($this->Deliverys->save($delivery)) {
        $this->Flash->success(__('The delivery has been saved.'));

        return $this->redirect(['action' => 'index']);
      }
      $this->Flash->error(__('The delivery could not be saved. Please, try again.'));
    }
    $this->set(compact('delivery'));
  }

  /**
   * Delete method
   *
   * @param string|null $id Delivery id.
   * @return \Cake\Http\Response|null Redirects to index.
   * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
   */
  public function delete($id = null)
  {
    $this->request->allowMethod(['post', 'delete']);
    $delivery = $this->Deliverys->get($id);
    if ($this->Deliverys->delete($delivery)) {
      $this->Flash->success(__('The delivery has been deleted.'));
    } else {
      $this->Flash->error(__('The delivery could not be deleted. Please, try again.'));
    }

    return $this->redirect(['action' => 'index']);
  }

  public function download()
  {
    $this->request->allowMethod(['post']);
    $this->autoRender = false;
    $response = $this->response;
    $filename = sprintf(ROOT.DIRECTORY_SEPARATOR.'storage'.DIRECTORY_SEPARATOR.'%s', 'deliverys'.'_'.time());
    $this->AmazonMWS->fetchDeliverys($filename);
    $response = $response->withFile($filename, ['download' => true, 'name' => 'download.csv']);
    return $response;
  }

  public function upload()
  {
    $title = 'Deliverys file upload';
    $fileform = new UploadFilesForm();
    if($this->request->is('post')) {
      if($fileform->validate($this->request->data)) {
        $tmp_file = $this->request->data['upload_file']['tmp_name'];
        $new_file = sprintf(ROOT.DIRECTORY_SEPARATOR.'storage'.DIRECTORY_SEPARATOR.'%s'
          , $this->request->data['upload_file']['name'].'_'.time());
        move_uploaded_file($tmp_file, $new_file);
        $result = $this->AmazonMWS->upsertDeliverys($new_file);
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
}
