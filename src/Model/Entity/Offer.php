<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Offer Entity
 *
 * @property int $id
 * @property string $asin
 * @property string $availability
 * @property int $average_feedback_rating
 * @property string $condition_status
 * @property string $condition_status_note
 * @property string $country
 * @property string $exchange_identifier
 * @property bool $is_eligible_for_supersaver_shipping
 * @property string $offer_listing_identifier
 * @property int $price
 * @property string $price_currency
 * @property string $state
 * @property string $sub_condition_status
 * @property int $total_feedback
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class Offer extends Entity
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
        'asin' => true,
        'availability' => true,
        'average_feedback_rating' => true,
        'condition_status' => true,
        'condition_status_note' => true,
        'country' => true,
        'exchange_identifier' => true,
        'is_eligible_for_supersaver_shipping' => true,
        'offer_listing_identifier' => true,
        'price' => true,
        'price_currency' => true,
        'state' => true,
        'sub_condition_status' => true,
        'total_feedback' => true,
        'seller_identifier' => true,
        'item_id' => true,
        'created' => true,
        'modified' => true
    ];
}
