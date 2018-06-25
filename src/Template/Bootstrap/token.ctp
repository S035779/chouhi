        <!-- Main contens -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2"><?= __('トークン設定') ?></h1>
          </div>

          <div class="container">
            <div class="row">
              <div class="col-md-8 order-md-1">
                <h4 class="mb-3"><?= __('APIアクセスキー登録') ?></h4>
                <?= $this->Form->create($token, [
                  'url' => ['controller' => 'Bootstrap', 'action' => 'token']
                , 'class' => 'needs-validation'
                , 'novalidate' => true
                ]) ?>

                  <div class="mb-3">
                    <label for="access_key"><?= __('アクセスキー') ?></label>
                    <?= $this->Form->text('access_key', [
                      'required'    => true
                    , 'class'       => 'form-control'
                    , 'placeholder' => 'Your Access Key Id'
                    ])?>
                    <div class="invalid-feedback">
                      Please enter a valid AWSAccessKeyId.
                    </div>
                  </div>

                  <div class="mb-3">
                    <label for="secret_key"><?= __('シークレットキー') ?></label>
                    <?= $this->Form->text('secret_key', [
                      'required'    => true
                    , 'class'       => 'form-control'
                    , 'placeholder' => 'Your Secret Key'
                    ])?>
                    <div class="invalid-feedback">
                      Please enter a valid AWSSecretKeyId.
                    </div>
                  </div>

                  <div class="mb-3">
                    <label for="seller.seller"><?= __('セラーＩＤ') ?></label>
                    <?= $this->Form->text('seller.seller', [
                      'required'    => true
                    , 'class'       => 'form-control'
                    , 'placeholder' => 'Your Seller Id'
                    ])?>
                    <div class="invalid-feedback">
                      Please enter a valid Seller Id.
                    </div>
                  </div>

                  <div class="mb-3">
                    <label for="seller.marketplace"><?= __('マーケットプレイス') ?></label>
                    <?= $this->Form->select('seller.marketplace', [
                      'JP' =>  'Japan', 'AU' =>  'Australia', 'US' => 'United stats'
                    ], [
                      'required'    => true
                    , 'class'       => 'form-control'
                    , 'empty'       => 'Your Marketplace'
                    ])?>
                    <div class="invalid-feedback">
                      Please enter a valid Marketplace country.
                    </div>
                  </div>

                  <div class="mb-3">
                    <label for="pa_access_key"><?= __('PAアクセスキー') ?></label>
                    <?= $this->Form->text('pa_access_key', [
                      'required'    => false
                    , 'class'       => 'form-control'
                    , 'placeholder' => 'Your PA Access Key Id'
                    ])?>
                    <div class="invalid-feedback">
                      Please enter a valid PA-API AccessKeyId.
                    </div>
                  </div>

                  <div class="mb-3">
                    <label for="pa_secret_key"><?= __('PAシークレットキー') ?></label>
                    <?= $this->Form->text('pa_secret_key', [
                      'required'    => false
                    , 'class'       => 'form-control'
                    , 'placeholder' => 'Your PA Secret Key'
                    ])?>
                    <div class="invalid-feedback">
                      Please enter a valid PA-API SecretKeyId.
                    </div>
                  </div>

                  <div class="mb-3">
                    <label for="pa_associate_tag"><?= __('アソシエイトタグ') ?></label>
                    <?= $this->Form->text('pa_associate_tag', [
                      'required'    => false
                    , 'class'       => 'form-control'
                    , 'placeholder' => 'Your Associate Tag'
                    ])?>
                    <div class="invalid-feedback">
                      Please enter a valid Associate Tag.
                    </div>
                  </div>

                  <div class="mb-3">
                  <label><?= __('接続確認') ?></label>
                    <?= $this->Form->button(__('確認する'), [
                      'class' => 'btn btn-outline-dark btn-block'
                    , 'name'  => 'confirmation'
                    ]) ?>
                  </div>

                  <hr class="mb-4">
                  <?= $this->Form->button(__('登録する'), [
                    'class' => 'btn btn-primary btn-lg btn-block'
                  , 'name'  => 'registration'
                  ]) ?>
                <?= $this->Form->end() ?>
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
