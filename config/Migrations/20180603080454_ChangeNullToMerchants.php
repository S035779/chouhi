<?php
use Migrations\AbstractMigration;

class ChangeNullToMerchants extends AbstractMigration
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
      $table->changeColumn('minimum_seller_allow_price', 'float', [
        'default' => null
      , 'null'    => true
      ]);
      $table->changeColumn('maximum_seller_allow_price', 'float', [
        'default' => null
      , 'null'    => true
      ]);
      $table->update();
    }

    public function down()
    {
      $table = $this->table('merchants');
      $table->changeColumn('minimum_seller_allow_price', 'float', [
        'default' => null
      , 'null'    => false
      ]);
      $table->changeColumn('maximum_seller_allow_price', 'float', [
        'default' => null
      , 'null'    => false
      ]);
      $table->update();
    }
}
