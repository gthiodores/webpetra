/* globals Chart:false, feather:false */
function draw_graph (id, label, data, beginAtZero) {
  'use strict'

  feather.replace();

  // Graphs
  var ctx = document.getElementById(id);
  // eslint-disable-next-line no-unused-vars
  var myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: label,
      datasets: [{
        data: data,
        lineTension: 0,
        backgroundColor: 'transparent',
        borderColor: '#007bff',
        borderWidth: 4,
        pointBackgroundColor: '#007bff'
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: beginAtZero
          }
        }]
      },
      legend: {
        display: false
      }
    }
  })
};
