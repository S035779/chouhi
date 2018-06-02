<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Merchant $merchant
 */
?>
<!-- Main menu -->
<nav class="col-md-2 d-none d-md-block bg-light sidebar">
  <div class="sidebar-sticky">

    <ul class="nav flex-column">
      <li>
        <?= $this->Html->link(
          $this->Html->tag('span', '', ['data-feather' => 'file'])
          . __(' セラー出品編集 ')
        , ['controller' => 'Merchants', 'action' => 'edit', $merchant->id]
        , ['escape' => false, 'class' => 'nav-link']
        ) ?> 
      </li>
      <li>
        <?= $this->Form->postLink(
          $this->Html->tag('span', '', ['data-feather' => 'file'])
          . __(' セラー出品削除 ')
        , ['controller' => 'Merchants', 'action' => 'delete', $merchant->id]
        , ['confirm' => __('Are you sure you want to delete # {0}?', $merchant->id)
          , 'escape' => false, 'class' => 'nav-link']
        ) ?> 
      </li>
      <li>
        <?= $this->Html->link(
          $this->Html->tag('span', '', ['data-feather' => 'home'])
          . __(' セラー出品一覧 ') .
          $this->Html->tag('span', '(current)', ['class' => 'sr-only'])
        , ['controller' => 'Merchants', 'action' => 'index']
        , ['escape' => false, 'class' => 'nav-link active']
        ) ?> 
      </li>
      <li>
        <?= $this->Html->link(
          $this->Html->tag('span', '', ['data-feather' => 'file'])
          . __(' セラー出品追加 ')
        , ['controller' => 'Merchants', 'action' => 'add']
        , ['escape' => false, 'class' => 'nav-link']
        ) ?> 
      </li>
    </ul>

  </div>
</nav>

