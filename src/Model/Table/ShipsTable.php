<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Ships Model
 *
 * @method \App\Model\Entity\Ship get($primaryKey, $options = [])
 * @method \App\Model\Entity\Ship newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Ship[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Ship|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ship patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Ship[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Ship findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ShipsTable extends Table
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

        $this->setTable('ships');
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
            ->boolean('is_fulfillment_selling')
            ->requirePresence('is_fulfillment_selling', 'create')
            ->notEmpty('is_fulfillment_selling');

        $validator
            ->integer('pending_quantity_rate')
            ->requirePresence('pending_quantity_rate', 'create')
            ->notEmpty('pending_quantity_rate');

        $validator
            ->integer('pending_quantity')
            ->requirePresence('pending_quantity', 'create')
            ->notEmpty('pending_quantity');

        $validator
            ->numeric('price_criteria_1')
            ->requirePresence('price_criteria_1', 'create')
            ->notEmpty('price_criteria_1');

        $validator
            ->numeric('price_criteria_2')
            ->requirePresence('price_criteria_2', 'create')
            ->notEmpty('price_criteria_2');

        $validator
            ->numeric('price_criteria_3')
            ->requirePresence('price_criteria_3', 'create')
            ->notEmpty('price_criteria_3');

        $validator
            ->numeric('price_criteria_4')
            ->requirePresence('price_criteria_4', 'create')
            ->notEmpty('price_criteria_4');

        $validator
            ->integer('sales_rate_1')
            ->requirePresence('sales_rate_1', 'create')
            ->notEmpty('sales_rate_1');

        $validator
            ->integer('sales_rate_2')
            ->requirePresence('sales_rate_2', 'create')
            ->notEmpty('sales_rate_2');

        $validator
            ->integer('sales_rate_3')
            ->requirePresence('sales_rate_3', 'create')
            ->notEmpty('sales_rate_3');

        $validator
            ->integer('sales_rate_4')
            ->requirePresence('sales_rate_4', 'create')
            ->notEmpty('sales_rate_4');

        $validator
            ->integer('sales_rate_5')
            ->requirePresence('sales_rate_5', 'create')
            ->notEmpty('sales_rate_5');

        $validator
            ->numeric('sales_price_1')
            ->requirePresence('sales_price_1', 'create')
            ->notEmpty('sales_price_1');

        $validator
            ->numeric('sales_price_2')
            ->requirePresence('sales_price_2', 'create')
            ->notEmpty('sales_price_2');

        $validator
            ->numeric('sales_price_3')
            ->requirePresence('sales_price_3', 'create')
            ->notEmpty('sales_price_3');

        $validator
            ->numeric('sales_price_4')
            ->requirePresence('sales_price_4', 'create')
            ->notEmpty('sales_price_4');

        $validator
            ->numeric('sales_price_5')
            ->requirePresence('sales_price_5', 'create')
            ->notEmpty('sales_price_5');

        $validator
            ->integer('delete_rate_1')
            ->requirePresence('delete_rate_1', 'create')
            ->notEmpty('delete_rate_1');

        $validator
            ->integer('delete_rate_2')
            ->requirePresence('delete_rate_2', 'create')
            ->notEmpty('delete_rate_2');

        $validator
            ->integer('delete_rate_3')
            ->requirePresence('delete_rate_3', 'create')
            ->notEmpty('delete_rate_3');

        $validator
            ->integer('delete_rate_4')
            ->requirePresence('delete_rate_4', 'create')
            ->notEmpty('delete_rate_4');

        $validator
            ->integer('delete_rate_5')
            ->requirePresence('delete_rate_5', 'create')
            ->notEmpty('delete_rate_5');

        $validator
            ->numeric('delete_price_1')
            ->requirePresence('delete_price_1', 'create')
            ->notEmpty('delete_price_1');

        $validator
            ->numeric('delete_price_2')
            ->requirePresence('delete_price_2', 'create')
            ->notEmpty('delete_price_2');

        $validator
            ->numeric('delete_price_3')
            ->requirePresence('delete_price_3', 'create')
            ->notEmpty('delete_price_3');

        $validator
            ->numeric('delete_price_4')
            ->requirePresence('delete_price_4', 'create')
            ->notEmpty('delete_price_4');

        $validator
            ->numeric('delete_price_5')
            ->requirePresence('delete_price_5', 'create')
            ->notEmpty('delete_price_5');

        return $validator;
    }
}
