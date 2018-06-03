<?php
use Migrations\AbstractMigration;

class ChangePriceToOffers extends AbstractMigration
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
      $table = $this->table('offers');
      $table->changeColumn('price', 'float', [
        'default' => null
      , 'null'    => false
      ]);
      $table->changeColumn('lowest_price', 'float', [
        'default' => null
      , 'null'    => false
      ]);
      $table->update();
    }

    public function down()
    {
      $table = $this->table('offers');
      $table->changeColumn('price', 'integer', [
        'default' => null
      , 'limit'   => 11
      , 'null'    => false
      ]);
      $table->changeColumn('lowest_price', 'integer', [
        'default' => null
      , 'limit'   => 11
      , 'null'    => false
      ]);
      $table->update();
    }
}
