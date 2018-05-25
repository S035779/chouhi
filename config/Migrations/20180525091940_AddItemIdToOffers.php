<?php
use Migrations\AbstractMigration;

class AddItemIdToOffers extends AbstractMigration
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
        $table->addColumn('item_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->update();
    }

    public function down()
    {
      $table = $this->table('offers');
      $table->removeColumn('item_id');
      $table->update();
    }
}
