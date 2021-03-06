<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Asin $asin
 */
?>
<!-- Main menu -->
<nav class="col-md-2 d-none d-md-block bg-light sidebar">
  <div class="sidebar-sticky">

    <ul class="nav flex-column">
      <li class="nav-item">
        <?= $this->Html->link(
          $this->Html->tag('span', '', ['data-feather' => 'file'])
          . __(' ASIN編集 ')
        , ['controller' => 'Asins', 'action' => 'edit', $asin->id]
        , ['escape' => false, 'class' => 'nav-link']
        ) ?>
      </li>
      <li class="nav-item">
        <?= $this->Form->postLink(
          $this->Html->tag('span', '', ['data-feather' => 'file'])
          . __(' ASIN削除 ')
        , ['controller' => 'Asins', 'action' => 'delete', $asin->id]
        , ['confirm' => __('Are you sure you want to delete # {0}?', $asin->id)
          , 'escape' => false, 'class' => 'nav-link']
        ) ?>
      </li>
      <li class="nav-item">
        <?= $this->Html->link(
          $this->Html->tag('span', '', ['data-feather' => 'home'])
          . __(' ASIN一覧 ') .
          $this->Html->tag('span', '(current)', ['class' => 'sr-only'])
        , ['controller' => 'Asins', 'action' => 'index']
        , ['escape' => false, 'class' => 'nav-link active']
        ) ?>
      </li>
      <li class="nav-item">
        <?= $this->Html->link(
          $this->Html->tag('span', '', ['data-feather' => 'file'])
          . __(' ASIN追加 ')
        , ['controller' => 'Asins', 'action' => 'add']
        , ['escape' => false, 'class' => 'nav-link']
        ) ?>
      </li>
    </ul>

  </div>
</nav>

<!-- Main contents -->
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><?= __('ASIN管理マスタ') ?></h1>
  </div>
  <div class="container">
    <div class="row">

      <div class="col-md-8 order-md-1">
        <h3><?= h($asin->asin) ?></h3>
        <table class="table table-hover">
          <tr>
            <th scope="row"><?= __('Asin') ?></th>
            <td><?= h($asin->asin) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Ean') ?></th>
            <td><?= h($asin->ean) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Upc') ?></th>
            <td><?= h($asin->upc) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Isbn') ?></th>
            <td><?= h($asin->isbn) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Sku') ?></th>
            <td><?= h($asin->sku) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Marketplace') ?></th>
            <td><?= h($asin->marketplace) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($asin->id) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($asin->created) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($asin->modified) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Suspended') ?></th>
            <td><?= $asin->suspended ? __('Yes') : __('No'); ?></td>
          </tr>
        </table>
      </div>

    </div>
  </div>
</main>
