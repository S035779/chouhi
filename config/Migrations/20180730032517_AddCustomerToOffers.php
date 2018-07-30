<?php
use Migrations\AbstractMigration;

class AddCustomerToOffers extends AbstractMigration
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
        $table->addColumn('total_reviews', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('average_rating', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('total_votes', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('customer_reviews_url', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->update();
    }

    public function down() 
    {
      $table = $this->table('offers');
      $table->removeColumn('total_reviews');
      $table->removeColumn('average_rating');
      $table->removeColumn('total_votes');
      $table->removeColumn('customer_reviews_url');
      $table->update();
    }
}
