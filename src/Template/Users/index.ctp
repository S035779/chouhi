<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="desctiption" content="bootstrap-4.1.1">
    <meta name="author" content="Mamoru Hashimoto">
    <?= $this->Html->meta('icon') ?>
    <title><?= h($title) ?></title>
    <!-- Bootstrap CSS -->
    <?= $this->Html->css([
      '//stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css'
    , $this->Elixir->version('css/watchnote.css')
    ]) ?>
  </head>

  <body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
      <?= $this->Html->link(
        env('APP_NAME')
      , ['controller' => 'Bootstrap', 'action' => 'index']
      , ['class' => 'navbar-brand col-sm-3 col-md-2 mr-0']
      ) ?>
      <input class="form-control form-control-dark w-100" type="text"
        placeholder="Search" aria-label="Search">
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <?= $this->Html->link(
            ' Sign out '
          , ['controller' => 'Users', 'action' => 'signout']
          , ['class' => 'nav-link']
          ) ?>
        </li>
      </ul>
    </nav>
    <?= $this->Flash->render() ?>

    <!-- Main menu -->
    <div class="container-fluid">
      <div class="row">

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
              <?php
                $this->Paginator->setTemplates([
                  'number'        =>
                    '<li class="page-item">
                      <a class="page-link" href="{{url}}">{{text}}</a>
                    </li>'
                , 'first'         =>
                    '<li class="page-item">
                      <a class="page-link" href="{{url}}">{{text}}</a>
                    </li>'
                , 'prevActive'    =>
                    '<li class="page-item">
                      <a class="page-link" href="{{url}}">{{text}}</a>
                    </li>'
                , 'prevDisabled'   =>
                    '<li class="page-item disabled">
                      <a class="page-link" href="{{url}}" tabindex="-1">{{text}}</a>
                    </li>'
                , 'nextActive'    =>
                    '<li class="page-item">
                      <a class="page-link" href="{{url}}">{{text}}</a>
                    </li>'
                , 'nextDisabled'  =>
                    '<li class="page-item disabled">
                      <a class="page-link" href="{{url}}" tabindex="-1">{{text}}</a>
                    </li>'
                , 'last'          =>
                    '<li class="page-item">
                      <a class="page-link" href="{{url}}">{{text}}</a>
                    </li>'
                , 'current'  =>
                    '<li class="page-item active">
                      <a class="page-link" href="{{url}}">{{text}}
                       <span class="sr-only">(current)</span></a>
                    </li>'
                ]);
              ?>
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

      </div>
    </div>

    <!-- The Modal -->
    <div class="modal fade" id="myModal">
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">送信完了</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            処理を受け付ました。
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>

        </div>
      </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <?= $this->Html->script([
        '//code.jquery.com/jquery-3.3.1.slim.min.js'
      , '//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js'
      , '//stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js'
      , '//unpkg.com/feather-icons/dist/feather.min.js'
      , $this->Elixir->version('js/watchnote.js')
      ]) ?>
    <!-- Icons -->
    <script>feather.replace()</script>
    <!-- Validation check -->
    <script>
    (function() {
      'use strict';
      window.addEventListener('load', function() {
        var forms = document.getElementsByClassName('needs-validation');
        var validation = Array.prototype.filter.call(forms
          , function(form) {
          form.addEventListener('submit', function(event) {
            if(form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    })();
    </script>

  </body>
