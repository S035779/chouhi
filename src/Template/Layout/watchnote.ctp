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
    <nav class
      ="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">
        <?= env('APP_NAME') ?>
      </a>
      <input class="form-control form-control-dark w-100" type="text"
        placeholder="Search" aria-label="Search">
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="sign-in.html">Sign out</a>
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
                <a class="nav-link active" href="index.html">
                  <span data-feather="home"></span>
                  ダッシュボード<span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="token.html">
                  <span data-feather="file"></span>
                  トークン設定
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="search.html">
                  <span data-feather="search"></span>
                  商品検索
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="market.html">
                  <span data-feather="shopping-cart"></span>
                  マーケット出品
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="user.html">
                  <span data-feather="user"></span>
                  ユーザ管理
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="asin_regist.html">
                  <span data-feather="bar-chart-2"></span>
                  新規ASIN登録
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="asin_prohigit.html">
                  <span data-feather="layers"></span>
                  禁止ASIN登録
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
                <a class="nav-link" href="#">
                  <span data-feather="file-text"></span>
                  ASIN管理マスタ
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="file-text"></span>
                  ユーザ管理マスタ
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="file-text"></span>
                  商品管理マスタ
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="file-text"></span>
                  送料管理マスタ
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
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
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <?= $this->Html->script([
        '//code.jquery.com/jquery-3.3.1.slim.min.js'
      , '//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js'
      , '//stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js'
      ]) ?>
    <script src="/chouhi<?= $this->Elixir->version('js/watchnote.js') ?>"></script>
    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>feather.replace()</script>
    <!-- Graphs -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
    <script>
      var ctx = document.getElementById("myChart");
      var myChart = new Chart(ctx, { type: 'line',
        data: {
          labels: [
            '日曜日', '月曜日', '火曜日', '水曜日', '木曜日'
          , '金曜日', '土曜日'
          ], 
          datasets: [{
            data: [15339, 21345, 18483, 24003, 23489, 24092, 12034],
            lineTension: 0,
            backgroundColor: 'transparent',
            borderColor: '#007bff',
            borderWidth: 4,
            pointBackgroundColor: '#007bff'
          }]
        },
        options: {
          scales: { yAxes: [{ ticks: { beginAtZero: false } }]},
          legend: { display: false }
        }
      });
    </script>
    <!-- bootstrap-datepicker -->
    <script>$('.datepicker').datepicker({ language: 'ja' })</script>
  </body>
</html>
