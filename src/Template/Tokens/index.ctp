<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Token[]|\Cake\Collection\CollectionInterface $tokens
 */
?>
<!-- Main menu -->
<nav class="col-md-2 d-none d-md-block bg-light sidebar">
  <div class="sidebar-sticky">

    <ul class="nav flex-column">
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
      <h3><?= __('トークン一覧') ?></h3>
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col"><?= $this->Paginator->sort('id') ?></th>
            <th scope="col"><?= $this->Paginator->sort('email') ?></th>
            <th scope="col"><?= $this->Paginator->sort('marketplace') ?></th>
            <th scope="col"><?= $this->Paginator->sort('seller_id') ?></th>
            <th scope="col"><?= $this->Paginator->sort('access_key') ?></th>
            <th scope="col"><?= $this->Paginator->sort('secret_key') ?></th>
            <th scope="col"><?= $this->Paginator->sort('pa_access_key') ?></th>
            <th scope="col"><?= $this->Paginator->sort('pa_secret_key') ?></th>
            <th scope="col"><?= $this->Paginator->sort('pa_associate_tag') ?></th>
            <th scope="col"><?= $this->Paginator->sort('suspended') ?></th>
            <th scope="col"><?= $this->Paginator->sort('created') ?></th>
            <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
            <th scope="col" class="actions"><?= __('Actions') ?></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($tokens as $token): ?>
          <tr>
            <td><?= $this->Number->format($token->id) ?></td>
            <td><?= $token->has('seller')  ? $this->Html->link($token->seller->email
              , ['controller' => 'Sellers', 'action' => 'view', $token->seller->id]) : '' ?></td>
            <td><?= $token->has('seller')  ? $this->Html->link($token->seller->marketplace
              , ['controller' => 'Sellers', 'action' => 'view', $token->seller->id]) : '' ?></td>
            <td><?= $token->has('seller')  ? $this->Html->link($token->seller->seller
              , ['controller' => 'Sellers', 'action' => 'view', $token->seller->id]) : '' ?></td>
            <td><?= h($token->access_key) ?></td>
            <td><?= h($token->secret_key) ?></td>
            <td><?= h($token->pa_access_key) ?></td>
            <td><?= h($token->pa_secret_key) ?></td>
            <td><?= h($token->pa_associate_tag) ?></td>
            <td><?= h($token->suspended) ?></td>
            <td><?= h($token->created) ?></td>
            <td><?= h($token->modified) ?></td>
            <td class="actions">
              <?= $this->Html->link(__('View'), ['action' => 'view', $token->id]) ?>
              <?= $this->Html->link(__('Edit'), ['action' => 'edit', $token->id]) ?>
              <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $token->id], ['confirm' => __('Are you sure you want to delete # {0}?', $token->id)]) ?>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <nav aria-label="Page navigation">
        <ul class="pagination">
          <?= $this->Paginator->first(__('first'))   ?>
          <?= $this->Paginator->prev(__('previous')) ?>
          <?= $this->Paginator->numbers()            ?>
          <?= $this->Paginator->next(__('next'))     ?>
          <?= $this->Paginator->last(__('last'))     ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
      </nav>

    </div>
  </div>
</main>
