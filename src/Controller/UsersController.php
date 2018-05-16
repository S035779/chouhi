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

  public function initialize()
  {
    parent::initialize();
    $this->viewBuilder()->setLayout('users');
  }

  public function beforeFilter(Event $event)
  {
    parent::beforeFilter($event);
    $this->Auth->allow(['add', 'signout']);
  }

  public function isAuthorized($user) {
    return true;
  }

  public function signin()
  {
    $title = 'Sign-in';
    if($this->request->is('post')) {
      $user = $this->Auth->identify();
      if($user) {
        $this->Auth->setUser($user);
        $this->loadModel('Users');
        $user_entity = $this->Users->get($user['id']);
        $user_entity->dirty('modified', true);
        $this->Users->touch($user_entity, 'Users.signin');
        $this->Users->save($user_entity);
        return $this->redirect($this->Auth->redirectUrl());
      }
      $this->Flash->flash(__('Invalid email address or password, try again')
      , [ 'params' => [ 'class' => 'alert alert-error', 'role' => 'alert' ] ]
      );
    }
    $this->set(compact('title'));
  }

  public function signout()
  {
    $this->Flash->flash(__('The user has been signout.')
    , [ 'params' => [ 'class' => 'alert alert-success', 'role' => 'alert' ] ]
    );
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
    $user = $this->Users->newEntity();
    if ($this->request->is('post')) {
      $user = $this->Users->patchEntity($user, $this->request->getData());
      if ($this->Users->save($user)) {
        $this->Flash->flash(__('The user has been saved.')
        , [ 'params' => [ 'class' => 'alert alert-success', 'role' => 'alert' ] ]
        );

        return $this->redirect(['action' => 'index']);
      }
      $this->Flash->flash(__('The user could not be saved. Please, try again.')
      , [ 'params' => [ 'class' => 'alert alert-error', 'role' => 'alert' ] ]
      );
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
    $user = $this->Users->get($id, [
      'contain' => []
    ]);
    if ($this->request->is(['patch', 'post', 'put'])) {
      $user = $this->Users->patchEntity($user, $this->request->getData());
      if ($this->Users->save($user)) {
        $this->Flash->flash(__('The user has been saved.')
        , [ 'params' => [ 'class' => 'alert alert-success', 'role' => 'alert' ] ]
        );

        return $this->redirect(['action' => 'index']);
      }
      $this->Flash->flash(__('The user could not be saved. Please, try again.')
      , [ 'params' => [ 'class' => 'alert alert-error', 'role' => 'alert' ] ]
      );
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
      $this->Flash->flash(__('The user has been deleted.')
      , [ 'params' => [ 'class' => 'alert alert-success', 'role' => 'alert' ] ]
      );
    } else {
      $this->Flash->flash(__('The user could not be deleted. Please, try again.')
      , [ 'params' => [ 'class' => 'alert alert-error', 'role' => 'alert' ] ]
      );
    }

    return $this->redirect(['action' => 'index']);
  }

}
