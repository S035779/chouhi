<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Items Model
 *
 * @method \App\Model\Entity\Item get($primaryKey, $options = [])
 * @method \App\Model\Entity\Item newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Item[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Item|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Item patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Item[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Item findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ItemsTable extends Table
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

        $this->setTable('items');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Offers', [
          'foreignKey' => 'item_id'
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
            ->scalar('title')
            ->maxLength('title', 4095)
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->boolean('is_eligible_prime')
            ->allowEmpty('is_eligible_prime');

        $validator
            ->boolean('is_eligible_for_supersaver_shipping')
            ->allowEmpty('is_eligible_for_supersaver_shipping');

        $validator
            ->requirePresence('item_height', 'create')
            ->notEmpty('item_height');

        $validator
            ->requirePresence('item_length', 'create')
            ->notEmpty('item_length');

        $validator
            ->requirePresence('item_weight', 'create')
            ->notEmpty('item_weight');

        $validator
            ->requirePresence('item_width', 'create')
            ->notEmpty('item_width');

        $validator
            ->requirePresence('package_height', 'create')
            ->notEmpty('package_height');

        $validator
            ->requirePresence('package_length', 'create')
            ->notEmpty('package_length');

        $validator
            ->requirePresence('package_weight', 'create')
            ->notEmpty('package_weight');

        $validator
            ->requirePresence('package_width', 'create')
            ->notEmpty('package_width');

        $validator
            ->allowEmpty('list_price');

        $validator
            ->scalar('list_price_currency')
            ->maxLength('list_price_currency', 255)
            ->allowEmpty('list_price_currency');

        $validator
            ->allowEmpty('lowest_price');

        $validator
            ->scalar('lowest_price_currency')
            ->maxLength('lowest_price_currency', 255)
            ->allowEmpty('lowest_price_currency');

        $validator
            ->allowEmpty('lowest_used_price');

        $validator
            ->scalar('lowest_used_price_currency')
            ->maxLength('lowest_used_price_currency', 255)
            ->allowEmpty('lowest_used_price_currency');

        $validator
            ->allowEmpty('lowest_collectible_price');

        $validator
            ->scalar('lowest_collectible_price_currency')
            ->maxLength('lowest_collectible_price_currency', 255)
            ->allowEmpty('lowest_collectible_price_currency');

        $validator
            ->allowEmpty('offer_listing_price');

        $validator
            ->scalar('offer_listing_price_currency')
            ->maxLength('offer_listing_price_currency', 255)
            ->allowEmpty('offer_listing_price_currency');

        $validator
            ->allowEmpty('offer_listing_saved_price');

        $validator
            ->scalar('offer_listing_saved_price_currency')
            ->maxLength('offer_listing_saved_price_currency', 255)
            ->allowEmpty('offer_listing_saved_price_currency');

        $validator
            ->integer('sales_ranking')
            ->allowEmpty('sales_ranking');

        $validator
            ->scalar('ean')
            ->maxLength('ean', 255)
            ->allowEmpty('ean');

        $validator
            ->dateTime('release_date_at')
            ->allowEmpty('release_date_at');

        $validator
            ->dateTime('publication_date_at')
            ->allowEmpty('publication_date_at');

        $validator
            ->dateTime('original_release_date_at')
            ->allowEmpty('original_release_date_at');

        $validator
            ->scalar('condition_status')
            ->maxLength('condition_status', 255)
            ->allowEmpty('condition_status');

        $validator
            ->integer('total_reviews')
            ->allowEmpty('total_reviews');

        $validator
            ->integer('average_rating')
            ->allowEmpty('average_rating');

        $validator
            ->integer('total_votes')
            ->allowEmpty('total_votes');

        $validator
            ->scalar('product_group')
            ->maxLength('product_group', 255)
            ->requirePresence('product_group', 'create')
            ->notEmpty('product_group');

        $validator
            ->integer('quantity')
            ->allowEmpty('quantity');

        $validator
            ->integer('quantity_allocated')
            ->allowEmpty('quantity_allocated');

        $validator
            ->boolean('status')
            ->allowEmpty('status');

        $validator
            ->scalar('marketplace')
            ->maxLength('marketplace', 255)
            ->requirePresence('marketplace', 'create')
            ->notEmpty('marketplace');

        $validator
            ->scalar('detail_page_url')
            ->maxLength('detail_page_url', 4095)
            ->requirePresence('detail_page_url', 'create')
            ->notEmpty('detail_page_url');

        $validator
            ->scalar('small_image_url')
            ->maxLength('small_image_url', 255)
            ->requirePresence('small_image_url', 'create')
            ->notEmpty('small_image_url');

        $validator
            ->scalar('medium_image_url')
            ->maxLength('medium_image_url', 255)
            ->requirePresence('medium_image_url', 'create')
            ->notEmpty('medium_image_url');

        $validator
            ->scalar('large_image_url')
            ->maxLength('large_image_url', 255)
            ->requirePresence('large_image_url', 'create')
            ->notEmpty('large_image_url');

        $validator
            ->integer('total_new')
            ->allowEmpty('total_new');

        $validator
            ->integer('total_used')
            ->allowEmpty('total_used');

        $validator
            ->integer('total_collectible')
            ->allowEmpty('total_collectible');

        $validator
            ->integer('total_refurbished')
            ->allowEmpty('total_refurbished');

        $validator
            ->scalar('customer_reviews_url')
            ->maxLength('customer_reviews_url', 4095)
            ->allowEmpty('customer_reviews_url');

        return $validator;
    }
}
