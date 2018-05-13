<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name"viewport" content="width=device-width, maximum-scale=1.0, minimum-scale=0.5,user-scalable=yes,initial-scale=1.0" />
  <title><?= h($title) ?></title>
  <?php
  echo $this->Html->css('reset.css');
  echo $this->Html->css('common.css');
  echo $this->Html->css('samples/index.css');
  ?>
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
