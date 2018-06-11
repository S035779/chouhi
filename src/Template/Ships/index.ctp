<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ship[]|\Cake\Collection\CollectionInterface $ships
 */
?>
<!-- Main menu -->
<nav class="col-md-2 d-none d-md-block bg-light sidebar">
  <div class="sidebar-sticky">

    <ul class="nav flex-column">
      <li class="nav-item">
        <?= $this->Html->link(
          $this->Html->tag('span', '', ['data-feather' => 'home'])
          . __(' 価格設定一覧 ') .
          $this->Html->tag('span', '(current)', ['class' => 'sr-only'])
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
      <h3><?= __('価格設定一覧') ?></h3>
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col"><?= $this->Paginator->sort('id') ?></th>
            <th scope="col"><?= $this->Paginator->sort('pending_quantity_rate') ?></th>
            <th scope="col"><?= $this->Paginator->sort('pending_quantity') ?></th>
            <th scope="col"><?= $this->Paginator->sort('price_criteria_1') ?></th>
            <th scope="col"><?= $this->Paginator->sort('price_criteria_2') ?></th>
            <th scope="col"><?= $this->Paginator->sort('price_criteria_3') ?></th>
            <th scope="col"><?= $this->Paginator->sort('price_criteria_4') ?></th>
            <th scope="col"><?= $this->Paginator->sort('sales_rate_1') ?></th>
            <th scope="col"><?= $this->Paginator->sort('sales_rate_2') ?></th>
            <th scope="col"><?= $this->Paginator->sort('sales_rate_3') ?></th>
            <th scope="col"><?= $this->Paginator->sort('sales_rate_4') ?></th>
            <th scope="col"><?= $this->Paginator->sort('sales_rate_5') ?></th>
            <th scope="col"><?= $this->Paginator->sort('sales_price_1') ?></th>
            <th scope="col"><?= $this->Paginator->sort('sales_price_2') ?></th>
            <th scope="col"><?= $this->Paginator->sort('sales_price_3') ?></th>
            <th scope="col"><?= $this->Paginator->sort('sales_price_4') ?></th>
            <th scope="col"><?= $this->Paginator->sort('sales_price_5') ?></th>
            <th scope="col"><?= $this->Paginator->sort('jpy_price') ?></th>
            <th scope="col"><?= $this->Paginator->sort('jp_length') ?></th>
            <th scope="col"><?= $this->Paginator->sort('jp_weight') ?></th>
            <th scope="col"><?= $this->Paginator->sort('aud_price') ?></th>
            <th scope="col"><?= $this->Paginator->sort('au_length') ?></th>
            <th scope="col"><?= $this->Paginator->sort('au_weight') ?></th>
            <th scope="col"><?= $this->Paginator->sort('usd_price') ?></th>
            <th scope="col"><?= $this->Paginator->sort('us_length') ?></th>
            <th scope="col"><?= $this->Paginator->sort('us_weight') ?></th>
            <th scope="col"><?= $this->Paginator->sort('created') ?></th>
            <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
            <th scope="col" class="actions"><?= __('Actions') ?></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($ships as $ship): ?>
          <tr>
            <td><?= $this->Number->format($ship->id) ?></td>
            <td><?= $this->Number->format($ship->pending_quantity_rate) ?></td>
            <td><?= $this->Number->format($ship->pending_quantity) ?></td>
            <td><?= $this->Number->format($ship->price_criteria_1) ?></td>
            <td><?= $this->Number->format($ship->price_criteria_2) ?></td>
            <td><?= $this->Number->format($ship->price_criteria_3) ?></td>
            <td><?= $this->Number->format($ship->price_criteria_4) ?></td>
            <td><?= $this->Number->format($ship->sales_rate_1) ?></td>
            <td><?= $this->Number->format($ship->sales_rate_2) ?></td>
            <td><?= $this->Number->format($ship->sales_rate_3) ?></td>
            <td><?= $this->Number->format($ship->sales_rate_4) ?></td>
            <td><?= $this->Number->format($ship->sales_rate_5) ?></td>
            <td><?= $this->Number->format($ship->sales_price_1) ?></td>
            <td><?= $this->Number->format($ship->sales_price_2) ?></td>
            <td><?= $this->Number->format($ship->sales_price_3) ?></td>
            <td><?= $this->Number->format($ship->sales_price_4) ?></td>
            <td><?= $this->Number->format($ship->sales_price_5) ?></td>
            <td><?= $this->Number->format($ship->jpy_price) ?></td>
            <td><?= $this->Number->format($ship->jp_length) ?></td>
            <td><?= $this->Number->format($ship->jp_weight) ?></td>
            <td><?= $this->Number->format($ship->aud_price) ?></td>
            <td><?= $this->Number->format($ship->au_length) ?></td>
            <td><?= $this->Number->format($ship->au_weight) ?></td>
            <td><?= $this->Number->format($ship->usd_price) ?></td>
            <td><?= $this->Number->format($ship->us_length) ?></td>
            <td><?= $this->Number->format($ship->us_weight) ?></td>
            <td><?= h($ship->created) ?></td>
            <td><?= h($ship->modified) ?></td>
            <td class="actions">
              <?= $this->Html->link(__('View'), ['action' => 'view', $ship->id]) ?>
              <?= $this->Html->link(__('Edit'), ['action' => 'edit', $ship->id]) ?>
              <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $ship->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ship->id)]) ?>
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
