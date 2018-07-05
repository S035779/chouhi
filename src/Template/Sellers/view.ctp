<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Seller $seller
 */
?>
<!-- Main menu -->
<nav class="col-md-2 d-none d-md-block bg-light sidebar">
  <div class="sidebar-sticky">

    <ul class="nav flex-column">
        <li class="nav-item">
          <?= $this->Html->link(
            $this->Html->tag('span', '', ['data-feather' => 'file'])
            . __(' セラー編集 ')
          , ['controller' => 'Sellers', 'action' => 'edit', $seller->id]
          , ['escape' => false, 'class' => 'nav-link']
          ) ?>
        </li>
        <li class="nav-item">
          <?= $this->Form->postLink(
            $this->Html->tag('span', '', ['data-feather' => 'file'])
            . __(' セラー削除 ')
          , ['controller' => 'Sellers', 'action' => 'delete', $seller->id]
          , ['confirm' => __('Are you sure you want to delete # {0}?', $seller->id)
            , 'escape' => false, 'class' => 'nav-link']
          ) ?> 
        </li>
        <li class="nav-item">
          <?= $this->Html->link(
            $this->Html->tag('span', '', ['data-feather' => 'home'])
            . __(' セラー一覧 ') .
            $this->Html->tag('span', '(current)', ['class' => 'sr-only'])
          , ['controller' => 'Sellers', 'action' => 'index']
          , ['escape' => false, 'class' => 'nav-link active']
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
    <h1 class="h2"><?= __('セラー管理マスタ') ?></h1>
  </div>

  <div class="container">
    <div class="row">

      <div class="col-md-8 order-md-1">
        <h3><?= h($seller->seller) ?></h3>
        <table class="table table-hover">
          <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($seller->email) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Marketplace') ?></th>
            <td><?= h($seller->marketplace) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('seller') ?></th>
            <td><?= h($seller->seller) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($seller->id) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($seller->created) ?></td>
          </tr>
          <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($seller->modified) ?></td>
          </tr>
        </table>
        <div class="related">
          <h4><?= __('登録トークン') ?></h4>
          <?php if (!empty($seller->tokens)): ?>
          <table class="table table-hover">
            <tr>
              <th scope="col"><?= __('Id') ?></th>
              <th scope="col"><?= __('Access Key') ?></th>
              <th scope="col"><?= __('Secret Key') ?></th>
              <th scope="col"><?= __('Seller Id') ?></th>
              <th scope="col"><?= __('Suspended') ?></th>
              <th scope="col"><?= __('Pa Access Key') ?></th>
              <th scope="col"><?= __('Pa Secret Key') ?></th>
              <th scope="col"><?= __('Pa Associate Tag') ?></th>
              <th scope="col"><?= __('Created') ?></th>
              <th scope="col"><?= __('Modified') ?></th>
              <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($seller->tokens as $tokens): ?>
            <tr>
              <td><?= h($tokens->id) ?></td>
              <td><?= h($tokens->access_key) ?></td>
              <td><?= h($tokens->secret_key) ?></td>
              <td><?= h($tokens->seller_id) ?></td>
              <td><?= h($tokens->suspended) ?></td>
              <td><?= h($tokens->pa_access_key) ?></td>
              <td><?= h($tokens->pa_secret_key) ?></td>
              <td><?= h($tokens->pa_associate_tag) ?></td>
              <td><?= h($tokens->created) ?></td>
              <td><?= h($tokens->modified) ?></td>
              <td class="actions">
                  <?= $this->Html->link(__('View'), ['controller' => 'Tokens', 'action' => 'view', $tokens->id]) ?>
                  <?= $this->Html->link(__('Edit'), ['controller' => 'Tokens', 'action' => 'edit', $tokens->id]) ?>
                  <?= $this->Form->postLink(__('Delete'), ['controller' => 'Tokens', 'action' => 'delete', $tokens->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tokens->id)]) ?>
              </td>
            </tr>
            <?php endforeach; ?>
          </table>
          <?php endif; ?>
        </div>
      </div>

    </div>
  </div>
</main>
