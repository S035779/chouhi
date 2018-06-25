<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>

        <!-- Main menu -->
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">

            <ul class="nav flex-column">
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
            <h1 class="h2"><?= __('ユーザ管理マスタ') ?></h1>
          </div>

          <div class="container">
            <div class="row">
              <h3><?= __('ユーザ一覧') ?></h3>
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('password') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('role') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('last_login_at') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($users as $user): ?>
                  <tr>
                    <td><?= $this->Number->format($user->id) ?></td>
                    <td><?= h($user->name) ?></td>
                    <td><?= h($user->email) ?></td>
                    <td><?= h($user->password) ?></td>
                    <td><?= $this->Number->format($user->role) ?></td>
                    <td><?= h($user->last_login_at) ?></td>
                    <td><?= h($user->created) ?></td>
                    <td><?= h($user->modified) ?></td>
                    <td class="actions">
                      <?= $this->Html->link(__('View'), ['action' => 'view', $user->id]) ?>
                      <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id]) ?>
                      <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
              <nav aria-label="Page navigation">
                <ul class="pagination">
                  <?= $this->Paginator->first(__('First'))    ?>
                  <?= $this->Paginator->prev(__('Previous'))  ?>
                  <?= $this->Paginator->numbers()             ?>
                  <?= $this->Paginator->next(__('Next'))      ?>
                  <?= $this->Paginator->last(__('Last'))      ?>
                </ul>
                <p><?= $this->Paginator->counter(['format'  =>  __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
              </nav>

            </div>
          </div>
        </main>
