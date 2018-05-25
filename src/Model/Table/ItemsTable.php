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
            ->requirePresence('is_eligible_prime', 'create')
            ->notEmpty('is_eligible_prime');

        $validator
            ->boolean('is_eligible_for_supersaver_shipping')
            ->requirePresence('is_eligible_for_supersaver_shipping', 'create')
            ->notEmpty('is_eligible_for_supersaver_shipping');

        $validator
            ->integer('item_height')
            ->requirePresence('item_height', 'create')
            ->notEmpty('item_height');

        $validator
            ->integer('item_length')
            ->requirePresence('item_length', 'create')
            ->notEmpty('item_length');

        $validator
            ->integer('item_weight')
            ->requirePresence('item_weight', 'create')
            ->notEmpty('item_weight');

        $validator
            ->integer('item_width')
            ->requirePresence('item_width', 'create')
            ->notEmpty('item_width');

        $validator
            ->integer('package_height')
            ->requirePresence('package_height', 'create')
            ->notEmpty('package_height');

        $validator
            ->integer('package_length')
            ->requirePresence('package_length', 'create')
            ->notEmpty('package_length');

        $validator
            ->integer('package_weight')
            ->requirePresence('package_weight', 'create')
            ->notEmpty('package_weight');

        $validator
            ->integer('package_width')
            ->requirePresence('package_width', 'create')
            ->notEmpty('package_width');

        $validator
            ->integer('list_price')
            ->requirePresence('list_price', 'create')
            ->notEmpty('list_price');

        $validator
            ->scalar('list_price_currency')
            ->maxLength('list_price_currency', 255)
            ->requirePresence('list_price_currency', 'create')
            ->notEmpty('list_price_currency');

        $validator
            ->integer('lowest_price')
            ->requirePresence('lowest_price', 'create')
            ->notEmpty('lowest_price');

        $validator
            ->scalar('lowest_price_currency')
            ->maxLength('lowest_price_currency', 255)
            ->requirePresence('lowest_price_currency', 'create')
            ->notEmpty('lowest_price_currency');

        $validator
            ->integer('lowest_used_price')
            ->requirePresence('lowest_used_price', 'create')
            ->notEmpty('lowest_used_price');

        $validator
            ->scalar('lowest_used_price_currency')
            ->maxLength('lowest_used_price_currency', 255)
            ->requirePresence('lowest_used_price_currency', 'create')
            ->notEmpty('lowest_used_price_currency');

        $validator
            ->integer('lowest_collectible_price')
            ->requirePresence('lowest_collectible_price', 'create')
            ->notEmpty('lowest_collectible_price');

        $validator
            ->scalar('lowest_collectible_price_currency')
            ->maxLength('lowest_collectible_price_currency', 255)
            ->requirePresence('lowest_collectible_price_currency', 'create')
            ->notEmpty('lowest_collectible_price_currency');

        $validator
            ->integer('offer_listing_price')
            ->requirePresence('offer_listing_price', 'create')
            ->notEmpty('offer_listing_price');

        $validator
            ->scalar('offer_listing_price_currency')
            ->maxLength('offer_listing_price_currency', 255)
            ->requirePresence('offer_listing_price_currency', 'create')
            ->notEmpty('offer_listing_price_currency');

        $validator
            ->integer('offer_listing_saved_price')
            ->requirePresence('offer_listing_saved_price', 'create')
            ->notEmpty('offer_listing_saved_price');

        $validator
            ->scalar('offer_listing_saved_price_currency')
            ->maxLength('offer_listing_saved_price_currency', 255)
            ->requirePresence('offer_listing_saved_price_currency', 'create')
            ->notEmpty('offer_listing_saved_price_currency');

        $validator
            ->integer('sales_ranking')
            ->requirePresence('sales_ranking', 'create')
            ->notEmpty('sales_ranking');

        $validator
            ->scalar('ean')
            ->maxLength('ean', 255)
            ->requirePresence('ean', 'create')
            ->notEmpty('ean');

        $validator
            ->dateTime('release_date_at')
            ->requirePresence('release_date_at', 'create')
            ->notEmpty('release_date_at');

        $validator
            ->dateTime('publication_date_at')
            ->requirePresence('publication_date_at', 'create')
            ->notEmpty('publication_date_at');

        $validator
            ->dateTime('original_release_date_at')
            ->requirePresence('original_release_date_at', 'create')
            ->notEmpty('original_release_date_at');

        $validator
            ->scalar('condition_status')
            ->maxLength('condition_status', 255)
            ->requirePresence('condition_status', 'create')
            ->notEmpty('condition_status');

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
            ->requirePresence('total_new', 'create')
            ->notEmpty('total_new');

        $validator
            ->integer('total_used')
            ->requirePresence('total_used', 'create')
            ->notEmpty('total_used');

        $validator
            ->integer('total_collectible')
            ->requirePresence('total_collectible', 'create')
            ->notEmpty('total_collectible');

        $validator
            ->integer('total_refurbished')
            ->requirePresence('total_refurbished', 'create')
            ->notEmpty('total_refurbished');

        $validator
            ->scalar('customer_reviews_url')
            ->maxLength('customer_reviews_url', 4095)
            ->requirePresence('customer_reviews_url', 'create')
            ->notEmpty('customer_reviews_url');

        return $validator;
    }
}
