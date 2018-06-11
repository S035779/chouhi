        <!-- Main contens -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2"><?= __('販売価格設定') ?></h1>
          </div>

          <div class="container">
            <div class="row mb-4">
              <div class="col-md-12 order-md-1">
                <?= $this->Form->create($ship, [
                  'url' => ['controller' => 'Bootstrap', 'action' => 'calculation']
                , 'class' => 'needs-validation', 'novalidate' => true
                ]) ?>

                  <h4 class="mb-3"><?= __('単位設定') ?></h4>

                  <div class="form-group row mb-3">
                    <label for="jp_length"
                      class="col-sm-4 col-form-label">
                      <?= __('日本 (mm/kg) =') ?></label>
                    <label for="jp_length"
                      class="col-sm-1 col-form-label"><?= __('長さ') ?></label>
                    <div class="col-sm-2">
                      <?= $this->Form->text('jp_length', [
                        'required' => true
                      , 'class'    => 'form-control'
                      , 'id'       => 'jp_length'
                      , 'placeholder' => '1'
                      ]) ?>
                      <div class="invalid-feedback">
                        Please enter a valid length value.
                      </div>
                    </div>
                    <label for="jp_length"
                      class="col-form-label col-sm-1"><?= __('mm') ?></label>
                    <label for="jp_weight"
                      class="col-form-label col-sm-1"><?= __('重さ') ?></label>
                    <div class="col-sm-2">
                      <?= $this->Form->text('jp_weight', [
                        'required' => true
                      , 'class'    => 'form-control'
                      , 'id'       => 'jp_weight'
                      , 'placeholder' => '1.0'
                      ]) ?>
                      <div class="invalid-feedback">
                        Please enter a valid weight value.
                      </div>
                    </div>
                    <label for="jp_weight"
                      class="col-form-label col-sm-1"><?= __('kg') ?></label>
                  </div>

                  <div class="form-group row mb-3">
                    <label for="au_length"
                      class="col-sm-4 col-form-label">
                      <?= __('オーストラリア (inches/pounds) =') ?></label>
                    <label for="au_length"
                      class="col-sm-1 col-form-label"><?= __('長さ') ?></label>
                    <div class="col-sm-2">
                      <?= $this->Form->text('au_length', [
                        'required' => true
                      , 'class'    => 'form-control'
                      , 'id'       => 'au_length'
                      , 'placeholder' => '1'
                      ]) ?>
                      <div class="invalid-feedback">
                        Please enter a valid length value.
                      </div>
                    </div>
                    <label for="au_length"
                      class="col-form-label col-sm-1"><?= __('mm') ?></label>
                    <label for="au_weight"
                      class="col-form-label col-sm-1"><?= __('重さ') ?></label>
                    <div class="col-sm-2">
                      <?= $this->Form->text('au_weight', [
                        'required' => true
                      , 'class'    => 'form-control'
                      , 'id'       => 'au_weight'
                      , 'placeholder' => '1.0'
                      ]) ?>
                      <div class="invalid-feedback">
                        Please enter a valid weight value.
                      </div>
                    </div>
                    <label for="au_weight"
                      class="col-form-label col-sm-1"><?= __('kg') ?></label>
                  </div>

                  <div class="form-group row mb-3">
                    <label for="us_length"
                      class="col-sm-4 col-form-label">
                      <?= __('アメリカ (inches/pounds) =') ?></label>
                    <label for="us_length"
                      class="col-sm-1 col-form-label"><?= __('長さ') ?></label>
                    <div class="col-sm-2">
                      <?= $this->Form->text('us_length', [
                        'required' => true
                      , 'class'    => 'form-control'
                      , 'id'       => 'us_length'
                      , 'placeholder' => '1'
                      ]) ?>
                      <div class="invalid-feedback">
                        Please enter a valid length value.
                      </div>
                    </div>
                    <label for="us_length"
                      class="col-form-label col-sm-1"><?= __('mm') ?></label>
                    <label for="us_weight"
                      class="col-form-label col-sm-1"><?= __('重さ') ?></label>
                    <div class="col-sm-2">
                      <?= $this->Form->text('us_weight', [
                        'required' => true
                      , 'class'    => 'form-control'
                      , 'id'       => 'us_weight'
                      , 'placeholder' => '1.0'
                      ]) ?>
                      <div class="invalid-feedback">
                        Please enter a valid weight value.
                      </div>
                    </div>
                    <label for="us_weight"
                      class="col-form-label col-sm-1"><?= __('kg') ?></label>
                  </div>

                  <h4 class="mb-3"><?= __('為替設定') ?></h4>

                  <div class="form-group row mb-3">
                    <label for="jpy_price"
                      class="col-sm-4 col-form-label">
                      <?= __('日本円 (JPY) =') ?></label>
                    <div class="col-sm-4">
                      <?= $this->Form->text('jpy_price', [
                        'required' => true
                      , 'class'    => 'form-control'
                      , 'id'       => 'jpy_price'
                      , 'placeholder' => '1'
                      ]) ?>
                      <div class="invalid-feedback">
                        Please enter a valid jpy price.
                      </div>
                    </div>
                    <label for="jpy_price"
                      class="col-sm-4 col-form-label">
                      <?= __('円') ?></label>
                  </div>
                  <div class="form-group row mb-3">
                    <label for="aud_price"
                      class="col-sm-4 col-form-label">
                      <?= __('オーストラリアドル (AUD) =') ?></label>
                    <div class="col-sm-4">
                      <?= $this->Form->text('aud_price', [
                        'required' => true
                      , 'class'    => 'form-control'
                      , 'id'       => 'aud_price'
                      , 'placeholder' => '90'
                      ]) ?>
                      <div class="invalid-feedback">
                        Please enter a valid aud price.
                      </div>
                    </div>
                    <label for="aud_price"
                      class="col-sm-4 col-form-label">
                      <?= __('円') ?></label>
                  </div>
                  <div class="form-group row mb-3">
                    <label for="usd_price"
                      class="col-sm-4 col-form-label">
                      <?= __('アメリカドル (USD) =') ?></label>
                    <div class="col-sm-4">
                      <?= $this->Form->text('usd_price', [
                        'required' => true
                      , 'class'    => 'form-control'
                      , 'id'       => 'usd_price'
                      , 'placeholder' => '110'
                      ]) ?>
                      <div class="invalid-feedback">
                        Please enter a valid usd price.
                      </div>
                    </div>
                    <label for="usd_price"
                      class="col-sm-4 col-form-label">
                      <?= __('円') ?></label>
                  </div>

                  <h4 class="mb-3"><?= __('在庫数指定') ?></h4>

                  <div class="form-group row mb-3">
                    <label for="pending_quantity_rate"
                      class="col-sm-5 col-form-label">
                      <?= __('在庫数　＝　アマゾンでの在庫数') ?></label>
                    <label for="pending_quantity_rate"
                      class="col-sm-1 col-form-label"><?= __('✕') ?></label>
                    <div class="col-sm-2">
                      <?= $this->Form->text('pending_quantity_rate', [
                        'required' => true
                      , 'class'    => 'form-control'
                      , 'id'       => 'pending_quantity_rate'
                      , 'placeholder' => '100'
                      ]) ?>
                      <div class="invalid-feedback">
                        Please enter a valid quantity rate.
                      </div>
                    </div>
                    <label for="pending_quantity_rate"
                      class="col-form-label col-sm-1"><?= __('％') ?></label>
                    <label for="pending_quantity"
                      class="col-form-label col-sm-1"><?= __('＋') ?></label>
                    <div class="col-sm-2">
                      <?= $this->Form->text('pending_quantity', [
                        'required' => true
                      , 'class'    => 'form-control'
                      , 'id'       => 'pending_quantity'
                      , 'placeholder' => '0'
                      ]) ?>
                      <div class="invalid-feedback">
                        Please enter a valid quantity number.
                      </div>
                    </div>
                  </div>

                  <h4 class="mb-3"><?= __('価格判定') ?></h4>

                  <div class="form-group row mb-3">
                    <label for="price_criteria_1"
                      class="col-sm-4 col-form-label">
                      <?= __('アマゾンの購入額が') ?></label>
                    <div class="col-sm-4">
                      <?= $this->Form->text('price_criteria_1', [
                        'required' => true
                      , 'class'    => 'form-control'
                      , 'id'       => 'price_criteria_1'
                      , 'placeholder' => '1000'
                      ]) ?>
                      <div class="invalid-feedback">
                        Please enter a valid buy price.
                      </div>
                    </div>
                    <label for="price_criteria_1"
                      class="col-sm-4 col-form-label">
                      <?= __('円以下はパターン１') ?></label>
                  </div>
                  <div class="form-group row mb-3">
                    <label for="price_criteria_2"
                      class="col-sm-4 col-form-label">
                      <?= __('アマゾンの購入額が') ?></label>
                    <div class="col-sm-4">
                      <?= $this->Form->text('price_criteria_2', [
                        'required' => true
                      , 'class'    => 'form-control'
                      , 'id'       => 'price_criteria_2'
                      , 'placeholder' => '5000'
                      ]) ?>
                      <div class="invalid-feedback">
                        Please enter a valid buy price.
                      </div>
                    </div>
                    <label for="price_criteria_2"
                      class="col-sm-4 col-form-label">
                      <?= __('円以下はパターン２') ?></label>
                  </div>
                  <div class="form-group row mb-3">
                    <label for="price_criteria_3"
                      class="col-sm-4 col-form-label">
                      <?= __('アマゾンの購入額が') ?></label>
                    <div class="col-sm-4">
                      <?= $this->Form->text('price_criteria_3', [
                        'required' => true
                      , 'class'    => 'form-control'
                      , 'id'       => 'price_criteria_3'
                      , 'placeholder' => '10000'
                      ]) ?>
                      <div class="invalid-feedback">
                        Please enter a valid buy price.
                      </div>
                    </div>
                    <label for="price_criteria_3"
                      class="col-sm-4 col-form-label">
                      <?= __('円以下はパターン３') ?></label>
                  </div>
                  <div class="form-group row mb-3">
                    <label for="price_criteria_4"
                      class="col-sm-4 col-form-label">
                      <?= __('アマゾンの購入額が') ?></label>
                    <div class="col-sm-4">
                      <?= $this->Form->text('price_criteria_4', [
                        'required' => true
                      , 'class'    => 'form-control'
                      , 'id'       => 'price_criteria_4'
                      , 'placeholder' => '30000'
                      ]) ?>
                      <div class="invalid-feedback">
                        Please enter a valid buy price.
                      </div>
                    </div>
                    <label for="price_criteria_4"
                      class="col-sm-4 col-form-label">
                      <?= __('円以下はパターン４') ?></label>
                  </div>

                  <h4 class="mb-3"><?= __('販売価格') ?></h4>

                  <h6 class="mb-3"><?= __('パターン１') ?></h6>
                  <div class="form-group row mb-3">
                    <label for="sales_rate_1"
                      class="col-sm-5 col-form-label">
                      <?= __('販売価格　＝　アマゾンの購入額') ?></label>
                    <label for="sales_rate_1"
                      class="col-sm-1 col-form-label"><?= __('✕') ?></label>
                    <div class="col-sm-2">
                      <?= $this->Form->text('sales_rate_1', [
                        'required' => true
                      , 'class'    => 'form-control'
                      , 'id'       => 'sales_rate_1'
                      , 'placeholder' => '140'
                      ]) ?>
                      <div class="invalid-feedback">
                        Please enter a valid price rate.
                      </div>
                    </div>
                    <label for="sales_rate_1"
                      class="col-form-label col-sm-1"><?= __('％') ?></label>
                    <label for="sales_price_1"
                      class="col-form-label col-sm-1"><?= __('＋') ?></label>
                    <div class="col-sm-2">
                      <?= $this->Form->text('sales_price_1', [
                        'required' => true
                      , 'class'    => 'form-control'
                      , 'id'       => 'sales_price_1'
                      , 'placeholder' => '1000'
                      ]) ?>
                      <div class="invalid-feedback">
                        Please enter a valid price.
                      </div>
                    </div>
                  </div>

                  <h6 class="mb-3"><?= __('パターン２') ?></h6>
                  <div class="form-group row mb-3">
                    <label for="sales_rate_2"
                      class="col-sm-5 col-form-label">
                      <?= __('販売価格　＝　アマゾンの購入額') ?></label>
                    <label for="sales_rate_2"
                      class="col-sm-1 col-form-label"><?= __('✕') ?></label>
                    <div class="col-sm-2">
                      <?= $this->Form->text('sales_rate_2', [
                        'required' => true
                      , 'class'    => 'form-control'
                      , 'id'       => 'sales_rate_2'
                      , 'placeholder' => '140'
                      ]) ?>
                      <div class="invalid-feedback">
                        Please enter a valid price rate.
                      </div>
                    </div>
                    <label for="sales_rate_2"
                      class="col-form-label col-sm-1"><?= __('％') ?></label>
                    <label for="sales_price_2"
                      class="col-form-label col-sm-1"><?= __('＋') ?></label>
                    <div class="col-sm-2">
                      <?= $this->Form->text('sales_price_2', [
                        'required' => true
                      , 'class'    => 'form-control'
                      , 'id'       => 'sales_price_2'
                      , 'placeholder' => '1000'
                      ]) ?>
                      <div class="invalid-feedback">
                        Please enter a valid price.
                      </div>
                    </div>
                  </div>

                  <h6 class="mb-3"><?= __('パターン３') ?></h6>
                  <div class="form-group row mb-3">
                    <label for="sales_rate_3"
                      class="col-sm-5 col-form-label">
                      <?= __('販売価格　＝　アマゾンの購入額') ?></label>
                    <label for="sales_rate_3"
                      class="col-sm-1 col-form-label"><?= __('✕') ?></label>
                    <div class="col-sm-2">
                      <?= $this->Form->text('sales_rate_3', [
                        'required' => true
                      , 'class'    => 'form-control'
                      , 'id'       => 'sales_rate_3'
                      , 'placeholder' => '140'
                      ]) ?>
                      <div class="invalid-feedback">
                        Please enter a valid price rate.
                      </div>
                    </div>
                    <label for="sales_rate_3"
                      class="col-form-label col-sm-1"><?= __('％') ?></label>
                    <label for="sales_price_3"
                      class="col-form-label col-sm-1"><?= __('＋') ?></label>
                    <div class="col-sm-2">
                      <?= $this->Form->text('sales_price_3', [
                        'required' => true
                      , 'class'    => 'form-control'
                      , 'id'       => 'sales_price_3'
                      , 'placeholder' => '1000'
                      ]) ?>
                      <div class="invalid-feedback">
                        Please enter a valid price.
                      </div>
                    </div>
                  </div>

                  <h6 class="mb-3"><?= __('パターン４') ?></h6>
                  <div class="form-group row mb-3">
                    <label for="sales_rate_4"
                      class="col-sm-5 col-form-label">
                      <?= __('販売価格　＝　アマゾンの購入額') ?></label>
                    <label for="sales_rate_4"
                      class="col-sm-1 col-form-label"><?= __('✕') ?></label>
                    <div class="col-sm-2">
                      <?= $this->Form->text('sales_rate_4', [
                        'required' => true
                      , 'class'    => 'form-control'
                      , 'id'       => 'sales_rate_4'
                      , 'placeholder' => '140'
                      ]) ?>
                      <div class="invalid-feedback">
                        Please enter a valid price rate.
                      </div>
                    </div>
                    <label for="sales_rate_4"
                      class="col-form-label col-sm-1"><?= __('％') ?></label>
                    <label for="sales_price_4"
                      class="col-form-label col-sm-1"><?= __('＋') ?></label>
                    <div class="col-sm-2">
                      <?= $this->Form->text('sales_price_4', [
                        'required' => true
                      , 'class'    => 'form-control'
                      , 'id'       => 'sales_price_4'
                      , 'placeholder' => '1000'
                      ]) ?>
                      <div class="invalid-feedback">
                        Please enter a valid price.
                      </div>
                    </div>
                  </div>

                  <h6 class="mb-3"><?= __('パターン５') ?></h6>
                  <div class="form-group row mb-3">
                    <label for="sales_rate_5"
                      class="col-sm-5 col-form-label">
                      <?= __('販売価格　＝　アマゾンの購入額') ?></label>
                    <label for="sales_rate_5"
                      class="col-sm-1 col-form-label"><?= __('✕') ?></label>
                    <div class="col-sm-2">
                      <?= $this->Form->text('sales_rate_5', [
                        'required' => true
                      , 'class'    => 'form-control'
                      , 'id'       => 'sales_rate_5'
                      , 'placeholder' => '140'
                      ]) ?>
                      <div class="invalid-feedback">
                        Please enter a valid price rate.
                      </div>
                    </div>
                    <label for="sales_rate_5"
                      class="col-form-label col-sm-1"><?= __('％') ?></label>
                    <label for="sales_price_5"
                      class="col-form-label col-sm-1"><?= __('＋') ?></label>
                    <div class="col-sm-2">
                      <?= $this->Form->text('sales_price_5', [
                        'required' => true
                      , 'class'    => 'form-control'
                      , 'id'       => 'sales_price_5'
                      , 'placeholder' => '1000'
                      ]) ?>
                      <div class="invalid-feedback">
                        Please enter a valid price.
                      </div>
                    </div>
                  </div>

                  <hr class="mb-4">
                  <?= $this->Form->button(__('登録する'), [
                    'class' => 'btn btn-primary btn-lg btn-block'
                  , 'name' => 'calculation'
                  ]) ?>
                <?= $this->Form->end() ?>
              </div>
            </div>
          </div>


        </main>
      </div>
    </div>

    <!-- The Modal -->
    <div class="modal fade" id="myModal">
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">送信完了</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            処理を受け付ました。
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>

        </div>
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
