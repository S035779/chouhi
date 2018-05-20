<?php
use Migrations\AbstractMigration;

class ChangeLowestPriceToItems extends AbstractMigration
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
      $table->changeColumn('lowest_price', 'integer', [
        'default' => null
      , 'null'    => false
      ]);
      $table->changeColumn('detail_page_url', 'string', [
        'default' => null
      , 'limit'   => 1023
      , 'null'    => false
      ]);
      $table->update();
    }
     
    public function down()
    {
      $table = $this->table('items');
      $table->changeColumn('lowest_price', 'string', [
        'default' => 'null'
      , 'limit'   => 255
      , 'null'    => false
      ]);
      $table->changeColumn('detail_page_url', 'string', [
        'default' => null
      , 'limit'   => 255
      , 'null'    => false
      ]);
      $table->update();
    }
}
