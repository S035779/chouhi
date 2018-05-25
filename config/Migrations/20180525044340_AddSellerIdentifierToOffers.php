<?php
use Migrations\AbstractMigration;

class AddSellerIdentifierToOffers extends AbstractMigration
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
        $table->addColumn('seller_identifier', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->update();
    }

    public function down()
    {
      $table = $this->table('offers');
      $table->removeColumn('seller_identifier');
      $table->update();
    }
}
