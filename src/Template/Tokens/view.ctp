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
            $this->Html->tag('span', '', ['data-feather' => 'file'])
            . __(' トークン編集 ')
          , ['controller' => 'Tokens', 'action' => 'edit', $token->id]
          , ['escape' => false, 'class' => 'nav-link']
          ) ?> 
        </li>
        <li class="nav-item">
          <?= $this->Form->postLink(
            $this->Html->tag('span', '', ['data-feather' => 'file'])
            . __(' トークン削除 ')
          , ['controller' => 'Tokens', 'action' => 'delete', $token->id]
          , ['confirm' => __('Are you sure you want to delete # {0}?', $token->id)
            , 'escape' => false, 'class' => 'nav-link']
          ) ?> 
        </li>
        <li class="nav-item">
          <?= $this->Html->link(
            $this->Html->tag('span', '', ['data-feather' => 'home'])
            . __(' トークン一覧 ') .
            $this->Html->tag('span', '(current)', ['class' => 'sr-only'])
          , ['controller' => 'Tokens', 'action' => 'index']
          , ['escape' => false, 'class' => 'nav-link active']
          ) ?> 
        </li>
        <li class="nav-item">
          <?= $this->Html->link(
            $this->Html->tag('span', '', ['data-feather' => 'file'])
            . __(' トークン追加 ')
          , ['controller' => 'Tokens', 'action' => 'add']
          , ['escape' => false, 'class' => 'nav-link']
          ) ?> 
        </li>
        <li class="nav-item">
          <?= $this->Html->link(
            $this->Html->tag('span', '', ['data-feather' => 'home'])
            . __(' セラー一覧 ')
          , ['controller' => 'Sellers', 'action' => 'index']
          , ['escape' => false, 'class' => 'nav-link']
          ) ?> 
        </li>
        <li class="nav-item">
          <?= $this->Html->link(
            $this->Html->tag('span', '', ['data-feather' => 'file'])
            . __(' セラー追加 ')
          , ['controller' => 'Sellers', 'action' => 'add']
          , ['escape' => false, 'class' => 'nav-link']
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

        <h3><?= h($token->access_key) ?></h3>
        <table class="table table-hover">
          <tr>
            <th scope="row"><?= __('Access Key') ?></th>
            <td><?= h($token->access_key) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Secret Key') ?></th>
            <td><?= h($token->secret_key) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Seller') ?></th>
            <td><?= $token->has('seller') ? $this->Html->link($token->seller->seller, ['controller' => 'Sellers', 'action' => 'view', $token->seller->id]) : '' ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($token->id) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($token->created) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($token->modified) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Suspended') ?></th>
            <td><?= $token->suspended ? __('Yes') : __('No'); ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('PA Access Key') ?></th>
            <td><?= h($token->pa_access_key) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('PA Secret Key') ?></th>
            <td><?= h($token->pa_secret_key) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('PA Associate Tag') ?></th>
            <td><?= h($token->pa_associate_tag) ?></td>
          </tr>
        </table>

      </div>
    </div>
  </div>
</main>
