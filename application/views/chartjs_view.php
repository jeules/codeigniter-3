<div class="container h-100">
  <div class="row h-50">
    <div class="col-12 m-auto text-center" style="background-color: rgba(255, 223, 211, 0.4);">
      <canvas id="myChart"></canvas>
    </div>
  </div>
  <div class="row h-50">
    <div class="col-12 m-auto text-center" style="background-color: rgba(149, 125, 173, 0.4);">
      <canvas id="myChart2"></canvas>
    </div>
  </div>
  <div class="row h-50">
    <div class="col-12 m-auto text-center" style="background-color: rgba(226, 240, 203, 0.4);">
      <canvas id="myChart3"></canvas>
    </div>
  </div>
</div>

<?php
  $labels = array('Boston', 'Worcester', 'Springfield', 'Lowell', 'Cambridge', 'New Bedford');
  $data = array(40, 30, 25, 85, 60, 80);
  $backgroundColor = array('red','orange','green','violet','blue','cyan');
?>

<script>
  //Chart standard
  $(document).ready(function() {
    let myChart = document.getElementById('myChart').getContext('2d');
    let massPopChart = new Chart(myChart, {
      type: 'bar', //bar, horizontalBar, pie, line, doughnut, radar, polarArea
      data:{
        labels:['Boston', 'Worcester', 'Springfield', 'Lowell', 'Cambridge', 'New Bedford'],
        datasets:[{
          label:'Population',
          data:[
            61,
            18,
            15,
            25,
            51,
            95
          ],
          //backgroundColor:'green'
          backgroundColor:[
            'green',
            'red',
            'orange',
            'blue',
            'violet',
            'pink'
          ],
          borderWidth: 1,
          borderColor: '#777',
          hoverBorderWidth: 3,
          hoverBorderColor: '#000'
        }]
      },
      options:{}
    });
  });

  //Chart2 from PHP variables
  $(function(){
    let myChart2 = document.getElementById('myChart2').getContext('2d');
    let massPopChart2 = new Chart(myChart2, {
      type: 'polarArea', //bar, horizontalBar, pie, line, doughnut, radar, polarArea
      data:{
        //labels:['Boston', 'Worcester', 'Springfield', 'Lowell', 'Cambridge', 'New Bedford'],
        labels: [<?php echo '"'.implode('", "', $labels).'"'; ?>],
        datasets:[{
          label:'Population',
          data:[<?php echo '"'.implode('", "', $data).'"'; ?>],
          //backgroundColor:'green'
          backgroundColor:[<?php echo '"'.implode('", "', $backgroundColor).'"'; ?>],
          borderWidth: 1,
          borderColor: '#777',
          hoverBorderWidth: 3,
          hoverBorderColor: '#000'
        }]
      },
      options:{}
    });
  });

  //Chart3 ajax
  $(function(){

    var ctx = document.getElementById('myChart3').getContext('2d');
    var json_url = "<?php echo base_url('index.php/main/chart_url'); ?>";

    //Draw empty chart
    var myChart3 = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: [],
        datasets: [{
          label: 'Population',
          fill: false,
          lineTension: 0.1,
          //backgroundColor: "rgba(75,192,192,0.4)",
          backgroundColor: [],
          borderColor: "rgba(75,192,192,1)",
          borderCapStyle: 'butt',
          borderDash: [],
          borderDashOffset: 0.0,
          borderJoinStyle: 'miter',
          pointBorderColor: "rgba(75,192,192,1)",
          pointBackgroundColor: "#fff",
          pointBorderWidth: 1,
          pointHoverRadius: 5,
          pointHoverBackgroundColor: "rgba(75,192,192,1)",
          pointHoverBorderColor: "rgba(220,220,220,1)",
          pointHoverBorderWidth: 2,
          pointRadius: 1,
          pointHitRadius: 10,
          data: [],
          spanGaps: false,
        }]
      },
      options:{
        tooltips: {
              mode: 'index',
              intersect: false
            },
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
      }
    });

    ajax_chart(myChart3, json_url);

    //Function to update chart
    function ajax_chart(chart, url, data){
      var data = data || {};

      $.getJSON(url, data).done(function(response){
        chart.data.labels = response.labels;
        chart.data.datasets[0].data = response.data.population;
        chart.data.datasets[0].backgroundColor = response.data.backgroundcolor;
        chart.update();
      });
    }

  });


</script>