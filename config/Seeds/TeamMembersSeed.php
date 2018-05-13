<?php
use Migrations\AbstractSeed;
use Cake\Auth\DefaultPasswordHasher;

/**
 * TeamMembers seed.
 */
class TeamMembersSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
      $datetime = date('Y-m-d H:i:s');
      $data = [[
        'username' => 'test01'
      , 'email' => 'test01@example.com'
      , 'password' => $this->_setPassword(123456)
      , 'created' => $datetime
      ], [
        'username' => 'test02'
      , 'email' => 'test02@example.com'
      , 'password' => $this->_setPassword(123456)
      , 'created' => $datetime
      ], [
        'username' => 'test03'
      , 'email' => 'test03@example.com'
      , 'password' => $this->_setPassword(123456)
      , 'created' => $datetime
      ], [
        'username' => 'test04'
      , 'email' => 'test04@example.com'
      , 'password' => $this->_setPassword(123456)
      , 'created' => $datetime
      ], [
        'username' => 'test05'
      , 'email' => 'test05@example.com'
      , 'password' => $this->_setPassword(123456)
      , 'created' => $datetime
      ]];

      $table = $this->table('team_members');
      $table->insert($data)->save();
    }

    protected function _setPassword($value)
    {
      $hasher = new DefaultPasswordHasher();
      return $hasher->hash($value);
    }
}
