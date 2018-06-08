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
            ->allowEmpty('item_name', 'update');

        $validator
            ->scalar('product_identifier')
            ->maxLength('product_identifier', 255)
            ->allowEmpty('product_identifier', 'update');

        $validator
            ->integer('product_id_type')
            ->allowEmpty('product_id_type', 'update');

        $validator
            ->allowEmpty('price', 'update');

        $validator
            ->allowEmpty('minimum_seller_allow_price');

        $validator
            ->allowEmpty('maximum_seller_allow_price');

        $validator
            ->integer('item_condition')
            ->allowEmpty('item_condition', 'update');

        $validator
            ->integer('quantity')
            ->allowEmpty('quantity', 'update');

        $validator
            ->scalar('add_delete')
            ->maxLength('add_delete', 255)
            ->allowEmpty('add_delete', 'update');

        $validator
            ->scalar('will_ship_internationally')
            ->maxLength('will_ship_internationally', 255)
            ->allowEmpty('will_ship_internationally', 'update');

        $validator
            ->scalar('expedited_shipping')
            ->maxLength('expedited_shipping', 255)
            ->allowEmpty('expedited_shipping', 'update');

        $validator
            ->scalar('standard_plus')
            ->maxLength('standard_plus', 255)
            ->allowEmpty('standard_plus');

        $validator
            ->scalar('item_note')
            ->maxLength('item_note', 2047)
            ->allowEmpty('item_note', 'update');

        $validator
            ->scalar('fullfillment_channel')
            ->maxLength('fullfillment_channel', 1023)
            ->allowEmpty('fullfillment_channel', 'update');

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
            ->allowEmpty('seller_sku', 'update');

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
            ->allowEmpty('item_description', 'update');

        $validator
            ->scalar('listing_identifier')
            ->maxLength('listing_identifier', 255)
            ->allowEmpty('listing_identifier', 'update');

        $validator
            ->dateTime('open_date_at')
            ->allowEmpty('open_date_at', 'update');

        $validator
            ->scalar('image_url')
            ->maxLength('image_url', 2047)
            ->allowEmpty('image_url', 'update');

        $validator
            ->scalar('item_is_marketplace')
            ->maxLength('item_is_marketplace', 255)
            ->allowEmpty('item_is_marketplace', 'update');

        $validator
            ->integer('zshop_shipping_fee')
            ->allowEmpty('zshop_shippping_fee', 'update');

        $validator
            ->scalar('zshop_category1')
            ->maxLength('zshop_category1', 255)
            ->allowEmpty('zshop_category1', 'update');

        $validator
            ->scalar('zshop_browse_path')
            ->maxLength('zshop_browse_path', 255)
            ->allowEmpty('zshop_browse_path', 'update');

        $validator
            ->scalar('zshop_storefront_feature')
            ->maxLength('zshop_storefront_feature', 255)
            ->allowEmpty('zshop_storefront_feature', 'update');

        $validator
            ->scalar('asin1')
            ->maxLength('asin1', 255)
            ->allowEmpty('asin1', 'update');

        $validator
            ->scalar('asin2')
            ->maxLength('asin2', 255)
            ->allowEmpty('asin2', 'update');

        $validator
            ->scalar('asin3')
            ->maxLength('asin3', 255)
            ->allowEmpty('asin3', 'update');

        $validator
            ->scalar('zshop_boldface')
            ->maxLength('zshop_boldface', 255)
            ->allowEmpty('zshop_boldface', 'update');

        $validator
            ->scalar('bid_for_featured_placement')
            ->maxLength('bid_for_featured_placement', 255)
            ->allowEmpty('bid_for_featured_placement', 'update');

        $validator
            ->integer('pending_quantity')
            ->allowEmpty('pending_quantity', 'update');

        $validator
            ->scalar('merchant_shipping_group')
            ->maxLength('merchant_shipping_group', 255)
            ->allowEmpty('merchant_shipping_group', 'update');

        $validator
            ->integer('point')
            ->allowEmpty('point', 'update');

        $validator
            ->scalar('seller_identifier')
            ->maxLength('seller_identifier', 255)
            ->allowEmpty('seller_identifier', 'update');

        $validator
            ->scalar('marketplace')
            ->maxLength('marketplace', 255)
            ->allowEmpty('marketplace', 'update');

        return $validator;
    }
}
