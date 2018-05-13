<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TeamMember $teamMember
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Team Member'), ['action' => 'edit', $teamMember->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Team Member'), ['action' => 'delete', $teamMember->id], ['confirm' => __('Are you sure you want to delete # {0}?', $teamMember->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Team Members'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Team Member'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="teamMembers view large-9 medium-8 columns content">
    <h3><?= h($teamMember->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Username') ?></th>
            <td><?= h($teamMember->username) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($teamMember->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Password') ?></th>
            <td><?= h($teamMember->password) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($teamMember->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Deleted') ?></th>
            <td><?= h($teamMember->deleted) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last Login At') ?></th>
            <td><?= h($teamMember->last_login_at) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($teamMember->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($teamMember->modified) ?></td>
        </tr>
    </table>
</div>
