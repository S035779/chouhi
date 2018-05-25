        <!-- Main contens -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2"><?= __('商品検索') ?></h1>
          </div>

          <div class="container">
            <div class="row">
              <div class="col-md-12 order-md-1">
              <h4 class="mb-3"><?= __('検索条件') ?></h4>
                <?= $this->Form->create($offers, [
                  'url' => ['controller' => 'Bootstrap', 'action' => 'search']
                , 'class' => 'needs-validation'
                , 'novalidate' => true
                ]) ?>

                  <div class="mb-3">
                    <label for="period"><?= __('平均価格日数') ?></label>
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
                    <label for="riserate"><?= __('上昇率') ?></label>
                    <?= $this->Form->text('riserate', [
                      'required' => true
                    , 'class' => 'form-control'
                    , 'placeholder' => 'Input price rise rate'
                    ]) ?>
                    <div class="invalid-feedback">
                      Please enter a valid price rise rate.
                    </div>
                  </div>

                  <div class="mb-3">
                    <label for="proifit"><?= __('利益幅') ?></label>
                    <?= $this->Form->text('profit', [
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

                  <h4 class="mb-3">検索結果</h4>
                  <div class="card mb-3">
                    <div class="card-header">商品名</div>
                    <div class="card-body p-2">
                      <div class="card-group">
                      <div class="col-sm-4">
                        <div class="card">
                          <img class="card-img-top" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22219%22%20height%3D%22200%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20219%20200%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_16359a211ce%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A11pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_16359a211ce%22%3E%3Crect%20width%3D%22219%22%20height%3D%22200%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2260.92499923706055%22%20y%3D%22104.95%22%3E%E3%82%AB%E3%83%BC%E3%83%891%E3%81%AE%E7%94%BB%E5%83%8F%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" alt="カード1の画像">
                          <div class="card-body p-2">
                            <div class="btn-group d-flex" role="group"
                              aria-label="button-group">
                              <button type="button"
                                class="btn btn-primary w-100">
                                MO
                              </button>
                              <button type="button"
                                class="btn btn-primary w-100">
                                FB
                              </button>
                              <button type="button"
                                class="btn btn-primary w-100">
                                AM
                              </button>
                              <button type="button" class="btn btn-primary w-100"
                                data-toggle="popover"
                                data-content-id="#myPopover1">
                                詳
                              </button>
                            </div>
                          </div>
                          <div class="card hidden" id="myPopover1">
                            <ul class="list-group list-group-flush">
                              <li class="list-group-item">出品者数（新品／中古）</li>
                              <li class="list-group-item">更新日</li>
                              <li class="list-group-item">レビュー数</li>
                              <li class="list-group-item">平均レビュー</li>
                              <li class="list-group-item">平均ランキング</li>
                              <li class="list-group-item">カテゴリー</li>
                            </ul>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="card">
                        <ul class="list-group list-group-flush">
                          <li class="list-group-item">ランキング</li>
                          <li class="list-group-item">ASIN</li>
                          <li class="list-group-item">価格</li>
                          <li class="list-group-item">平均価格</li>
                          <li class="list-group-item">価格差</li>
                          <li class="list-group-item">発売日</li>
                        </ul>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="card">
                        <img class="card-img" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22226%22%20height%3D%22260%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20226%20260%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_16359a211dc%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A13pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_16359a211dc%22%3E%3Crect%20width%3D%22226%22%20height%3D%22260%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2255.68333435058594%22%20y%3D%22135.85%22%3E%E3%82%AB%E3%83%BC%E3%83%896%E3%81%AE%E7%94%BB%E5%83%8F%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" alt="カード1の画像">
                        </div>
                      </div>
                      </div>
                    </div>
                  </div>

                  <div class="card mb-3">
                    <div class="card-header">商品名</div>
                    <div class="card-body p-2">
                      <div class="card-group">
                      <div class="col-sm-4">
                        <div class="card">
                          <img class="card-img-top" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22219%22%20height%3D%22200%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20219%20200%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_16359a211ce%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A11pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_16359a211ce%22%3E%3Crect%20width%3D%22219%22%20height%3D%22200%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2260.92499923706055%22%20y%3D%22104.95%22%3E%E3%82%AB%E3%83%BC%E3%83%891%E3%81%AE%E7%94%BB%E5%83%8F%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" alt="カード1の画像">
                          <div class="card-body p-2">
                            <div class="btn-group d-flex" role="group"
                              aria-label="button-group">
                              <button type="button"
                                class="btn btn-primary w-100">
                                MO
                              </button>
                              <button type="button"
                                class="btn btn-primary w-100">
                                FB
                              </button>
                              <button type="button"
                                class="btn btn-primary w-100">
                                AM
                              </button>
                              <button type="button" class="btn btn-primary w-100"
                                data-toggle="popover"
                                data-content-id="#myPopover2">
                                詳
                              </button>
                            </div>
                          </div>
                          <div class="card hidden" id="myPopover2">
                            <ul class="list-group list-group-flush">
                              <li class="list-group-item">出品者数（新品／中古）</li>
                              <li class="list-group-item">更新日</li>
                              <li class="list-group-item">レビュー数</li>
                              <li class="list-group-item">平均レビュー</li>
                              <li class="list-group-item">平均ランキング</li>
                              <li class="list-group-item">カテゴリー</li>
                            </ul>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="card">
                        <ul class="list-group list-group-flush">
                          <li class="list-group-item">ランキング</li>
                          <li class="list-group-item">ASIN</li>
                          <li class="list-group-item">価格</li>
                          <li class="list-group-item">平均価格</li>
                          <li class="list-group-item">価格差</li>
                          <li class="list-group-item">発売日</li>
                        </ul>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="card">
                        <img class="card-img" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22226%22%20height%3D%22260%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20226%20260%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_16359a211dc%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A13pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_16359a211dc%22%3E%3Crect%20width%3D%22226%22%20height%3D%22260%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2255.68333435058594%22%20y%3D%22135.85%22%3E%E3%82%AB%E3%83%BC%E3%83%896%E3%81%AE%E7%94%BB%E5%83%8F%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" alt="カード1の画像">
                        </div>
                      </div>
                      </div>
                    </div>
                  </div>

                  <div class="card mb-3">
                    <div class="card-header">商品名</div>
                    <div class="card-body p-2">
                      <div class="card-group">
                      <div class="col-sm-4">
                        <div class="card">
                          <img class="card-img-top" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22219%22%20height%3D%22200%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20219%20200%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_16359a211ce%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A11pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_16359a211ce%22%3E%3Crect%20width%3D%22219%22%20height%3D%22200%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2260.92499923706055%22%20y%3D%22104.95%22%3E%E3%82%AB%E3%83%BC%E3%83%891%E3%81%AE%E7%94%BB%E5%83%8F%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" alt="カード1の画像">
                          <div class="card-body p-2">
                            <div class="btn-group d-flex" role="group"
                              aria-label="button-group">
                              <button type="button"
                                class="btn btn-primary w-100">
                                MO
                              </button>
                              <button type="button"
                                class="btn btn-primary w-100">
                                FB
                              </button>
                              <button type="button"
                                class="btn btn-primary w-100">
                                AM
                              </button>
                              <button type="button" class="btn btn-primary w-100"
                                data-toggle="popover"
                                data-content-id="#myPopover3">
                                詳
                              </button>
                            </div>
                          </div>
                          <div class="card hidden" id="myPopover3">
                            <ul class="list-group list-group-flush">
                              <li class="list-group-item">出品者数（新品／中古）</li>
                              <li class="list-group-item">更新日</li>
                              <li class="list-group-item">レビュー数</li>
                              <li class="list-group-item">平均レビュー</li>
                              <li class="list-group-item">平均ランキング</li>
                              <li class="list-group-item">カテゴリー</li>
                            </ul>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="card">
                        <ul class="list-group list-group-flush">
                          <li class="list-group-item">ランキング</li>
                          <li class="list-group-item">ASIN</li>
                          <li class="list-group-item">価格</li>
                          <li class="list-group-item">平均価格</li>
                          <li class="list-group-item">価格差</li>
                          <li class="list-group-item">発売日</li>
                        </ul>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="card">
                        <img class="card-img" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22226%22%20height%3D%22260%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20226%20260%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_16359a211dc%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A13pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_16359a211dc%22%3E%3Crect%20width%3D%22226%22%20height%3D%22260%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2255.68333435058594%22%20y%3D%22135.85%22%3E%E3%82%AB%E3%83%BC%E3%83%896%E3%81%AE%E7%94%BB%E5%83%8F%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" alt="カード1の画像">
                        </div>
                      </div>
                      </div>
                    </div>
                  </div>

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
