<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Merchants Controller
 *
 * @property \App\Model\Table\MerchantsTable $Merchants
 *
 * @method \App\Model\Entity\Merchant[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MerchantsController extends AppController
{
  public $helpers = ['Paginator' => ['templates' => 'paginator-templates']];

  public function initialize()
  {
    parent::initialize();
    $this->viewBuilder()->setLayout('dataview');
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
    $merchants = $this->paginate($this->Merchants);

    $this->set(compact('merchants'));
  }

  /**
   * View method
   *
   * @param string|null $id Merchant id.
   * @return \Cake\Http\Response|void
   * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
   */
  public function view($id = null)
  {
    $merchant = $this->Merchants->get($id, [
      'contain' => []
    ]);

    $this->set('merchant', $merchant);
  }

  /**
   * Add method
   *
   * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
   */
  public function add()
  {
    $merchant = $this->Merchants->newEntity();
    if ($this->request->is('post')) {
      $merchant = $this->Merchants->patchEntity($merchant, $this->request->getData());
      if ($this->Merchants->save($merchant)) {
        $this->Flash->success(__('The merchant has been saved.'));

        return $this->redirect(['action' => 'index']);
      }
      $this->Flash->error(__('The merchant could not be saved. Please, try again.'));
    }
    $this->set(compact('merchant'));
  }

  /**
   * Edit method
   *
   * @param string|null $id Merchant id.
   * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
   * @throws \Cake\Network\Exception\NotFoundException When record not found.
   */
  public function edit($id = null)
  {
    $merchant = $this->Merchants->get($id, [
      'contain' => []
    ]);
    if ($this->request->is(['patch', 'post', 'put'])) {
      $merchant = $this->Merchants->patchEntity($merchant, $this->request->getData());
      if ($this->Merchants->save($merchant)) {
        $this->Flash->success(__('The merchant has been saved.'));

        return $this->redirect(['action' => 'index']);
      }
      $this->Flash->error(__('The merchant could not be saved. Please, try again.'));
    }
    $this->set(compact('merchant'));
  }

  /**
   * Delete method
   *
   * @param string|null $id Merchant id.
   * @return \Cake\Http\Response|null Redirects to index.
   * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
   */
  public function delete($id = null)
  {
    $this->request->allowMethod(['post', 'delete']);
    $merchant = $this->Merchants->get($id);
    if ($this->Merchants->delete($merchant)) {
      $this->Flash->success(__('The merchant has been deleted.'));
    } else {
      $this->Flash->error(__('The merchant could not be deleted. Please, try again.'));
    }

    return $this->redirect(['action' => 'index']);
  }
}
