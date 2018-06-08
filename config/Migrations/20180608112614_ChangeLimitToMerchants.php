<?php
use Migrations\AbstractMigration;

class ChangeLimitToMerchants extends AbstractMigration
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
      $table->changeColumn('product_id_type',       'integer', [
        'limit' => 11
      , 'null' => true
      ]);
      $table->changeColumn('item_note',             'string', [
        'limit' => 2047
      , 'null' => true
      ]);
      $table->changeColumn('fullfillment_channel',  'string', [
        'limit' => 1023
      , 'null' => true
      ]);
      $table->changeColumn('item_description',      'string', [
        'limit' => 1023
      , 'null' => true
      ]);
      $table->changeColumn('image_url',             'string', [
        'limit' => 2047
      , 'null' => true
      ]);
      $table->update();
    }
    public function down()
    {
      $table = $this->table('merchants');
      $table->changeColumn('product_id_type',       'string', [
        'limit' => 255
      , 'null' => true
      ]);
      $table->changeColumn('item_note',             'string', [
        'limit' => 255
      , 'null' => true
      ]);
      $table->changeColumn('fullfillment_channel',  'string', [
        'limit' => 255
      , 'null' => true
      ]);
      $table->changeColumn('item_description',      'string', [
        'limit' => 255
      , 'null' => true
      ]);
      $table->changeColumn('image_url',             'string', [
        'limit' => 255
      , 'null' => true
      ]);
      $table->update();
    }
}
