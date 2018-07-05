<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Tokens Controller
 *
 * @property \App\Model\Table\TokensTable $Tokens
 *
 * @method \App\Model\Entity\Token[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TokensController extends AppController
{
  public $helpers = ['Paginator' => ['templates' => 'paginator-templates']];

  public function initialize()
  {
    parent::initialize();
    $this->viewBuilder()->setLayout('dataview');
    $this->loadModel('Users');
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
    $this->paginate = [
      'contain' => ['Sellers']
    ];
    $tokens = $this->paginate($this->Tokens);

    $this->set(compact('tokens'));
  }

  /**
   * View method
   *
   * @param string|null $id Token id.
   * @return \Cake\Http\Response|void
   * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
   */
  public function view($id = null)
  {
    $token = $this->Tokens->get($id, [
      'contain' => ['Sellers']
    ]);

    $this->set('token', $token);
  }

  /**
   * Add method
   *
   * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
   */
  public function add()
  {
    $token = $this->Tokens->newEntity();
    if ($this->request->is('post')) {
      $token = $this->Tokens->patchEntity($token, $this->request->getData());
      if ($this->Tokens->save($token)) {
        $this->Flash->success(__('The token has been saved.'));

        return $this->redirect(['action' => 'index']);
      }
      $this->Flash->error(__('The token could not be saved. Please, try again.'));
    }
    $sellers = $this->Tokens->Sellers->find('list', ['limit' => 200]);
    $this->set(compact('token', 'sellers'));
  }

  /**
   * Edit method
   *
   * @param string|null $id Token id.
   * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
   * @throws \Cake\Network\Exception\NotFoundException When record not found.
   */
  public function edit($id = null)
  {
    $token = $this->Tokens->get($id, [
      'contain' => []
    ]);
    if ($this->request->is(['patch', 'post', 'put'])) {
      $token = $this->Tokens->patchEntity($token, $this->request->getData());
      if ($this->Tokens->save($token)) {
        $this->Flash->success(__('The token has been saved.'));

        return $this->redirect(['action' => 'index']);
      }
      $this->Flash->error(__('The token could not be saved. Please, try again.'));
    }
    $sellers = $this->Tokens->Sellers->find('list', ['limit' => 200]);
    $this->set(compact('token', 'sellers'));
  }

  /**
   * Delete method
   *
   * @param string|null $id Token id.
   * @return \Cake\Http\Response|null Redirects to index.
   * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
   */
  public function delete($id = null)
  {
    $this->request->allowMethod(['post', 'delete']);
    $token = $this->Tokens->get($id);
    if ($this->Tokens->delete($token)) {
      $this->Flash->success(__('The token has been deleted.'));
    } else {
      $this->Flash->error(__('The token could not be deleted. Please, try again.'));
    }

    return $this->redirect(['action' => 'index']);
  }
}
