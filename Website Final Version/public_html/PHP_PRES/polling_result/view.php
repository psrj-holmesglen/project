<?PHP
/*
     _____ _____ _____ _____    _____ _____ _____ _____ _____ _____
    |_   _|   __|  _  |     |  |   __|  _  |  _  | __  |_   _|  _  |
      | | |   __|     | | | |  |__   |   __|     |    -| | | |     |
      |_| |_____|__|__|_|_|_|  |_____|__|  |__|__|__|__| |_| |__|__|

     * File: view.php
     * View Polling Result for the dstc e conference web application.
     * Written by TEAM  SPARTA
     * Last updated: 13-05-14 by Shohei
    */

/////////////////////////////////////////////////////////////////////////////////
//																				/
//***Presenters are given URL address from admin like:							/
//***http://localhost/WebApp/root/index.php?page=polling_result&action=view&id=1/
//																				/
/////////////////////////////////////////////////////////////////////////////////

////
//// Setup START
////

// Import libraries.
require "PHP_DB/dbObject.php";

// Get a copy of the DAL object.
$data = new Data();
$SesId = $_GET["id"];

$table = $data->session->getRowByMatch("ID", $SesId);
//Check polling status
foreach ($table as $row) {
    $avaliable = $row["Polling_Available"];
}

//Check number of polling question in a session
$count = $data->pollingQuestion->getRowCount_pq($SesId);

//Retrieve data object from database
$table = $data->pollingQuestion->getRowByMatch("Session", $SesId);


if ($avaliable == 1) {
    //Display error message if polling in the session is not available.
    echo "<h1 style='; text-align:center;'>This Session is currently unavailable.<br/>Sorry....</h1>";
} else {
    //If the session has 1 polling, go straight to the result page
    if ($count == 1) {
        foreach ($table as $row) {
            $pollingID = $row["ID"];
        }


        //Declare URL of the page
        $URL = "http://localhost/WebApp/root/index.php?page=polling_result&action=result&id=" . $pollingID;
        // Move into the page
        header("Location:$URL");
    } else {

        //If the session has many pollings, a presenter can choose a polling result

        ?>


        <h1 style='; text-align:center;'>Polling Questions in Session</h1>

        <table width='100%' border='1' cellpadding='5' cellspacing='0' class='stdDataTable' style="margin-top:30px">
            <thead>
            <tr style='background-color:#999;'>
                <th align="left" valign="middle">Question</th>
                <th align="left" valign="middle">Action</th>
            </tr>
            </thead>
            <tbody><?PHP
            foreach ($table as $row) {
                ?>
                <tr style="font-size:86%; font-size:20px">

                    <td align='left' valign='middle'><?= $row["Polling_Question"] ?></td>
                    <td align='left' valign='middle'><a
                                href='index.php?page=polling_result&action=result&id=<?= $row["ID"] ?>'>Display
                            Result</a></td>
                </tr>
            <?PHP } ?>
            </tbody>
        </table>

    <?PHP
    }
}
?>