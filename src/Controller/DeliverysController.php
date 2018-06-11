<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Deliverys Controller
 *
 * @property \App\Model\Table\DeliverysTable $Deliverys
 *
 * @method \App\Model\Entity\Delivery[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DeliverysController extends AppController
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
    $deliverys = $this->paginate($this->Deliverys);

    $this->set(compact('deliverys'));
  }

  /**
   * View method
   *
   * @param string|null $id Delivery id.
   * @return \Cake\Http\Response|void
   * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
   */
  public function view($id = null)
  {
    $delivery = $this->Deliverys->get($id, [
      'contain' => []
    ]);

    $this->set('delivery', $delivery);
  }

  /**
   * Add method
   *
   * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
   */
  public function add()
  {
    $delivery = $this->Deliverys->newEntity();
    $methods = array(
      'SAL'       => 'SAL'     
    , 'E_PACKET'  => 'e-packet'
    , 'EMS'       => 'EMS'     
    );
    $areas = array(
      'ASIA'            => 'Asia'          
    , 'OCEANIA'         => 'Oceania'       
    , 'NORTH_AMERICA'   => 'North America' 
    , 'MIDDLE_AMERICA'  => 'Middle America'
    , 'MIDDLE_EAST'     => 'Middle East'   
    , 'EUROPE'          => 'Europe'        
    , 'SOUTH_AMERICA'   => 'South America' 
    , 'AFRICA'          => 'Africa'        
    );
    $duedates = array(
      '4'   => '2-4 days'
    , '6'   => '3-6 days'
    , '14'  => '2 weeks' 
    );
    if ($this->request->is('post')) {
      $delivery = $this->Deliverys->patchEntity($delivery, $this->request->getData());
      if ($this->Deliverys->save($delivery)) {
        $this->Flash->success(__('The delivery has been saved.'));

        return $this->redirect(['action' => 'index']);
      }
      $this->Flash->error(__('The delivery could not be saved. Please, try again.'));
    }
    $this->set(compact('delivery', 'methods', 'areas', 'duedates'));
  }

  /**
   * Edit method
   *
   * @param string|null $id Delivery id.
   * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
   * @throws \Cake\Network\Exception\NotFoundException When record not found.
   */
  public function edit($id = null)
  {
    $delivery = $this->Deliverys->get($id, [
      'contain' => []
    ]);
    $methods = array(
      'SAL'       => 'SAL'     
    , 'E_PACKET'  => 'e-packet'
    , 'EMS'       => 'EMS'     
    );
    $areas = array(
      'ASIA'            => 'Asia'          
    , 'OCEANIA'         => 'Oceania'       
    , 'NORTH_AMERICA'   => 'North America' 
    , 'MIDDLE_AMERICA'  => 'Middle America'
    , 'MIDDLE_EAST'     => 'Middle East'   
    , 'EUROPE'          => 'Europe'        
    , 'SOUTH_AMERICA'   => 'South America' 
    , 'AFRICA'          => 'Africa'        
    );
    $duedates = array(
      '4'   => '2-4 days'
    , '6'   => '3-6 days'
    , '14'  => '2 weeks' 
    );
    if ($this->request->is(['patch', 'post', 'put'])) {
      $delivery = $this->Deliverys->patchEntity($delivery, $this->request->getData());
      if ($this->Deliverys->save($delivery)) {
        $this->Flash->success(__('The delivery has been saved.'));

        return $this->redirect(['action' => 'index']);
      }
      $this->Flash->error(__('The delivery could not be saved. Please, try again.'));
    }
    $this->set(compact('delivery', 'methods', 'areas', 'duedates'));
  }

  /**
   * Delete method
   *
   * @param string|null $id Delivery id.
   * @return \Cake\Http\Response|null Redirects to index.
   * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
   */
  public function delete($id = null)
  {
    $this->request->allowMethod(['post', 'delete']);
    $delivery = $this->Deliverys->get($id);
    if ($this->Deliverys->delete($delivery)) {
      $this->Flash->success(__('The delivery has been deleted.'));
    } else {
      $this->Flash->error(__('The delivery could not be deleted. Please, try again.'));
    }

    return $this->redirect(['action' => 'index']);
  }
}
