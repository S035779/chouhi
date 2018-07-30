<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Item $item
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
        , ['controller' => 'Items', 'action' => 'delete', $item->id]
        , ['confirm' => __('Are you sure you want to delete # {0}?', $item->id)
          , 'escape' => false, 'class' => 'nav-link']
        ) ?>
      </li>
      <li class="nav-item">
        <?= $this->Html->link(
          $this->Html->tag('span', '', ['data-feather' => 'home'])
          . __(' 商品一覧 ') .
          $this->Html->tag('span', '(current)', ['class' => 'sr-only'])
        , ['controller' => 'Items', 'action' => 'index']
        , ['escape' => false, 'class' => 'nav-link active']
        ) ?>
      </li>
      <li class="nav-item">
        <?= $this->Html->link(
          $this->Html->tag('span', '', ['data-feather' => 'file'])
          . __(' 商品追加 ')
        , ['controller' => 'Items', 'action' => 'add']
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

        <?= $this->Form->create($item) ?>
        <fieldset>
          <legend><?= __('商品編集') ?></legend>
          <?php
            echo $this->Form->control('asin');
            echo $this->Form->control('title');
            echo $this->Form->control('is_eligible_prime');
            echo $this->Form->control('is_eligible_for_supersaver_shipping');
            echo $this->Form->control('item_height');
            echo $this->Form->control('item_length');
            echo $this->Form->control('item_weight');
            echo $this->Form->control('item_width');
            echo $this->Form->control('package_height');
            echo $this->Form->control('package_length');
            echo $this->Form->control('package_weight');
            echo $this->Form->control('package_width');
            echo $this->Form->control('list_price');
            echo $this->Form->control('list_price_currency');
            echo $this->Form->control('lowest_price');
            echo $this->Form->control('lowest_price_currency');
            echo $this->Form->control('lowest_used_price');
            echo $this->Form->control('lowest_used_price_currency');
            echo $this->Form->control('lowest_collectible_price');
            echo $this->Form->control('lowest_collectible_price_currency');
            echo $this->Form->control('offer_listing_price');
            echo $this->Form->control('offer_listing_price_currency');
            echo $this->Form->control('offer_listing_saved_price');
            echo $this->Form->control('offer_listing_saved_price_currency');
            echo $this->Form->control('ean');
            echo $this->Form->control('release_date_at');
            echo $this->Form->control('publication_date_at');
            echo $this->Form->control('original_release_date_at');
            echo $this->Form->control('condition_status');
            echo $this->Form->control('product_group');
            echo $this->Form->control('quantity');
            echo $this->Form->control('quantity_allocated');
            echo $this->Form->control('status');
            echo $this->Form->control('marketplace');
            echo $this->Form->control('detail_page_url');
            echo $this->Form->control('small_image_url');
            echo $this->Form->control('medium_image_url');
            echo $this->Form->control('large_image_url');
            echo $this->Form->control('total_new');
            echo $this->Form->control('total_used');
            echo $this->Form->control('total_collectible');
            echo $this->Form->control('total_refurbished');
          ?>
        </fieldset>
        <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>

      </div>
    </div>
  </div>
</main>
