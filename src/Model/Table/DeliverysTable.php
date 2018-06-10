<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Deliverys Model
 *
 * @method \App\Model\Entity\Delivery get($primaryKey, $options = [])
 * @method \App\Model\Entity\Delivery newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Delivery[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Delivery|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Delivery patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Delivery[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Delivery findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class DeliverysTable extends Table
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

        $this->setTable('deliverys');
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
            ->scalar('method')
            ->maxLength('method', 255)
            ->requirePresence('method', 'create')
            ->notEmpty('method');

        $validator
            ->scalar('area')
            ->maxLength('area', 255)
            ->requirePresence('area', 'create')
            ->notEmpty('area');

        $validator
            ->numeric('price')
            ->requirePresence('price', 'create')
            ->notEmpty('price');

        $validator
            ->integer('length')
            ->requirePresence('length', 'create')
            ->notEmpty('length');

        $validator
            ->integer('total_length')
            ->requirePresence('total_length', 'create')
            ->notEmpty('total_length');

        $validator
            ->numeric('weight')
            ->requirePresence('weight', 'create')
            ->notEmpty('weight');

        $validator
            ->integer('duedate')
            ->requirePresence('duedate', 'create')
            ->notEmpty('duedate');

        return $validator;
    }
}
