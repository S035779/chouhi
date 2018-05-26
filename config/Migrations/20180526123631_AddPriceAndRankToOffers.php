<?php
use Migrations\AbstractMigration;

class AddPriceAndRankToOffers extends AbstractMigration
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
        $table->addColumn('sales_ranking', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('lowest_price', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('lowest_price_currency', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->update();
    }
     
    public function down()
    {
      $table = $this->table('offers');
      $table->removeColumn('sales_ranking');
      $table->removeColumn('lowest_price');
      $table->removeColumn('lowest_price_currecy');
      $table->update();
    }
}
