        <!-- Main contens -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2"><?= __('商品検索') ?></h1>
          </div>

          <div class="container">
            <div class="row">
              <div class="col-md-12 order-md-1">
              <h4 class="mb-3"><?= __('検索条件') ?></h4>
                <?= $this->Form->create(null, [
                  'url' => ['controller' => 'Bootstrap', 'action' => 'search']
                , 'class' => 'needs-validation'
                , 'novalidate' => true
                ]) ?>

                  <div class="mb-3">
                    <label for="period"><?= __('平均価格日数（日数）') ?></label>
                    <?= $this->Form->text('period', [
                      'required' => true
                    , 'class' => 'form-control'
                    , 'placeholder' => 'Input the target period'
                    ]) ?>
                    <div class="invalid-feedback">
                      Please enter a valid target period.
                    </div>
                  </div>

                  <div class="mb-3">
                    <label for="rise_rate"><?= __('上昇率（％）') ?></label>
                    <?= $this->Form->text('rise_rate', [
                      'required' => true
                    , 'class' => 'form-control'
                    , 'placeholder' => 'Input price rise rate'
                    ]) ?>
                    <div class="invalid-feedback">
                      Please enter a valid price rise rate.
                    </div>
                  </div>

                  <div class="mb-3">
                    <label for="profit_range"><?= __('利益幅（円）') ?></label>
                    <?= $this->Form->text('profit_range', [
                      'required' => true
                    , 'class' => 'form-control'
                    , 'placeholder' => 'Input profit range'
                    ]) ?>
                    <div class="invalid-feedback">
                      Please enter a valid profit range.
                    </div>
                  </div>

                  <hr class="mb-4">

                  <div class="mb-3">
                    <?= $this->Form->button(__('検索'), [
                      'class' => 'btn btn-primary btn-lg btn-block'
                    ]) ?>
                  </div>
                </form>
                <?= $this->Form->end() ?>

                <?php foreach ($offers as $offer): ?>
                <h4 class="mb-3">検索結果</h4>

                <div class="card mb-3">
                  <div class="card-header"><?= h($offer['title']) ?></div>
                  <div class="card-body p-2">
                    <div class="card-group">
                    <div class="col-sm-4">
                      <div class="card">
                      <img class="card-img-top" src="//dyn.keepa.com/pricehistory.png?cAmazon=0f5702&cNew=77ce43&cUsed=f26e3c&cFont=31393d&cBackground=ffffff&amazon=1&new=1&used=1&range=90&salesrank=1&domain=co.jp&width=512&height=480&asin=<?= h($offer['asin']) ?>"
                        alt="<?= h($offer['title']) ?>">
                        <div class="card-body p-2">
                          <div class="btn-group d-flex" role="group"
                            aria-label="button-group">
                            <a role="button" class="btn btn-primary w-100"
                              href="//www.mnrate.com/item/aid/<?= h($offer['asin']) ?>" 
                              target="_blank">
                              <?= __('MO') ?>
                            </a>
                            <a role="button" class="btn btn-primary w-100" 
                              href="//sellercentral.amazon.co.jp/hz/fba/profitabilitycalculator/index?lang=ja_JP" 
                              target="_blank">
                              <?= __('FB') ?>
                            </a>
                            <a role="button" class="btn btn-primary w-100" 
                              href="<?= h($offer['detail_page_url']) ?>" 
                              target="_blank">
                              <?= __('AM') ?>
                            </a>
                            <button type="button" class="btn btn-primary w-100"
                              data-toggle="popover"
                              data-content-id="#popover<?= h($offer['id']) ?>">
                              <?= __('詳') ?>
                            </button>
                          </div>
                        </div>
                        <div class="card hidden" id="popover<?= h($offer['id']) ?>">
                          <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                              <?=
                                __('出品者数（新品 : ').$this->Number->format($offer['total_new'])
                              . __('／中古 : ').$this->Number->format($offer['total_used'])
                              . __('）')
                              ?>
                            </li>
                            <li class="list-group-item">
                              <?= __('更新日').__(' : ')
                                .h(date("Y年m月d日 H時i分s秒", strtotime($offer['created']))) ?>
                            </li>
                            <li class="list-group-item">
                              <a role="button"
                                class="btn btn-primary w-100" 
                                href="<?= h($offer['customer_reviews_url']) ?>" target="_blank">
                                <?= __('カスタマー・レビュー') ?>
                              </a>
                            </li>
                            <li class="list-group-item">
                              <?=
                                __('平均ランキング : ') 
                              . $this->Number->format($offer['average_sales_ranking']
                                , ['places' => 0, 'precision' => 0])
                              ?>
                            </li>
                            <li class="list-group-item">
                              <?= __('カテゴリー').__(' : ').h($offer['product_group']) ?>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="card">
                      <ul class="list-group list-group-flush">
                        <li class="list-group-item"><?= 
                          __('ランキング').__(' : ')
                            .$this->Number->format($offer['sales_ranking'])
                        ?></li>
                        <li class="list-group-item"><?= 
                          __('ASIN')
                            .__(' : ').h($offer['asin']) 
                        ?></li>
                        <li class="list-group-item"><?= 
                          __('価格').__(' : ').$this->Number->currency(
                            $offer['lowest_price']
                          , $offer['lowest_price_currency']
                          )
                        ?></li>
                        <li class="list-group-item"><?= 
                          __('平均価格').__(' : ').$this->Number->currency(
                            $offer['average_lowest_price']
                          , $offer['average_lowest_price_currency']
                          ) 
                        ?></li>
                        <li class="list-group-item"><?= 
                          __('価格差').__(' : ').$this->Number->currency(
                            $offer['average_lowest_price'] - $offer['lowest_price']
                          , $offer['lowest_price_currency']
                          ) 
                        ?></li>
                        <li class="list-group-item"><?= 
                          __('発売日')
                            .__(' : ')
                            .h(strtotime($offer['original_release_date_at']) !== 0
                                ? date("Y年m月d日"
                                  , strtotime($offer['original_release_date_at'])) 
                                : ( strtotime($offer['release_date_at']) !== 0
                                  ? date("Y年m月d日"
                                    , strtotime($offer['release_date_at']))
                                  : ( strtotime($offer['publication_date_at']) !== 0
                                    ? date("Y年m月d日"
                                      , strtotime($offer['publication_date_at']))
                                    : '不明') ) )
                        ?></li>
                      </ul>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="card">
                      <img class="card-img" src="<?= h($offer['large_image_url']) ?>"
                        alt="<?= h($offer['title']) ?>">
                      </div>
                    </div>
                    </div>
                  </div>
                </div>
                <?php endforeach; ?>

              </div>
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
    <!-- Validation check -->
    <script>
    (function() {
      'use strict';
      window.addEventListener('load', function() {
        var forms = document.getElementsByClassName('needs-validation');
        var validation = Array.prototype.filter.call(forms
          , function(form) {
          form.addEventListener('submit', function(event) {
            if(form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    })();
    </script>
    <!-- Popvers -->
    <script>
    $(function () {
      $('[data-toggle="popover"]').popover({
        html: true
      , container: 'body'
      , title: '商品詳細'
      , content: function() { return $($(this).data('content-id')).html(); }
      });
    });
    </script>
