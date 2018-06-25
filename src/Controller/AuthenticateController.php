<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

class AuthenticateController extends AppController
{
  public function initialize() 
  {
    parent::initialize();
    $this->viewBuilder()->setLayout('authenticate');
    $this->loadModel('Users');
  }

  public function beforeFiler(Event $event)
  {
    parent::beforeFilter($event);
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

  public function signup()
  {
    $title = 'Sign-up';
    $date = date('Y-m-d H:i:s');
    $user = $this->Users->newEntity([
        'created' => $date, 'modified' => $date, 'last_login_at' => $date, 'role' => 2
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
}
