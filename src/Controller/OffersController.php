<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Offers Controller
 *
 * @property \App\Model\Table\OffersTable $Offers
 *
 * @method \App\Model\Entity\Offer[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OffersController extends AppController
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
    $offers = $this->paginate($this->Offers);

    $this->set(compact('offers'));
  }

  /**
   * View method
   *
   * @param string|null $id Offer id.
   * @return \Cake\Http\Response|void
   * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
   */
  public function view($id = null)
  {
    $offer = $this->Offers->get($id, [
      'contain' => []
    ]);

    $this->set('offer', $offer);
  }

  /**
   * Add method
   *
   * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
   */
  public function add()
  {
    $offer = $this->Offers->newEntity();
    if ($this->request->is('post')) {
      $offer = $this->Offers->patchEntity($offer, $this->request->getData());
      if ($this->Offers->save($offer)) {
        $this->Flash->success(__('The offer has been saved.'));

        return $this->redirect(['action' => 'index']);
      }
      $this->Flash->error(__('The offer could not be saved. Please, try again.'));
    }
    $this->set(compact('offer'));
  }

  /**
   * Edit method
   *
   * @param string|null $id Offer id.
   * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
   * @throws \Cake\Network\Exception\NotFoundException When record not found.
   */
  public function edit($id = null)
  {
    $offer = $this->Offers->get($id, [
      'contain' => []
    ]);
    if ($this->request->is(['patch', 'post', 'put'])) {
      $offer = $this->Offers->patchEntity($offer, $this->request->getData());
      if ($this->Offers->save($offer)) {
        $this->Flash->success(__('The offer has been saved.'));

        return $this->redirect(['action' => 'index']);
      }
      $this->Flash->error(__('The offer could not be saved. Please, try again.'));
    }
    $this->set(compact('offer'));
  }

  /**
   * Delete method
   *
   * @param string|null $id Offer id.
   * @return \Cake\Http\Response|null Redirects to index.
   * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
   */
  public function delete($id = null)
  {
    $this->request->allowMethod(['post', 'delete']);
    $offer = $this->Offers->get($id);
    if ($this->Offers->delete($offer)) {
      $this->Flash->success(__('The offer has been deleted.'));
    } else {
      $this->Flash->error(__('The offer could not be deleted. Please, try again.'));
    }

    return $this->redirect(['action' => 'index']);
  }
}
