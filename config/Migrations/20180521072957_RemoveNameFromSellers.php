<?php
use Migrations\AbstractMigration;

class RemoveNameFromSellers extends AbstractMigration
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
        $table = $this->table('sellers');
        $table->removeColumn('name');
        $table->update();
    }
    
    public function down()
    {
      $table = $this->table('sellers');
      $table->addColumn('name', 'string', [
        'default' => null
      , 'limit' => 255
      , 'null' => false
      ]);
      $table->update();
    }
}
