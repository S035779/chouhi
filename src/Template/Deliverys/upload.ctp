<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Delivery[]|\Cake\Collection\CollectionInterface $deliverys
 */
?>
<!-- Main menu -->
<nav class="col-md-2 d-none d-md-block bg-light sidebar">
  <div class="sidebar-sticky">
    <ul class="nav flex-column">
      <li class="nav-item">
        <?= $this->Html->link(
          $this->Html->tag('span', '', ['data-feather' => 'home'])
          . __(' 配送料一覧 ') .
          $this->Html->tag('span', '(current)', ['class' => 'sr-only'])
        , ['controller' => 'Deliverys', 'action' => 'index']
        , ['escape' => false, 'class' => 'nav-link active']
        ) ?>
      </li>
      <li class="nav-item">
        <?= $this->Html->link(
          $this->Html->tag('span', '', ['data-feather' => 'file'])
          . __(' 配送料追加 ')
        , ['controller' => 'Deliverys', 'action' => 'add']
        , ['escape' => false, 'class' => 'nav-link']
        ) ?>
      </li>
      <li class="nav-item">
        <?= $this->Html->link(
          $this->Html->tag('span', '', ['data-feather' => 'upload'])
          . __(' アップロード ')
        , ['controller' => 'Deliverys', 'action' => 'upload']
        , ['escape' => false, 'class' => 'nav-link']
        ) ?>
      </li>
      <li class="nav-item">
        <?= $this->Form->postLink(
          $this->Html->tag('span', '', ['data-feather' => 'download'])
          . __(' ダウンロード ')
        , ['controller' => 'Deliverys', 'action' => 'download']
        , ['escape' => false, 'class' => 'nav-link', 'confirm' => __('Are you sure you want to download ?')]
        ) ?>
      </li>
    </ul>
  </div>
</nav>

<!-- Main contens -->
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">配送料登録</h1>
  </div>

  <div class="container" id="deliverys">
    <div class="row">
      <div class="col-md-4 order-md-2 mb-4">
      </div>
      <div class="col-md-8 order-md-1">
        <h4 class="mb-3">ファイルアップロード</h4>
        <?= $this->Form->create($fileform, [
          'type'        => 'file'
        , 'url'         => [ 'controler' => 'Bootstrap', 'action'=> 'upload' ]
        , 'class'       => 'needs-validation'
        , 'novalidate'  => true
        ])?>

          <div class="mb-3 form-group">
            <?= $this->Form->control('upload_file',[
              'type'      => 'file'
            , 'label'     => 'CSVファイル'
            , 'required'  => true
            , 'class'     => 'form-control-file'
            ]) ?>
            <div class="invalid-feedback">
              Please select a valid CSV file.
            </div>
          </div>

          <hr class="mb-4">
          <?= $this->Form->button('登録する', [
            'class' => 'btn btn-primary btn-lg btn-block'
          , 'id' => 'submit'
          ]) ?>
        <?= $this->Form->end() ?>
      </div>
    </div>
  </div>
</main>
