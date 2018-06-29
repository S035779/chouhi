        <!-- Main contens -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="jumbotron mt-4">
            <h1 class="display-4">Amazon MWS Tools Management Page.</h1>
            <p class="lead">このページは管理者ページです。</p>
            <hr class="my-4">
            <p>サービスページヘ進む場合は以下のボタンを押下してください。</p>
            <?= $this->Html->Link(__('サービスページ')
            , ['controller' => 'Bootstrap', 'action' => 'token']
            , ['escape' => false, 'class' => 'btn btn-primary btn-lg', 'role'  => 'button']
            ) ?>
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
      , '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js'
      , $this->Elixir->version('js/watchnote.js')
      ]) ?>
    <!-- Icons -->
    <script>feather.replace()</script>
