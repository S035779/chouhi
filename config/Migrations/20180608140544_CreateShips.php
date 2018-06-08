<?php
use Migrations\AbstractMigration;

class CreateShips extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('ships');
        $table->addColumn('is_fulfillment_selling', 'boolean', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('pending_quantity_rate', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('pending_quantity', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('price_criteria_1', 'float', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('price_criteria_2', 'float', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('price_criteria_3', 'float', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('price_criteria_4', 'float', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('sales_rate_1', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('sales_rate_2', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('sales_rate_3', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('sales_rate_4', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('sales_rate_5', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('sales_price_1', 'float', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('sales_price_2', 'float', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('sales_price_3', 'float', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('sales_price_4', 'float', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('sales_price_5', 'float', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('delete_rate_1', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('delete_rate_2', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('delete_rate_3', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('delete_rate_4', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('delete_rate_5', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('delete_price_1', 'float', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('delete_price_2', 'float', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('delete_price_3', 'float', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('delete_price_4', 'float', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('delete_price_5', 'float', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->create();
    }
}
