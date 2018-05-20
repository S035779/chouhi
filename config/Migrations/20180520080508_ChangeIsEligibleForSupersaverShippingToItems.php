<?php
use Migrations\AbstractMigration;

class ChangeIsEligibleForSupersaverShippingToItems extends AbstractMigration
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
      $table->changeColumn('is_eligible_for_supersaver_shipping', 'boolean', [
        'default' => null
      , 'null'    => false
      ]);
      $table->update();
    }

    public function down()
    {
      $table = $this->table('items');
      $table->changeColumn('is_eligible_for_supersaver_shipping', 'string', [
        'default' => null
      , 'limit'   => 255
      , 'null'    => false
      ]);
      $table->update();
    }
}
