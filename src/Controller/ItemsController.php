<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Items Controller
 *
 * @property \App\Model\Table\ItemsTable $Items
 *
 * @method \App\Model\Entity\Item[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ItemsController extends AppController
{
  public $helpers =['Paginator' => ['templates' => 'paginator-templates']];
  
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
    $items = $this->paginate($this->Items);

    $this->set(compact('items'));
  }

  /**
   * View method
   *
   * @param string|null $id Item id.
   * @return \Cake\Http\Response|void
   * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
   */
  public function view($id = null)
  {
    $item = $this->Items->get($id, [
      'contain' => []
    ]);

    $this->set('item', $item);
  }

  /**
   * Add method
   *
   * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
   */
  public function add()
  {
    $item = $this->Items->newEntity();
    if ($this->request->is('post')) {
      $item = $this->Items->patchEntity($item, $this->request->getData());
      if ($this->Items->save($item)) {
        $this->Flash->success(__('The item has been saved.'));

        return $this->redirect(['action' => 'index']);
      }
      $this->Flash->error(__('The item could not be saved. Please, try again.'));
    }
    $this->set(compact('item'));
  }

  /**
   * Edit method
   *
   * @param string|null $id Item id.
   * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
   * @throws \Cake\Network\Exception\NotFoundException When record not found.
   */
  public function edit($id = null)
  {
    $item = $this->Items->get($id, [
      'contain' => []
    ]);
    if ($this->request->is(['patch', 'post', 'put'])) {
      $item = $this->Items->patchEntity($item, $this->request->getData());
      if ($this->Items->save($item)) {
        $this->Flash->success(__('The item has been saved.'));

        return $this->redirect(['action' => 'index']);
      }
      $this->Flash->error(__('The item could not be saved. Please, try again.'));
    }
    $this->set(compact('item'));
  }

  /**
   * Delete method
   *
   * @param string|null $id Item id.
   * @return \Cake\Http\Response|null Redirects to index.
   * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
   */
  public function delete($id = null)
  {
    $this->request->allowMethod(['post', 'delete']);
    $item = $this->Items->get($id);
    if ($this->Items->delete($item)) {
      $this->Flash->success(__('The item has been deleted.'));
    } else {
      $this->Flash->error(__('The item could not be deleted. Please, try again.'));
    }

    return $this->redirect(['action' => 'index']);
  }
}
