<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Delivery Entity
 *
 * @property int $id
 * @property string $method
 * @property string $area
 * @property float $price
 * @property int $length
 * @property int $total_length
 * @property float $weight
 * @property int $duedate
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class Delivery extends Entity
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
        'method' => true,
        'area' => true,
        'price' => true,
        'length' => true,
        'total_length' => true,
        'weight' => true,
        'duedate' => true,
        'created' => true,
        'modified' => true
    ];
}
