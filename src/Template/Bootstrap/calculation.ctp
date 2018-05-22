        <!-- Main contens -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">販売価格設定</h1>
          </div>

          <div class="container">
            <div class="row mb-4">
              <div class="col-md-12 order-md-1">
                <form class="needs-validation" novalidate>

                  <h4 class="mb-3">販売商品</h4>

                  <div class="form-group mb-3">
                    <div class="form-check form-check-inline">
                      <label for="sellingRadio1">アマゾン商品の販売</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input type="radio" value="option1" checked
                        class="form-check-input"
                        name="sellingRadios"
                        id="sellingRadio1">
                      <label class="form-check-label"
                        for="sellingRadio1">販売する</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input type="radio" value="option2"
                        class="form-check-input"
                        name="sellingRadios"
                        id="sellingRadio2">
                      <label class="form-check-label"
                        for="sellingRadio2">販売しない</label>
                    </div>
                  </div>

                  <h4 class="mb-3">在庫数指定</h4>

                  <div class="form-group row mb-3">
                    <label for="quantity-rate"
                      class="col-sm-5 col-form-label">
                      在庫数　＝　アマゾンでの在庫数</label>
                    <label for="quantity-rate"
                      class="col-sm-1 col-form-label">✕</label>
                    <div class="col-sm-2">
                      <input type="text"
                        class="form-control"
                        id="quantity-rate"
                        placeholder="100" required>
                      <div class="invalid-feedback">
                        Please enter a valid quantity rate.
                      </div>
                    </div>
                    <label for="quantity-rate"
                      class="col-form-label col-sm-1">％</label>
                    <label for="quantity-number"
                      class="col-form-label col-sm-1">＋</label>
                    <div class="col-sm-2">
                      <input type="text"
                        class="form-control"
                        id="quantity-number"
                        placeholder="0" required>
                      <div class="invalid-feedback">
                        Please enter a valid quantity number.
                      </div>
                    </div>
                  </div>

                  <h4 class="mb-3">価格判定</h4>

                  <div class="form-group row mb-3">
                    <label for="buyprice1"
                      class="col-sm-4 col-form-label">
                      アマゾンの購入額が</label>
                    <div class="col-sm-4">
                      <input type="text"
                        class="form-control"
                        id="buyprice1"
                        placeholder="1000" required>
                      <div class="invalid-feedback">
                        Please enter a valid buy price.
                      </div>
                    </div>
                    <label for="buyprice1"
                      class="col-sm-4 col-form-label">
                      円以下はパターン１</label>
                  </div>
                  <div class="form-group row mb-3">
                    <label for="buyprice2"
                      class="col-sm-4 col-form-label">
                      アマゾンの購入額が</label>
                    <div class="col-sm-4">
                      <input type="text"
                        class="form-control"
                        id="buyprice2"
                        placeholder="5000" required>
                      <div class="invalid-feedback">
                        Please enter a valid buy price.
                      </div>
                    </div>
                    <label for="buyprice2"
                      class="col-sm-4 col-form-label">
                      円以下はパターン２</label>
                  </div>
                  <div class="form-group row mb-3">
                    <label for="buyprice3"
                      class="col-sm-4 col-form-label">
                      アマゾンの購入額が</label>
                    <div class="col-sm-4">
                      <input type="text"
                        class="form-control"
                        id="buyprice3"
                        placeholder="10000" required>
                      <div class="invalid-feedback">
                        Please enter a valid buy price.
                      </div>
                    </div>
                    <label for="buyprice3"
                      class="col-sm-4 col-form-label">
                      円以下はパターン３</label>
                  </div>
                  <div class="form-group row mb-3">
                    <label for="buyprice4"
                      class="col-sm-4 col-form-label">
                      アマゾンの購入額が</label>
                    <div class="col-sm-4">
                      <input type="text"
                        class="form-control"
                        id="buyprice4"
                        placeholder="30000" required>
                      <div class="invalid-feedback">
                        Please enter a valid buy price.
                      </div>
                    </div>
                    <label for="buyprice4"
                      class="col-sm-4 col-form-label">
                      円以下はパターン４</label>
                  </div>

                  <h4 class="mb-3">販売価格</h4>

                  <h6 class="mb-3">パターン１</h6>
                  <div class="form-group row mb-3">
                    <label for="price-rate1"
                      class="col-sm-5 col-form-label">
                      販売価格　＝　アマゾンの購入額</label>
                    <label for="price-rate1"
                      class="col-sm-1 col-form-label">✕</label>
                    <div class="col-sm-2">
                      <input type="text"
                        class="form-control"
                        id="price-rate1"
                        placeholder="140" required>
                      <div class="invalid-feedback">
                        Please enter a valid price rate.
                      </div>
                    </div>
                    <label for="price-rate1"
                      class="col-form-label col-sm-1">％</label>
                    <label for="price-number1"
                      class="col-form-label col-sm-1">＋</label>
                    <div class="col-sm-2">
                      <input type="text"
                        class="form-control"
                        id="price-number1"
                        placeholder="1000" required>
                      <div class="invalid-feedback">
                        Please enter a valid price.
                      </div>
                    </div>
                  </div>
                  <div class="form-group row mb-3">
                    <label for="delete-rate1"
                      class="col-sm-5 col-form-label">
                      削除条件　＝　登録時の購入額</label>
                    <label for="delete-rate1"
                      class="col-sm-1 col-form-label">✕</label>
                    <div class="col-sm-2">
                      <input type="text"
                        class="form-control"
                        id="delete-rate1"
                        placeholder="110" required>
                      <div class="invalid-feedback">
                        Please enter a valid delete rate.
                      </div>
                    </div>
                    <label for="delete-rate1"
                      class="col-form-label col-sm-1">％</label>
                    <label for="delete-number1"
                      class="col-form-label col-sm-1">＋</label>
                    <div class="col-sm-2">
                      <input type="text"
                        class="form-control"
                        id="delete-number1"
                        placeholder="200" required>
                      <div class="invalid-feedback">
                        Please enter a valid price.
                      </div>
                    </div>
                  </div>

                  <h6 class="mb-3">パターン２</h6>
                  <div class="form-group row mb-3">
                    <label for="price-rate2"
                      class="col-sm-5 col-form-label">
                      販売価格　＝　アマゾンの購入額</label>
                    <label for="price-rate2"
                      class="col-sm-1 col-form-label">✕</label>
                    <div class="col-sm-2">
                      <input type="text"
                        class="form-control"
                        id="price-rate2"
                        placeholder="140" required>
                      <div class="invalid-feedback">
                        Please enter a valid price rate.
                      </div>
                    </div>
                    <label for="price-rate2"
                      class="col-form-label col-sm-1">％</label>
                    <label for="price-number2"
                      class="col-form-label col-sm-1">＋</label>
                    <div class="col-sm-2">
                      <input type="text"
                        class="form-control"
                        id="price-number2"
                        placeholder="1000" required>
                      <div class="invalid-feedback">
                        Please enter a valid price.
                      </div>
                    </div>
                  </div>
                  <div class="form-group row mb-3">
                    <label for="delete-rate2"
                      class="col-sm-5 col-form-label">
                      削除条件　＝　登録時の購入額</label>
                    <label for="delete-rate2"
                      class="col-sm-1 col-form-label">✕</label>
                    <div class="col-sm-2">
                      <input type="text"
                        class="form-control"
                        id="delete-rate2"
                        placeholder="110" required>
                      <div class="invalid-feedback">
                        Please enter a valid delete rate.
                      </div>
                    </div>
                    <label for="delete-rate2"
                      class="col-form-label col-sm-1">％</label>
                    <label for="delete-number2"
                      class="col-form-label col-sm-1">＋</label>
                    <div class="col-sm-2">
                      <input type="text"
                        class="form-control"
                        id="delete-number2"
                        placeholder="600" required>
                      <div class="invalid-feedback">
                        Please enter a valid price.
                      </div>
                    </div>
                  </div>

                  <h6 class="mb-3">パターン３</h6>
                  <div class="form-group row mb-3">
                    <label for="price-rate3"
                      class="col-sm-5 col-form-label">
                      販売価格　＝　アマゾンの購入額</label>
                    <label for="price-rate3"
                      class="col-sm-1 col-form-label">✕</label>
                    <div class="col-sm-2">
                      <input type="text"
                        class="form-control"
                        id="price-rate3"
                        placeholder="140" required>
                      <div class="invalid-feedback">
                        Please enter a valid price rate.
                      </div>
                    </div>
                    <label for="price-rate3"
                      class="col-form-label col-sm-1">％</label>
                    <label for="price-number3"
                      class="col-form-label col-sm-1">＋</label>
                    <div class="col-sm-2">
                      <input type="text"
                        class="form-control"
                        id="price-number3"
                        placeholder="1000" required>
                      <div class="invalid-feedback">
                        Please enter a valid price.
                      </div>
                    </div>
                  </div>
                  <div class="form-group row mb-3">
                    <label for="delete-rate3"
                      class="col-sm-5 col-form-label">
                      削除条件　＝　登録時の購入額</label>
                    <label for="delete-rate3"
                      class="col-sm-1 col-form-label">✕</label>
                    <div class="col-sm-2">
                      <input type="text"
                        class="form-control"
                        id="delete-rate3"
                        placeholder="110" required>
                      <div class="invalid-feedback">
                        Please enter a valid delete rate.
                      </div>
                    </div>
                    <label for="delete-rate3"
                      class="col-form-label col-sm-1">％</label>
                    <label for="delete-number3"
                      class="col-form-label col-sm-1">＋</label>
                    <div class="col-sm-2">
                      <input type="text"
                        class="form-control"
                        id="delete-number3"
                        placeholder="600" required>
                      <div class="invalid-feedback">
                        Please enter a valid price.
                      </div>
                    </div>
                  </div>

                  <h6 class="mb-3">パターン４</h6>
                  <div class="form-group row mb-3">
                    <label for="price-rate4"
                      class="col-sm-5 col-form-label">
                      販売価格　＝　アマゾンの購入額</label>
                    <label for="price-rate4"
                      class="col-sm-1 col-form-label">✕</label>
                    <div class="col-sm-2">
                      <input type="text"
                        class="form-control"
                        id="price-rate4"
                        placeholder="140" required>
                      <div class="invalid-feedback">
                        Please enter a valid price rate.
                      </div>
                    </div>
                    <label for="price-rate4"
                      class="col-form-label col-sm-1">％</label>
                    <label for="price-number4"
                      class="col-form-label col-sm-1">＋</label>
                    <div class="col-sm-2">
                      <input type="text"
                        class="form-control"
                        id="price-number4"
                        placeholder="1000" required>
                      <div class="invalid-feedback">
                        Please enter a valid price.
                      </div>
                    </div>
                  </div>
                  <div class="form-group row mb-3">
                    <label for="delete-rate4"
                      class="col-sm-5 col-form-label">
                      削除条件　＝　登録時の購入額</label>
                    <label for="delete-rate4"
                      class="col-sm-1 col-form-label">✕</label>
                    <div class="col-sm-2">
                      <input type="text"
                        class="form-control"
                        id="delete-rate4"
                        placeholder="110" required>
                      <div class="invalid-feedback">
                        Please enter a valid delete rate.
                      </div>
                    </div>
                    <label for="delete-rate4"
                      class="col-form-label col-sm-1">％</label>
                    <label for="delete-number4"
                      class="col-form-label col-sm-1">＋</label>
                    <div class="col-sm-2">
                      <input type="text"
                        class="form-control"
                        id="delete-number4"
                        placeholder="600" required>
                      <div class="invalid-feedback">
                        Please enter a valid price.
                      </div>
                    </div>
                  </div>

                  <h6 class="mb-3">パターン５</h6>
                  <div class="form-group row mb-3">
                    <label for="price-rate5"
                      class="col-sm-5 col-form-label">
                      販売価格　＝　アマゾンの購入額</label>
                    <label for="price-rate5"
                      class="col-sm-1 col-form-label">✕</label>
                    <div class="col-sm-2">
                      <input type="text"
                        class="form-control"
                        id="price-rate5"
                        placeholder="140" required>
                      <div class="invalid-feedback">
                        Please enter a valid price rate.
                      </div>
                    </div>
                    <label for="price-rate5"
                      class="col-form-label col-sm-1">％</label>
                    <label for="price-number5"
                      class="col-form-label col-sm-1">＋</label>
                    <div class="col-sm-2">
                      <input type="text"
                        class="form-control"
                        id="price-number5"
                        placeholder="1000" required>
                      <div class="invalid-feedback">
                        Please enter a valid price.
                      </div>
                    </div>
                  </div>
                  <div class="form-group row mb-3">
                    <label for="delete-rate5"
                      class="col-sm-5 col-form-label">
                      削除条件　＝　登録時の購入額</label>
                    <label for="delete-rate5"
                      class="col-sm-1 col-form-label">✕</label>
                    <div class="col-sm-2">
                      <input type="text"
                        class="form-control"
                        id="delete-rate5"
                        placeholder="110" required>
                      <div class="invalid-feedback">
                        Please enter a valid delete rate.
                      </div>
                    </div>
                    <label for="delete-rate5"
                      class="col-form-label col-sm-1">％</label>
                    <label for="delete-number5"
                      class="col-form-label col-sm-1">＋</label>
                    <div class="col-sm-2">
                      <input type="text"
                        class="form-control"
                        id="delete-number5"
                        placeholder="600" required>
                      <div class="invalid-feedback">
                        Please enter a valid price.
                      </div>
                    </div>
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
