<?php

$chartData = Array();
$chartLabel = Array();

foreach ($this->data['Poll'] as $row) {

    array_push($chartData, $row['Count']);
    array_push($chartLabel, $row['Label']);
}

$dataStr = implode(",", $chartData);
$labelStr = implode("|", $chartLabel);

$url = "https://chart.googleapis.com/chart?"
        . "cht=p3&amp;"
        . "chs=850x200&amp;"
        . "chco=034C75&amp;"
        . "chd=t:$dataStr&amp;"
        . "chl=$labelStr";
?>

<div style="margin-right: auto; margin-left: auto; text-align: center;">
    <img src="<?= $url ?>"/>
</div>

<table width='40%' border='1' cellpadding='5' cellspacing='0' class='stdDataTable'
       style='margin-top:44px;margin-left: auto;margin-right: auto;'>
    <thead>
    <tr style='background-color:#999'>
        <td align="left" valign="middle">Option</td>
        <td align="left" valign="middle">Result</td>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($this->data['Poll'] as $row) {
        ?>
        <tr style="font-size:13px">
            <td align='left' valign='middle'><?= $row["Label"] ?></td>
            <td align='left' valign='middle'><?= $row["Count"] ?></td>
        </tr>
    <?php
    }
    ?>
    </tbody>
</table>
