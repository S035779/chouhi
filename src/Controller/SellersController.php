<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Sellers Controller
 *
 * @property \App\Model\Table\SellersTable $Sellers
 *
 * @method \App\Model\Entity\Seller[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SellersController extends AppController
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
    return parent::isAuthorized($user);
  }

  /**
   * Index method
   *
   * @return \Cake\Http\Response|void
   */
  public function index()
  {
    $sellers = $this->paginate($this->Sellers);

    $this->set(compact('sellers'));
  }

  /**
   * View method
   *
   * @param string|null $id Seller id.
   * @return \Cake\Http\Response|void
   * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
   */
  public function view($id = null)
  {
    $seller = $this->Sellers->get($id, [
      'contain' => ['Tokens']
    ]);

    $this->set('seller', $seller);
  }

  /**
   * Add method
   *
   * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
   */
  public function add()
  {
    $seller = $this->Sellers->newEntity();
    if ($this->request->is('post')) {
      $seller = $this->Sellers->patchEntity($seller, $this->request->getData());
      if ($this->Sellers->save($seller)) {
        $this->Flash->success(__('The seller has been saved.'));

        return $this->redirect(['action' => 'index']);
      }
      $this->Flash->error(__('The seller could not be saved. Please, try again.'));
    }
    $this->set(compact('seller'));
  }

  /**
   * Edit method
   *
   * @param string|null $id Seller id.
   * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
   * @throws \Cake\Network\Exception\NotFoundException When record not found.
   */
  public function edit($id = null)
  {
    $seller = $this->Sellers->get($id, [
      'contain' => []
    ]);
    if ($this->request->is(['patch', 'post', 'put'])) {
      $seller = $this->Sellers->patchEntity($seller, $this->request->getData());
      if ($this->Sellers->save($seller)) {
        $this->Flash->success(__('The seller has been saved.'));

        return $this->redirect(['action' => 'index']);
      }
      $this->Flash->error(__('The seller could not be saved. Please, try again.'));
    }
    $this->set(compact('seller'));
  }

  /**
   * Delete method
   *
   * @param string|null $id Seller id.
   * @return \Cake\Http\Response|null Redirects to index.
   * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
   */
  public function delete($id = null)
  {
    $this->request->allowMethod(['post', 'delete']);
    $seller = $this->Sellers->get($id);
    if ($this->Sellers->delete($seller)) {
      $this->Flash->success(__('The seller has been deleted.'));
    } else {
      $this->Flash->error(__('The seller could not be deleted. Please, try again.'));
    }

    return $this->redirect(['action' => 'index']);
  }
}
