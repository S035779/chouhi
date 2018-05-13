<dl>
  <dt>
    <?= h($response['OperationRequest']['HTTPHeaders']['Header']['@attributes']['Name']) ?>
  </dt>
  <dd>
    <?= h($response['OperationRequest']['HTTPHeaders']['Header']['@attributes']['Value']) ?>
  </dd>
</dl>
<?php var_dump($response); ?>
