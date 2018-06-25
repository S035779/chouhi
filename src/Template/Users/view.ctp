<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
        <!-- Main menu -->
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">

            <ul class="nav flex-column">
              <li class="nav-item">
                <?= $this->Html->link(
                  $this->Html->tag('span', '', ['data-feather' => 'file'])
                  . ' ユーザ編集 '
                , ['controller' => 'Users', 'action' => 'edit', $user->id]
                , ['escape' => false, 'class' => 'nav-link']
                ) ?>
              </li>
              <li class="nav-item">
                <?= $this->Form->postLink(
                  $this->Html->tag('span', '', ['data-feather' => 'file'])
                  . ' ユーザ削除 '
                , ['controller' => 'Users', 'action' => 'delete', $user->id]
                , ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)
                  , 'escape' => false, 'class' => 'nav-link']
                ) ?>
              </li>
              <li class="nav-item">
                <?= $this->Html->link(
                  $this->Html->tag('span', '', ['data-feather' => 'home'])
                  . ' ユーザ一覧 ' .
                  $this->Html->tag('span', '(current)', ['class' => 'sr-only'])
                , ['controller' => 'Users', 'action' => 'index']
                , ['escape' => false, 'class' => 'nav-link active']
                ) ?>
              </li>
              <li class="nav-item">
                <?= $this->Html->link(
                  $this->Html->tag('span', '', ['data-feather' => 'file'])
                  . ' ユーザ追加 '
                , ['controller' => 'Users', 'action' => 'add']
                , ['escape' => false, 'class' => 'nav-link']
                ) ?>
              </li>
            </ul>

          </div>
        </nav>

        <!-- Main contens -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">ユーザ管理マスタ</h1>
          </div>
          <div class="container">
            <div class="row">

              <div class="col-md-8 order-md-1">
                <h3><?= h($user->name) ?></h3>
                <table class="table table-hover">
                  <tr>
                    <th scope="row"><?= __('Name') ?></th>
                    <td><?= h($user->name) ?></td>
                  </tr>
                  <tr>
                    <th scope="row"><?= __('Email') ?></th>
                    <td><?= h($user->email) ?></td>
                  </tr>
                  <tr>
                    <th scope="row"><?= __('Password') ?></th>
                    <td><?= h($user->password) ?></td>
                  </tr>
                  <tr>
                    <th scope="row"><?= __('Id') ?></th>
                    <td><?= $this->Number->format($user->id) ?></td>
                  </tr>
                  <tr>
                    <th scope="row"><?= __('Role') ?></th>
                    <td><?= $this->Number->format($user->role) ?></td>
                  </tr>
                  <tr>
                    <th scope="row"><?= __('Last Login At') ?></th>
                    <td><?= h($user->last_login_at) ?></td>
                  </tr>
                  <tr>
                    <th scope="row"><?= __('Created') ?></th>
                    <td><?= h($user->created) ?></td>
                  </tr>
                  <tr>
                    <th scope="row"><?= __('Modified') ?></th>
                    <td><?= h($user->modified) ?></td>
                  </tr>
                </table>
              </div>

            </div>
          </div>
        </main>
