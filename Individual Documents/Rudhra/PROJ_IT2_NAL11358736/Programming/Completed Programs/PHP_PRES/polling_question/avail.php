<!--                                                            
 _____ _____ _____ _____    _____ _____ _____ _____ _____ _____ 
|_   _|   __|  _  |     |  |   __|  _  |  _  | __  |_   _|  _  |
  | | |   __|     | | | |  |__   |   __|     |    -| | | |     |
  |_| |_____|__|__|_|_|_|  |_____|__|  |__|__|__|__| |_| |__|__|
                                                                
 * File: avail.php
 * Edit Polling availability for the dstc e conference web application.
 * Written by TEAM SPARTA 
 * Last updated: 17-05-14 by Shohei Masunaga

  -->
<div id='polling_question_availability'>
    <link rel='stylesheet' type='text/css' href='CSS/std_form.css'>
    <?PHP
    //Prepare DB connection and functions
    require "PHP_DB/dbObject.php";

    require "PHP_PRES/helpers/dateTimePicker.php";
    $data = new Data();


    // If submit has been clicked:
    if (isset($_POST['clicked_submit'])) {

        $row = $data->pollingQuestion->getRow($_GET["id"]);
        print_r($row);
//			$SesId = $row["Session"];

//			$row = $data->session->getRow($SesId);

//            $Titl = $row["Title"];
//            $Desc = $row["Description"];
//            $Star = dtConvertToArray($row["Start_Time"]);
//            $EndT = dtConvertToArray($row["End_Time"]);
//            $Room = $row["Room_Location"];
//            $Chair = $row["Session_Chairperson"];
//			$CSId = $row["Conference_Section"];
//            $Feed = $row["Feedback"];
//			$Sect = $row["Feedback_Section"];

        $Poll = $_POST['txtPoll'];
        $Open = $_POST['txtOpen'];

        $validated = true;

        // Once the data has been validated, let's insert the data.
        if ($validated) {

//            $biPoll;
//            $biOpen;

            if ($Poll == 'Yes')
                $biPoll = 1;
            else
                $biPoll = 0;

            if ($Open == 'Yes')
                $biOpen = 1;
            else
                $biOpen = 0;


            $newData = array(
                    "ID" => $row['ID'],
                    "Polling_Question" => $row['Polling_Question'],
                    "session" => $row['session'],
                    "Available" => $biPoll,
                    "Open" => $biOpen

//                    "Title"		                => $Titl,
//                    "Description"               => $Desc,
//                    "Start_Time"                => dtConvertToString($Star),
//                    "End_Time"                  => dtConvertToString($EndT),
//                    "Room_Location"             => $Room,
//                    "Session_Chairperson"       => $Chair,
//                    "Polling_Available"         => $biPoll,
//                    "Polling_Open"              => $biOpen,
//                    "Conference_Section"        => $CSId,
//                    "Feedback"                  => $Feed,
//					"Feedback_Section"			=> $Sect,
            );
            print_r($newData);
//            if ($data->session->updateRow($_GET["id"], $newData)) {
            if ($data->pollingQuestion->updateRow($_GET["id"], $newData)) {
                header("Location: index.php?page=polling_question");
            }
        }
    } else {

        $row = $data->pollingQuestion->getRow($_GET["id"]);

//			$SesId = $row["Session"];

//			$row2 = $data->session->getRow($SesId);
//            $Poll = $row2["Polling_Available"];
//            $Open = $row2["Polling_Open"];
        $Poll = $row["Available"];
        $Open = $row["Open"];
    }
    ?>

    <div id='backButton' style='float: left;'>
        <form action='index.php' method='get'>
            <input type='hidden' name='page' value='polling_question'/>
            <input type='submit' class='buttonStyle1' value='Go Back'/>
        </form>
    </div>

    <h1 style='text-align:center'>Manage Polling Availability</h1>
    <br/>

    <form method='post' action='index.php?page=polling_question&action=availability&id=<?= $_GET["id"] ?>'>
        <table class='std_form'>
            <tr>
                <td class='label'>Polling Available:</td>
                <td>
                    <select name="txtPoll" class='selectStyle1'>
                        <option value='Yes'<?php if ($Poll == 1) echo " selected=\"selected\" "; ?>>Yes</option>
                        <option value='No'<?php if ($Poll == 0) echo " selected=\"selected\" "; ?>>No</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <hr>
                </td>
            </tr>
            <tr>
                <td class='label'>Polling Open:</td>
                <td>
                    <select name="txtOpen" class='selectStyle1'>
                        <option value='Yes'<?php if ($Open == 1) echo " selected=\"selected\" "; ?>>Yes</option>
                        <option value='No'<?php if ($Open == 0) echo " selected=\"selected\" "; ?>>No</option>
                    </select>
                </td>


            </tr>
            <tr>
                <td colspan='2'><span style='float: right;'>
                	<br/>
                	<input type='submit' value='Reset' name='clicked_reset' class="buttonStyle1"/>
                    <input type='submit' value='Submit' name='clicked_submit' class='buttonStyle1'/>
                    </span>
                </td>
            </tr>
        </table>
    </form>
</div>