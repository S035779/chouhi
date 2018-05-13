<?php
use Migrations\AbstractSeed;
use Cake\Auth\DefaultPasswordHasher;

/**
 * Users seed.
 */
class UsersSeed extends AbstractSeed
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
      $faker = Faker\Factory::create('ja_JP');

      for($i = 0; $i < 100; $i++){
        $data[] = [
          'name'          => $faker->name,
          'email'         => $faker->email,
          'password'      => $this->_setPassword(123456),
          'role'          => $faker->numberBetween($min = 2, $max = 4),
          'last_login_at' => $datetime,
          'created'       => $datetime,
          'modified'      => $datetime,
        ];
      }
      $table = $this->table('users');
      $table->insert($data)->save();
    }

    protected function _setPassword($value)
    {
      $hasher = new DefaultPasswordHasher();
      return $hasher->hash($value);
    }
}
