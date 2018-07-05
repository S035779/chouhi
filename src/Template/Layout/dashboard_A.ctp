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
      , ['controller' => 'Bootstrap', 'action' => env('APP_TOPPAGE')]
      , ['class' => 'navbar-brand col-sm-3 col-md-2 mr-0']
      ) ?>
      <input class="form-control form-control-dark w-100" type="text"
        placeholder="Search" aria-label="Search">
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <?= $this->Html->link(
            __(' Sign out ')
          , ['controller' => 'Authenticate', 'action' => 'signout']
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
                  . __(' MWS/PAAPI設定 ')
                , ['controller' => 'Bootstrap', 'action' => 'token']
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
              <li class="nav-item">
                <?= $this->Html->link(
                  $this->Html->tag('span', '', ['data-feather' => 'shopping-cart'])
                  . __(' 出品商品一覧 ')
                , ['controller' => 'Bootstrap', 'action' => 'market']
                , ['escape' => false, 'class' => 'nav-link']
                ) ?>
              </li>
              <li class="nav-item">
                <?= $this->Html->link(
                  $this->Html->tag('span', '', ['data-feather' => 'crosshair'])
                  . __(' ASINリスト ')
                , ['controller' => 'Bootstrap', 'action' => 'asins']
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
                  $this->Html->tag('span', '', ['data-feather' => 'user'])
                  . __(' ユーザ設定 ')
                , ['controller' => 'Bootstrap', 'action' => 'setting']
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
