        <!-- Main contens -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2"><?= __('マーケット出品') ?></h1>
          </div>


      <div class="container">
        <div class="row">
          <h3><?= __('マーケット出品一覧') ?></h3>

          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('seller_sku') ?></th>
                <th scope="col"><?= $this->Paginator->sort('product_identifier') ?></th>
                <th scope="col"><?= $this->Paginator->sort('product-id-type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('price') ?></th>
                <th scope="col"><?= $this->Paginator->sort('minimum_seller_allowed_price') ?></th>
                <th scope="col"><?= $this->Paginator->sort('maximum_seller_allowed_price') ?></th>
                <th scope="col"><?= $this->Paginator->sort('marketplace') ?></th>
                <th scope="col"><?= $this->Paginator->sort('shippintg_amount_1') ?></th>
                <th scope="col"><?= $this->Paginator->sort('shippintg_amount_2') ?></th>
                <th scope="col"><?= $this->Paginator->sort('shippintg_amount_3') ?></th>
                <th scope="col"><?= $this->Paginator->sort('shippintg_amount_4') ?></th>
                <th scope="col"><?= $this->Paginator->sort('shippintg_amount_5') ?></th>
                <th scope="col"><?= $this->Paginator->sort('shippintg_amount_6') ?></th>
                <th scope="col"><?= $this->Paginator->sort('item_condition') ?></th>
                <th scope="col"><?= $this->Paginator->sort('quantity') ?></th>
                <th scope="col"><?= $this->Paginator->sort('will_ship_internationally') ?></th>
                <th scope="col"><?= $this->Paginator->sort('expedited_shipping') ?></th>
                <th scope="col"><?= $this->Paginator->sort('standard_plus') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fulfillment_channel') ?></th>
                <th scope="col"><?= $this->Paginator->sort('product_tax_code') ?></th>
                <th scope="col"><?= $this->Paginator->sort('leadtime_to_ship') ?></th>
              </tr>
              <tr>
                <th>#</th>
                <th>商品管理番号</th>
                <th>商品番号</th>
                <th>商品番号タイプ</th>
                <th>商品価格</th>
                <th>指定最低価格</th>
                <th>指定最高価格</th>
                <th>マーケットプレイス</th>
                <th>送料1</th>
                <th>送料2</th>
                <th>送料3</th>
                <th>送料4</th>
                <th>送料5</th>
                <th>送料6</th>
                <th>商品状態</th>
                <th>商品在庫</th>
                <th>国際発送</th>
                <th>緊急配送</th>
                <th>標準配送プラス</th>
                <th>FBA利用</th>
                <th>TAXコード</th>
                <th>発送リードタイム</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($merchants as $merchant): ?>
              <tr>
                <th><?= $this->Number->format($merchant->id) ?></th>
                <td><?= h($merchant->seller_sku) ?></td>
                <td><?= h($merchant->product_identifier) ?></td>
                <td><?= $this->Number->format($merchant->product_id_type) ?></td>
                <td><?= $this->Number->currency($merchant->price
                  , $merchant->marketplace === 'AU' ? 'AUD' 
                    : ($merchant->marketplace === 'US' ? 'USD' 
                      : ($merchant->marketplace === 'JP' ? 'JPY' : 'JPY'))) ?></td>
                <td><?= $this->Number->format($merchant->minimum_seller_allowed_price) ?></td>
                <td><?= $this->Number->format($merchant->maximum_seller_allowed_price) ?></td>
                <td><?= h($merchant->marketplace) ?></td>
                <td><?= $this->Number->format($merchant->shipping_amount_1) ?></td>
                <td><?= $this->Number->format($merchant->shipping_amount_2) ?></td>
                <td><?= $this->Number->format($merchant->shipping_amount_3) ?></td>
                <td><?= $this->Number->format($merchant->shipping_amount_4) ?></td>
                <td><?= $this->Number->format($merchant->shipping_amount_5) ?></td>
                <td><?= $this->Number->format($merchant->shipping_amount_6) ?></td>
                <td><?= h($merchant->item_condition) ?></td>
                <td><?= $this->Number->format($merchant->quantity) ?></td>
                <td><?= $this->Number->format($merchant->will_ship_internationally) ?></td>
                <td><?= h($merchant->expedited_shipping) ?></td>
                <td><?= h($merchant->standard_plus) ?></td>
                <td><?= h($merchant->fullfillment_channel) ?></td>
                <td><?= h($merchant->product_tax_code) ?></td>
                <td><?= $this->Number->format($merchant->leadtime_to_ship) ?></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
          <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
              <?= $this->Paginator->first(__('最初')) ?>
              <?= $this->Paginator->prev(__('前へ')) ?>
              <?= $this->Paginator->numbers() ?>
              <?= $this->Paginator->next(__('次へ')) ?>
              <?= $this->Paginator->last(__('最後')) ?>
            </ul>
            <p><?= $this->Paginator->counter(['format' => __('{{page}}ページ  / {{current}}アイテム,（全{{pages}}ページ / 全{{count}}アイテム）')]) ?> </p>
          </nav>

        </main>
      </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <?= $this->Html->script([
        '//code.jquery.com/jquery-3.3.1.slim.min.js'
      , '//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js'
      , '//stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js'
      , '//unpkg.com/feather-icons/dist/feather.min.js'
      , $this->Elixir->version('js/watchnote.js')
      ]) ?>
    <!-- Icons -->
    <script>feather.replace()</script>
