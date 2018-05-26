<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Offers Model
 *
 * @method \App\Model\Entity\Offer get($primaryKey, $options = [])
 * @method \App\Model\Entity\Offer newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Offer[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Offer|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Offer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Offer[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Offer findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class OffersTable extends Table
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

        $this->setTable('offers');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Items', [
          'foreignKey' => 'item_id',
          'joinType' => 'INNER'
        ]);
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
            ->scalar('asin')
            ->maxLength('asin', 255)
            ->requirePresence('asin', 'create')
            ->notEmpty('asin');

        $validator
            ->scalar('availability')
            ->maxLength('availability', 1024)
            ->requirePresence('availability', 'create')
            ->notEmpty('availability');

        $validator
            ->integer('average_feedback_rating')
            ->requirePresence('average_feedback_rating', 'create')
            ->notEmpty('average_feedback_rating');

        $validator
            ->scalar('condition_status')
            ->maxLength('condition_status', 255)
            ->requirePresence('condition_status', 'create')
            ->notEmpty('condition_status');

        $validator
            ->scalar('condition_status_note')
            ->maxLength('condition_status_note', 4095)
            ->requirePresence('condition_status_note', 'create')
            ->notEmpty('condition_status_note');

        $validator
            ->scalar('country')
            ->maxLength('country', 255)
            ->requirePresence('country', 'create')
            ->notEmpty('country');

        $validator
            ->scalar('exchange_identifier')
            ->maxLength('exchange_identifier', 255)
            ->requirePresence('exchange_identifier', 'create')
            ->notEmpty('exchange_identifier');

        $validator
            ->boolean('is_eligible_for_supersaver_shipping')
            ->requirePresence('is_eligible_for_supersaver_shipping', 'create')
            ->notEmpty('is_eligible_for_supersaver_shipping');

        $validator
            ->scalar('offer_listing_identifier')
            ->maxLength('offer_listing_identifier', 255)
            ->requirePresence('offer_listing_identifier', 'create')
            ->notEmpty('offer_listing_identifier');

        $validator
            ->integer('price')
            ->requirePresence('price', 'create')
            ->notEmpty('price');

        $validator
            ->scalar('price_currency')
            ->maxLength('price_currency', 255)
            ->requirePresence('price_currency', 'create')
            ->notEmpty('price_currency');

        $validator
            ->scalar('state')
            ->maxLength('state', 255)
            ->requirePresence('state', 'create')
            ->notEmpty('state');

        $validator
            ->scalar('sub_condition_status')
            ->maxLength('sub_condition_status', 255)
            ->requirePresence('sub_condition_status', 'create')
            ->notEmpty('sub_condition_status');

        $validator
            ->integer('total_feedback')
            ->requirePresence('total_feedback', 'create')
            ->notEmpty('total_feedback');

        $validator
            ->scalar('seller_identifier')
            ->maxLength('seller_identifier', 255)
            ->requirePresence('seller_identifier', 'create')
            ->notEmpty('seller_identifier');

        $validator
            ->integer('sales_ranking')
            ->requirePresence('sales_ranking', 'create')
            ->notEmpty('sales_ranking');

        $validator
            ->integer('lowest_price')
            ->requirePresence('lowest_price', 'create')
            ->notEmpty('lowest_price');

        $validator
            ->scalar('lowest_price_currency')
            ->maxLength('lowest_price_currency', 255)
            ->requirePresence('lowest_price_currency', 'create')
            ->notEmpty('lowest_price_currency');

        return $validator;
    }

    public function buildRules(RulesChecker $rules) 
    {
      $rules->add($rules->existsIn(['item_id'], 'Items'));
    
      return $rules;
    }
}
