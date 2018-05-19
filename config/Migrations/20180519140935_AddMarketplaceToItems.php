<?php
use Migrations\AbstractMigration;

class AddMarketplaceToItems extends AbstractMigration
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
        $table->addColumn('marketplace', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->update();
    }

    public function down()
    {
      $table = $this->table('items');
      $table->removeColumn('marketplace');
      $table->update();
    }
}
