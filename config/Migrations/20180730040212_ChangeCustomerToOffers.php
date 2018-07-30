<?php
use Migrations\AbstractMigration;

class ChangeCustomerToOffers extends AbstractMigration
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
      $table->changeColumn('total_reviews', 'integer', [
        'limit' => 11
      , 'default' => null
      , 'null'    => true
      ]);
      $table->changeColumn('average_rating', 'integer', [
        'limit' => 11
      , 'default' => null
      , 'null'    => true
      ]);
      $table->changeColumn('total_votes', 'integer', [
        'limit' => 11
      , 'default' => null
      , 'null'    => true
      ]);
      $table->changeColumn('customer_reviews_url', 'string', [
        'limit' => 4095
      , 'default' => null
      , 'null'    => true
      ]);
    }

    public function down()
    {
      $table = $this->table('offers');
      $table->changeColumn('total_reviews', 'integer', [
        'limit'   => 11
      , 'default' => null
      , 'null'    => false
      ]);
      $table->changeColumn('average_rating', 'integer', [
        'limit'   => 11
      , 'default' => null
      , 'null'    => false
      ]);
      $table->changeColumn('total_votes', 'integer', [
        'limit'   => 11
      , 'default' => null
      , 'null'    => false
      ]);
      $table->changeColumn('customer_reviews_url', 'string', [
        'limit'   => 255
      , 'default' => null
      , 'null'    => false
      ]);
    }
};
