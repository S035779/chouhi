<?php
use Migrations\AbstractMigration;

class ChangePaToTokens extends AbstractMigration
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
      $table = $this->table('tokens');
      $table->changeColumn('pa_access_key', 'string', [
        'default' => null
      , 'limit' => 255
      , 'null' => true
      ]);
      $table->changeColumn('pa_secret_key', 'string', [
        'default' => null
      , 'limit' => 255
      , 'null' => true
      ]);
      $table->changeColumn('pa_associate_tag', 'string', [
        'default' => null
      , 'limit' => 255
      , 'null' => true
      ]);
      $table->update();
    }

    public function down()
    {
      $table = $this->table('tokens');
      $table->changeColumn('pa_access_key', 'string', [
        'default' => null
      , 'limit' => 255
      , 'null' => false
      ]);
      $table->changeColumn('pa_secret_key', 'string', [
        'default' => null
      , 'limit' => 255
      , 'null' => false
      ]);
      $table->changeColumn('pa_associate_tag', 'string', [
        'default' => null
      , 'limit' => 255
      , 'null' => false
      ]);
      $table->update();
    }
}
