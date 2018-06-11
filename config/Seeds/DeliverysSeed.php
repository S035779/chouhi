<?php
use Migrations\AbstractSeed;

/**
 * Deliverys seed.
 */
class DeliverysSeed extends AbstractSeed
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
      // ----- SAL ASIA ----- //
      [
        'method'    => 'SAL'      , 'area'    => 'ASIA'
      , 'price'     => 530        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.1        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'ASIA'
      , 'price'     => 580        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.2        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'ASIA'
      , 'price'     => 630        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.3        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'ASIA'
      , 'price'     => 700        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.4        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'ASIA'
      , 'price'     => 770        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.5        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'ASIA'
      , 'price'     => 840        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.6        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'ASIA'
      , 'price'     => 910        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.7        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'ASIA'
      , 'price'     => 980        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.8        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'ASIA'
      , 'price'     => 1050       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.9        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'ASIA'
      , 'price'     => 1120       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 1.0        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'ASIA'
      , 'price'     => 1340       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 1.25       , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'ASIA'
      , 'price'     => 1560       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 1.5        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'ASIA'
      , 'price'     => 1780       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 1.75       , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'ASIA'
      , 'price'     => 2000       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 2.0        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ]
      // ----- SAL OCEANIA ----- //
    , [
        'method'    => 'SAL'      , 'area'    => 'OCEANIA'
      , 'price'     => 550        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.1        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'OCEANIA'
      , 'price'     => 620        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.2        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'OCEANIA'
      , 'price'     => 690        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.3        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'OCEANIA'
      , 'price'     => 780        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.4        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'OCEANIA'
      , 'price'     => 870        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.5        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'OCEANIA'
      , 'price'     => 960        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.6        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'OCEANIA'
      , 'price'     => 1050       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.7        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'OCEANIA'
      , 'price'     => 1140       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.8        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'OCEANIA'
      , 'price'     => 1230       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.9        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'OCEANIA'
      , 'price'     => 1320       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 1.0        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'OCEANIA'
      , 'price'     => 1590       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 1.25       , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'OCEANIA'
      , 'price'     => 1860       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 1.5        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'OCEANIA'
      , 'price'     => 2130       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 1.75       , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'OCEANIA'
      , 'price'     => 2400       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 2.0        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ]
      // ----- SAL NORTH_AMERICA ----- //
    , [
        'method'    => 'SAL'      , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 550        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.1        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 620        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.2        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 690        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.3        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 780        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.4        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 870        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.5        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 960        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.6        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 1050       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.7        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 1140       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.8        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 1230       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.9        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 1320       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 1.0        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 1590       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 1.25       , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 1860       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 1.5        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 2130       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 1.75       , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 2400       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 2.0        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ]
      // ----- SAL MIDDLE_AMERICA ----- //
    , [
        'method'    => 'SAL'      , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 550        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.1        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 620        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.2        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 690        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.3        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 780        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.4        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 870        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.5        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 960        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.6        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 1050       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.7        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 1140       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.8        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 1230       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.9        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 1320       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 1.0        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 1590       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 1.25       , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 1860       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 1.5        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 2130       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 1.75       , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 2400       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 2.0        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ]
      // ----- SAL MIDDLE_EAST ----- //
    , [
        'method'    => 'SAL'      , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 550        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.1        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 620        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.2        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 690        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.3        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 780        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.4        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 870        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.5        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 960        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.6        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 1050       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.7        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 1140       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.8        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 1230       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.9        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 1320       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 1.0        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 1590       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 1.25       , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 1860       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 1.5        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 2130       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 1.75       , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 2400       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 2.0        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ]
      // ----- SAL EUROPE ----- //
    , [
        'method'    => 'SAL'      , 'area'    => 'EUROPE'
      , 'price'     => 550        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.1        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'EUROPE'
      , 'price'     => 620        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.2        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'EUROPE'
      , 'price'     => 690        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.3        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'EUROPE'
      , 'price'     => 780        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.4        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'EUROPE'
      , 'price'     => 870        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.5        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'EUROPE'
      , 'price'     => 960        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.6        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'EUROPE'
      , 'price'     => 1050       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.7        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'EUROPE'
      , 'price'     => 1140       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.8        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'EUROPE'
      , 'price'     => 1230       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.9        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'EUROPE'
      , 'price'     => 1320       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 1.0        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'EUROPE'
      , 'price'     => 1590       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 1.25       , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'EUROPE'
      , 'price'     => 1860       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 1.5        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'EUROPE'
      , 'price'     => 2130       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 1.75       , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'EUROPE'
      , 'price'     => 2400       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 2.0        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ]
      // ----- SAL SOUTH_AMERICA ----- //
    , [
        'method'    => 'SAL'      , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 570        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.1        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 660        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.2        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 750        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.3        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 860        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.4        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 970        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.5        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 1080       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.6        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 1190       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.7        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 1300       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.8        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 1410       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.9        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 1520       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 1.0        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 1840       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 1.25       , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 2160       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 1.5        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 2480       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 1.75       , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 2800       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 2.0        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ]
      // ----- SAL AFRICA ----- //
    , [
        'method'    => 'SAL'      , 'area'    => 'AFRICA'
      , 'price'     => 570        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.1        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'AFRICA'
      , 'price'     => 660        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.2        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'AFRICA'
      , 'price'     => 750        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.3        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'AFRICA'
      , 'price'     => 860        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.4        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'AFRICA'
      , 'price'     => 970        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.5        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'AFRICA'
      , 'price'     => 1080       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.6        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'AFRICA'
      , 'price'     => 1190       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.7        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'AFRICA'
      , 'price'     => 1300       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.8        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'AFRICA'
      , 'price'     => 1410       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.9        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'AFRICA'
      , 'price'     => 1520       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 1.0        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'AFRICA'
      , 'price'     => 1840       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 1.25       , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'AFRICA'
      , 'price'     => 2160       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 1.5        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'AFRICA'
      , 'price'     => 2480       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 1.75       , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'SAL'      , 'area'    => 'AFRICA'
      , 'price'     => 2800       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 2.0        , 'duedate' => 14     , 'created'       => $datetime
      , 'modified'  => $datetime
      ]
      // ----- E_PACKET ASIA ----- //
    , [
        'method'    => 'E_PACKET' , 'area'    => 'ASIA'
      , 'price'     => 530        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.05       , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'ASIA'
      , 'price'     => 580        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.1        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'ASIA'
      , 'price'     => 630        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.15       , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'ASIA'
      , 'price'     => 680        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.2        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'ASIA'
      , 'price'     => 730        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.25       , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'ASIA'
      , 'price'     => 780        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.3        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'ASIA'
      , 'price'     => 880        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.4        , 'duedate' => 6     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'ASIA'
      , 'price'     => 980        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.5        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'ASIA'
      , 'price'     => 1080       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.6        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'ASIA'
      , 'price'     => 1180       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.7        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'ASIA'
      , 'price'     => 1280       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.8        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'ASIA'
      , 'price'     => 1380       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.9        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'ASIA'
      , 'price'     => 1480       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 1.0        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'ASIA'
      , 'price'     => 1700       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 1.25       , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'ASIA'
      , 'price'     => 1920       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 1.5        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'ASIA'
      , 'price'     => 2140       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 1.75       , 'duedate' => 6     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'ASIA'
      , 'price'     => 2360       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 2.0        , 'duedate' => 6     , 'created'       => $datetime
      , 'modified'  => $datetime
      ]
      // ----- E_PACKET OCEANIA ----- //
    , [
        'method'    => 'E_PACKET' , 'area'    => 'OCEANIA'
      , 'price'     => 560        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.05       , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'OCEANIA'
      , 'price'     => 635        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.1        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'OCEANIA'
      , 'price'     => 710        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.15       , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'OCEANIA'
      , 'price'     => 785        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.2        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'OCEANIA'
      , 'price'     => 860        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.25       , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'OCEANIA'
      , 'price'     => 935        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.3        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'OCEANIA'
      , 'price'     => 1085       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.4        , 'duedate' => 6     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'OCEANIA'
      , 'price'     => 1235       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.5        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'OCEANIA'
      , 'price'     => 1385       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.6        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'OCEANIA'
      , 'price'     => 1535       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.7        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'OCEANIA'
      , 'price'     => 1685       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.8        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'OCEANIA'
      , 'price'     => 1835       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.9        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'OCEANIA'
      , 'price'     => 1985       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 1.0        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'OCEANIA'
      , 'price'     => 2250       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 1.25       , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'OCEANIA'
      , 'price'     => 2525       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 1.5        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'OCEANIA'
      , 'price'     => 2795       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 1.75       , 'duedate' => 6     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'OCEANIA'
      , 'price'     => 3065       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 2.0        , 'duedate' => 6     , 'created'       => $datetime
      , 'modified'  => $datetime
      ]
      // ----- E_PACKET NORTH_AMERICA ----- //
    , [
        'method'    => 'E_PACKET' , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 560        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.05       , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 635        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.1        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 710        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.15       , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 785        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.2        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 860        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.25       , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 935        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.3        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 1085       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.4        , 'duedate' => 6     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 1235       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.5        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 1385       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.6        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 1535       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.7        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 1685       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.8        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 1835       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.9        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 1985       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 1.0        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 2250       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 1.25       , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 2525       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 1.5        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 2795       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 1.75       , 'duedate' => 6     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 3065       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 2.0        , 'duedate' => 6     , 'created'       => $datetime
      , 'modified'  => $datetime
      ]
      // ----- E_PACKET MIDDLE_AMERICA ----- //
    , [
        'method'    => 'E_PACKET' , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 560        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.05       , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 635        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.1        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 710        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.15       , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 785        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.2        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 860        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.25       , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 935        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.3        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 1085       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.4        , 'duedate' => 6     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 1235       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.5        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 1385       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.6        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 1535       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.7        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 1685       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.8        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 1835       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.9        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 1985       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 1.0        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 2250       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 1.25       , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 2525       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 1.5        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 2795       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 1.75       , 'duedate' => 6     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 3065       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 2.0        , 'duedate' => 6     , 'created'       => $datetime
      , 'modified'  => $datetime
      ]
      // ----- E_PACKET MIDDLE_EAST ----- //
    , [
        'method'    => 'E_PACKET' , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 560        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.05       , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 635        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.1        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 710        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.15       , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 785        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.2        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 860        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.25       , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 935        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.3        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 1085       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.4        , 'duedate' => 6     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 1235       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.5        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 1385       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.6        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 1535       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.7        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 1685       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.8        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 1835       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.9        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 1985       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 1.0        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 2250       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 1.25       , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 2525       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 1.5        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 2795       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 1.75       , 'duedate' => 6     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 3065       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 2.0        , 'duedate' => 6     , 'created'       => $datetime
      , 'modified'  => $datetime
      ]
      // ----- E_PACKET EUROPE ----- //
    , [
        'method'    => 'E_PACKET' , 'area'    => 'EUROPE'
      , 'price'     => 560        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.05       , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'EUROPE'
      , 'price'     => 635        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.1        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'EUROPE'
      , 'price'     => 710        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.15       , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'EUROPE'
      , 'price'     => 785        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.2        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'EUROPE'
      , 'price'     => 860        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.25       , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'EUROPE'
      , 'price'     => 935        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.3        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'EUROPE'
      , 'price'     => 1085       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.4        , 'duedate' => 6     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'EUROPE'
      , 'price'     => 1235       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.5        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'EUROPE'
      , 'price'     => 1385       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.6        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'EUROPE'
      , 'price'     => 1535       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.7        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'EUROPE'
      , 'price'     => 1685       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.8        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'EUROPE'
      , 'price'     => 1835       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.9        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'EUROPE'
      , 'price'     => 1985       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 1.0        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'EUROPE'
      , 'price'     => 2250       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 1.25       , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'EUROPE'
      , 'price'     => 2525       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 1.5        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'EUROPE'
      , 'price'     => 2795       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 1.75       , 'duedate' => 6     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'EUROPE'
      , 'price'     => 3065       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 2.0        , 'duedate' => 6     , 'created'       => $datetime
      , 'modified'  => $datetime
      ]
      // ----- E_PACKET SOUTH_AMERICA ----- //
    , [
        'method'    => 'E_PACKET' , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 580        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.05       , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 685        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.1        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 790        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.15       , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 895        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.2        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 1000       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.25       , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 1105       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.3        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 1315       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.4        , 'duedate' => 6     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 1525       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.5        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 1735       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.6        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 1945       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.7        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 2155       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.8        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 2365       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.9        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 2575       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 1.0        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 2945       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 1.25       , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 3315       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 1.5        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 3685       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 1.75       , 'duedate' => 6     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 4055       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 2.0        , 'duedate' => 6     , 'created'       => $datetime
      , 'modified'  => $datetime
      ]
      // ----- E_PACKET AFRICA ----- //
    , [
        'method'    => 'E_PACKET' , 'area'    => 'AFRICA'
      , 'price'     => 580        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.05       , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'AFRICA'
      , 'price'     => 685        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.1        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'AFRICA'
      , 'price'     => 790        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.15       , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'AFRICA'
      , 'price'     => 895        , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.2        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'AFRICA'
      , 'price'     => 1000       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.25       , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'AFRICA'
      , 'price'     => 1105       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.3        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'AFRICA'
      , 'price'     => 1315       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.4        , 'duedate' => 6     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'AFRICA'
      , 'price'     => 1525       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.5        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'AFRICA'
      , 'price'     => 1735       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.6        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'AFRICA'
      , 'price'     => 1945       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.7        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'AFRICA'
      , 'price'     => 2155       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.8        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'AFRICA'
      , 'price'     => 2365       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 0.9        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'AFRICA'
      , 'price'     => 2575       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 1.0        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'AFRICA'
      , 'price'     => 2945       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 1.25       , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'AFRICA'
      , 'price'     => 3315       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 1.5        , 'duedate' => 6      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'AFRICA'
      , 'price'     => 3685       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 1.75       , 'duedate' => 6     , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'E_PACKET' , 'area'    => 'AFRICA'
      , 'price'     => 4055       , 'length'  => 600    , 'total_length'  => 900
      , 'weight'    => 2.0        , 'duedate' => 6     , 'created'       => $datetime
      , 'modified'  => $datetime
      ]
      // ----- EMS ASIA ----- //
    , [
        'method'    => 'EMS'      , 'area'    => 'ASIA'
      , 'price'     => 1400       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 0.5        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'ASIA'
      , 'price'     => 1540       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 0.6        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'ASIA'
      , 'price'     => 1680       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 0.7        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'ASIA'
      , 'price'     => 1820       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 0.8        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'ASIA'
      , 'price'     => 1960       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 0.9        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'ASIA'
      , 'price'     => 2100       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 1.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'ASIA'
      , 'price'     => 2400       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 1.25       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'ASIA'
      , 'price'     => 2700       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 1.5        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'ASIA'
      , 'price'     => 3000       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 1.75       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'ASIA'
      , 'price'     => 3300       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 2.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'ASIA'
      , 'price'     => 3800       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 2.5        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'ASIA'
      , 'price'     => 4300       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 3.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'ASIA'
      , 'price'     => 4800       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 3.5        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'ASIA'
      , 'price'     => 5300       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 4.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'ASIA'
      , 'price'     => 5800       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 4.5        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'ASIA'
      , 'price'     => 6300       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 5.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'ASIA'
      , 'price'     => 6800       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 5.5        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'ASIA'
      , 'price'     => 7300       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 6.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'ASIA'
      , 'price'     => 8100       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 7.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'ASIA'
      , 'price'     => 8900       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 8.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'ASIA'
      , 'price'     => 9700       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 9.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'ASIA'
      , 'price'     => 10500      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 10.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'ASIA'
      , 'price'     => 11300      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 11.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'ASIA'
      , 'price'     => 12100      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 12.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'ASIA'
      , 'price'     => 12900      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 13.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'ASIA'
      , 'price'     => 13700      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 14.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'ASIA'
      , 'price'     => 14500      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 15.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'ASIA'
      , 'price'     => 15300      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 16.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'ASIA'
      , 'price'     => 16100      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 17.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'ASIA'
      , 'price'     => 16900      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 18.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'ASIA'
      , 'price'     => 17700      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 19.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'ASIA'
      , 'price'     => 18500      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 20.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'ASIA'
      , 'price'     => 19300      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 21.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'ASIA'
      , 'price'     => 20100      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 22.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'ASIA'
      , 'price'     => 20900      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 23.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'ASIA'
      , 'price'     => 21700      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 24.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'ASIA'
      , 'price'     => 22500      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 25.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'ASIA'
      , 'price'     => 23300      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 26.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'ASIA'
      , 'price'     => 24100      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 27.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'ASIA'
      , 'price'     => 24900      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 28.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'ASIA'
      , 'price'     => 25700      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 29.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'ASIA'
      , 'price'     => 26500      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 30.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ]
      // ----- EMS OCEANIA ----- //
    , [
        'method'    => 'EMS'      , 'area'    => 'OCEANIA'
      , 'price'     => 2000       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 0.5        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'OCEANIA'
      , 'price'     => 2180       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 0.6        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'OCEANIA'
      , 'price'     => 2360       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 0.7        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'OCEANIA'
      , 'price'     => 2540       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 0.8        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'OCEANIA'
      , 'price'     => 2720       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 0.9        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'OCEANIA'
      , 'price'     => 2900       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 1.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'OCEANIA'
      , 'price'     => 3300       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 1.25       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'OCEANIA'
      , 'price'     => 3700       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 1.5        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'OCEANIA'
      , 'price'     => 4100       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 1.75       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'OCEANIA'
      , 'price'     => 4500       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 2.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'OCEANIA'
      , 'price'     => 5200       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 2.5        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'OCEANIA'
      , 'price'     => 5900       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 3.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'OCEANIA'
      , 'price'     => 6600       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 3.5        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'OCEANIA'
      , 'price'     => 7300       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 4.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'OCEANIA'
      , 'price'     => 8000       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 4.5        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'OCEANIA'
      , 'price'     => 8700       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 5.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'OCEANIA'
      , 'price'     => 9400       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 5.5        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'OCEANIA'
      , 'price'     => 10100      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 6.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'OCEANIA'
      , 'price'     => 11200      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 7.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'OCEANIA'
      , 'price'     => 12300      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 8.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'OCEANIA'
      , 'price'     => 13400      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 9.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'OCEANIA'
      , 'price'     => 14500      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 10.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'OCEANIA'
      , 'price'     => 15600      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 11.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'OCEANIA'
      , 'price'     => 16700      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 12.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'OCEANIA'
      , 'price'     => 17800      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 13.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'OCEANIA'
      , 'price'     => 18900      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 14.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'OCEANIA'
      , 'price'     => 20000      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 15.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'OCEANIA'
      , 'price'     => 21100      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 16.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'OCEANIA'
      , 'price'     => 22200      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 17.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'OCEANIA'
      , 'price'     => 23300      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 18.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'OCEANIA'
      , 'price'     => 24400      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 19.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'OCEANIA'
      , 'price'     => 25500      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 20.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'OCEANIA'
      , 'price'     => 26600      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 21.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'OCEANIA'
      , 'price'     => 27700      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 22.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'OCEANIA'
      , 'price'     => 28800      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 23.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'OCEANIA'
      , 'price'     => 29900      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 24.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'OCEANIA'
      , 'price'     => 31000      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 25.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'OCEANIA'
      , 'price'     => 32100      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 26.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'OCEANIA'
      , 'price'     => 33200      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 27.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'OCEANIA'
      , 'price'     => 34300      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 28.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'OCEANIA'
      , 'price'     => 35400      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 29.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'OCEANIA'
      , 'price'     => 36500      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 30.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ]
      // ----- EMS NORTH_AMERICA ----- //
    , [
        'method'    => 'EMS'      , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 2000       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 0.5        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 2180       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 0.6        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 2360       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 0.7        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 2540       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 0.8        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 2720       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 0.9        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 2900       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 1.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 3300       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 1.25       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 3700       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 1.5        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 4100       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 1.75       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 4500       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 2.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 5200       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 2.5        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 5900       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 3.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 6600       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 3.5        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 7300       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 4.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 8000       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 4.5        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 8700       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 5.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 9400       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 5.5        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 10100      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 6.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 11200      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 7.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 12300      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 8.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 13400      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 9.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 14500      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 10.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 15600      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 11.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 16700      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 12.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 17800      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 13.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 18900      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 14.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 20000      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 15.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 21100      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 16.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 22200      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 17.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 23300      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 18.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 24400      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 19.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 25500      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 20.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 26600      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 21.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 27700      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 22.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 28800      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 23.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 29900      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 24.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 31000      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 25.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 32100      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 26.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 33200      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 27.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 34300      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 28.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 35400      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 29.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'NORTH_AMERICA'
      , 'price'     => 36500      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 30.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ]
      // ----- EMS MIDDLE_AMERICA ----- //
    , [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 2000       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 0.5        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 2180       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 0.6        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 2360       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 0.7        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 2540       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 0.8        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 2720       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 0.9        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 2900       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 1.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 3300       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 1.25       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 3700       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 1.5        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 4100       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 1.75       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 4500       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 2.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 5200       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 2.5        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 5900       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 3.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 6600       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 3.5        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 7300       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 4.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 8000       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 4.5        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 8700       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 5.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 9400       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 5.5        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 10100      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 6.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 11200      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 7.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 12300      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 8.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 13400      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 9.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 14500      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 10.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 15600      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 11.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 16700      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 12.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 17800      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 13.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 18900      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 14.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 20000      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 15.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 21100      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 16.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 22200      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 17.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 23300      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 18.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 24400      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 19.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 25500      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 20.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 26600      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 21.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 27700      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 22.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 28800      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 23.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 29900      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 24.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 31000      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 25.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 32100      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 26.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 33200      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 27.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 34300      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 28.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 35400      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 29.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_AMERICA'
      , 'price'     => 36500      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 30.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ]
      // ----- EMS MIDDLE_EAST ----- //
    , [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 2000       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 0.5        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 2180       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 0.6        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 2360       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 0.7        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 2540       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 0.8        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 2720       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 0.9        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 2900       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 1.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 3300       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 1.25       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 3700       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 1.5        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 4100       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 1.75       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 4500       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 2.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 5200       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 2.5        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 5900       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 3.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 6600       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 3.5        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 7300       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 4.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 8000       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 4.5        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 8700       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 5.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 9400       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 5.5        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 10100      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 6.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 11200      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 7.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 12300      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 8.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 13400      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 9.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 14500      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 10.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 15600      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 11.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 16700      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 12.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 17800      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 13.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 18900      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 14.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 20000      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 15.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 21100      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 16.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 22200      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 17.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 23300      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 18.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 24400      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 19.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 25500      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 20.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 26600      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 21.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 27700      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 22.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 28800      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 23.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 29900      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 24.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 31000      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 25.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 32100      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 26.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 33200      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 27.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 34300      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 28.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 35400      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 29.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'MIDDLE_EAST'
      , 'price'     => 36500      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 30.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ]
      // ----- EMS EUROPE ----- //
    , [
        'method'    => 'EMS'      , 'area'    => 'EUROPE'
      , 'price'     => 2200       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 0.5        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'EUROPE'
      , 'price'     => 2400       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 0.6        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'EUROPE'
      , 'price'     => 2600       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 0.7        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'EUROPE'
      , 'price'     => 2800       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 0.8        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'EUROPE'
      , 'price'     => 3000       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 0.9        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'EUROPE'
      , 'price'     => 3200       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 1.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'EUROPE'
      , 'price'     => 3650       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 1.25       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'EUROPE'
      , 'price'     => 4100       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 1.5        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'EUROPE'
      , 'price'     => 4550       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 1.75       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'EUROPE'
      , 'price'     => 5000       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 2.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'EUROPE'
      , 'price'     => 5800       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 2.5        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'EUROPE'
      , 'price'     => 6600       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 3.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'EUROPE'
      , 'price'     => 7400       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 3.5        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'EUROPE'
      , 'price'     => 8200       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 4.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'EUROPE'
      , 'price'     => 9000       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 4.5        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'EUROPE'
      , 'price'     => 9800       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 5.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'EUROPE'
      , 'price'     => 10600      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 5.5        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'EUROPE'
      , 'price'     => 11400      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 6.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'EUROPE'
      , 'price'     => 12700      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 7.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'EUROPE'
      , 'price'     => 14000      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 8.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'EUROPE'
      , 'price'     => 15300      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 9.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'EUROPE'
      , 'price'     => 16600      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 10.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'EUROPE'
      , 'price'     => 17900      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 11.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'EUROPE'
      , 'price'     => 19200      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 12.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'EUROPE'
      , 'price'     => 20500      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 13.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'EUROPE'
      , 'price'     => 21800      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 14.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'EUROPE'
      , 'price'     => 23100      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 15.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'EUROPE'
      , 'price'     => 24400      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 16.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'EUROPE'
      , 'price'     => 25700      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 17.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'EUROPE'
      , 'price'     => 27000      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 18.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'EUROPE'
      , 'price'     => 28300      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 19.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'EUROPE'
      , 'price'     => 29600      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 20.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'EUROPE'
      , 'price'     => 30900      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 21.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'EUROPE'
      , 'price'     => 32200      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 22.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'EUROPE'
      , 'price'     => 33500      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 23.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'EUROPE'
      , 'price'     => 34800      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 24.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'EUROPE'
      , 'price'     => 36100      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 25.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'EUROPE'
      , 'price'     => 37400      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 26.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'EUROPE'
      , 'price'     => 38700      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 27.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'EUROPE'
      , 'price'     => 40000      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 28.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'EUROPE'
      , 'price'     => 41300      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 29.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'EUROPE'
      , 'price'     => 42600      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 30.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ]
      // ----- EMS SOUTH_AMERICA ----- //
    , [
        'method'    => 'EMS'      , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 2400       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 0.5        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 2740       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 0.6        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 3080       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 0.7        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 3420       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 0.8        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 3760       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 0.9        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 4100       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 1.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 4900       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 1.25       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 5700       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 1.5        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 6500       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 1.75       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 7300       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 2.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 8800       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 2.5        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 10300      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 3.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 11800      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 3.5        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 13300      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 4.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 14800      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 4.5        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 16300      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 5.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 17800      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 5.5        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 19300      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 6.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 21400      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 7.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 23500      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 8.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 25600      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 9.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 27700      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 10.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 29800      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 11.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 31900      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 12.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 34000      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 13.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 36100      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 14.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 38200      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 15.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 40300      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 16.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 42400      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 17.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 44500      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 18.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 46600      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 19.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 48700      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 20.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 50800      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 21.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 52900      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 22.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 55000      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 23.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 57100      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 24.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 59200      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 25.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 61300      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 26.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 63400      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 27.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 65500      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 28.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 67600      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 29.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'SOUTH_AMERICA'
      , 'price'     => 69700      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 30.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ]
      // ----- EMS AFRICA ----- //
    , [
        'method'    => 'EMS'      , 'area'    => 'AFRICA'
      , 'price'     => 2400       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 0.5        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'AFRICA'
      , 'price'     => 2740       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 0.6        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'AFRICA'
      , 'price'     => 3080       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 0.7        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'AFRICA'
      , 'price'     => 3420       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 0.8        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'AFRICA'
      , 'price'     => 3760       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 0.9        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'AFRICA'
      , 'price'     => 4100       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 1.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'AFRICA'
      , 'price'     => 4900       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 1.25       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'AFRICA'
      , 'price'     => 5700       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 1.5        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'AFRICA'
      , 'price'     => 6500       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 1.75       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'AFRICA'
      , 'price'     => 7300       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 2.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'AFRICA'
      , 'price'     => 8800       , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 2.5        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'AFRICA'
      , 'price'     => 10300      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 3.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'AFRICA'
      , 'price'     => 11800      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 3.5        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'AFRICA'
      , 'price'     => 13300      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 4.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'AFRICA'
      , 'price'     => 14800      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 4.5        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'AFRICA'
      , 'price'     => 16300      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 5.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'AFRICA'
      , 'price'     => 17800      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 5.5        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'AFRICA'
      , 'price'     => 19300      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 6.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'AFRICA'
      , 'price'     => 21400      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 7.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'AFRICA'
      , 'price'     => 23500      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 8.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'AFRICA'
      , 'price'     => 25600      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 9.0        , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'AFRICA'
      , 'price'     => 27700      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 10.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'AFRICA'
      , 'price'     => 29800      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 11.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'AFRICA'
      , 'price'     => 31900      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 12.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'AFRICA'
      , 'price'     => 34000      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 13.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'AFRICA'
      , 'price'     => 36100      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 14.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'AFRICA'
      , 'price'     => 38200      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 15.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'AFRICA'
      , 'price'     => 40300      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 16.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'AFRICA'
      , 'price'     => 42400      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 17.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'AFRICA'
      , 'price'     => 44500      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 18.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'AFRICA'
      , 'price'     => 46600      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 19.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'AFRICA'
      , 'price'     => 48700      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 20.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'AFRICA'
      , 'price'     => 50800      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 21.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'AFRICA'
      , 'price'     => 52900      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 22.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'AFRICA'
      , 'price'     => 55000      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 23.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'AFRICA'
      , 'price'     => 57100      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 24.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'AFRICA'
      , 'price'     => 59200      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 25.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'AFRICA'
      , 'price'     => 61300      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 26.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'AFRICA'
      , 'price'     => 63400      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 27.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'AFRICA'
      , 'price'     => 65500      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 28.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'AFRICA'
      , 'price'     => 67600      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 29.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ], [
        'method'    => 'EMS'      , 'area'    => 'AFRICA'
      , 'price'     => 69700      , 'length'  => 1500   , 'total_length'  => 3000
      , 'weight'    => 30.0       , 'duedate' => 4      , 'created'       => $datetime
      , 'modified'  => $datetime
      ]
    ];

    $table = $this->table('deliverys');
    $table->insert($data)->save();
  }
}
