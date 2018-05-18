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
          $this->Html->tag('span', '', ['data-feather' => 'home'])
          . ' ASIN一覧 ' .
          $this->Html->tag('span', '(current)', ['class' => 'sr-only'])
        , ['controller' => 'Asins', 'action' => 'index']
        , ['escape' => false, 'class' => 'nav-link active']
        ) ?>
      </li>
      <li class="nav-item">
        <?= $this->Html->link(
          $this->Html->tag('span', '', ['data-feather' => 'file'])
          . ' ASIN追加 '
        , ['controller' => 'Asins', 'action' => 'add']
        , ['escape' => false, 'class' => 'nav-link']
        ) ?>
      </li>
    </ul>

  </div>
</nav>

<!-- Main contens -->
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">ASIN管理マスタ</h1>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-8 order-md-1">
        <h3><?= h($user->name) ?></h3>

        <table class="vertical-table">
          <tr>
            <th scope="row"><?= __('Asin') ?></th>
            <td><?= h($asin->asin) ?></td>
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