<!-- Main contents -->
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><?= __('セラー出品管理マスタ') ?></h1>
  </div>

  <div class="container">
    <div class="row">

      <div class="col-md-8 order-md-1">
        <h3><?= h($merchant->id) ?></h3>
        <table class="table table-hover">
          <tr>
            <th scope="row"><?= __('Item Name') ?></th>
            <td><?= h($merchant->item_name) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Product Identifier') ?></th>
            <td><?= h($merchant->product_identifier) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Add Delete') ?></th>
            <td><?= h($merchant->add_delete) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Will Ship Internationally') ?></th>
            <td><?= h($merchant->will_ship_internationally) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Expedited Shipping') ?></th>
            <td><?= h($merchant->expedited_shipping) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Standard Plus') ?></th>
            <td><?= h($merchant->standard_plus) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Item Note') ?></th>
            <td><?= h($merchant->item_note) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Fullfillment Channel') ?></th>
            <td><?= h($merchant->fullfillment_channel) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Product Tax Code') ?></th>
            <td><?= h($merchant->product_tax_code) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Seller Sku') ?></th>
            <td><?= h($merchant->seller_sku) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Currency') ?></th>
            <td><?= h($merchant->currency) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Shipping Option 1') ?></th>
            <td><?= h($merchant->shipping_option_1) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Shipping Option 2') ?></th>
            <td><?= h($merchant->shipping_option_2) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Shipping Option 3') ?></th>
            <td><?= h($merchant->shipping_option_3) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Shipping Option 4') ?></th>
            <td><?= h($merchant->shipping_option_4) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Shipping Option 5') ?></th>
            <td><?= h($merchant->shipping_option_5) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Shipping Option 6') ?></th>
            <td><?= h($merchant->shipping_option_6) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Type 1') ?></th>
            <td><?= h($merchant->type_1) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Type 2') ?></th>
            <td><?= h($merchant->type_2) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Type 3') ?></th>
            <td><?= h($merchant->type_3) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Type 4') ?></th>
            <td><?= h($merchant->type_4) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Type 5') ?></th>
            <td><?= h($merchant->type_5) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Type 6') ?></th>
            <td><?= h($merchant->type_6) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Update Delete') ?></th>
            <td><?= h($merchant->update_delete) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Item Description') ?></th>
            <td><?= h($merchant->item_description) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Listing Identifier') ?></th>
            <td><?= h($merchant->listing_identifier) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Image Url') ?></th>
            <td><?= h($merchant->image_url) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Item Is Marketplace') ?></th>
            <td><?= h($merchant->item_is_marketplace) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Zshop Category1') ?></th>
            <td><?= h($merchant->zshop_category1) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Zshop Browse Path') ?></th>
            <td><?= h($merchant->zshop_browse_path) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Zshop Storefront Feature') ?></th>
            <td><?= h($merchant->zshop_storefront_feature) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Asin1') ?></th>
            <td><?= h($merchant->asin1) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Asin2') ?></th>
            <td><?= h($merchant->asin2) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Asin3') ?></th>
            <td><?= h($merchant->asin3) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Zshop Boldface') ?></th>
            <td><?= h($merchant->zshop_boldface) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Bid For Featured Placement') ?></th>
            <td><?= h($merchant->bid_for_featured_placement) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Merchant Shipping Group') ?></th>
            <td><?= h($merchant->merchant_shipping_group) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Seller Identifier') ?></th>
            <td><?= h($merchant->seller_identifier) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Marketplace') ?></th>
            <td><?= h($merchant->marketplace) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($merchant->id) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Product Id Type') ?></th>
            <td><?= $this->Number->format($merchant->product_id_type) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Price') ?></th>
            <td><?= $this->Number->format($merchant->price) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Minimum Seller Allow Price') ?></th>
            <td><?= $this->Number->format($merchant->minimum_seller_allow_price) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Maximum Seller Allow Price') ?></th>
            <td><?= $this->Number->format($merchant->maximum_seller_allow_price) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Item Condition') ?></th>
            <td><?= $this->Number->format($merchant->item_condition) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Quantity') ?></th>
            <td><?= $this->Number->format($merchant->quantity) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Leadtime To Ship') ?></th>
            <td><?= $this->Number->format($merchant->leadtime_to_ship) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Shipping Amount 1') ?></th>
            <td><?= $this->Number->format($merchant->shipping_amount_1) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Shipping Amount 2') ?></th>
            <td><?= $this->Number->format($merchant->shipping_amount_2) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Shipping Amount 3') ?></th>
            <td><?= $this->Number->format($merchant->shipping_amount_3) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Shipping Amount 4') ?></th>
            <td><?= $this->Number->format($merchant->shipping_amount_4) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Shipping Amount 5') ?></th>
            <td><?= $this->Number->format($merchant->shipping_amount_5) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Shipping Amount 6') ?></th>
            <td><?= $this->Number->format($merchant->shipping_amount_6) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Zshop Shipping Fee') ?></th>
            <td><?= $this->Number->format($merchant->zshop_shipping_fee) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Pending Quantity') ?></th>
            <td><?= $this->Number->format($merchant->pending_quantity) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Point') ?></th>
            <td><?= $this->Number->format($merchant->point) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Open Date At') ?></th>
            <td><?= h($merchant->open_date_at) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($merchant->created) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($merchant->modified) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Is Shipping Restricted 1') ?></th>
            <td><?= $merchant->is_shipping_restricted_1 ? __('Yes') : __('No'); ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Is Shipping Restricted 2') ?></th>
            <td><?= $merchant->is_shipping_restricted_2 ? __('Yes') : __('No'); ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Is Shipping Restricted 3') ?></th>
            <td><?= $merchant->is_shipping_restricted_3 ? __('Yes') : __('No'); ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Is Shipping Restricted 4') ?></th>
            <td><?= $merchant->is_shipping_restricted_4 ? __('Yes') : __('No'); ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Is Shipping Restricted 5') ?></th>
            <td><?= $merchant->is_shipping_restricted_5 ? __('Yes') : __('No'); ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Is Shipping Restricted 6') ?></th>
            <td><?= $merchant->is_shipping_restricted_6 ? __('Yes') : __('No'); ?></td>
          </tr>
        </table>

      </div>
    </div>
  </div>
</main>
