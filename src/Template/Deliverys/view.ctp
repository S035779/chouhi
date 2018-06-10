<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Delivery $delivery
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Delivery'), ['action' => 'edit', $delivery->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Delivery'), ['action' => 'delete', $delivery->id], ['confirm' => __('Are you sure you want to delete # {0}?', $delivery->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Deliverys'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Delivery'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="deliverys view large-9 medium-8 columns content">
    <h3><?= h($delivery->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Method') ?></th>
            <td><?= h($delivery->method) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Area') ?></th>
            <td><?= h($delivery->area) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($delivery->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Price') ?></th>
            <td><?= $this->Number->format($delivery->price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Length') ?></th>
            <td><?= $this->Number->format($delivery->length) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Total Length') ?></th>
            <td><?= $this->Number->format($delivery->total_length) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Weight') ?></th>
            <td><?= $this->Number->format($delivery->weight) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Duedate') ?></th>
            <td><?= $this->Number->format($delivery->duedate) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($delivery->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($delivery->modified) ?></td>
        </tr>
    </table>
</div>
