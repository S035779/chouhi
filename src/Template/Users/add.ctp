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
                  $this->Html->tag('span', '', ['data-feather' => 'home'])
                  . ' ユーザ一覧 '
                , ['controller' => 'Users', 'action' => 'index']
                , ['escape' => false, 'class' => 'nav-link']
                ) ?>
              </li>
              <li class="nav-item">
                <?= $this->Html->link(
                  $this->Html->tag('span', '', ['data-feather' => 'file'])
                  . ' ユーザ追加 ' .
                  $this->Html->tag('span', '(current)', ['class' => 'sr-only'])
                , ['controller' => 'Users', 'action' => 'add']
                , ['escape' => false, 'class' => 'nav-link active']
                ) ?>
              </li>
            </ul>

          </div>
        </nav>

        <!-- Main contens -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2"><?= __('ユーザ管理マスタ') ?></h1>
          </div>

          <div class="container">
            <div class="row">

              <div class="col-md-8 order-md-1">
                <?= $this->Form->create($user) ?>
                <fieldset>
                  <legend><?= __('ユーザ登録') ?></legend>
                  <?php
                    echo $this->Form->control('name');
                    echo $this->Form->control('email');
                    echo $this->Form->control('password');
                    echo $this->Form->control('role');
                    echo $this->Form->control('last_login_at');
                  ?>
                </fieldset>
                <?= $this->Form->button(__('Submit')) ?>
                <?= $this->Form->end() ?>
              </div>

            </div>
          </div>
        </main>
