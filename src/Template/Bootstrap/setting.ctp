        <!-- Main contens -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">ユーザ管理</h1>
          </div>


          <div class="container">
            <div class="row">
              <div class="col-md-4 order-md-2 mb-4">
              </div>
              <div class="col-md-8 order-md-1">
                <h4 class="mb-3">パスワード変更</h4>
                <form class="needs-validation" novalidate>

                  <div class="mb-3">
                    <label for="password">パスワード</label>
                    <input type="text"
                      class="form-control"
                      id="password"
                      placeholder="Your password" required>
                    <div class="invalid-feedback">
                      Please enter a valid password.
                    </div>
                  </div>

                  <div class="mb-3">
                    <label for="confirm_password">パスワード（確認）</label>
                    <input type="text"
                      class="form-control"
                      id="confirm_password"
                      placeholder="Your confirmation password" required>
                    <div class="invalid-feedback">
                      Please enter a valid confirmation password.
                    </div>
                  </div>

                  <hr class="mb-4">
                  <button type="submit"
                    class="btn btn-primary btn-lg btn-block">
                    変更する
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

