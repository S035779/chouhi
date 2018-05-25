<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Offer $offer
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Offer'), ['action' => 'edit', $offer->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Offer'), ['action' => 'delete', $offer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $offer->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Offers'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Offer'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="offers view large-9 medium-8 columns content">
    <h3><?= h($offer->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Asin') ?></th>
            <td><?= h($offer->asin) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Availability') ?></th>
            <td><?= h($offer->availability) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Condition Status') ?></th>
            <td><?= h($offer->condition_status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Condition Status Note') ?></th>
            <td><?= h($offer->condition_status_note) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Country') ?></th>
            <td><?= h($offer->country) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Exchange Identifier') ?></th>
            <td><?= h($offer->exchange_identifier) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Offer Listing Identifier') ?></th>
            <td><?= h($offer->offer_listing_identifier) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Price Currency') ?></th>
            <td><?= h($offer->price_currency) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('State') ?></th>
            <td><?= h($offer->state) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sub Condition Status') ?></th>
            <td><?= h($offer->sub_condition_status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($offer->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Average Feedback Rating') ?></th>
            <td><?= $this->Number->format($offer->average_feedback_rating) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Price') ?></th>
            <td><?= $this->Number->format($offer->price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Total Feedback') ?></th>
            <td><?= $this->Number->format($offer->total_feedback) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($offer->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($offer->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Eligible For Supersaver Shipping') ?></th>
            <td><?= $offer->is_eligible_for_supersaver_shipping ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
