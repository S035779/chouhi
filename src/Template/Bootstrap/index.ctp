        <!-- Main contens -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">ダッシュボード</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
                <button class="btn btn-sm btn-outline-secondary">
                  共有する
                </button>
                <button class="btn btn-sm btn-outline-secondary">
                  出力する
                </button>
              </div>
              <button class
                ="btn btn-sm btn-outline-secondary dropdown-toggle datepicker">
                <span data-feather="calendar"></span>
                今週
              </button>
            </div>
          </div>

          <canvas class="my-4 w-100" id="myChart" width="900"
            height="300"></canvas>

          <h4 class="md-3">売上推移一覧</h4>
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>#</th>
                  <th>対象月日</th>
                  <th>出品数</th>
                  <th>利益率</th>
                  <th>売上金額</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th>1011</th>
                  <td>2018/05/31（金）</td>
                  <td>45 商品</td>
                  <td>32 %</td>
                  <td>24,000 円</td>
                </tr>
                <tr>
                  <th>1010</th>
                  <td>2018/05/30（木）</td>
                  <td>43 商品</td>
                  <td>17 %</td>
                  <td>17,000 円</td>
                </tr>
                <tr>
                  <th>1009</th>
                  <td>2018/05/29（水）</td>
                  <td>41 商品</td>
                  <td>3 %</td>
                  <td>8,000 円</td>
                </tr>
                <tr>
                  <th>1008</th>
                  <td>2018/05/29（火）</td>
                  <td>40 商品</td>
                  <td>11 %</td>
                  <td>14,000 円</td>
                </tr>
                <tr>
                  <th>1007</th>
                  <td>2018/05/28（月）</td>
                  <td>37 商品</td>
                  <td>25 %</td>
                  <td>32,000 円</td>
                </tr>
                <tr>
                  <th>1006</th>
                  <td>2018/05/27（日）</td>
                  <td>35 商品</td>
                  <td>6 %</td>
                  <td>22,000 円</td>
                </tr>
                <tr>
                  <th>1005</th>
                  <td>2018/05/26（土）</td>
                  <td>32 商品</td>
                  <td>3 %</td>
                  <td>18,000 円</td>
                </tr>
                <tr>
                  <th>1004</th>
                  <td>2018/05/25（金）</td>
                  <td>27 商品</td>
                  <td>15 %</td>
                  <td>22,000 円</td>
                </tr>
                <tr>
                  <th>1003</th>
                  <td>2018/05/24（木）</td>
                  <td>26 商品</td>
                  <td>11 %</td>
                  <td>15,000 円</td>
                </tr>
                <tr>
                  <th>1002</th>
                  <td>2018/05/23（水）</td>
                  <td>24 商品</td>
                  <td>12 %</td>
                  <td>11,000 円</td>
                </tr>
                <tr>
                  <th>1001</th>
                  <td>2018/05/22（火）</td>
                  <td>23 商品</td>
                  <td>23 %</td>
                  <td>12,000 円</td>
                </tr>
              </tbody>
            </table>
          </div>

          <button type="button" class="btn btn-primary"
            data-toggle="modal" data-target="#myModal">
            更新する
          </button>

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
      , '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js'
      , $this->Elixir->version('js/watchnote.js')
      ]) ?>
    <!-- Icons -->
    <script>feather.replace()</script>
    <!-- Graphs -->
    <script>
      var ctx = document.getElementById("myChart");
      var myChart = new Chart(ctx, { type: 'line',
        data: {
          labels: [
            '日曜日', '月曜日', '火曜日', '水曜日', '木曜日'
          , '金曜日', '土曜日'
          ], 
          datasets: [{
            data: [15339, 21345, 18483, 24003, 23489, 24092, 12034],
            lineTension: 0,
            backgroundColor: 'transparent',
            borderColor: '#007bff',
            borderWidth: 4,
            pointBackgroundColor: '#007bff'
          }]
        },
        options: {
          scales: { yAxes: [{ ticks: { beginAtZero: false } }]},
          legend: { display: false }
        }
      });
    </script>
    <!-- bootstrap-datepicker -->
    <script>$('.datepicker').datepicker({ language: 'ja' })</script>
