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
      <li class="nav-item">
        <?= $this->Html->link(
          $this->Html->tag('span', '', ['data-feather' => 'home'])
          . __(' マーケット出品一覧 ')
        , ['controller' => 'Merchants', 'action' => 'index']
        , ['escape' => false, 'class' => 'nav-link']
        ) ?>
      </li>
      <li class="nav-item">
        <?= $this->Html->link(
          $this->Html->tag('span', '', ['data-feather' => 'file'])
          . __(' マーケット出品追加 ') .
          $this->Html->tag('span', '(current)', ['class' => 'sr-only'])
        , ['controller' => 'Merchants', 'action' => 'add']
        , ['escape' => false, 'class' => 'nav-link active']
        ) ?>
      </li>
    </ul>

  </div>
</nav>

<!-- Main contents -->
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><?= __('マーケット出品管理マスタ') ?></h1>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-md-8 order-md-1">
        <?= $this->Form->create($merchant) ?>
        <fieldset>
          <legend><?= __('マーケット出品追加') ?></legend>
          <?php
            echo $this->Form->control('item_name');
            echo $this->Form->control('product_identifier');
            echo $this->Form->control('product_id_type');
            echo $this->Form->control('price');
            echo $this->Form->control('minimum_seller_allow_price');
            echo $this->Form->control('maximum_seller_allow_price');
            echo $this->Form->control('item_condition');
            echo $this->Form->control('quantity');
            echo $this->Form->control('add_delete');
            echo $this->Form->control('will_ship_internationally');
            echo $this->Form->control('expedited_shipping');
            echo $this->Form->control('standard_plus');
            echo $this->Form->control('item_note');
            echo $this->Form->control('fullfillment_channel');
            echo $this->Form->control('product_tax_code');
            echo $this->Form->control('leadtime_to_ship');
            echo $this->Form->control('seller_sku');
            echo $this->Form->control('currency');
            echo $this->Form->control('shipping_option_1');
            echo $this->Form->control('shipping_option_2');
            echo $this->Form->control('shipping_option_3');
            echo $this->Form->control('shipping_option_4');
            echo $this->Form->control('shipping_option_5');
            echo $this->Form->control('shipping_option_6');
            echo $this->Form->control('shipping_amount_1');
            echo $this->Form->control('shipping_amount_2');
            echo $this->Form->control('shipping_amount_3');
            echo $this->Form->control('shipping_amount_4');
            echo $this->Form->control('shipping_amount_5');
            echo $this->Form->control('shipping_amount_6');
            echo $this->Form->control('type_1');
            echo $this->Form->control('type_2');
            echo $this->Form->control('type_3');
            echo $this->Form->control('type_4');
            echo $this->Form->control('type_5');
            echo $this->Form->control('type_6');
            echo $this->Form->control('is_shipping_restricted_1');
            echo $this->Form->control('is_shipping_restricted_2');
            echo $this->Form->control('is_shipping_restricted_3');
            echo $this->Form->control('is_shipping_restricted_4');
            echo $this->Form->control('is_shipping_restricted_5');
            echo $this->Form->control('is_shipping_restricted_6');
            echo $this->Form->control('update_delete');
            echo $this->Form->control('item_description');
            echo $this->Form->control('listing_identifier');
            echo $this->Form->control('open_date_at');
            echo $this->Form->control('image_url');
            echo $this->Form->control('item_is_marketplace');
            echo $this->Form->control('zshop_shipping_fee');
            echo $this->Form->control('zshop_category1');
            echo $this->Form->control('zshop_browse_path');
            echo $this->Form->control('zshop_storefront_feature');
            echo $this->Form->control('asin1');
            echo $this->Form->control('asin2');
            echo $this->Form->control('asin3');
            echo $this->Form->control('zshop_boldface');
            echo $this->Form->control('bid_for_featured_placement');
            echo $this->Form->control('pending_quantity');
            echo $this->Form->control('merchant_shipping_group');
            echo $this->Form->control('point');
            echo $this->Form->control('seller_identifier');
            echo $this->Form->control('marketplace');
          ?>
        </fieldset>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>

      </div>
    </div>
  </div>
</main>
