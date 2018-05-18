<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
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
