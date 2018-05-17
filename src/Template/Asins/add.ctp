<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Asin $asin
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Asins'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="asins form large-9 medium-8 columns content">
    <?= $this->Form->create($asin) ?>
    <fieldset>
        <legend><?= __('Add Asin') ?></legend>
        <?php
            echo $this->Form->control('asin');
            echo $this->Form->control('marketplace');
            echo $this->Form->control('suspended');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
