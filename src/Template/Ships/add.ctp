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
          $this->Html->tag('span', '', ['data-feather' => 'home'])
          . __(' 価格設定一覧 ')
        , ['controller' => 'Ships', 'action' => 'index']
        , ['escape' => false, 'class' => 'nav-link']
        ) ?>
      </li>
      <li class="nav-item">
        <?= $this->Html->link(
          $this->Html->tag('span', '', ['data-feather' => 'file'])
          . __(' 価格設定追加 ') .
          $this->Html->tag('span', '(current)', ['class' => 'sr-only'])
        , ['controller' => 'Ships', 'action' => 'index']
        , ['escape' => false, 'class' => 'nav-link active']
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

        <?= $this->Form->create($ship) ?>
        <fieldset>
          <legend><?= __('価格設定登録') ?></legend>
          <?php
            echo $this->Form->control('is_fulfillment_selling');
            echo $this->Form->control('pending_quantity_rate');
            echo $this->Form->control('pending_quantity');
            echo $this->Form->control('price_criteria_1');
            echo $this->Form->control('price_criteria_2');
            echo $this->Form->control('price_criteria_3');
            echo $this->Form->control('price_criteria_4');
            echo $this->Form->control('sales_rate_1');
            echo $this->Form->control('sales_rate_2');
            echo $this->Form->control('sales_rate_3');
            echo $this->Form->control('sales_rate_4');
            echo $this->Form->control('sales_rate_5');
            echo $this->Form->control('sales_price_1');
            echo $this->Form->control('sales_price_2');
            echo $this->Form->control('sales_price_3');
            echo $this->Form->control('sales_price_4');
            echo $this->Form->control('sales_price_5');
            echo $this->Form->control('delete_rate_1');
            echo $this->Form->control('delete_rate_2');
            echo $this->Form->control('delete_rate_3');
            echo $this->Form->control('delete_rate_4');
            echo $this->Form->control('delete_rate_5');
            echo $this->Form->control('delete_price_1');
            echo $this->Form->control('delete_price_2');
            echo $this->Form->control('delete_price_3');
            echo $this->Form->control('delete_price_4');
            echo $this->Form->control('delete_price_5');
          ?>
        </fieldset>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>

      </div>
    </div>
  </div>
</main>
