<?php
use Migrations\AbstractMigration;

class AddPaAccessKeyToTokens extends AbstractMigration
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
        $table->addColumn('pa_access_key', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('pa_secret_key', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('pa_associate_tag', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->update();
    }

    public function down()
    {
      $table = $this->table('tokens');
      $table->removeColumn('pa_access_key');
      $table->removeColumn('pa_secret_key');
      $table->removeColumn('pa_associate_tag');
      $table->update();
    }
}
