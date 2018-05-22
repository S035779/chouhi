<!doctype html>
<html lang="ja">
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
            __(' Sign out ')
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
                  $this->Html->tag('span', '', ['data-feather' => 'pie-chart'])
                  . __(' ダッシュボード ')
                , ['controller' => 'Bootstrap', 'action' => 'index']
                , ['escape' => false, 'class' => 'nav-link']
                ) ?>
              </li>
              <li class="nav-item">
                <?= $this->Html->link(
                  $this->Html->tag('span', '', ['data-feather' => 'file'])
                  . __(' トークン設定 ')
                , ['controller' => 'Bootstrap', 'action' => 'token']
                , ['escape' => false, 'class' => 'nav-link']
                ) ?>
              </li>
              <li class="nav-item">
                <?= $this->Html->link(
                  $this->Html->tag('span', '', ['data-feather' => 'search'])
                  . __(' 商品検索 ')
                , ['controller' => 'Bootstrap', 'action' => 'search']
                , ['escape' => false, 'class' => 'nav-link']
                ) ?>
              </li>
              <li class="nav-item">
                <?= $this->Html->link(
                  $this->Html->tag('span', '', ['data-feather' => 'shopping-cart'])
                  . __(' マーケット出品 ')
                , ['controller' => 'Bootstrap', 'action' => 'market']
                , ['escape' => false, 'class' => 'nav-link']
                ) ?>
              </li>
              <li class="nav-item">
                <?= $this->Html->link(
                  $this->Html->tag('span', '', ['data-feather' => 'user'])
                  . __(' ユーザ管理 ')
                , ['controller' => 'Bootstrap', 'action' => 'setting']
                , ['escape' => false, 'class' => 'nav-link']
                ) ?>
              </li>
              <li class="nav-item">
                <?= $this->Html->link(
                  $this->Html->tag('span', '', ['data-feather' => 'bar-chart-2'])
                  . __(' 新規ASIN登録 ')
                , ['controller' => 'Bootstrap', 'action' => 'registration']
                , ['escape' => false, 'class' => 'nav-link']
                ) ?>
              </li>
              <li class="nav-item">
                <?= $this->Html->link(
                  $this->Html->tag('span', '', ['data-feather' => 'layers'])
                  . __(' 禁止ASIN登録 ')
                , ['controller' => 'Bootstrap', 'action' => 'suspension']
                , ['escape' => false, 'class' => 'nav-link']
                ) ?>
              </li>
              <li class="nav-item">
                <?= $this->Html->link(
                  $this->Html->tag('span', '', ['data-feather' => 'percent'])
                  . __(' 販売価格設定 ')
                , ['controller' => 'Bootstrap', 'action' => 'calculation']
                , ['escape' => false, 'class' => 'nav-link']
                ) ?>
              </li>
            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>登録データ管理</span>
              <a class="d-flex align-items-center text-muted" href="#">
                <span data-feather="plus-circle"></span>
              </a>
            </h6>

            <ul class="nav flex-column mb-2">
              <li class="nav-item">
                <?= $this->Html->link(
                  $this->Html->tag('span', '', ['data-feather' => 'file-text'])
                  . __(' ASIN管理マスタ ')
                , ['controller' => 'Asins', 'action' => 'index']
                , ['escape' => false, 'class' => 'nav-link']
                ) ?>
              </li>
              <li class="nav-item">
                <?= $this->Html->link(
                  $this->Html->tag('span', '', ['data-feather' => 'file-text'])
                  . __(' ユーザ管理マスタ ')
                , ['controller' => 'Users', 'action' => 'index']
                , ['escape' => false, 'class' => 'nav-link']
                ) ?>
              </li>
              <li class="nav-item">
                <?= $this->Html->link(
                  $this->Html->tag('span', '', ['data-feather' => 'file-text'])
                  . __(' 商品管理マスタ ')
                , ['controller' => 'Items', 'action' => 'index']
                , ['escape' => false, 'class' => 'nav-link']
                ) ?>
              </li>
              <li class="nav-item">
                <?= $this->Html->link(
                  $this->Html->tag('span', '', ['data-feather' => 'file-text'])
                  . __(' 送料管理マスタ ')
                , ['controller' => 'Delivery', 'action' => 'index']
                , ['escape' => false, 'class' => 'nav-link']
                ) ?>
              </li>
              <li class="nav-item">
                <?= $this->Html->link(
                  $this->Html->tag('span', '', ['data-feather' => 'file-text'])
                  . __(' トークン管理マスタ ')
                , ['controller' => 'Tokens', 'action' => 'index']
                , ['escape' => false, 'class' => 'nav-link']
                ) ?>
              </li>
            </ul>

          </div>
        </nav>

        <?= $this->fetch('content') ?>

      </div>
    </div>
  </body>
</html>
