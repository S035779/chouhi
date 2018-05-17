<!doctype html>
<html lang="ja">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="desctiption" content="bootstrap-4.1.1">
    <meta name="author" content="Mamoru Hashimoto">
    <link rel="icon" href="favicon.ico">
    <title><?= h($title) ?></title>
    <!-- Bootstrap CSS -->
    <?= $this->Html->css([
        '//stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css'
      ]) ?>
    <link rel="stylesheet" href="/chouhi<?= $this->Elixir->version('css/watchnote.css') ?>">
  </head>

  <body>
    <?= $this->Flash->render() ?>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="/chouhi/bootstrap">
        <?= env('APP_NAME') ?>
      </a>
      <input class="form-control form-control-dark w-100" type="text"
        placeholder="Search" aria-label="Search">
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="/chouhi/users/signout">Sign out</a>
        </li>
      </ul>
    </nav>

    <!-- Main menu -->
    <div class="container-fluid">
      <div class="row">

        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">

            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link" href="/chouhi/bootstrap/index">
                  <span data-feather="pie-chart"></span>
                  ダッシュボード</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/chouhi/bootstrap/token">
                  <span data-feather="file"></span>
                  トークン設定
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/chouhi/bootstrap/search">
                  <span data-feather="search"></span>
                  商品検索
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/chouhi/bootstrap/market">
                  <span data-feather="shopping-cart"></span>
                  マーケット出品
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/chouhi/bootstrap/setting">
                  <span data-feather="user"></span>
                  ユーザ管理
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/chouhi/bootstrap/registration">
                  <span data-feather="bar-chart-2"></span>
                  新規ASIN登録
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/chouhi/bootstrap/suspension">
                  <span data-feather="layers"></span>
                  禁止ASIN登録
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/chouhi/bootstrap/calculation">
                  <span data-feather="percent"></span>
                  販売価格設定
                </a>
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
                <a class="nav-link" href="/chouhi/Asins">
                  <span data-feather="file-text"></span>
                  ASIN管理マスタ
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/chouhi/Users">
                  <span data-feather="file-text"></span>
                  ユーザ管理マスタ
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/chouhi/Items">
                  <span data-feather="file-text"></span>
                  商品管理マスタ
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/chouhi/Delivery">
                  <span data-feather="file-text"></span>
                  送料管理マスタ
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/chouhi/Tokens">
                  <span data-feather="file-text"></span>
                  トークン管理マスタ
                </a>
              </li>
            </ul>

          </div>
        </nav>

        <?= $this->fetch('content') ?>

      </div>
    </div>
  </body>
</html>
