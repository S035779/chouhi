<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Submission Model
 *
 * @method \App\Model\Entity\Submission get($primaryKey, $options = [])
 * @method \App\Model\Entity\Submission newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Submission[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Submission|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Submission patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Submission[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Submission findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SubmissionTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('submission');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('student_name')
            ->maxLength('student_name', 255)
            ->requirePresence('student_name', 'create')
            ->notEmpty('student_name');

        $validator
            ->scalar('affiliation')
            ->maxLength('affiliation', 255)
            ->requirePresence('affiliation', 'create')
            ->notEmpty('affiliation');

        $validator
            ->scalar('issue_name')
            ->maxLength('issue_name', 255)
            ->requirePresence('issue_name', 'create')
            ->notEmpty('issue_name');

        $validator
            ->scalar('file_name')
            ->maxLength('file_name', 255)
            ->requirePresence('file_name', 'create')
            ->notEmpty('file_name');

        return $validator;
    }
}
