<?php
use Migrations\AbstractMigration;

class ChangeAgeToSamples extends AbstractMigration
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
      $table->changeColumn('age', 'integer', [
        'limit' => 2,
      ]);
      $table->update();
    }
    public function down()
    {
      $table = $this->table('samples');
      $table->changeColumn('age', 'integer', [
        'limit' => 3,
      ]);
      $table->update();
    }
}
