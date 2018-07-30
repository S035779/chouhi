<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Offer $offer
 */
?>
<!-- Main menu -->
<nav class="col-md-2 d-none d-md-block bg-light sidebar">
  <div class="sidebar-sticky">

    <ul class="nav flex-column">
      <li class="nav-item">
        <?= $this->Form->postLink(
          $this->Html->tag('span', '', ['data-feather' => 'file'])
          . __(' 商品削除 ')
        , ['controller' => 'Offers', 'action' => 'delete', $offer->id]
        , ['confirm' => __('Are you sure you want to delete # {0}?', $offer->id)
          , 'escape' => false, 'class' => 'nav-link']
        ) ?>
      </li>
      <li class="nav-item">
        <?= $this->Html->link(
          $this->Html->tag('span', '', ['data-feather' => 'home'])
          . __(' 商品一覧 ') .
          $this->Html->tag('span', '(current)', ['class' => 'sr-only'])
          , ['controller' => 'Offers', 'action' => 'index']
          , ['escape' => false, 'class' => 'nav-link active']
        ) ?>
      </li>
      <li class="nav-item">
        <?= $this->Html->link(
          $this->Html->tag('span', '', ['data-feather' => 'file'])
          . __(' 商品追加 ')
        , ['controller' => 'Offers', 'action' => 'add']
        , ['escape' => false, 'class' => 'nav-link']
        ) ?>
      </li>
    </ul>

  </div>
</nav>

<!-- Main contents -->
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><?= __('商品管理マスタ') ?></h1>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-md-8 order-md-1">

        <?= $this->Form->create($offer) ?>
        <fieldset>
            <legend><?= __('商品編集') ?></legend>
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
                echo $this->Form->control('total_reviews');
                echo $this->Form->control('average_rating');
                echo $this->Form->control('total_votes');
                echo $this->Form->control('customer_reviews_url');
            ?>
        </fieldset>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>

      </div>
    </div>
  </div>
</main>
