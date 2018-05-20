<?php
use Migrations\AbstractMigration;

class ChangeTitleToItems extends AbstractMigration
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
      $table->changeColumn('title', 'string', [
        'default' => null
      , 'limit'   => 4095
      , 'null'    => false
      ]);
      $table->update();
    }

    public function down()
    {
      $table = $this->table('items');
      $table->changeColumn('title', 'string', [
        'default' => null
      , 'limit'   => 255
      , 'null'    => false
      ]);
      $table->update();
    }
}
