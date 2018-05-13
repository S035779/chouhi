<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Submission $submission
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Submission'), ['action' => 'edit', $submission->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Submission'), ['action' => 'delete', $submission->id], ['confirm' => __('Are you sure you want to delete # {0}?', $submission->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Submission'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Submission'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="submission view large-9 medium-8 columns content">
    <h3><?= h($submission->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Student Name') ?></th>
            <td><?= h($submission->student_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Affiliation') ?></th>
            <td><?= h($submission->affiliation) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Issue Name') ?></th>
            <td><?= h($submission->issue_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('File Name') ?></th>
            <td><?= h($submission->file_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($submission->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($submission->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($submission->modified) ?></td>
        </tr>
    </table>
</div>
