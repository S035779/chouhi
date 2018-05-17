<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Asins Controller
 *
 * @property \App\Model\Table\AsinsTable $Asins
 *
 * @method \App\Model\Entity\Asin[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AsinsController extends AppController
{
  public function initialize()
  {
    parent::initialize();
    //$this->viewBuilder()->setLayout('dashboard');
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
    $asins = $this->paginate($this->Asins);

    $this->set(compact('asins'));
  }

  /**
   * View method
   *
   * @param string|null $id Asin id.
   * @return \Cake\Http\Response|void
   * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
   */
  public function view($id = null)
  {
    $asin = $this->Asins->get($id, [
      'contain' => []
    ]);

    $this->set('asin', $asin);
  }

  /**
   * Add method
   *
   * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
   */
  public function add()
  {
    $asin = $this->Asins->newEntity();
    if ($this->request->is('post')) {
      $asin = $this->Asins->patchEntity($asin, $this->request->getData());
      if ($this->Asins->save($asin)) {
        $this->Flash->success(__('The asin has been saved.'));

        return $this->redirect(['action' => 'index']);
      }
      $this->Flash->error(__('The asin could not be saved. Please, try again.'));
    }
    $this->set(compact('asin'));
  }

  /**
   * Edit method
   *
   * @param string|null $id Asin id.
   * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
   * @throws \Cake\Network\Exception\NotFoundException When record not found.
   */
  public function edit($id = null)
  {
    $asin = $this->Asins->get($id, [
      'contain' => []
    ]);
    if ($this->request->is(['patch', 'post', 'put'])) {
      $asin = $this->Asins->patchEntity($asin, $this->request->getData());
      if ($this->Asins->save($asin)) {
        $this->Flash->success(__('The asin has been saved.'));

        return $this->redirect(['action' => 'index']);
      }
      $this->Flash->error(__('The asin could not be saved. Please, try again.'));
    }
    $this->set(compact('asin'));
  }

  /**
   * Delete method
   *
   * @param string|null $id Asin id.
   * @return \Cake\Http\Response|null Redirects to index.
   * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
   */
  public function delete($id = null)
  {
    $this->request->allowMethod(['post', 'delete']);
    $asin = $this->Asins->get($id);
    if ($this->Asins->delete($asin)) {
      $this->Flash->success(__('The asin has been deleted.'));
    } else {
      $this->Flash->error(__('The asin could not be deleted. Please, try again.'));
    }

    return $this->redirect(['action' => 'index']);
  }
}
