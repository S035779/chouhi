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
          . __(' ASIN一覧 ')
        , ['controller' => 'Asins', 'action' => 'index']
        , ['escape' => false, 'class' => 'nav-link']
        ) ?>
      </li>
      <li class="nav-item">
        <?= $this->Html->link(
          $this->Html->tag('span', '', ['data-feather' => 'file'])
          . __(' ASIN追加 ') .
           $this->Html->tag('span', '(current)', ['class' => 'sr-only'])
        , ['controller' => 'Asins', 'action' => 'add']
        , ['escape' => false, 'class' => 'nav-link active']
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
        <?= $this->Form->create($asin) ?>
        <fieldset>
          <legend><?= __('ASIN登録') ?></legend>
          <?php
            echo $this->Form->control('asin');
            echo $this->Form->control('ean');
            echo $this->Form->control('upc');
            echo $this->Form->control('isbn');
            echo $this->Form->control('sku');
            echo $this->Form->control('marketplace');
            echo $this->Form->control('suspended');
          ?>
        </fieldset>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
      </div>

    </div>
  </div>
</main>
