<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Offer[]|\Cake\Collection\CollectionInterface $offers
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Offer'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="offers index large-9 medium-8 columns content">
    <h3><?= __('Offers') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('asin') ?></th>
                <th scope="col"><?= $this->Paginator->sort('availability') ?></th>
                <th scope="col"><?= $this->Paginator->sort('average_feedback_rating') ?></th>
                <th scope="col"><?= $this->Paginator->sort('condition_status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('condition_status_note') ?></th>
                <th scope="col"><?= $this->Paginator->sort('country') ?></th>
                <th scope="col"><?= $this->Paginator->sort('exchange_identifier') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_eligible_for_supersaver_shipping') ?></th>
                <th scope="col"><?= $this->Paginator->sort('offer_listing_identifier') ?></th>
                <th scope="col"><?= $this->Paginator->sort('price') ?></th>
                <th scope="col"><?= $this->Paginator->sort('price_currency') ?></th>
                <th scope="col"><?= $this->Paginator->sort('state') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sub_condition_status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('total_feedback') ?></th>
                <th scope="col"><?= $this->Paginator->sort('seller_identifier') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($offers as $offer): ?>
            <tr>
                <td><?= $this->Number->format($offer->id) ?></td>
                <td><?= h($offer->asin) ?></td>
                <td><?= h($offer->availability) ?></td>
                <td><?= $this->Number->format($offer->average_feedback_rating) ?></td>
                <td><?= h($offer->condition_status) ?></td>
                <td><?= h($offer->condition_status_note) ?></td>
                <td><?= h($offer->country) ?></td>
                <td><?= h($offer->exchange_identifier) ?></td>
                <td><?= h($offer->is_eligible_for_supersaver_shipping) ?></td>
                <td><?= h($offer->offer_listing_identifier) ?></td>
                <td><?= $this->Number->format($offer->price) ?></td>
                <td><?= h($offer->price_currency) ?></td>
                <td><?= h($offer->state) ?></td>
                <td><?= h($offer->sub_condition_status) ?></td>
                <td><?= $this->Number->format($offer->total_feedback) ?></td>
                <td><?= h($offer->seller_identifier) ?></td>
                <td><?= $this->Number->format($offer->item_id) ?></td>
                <td><?= h($offer->created) ?></td>
                <td><?= h($offer->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $offer->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $offer->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $offer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $offer->id)]) ?>
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
