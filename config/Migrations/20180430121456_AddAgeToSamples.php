<?php
use Migrations\AbstractMigration;

class AddAgeToSamples extends AbstractMigration
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
        $table = $this->table('samples');
        $table->addColumn('age', 'integer', [
            'default' => null,
            'limit' => 3,
            'null' => true,
        ]);
        $table->update();
    }
    public function down() 
    {
      $table = $this->table('samples');
      $table->removeColumn('age');
      $table->update();
    }
}
