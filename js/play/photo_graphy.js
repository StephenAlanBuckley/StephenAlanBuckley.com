$(function () {
  $('#highcharts_container').highcharts({
    chart: {
      type: 'spline'
    },
    title: {
      text: 'Pictures Taken With Me Over Time'
    },
    subtitle: {
      text: 'Starting When I Moved to NYC'
    },
    xAxis: {
      type: 'datetime',
      dateTimeLabelFormats: {
        month: '%e %b',
        year: '%b'
      }
    },
    yAxis: {
      title: {
        text: 'Number of Pics'
      },
      min: 0
    },
    tooltip: {
      formatter: function() {
        return '<b>' + this.series.name + '</b><br/>' + Highcharts.dateFormat('%e %b', this.x) + ': ' + this.y + ' pics';
      }
    },

    series: [{

