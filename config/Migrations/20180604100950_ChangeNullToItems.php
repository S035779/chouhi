<?php
use Migrations\AbstractMigration;

class ChangeNullToItems extends AbstractMigration
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
      $table = $this->table('items');
      $table->changeColumn('item_height', 'float');
      $table->changeColumn('item_length', 'float');
      $table->changeColumn('item_weight', 'float');
      $table->changeColumn('item_width', 'float');
      $table->changeColumn('package_height', 'float');
      $table->changeColumn('package_length', 'float');
      $table->changeColumn('package_weight', 'float');
      $table->changeColumn('package_width', 'float');
      $table->changeColumn('is_eligible_prime', 'boolean', [
        'null' => true
      ]);
      $table->changeColumn('is_eligible_for_supersaver_shipping', 'boolean', [
        'null' => true
      ]);
      $table->changeColumn('list_price', 'float', [
        'null' => true
      ]);
      $table->changeColumn('list_price_currency', 'string', [
        'null' => true
      ]);
      $table->changeColumn('lowest_price', 'float', [
        'null' => true
      ]);
      $table->changeColumn('lowest_price_currency', 'string', [
        'null' => true
      ]);
      $table->changeColumn('lowest_used_price', 'float', [
        'null' => true
      ]);
      $table->changeColumn('lowest_used_price_currency', 'string', [
        'null' => true
      ]);
      $table->changeColumn('lowest_collectible_price', 'float', [
        'null' => true
      ]);
      $table->changeColumn('lowest_collectible_price_currency', 'string', [
        'null' => true
      ]);
      $table->changeColumn('offer_listing_price', 'float', [
        'null' => true
      ]);
      $table->changeColumn('offer_listing_price_currency', 'string', [
        'null' => true
      ]);
      $table->changeColumn('offer_listing_saved_price', 'float', [
        'null' => true
      ]);
      $table->changeColumn('offer_listing_saved_price_currency', 'string', [
        'null' => true
      ]);
      $table->changeColumn('sales_ranking', 'integer', [
        'null' => true
      ]);
      $table->changeColumn('ean', 'string', [
        'null' => true
      ]);
      $table->changeColumn('release_date_at', 'datetime', [
        'null' => true
      ]);
      $table->changeColumn('publication_date_at', 'datetime', [
        'null' => true
      ]);
      $table->changeColumn('original_release_date_at', 'datetime', [
        'null' => true
      ]);
      $table->changeColumn('condition_status', 'string', [
        'null' => true
      ]);
      $table->changeColumn('total_new', 'integer', [
        'null' => true
      ]);
      $table->changeColumn('total_used', 'integer', [
        'null' => true
      ]);
      $table->changeColumn('total_collectible', 'integer', [
        'null' => true
      ]);
      $table->changeColumn('total_refurbished', 'integer', [
        'null' => true
      ]);
      $table->changeColumn('customer_reviews_url', 'string', [
        'null' => true
      ]);
      $table->update();
    }

    public function down()
    {
      $table = $this->table('items');
      $table->changeColumn('item_height', 'integer');
      $table->changeColumn('item_length', 'integer');
      $table->changeColumn('item_weight', 'integer');
      $table->changeColumn('item_width', 'integer');
      $table->changeColumn('package_height', 'integer');
      $table->changeColumn('package_length', 'integer');
      $table->changeColumn('package_weight', 'integer');
      $table->changeColumn('package_width', 'integer');
      $table->changeColumn('is_eligible_prime', 'boolean', [
        'null' => false
      ]);
      $table->changeColumn('is_eligible_for_supersaver_shipping', 'boolean', [
        'null' => false
      ]);
      $table->changeColumn('list_price', 'float', [
        'null' => false
      ]);
      $table->changeColumn('list_price_currency', 'string', [
        'null' => false
      ]);
      $table->changeColumn('lowest_price', 'float', [
        'null' => false
      ]);
      $table->changeColumn('lowest_price_currency', 'string', [
        'null' => false
      ]);
      $table->changeColumn('lowest_used_price', 'float', [
        'null' => false
      ]);
      $table->changeColumn('lowest_used_price_currency', 'string', [
        'null' => false
      ]);
      $table->changeColumn('lowest_collectible_price', 'float', [
        'null' => false
      ]);
      $table->changeColumn('lowest_collectible_price_currency', 'string', [
        'null' => false
      ]);
      $table->changeColumn('offer_listing_price', 'float', [
        'null' => false
      ]);
      $table->changeColumn('offer_listing_price_currency', 'string', [
        'null' => false
      ]);
      $table->changeColumn('offer_listing_saved_price', 'float', [
        'null' => false
      ]);
      $table->changeColumn('offer_listing_saved_price_currency', 'string', [
        'null' => false
      ]);
      $table->changeColumn('sales_ranking', 'integer', [
        'null' => false
      ]);
      $table->changeColumn('ean', 'string', [
        'null' => false
      ]);
      $table->changeColumn('release_date_at', 'datetime', [
        'null' => false
      ]);
      $table->changeColumn('publication_date_at', 'datetime', [
        'null' => false
      ]);
      $table->changeColumn('original_release_date_at', 'datetime', [
        'null' => false
      ]);
      $table->changeColumn('condition_status', 'string', [
        'null' => false
      ]);
      $table->changeColumn('total_new', 'integer', [
        'null' => false
      ]);
      $table->changeColumn('total_used', 'integer', [
        'null' => false
      ]);
      $table->changeColumn('total_collectible', 'integer', [
        'null' => false
      ]);
      $table->changeColumn('total_refurbished', 'integer', [
        'null' => false
      ]);
      $table->changeColumn('customer_reviews_url', 'string', [
        'null' => false
      ]);
      $table->update();
    }
}
