<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Ships Controller
 *
 * @property \App\Model\Table\ShipsTable $Ships
 *
 * @method \App\Model\Entity\Ship[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ShipsController extends AppController
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

  public function isAuthorized($user)
  {
    return true;
  }

  /**
   * Index method
   *
   * @return \Cake\Http\Response|void
   */
  public function index()
  {
    $ships = $this->paginate($this->Ships);

    $this->set(compact('ships'));
  }

  /**
   * View method
   *
   * @param string|null $id Ship id.
   * @return \Cake\Http\Response|void
   * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
   */
  public function view($id = null)
  {
    $ship = $this->Ships->get($id, [
      'contain' => []
    ]);

    $this->set('ship', $ship);
  }

  /**
   * Add method
   *
   * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
   */
  public function add()
  {
    $ship = $this->Ships->newEntity();
    if ($this->request->is('post')) {
      $ship = $this->Ships->patchEntity($ship, $this->request->getData());
      if ($this->Ships->save($ship)) {
        $this->Flash->success(__('The ship has been saved.'));

        return $this->redirect(['action' => 'index']);
      }
      $this->Flash->error(__('The ship could not be saved. Please, try again.'));
    }
    $this->set(compact('ship'));
  }

  /**
   * Edit method
   *
   * @param string|null $id Ship id.
   * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
   * @throws \Cake\Network\Exception\NotFoundException When record not found.
   */
  public function edit($id = null)
  {
    $ship = $this->Ships->get($id, [
      'contain' => []
    ]);
    if ($this->request->is(['patch', 'post', 'put'])) {
      $ship = $this->Ships->patchEntity($ship, $this->request->getData());
      if ($this->Ships->save($ship)) {
        $this->Flash->success(__('The ship has been saved.'));

        return $this->redirect(['action' => 'index']);
      }
      $this->Flash->error(__('The ship could not be saved. Please, try again.'));
    }
    $this->set(compact('ship'));
  }

  /**
   * Delete method
   *
   * @param string|null $id Ship id.
   * @return \Cake\Http\Response|null Redirects to index.
   * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
   */
  public function delete($id = null)
  {
    $this->request->allowMethod(['post', 'delete']);
    $ship = $this->Ships->get($id);
    if ($this->Ships->delete($ship)) {
      $this->Flash->success(__('The ship has been deleted.'));
    } else {
      $this->Flash->error(__('The ship could not be deleted. Please, try again.'));
    }

    return $this->redirect(['action' => 'index']);
  }
}
