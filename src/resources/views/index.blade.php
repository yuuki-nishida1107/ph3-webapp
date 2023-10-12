<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>webapp</title>
    <link rel="stylesheet" href="{{ asset('reset.css') }}">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.min.css">
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
</head>
<body>
    <header>
        <div class="header-container">
            <nav>
                <div class="header-logo">
                    <img src="./assets-ph1-website/img/logo.svg" alt="">
                    <span>{{$weeks}}th week</span>
                </div>
                <ul class="main-nav">
                    <li><button class="button">記録・投稿</button></li>
                </ul>
            </nav>
        </div>
    </header>
    <main>
        <div class="main-container">
            <div class="times-container">
            <ul class="times">
                <li class="time">
                    <div class="title">Today</div>
                    <div class="hours">{{$todays}}</div>
                    <div class="hour">hour</div>
                </li>
                <li class="time">
                    <div class="title">Month</div>
                    <div class="hours">{{$months ?? '0'}}</div>
                    <div class="hour">hour</div>
                </li>
                <li class="time">
                    <div class="title">Total</div>
                    <div class="hours">{{$totals ?? '0'}}</div>
                    <div class="hour">hour</div>
                </li>
            </ul>
            <div class="gragh-container">
                <div class="ex-chart-container">
                <canvas id="ex_chart"></canvas>
                </div>
            </div>
            </div>
        <div class="circle-container">
            <ul class="circles">
                <li class="language circle">
                    <div class="title-two"><span>学習言語</span></div>
                    <div class="language-inner">
                        <canvas id="language_circle"></canvas>
                    </div>
                </li>
                <li class="contents circle">
                    <div class="title-two"><span>学習コンテンツ</span></div>
                    <div class="content-inner">
                        <canvas id="content_circle"></canvas>
                    </div>
                </li>
            </ul>
        </div>
        </div>

        <div class="modal-container js-modal-container">
                <div class="modal">
                    <div class="test">
                        <button class="modal-close-btn  js-btn">✖️</button>
                    </div>
                    <form action="{{ route('top.store') }}" method="POST">
                        @csrf
                <div class="modal-inner">
                    <div class="modal-left">
                        <div class="modal-day">
                            <span class="ten">学習日</span>
                            <input type="date" class="hoge" name="date">
                        </div>
                        <div class="modal-content">
                            <p class="ten">学習コンテンツ（複数選択可)</p>
                                <select name="content">
                                    @foreach($contents as $content)
                                    <option value="{{$content->id}}" >{{$content->content}}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="modal-language">
                            <p class="ten">学習言語（複数選択可)</p>
                            <select name="language">
                                @foreach($languages as $language)
                                <option value="{{$language->id}}" >{{$language->language}}</option>
                                @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="modal-right">
                        <div class="modal-hour">
                            <p class="ten">学習時間</p>
                            <input type="text" class="hoge" name="time">
                        </div>
                        <div class="modal-twitter">
                            <p class="ten"> Twitter用コメント</p>
                            <textarea class="twitterComent" name="twitterComent" id="js-tweet-area" cols="30" rows="10"placeholder="140文字以内で入力"></textarea>
                        </div>
                        <div class="modal-share">
                            <div class="twitter-check">
                                <input class="check-design" type="checkbox" name="twitter" id="twitter">
                                <label for="twitter">Twitterにシェアする</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-btn">
                    <button type="submit" class="button-modal">記録・投稿</button>
                </div>
            </div>
        </div>
        </form>
        <div class="loading-container">
            <div class="loading">
            <span class="loading-circle"></span>
            </div>
        </div>
        <div class="complete-container js-complete-container">
            <div class="complete">
                <div class="testTwo">
                    <button class="complete-close-btn  js-complete-btn">✖️</button>
                </div>
            <div class="test-container">
                <div class="complete-english">
                    <span class="awesome">AWESOME!</span>
                </div>
                <div class="complete-check-container">
                    <span class="complete-check"></span>
                    <span class="checkCircle"></span>
                </div>
                <div class="complete-content">
                    <span>記録・投稿<br>完了しました</span>
                </div>
            </div>
            </div>

        </div>
    </main>
    <footer>
        <div class="footer-container">
            {{$now_format}}
        </div>
    </footer>
    <div class="responsiveButtonContainer">
        <button class="responsiveButton">記録・投稿</button>
    </div>
    <script src="../../script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    {{-- <script src="../../chart.js"></script> --}}
    <script>


