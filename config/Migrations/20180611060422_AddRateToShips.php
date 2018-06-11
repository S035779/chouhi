<?php
use Migrations\AbstractMigration;

class AddRateToShips extends AbstractMigration
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
        $table->addColumn('jpy_price', 'float', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('usd_price', 'float', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('aud_price', 'float', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('jp_length', 'float', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('us_length', 'float', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('au_length', 'float', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('jp_weight', 'float', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('us_weight', 'float', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('au_weight', 'float', [
            'default' => null,
            'null' => false,
        ]);
        $table->update();
    }

    public function down()
    {
        $table = $this->table('ships');
        $table->removeColumn('jpy_price');
        $table->removeColumn('usd_price');
        $table->removeColumn('aud_price');
        $table->removeColumn('jp_length');
        $table->removeColumn('us_length');
        $table->removeColumn('au_length');
        $table->removeColumn('jp_weight');
        $table->removeColumn('us_weight');
        $table->removeColumn('au_weight');
        $table->update();
    }
}
