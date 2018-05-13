<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Submission $submission
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $submission->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $submission->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Submission'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="submission form large-9 medium-8 columns content">
    <?= $this->Form->create($submission) ?>
    <fieldset>
        <legend><?= __('Edit Submission') ?></legend>
        <?php
            echo $this->Form->control('student_name');
            echo $this->Form->control('affiliation');
            echo $this->Form->control('issue_name');
            echo $this->Form->control('file_name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
