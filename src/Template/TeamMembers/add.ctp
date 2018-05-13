<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TeamMember $teamMember
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Team Members'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="teamMembers form large-9 medium-8 columns content">
    <?= $this->Form->create($teamMember) ?>
    <fieldset>
        <legend><?= __('Add Team Member') ?></legend>
        <?php
            echo $this->Form->control('username');
            echo $this->Form->control('email');
            echo $this->Form->control('password');
            echo $this->Form->control('deleted', ['empty' => true]);
            echo $this->Form->control('last_login_at', ['empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
