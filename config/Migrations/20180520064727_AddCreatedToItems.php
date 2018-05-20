<?php
use Migrations\AbstractMigration;

class AddCreatedToItems extends AbstractMigration
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
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->update();
    }

    public function down()
    {
      $table = $this->table('items');
      $table->removeColumn('created');
      $table->removeColumn('modified');
      $table->update();
    }
}
