<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Item Entity
 *
 * @property int $id
 * @property string $asin
 * @property string $title
 * @property bool $is_eligible_prime
 * @property bool $is_eligible_for_supersaver_shipping
 * @property int $item_height
 * @property int $item_length
 * @property int $item_weight
 * @property int $item_width
 * @property int $package_height
 * @property int $package_length
 * @property int $package_weight
 * @property int $package_width
 * @property int $list_price
 * @property string $list_price_currency
 * @property string $lowest_price
 * @property string $lowest_price_currency
 * @property int $lowest_used_price
 * @property string $lowest_used_price_currency
 * @property int $lowest_collectible_price
 * @property string $lowest_collectible_price_currency
 * @property int $offer_listing_price
 * @property string $offer_listing_price_currency
 * @property int $offer_listing_saved_price
 * @property string $offer_listing_saved_price_currency
 * @property int $sales_ranking
 * @property string $ean
 * @property \Cake\I18n\FrozenTime $release_date_at
 * @property \Cake\I18n\FrozenTime $publication_date_at
 * @property \Cake\I18n\FrozenTime $original_release_date_at
 * @property string $condition_status
 * @property int $total_reviews
 * @property int $average_rating
 * @property int $total_votes
 * @property string $product_group
 * @property int $quantity
 * @property int $quantity_allocated
 * @property bool $status
 * @property string $marketplace
 * @property string $detail_page_url
 * @property string $small_image_url
 * @property string $medium_image_url
 * @property string $large_image_url
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $total_new
 * @property int $total_used
 * @property int $total_collectible
 * @property int $total_refurbished
 * @property string $customer_reviews_url
 */
class Item extends Entity
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
        'title' => true,
        'is_eligible_prime' => true,
        'is_eligible_for_supersaver_shipping' => true,
        'item_height' => true,
        'item_length' => true,
        'item_weight' => true,
        'item_width' => true,
        'package_height' => true,
        'package_length' => true,
        'package_weight' => true,
        'package_width' => true,
        'list_price' => true,
        'list_price_currency' => true,
        'lowest_price' => true,
        'lowest_price_currency' => true,
        'lowest_used_price' => true,
        'lowest_used_price_currency' => true,
        'lowest_collectible_price' => true,
        'lowest_collectible_price_currency' => true,
        'offer_listing_price' => true,
        'offer_listing_price_currency' => true,
        'offer_listing_saved_price' => true,
        'offer_listing_saved_price_currency' => true,
        'sales_ranking' => true,
        'ean' => true,
        'release_date_at' => true,
        'publication_date_at' => true,
        'original_release_date_at' => true,
        'condition_status' => true,
        'total_reviews' => true,
        'average_rating' => true,
        'total_votes' => true,
        'product_group' => true,
        'quantity' => true,
        'quantity_allocated' => true,
        'status' => true,
        'marketplace' => true,
        'detail_page_url' => true,
        'small_image_url' => true,
        'medium_image_url' => true,
        'large_image_url' => true,
        'created' => true,
        'modified' => true,
        'total_new' => true,
        'total_used' => true,
        'total_collectible' => true,
        'total_refurbished' => true,
        'customer_reviews_url' => true
    ];
}
