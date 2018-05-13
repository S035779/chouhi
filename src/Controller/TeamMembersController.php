<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * TeamMembers Controller
 *
 * @property \App\Model\Table\TeamMembersTable $TeamMembers
 *
 * @method \App\Model\Entity\TeamMember[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TeamMembersController extends AppController
{

  public function beforeFilter(Event $event)
  {
    parent::beforeFilter($event);
    //$this->AUth->allow(['']);
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
        $teamMembers = $this->paginate($this->TeamMembers);

        $this->set(compact('teamMembers'));
    }

    /**
     * View method
     *
     * @param string|null $id Team Member id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $teamMember = $this->TeamMembers->get($id, [
            'contain' => []
        ]);

        $this->set('teamMember', $teamMember);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $teamMember = $this->TeamMembers->newEntity();
        if ($this->request->is('post')) {
            $teamMember = $this->TeamMembers->patchEntity($teamMember, $this->request->getData());
            if ($this->TeamMembers->save($teamMember)) {
                $this->Flash->success(__('The team member has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The team member could not be saved. Please, try again.'));
        }
        $this->set(compact('teamMember'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Team Member id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $teamMember = $this->TeamMembers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $teamMember = $this->TeamMembers->patchEntity($teamMember, $this->request->getData());
            if ($this->TeamMembers->save($teamMember)) {
                $this->Flash->success(__('The team member has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The team member could not be saved. Please, try again.'));
        }
        $this->set(compact('teamMember'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Team Member id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $teamMember = $this->TeamMembers->get($id);
        if ($this->TeamMembers->delete($teamMember)) {
            $this->Flash->success(__('The team member has been deleted.'));
        } else {
            $this->Flash->error(__('The team member could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
