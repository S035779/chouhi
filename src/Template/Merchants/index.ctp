<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Merchant[]|\Cake\Collection\CollectionInterface $merchants
 */
?>
<!-- Main menu -->
<nav class="col-md-2 d-none d-md-block bg-light sidebar">
  <div class="sidebar-sticky">

    <ul class="nav flex-column">
      <li class="nav-item">
        <?= $this->Html->link(
          $this->Html->tag('span', '', ['data-feather' => 'home'])
          . __(' マーケット出品一覧 ') .
          $this->Html->tag('span', '(current)', ['class' => 'sr-only'])
        , ['controller' => 'Merchants', 'action' => 'index']
        , ['escape' => false, 'class' => 'nav-link active']
        ) ?> 
      </li>
      <li class="nav-item">
        <?= $this->Html->link(
          $this->Html->tag('span', '', ['data-feather' => 'file'])
          . __(' マーケット出品追加 ')
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
    <h1 class="h2"><?= __('マーケット出品管理マスタ') ?></h1>
  </div>

  <div class="container">
    <div class="row">
      <h3><?= __('マーケット出品一覧') ?></h3>
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col"><?= $this->Paginator->sort('id') ?></th>
            <th scope="col"><?= $this->Paginator->sort('item_name') ?></th>
            <th scope="col"><?= $this->Paginator->sort('product_identifier') ?></th>
            <th scope="col"><?= $this->Paginator->sort('product_id_type') ?></th>
            <th scope="col"><?= $this->Paginator->sort('price') ?></th>
            <th scope="col"><?= $this->Paginator->sort('minimum_seller_allow_price') ?></th>
            <th scope="col"><?= $this->Paginator->sort('maximum_seller_allow_price') ?></th>
            <th scope="col"><?= $this->Paginator->sort('item_condition') ?></th>
            <th scope="col"><?= $this->Paginator->sort('quantity') ?></th>
            <th scope="col"><?= $this->Paginator->sort('add_delete') ?></th>
            <th scope="col"><?= $this->Paginator->sort('will_ship_internationally') ?></th>
            <th scope="col"><?= $this->Paginator->sort('expedited_shipping') ?></th>
            <th scope="col"><?= $this->Paginator->sort('standard_plus') ?></th>
            <th scope="col"><?= $this->Paginator->sort('item_note') ?></th>
            <th scope="col"><?= $this->Paginator->sort('fullfillment_channel') ?></th>
            <th scope="col"><?= $this->Paginator->sort('product_tax_code') ?></th>
            <th scope="col"><?= $this->Paginator->sort('leadtime_to_ship') ?></th>
            <th scope="col"><?= $this->Paginator->sort('seller_sku') ?></th>
            <th scope="col"><?= $this->Paginator->sort('currency') ?></th>
            <th scope="col"><?= $this->Paginator->sort('shipping_option_1') ?></th>
            <th scope="col"><?= $this->Paginator->sort('shipping_option_2') ?></th>
            <th scope="col"><?= $this->Paginator->sort('shipping_option_3') ?></th>
            <th scope="col"><?= $this->Paginator->sort('shipping_option_4') ?></th>
            <th scope="col"><?= $this->Paginator->sort('shipping_option_5') ?></th>
            <th scope="col"><?= $this->Paginator->sort('shipping_option_6') ?></th>
            <th scope="col"><?= $this->Paginator->sort('shipping_amount_1') ?></th>
            <th scope="col"><?= $this->Paginator->sort('shipping_amount_2') ?></th>
            <th scope="col"><?= $this->Paginator->sort('shipping_amount_3') ?></th>
            <th scope="col"><?= $this->Paginator->sort('shipping_amount_4') ?></th>
            <th scope="col"><?= $this->Paginator->sort('shipping_amount_5') ?></th>
            <th scope="col"><?= $this->Paginator->sort('shipping_amount_6') ?></th>
            <th scope="col"><?= $this->Paginator->sort('type_1') ?></th>
            <th scope="col"><?= $this->Paginator->sort('type_2') ?></th>
            <th scope="col"><?= $this->Paginator->sort('type_3') ?></th>
            <th scope="col"><?= $this->Paginator->sort('type_4') ?></th>
            <th scope="col"><?= $this->Paginator->sort('type_5') ?></th>
            <th scope="col"><?= $this->Paginator->sort('type_6') ?></th>
            <th scope="col"><?= $this->Paginator->sort('is_shipping_restricted_1') ?></th>
            <th scope="col"><?= $this->Paginator->sort('is_shipping_restricted_2') ?></th>
            <th scope="col"><?= $this->Paginator->sort('is_shipping_restricted_3') ?></th>
            <th scope="col"><?= $this->Paginator->sort('is_shipping_restricted_4') ?></th>
            <th scope="col"><?= $this->Paginator->sort('is_shipping_restricted_5') ?></th>
            <th scope="col"><?= $this->Paginator->sort('is_shipping_restricted_6') ?></th>
            <th scope="col"><?= $this->Paginator->sort('update_delete') ?></th>
            <th scope="col"><?= $this->Paginator->sort('item_description') ?></th>
            <th scope="col"><?= $this->Paginator->sort('listing_identifier') ?></th>
            <th scope="col"><?= $this->Paginator->sort('open_date_at') ?></th>
            <th scope="col"><?= $this->Paginator->sort('image_url') ?></th>
            <th scope="col"><?= $this->Paginator->sort('item_is_marketplace') ?></th>
            <th scope="col"><?= $this->Paginator->sort('zshop_shipping_fee') ?></th>
            <th scope="col"><?= $this->Paginator->sort('zshop_category1') ?></th>
            <th scope="col"><?= $this->Paginator->sort('zshop_browse_path') ?></th>
            <th scope="col"><?= $this->Paginator->sort('zshop_storefront_feature') ?></th>
            <th scope="col"><?= $this->Paginator->sort('asin1') ?></th>
            <th scope="col"><?= $this->Paginator->sort('asin2') ?></th>
            <th scope="col"><?= $this->Paginator->sort('asin3') ?></th>
            <th scope="col"><?= $this->Paginator->sort('zshop_boldface') ?></th>
            <th scope="col"><?= $this->Paginator->sort('bid_for_featured_placement') ?></th>
            <th scope="col"><?= $this->Paginator->sort('pending_quantity') ?></th>
            <th scope="col"><?= $this->Paginator->sort('merchant_shipping_group') ?></th>
            <th scope="col"><?= $this->Paginator->sort('point') ?></th>
            <th scope="col"><?= $this->Paginator->sort('seller_identifier') ?></th>
            <th scope="col"><?= $this->Paginator->sort('marketplace') ?></th>
            <th scope="col"><?= $this->Paginator->sort('created') ?></th>
            <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
            <th scope="col" class="actions"><?= __('Actions') ?></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($merchants as $merchant): ?>
          <tr>
            <td><?= $this->Number->format($merchant->id) ?></td>
            <td><?= h($merchant->item_name) ?></td>
            <td><?= h($merchant->product_identifier) ?></td>
            <td><?= $this->Number->format($merchant->product_id_type) ?></td>
            <td><?= $this->Number->format($merchant->price) ?></td>
            <td><?= $this->Number->format($merchant->minimum_seller_allow_price) ?></td>
            <td><?= $this->Number->format($merchant->maximum_seller_allow_price) ?></td>
            <td><?= $this->Number->format($merchant->item_condition) ?></td>
            <td><?= $this->Number->format($merchant->quantity) ?></td>
            <td><?= h($merchant->add_delete) ?></td>
            <td><?= h($merchant->will_ship_internationally) ?></td>
            <td><?= h($merchant->expedited_shipping) ?></td>
            <td><?= h($merchant->standard_plus) ?></td>
            <td><?= h($merchant->item_note) ?></td>
            <td><?= h($merchant->fullfillment_channel) ?></td>
            <td><?= h($merchant->product_tax_code) ?></td>
            <td><?= $this->Number->format($merchant->leadtime_to_ship) ?></td>
            <td><?= h($merchant->seller_sku) ?></td>
            <td><?= h($merchant->currency) ?></td>
            <td><?= h($merchant->shipping_option_1) ?></td>
            <td><?= h($merchant->shipping_option_2) ?></td>
            <td><?= h($merchant->shipping_option_3) ?></td>
            <td><?= h($merchant->shipping_option_4) ?></td>
            <td><?= h($merchant->shipping_option_5) ?></td>
            <td><?= h($merchant->shipping_option_6) ?></td>
            <td><?= $this->Number->format($merchant->shipping_amount_1) ?></td>
            <td><?= $this->Number->format($merchant->shipping_amount_2) ?></td>
            <td><?= $this->Number->format($merchant->shipping_amount_3) ?></td>
            <td><?= $this->Number->format($merchant->shipping_amount_4) ?></td>
            <td><?= $this->Number->format($merchant->shipping_amount_5) ?></td>
            <td><?= $this->Number->format($merchant->shipping_amount_6) ?></td>
            <td><?= h($merchant->type_1) ?></td>
            <td><?= h($merchant->type_2) ?></td>
            <td><?= h($merchant->type_3) ?></td>
            <td><?= h($merchant->type_4) ?></td>
            <td><?= h($merchant->type_5) ?></td>
            <td><?= h($merchant->type_6) ?></td>
            <td><?= h($merchant->is_shipping_restricted_1) ?></td>
            <td><?= h($merchant->is_shipping_restricted_2) ?></td>
            <td><?= h($merchant->is_shipping_restricted_3) ?></td>
            <td><?= h($merchant->is_shipping_restricted_4) ?></td>
            <td><?= h($merchant->is_shipping_restricted_5) ?></td>
            <td><?= h($merchant->is_shipping_restricted_6) ?></td>
            <td><?= h($merchant->update_delete) ?></td>
            <td><?= h($merchant->item_description) ?></td>
            <td><?= h($merchant->listing_identifier) ?></td>
            <td><?= h($merchant->open_date_at) ?></td>
            <td><?= h($merchant->image_url) ?></td>
            <td><?= h($merchant->item_is_marketplace) ?></td>
            <td><?= $this->Number->format($merchant->zshop_shipping_fee) ?></td>
            <td><?= h($merchant->zshop_category1) ?></td>
            <td><?= h($merchant->zshop_browse_path) ?></td>
            <td><?= h($merchant->zshop_storefront_feature) ?></td>
            <td><?= h($merchant->asin1) ?></td>
            <td><?= h($merchant->asin2) ?></td>
            <td><?= h($merchant->asin3) ?></td>
            <td><?= h($merchant->zshop_boldface) ?></td>
            <td><?= h($merchant->bid_for_featured_placement) ?></td>
            <td><?= $this->Number->format($merchant->pending_quantity) ?></td>
            <td><?= h($merchant->merchant_shipping_group) ?></td>
            <td><?= $this->Number->format($merchant->point) ?></td>
            <td><?= h($merchant->seller_identifier) ?></td>
            <td><?= h($merchant->marketplace) ?></td>
            <td><?= h($merchant->created) ?></td>
            <td><?= h($merchant->modified) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $merchant->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $merchant->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $merchant->id], ['confirm' => __('Are you sure you want to delete # {0}?', $merchant->id)]) ?>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <nav aria-label="Page navigation">
        <ul class="pagination">
          <?= $this->Paginator->first(__('first'))      ?>
          <?= $this->Paginator->prev(__('previous'))    ?>
          <?= $this->Paginator->numbers()               ?>
          <?= $this->Paginator->next(__('next'))        ?>
          <?= $this->Paginator->last(__('last'))        ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
      </nav>

    </div>
  </div>
</main>
