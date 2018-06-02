        <!-- Main contens -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2"><?= __('ユーザ設定') ?></h1>
          </div>


          <div class="container">
            <div class="row">
              <div class="col-md-8 order-md-1">
                <h4 class="mb-3"><? __('パスワード変更') ?></h4>
                <?= $this->Form->create($user, [
                  'url' => ['controller' => 'Bootstrap', 'action' => 'setting']
                , 'class' => 'needs-validation'
                , 'novalidate' => true
                ]) ?>

                  <div class="mb-3">
                    <label for="password"><?= __('パスワード') ?></label>
                    <?= $this->Form->text('password', [
                      'type'        => 'password'
                    , 'class'       => 'form-control'
                    , 'placeholder' => 'Your password'
                    , 'required'    => true
                    ]) ?>
                    <div class="invalid-feedback">
                      Please enter a valid password.
                    </div>
                  </div>

                  <div class="mb-3">
                    <label for="confirm_password"><?= __('パスワード（確認）') ?></label>
                    <?= $this->Form->text('confirm_password', [
                      'type'        => 'password'
                    , 'class'       => 'form-control'
                    , 'placeholder' => 'Your confirmation password'
                    , 'required'    => true
                    ]) ?>
                    <div class="invalid-feedback">
                      Please enter a valid confirmation password.
                    </div>
                  </div>

                  <hr class="mb-4">
                  <?= $this->Form->button(__('変更する'), [
                    'class' => 'btn btn-primary btn-lg btn-block'
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

