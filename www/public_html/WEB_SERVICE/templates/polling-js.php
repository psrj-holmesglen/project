<?php

// Chart data array with Column labels
$chartData = Array(Array('Answer', 'Submissions'));

// Build chart data array
foreach ($this->data['Poll'] as $row) {
    array_push($chartData, Array($row['Label'] . ' -  ' . $row['Count'], intval($row['Count'])));
}
?>

<html>
<head>
    <script src="https://www.google.com/jsapi"></script>
    <script>
        google.load("visualization", "1", {packages: ["corechart"]});
        google.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable(<?= json_encode($chartData) ?>);
            var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
            chart.draw(data, { // Options
                is3D: true,
                legend: {
                    textStyle: {
                        fontSize: 18
                    }
                }
            });
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

<h1><?= $this->data['Poll'][0]['Question'] ?></h1>

<div id="piechart_3d"></div>

</body>
</html>

