<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name"viewport" content="width=device-width, maximum-scale=1.0, minimum-scale=0.5,user-scalable=yes,initial-scale=1.0" />
  <title><?= h($title) ?></title>
  <?= $this->Html->css(['//stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css']) ?>
  <link rel="stylesheet" href="/chouhi<?= $this->Elixir->version('css/watchnote.css') ?>">
  <?= $this->Html->script([
      '//code.jquery.com/jquery-3.3.1.slim.min.js'
    , '//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js'
    , '//stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js'
    ]) ?>
  <script src="/chouhi<?= $this->Elixir->version('js/watchnote.js') ?>"></script>
</head>
<body>
  <div class="header">
    <p class="logo"><?= env('APP_NAME') ?></p>
  </div>
  <h1><?= h($title) ?></h1>

  <?= $this->fetch('content') ?>
  
  <div class="footer">
    <small>&copy; 2018 <?= env('APP_NAME') ?></small>
  </div>
</body>
</html>
