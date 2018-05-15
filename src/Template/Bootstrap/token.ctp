        <!-- Main contens -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">トークン設定</h1>
          </div>

          <div class="container">
            <div class="row">
              <div class="col-md-4 order-md-2 mb-4">
              </div>
              <div class="col-md-8 order-md-1">
                <h4 class="mb-3">APIアクセスキー登録</h4>
                <form class="needs-validation" novalidate>

                  <div class="mb-3">
                    <label for="access_key">アクセスキー</label>
                    <input type="text"
                      class="form-control"
                      id="access_key"
                      placeholder="Your Access Key Id" required>
                    <div class="invalid-feedback">
                      Please enter a valid AWSAccessKeyId.
                    </div>
                  </div>

                  <div class="mb-3">
                    <label for="secret_key">シークレットキー</label>
                    <input type="text"
                      class="form-control"
                      id="secret_key"
                      placeholder="Your Secret Key" required>
                    <div class="invalid-feedback">
                      Please enter a valid AWSSecretKeyId.
                    </div>
                  </div>

                  <div class="mb-3">
                    <label for="sellerid">セラーＩＤ</label>
                    <input type="text"
                      class="form-control"
                      id="sellerid"
                      placeholder="Your Seller Id" required>
                    <div class="invalid-feedback">
                      Please enter a valid Seller Id.
                    </div>
                  </div>

                  <div class="mb-3">
                    <label for="sellerid">接続確認</label>
                    <button type="button"
                      class="btn btn-outline-dark btn-block"
                      data-toggle="modal" data-target="#myModal">
                      確認する
                    </button>
                  </div>

                  <hr class="mb-4">
                  <button type="submit"
                    class="btn btn-primary btn-lg btn-block">
                    登録する
                  </button>

                </form>
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
      ]) ?>
    <script src="/chouhi<?= $this->Elixir->version('js/watchnote.js') ?>"></script>
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
