<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Merchants Model
 *
 * @method \App\Model\Entity\Merchant get($primaryKey, $options = [])
 * @method \App\Model\Entity\Merchant newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Merchant[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Merchant|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Merchant patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Merchant[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Merchant findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MerchantsTable extends Table
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

        $this->setTable('merchants');
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
            ->scalar('item_name')
            ->maxLength('item_name', 255)
            ->requirePresence('item_name', 'create')
            ->notEmpty('item_name');

        $validator
            ->scalar('product_identifier')
            ->maxLength('product_identifier', 255)
            ->requirePresence('product_identifier', 'create')
            ->notEmpty('product_identifier');

        $validator
            ->integer('product_id_type')
            ->requirePresence('product_id_type', 'create')
            ->notEmpty('product_id_type');

        $validator
            ->integer('price')
            ->requirePresence('price', 'create')
            ->notEmpty('price');

        $validator
            ->integer('minimum_seller_allow_price')
            ->allowEmpty('minimum_seller_allow_price');

        $validator
            ->integer('maximum_seller_allow_price')
            ->allowEmpty('maximum_seller_allow_price');

        $validator
            ->integer('item_condition')
            ->requirePresence('item_condition', 'create')
            ->notEmpty('item_condition');

        $validator
            ->integer('quantity')
            ->requirePresence('quantity', 'create')
            ->notEmpty('quantity');

        $validator
            ->scalar('add_delete')
            ->maxLength('add_delete', 255)
            ->requirePresence('add_delete', 'create')
            ->notEmpty('add_delete');

        $validator
            ->scalar('will_ship_internationally')
            ->maxLength('will_ship_internationally', 255)
            ->requirePresence('will_ship_internationally', 'create')
            ->notEmpty('will_ship_internationally');

        $validator
            ->scalar('expedited_shipping')
            ->maxLength('expedited_shipping', 255)
            ->requirePresence('expedited_shipping', 'create')
            ->notEmpty('expedited_shipping');

        $validator
            ->scalar('standard_plus')
            ->maxLength('standard_plus', 255)
            ->allowEmpty('standard_plus');

        $validator
            ->scalar('item_note')
            ->maxLength('item_note', 2047)
            ->requirePresence('item_note', 'create')
            ->notEmpty('item_note');

        $validator
            ->scalar('fullfillment_channel')
            ->maxLength('fullfillment_channel', 1023)
            ->requirePresence('fullfillment_channel', 'create')
            ->notEmpty('fullfillment_channel');

        $validator
            ->scalar('product_tax_code')
            ->maxLength('product_tax_code', 255)
            ->allowEmpty('product_tax_code');

        $validator
            ->integer('leadtime_to_ship')
            ->allowEmpty('leadtime_to_ship');

        $validator
            ->scalar('seller_sku')
            ->maxLength('seller_sku', 255)
            ->requirePresence('seller_sku', 'create')
            ->notEmpty('seller_sku');

        $validator
            ->scalar('currency')
            ->maxLength('currency', 255)
            ->allowEmpty('currency');

        $validator
            ->scalar('shipping_option_1')
            ->maxLength('shipping_option_1', 255)
            ->allowEmpty('shipping_option_1');

        $validator
            ->scalar('shipping_option_2')
            ->maxLength('shipping_option_2', 255)
            ->allowEmpty('shipping_option_2');

        $validator
            ->scalar('shipping_option_3')
            ->maxLength('shipping_option_3', 255)
            ->allowEmpty('shipping_option_3');

        $validator
            ->scalar('shipping_option_4')
            ->maxLength('shipping_option_4', 255)
            ->allowEmpty('shipping_option_4');

        $validator
            ->scalar('shipping_option_5')
            ->maxLength('shipping_option_5', 255)
            ->allowEmpty('shipping_option_5');

        $validator
            ->scalar('shipping_option_6')
            ->maxLength('shipping_option_6', 255)
            ->allowEmpty('shipping_option_6');

        $validator
            ->integer('shipping_amount_1')
            ->allowEmpty('shipping_amount_1');

        $validator
            ->integer('shipping_amount_2')
            ->allowEmpty('shipping_amount_2');

        $validator
            ->integer('shipping_amount_3')
            ->allowEmpty('shipping_amount_3');

        $validator
            ->integer('shipping_amount_4')
            ->allowEmpty('shipping_amount_4');

        $validator
            ->integer('shipping_amount_5')
            ->allowEmpty('shipping_amount_5');

        $validator
            ->integer('shipping_amount_6')
            ->allowEmpty('shipping_amount_6');

        $validator
            ->scalar('type_1')
            ->maxLength('type_1', 255)
            ->allowEmpty('type_1');

        $validator
            ->scalar('type_2')
            ->maxLength('type_2', 255)
            ->allowEmpty('type_2');

        $validator
            ->scalar('type_3')
            ->maxLength('type_3', 255)
            ->allowEmpty('type_3');

        $validator
            ->scalar('type_4')
            ->maxLength('type_4', 255)
            ->allowEmpty('type_4');

        $validator
            ->scalar('type_5')
            ->maxLength('type_5', 255)
            ->allowEmpty('type_5');

        $validator
            ->scalar('type_6')
            ->maxLength('type_6', 255)
            ->allowEmpty('type_6');

        $validator
            ->boolean('is_shipping_restricted_1')
            ->allowEmpty('is_shipping_restricted_1');

        $validator
            ->boolean('is_shipping_restricted_2')
            ->allowEmpty('is_shipping_restricted_2');

        $validator
            ->boolean('is_shipping_restricted_3')
            ->allowEmpty('is_shipping_restricted_3');

        $validator
            ->boolean('is_shipping_restricted_4')
            ->allowEmpty('is_shipping_restricted_4');

        $validator
            ->boolean('is_shipping_restricted_5')
            ->allowEmpty('is_shipping_restricted_5');

        $validator
            ->boolean('is_shipping_restricted_6')
            ->allowEmpty('is_shipping_restricted_6');

        $validator
            ->scalar('update_delete')
            ->maxLength('update_delete', 255)
            ->allowEmpty('update_delete');

        $validator
            ->scalar('item_description')
            ->maxLength('item_description', 1023)
            ->requirePresence('item_description', 'create')
            ->notEmpty('item_description');

        $validator
            ->scalar('listing_identifier')
            ->maxLength('listing_identifier', 255)
            ->requirePresence('listing_identifier', 'create')
            ->notEmpty('listing_identifier');

        $validator
            ->dateTime('open_date_at')
            ->requirePresence('open_date_at', 'create')
            ->notEmpty('open_date_at');

        $validator
            ->scalar('image_url')
            ->maxLength('image_url', 2047)
            ->requirePresence('image_url', 'create')
            ->notEmpty('image_url');

        $validator
            ->scalar('item_is_marketplace')
            ->maxLength('item_is_marketplace', 255)
            ->requirePresence('item_is_marketplace', 'create')
            ->notEmpty('item_is_marketplace');

        $validator
            ->integer('zshop_shipping_fee')
            ->requirePresence('zshop_shipping_fee', 'create')
            ->notEmpty('zshop_shipping_fee');

        $validator
            ->scalar('zshop_category1')
            ->maxLength('zshop_category1', 255)
            ->requirePresence('zshop_category1', 'create')
            ->notEmpty('zshop_category1');

        $validator
            ->scalar('zshop_browse_path')
            ->maxLength('zshop_browse_path', 255)
            ->requirePresence('zshop_browse_path', 'create')
            ->notEmpty('zshop_browse_path');

        $validator
            ->scalar('zshop_storefront_feature')
            ->maxLength('zshop_storefront_feature', 255)
            ->requirePresence('zshop_storefront_feature', 'create')
            ->notEmpty('zshop_storefront_feature');

        $validator
            ->scalar('asin1')
            ->maxLength('asin1', 255)
            ->requirePresence('asin1', 'create')
            ->notEmpty('asin1');

        $validator
            ->scalar('asin2')
            ->maxLength('asin2', 255)
            ->requirePresence('asin2', 'create')
            ->notEmpty('asin2');

        $validator
            ->scalar('asin3')
            ->maxLength('asin3', 255)
            ->requirePresence('asin3', 'create')
            ->notEmpty('asin3');

        $validator
            ->scalar('zshop_boldface')
            ->maxLength('zshop_boldface', 255)
            ->requirePresence('zshop_boldface', 'create')
            ->notEmpty('zshop_boldface');

        $validator
            ->scalar('bid_for_featured_placement')
            ->maxLength('bid_for_featured_placement', 255)
            ->requirePresence('bid_for_featured_placement', 'create')
            ->notEmpty('bid_for_featured_placement');

        $validator
            ->integer('pending_quantity')
            ->requirePresence('pending_quantity', 'create')
            ->notEmpty('pending_quantity');

        $validator
            ->scalar('merchant_shipping_group')
            ->maxLength('merchant_shipping_group', 255)
            ->requirePresence('merchant_shipping_group', 'create')
            ->notEmpty('merchant_shipping_group');

        $validator
            ->integer('point')
            ->requirePresence('point', 'create')
            ->notEmpty('point');

        $validator
            ->scalar('seller_identifier')
            ->maxLength('seller_identifier', 255)
            ->requirePresence('seller_identifier', 'create')
            ->notEmpty('seller_identifier');

        $validator
            ->scalar('marketplace')
            ->maxLength('marketplace', 255)
            ->requirePresence('marketplace', 'create')
            ->notEmpty('marketplace');

        return $validator;
    }
}
