<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Form\SubmissionForm;
use Cake\Datasource\ConnectionManager;
use Cake\Core\Exception\Exception;
use Cake\Event\Event;

//use Cake\Network\Exception\NotImplementedException;

/**
 * Submission Controller
 *
 * @property \App\Model\Table\SubmissionTable $Submission
 *
 * @method \App\Model\Entity\Submission[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SubmissionController extends AppController
{
    public $helpers =[
      'Form' => [
        'templates' => 'Templates/form-templates'
      , 'widgets' => [
          'datepicker' => ['DatePicker']
        ]
      ]
    ];

    public function beforeFilter(Event $event)
    {
      parent::beforeFilter($event);
      //$this->Auth->allow(['']);
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
        $submission = $this->paginate($this->Submission);

        $this->set(compact('submission'));
    }

    /**
     * View method
     *
     * @param string|null $id Submission id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $submission = $this->Submission->get($id, [
            'contain' => []
        ]);

        $this->set('submission', $submission);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
      $submission = $this->Submission->newEntity();
      $fileform = new SubmissionForm();
      if ($this->request->is('post')) {
        $conn = ConnectionManager::get('default');
        $conn->begin();
        try {
          //$this->hoge();
          $request_data = $this->request->getData();
          $request_data['file_name'] = $this->request->data['upload_file']['name']; //
          $submission = $this->Submission->patchEntity($submission, $request_data);
          if ($fileform->validate($this->request->data) && empty($submission->errors())) { //
            if ($this->Submission->save($submission)) {
              define('SITE_ROOT', realpath(dirname(__FILE__)));
              $ret = move_uploaded_file($this->request->data['upload_file']['tmp_name']
                , sprintf(SITE_ROOT . '\..\..\storage/%s'
                  , $this->request->data['upload_file']['name']) );
              if ($ret) {
                $conn->commit();
                $this->Flash->success(__('The submission has been saved.'));
                return $this->redirect(['action' => 'index']);
              } else {
                $this->Flash->error(
                  __('The submission could not be saved. Please, try again.')
                );
              }
            }
          } else {
            if (!empty($fileform->errors()['upload_file'])) {
              $submission->errors('upload_file', $fileform->errors()['upload_file']);
            }
          }
        } catch (Exection $e) {
          //print_r($e);
          $conn->rollback();
        }
      }
      $this->set(compact('submission'));
    }

    public function hoge()
    {
      throw new NotImplementedException(__('Error!!'));
    }
    /**
     * Edit method
     *
     * @param string|null $id Submission id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $submission = $this->Submission->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $submission = $this->Submission->patchEntity($submission, $this->request->getData());
            if ($this->Submission->save($submission)) {
                $this->Flash->success(__('The submission has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The submission could not be saved. Please, try again.'));
        }
        $this->set(compact('submission'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Submission id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $submission = $this->Submission->get($id);
        if ($this->Submission->delete($submission)) {
            $this->Flash->success(__('The submission has been deleted.'));
        } else {
            $this->Flash->error(__('The submission could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