Chart.register(ChartDataLabels);

let ctx = document.getElementById("ex_chart");
var gradientStops = [
    { offset: 0, color: 'rgba(65,105,225)' },  // 始点のカラー
    { offset: 0.5, color: 'rgba(30,144,255)' },  // 中間ポイント
    { offset: 1, color: 'rgba(135,206,250)' }  // 終点のカラー
];

var data = {
    labels: {!! json_encode($dailyData->pluck('date')) !!},
    datasets: [{
      label:"",
        data: {!! json_encode($dailyData->pluck('total_time')) !!},
        barPercentage: 0.7,
        backgroundColor: createLinearGradient(gradientStops),
        borderWidth:1,
        borderRadius: 50,
        borderSkipped: 'bottom',
        // borderSkipped: false,
    }]
};

function createLinearGradient(gradientStops) {
    var ctx = document.getElementById('ex_chart').getContext('2d');
    var gradient = ctx.createLinearGradient(0, 0, 0, 300); // 始点(x, y) と 終点(x, y) を指定

    gradientStops.forEach(function (stop) {
        gradient.addColorStop(stop.offset, stop.color);
    });

    return gradient;
}

var options = {
  maintainAspectRatio: false ,
  responsive: true,
  scales:{
  x:{
    grid: {
      display: false,
      drawBorder: false,
      //borderを消す
    },
    ticks:{
      maxRotation: 0,
      minRotation: 0,
      stepSize:2,
      min:1,
      max:30,
      color: "#97b9d1",
      callback:function(index,value){
        return index%2 !== 0 ? this.getLabelForValue(value) : "";
      }
    }
    },
  y: {
    grid: {
      display: false,
      drawBorder: false,
      //borderを消す
    },
    scaleLabel: {
      display: window.screen.width > 414,
      //省略
  },
    ticks: {
        stepSize:2,
        callback: function(value, index, values) {
            return value + 'h';
        },
        color: "#97b9d1",
    },
    plugins: {
      legend: {
        display: false,
      },
      datalabels: {
        display: false,
      },
    },
}}};

var ex_chart = new Chart(ctx, {
    type: 'bar',
    data: data,
    options: options
});
;





var chartDataCollection = {!! json_encode($chartData) !!};
const bgColors = ["#0345ec", "#0f71bd", "#20bdde", "#3ccefe", "#b29ef3", "#6d46ec", "#4a17ef", "#3105c0"];

  let language_ctx = document
    .getElementById("language_circle")
    .getContext("2d");
  new Chart(language_ctx, {
    type: "doughnut",
    data: {
      labels: chartDataCollection.map(item => item.label),
      datasets: [
        {
          datalabels: {
            color: "#ffffff",
            formatter: function (value, context) {
              return value + "%";
            }},
          data: chartDataCollection.map(item => item.data),
          backgroundColor: bgColors,
        },
      ],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins:{
        legend: {
          position: "bottom", 
          labels:{
            boxWidth:22,
            padding:24,
            usePointStyle:true,
            textAlign:'left',
            font:{
              size:14
            }
          }
        }
      }
    },
  });



  var contentsDataCollection = {!! json_encode($contentsData) !!};
  let content_ctx = document.getElementById("content_circle").getContext("2d");
  new Chart(content_ctx, {
    type: "doughnut",
    data: {
      labels: contentsDataCollection.map(item => item.label),
      datasets: [
        {
          data:contentsDataCollection.map(item => item.data),
          backgroundColor: bgColors,
          datalabels: {
            color: "#ffffff",
            formatter: function (value, context) {
              return value + "%";
            }},
    }],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          position: "bottom", 
          labels:{
            boxWidth:22,
            padding:24,
            usePointStyle:true,
            textAlign:'left',
            font:{
              size:14
            }
          }
        }
      },
    },
  });
    </script>
</body>
</html>
