<?php
use Migrations\AbstractMigration;

class RemoveCustomerFromItems extends AbstractMigration
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
        $table->removeColumn('total_reviews');
        $table->removeColumn('average_rating');
        $table->removeColumn('total_votes');
        $table->removeColumn('customer_reviews_url');
        $table->removeColumn('sales_ranking');
        $table->update();
    }

    public function down() 
    {
      $table = $this->table('items');
      $table->addColumn('total_reviews', 'integer', [
        'default' => null
      , 'limit'   => 11
      , 'null'    => true
      ]);
      $table->addColumn('average_rating', 'integer', [
        'default' => null
      , 'limit'   => 11
      , 'null'    => true
      ]);
      $table->addColumn('total_votes', 'integer', [
        'default' => null
      , 'limit'   => 11
      , 'null'    => true
      ]);
      $table->addColumn('customer_reviews_url', 'string', [
        'default' => null
      , 'limit'   => 255
      , 'null'    => true
      ]);
      $table->addColumn('sales_ranking', 'integer', [
        'default' => null
      , 'limit'   => 11
      , 'null'    => true
      ]);
    }
}
