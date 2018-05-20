<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Item[]|\Cake\Collection\CollectionInterface $items
 */
?>
<!-- Main manu -->
<nav class="col-md-2 d-none d-md-block bg-light sidebar">
  <div class="sidebar-sticky">

    <ul class="nav flex-column">
      <li class="nav-item">
        <?= $this->Html->link(
          $this->Html->tag('span', '', ['data-feather' => 'home' ])
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
      <h3><?= __('商品一覧') ?></h3>
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col"><?= $this->Paginator->sort('id') ?></th>
            <th scope="col"><?= $this->Paginator->sort('asin') ?></th>
            <th scope="col"><?= $this->Paginator->sort('title') ?></th>
            <th scope="col"><?= $this->Paginator->sort('is_eligible_prime') ?></th>
            <th scope="col"><?= $this->Paginator->sort('is_eligible_for_supersaver_shipping') ?></th>
            <th scope="col"><?= $this->Paginator->sort('item_height') ?></th>
            <th scope="col"><?= $this->Paginator->sort('item_length') ?></th>
            <th scope="col"><?= $this->Paginator->sort('item_weight') ?></th>
            <th scope="col"><?= $this->Paginator->sort('item_width') ?></th>
            <th scope="col"><?= $this->Paginator->sort('package_height') ?></th>
            <th scope="col"><?= $this->Paginator->sort('package_length') ?></th>
            <th scope="col"><?= $this->Paginator->sort('package_weight') ?></th>
            <th scope="col"><?= $this->Paginator->sort('package_width') ?></th>
            <th scope="col"><?= $this->Paginator->sort('list_price') ?></th>
            <th scope="col"><?= $this->Paginator->sort('list_price_currency') ?></th>
            <th scope="col"><?= $this->Paginator->sort('lowest_price') ?></th>
            <th scope="col"><?= $this->Paginator->sort('lowest_price_currency') ?></th>
            <th scope="col"><?= $this->Paginator->sort('lowest_used_price') ?></th>
            <th scope="col"><?= $this->Paginator->sort('lowest_used_price_currency') ?></th>
            <th scope="col"><?= $this->Paginator->sort('lowest_collectible_price') ?></th>
            <th scope="col"><?= $this->Paginator->sort('lowest_collectible_price_currency') ?></th>
            <th scope="col"><?= $this->Paginator->sort('offer_listing_price') ?></th>
            <th scope="col"><?= $this->Paginator->sort('offer_listing_price_currency') ?></th>
            <th scope="col"><?= $this->Paginator->sort('offer_listing_saved_price') ?></th>
            <th scope="col"><?= $this->Paginator->sort('offer_listing_saved_price_currency') ?></th>
            <th scope="col"><?= $this->Paginator->sort('sales_ranking') ?></th>
            <th scope="col"><?= $this->Paginator->sort('ean') ?></th>
            <th scope="col"><?= $this->Paginator->sort('release_date_at') ?></th>
            <th scope="col"><?= $this->Paginator->sort('publication_date_at') ?></th>
            <th scope="col"><?= $this->Paginator->sort('original_release_date_at') ?></th>
            <th scope="col"><?= $this->Paginator->sort('condition_status') ?></th>
            <th scope="col"><?= $this->Paginator->sort('total_reviews') ?></th>
            <th scope="col"><?= $this->Paginator->sort('average_rating') ?></th>
            <th scope="col"><?= $this->Paginator->sort('total_votes') ?></th>
            <th scope="col"><?= $this->Paginator->sort('product_group') ?></th>
            <th scope="col"><?= $this->Paginator->sort('quantity') ?></th>
            <th scope="col"><?= $this->Paginator->sort('quantity_allocated') ?></th>
            <th scope="col"><?= $this->Paginator->sort('status') ?></th>
            <th scope="col"><?= $this->Paginator->sort('marketplace') ?></th>
            <th scope="col"><?= $this->Paginator->sort('detail_page_url') ?></th>
            <th scope="col"><?= $this->Paginator->sort('small_image_url') ?></th>
            <th scope="col"><?= $this->Paginator->sort('medium_image_url') ?></th>
            <th scope="col"><?= $this->Paginator->sort('large_image_url') ?></th>
            <th scope="col"><?= $this->Paginator->sort('created') ?></th>
            <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
            <th scope="col"><?= $this->Paginator->sort('total_new') ?></th>
            <th scope="col"><?= $this->Paginator->sort('total_used') ?></th>
            <th scope="col"><?= $this->Paginator->sort('total_collectible') ?></th>
            <th scope="col"><?= $this->Paginator->sort('total_refurbished') ?></th>
            <th scope="col"><?= $this->Paginator->sort('customer_reviews_url') ?></th>
            <th scope="col" class="actions"><?= __('Actions') ?></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($items as $item): ?>
          <tr>
            <td><?= $this->Number->format($item->id) ?></td>
            <td><?= h($item->asin) ?></td>
            <td><?= h($item->title) ?></td>
            <td><?= h($item->is_eligible_prime) ?></td>
            <td><?= h($item->is_eligible_for_supersaver_shipping) ?></td>
            <td><?= $this->Number->format($item->item_height) ?></td>
            <td><?= $this->Number->format($item->item_length) ?></td>
            <td><?= $this->Number->format($item->item_weight) ?></td>
            <td><?= $this->Number->format($item->item_width) ?></td>
            <td><?= $this->Number->format($item->package_height) ?></td>
            <td><?= $this->Number->format($item->package_length) ?></td>
            <td><?= $this->Number->format($item->package_weight) ?></td>
            <td><?= $this->Number->format($item->package_width) ?></td>
            <td><?= $this->Number->format($item->list_price) ?></td>
            <td><?= h($item->list_price_currency) ?></td>
            <td><?= $this->Number->format($item->lowest_price) ?></td>
            <td><?= h($item->lowest_price_currency) ?></td>
            <td><?= $this->Number->format($item->lowest_used_price) ?></td>
            <td><?= h($item->lowest_used_price_currency) ?></td>
            <td><?= $this->Number->format($item->lowest_collectible_price) ?></td>
            <td><?= h($item->lowest_collectible_price_currency) ?></td>
            <td><?= $this->Number->format($item->offer_listing_price) ?></td>
            <td><?= h($item->offer_listing_price_currency) ?></td>
            <td><?= $this->Number->format($item->offer_listing_saved_price) ?></td>
            <td><?= h($item->offer_listing_saved_price_currency) ?></td>
            <td><?= $this->Number->format($item->sales_ranking) ?></td>
            <td><?= h($item->ean) ?></td>
            <td><?= h($item->release_date_at) ?></td>
            <td><?= h($item->publication_date_at) ?></td>
            <td><?= h($item->original_release_date_at) ?></td>
            <td><?= h($item->condition_status) ?></td>
            <td><?= $this->Number->format($item->total_reviews) ?></td>
            <td><?= $this->Number->format($item->average_rating) ?></td>
            <td><?= $this->Number->format($item->total_votes) ?></td>
            <td><?= h($item->product_group) ?></td>
            <td><?= $this->Number->format($item->quantity) ?></td>
            <td><?= $this->Number->format($item->quantity_allocated) ?></td>
            <td><?= h($item->status) ?></td>
            <td><?= h($item->marketplace) ?></td>
            <td><?= h($item->detail_page_url) ?></td>
            <td><?= h($item->small_image_url) ?></td>
            <td><?= h($item->medium_image_url) ?></td>
            <td><?= h($item->large_image_url) ?></td>
            <td><?= h($item->created) ?></td>
            <td><?= h($item->modified) ?></td>
            <td><?= $this->Number->format($item->total_new) ?></td>
            <td><?= $this->Number->format($item->total_used) ?></td>
            <td><?= $this->Number->format($item->total_collectible) ?></td>
            <td><?= $this->Number->format($item->total_refurbished) ?></td>
            <td><?= h($item->customer_reviews_url) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $item->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $item->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $item->id], ['confirm' => __('Are you sure you want to delete # {0}?', $item->id)]) ?>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <nav aria-label="Page navigation">
        <ul class="pagination">
          <?= $this->Paginator->first( __('first'))   ?>
          <?= $this->Paginator->prev(__('previous'))  ?>
          <?= $this->Paginator->numbers()             ?>
          <?= $this->Paginator->next(__('next'))      ?>
          <?= $this->Paginator->last(__('last'))      ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
      </nav>

    </div>
  </div>
</main>
