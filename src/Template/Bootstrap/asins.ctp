        <!-- Main contents -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2"><?= __('ASINリスト') ?></h1>
          </div>

          <div class="container">
            <div class="row">
              <h3><?= __('ASIN一覧') ?></h3>
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('asin') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('ean') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('upc') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('isbn') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('marketplace') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('suspended') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                  </tr>
                  <tr>
                    <th>#</th>
                    <th>ASIN</th>
                    <th>EAN</th>
                    <th>UPC</th>
                    <th>ISBN</th>
                    <th>マーケットプレイス</th>
                    <th>禁止フラグ</th>
                    <th>登録日</th>
                    <th>更新日</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($asins as $asin): ?>
                  <tr>
                    <td><?= $this->Number->format($asin->id) ?></td>
                    <td><?= h($asin->asin) ?></td>
                    <td><?= h($asin->ean) ?></td>
                    <td><?= h($asin->upc) ?></td>
                    <td><?= h($asin->isbn) ?></td>
                    <td><?= h($asin->marketplace) ?></td>
                    <td><?= h($asin->suspended) ?></td>
                    <td><?= h($asin->created) ?></td>
                    <td><?= h($asin->modified) ?></td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
              <nav aria-label="Page navigarion">
                <ul class="pagination justify-content-center">
                  <?= $this->Paginator->first(__('最初')) ?>
                  <?= $this->Paginator->prev(__('前へ')) ?>
                  <?= $this->Paginator->numbers() ?>
                  <?= $this->Paginator->next(__('次へ')) ?>
                  <?= $this->Paginator->last(__('最後')) ?>
                </ul>
                <p><?= $this->Paginator->counter(['format' => __('{{page}}ページ  / {{current}}アイテム,（全{{pages}}ページ / 全{{count}}アイテム）')]) ?> </p>
              </nav>
            </div>
          </div>

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
