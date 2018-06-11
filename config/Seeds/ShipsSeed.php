<?php
use Migrations\AbstractSeed;

/**
 * Ships seed.
 */
class ShipsSeed extends AbstractSeed
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
    $data = [
      [
        'pending_quantity_rate' => 100
      , 'pending_quantity'      => 10
      , 'price_criteria_1'      => 1000
      , 'price_criteria_2'      => 5000
      , 'price_criteria_3'      => 10000
      , 'price_criteria_4'      => 30000
      , 'sales_rate_1'          => 140
      , 'sales_rate_2'          => 140
      , 'sales_rate_3'          => 140
      , 'sales_rate_4'          => 140
      , 'sales_rate_5'          => 140
      , 'sales_price_1'         => 1000
      , 'sales_price_2'         => 1000
      , 'sales_price_3'         => 1000
      , 'sales_price_4'         => 1000
      , 'sales_price_5'         => 1000
      , 'jpy_price'             => 1
      , 'aud_price'             => 83.7337
      , 'usd_price'             => 110.01
      , 'jp_length'             => 1
      , 'jp_weight'             => 1.0
      , 'au_length'             => 25.4
      , 'au_weight'             => 0.45359237
      , 'us_length'             => 25.4
      , 'us_weight'             => 0.45359237
      , 'created'               => $datetime
      , 'modified'              => $datetime
      ]
    ];

    $table = $this->table('ships');
    $table->insert($data)->save();
  }
}
