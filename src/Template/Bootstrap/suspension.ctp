        <!-- Main contens -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">禁止ASIN登録</h1>
          </div>

          <div class="container" id="suspension">
            <div class="row">
              <div class="col-md-4 order-md-2 mb-4">
              </div>
              <div class="col-md-8 order-md-1">
                <h4 class="mb-3">ファイルアップロード</h4>
                <?= $this->Form->create($fileform, [
                  'type'        => 'file'
                , 'url'         => [ 'controler' => 'Bootstrap', 'action' => 'suspension' ]
                , 'class'       => 'needs-validation'
                , 'novalidate'  => true
                ]) ?>

                  <div class="mb-3 form-group">
                    <?= $this->Form->control('upload_file', [
                      'type'      => 'file'
                    , 'label'     => 'CSVファイル'
                    , 'required'  => true
                    , 'class'     => 'form-control-file'
                    ]) ?>
                    <div class="invalid-feedback">
                      Please select a valid CSV file.
                    </div>
                  </div>

                  <div class="mb-3">
                  <?= $this->Form->button('テンプレートを入手', [
                    'class' => 'btn btn-outline-dark btn-block'
                  , 'name' => 'template'
                  ]) ?>
                  </div>

                  <hr class="mb-4">
                  <?= $this->Form->button('登録する', [
                    'class' => 'btn btn-primary btn-lg btn-block'
                  , 'name' => 'suspension'
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
      , '//cdnjs.cloudflare.com/ajax/libs/spin.js/2.3.2/spin.js'
      , $this->Elixir->version('js/watchnote.js')
      ]) ?>
    <!-- Icons -->
    <script>feather.replace()</script>
    <!-- Validation check -->
    <script>
    (function() {
      'use strict';
      var opts = {
        lines: 13,
        length: 28,
        width: 14,
        radius: 42,
        scale: 1,
        corners: 1,
        color: '#000',
        opacity: .25,
        rotate: 0,
        direction: 1,
        speed: 1,
        trail: 60,
        fps: 20,
        zIndex: 2e9,
        className: 'spinner',
        top: '50%',
        left: '50%',
        shadow: false,
        hwaccel: false,
        position: 'absolute'
      };
      var spin_target = document.getElementById('suspension');
      var spin_submit = document.getElementById('submit');
      var upload_file = document.getElementById('upload-file');
      var spinner = new Spinner(opts);

      spin_submit.addEventListener('click', function () {
        if(upload_file.value !== "") spinner.spin(spin_target);
      }, false);

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
