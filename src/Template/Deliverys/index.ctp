<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Delivery[]|\Cake\Collection\CollectionInterface $deliverys
 */
?>
<!-- Main menu -->
<nav class="col-md-2 d-none d-md-block bg-light sidebar">
  <div class="sidebar-sticky">
    <ul class="nav flex-column">
      <li class="nav-item">
        <?= $this->Html->link(
          $this->Html->tag('span', '', ['data-feather' => 'home'])
          . __(' 配送料一覧 ') .
          $this->Html->tag('span', '(current)', ['class' => 'sr-only'])
        , ['controller' => 'Deliverys', 'action' => 'index']
        , ['escape' => false, 'class' => 'nav-link active']
        ) ?>
      </li>
      <li class="nav-item">
        <?= $this->Html->link(
          $this->Html->tag('span', '', ['data-feather' => 'file'])
          . __(' 配送料追加 ')
        , ['controller' => 'Deliverys', 'action' => 'add']
        , ['escape' => false, 'class' => 'nav-link']
        ) ?>
      </li>
    </ul>
  </div>
</nav>

<!-- Main contents -->
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><?= __('配送料管理マスタ') ?></h1>
  </div>

  <div class="container">
    <div class="row">
      <h3><?= __('配送料一覧') ?></h3>
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col"><?= $this->Paginator->sort('id') ?></th>
            <th scope="col"><?= $this->Paginator->sort('method') ?></th>
            <th scope="col"><?= $this->Paginator->sort('area') ?></th>
            <th scope="col"><?= $this->Paginator->sort('price') ?></th>
            <th scope="col"><?= $this->Paginator->sort('length') ?></th>
            <th scope="col"><?= $this->Paginator->sort('total_length') ?></th>
            <th scope="col"><?= $this->Paginator->sort('weight') ?></th>
            <th scope="col"><?= $this->Paginator->sort('duedate') ?></th>
            <th scope="col"><?= $this->Paginator->sort('created') ?></th>
            <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
            <th scope="col" class="actions"><?= __('Actions') ?></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($deliverys as $delivery): ?>
          <tr>
            <td><?= $this->Number->format($delivery->id) ?></td>
            <td><?= h($delivery->method) ?></td>
            <td><?= h($delivery->area) ?></td>
            <td><?= $this->Number->currency($delivery->price, 'JPY') ?></td>
            <td><?= $this->Number->format($delivery->length, ['after' => 'mm']) ?></td>
            <td><?= $this->Number->format($delivery->total_length, ['after' => 'mm']) ?></td>
            <td><?= $this->Number->format($delivery->weight, ['after' => 'kg', 'precision' => 2]) ?></td>
            <td><?= $this->Number->formatDelta($delivery->duedate, ['after' => 'days']) ?></td>
            <td><?= h($delivery->created) ?></td>
            <td><?= h($delivery->modified) ?></td>
            <td class="actions">
              <?= $this->Html->link(__('View'), ['action' => 'view', $delivery->id]) ?>
              <?= $this->Html->link(__('Edit'), ['action' => 'edit', $delivery->id]) ?>
              <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $delivery->id], ['confirm' => __('Are you sure you want to delete # {0}?', $delivery->id)]) ?>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <nav aria-label="Page navigation">
        <ul class="pagination">
          <?= $this->Paginator->first(__('first')) ?>
          <?= $this->Paginator->prev(__('previous')) ?>
          <?= $this->Paginator->numbers() ?>
          <?= $this->Paginator->next(__('next')) ?>
          <?= $this->Paginator->last(__('last')) ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
      </nav>

    </div>
  </div>
</main>
