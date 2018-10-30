<?php
/**
 * Created by PhpStorm.
 * User: Hoc_Anms
 * Date: 10/4/2018
 * Time: 9:04 AM
 */
?>
<!DOCTYPE html>

<html>

<head>
    <link rel="shortcut icon" type="image/png" href="/favicon.jpg"/>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <link rel="shortcut icon" type="image/png" href="/favicon.png"/>
</head>

<body>

<div style="height:410px;min-height:100px;margin:0 auto;" id="main"> </div>
<p></p>

<script type="text/javascript">

    Highcharts.setOptions({
        global: {
            useUTC: false
        }
    });
    function activeLastPointToolip(chart) {
        var points = chart.series[0].points;
        chart.tooltip.refresh(points[points.length -1]);
    }
    var temp_1 = 10.21;
    // alert(json_temp);
    $('#main').highcharts({
        chart: {
            type: 'spline',
            animation: Highcharts.svg,
            marginRight: 10,
            events: {
                load: function () {

                    var series_temp = this.series[0],
                        chart = this;
                    setInterval(function () {
                        var xmlhttp = new XMLHttpRequest();
                        var url = "data.json";
                        xmlhttp .overrideMimeType("application/json");
                        xmlhttp.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {
                                var myArr = JSON.parse(this.responseText);
                                json_temp = myArr['temp']
                                console.log("Temp:", json_temp );
                            }
                        };
                        xmlhttp.open("GET", url, true);
                        xmlhttp.send();

                        var x = (new Date()).getTime(),
                            y_temp = Number(json_temp),
                        console.log(typeof(y_temp));
                        console.log("YT:", y_temp);

                        series_temp.addPoint([x, y_temp], true, true);
                        activeLastPointToolip(chart);
                    }, 3000);
                }
            }
        },
        title: {
            text: 'Temperature & Humidity'
        },
        credits: {
            enabled: false
        },
        xAxis: {
            type: 'datetime',
            tickPixelInterval: 150
        },
        yAxis: {
            title: {
                text: 'data sensor'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            formatter: function () {
                return '<b>' + this.series.name + '</b><br/>' +
                    Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) + '<br/>' +
                    Highcharts.numberFormat(this.y, 2);
            }
        },
        legend: {
            enabled: false
        },
        exporting: {
            enabled: false
        },
        series: [
            {
                name: 'temperature',
                data: (function () {
                // generate an array of random data
                    var data = [],
                        time = (new Date()).getTime(),
                        i;
                    for (i = -19; i <= 0; i += 1) {
                        data.push({
                            x: time + i * 1000,
                            y: Math.random()
                        });
                    }
                    return data;
                }())
            }]
    }, function(c) {
        activeLastPointToolip(c)
    });

</script>

</body>



</html>
