<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Token Entity
 *
 * @property int $id
 * @property string $email
 * @property string $access_key
 * @property string $secret_key
 * @property string $seller_id
 * @property bool $suspended
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Seller $seller
 */
class Token extends Entity
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
        'access_key' => true,
        'secret_key' => true,
        'seller_id' => true,
        'suspended' => true,
        'created' => true,
        'modified' => true,
        'pa_access_key' => true,
        'pa_secret_key' => true,
        'pa_associate_tag' => true,
        'seller' => true
    ];
}
