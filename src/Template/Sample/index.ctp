<!DOCTYPE html>
<html lang="ja">
<head><meta charset="UTF-8"><title>Sample page index</title></head>
<body>
  <p>Hello CakePHP3!!</p>
  <dl>
  <dt><?= h($maxim_en) ?></dt>
  <dt><?= h($maxim_jp) ?></dt>
  <dt><?= h($maxim_person) ?></dt>
  </dl>
  <?php
    $num=1;
    echo $this->Status->get_fw_name($num);
  ?>
</body>
</html>
