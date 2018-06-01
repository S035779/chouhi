<?php
use Migrations\AbstractMigration;

class AddEanToAsins extends AbstractMigration
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
        $table->addColumn('ean', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('isbn', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('sku', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('upc', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
        ]);
        $table->update();
    }

    public function down()
    {
      $table = $this->table('asins');
      $table->removeColumn('ean');
      $table->removeColumn('isbn');
      $table->removeColumn('sku');
      $table->removeColumn('upc');
      $table->update();
    }
}
