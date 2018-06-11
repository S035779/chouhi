<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Ship Entity
 *
 * @property int $id
 * @property bool $is_fulfillment_selling
 * @property int $pending_quantity_rate
 * @property int $pending_quantity
 * @property float $price_criteria_1
 * @property float $price_criteria_2
 * @property float $price_criteria_3
 * @property float $price_criteria_4
 * @property int $sales_rate_1
 * @property int $sales_rate_2
 * @property int $sales_rate_3
 * @property int $sales_rate_4
 * @property int $sales_rate_5
 * @property float $sales_price_1
 * @property float $sales_price_2
 * @property float $sales_price_3
 * @property float $sales_price_4
 * @property float $sales_price_5
 * @property int $delete_rate_1
 * @property int $delete_rate_2
 * @property int $delete_rate_3
 * @property int $delete_rate_4
 * @property int $delete_rate_5
 * @property float $delete_price_1
 * @property float $delete_price_2
 * @property float $delete_price_3
 * @property float $delete_price_4
 * @property float $delete_price_5
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class Ship extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'pending_quantity_rate' => true,
        'pending_quantity' => true,
        'price_criteria_1' => true,
        'price_criteria_2' => true,
        'price_criteria_3' => true,
        'price_criteria_4' => true,
        'sales_rate_1' => true,
        'sales_rate_2' => true,
        'sales_rate_3' => true,
        'sales_rate_4' => true,
        'sales_rate_5' => true,
        'sales_price_1' => true,
        'sales_price_2' => true,
        'sales_price_3' => true,
        'sales_price_4' => true,
        'sales_price_5' => true,
        'sales_price_5' => true,
        'jpy_price' => true,
        'aud_price' => true,
        'usd_price' => true,
        'jp_length' => true,
        'au_length' => true,
        'us_length' => true,
        'jp_weight' => true,
        'au_weight' => true,
        'us_weight' => true,
        'created' => true,
        'modified' => true
    ];
}
