<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Token $token
 */
?>
<!-- Main menu -->
<nav class="col-md-2 d-none d-md-block bg-light sidebar">
  <div class="sidebar-sticky">

    <ul class="nav flex-column">
      <li class="nav-item">
        <?= $this->Html->link(
          $this->Html->tag('span', '', ['data-feather' => 'home'])
          . __(' トークン一覧 ')
        , ['controller' => 'Tokens', 'action' => 'index']
        , ['escape' => false, 'class' => 'nav-link']
        ) ?>
      </li>
      <li class="nav-item">
        <?= $this->Html->link(
          $this->Html->tag('span', '', ['data-feather' => 'file'])
          . __(' トークン追加 ') .
          $this->Html->tag('span', '(current)', ['class' => 'sr-only'])
        , ['controller' => 'Tokens', 'action' => 'add']
        , ['escape' => false, 'class' => 'nav-link active']
        ) ?>
      </li>
    </ul>

  </div>
</nav>

<!-- Main contents -->
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><?= __('トークン管理マスタ') ?></h1>
  </div>
  
  <div class="container">
    <div class="row">

      <div class="col-md-8 order-md-1">
        <?= $this->Form->create($token) ?>
        <fieldset>
          <legend><?= __('トークン追加') ?></legend>
          <?php
            echo $this->Form->control('access_key');
            echo $this->Form->control('secret_key');
            echo $this->Form->control('seller_id', ['options' => $sellers]);
            echo $this->Form->control('suspended');
            echo $this->Form->control('pa_access_key');
            echo $this->Form->control('pa_secret_key');
            echo $this->Form->control('pa_associate_tag');
          ?>
        </fieldset>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
      </div>
  
    </div>
  </div>
</main>
