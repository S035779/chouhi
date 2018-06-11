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
            ->numeric('jpy_price')
            ->requirePresence('jpy_price', 'create')
            ->notEmpty('jpy_price');

        $validator
            ->numeric('aud_price')
            ->requirePresence('aud_price', 'create')
            ->notEmpty('aud_price');

        $validator
            ->numeric('usd_price')
            ->requirePresence('usd_price', 'create')
            ->notEmpty('usd_price');

        $validator
            ->numeric('jp_length')
            ->requirePresence('jp_length', 'create')
            ->notEmpty('jp_length');

        $validator
            ->numeric('au_length')
            ->requirePresence('au_length', 'create')
            ->notEmpty('au_length');

        $validator
            ->numeric('us_length')
            ->requirePresence('us_length', 'create')
            ->notEmpty('us_length');

        $validator
            ->numeric('jp_weight')
            ->requirePresence('jp_weight', 'create')
            ->notEmpty('jp_weight');

        $validator
            ->numeric('au_weight')
            ->requirePresence('au_weight', 'create')
            ->notEmpty('au_weight');

        $validator
            ->numeric('us_weight')
            ->requirePresence('us_weight', 'create')
            ->notEmpty('us_weight');

        return $validator;
    }
}
