<?php
use Migrations\AbstractMigration;

class AddSmallImageUrlToItems extends AbstractMigration
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
        $table->addColumn('small_image_url', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->update();
    }

    public function down()
    {
      $table = $this->table('items');
      $table->removeColumn('small_image_url');
      $table->update();
    }
}
