  'use strict';
    $(document).ready(function() {
 dashboard();

 /*Counter Js Starts*/
$('.counter').counterUp({
    delay: 10,
    time: 400
});
/*Counter Js Ends*/

//  Resource bar
    $(".resource-barchart").sparkline([5, 6, 2, 4, 9, 1, 2, 8, 3, 6, 4,2,1,5], {
              type: 'bar',
              barWidth: '15px',
              height: '80px',
              barColor: '#fff',
            tooltipClassname:'abc'
          });

            function setHeight() {
                var $window = $(window);
                var windowHeight = $(window).height();
                if ($window.width() >= 320) {
                    $('.user-list').parent().parent().css('min-height', windowHeight);
                    $('.chat-window-inner-content').css('max-height', windowHeight);
                    $('.user-list').parent().parent().css('right', -300);
                }
            };
            setHeight();

            $(window).on('load',function() {
                setHeight();
            });
        });

 $(window).resize(function() {
        dashboard();
        //  Resource bar
    $(".resource-barchart").sparkline([5, 6, 2, 4, 9, 1, 2, 8, 3, 6, 4,2,1,5], {
              type: 'bar',
              barWidth: '15px',
              height: '80px',
              barColor: '#fff',
            tooltipClassname:'abc'
          });
    });

function dashboard(){

};

  Highcharts.chart('barchart', {
      title: {
          text: 'Tahun 2021 - 2025'
      },
      xAxis: {
          categories: ['2021', '2022', '2023', '2024', '2025']
      },
      labels: {
          items: [{
              html: 'Total fruit consumption',
              style: {
                  left: '130px',
                  top: '18px',
                  color: (Highcharts.theme && Highcharts.theme.textColor) || 'black'
              }
          }]
      },
      series: [{
          type: 'column',
          name: 'SD',
          data: [3, 2, 1, 3, 4],
          color:'#ff2400'
      }, {
          type: 'column',
          name: 'MTS',
          data: [4, 3, 5, 7, 6],
          color:'#00ff7f'
      }, {
          type: 'column',
          name: 'MA',
          data: [3, 4, 2, 9, 5],
          color:'#95a5a6'
      }, {
          type: 'spline',
          name: 'Average',
          data: [3.5, 2.67, 3, 6.33, 3.33],
          marker: {
              lineWidth: 2,
              lineColor: Highcharts.getOptions().colors[3],
              fillColor: 'white'
          }
      }, {
          type: 'pie',
          name: '',
          data: [{
              name: 'Laki-Laki',
              y: 13,
              color: '#87ceeb '
          }, {
              name: 'Perempuan',
              y: 23,
              color:'#ffc1cc '
          },],
          center: [40, 20],
          size: 100,
          showInLegend: false,
          dataLabels: {
              enabled: false
          }
      }]
  });


  Highcharts.chart('piechart', {
      chart: {
          type: 'pie',
          options3d: {
              enabled: true,
              alpha: 45,
              beta: 0
          }
         //  backgroundColor:'#fff'
      },
      title: {
          text: 'Browser market shares at a specific website, 2014'
      },
      tooltip: {
          pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
      },
      plotOptions: {
          pie: {
              allowPointSelect: true,
              cursor: 'pointer',
              depth: 35,
              dataLabels: {
                  enabled: true,
                  format: '{point.name}'
              }
          }
      },
      series: [{
          type: 'pie',
          name: 'Browser share',
          data: [
              {
                 name: 'SD',
                 y: 40.0,
                 sliced: true,
                 selected: true,
                 color:'#2BBBAD'
              },
              {
                 name: 'MTS',
                 y: 26.8,
                 color:'#39444e'
               },
              {
                  name: 'MA',
                  y: 12.8,
                  color:'#2196F3'
              },
          ]
      }]
  });
