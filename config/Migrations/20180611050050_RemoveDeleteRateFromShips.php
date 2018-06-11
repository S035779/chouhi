<?php
use Migrations\AbstractMigration;

class RemoveDeleteRateFromShips extends AbstractMigration
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
        $table = $this->table('ships');
        $table->removeColumn('delete_rate_1');
        $table->removeColumn('delete_rate_2');
        $table->removeColumn('delete_rate_3');
        $table->removeColumn('delete_rate_4');
        $table->removeColumn('delete_rate_5');
        $table->removeColumn('delete_price_1');
        $table->removeColumn('delete_price_2');
        $table->removeColumn('delete_price_3');
        $table->removeColumn('delete_price_4');
        $table->removeColumn('delete_price_5');
        $table->removeColumn('is_fulfillment_selling');
        $table->update();
    }

    public function down()
    {
        $table = $this->table('ships');
        $table->addColumn('delete_rate_1', 'integer', ['default' => null, 'limit' => 11, 'null' => false]);
        $table->addColumn('delete_rate_2', 'integer', ['default' => null, 'limit' => 11, 'null' => false]);
        $table->addColumn('delete_rate_3', 'integer', ['default' => null, 'limit' => 11, 'null' => false]);
        $table->addColumn('delete_rate_4', 'integer', ['default' => null, 'limit' => 11, 'null' => false]);
        $table->addColumn('delete_rate_5', 'integer', ['default' => null, 'limit' => 11, 'null' => false]);
        $table->addColumn('delete_price_1', 'float', ['default' => null, 'null' => false]);
        $table->addColumn('delete_price_2', 'float', ['default' => null, 'null' => false]);
        $table->addColumn('delete_price_3', 'float', ['default' => null, 'null' => false]);
        $table->addColumn('delete_price_4', 'float', ['default' => null, 'null' => false]);
        $table->addColumn('delete_price_5', 'float', ['default' => null, 'null' => false]);
        $table->addColumn('is_fulfillment_selling', 'boolean', ['default' => null, 'null' => false]);
        $table->update();
    }
}
