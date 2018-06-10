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
        <?= $this->Form->postLink(
          $this->Html->tag('span', '', ['data-feather' => 'file'])
          . __(' 配送料削除 ')
        , ['controller' => 'Deliverys', 'action' => 'delete', $delivery->id]
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
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><?= __('配送料管理マスタ') ?></h1>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-md-8 order-md-1">

        <?= $this->Form->create($delivery) ?>
        <fieldset>
            <legend><?= __('配送料編集') ?></legend>
            <?php
                echo $this->Form->control('method');
                echo $this->Form->control('area');
                echo $this->Form->control('price');
                echo $this->Form->control('length');
                echo $this->Form->control('total_length');
                echo $this->Form->control('weight');
                echo $this->Form->control('duedate');
            ?>
        </fieldset>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>

      </div>
    </div>
  </div>
</main>
