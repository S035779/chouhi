<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Offer[]|\Cake\Collection\CollectionInterface $offers
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
          , ['controller' => 'Offers', 'action' => 'index']
          , ['escape' => false, 'class' => 'nav-link active']
          ) ?>
        </li>
        <li class="nav-item">
          <?= $this->Html->link(
            $this->Html->tag('span', '', ['data-feather' => 'file'])
            . __(' 商品追加 ')
          , ['controller' => 'Offers', 'action' => 'add']
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
            <th scope="col"><?= $this->Paginator->sort('availability') ?></th>
            <th scope="col"><?= $this->Paginator->sort('average_feedback_rating') ?></th>
            <th scope="col"><?= $this->Paginator->sort('condition_status') ?></th>
            <th scope="col"><?= $this->Paginator->sort('condition_status_note') ?></th>
            <th scope="col"><?= $this->Paginator->sort('country') ?></th>
            <th scope="col"><?= $this->Paginator->sort('exchange_identifier') ?></th>
            <th scope="col"><?= $this->Paginator->sort('is_eligible_for_supersaver_shipping') ?></th>
            <th scope="col"><?= $this->Paginator->sort('offer_listing_identifier') ?></th>
            <th scope="col"><?= $this->Paginator->sort('price') ?></th>
            <th scope="col"><?= $this->Paginator->sort('price_currency') ?></th>
            <th scope="col"><?= $this->Paginator->sort('lowest_price') ?></th>
            <th scope="col"><?= $this->Paginator->sort('lowest_price_currency') ?></th>
            <th scope="col"><?= $this->Paginator->sort('state') ?></th>
            <th scope="col"><?= $this->Paginator->sort('sub_condition_status') ?></th>
            <th scope="col"><?= $this->Paginator->sort('total_feedback') ?></th>
            <th scope="col"><?= $this->Paginator->sort('seller_identifier') ?></th>
            <th scope="col"><?= $this->Paginator->sort('item_id') ?></th>
            <th scope="col"><?= $this->Paginator->sort('created') ?></th>
            <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
            <th scope="col" class="actions"><?= __('Actions') ?></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($offers as $offer): ?>
          <tr>
            <td><?= $this->Number->format($offer->id) ?></td>
            <td><?= h($offer->asin) ?></td>
            <td><?= h($offer->availability) ?></td>
            <td><?= $this->Number->format($offer->average_feedback_rating) ?></td>
            <td><?= h($offer->condition_status) ?></td>
            <td><?= h($offer->condition_status_note) ?></td>
            <td><?= h($offer->country) ?></td>
            <td><?= h($offer->exchange_identifier) ?></td>
            <td><?= h($offer->is_eligible_for_supersaver_shipping) ?></td>
            <td><?= h($offer->offer_listing_identifier) ?></td>
            <td><?= $this->Number->format($offer->price) ?></td>
            <td><?= h($offer->price_currency) ?></td>
            <td><?= $this->Number->format($offer->lowest_price) ?></td>
            <td><?= h($offer->lowest_price_currency) ?></td>
            <td><?= h($offer->state) ?></td>
            <td><?= h($offer->sub_condition_status) ?></td>
            <td><?= $this->Number->format($offer->total_feedback) ?></td>
            <td><?= h($offer->seller_identifier) ?></td>
            <td><?= $this->Number->format($offer->item_id) ?></td>
            <td><?= h($offer->created) ?></td>
            <td><?= h($offer->modified) ?></td>
            <td class="actions">
              <?= $this->Html->link(__('View'), ['action' => 'view', $offer->id]) ?>
              <?= $this->Html->link(__('Edit'), ['action' => 'edit', $offer->id]) ?>
              <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $offer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $offer->id)]) ?>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <nav aria-label="Page navigation">
        <ul class="pagination">
          <?= $this->Paginator->first(__('first'))    ?>
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

