<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ship $ship
 */
?>
<!-- Main menu -->
<nav class="col-md-2 d-none d-md-block bg-light sidebar">
  <div class="sidebar-sticky">

    <ul class="nav flex-column">
      <li class="nav-item">
        <?= $this->Html->link(
          $this->Html->tag('span', '', ['data-feather' => 'file'])
          . __(' 価格設定編集 ')
        , ['controller' => 'Ships', 'action' => 'edit', $ship->id]
        , ['escape' => false, 'class' => 'nav-link']
        ) ?> 
      </li>
      <li class="nav-item">
        <?= $this->Form->postLink(
          $this->Html->tag('span', '', ['data-feather' => 'file'])
          . __(' 価格設定削除 ')
        , ['controller' => 'Ships', 'action' => 'delete', $ship->id]
        , ['confirm' => __('Are you sure you want to delete # {0}?', $ship->id)
          , 'escape' => false, 'class' => 'nav-link']
        ) ?> 
      </li>
      <li class="nav-item">
        <?= $this->Html->link(
          $this->Html->tag('span', '', ['data-feather' => 'home'])
          . __(' 価格設定一覧 ') .
          $this->Html->tag('tag', '(current)', ['class' => 'sr-only'])
        , ['controller' => 'Ships', 'action' => 'index']
        , ['escape' => false, 'class' => 'nav-link active']
        ) ?> 
      </li>
      <li class="nav-item">
        <?= $this->Html->link(
          $this->Html->tag('span', '', ['data-feather' => 'file'])
          . __(' 価格設定追加 ')
        , ['controller' => 'Ships', 'action' => 'add']
        , ['escape' => false, 'class' => 'nav-link']
        ) ?> 
      </li>
    </ul>

  </div>
</nav>

<!-- Main contents -->
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><?= __('価格設定管理マスタ') ?></h1>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-md-8 order-md-1">

        <h3><?= h($ship->id) ?></h3>
        <table class="table table-hover">
            <tr>
                <th scope="row"><?= __('Id') ?></th>
                <td><?= $this->Number->format($ship->id) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Pending Quantity Rate') ?></th>
                <td><?= $this->Number->format($ship->pending_quantity_rate) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Pending Quantity') ?></th>
                <td><?= $this->Number->format($ship->pending_quantity) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Price Criteria 1') ?></th>
                <td><?= $this->Number->format($ship->price_criteria_1) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Price Criteria 2') ?></th>
                <td><?= $this->Number->format($ship->price_criteria_2) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Price Criteria 3') ?></th>
                <td><?= $this->Number->format($ship->price_criteria_3) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Price Criteria 4') ?></th>
                <td><?= $this->Number->format($ship->price_criteria_4) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Sales Rate 1') ?></th>
                <td><?= $this->Number->format($ship->sales_rate_1) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Sales Rate 2') ?></th>
                <td><?= $this->Number->format($ship->sales_rate_2) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Sales Rate 3') ?></th>
                <td><?= $this->Number->format($ship->sales_rate_3) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Sales Rate 4') ?></th>
                <td><?= $this->Number->format($ship->sales_rate_4) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Sales Rate 5') ?></th>
                <td><?= $this->Number->format($ship->sales_rate_5) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Sales Price 1') ?></th>
                <td><?= $this->Number->format($ship->sales_price_1) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Sales Price 2') ?></th>
                <td><?= $this->Number->format($ship->sales_price_2) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Sales Price 3') ?></th>
                <td><?= $this->Number->format($ship->sales_price_3) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Sales Price 4') ?></th>
                <td><?= $this->Number->format($ship->sales_price_4) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Sales Price 5') ?></th>
                <td><?= $this->Number->format($ship->sales_price_5) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Delete Rate 1') ?></th>
                <td><?= $this->Number->format($ship->delete_rate_1) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Delete Rate 2') ?></th>
                <td><?= $this->Number->format($ship->delete_rate_2) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Delete Rate 3') ?></th>
                <td><?= $this->Number->format($ship->delete_rate_3) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Delete Rate 4') ?></th>
                <td><?= $this->Number->format($ship->delete_rate_4) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Delete Rate 5') ?></th>
                <td><?= $this->Number->format($ship->delete_rate_5) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Delete Price 1') ?></th>
                <td><?= $this->Number->format($ship->delete_price_1) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Delete Price 2') ?></th>
                <td><?= $this->Number->format($ship->delete_price_2) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Delete Price 3') ?></th>
                <td><?= $this->Number->format($ship->delete_price_3) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Delete Price 4') ?></th>
                <td><?= $this->Number->format($ship->delete_price_4) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Delete Price 5') ?></th>
                <td><?= $this->Number->format($ship->delete_price_5) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Created') ?></th>
                <td><?= h($ship->created) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Modified') ?></th>
                <td><?= h($ship->modified) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Is Fulfillment Selling') ?></th>
                <td><?= $ship->is_fulfillment_selling ? __('Yes') : __('No'); ?></td>
            </tr>
        </table>

      </div>
    </div>
  </div>
</main>
