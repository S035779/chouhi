<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Offer $offer
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $offer->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $offer->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Offers'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="offers form large-9 medium-8 columns content">
    <?= $this->Form->create($offer) ?>
    <fieldset>
        <legend><?= __('Edit Offer') ?></legend>
        <?php
            echo $this->Form->control('asin');
            echo $this->Form->control('availability');
            echo $this->Form->control('average_feedback_rating');
            echo $this->Form->control('condition_status');
            echo $this->Form->control('condition_status_note');
            echo $this->Form->control('country');
            echo $this->Form->control('exchange_identifier');
            echo $this->Form->control('is_eligible_for_supersaver_shipping');
            echo $this->Form->control('offer_listing_identifier');
            echo $this->Form->control('price');
            echo $this->Form->control('price_currency');
            echo $this->Form->control('state');
            echo $this->Form->control('sub_condition_status');
            echo $this->Form->control('total_feedback');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
