<?php
use Migrations\AbstractMigration;

class AddSuspensionToAsins extends AbstractMigration
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
        $table = $this->table('asins');
        $table->addColumn('suspended', 'boolean', [
            'default' => false,
            'null' => false,
        ]);
        $table->update();
    }

    public function down()
    {
      $table = $this->table('asins');
      $table->removeColumn('suspended');
      $table->update();
    }
}
