<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Item $item
 */
?>
<!-- Main menu -->
<nav class="col-md-2 d-none d-md-block bg-light sidebar">
  <div class="sidebar-sticky">

    <ul class="nav flex-column">
      <li class="nav-item">
        <?= $this->Html->link(
          $this->Html->tag('span', '', ['data-feather' => 'home'])
          . __(' 商品一覧 ') .
          $this->Html->tag('span', '(current)', ['class' => 'sr-only'])
        , ['controller' => 'Items', 'action' => 'index']
        , ['escape' => false, 'class' => 'nav-link active']
        ) ?> 
      </li>
      <li class="nav-item">
        <?= $this->Html->link(
          $this->Html->tag('span', '', ['data-feather' => 'file'])
          . __(' 商品追加 ')
        , ['controller' => 'Items', 'action' => 'add']
        , ['escape' => false, 'class' => 'nav-link']
        ) ?> 
      </li>
    </ul>

  </div>
</nav>

<!-- Main contents -->
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><?= __('商品管理マスタ') ?></h1>
  </div>
  <div class="container">
    <div class="row">

      <div class="col-md-8 order-md-1">
        <h3><?= h($item->title) ?></h3>
        <table class="table table-hover">
          <tr>
            <th scope="row"><?= __('Asin') ?></th>
            <td><?= h($item->asin) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($item->title) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('List Price Currency') ?></th>
            <td><?= h($item->list_price_currency) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Lowest Price') ?></th>
            <td><?= h($item->lowest_price) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Lowest Price Currency') ?></th>
            <td><?= h($item->lowest_price_currency) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Lowest Used Price Currency') ?></th>
            <td><?= h($item->lowest_used_price_currency) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Lowest Collectible Price Currency') ?></th>
            <td><?= h($item->lowest_collectible_price_currency) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Offer Listing Price Currency') ?></th>
            <td><?= h($item->offer_listing_price_currency) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Offer Listing Saved Price Currency') ?></th>
            <td><?= h($item->offer_listing_saved_price_currency) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Ean') ?></th>
            <td><?= h($item->ean) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Condition') ?></th>
            <td><?= h($item->condition_status) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Product Group') ?></th>
            <td><?= h($item->product_group) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Marketplace') ?></th>
            <td><?= h($item->marketplace) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Detail Page Url') ?></th>
            <td><?= h($item->detail_page_url) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Small Image Url') ?></th>
            <td><?= h($item->small_image_url) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Medium Image Url') ?></th>
            <td><?= h($item->medium_image_url) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Large Image Url') ?></th>
            <td><?= h($item->large_image_url) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Customer Reviews Url') ?></th>
            <td><?= h($item->customer_reviews_url) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($item->id) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Item Height') ?></th>
            <td><?= $this->Number->format($item->item_height) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Item Length') ?></th>
            <td><?= $this->Number->format($item->item_length) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Item Weight') ?></th>
            <td><?= $this->Number->format($item->item_weight) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Item Width') ?></th>
            <td><?= $this->Number->format($item->item_width) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Package Height') ?></th>
            <td><?= $this->Number->format($item->package_height) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Package Length') ?></th>
            <td><?= $this->Number->format($item->package_length) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Package Weight') ?></th>
            <td><?= $this->Number->format($item->package_weight) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Package Width') ?></th>
            <td><?= $this->Number->format($item->package_width) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('List Price') ?></th>
            <td><?= $this->Number->format($item->list_price) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Lowest Used Price') ?></th>
            <td><?= $this->Number->format($item->lowest_used_price) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Lowest Collectible Price') ?></th>
            <td><?= $this->Number->format($item->lowest_collectible_price) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Offer Listing Price') ?></th>
            <td><?= $this->Number->format($item->offer_listing_price) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Offer Listing Saved Price') ?></th>
            <td><?= $this->Number->format($item->offer_listing_saved_price) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Sales Ranking') ?></th>
            <td><?= $this->Number->format($item->sales_ranking) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Total Reviews') ?></th>
            <td><?= $this->Number->format($item->total_reviews) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Average Rating') ?></th>
            <td><?= $this->Number->format($item->average_rating) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Total Votes') ?></th>
            <td><?= $this->Number->format($item->total_votes) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Quantity') ?></th>
            <td><?= $this->Number->format($item->quantity) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Quantity Allocated') ?></th>
            <td><?= $this->Number->format($item->quantity_allocated) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Total New') ?></th>
            <td><?= $this->Number->format($item->total_new) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Total Used') ?></th>
            <td><?= $this->Number->format($item->total_used) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Total Collectible') ?></th>
            <td><?= $this->Number->format($item->total_collectible) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Total Refurbished') ?></th>
            <td><?= $this->Number->format($item->total_refurbished) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Release Date At') ?></th>
            <td><?= h($item->release_date_at) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Publication Date At') ?></th>
            <td><?= h($item->publication_date_at) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Original Release Date At') ?></th>
            <td><?= h($item->original_release_date_at) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($item->created) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($item->modified) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Is Eligible Prime') ?></th>
            <td><?= $item->is_eligible_prime ? __('Yes') : __('No'); ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Is Eligible For Supersaver Shipping') ?></th>
            <td><?= $item->is_eligible_for_supersaver_shipping ? __('Yes') : __('No'); ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $item->status ? __('Yes') : __('No'); ?></td>
          </tr>
        </table>  
      </div>

    </div>
  </div>
</main>
