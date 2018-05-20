<?php
use Migrations\AbstractMigration;

class ChangeStatusToItems extends AbstractMigration
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
      $table->removeColumn('condition');
      $table->addColumn('condition_status', 'string', [
        'default' => null
      , 'limit'   => 255
      , 'null'    => false
      ]);
      $table->update();
    }

    public function down()
    {
      $table = $this->table('items');
      $table->removeColumn('condition_status');
      $table->addColumn('condition', 'string', [
        'default' => null
      , 'limit'   => 255
      , 'null'    => false
      ]);
      $table->update();
    }
}
