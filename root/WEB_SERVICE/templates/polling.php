<?php
//
//// Chart data array with Column labels
//$chartData = Array(Array('Answer', 'Submissions'));
//
//// Build chart data array
//foreach ($this->data['Poll'] as $row) {
//    array_push($chartData, Array($row['Label'] . ' -  ' . $row['Count'], intval($row['Count'])));
//}
//
?>

<html>
<head>
    <script type="text/javascript" src="../../../SCRIPTS_THIRD_PARTY/jquery/jquery-1.11.0.min.js"></script>
    <script src="https://www.google.com/jsapi"></script>
    <script>
        var chartData = [];
        var chart = null;
        google.load("visualization", "1", {packages: ["corechart"]});
        google.setOnLoadCallback(getData);

        function drawChart() {
            if (chart === null) {
                chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
            }

            chart.draw(chartData, { // Options
                is3D: true,
                legend: {
                    textStyle: {
                        fontSize: 18
                    }
                }
            });
            setTimeout(getData, 10000);
        }

        function getData() {

            $.getJSON("<?= $this->data['URL']?>").
                    done(function (data, status, xhr) {
                        chartData = new google.visualization.DataTable();

                        chartData.addColumn('string', 'Answer');
                        chartData.addColumn('number', 'Submissions');

                        chartData.addRows(data.length);
                        for (i = 0; i < data.length; i++) {
                            chartData.setCell(i, 0, data[i].Label);
                            chartData.setCell(i, 1, parseInt(data[i].Count));
                        }

                    }).
                    done(drawChart);
        }
    </script>
    <style>
        h1 {
            position: fixed;
            text-align: center;
            top: 0;
            width: 100%;
            z-index: 100;
        }

        #piechart_3d {
            height: 100%;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 50;
        }
    </style>
</head>
<body>

<h1><?= $this->data['Question'] ?></h1>

<div id="piechart_3d"></div>

</body>
</html>

