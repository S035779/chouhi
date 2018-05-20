<?php
use Migrations\AbstractMigration;

class ChangeReviewsToItems extends AbstractMigration
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
      $table->changeColumn('total_reviews',       'integer', [
        'default' => null
      , 'null'    => true
      ]);
      $table->changeColumn('average_rating',      'integer', [
        'default' => null
      , 'null'    => true
      ]);
      $table->changeColumn('total_votes',         'integer', [
        'default' => null
      , 'null'    => true
      ]);
      $table->changeColumn('quantity',            'integer', [
        'default' => null
      , 'null'    => true
      ]);
      $table->changeColumn('quantity_allocated',  'integer', [
        'default' => null
      , 'null'    => true
      ]);
      $table->changeColumn('status',              'boolean', [
        'default' => null
      , 'null'    => true
      ]);
      $table->update();
    }

    public function down()
    {
      $table = $this->table('items');
      $table->changeColumn('total_reviews',       'integer', [
        'default' => null
      , 'null' => false
      ]);
      $table->changeColumn('average_rating',      'integer', [
        'default' => null
      , 'null' => false
      ]);
      $table->changeColumn('total_votes',         'integer', [
        'default' => null
      , 'null' => false
      ]);
      $table->changeColumn('quantitiy',           'integer', [
        'default' => null
      , 'null' => false
      ]);
      $table->changeColumn('quantity_allocated',  'integer', [
        'default' => null
      , 'null' => false
      ]);
      $table->changeColumn('status',              'boolean', [
        'default' => null
      , 'null' => false
      ]);
      $table->update();
    }
}
