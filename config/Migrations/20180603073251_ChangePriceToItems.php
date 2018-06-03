<?php
use Migrations\AbstractMigration;

class ChangePriceToItems extends AbstractMigration
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
      $table->changeColumn('list_price', 'float', [
        'default' => null
      , 'null'    => false
      ]);
      $table->changeColumn('lowest_price', 'float', [
        'default' => null
      , 'null'    => false
      ]);
      $table->changeColumn('lowest_used_price', 'float', [
        'default' => null
      , 'null'    => false
      ]);
      $table->changeColumn('lowest_collectible_price', 'float', [
        'default' => null
      , 'null'    => false
      ]);
      $table->changeColumn('offer_listing_price', 'float', [
        'default' => null
      , 'null'    => false
      ]);
      $table->changeColumn('offer_listing_saved_price', 'float', [
        'default' => null
      , 'null'    => false
      ]);
      $table->update();
    }

    public function down()
    {
      $table = $this->table('items');
      $table->changeColumn('list_price', 'integer', [
        'default' => null
      , 'limit'   => 11
      , 'null'    => false
      ]);
      $table->changeColumn('lowest_price', 'integer', [
        'default' => null
      , 'limit'   => 11
      , 'null'    => false
      ]);
      $table->changeColumn('lowest_used_price', 'integer', [
        'default' => null
      , 'limit'   => 11
      , 'null'    => false
      ]);
      $table->changeColumn('lowest_collectible_price', 'integer', [
        'default' => null
      , 'limit'   => 11
      , 'null'    => false
      ]);
      $table->changeColumn('offer_listing_price', 'integer', [
        'default' => null
      , 'limit'   => 11
      , 'null'    => false
      ]);
      $table->changeColumn('offer_listing_saved_price', 'integer', [
        'default' => null
      , 'limit'   => 11
      , 'null'    => false
      ]);
      $table->update();
    }
}
