<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Merchant Entity
 *
 * @property int $id
 * @property string $item_name
 * @property string $product_identifier
 * @property int $product_id_type
 * @property int $price
 * @property int $minimum_seller_allow_price
 * @property int $maximum_seller_allow_price
 * @property int $item_condition
 * @property int $quantity
 * @property string $add_delete
 * @property string $will_ship_internationally
 * @property string $expedited_shipping
 * @property string $standard_plus
 * @property string $item_note
 * @property string $fullfillment_channel
 * @property string $product_tax_code
 * @property int $leadtime_to_ship
 * @property string $seller_sku
 * @property string $currency
 * @property string $shipping_option_1
 * @property string $shipping_option_2
 * @property string $shipping_option_3
 * @property string $shipping_option_4
 * @property string $shipping_option_5
 * @property string $shipping_option_6
 * @property int $shipping_amount_1
 * @property int $shipping_amount_2
 * @property int $shipping_amount_3
 * @property int $shipping_amount_4
 * @property int $shipping_amount_5
 * @property int $shipping_amount_6
 * @property string $type_1
 * @property string $type_2
 * @property string $type_3
 * @property string $type_4
 * @property string $type_5
 * @property string $type_6
 * @property bool $is_shipping_restricted_1
 * @property bool $is_shipping_restricted_2
 * @property bool $is_shipping_restricted_3
 * @property bool $is_shipping_restricted_4
 * @property bool $is_shipping_restricted_5
 * @property bool $is_shipping_restricted_6
 * @property string $update_delete
 * @property string $item_description
 * @property string $listing_identifier
 * @property \Cake\I18n\FrozenTime $open_date_at
 * @property string $image_url
 * @property string $item_is_marketplace
 * @property int $zshop_shipping_fee
 * @property string $zshop_category1
 * @property string $zshop_browse_path
 * @property string $zshop_storefront_feature
 * @property string $asin1
 * @property string $asin2
 * @property string $asin3
 * @property string $zshop_boldface
 * @property string $bid_for_featured_placement
 * @property int $pending_quantity
 * @property string $merchant_shipping_group
 * @property int $point
 * @property string $seller_identifier
 * @property string $marketplace
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class Merchant extends Entity
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
        'item_name' => true,
        'product_identifier' => true,
        'product_id_type' => true,
        'price' => true,
        'minimum_seller_allow_price' => true,
        'maximum_seller_allow_price' => true,
        'item_condition' => true,
        'quantity' => true,
        'add_delete' => true,
        'will_ship_internationally' => true,
        'expedited_shipping' => true,
        'standard_plus' => true,
        'item_note' => true,
        'fullfillment_channel' => true,
        'product_tax_code' => true,
        'leadtime_to_ship' => true,
        'seller_sku' => true,
        'currency' => true,
        'shipping_option_1' => true,
        'shipping_option_2' => true,
        'shipping_option_3' => true,
        'shipping_option_4' => true,
        'shipping_option_5' => true,
        'shipping_option_6' => true,
        'shipping_amount_1' => true,
        'shipping_amount_2' => true,
        'shipping_amount_3' => true,
        'shipping_amount_4' => true,
        'shipping_amount_5' => true,
        'shipping_amount_6' => true,
        'type_1' => true,
        'type_2' => true,
        'type_3' => true,
        'type_4' => true,
        'type_5' => true,
        'type_6' => true,
        'is_shipping_restricted_1' => true,
        'is_shipping_restricted_2' => true,
        'is_shipping_restricted_3' => true,
        'is_shipping_restricted_4' => true,
        'is_shipping_restricted_5' => true,
        'is_shipping_restricted_6' => true,
        'update_delete' => true,
        'item_description' => true,
        'listing_identifier' => true,
        'open_date_at' => true,
        'image_url' => true,
        'item_is_marketplace' => true,
        'zshop_shipping_fee' => true,
        'zshop_category1' => true,
        'zshop_browse_path' => true,
        'zshop_storefront_feature' => true,
        'asin1' => true,
        'asin2' => true,
        'asin3' => true,
        'zshop_boldface' => true,
        'bid_for_featured_placement' => true,
        'pending_quantity' => true,
        'merchant_shipping_group' => true,
        'point' => true,
        'seller_identifier' => true,
        'marketplace' => true,
        'created' => true,
        'modified' => true
    ];
}
