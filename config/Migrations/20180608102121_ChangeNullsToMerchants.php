<?php
use Migrations\AbstractMigration;

class ChangeNullsToMerchants extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function up()
    {
      $table = $this->table('merchants');

      $table->changeColumn('item_name',                 'string',   ['null' => true]);
      $table->changeColumn('product_identifier',        'string',   ['null' => true]);
      $table->changeColumn('product_id_type',           'string',   ['null' => true]);
      $table->changeColumn('price',                     'float',    ['null' => true]);
      $table->changeColumn('item_condition',            'integer',  ['null' => true]);
      $table->changeColumn('quantity',                  'integer',  ['null' => true]);
      $table->changeColumn('add_delete',                'string',   ['null' => true]);
      $table->changeColumn('will_ship_internationally', 'string',   ['null' => true]);
      $table->changeColumn('expedited_shipping',        'string',   ['null' => true]);
      $table->changeColumn('item_note',                 'string',   ['null' => true]);
      $table->changeColumn('fullfillment_channel',      'string',   ['null' => true]);
      $table->changeColumn('seller_sku',                'string',   ['null' => true]);
      $table->changeColumn('item_description',          'string',   ['null' => true]);
      $table->changeColumn('listing_identifier',        'string',   ['null' => true]);
      $table->changeColumn('open_date_at',              'datetime', ['null' => true]);
      $table->changeColumn('image_url',                 'string',   ['null' => true]);
      $table->changeColumn('item_is_marketplace',       'string',   ['null' => true]);
      $table->changeColumn('zshop_shipping_fee',        'integer',  ['null' => true]);
      $table->changeColumn('zshop_category1',           'string',   ['null' => true]);
      $table->changeColumn('zshop_browse_path',         'string',   ['null' => true]);
      $table->changeColumn('zshop_storefront_feature',  'string',   ['null' => true]);
      $table->changeColumn('asin1',                     'string',   ['null' => true]);
      $table->changeColumn('asin2',                     'string',   ['null' => true]);
      $table->changeColumn('asin3',                     'string',   ['null' => true]);
      $table->changeColumn('zshop_boldface',            'string',   ['null' => true]);
      $table->changeColumn('bid_for_featured_placement','string',   ['null' => true]);
      $table->changeColumn('pending_quantity',          'integer',  ['null' => true]);
      $table->changeColumn('merchant_shipping_group',   'string',   ['null' => true]);
      $table->changeColumn('point',                     'integer',  ['null' => true]);
      $table->changeColumn('seller_identifier',         'string',   ['null' => true]);
      $table->changeColumn('marketplace',               'string',   ['null' => true]);

      $table->update();
    }

    public function down()
    {
      $table = $this->table('merchants');

      $table->changeColumn('item_name',                 'string',   ['null' => false]);
      $table->changeColumn('product_identifier',        'string',   ['null' => false]);
      $table->changeColumn('product_id_type',           'string',   ['null' => false]);
      $table->changeColumn('price',                     'float',    ['null' => false]);
      $table->changeColumn('item_condition',            'integer',  ['null' => false]);
      $table->changeColumn('quantity',                  'integer',  ['null' => false]);
      $table->changeColumn('add_delete',                'string',   ['null' => false]);
      $table->changeColumn('will_ship_internationally', 'string',   ['null' => false]);
      $table->changeColumn('expedited_shipping',        'string',   ['null' => false]);
      $table->changeColumn('item_note',                 'string',   ['null' => false]);
      $table->changeColumn('fullfillment_channel',      'string',   ['null' => false]);
      $table->changeColumn('seller_sku',                'string',   ['null' => false]);
      $table->changeColumn('item_description',          'string',   ['null' => false]);
      $table->changeColumn('listing_identifier',        'string',   ['null' => false]);
      $table->changeColumn('open_date_at',              'datetime', ['null' => false]);
      $table->changeColumn('image_url',                 'string',   ['null' => false]);
      $table->changeColumn('item_is_marketplace',       'string',   ['null' => false]);
      $table->changeColumn('zshop_shipping_fee',        'integer',  ['null' => false]);
      $table->changeColumn('zshop_category1',           'string',   ['null' => false]);
      $table->changeColumn('zshop_browse_path',         'string',   ['null' => false]);
      $table->changeColumn('zshop_storefront_feature',  'string',   ['null' => false]);
      $table->changeColumn('asin1',                     'string',   ['null' => false]);
      $table->changeColumn('asin2',                     'string',   ['null' => false]);
      $table->changeColumn('asin3',                     'string',   ['null' => false]);
      $table->changeColumn('zshop_boldface',            'string',   ['null' => false]);
      $table->changeColumn('bid_for_featured_placement','string',   ['null' => false]);
      $table->changeColumn('pending_quantity',          'integer',  ['null' => false]);
      $table->changeColumn('merchant_shipping_group',   'string',   ['null' => false]);
      $table->changeColumn('point',                     'integer',  ['null' => false]);
      $table->changeColumn('seller_identifier',         'string',   ['null' => false]);
      $table->changeColumn('marketplace',               'string',   ['null' => false]);

      $table->update();
    }
}
