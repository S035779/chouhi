<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Offer $offer
 */
?>
<!-- Main menu -->
<nav class="col-md-2 d-none d-md-block bg-light sidebar">
  <div class="sidebar-sticky">

    <ul class="nav flex-column">
      <li class="nav-item">
        <?= $this->Html->link(
          $this->Html->tag('span', '', ['data-feather' => 'file'])
          . __(' 商品編集 ') 
        , ['controller' => 'Offers', 'action' => 'edit', $offer->id]
        , ['escape' => false, 'class' => 'nav-link']
        ) ?>
      </li>
      <li class="nav-item">
        <?= $this->Form->postLink(
          $this->Html->tag('span', '', ['data-feather' => 'file'])
          . __(' 商品削除 ')
        , ['controller' => 'Offers', 'action' => 'delete', $offer->id]
        , ['confirm' => __('Are you sure you want to delete # {0}?', $offer->id)
          , 'escape' => false, 'class' => 'nav-link']
        ) ?> 
      </li>
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
          . __(' 商品編集 ')
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
      <div class="col-md-8 order-md-1">

        <h3><?= h($offer->id) ?></h3>
        <table class="table table-hover">
          <tr>
            <th scope="row"><?= __('Asin') ?></th>
            <td><?= h($offer->asin) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Availability') ?></th>
            <td><?= h($offer->availability) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Condition Status') ?></th>
            <td><?= h($offer->condition_status) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Condition Status Note') ?></th>
            <td><?= h($offer->condition_status_note) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Country') ?></th>
            <td><?= h($offer->country) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Exchange Identifier') ?></th>
            <td><?= h($offer->exchange_identifier) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Is Eligible For Supersaver Shipping') ?></th>
            <td><?= $offer->is_eligible_for_supersaver_shipping ? __('Yes') : __('No'); ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Offer Listing Identifier') ?></th>
            <td><?= h($offer->offer_listing_identifier) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('State') ?></th>
            <td><?= h($offer->state) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Sub Condition Status') ?></th>
            <td><?= h($offer->sub_condition_status) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($offer->id) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Average Feedback Rating') ?></th>
            <td><?= $this->Number->format($offer->average_feedback_rating) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Price') ?></th>
            <td><?= $this->Number->format($offer->price) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Price Currency') ?></th>
            <td><?= h($offer->price_currency) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Total Feedback') ?></th>
            <td><?= $this->Number->format($offer->total_feedback) ?></td>
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
            <th scope="row"><?= __('Customer Reviews Url') ?></th>
            <td><?= h($item->customer_reviews_url) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($offer->created) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($offer->modified) ?></td>
          </tr>
        </table>

      </div>
    </div>
  </div>
</main>
