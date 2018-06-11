<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Delivery $delivery
 */
?>
<!-- Main menu -->
<nav class="col-md-2 d-none d-md-block bg-light sidebar">
  <div class="sidebar-sticky">

    <ul class="nav flex-column">
      <li class="nav-item">
        <?= $this->Html->link(
          $this->Html->tag('span', '', ['data-feather' => 'file'])
          . __(' 配送料編集 ')
        , ['controller' => 'Deliverys', 'action' => 'edit', $delivery->id]
        , ['escape' => false, 'class' => 'nav-link']
        ) ?> 
      </li>
      <li class="nav-item">
        <?= $this->Form->postLink(
          $this->Html->tag('span', '', ['data-feather' => 'file'])
          . __(' 配送料削除 ')
        , ['controller' => 'Deliverys',  'action' => 'delete', $delivery->id]
        , ['confirm' => __('Are you sure you want to delete # {0}?', $delivery->id)
          , 'escape' => false, 'class' => 'nav-link']
        ) ?> 
      </li>
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
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-conter pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><?= __('配送料管理マスタ') ?></h1>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-md-8 order-md-1">

        <h3><?= h($delivery->id) ?></h3>
        <table class="table table-hover">
          <tr>
            <th scope="row"><?= __('Method') ?></th>
            <td><?= h($delivery->method) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Area') ?></th>
            <td><?= h($delivery->area) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($delivery->id) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Price') ?></th>
            <td><?= $this->Number->currency($delivery->price, 'JPY') ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Length') ?></th>
            <td><?= $this->Number->format($delivery->length, ['after' => 'mm']) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Total Length') ?></th>
            <td><?= $this->Number->format($delivery->total_length, ['after' => 'mm']) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Weight') ?></th>
            <td><?= $this->Number->format($delivery->weight, ['after' => 'kg', 'precision' => 2]) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Duedate') ?></th>
            <td><?= $this->Number->formatDelta($delivery->duedate, ['after' => 'days']) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($delivery->created) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($delivery->modified) ?></td>
          </tr>
        </table>

      </div>
    </div>
  </div>
</main>
