<?php
use Migrations\AbstractMigration;

class ChangeNonNullTOMerchants extends AbstractMigration
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
      $table->changeColumn('minimum_seller_allow_price', 'integer', [
        'default' => null
      , 'limit'   => 11
      , 'null'    => true
      ]);
      $table->changeColumn('maximum_seller_allow_price', 'integer', [
        'default' => null
      , 'limit'   => 11
      , 'null'    => true
      ]);
      $table->changeColumn('standard_plus', 'string', [
        'default' => null
      , 'limit'   => 255
      , 'null'    => true
      ]);
      $table->changeColumn('product_tax_code', 'string', [
        'default' => null
      , 'limit'   => 255
      , 'null'    => true
      ]);
      $table->changeColumn('leadtime_to_ship', 'integer', [
        'default' => null
      , 'limit'   => 11
      , 'null'    => true
      ]);
      $table->changeColumn('currency', 'string', [
        'default' => null
      , 'limit'   => 255
      , 'null'    => true
      ]);
      $table->changeColumn('shipping_option_1', 'string', [
        'default' => null
      , 'limit'   => 255
      , 'null'    => true
      ]);
      $table->changeColumn('shipping_option_2', 'string', [
        'default' => null
      , 'limit'   => 255
      , 'null'    => true
      ]);
      $table->changeColumn('shipping_option_3', 'string', [
        'default' => null
      , 'limit'   => 255
      , 'null'    => true
      ]);
      $table->changeColumn('shipping_option_4', 'string', [
        'default' => null
      , 'limit'   => 255
      , 'null'    => true
      ]);
      $table->changeColumn('shipping_option_5', 'string', [
        'default' => null
      , 'limit'   => 255
      , 'null'    => true
      ]);
      $table->changeColumn('shipping_option_6', 'string', [
        'default' => null
      , 'limit'   => 255
      , 'null'    => true
      ]);
      $table->changeColumn('shipping_amount_1', 'integer', [
        'default' => null
      , 'limit'   => 11
      , 'null'    => true
      ]);
      $table->changeColumn('shipping_amount_2', 'integer', [
        'default' => null
      , 'limit'   => 11
      , 'null'    => true
      ]);
      $table->changeColumn('shipping_amount_3', 'integer', [
        'default' => null
      , 'limit'   => 11
      , 'null'    => true
      ]);
      $table->changeColumn('shipping_amount_4', 'integer', [
        'default' => null
      , 'limit'   => 11
      , 'null'    => true
      ]);
      $table->changeColumn('shipping_amount_5', 'integer', [
        'default' => null
      , 'limit'   => 11
      , 'null'    => true
      ]);
      $table->changeColumn('shipping_amount_6', 'integer', [
        'default' => null
      , 'limit'   => 11
      , 'null'    => true
      ]);
      $table->changeColumn('type_1', 'string', [
        'default' => null
      , 'limit'   => 255
      , 'null'    => true
      ]);
      $table->changeColumn('type_2', 'string', [
        'default' => null
      , 'limit'   => 255
      , 'null'    => true
      ]);
      $table->changeColumn('type_3', 'string', [
        'default' => null
      , 'limit'   => 255
      , 'null'    => true
      ]);
      $table->changeColumn('type_4', 'string', [
        'default' => null
      , 'limit'   => 255
      , 'null'    => true
      ]);
      $table->changeColumn('type_5', 'string', [
        'default' => null
      , 'limit'   => 255
      , 'null'    => true
      ]);
      $table->changeColumn('type_6', 'string', [
        'default' => null
      , 'limit'   => 255
      , 'null'    => true
      ]);
      $table->changeColumn('is_shipping_restricted_1', 'boolean', [
        'default' => null
      , 'limit'   => 1
      , 'null'    => true
      ]);
      $table->changeColumn('is_shipping_restricted_2', 'boolean', [
        'default' => null
      , 'limit'   => 1
      , 'null'    => true
      ]);
      $table->changeColumn('is_shipping_restricted_3', 'boolean', [
        'default' => null
      , 'limit'   => 1
      , 'null'    => true
      ]);
      $table->changeColumn('is_shipping_restricted_4', 'boolean', [
        'default' => null
      , 'limit'   => 1
      , 'null'    => true
      ]);
      $table->changeColumn('is_shipping_restricted_5', 'boolean', [
        'default' => null
      , 'limit'   => 1
      , 'null'    => true
      ]);
      $table->changeColumn('is_shipping_restricted_6', 'boolean', [
        'default' => null
      , 'limit'   => 1
      , 'null'    => true
      ]);
      $table->changeColumn('update_delete', 'string', [
        'default' => null
      , 'limit'   => 255
      , 'null'    => true
      ]);
      $table->update();
    }

    public function down()
    {
      $table = $this->table('merchants');
      $table->changeColumn('minimum_seller_allow_price', 'integer', [
        'default' => null
      , 'limit'   => 11
      , 'null'    => false
      ]);
      $table->changeColumn('maximum_seller_allow_price', 'integer', [
        'default' => null
      , 'limit'   => 11
      , 'null'    => false
      ]);
      $table->changeColumn('standard_plus', 'string', [
        'default' => null
      , 'limit'   => 255
      , 'null'    => false
      ]);
      $table->changeColumn('product_tax_code', 'string', [
        'default' => null
      , 'limit'   => 255
      , 'null'    => false
      ]);
      $table->changeColumn('leadtime_to_ship', 'integer', [
        'default' => null
      , 'limit'   => 11
      , 'null'    => false
      ]);
      $table->changeColumn('currency', 'string', [
        'default' => null
      , 'limit'   => 255
      , 'null'    => false
      ]);
      $table->changeColumn('shipping_option_1', 'string', [
        'default' => null
      , 'limit'   => 255
      , 'null'    => false
      ]);
      $table->changeColumn('shipping_option_2', 'string', [
        'default' => null
      , 'limit'   => 255
      , 'null'    => false
      ]);
      $table->changeColumn('shipping_option_3', 'string', [
        'default' => null
      , 'limit'   => 255
      , 'null'    => false
      ]);
      $table->changeColumn('shipping_option_4', 'string', [
        'default' => null
      , 'limit'   => 255
      , 'null'    => false
      ]);
      $table->changeColumn('shipping_option_5', 'string', [
        'default' => null
      , 'limit'   => 255
      , 'null'    => false
      ]);
      $table->changeColumn('shipping_option_6', 'string', [
        'default' => null
      , 'limit'   => 255
      , 'null'    => false
      ]);
      $table->changeColumn('shipping_amount_1', 'integer', [
        'default' => null
      , 'limit'   => 11
      , 'null'    => false
      ]);
      $table->changeColumn('shipping_amount_2', 'integer', [
        'default' => null
      , 'limit'   => 11
      , 'null'    => false
      ]);
      $table->changeColumn('shipping_amount_3', 'integer', [
        'default' => null
      , 'limit'   => 11
      , 'null'    => false
      ]);
      $table->changeColumn('shipping_amount_4', 'integer', [
        'default' => null
      , 'limit'   => 11
      , 'null'    => false
      ]);
      $table->changeColumn('shipping_amount_5', 'integer', [
        'default' => null
      , 'limit'   => 11
      , 'null'    => false
      ]);
      $table->changeColumn('shipping_amount_6', 'integer', [
        'default' => null
      , 'limit'   => 11
      , 'null'    => false
      ]);
      $table->changeColumn('type_1', 'string', [
        'default' => null
      , 'limit'   => 255
      , 'null'    => false
      ]);
      $table->changeColumn('type_2', 'string', [
        'default' => null
      , 'limit'   => 255
      , 'null'    => false
      ]);
      $table->changeColumn('type_3', 'string', [
        'default' => null
      , 'limit'   => 255
      , 'null'    => false
      ]);
      $table->changeColumn('type_4', 'string', [
        'default' => null
      , 'limit'   => 255
      , 'null'    => false
      ]);
      $table->changeColumn('type_5', 'string', [
        'default' => null
      , 'limit'   => 255
      , 'null'    => false
      ]);
      $table->changeColumn('type_6', 'string', [
        'default' => null
      , 'limit'   => 255
      , 'null'    => false
      ]);
      $table->changeColumn('is_shipping_restricted_1', 'boolean', [
        'default' => null
      , 'limit'   => 1
      , 'null'    => false
      ]);
      $table->changeColumn('is_shipping_restricted_2', 'boolean', [
        'default' => null
      , 'limit'   => 1
      , 'null'    => false
      ]);
      $table->changeColumn('is_shipping_restricted_3', 'boolean', [
        'default' => null
      , 'limit'   => 1
      , 'null'    => false
      ]);
      $table->changeColumn('is_shipping_restricted_4', 'boolean', [
        'default' => null
      , 'limit'   => 1
      , 'null'    => false
      ]);
      $table->changeColumn('is_shipping_restricted_5', 'boolean', [
        'default' => null
      , 'limit'   => 1
      , 'null'    => false
      ]);
      $table->changeColumn('is_shipping_restricted_6', 'boolean', [
        'default' => null
      , 'limit'   => 1
      , 'null'    => false
      ]);
      $table->changeColumn('update_delete', 'string', [
        'default' => null
      , 'limit'   => 255
      , 'null'    => false
      ]);
      $table->update();
    }
}
