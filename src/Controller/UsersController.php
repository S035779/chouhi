<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Users Controller
 *
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
  public $helpers = ['Paginator' => ['templates' => 'paginator-templates']];

  public function initialize()
  {
    parent::initialize();
    $this->viewBuilder()->setLayout('users');
    $this->loadComponent('Common');
  }

  public function beforeFilter(Event $event)
  {
    parent::beforeFilter($event);
    $this->Auth->allow(['signup', 'signout']);
  }

  public function isAuthorized($user) {
    return true;
  }

  public function signin()
  {
    $title = 'Sign-in';
    if($this->request->is('post')) {
      if (isset($this->request->data['signin'])) {
        $user = $this->Auth->identify();
        if($user) {
          $this->Auth->setUser($user);
          $user_entity = $this->Users->get($user['id']);
          $user_entity->dirty('modified', true);
          $this->Users->touch($user_entity, 'Users.signin');
          $this->Users->save($user_entity);
          return $this->redirect($this->Auth->redirectUrl());
        }
        $this->Flash->error(__('Invalid email address or password, try again'));
      } elseif (isset($this->request->data['signup'])) {
        return $this->redirect(['action' => 'signup']);
      }
    }
    $this->set(compact('title'));
  }

  /**
   * Add method
   *
   * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
   */
  public function signup()
  {
    $title = 'Sign-up';
    $date = date('Y-m-d H:i:s');
    $user = $this->Users->newEntity([
        'created' => $date, 'modified' => $date, 'last_login_at' => $date, 'role' => 1
      ]);
    if ($this->request->is(['post'])) {
      $entity = $this->Users->patchEntity($user, $this->request->getData());
      if ($this->Users->save($entity)) {
        $this->Flash->success(__('The user has been saved.'));
        $user = $this->Auth->identify();
        if($user) {
          $this->Auth->setUser($user);
          $entity = $this->Users->get($user['id']);
          $entity->dirty('modified', true);
          $this->Users->touch($entity, 'Users.signin');
          $this->Users->save($entity);
          return $this->redirect($this->Auth->redirectUrl());
        }
      }
      $this->Flash->error(__('The user could not be saved. Please, try again.'));
    }
    $this->set(compact('user', 'title'));
  }

  public function signout()
  {
    $this->Flash->success(__('The user has been signout.'));
    return $this->redirect($this->Auth->logout());
  }

  /**
   * Index method
   *
   * @return \Cake\Http\Response|void
   */
  public function index()
  {
    $title = 'List users';
    $users = $this->paginate($this->Users);
    $this->set(compact('users', 'title'));
  }

  /**
   * View method
   *
   * @param string|null $id User id.
   * @return \Cake\Http\Response|void
   * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
   */
  public function view($id = null)
  {
    $title = 'View user';
    $user = $this->Users->get($id, [
      'contain' => []
    ]);
    $this->set(compact('user', 'title'));
  }

  /**
   * Add method
   *
   * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
   */
  public function add()
  {
    $title = 'Add user';
    $date = date('Y-m-d H:i:s');
    $user = $this->Users->newEntity(['created' => $date, 'modified' => $date]);
    if ($this->request->is(['post'])) {
      $user = $this->Users->patchEntity($user, $this->request->getData());
      if ($this->Users->save($user)) {
        $this->Flash->success(__('The user has been saved.'));
        return $this->redirect(['action' => 'index']);
      }
      $this->Flash->error(__('The user could not be saved. Please, try again.'));
    }
    $this->set(compact('user', 'title'));
  }

  /**
   * Edit method
   *
   * @param string|null $id User id.
   * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
   * @throws \Cake\Network\Exception\NotFoundException When record not found.
   */
  public function edit($id = null)
  {
    $title = 'Edit user';
    $user = $this->Users->get($id, ['contain' => []]);
    if ($this->request->is(['patch', 'post', 'put'])) {
      $user = $this->Users->patchEntity($user, $this->request->getData());
      if ($this->Users->save($user)) {
        $this->Flash->success(__('The user has been saved.'));
        return $this->redirect(['action' => 'index']);
      }
      $this->Flash->error(__('The user could not be saved. Please, try again.'));
    }
    $this->set(compact('user', 'title'));
  }

  /**
   * Delete method
   *
   * @param string|null $id User id.
   * @return \Cake\Http\Response|null Redirects to index.
   * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
   */
  public function delete($id = null)
  {
    $this->request->allowMethod(['post', 'delete']);
    $user = $this->Users->get($id);
    if ($this->Users->delete($user)) {
      $this->Flash->success(__('The user has been deleted.'));
    } else {
      $this->Flash->error(__('The user could not be deleted. Please, try again.'));
    }
    return $this->redirect(['action' => 'index']);
  }

}
