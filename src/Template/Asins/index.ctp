<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Asin[]|\Cake\Collection\CollectionInterface $asins
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Asin'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="asins index large-9 medium-8 columns content">
    <h3><?= __('Asins') ?></h3>
    <table cellpadding="0" cellspacing="0">
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
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
