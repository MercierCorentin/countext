var scaleToMoment = {'Y':'year', 'm':'month', 'd':'day', 'H':'hour', 'i':'minute', 's':'second'};
    var dateFormat = 'YYYY-MM-DD';
    var data = [];
    // TO DO: responsive chart
    var ctx = document.getElementById('chart1').getContext('2d');
    ctx.canvas.width = 1000;
    ctx.canvas.height = 300;

    var color = Chart.helpers.color;
    var cfg = {
        type: 'bar',
        data: {
            datasets: [{
                label: 'Visits',
                backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
                borderColor: window.chartColors.red,
                data: data,
                type: 'line',
                pointRadius: 0,
                fill: false,
                lineTension: 0,
                borderWidth: 2
            }]
        },
        options: {
            scales: {
                xAxes: [{
                    type: 'time',
                    distribution: 'series',
                    ticks: {
                        source: 'data',
                        autoSkip: true
                    }
                }],
                yAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: 'Visits'
                    }
                }]
            },
            tooltips: {
                intersect: false,
                mode: 'index',
                callbacks: {
                    label: function(tooltipItem, myData) {
                        var label = myData.datasets[tooltipItem.datasetIndex].label || '';
                        if (label) {
                            label += ': ';
                        }
                        label += myData.datasets[tooltipItem.datasetIndex].data[tooltipItem.index].y;
                        return label;
                    }
                }
            }
        }
    };

    var chart = new Chart(ctx, cfg);

// Get Data from the server and refresh chart
function getData(linkId, startDateTime, endDateTime, scale){
    $.ajax({
        url: "/visits/" + linkId + "/" + startDateTime + "/" + endDateTime + "/" + scale,
        type: 'GET',
        dataType: 'json',
        success: function(data, state){
            chartData = [];
            chartDate = moment(startDateTime, dateFormat);

            while(chartDate.isBefore(endDateTime, scaleToMoment[scale])){
                // 0 if not found. Else number of visits 
                valueToPush = getVisits(data, chartDate.format(scaleToMomentFormat(scale)));
                chartData.push({
                    t: chartDate.valueOf(),
                    y: valueToPush
                });
                // Add 1 unity of the scale
                chartDate = chartDate.clone().add(1, scaleToMoment[scale]+"s");
            }

            // Affecting new data to chart data
            chart.data.datasets[0].data = chartData;
            // Refresh view of chart
            chart.update();
        },
        error : function(result, state, error){
            // TO DO: display error message to user
            console.log(result.responseText);
            console.log(state);
            console.log(error);
        }
    });
}