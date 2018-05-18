<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Asin[]|\Cake\Collection\CollectionInterface $asins
 */
?>
<!-- Main menu -->
<nav class="col-md-2 d-none d-md-block bg-light sidebar">
  <div class="sidebar-sticky">

    <ul class="nav flex-column">
      <li class="nav-item">
        <?= $this->Html->link(
          $this->Html->tag('span', '', ['data-feather' => 'home'])
          . ' ASIN一覧 ' .
          $this->Html->tag('span', '(current)', ['class' => 'sr-only'])
        , ['controller' => 'Asins', 'action' => 'index']
        , ['escape' => false, 'class' => 'nav-link active']
        ) ?>
      </li>
      <li class="nav-item">
        <?= $this->Html->link(
          $this->Html->tag('span', '', ['data-feather' => 'file'])
          . ' ASIN追加 '
        , ['controller' => 'Asins', 'action' => 'add']
        , ['escape' => false, 'class' => 'nav-link']
        ) ?>
      </li>
    </ul>

  </div>
</nav>

<!-- Main contens -->
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><?= __('ASIN管理マスタ') ?></h1>
  </div>

  <div class="container">
    <div class="row">
      <h3><?= __('ASIN一覧') ?></h3>
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col"><?= $this->Paginator->sort('id') ?></th>
            <th scope="col"><?= $this->Paginator->sort('asin') ?></th>
            <th scope="col"><?= $this->Paginator->sort('marketplace') ?></th>
            <th scope="col"><?= $this->Paginator->sort('created') ?></th>
            <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
            <th scope="col"><?= $this->Paginator->sort('suspended') ?></th>
            <th scope="col" class="actions"><?= __('Actions') ?></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($asins as $asin): ?>
          <tr>
            <td><?= $this->Number->format($asin->id) ?></td>
            <td><?= h($asin->asin) ?></td>
            <td><?= h($asin->marketplace) ?></td>
            <td><?= h($asin->created) ?></td>
            <td><?= h($asin->modified) ?></td>
            <td><?= h($asin->suspended) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $asin->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $asin->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $asin->id], ['confirm' => __('Are you sure you want to delete # {0}?', $asin->id)]) ?>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <?php
        $this->Paginator->setTemplates([
          'number'        =>
            '<li class="page-item">
              <a class="page-link" href="{{url}}">{{text}}</a>
            </li>'
        , 'first'         =>
            '<li class="page-item">
              <a class="page-link" href="{{url}}">{{text}}</a>
            </li>'
        , 'prevActive'    =>
            '<li class="page-item">
              <a class="page-link" href="{{url}}">{{text}}</a>
            </li>'
        , 'prevDisabled'   =>
            '<li class="page-item disabled">
              <a class="page-link" href="{{url}}" tabindex="-1">{{text}}</a>
            </li>'
        , 'nextActive'    =>
            '<li class="page-item">
              <a class="page-link" href="{{url}}">{{text}}</a>
            </li>'
        , 'nextDisabled'  =>
            '<li class="page-item disabled">
              <a class="page-link" href="{{url}}" tabindex="-1">{{text}}</a>
            </li>'
        , 'last'          =>
            '<li class="page-item">
              <a class="page-link" href="{{url}}">{{text}}</a>
            </li>'
        , 'current'  =>
            '<li class="page-item active">
              <a class="page-link" href="{{url}}">{{text}}
               <span class="sr-only">(current)</span></a>
            </li>'
        ]);
      ?>
      <nav aria-label="Page navigation">
        <ul class="pagination">
          <?= $this->Paginator->first(__('first'))    ?>
          <?= $this->Paginator->prev(__('previous'))  ?>
          <?= $this->Paginator->numbers()             ?>
          <?= $this->Paginator->next(__('next'))      ?>
          <?= $this->Paginator->last(__('last'))      ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
      </nav>

    </div>
  </div>
</main>
