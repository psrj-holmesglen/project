<?PHP
/*
     _____ _____ _____ _____    _____ _____ _____ _____ _____ _____
    |_   _|   __|  _  |     |  |   __|  _  |  _  | __  |_   _|  _  |
      | | |   __|     | | | |  |__   |   __|     |    -| | | |     |
      |_| |_____|__|__|_|_|_|  |_____|__|  |__|__|__|__| |_| |__|__|

     * File: view.php
     * View Session for the dstc e conference web application.
     * Written by TEAM  SPARTA
     * Last updated: 27-03-14 by Tom Budds
    */

////
//// Setup START
////

// Import libraries.
require "PHP_DB/dbObject.php";
require "PHP_PRES/helpers/dateTimePicker.php";
// Get a copy of the DAL object.
$data = new Data();
$CSId = "All";

////
//// Setup END
////
if (isset($_POST['conference_selected'])) {
    // Grab our data from the form.
    $CSId = $_POST["selCSId"];
}
?>


<div class="session_view">
    <link rel="stylesheet" type="text/css" href="CSS/std_data_table.css"/>
    <h1>Sessions</h1>

    <form method="post" action="index.php?page=session&action=view">
        <table>
            <tr>
                <td class='label'>Select Section:</td>
                <td>
                    <select name='selCSId' class='selectStyle1' style="width:auto">
                        <option value="All">All Sections</option>
                        <?php
                        $data->section->printDropDownOptions($CSId, "Section_Title");
                        ?>
                    </select>
                </td>
                <td>

                    <input type="submit" name="conference_selected" value="Filter" class="buttonStyle1"/>
                </td>
            </tr>
        </table>
    </form>
    <?php
    //if the slection in the drop down list has no values within
    if ($data->session->getRowByMatch("Conference_Section", $CSId) || $CSId == "All"){

    ?>

    <div class="scroll"> <!--Add scroll bar to table -->
        <table width="100%" border="1" cellpadding="5" cellspacing="0" class="stdDataTable">
            <thead>
            <tr style="background-color:#999" align="left" valign="middle">

                <td>Title</td>
                <td>Description</td>
                <td>Start</td>
                <td>Finish</td>
                <td>Location</td>
                <td>Session Chairperson</td>
                <td>Actions</td>
            </tr>
            </thead>
            <tbody>
            <?PHP
            //Get and display sessions from DB
            if ($CSId == "All")
                $table = $data->session->getRow("all");
            else
                $table = $data->session->getRowByMatch("Conference_Section", $CSId);
            // TODO: alert no entries.
            foreach ($table as $row) {
                ?>
                <tr align="left" valign="middle" style="font-size:86%;">


                    <td><?= $row["Title"] ?></td>
                    <td><?= $row["Description"] ?></td>
                    <td><?= $row["Start_Time"] ?></td>
                    <td><?= $row["End_Time"] ?></td>
                    <td><?= $row["Room_Location"] ?></td>
                    <td><?= $row["Session_Chairperson"] ?></td>

                    <td align="center" valign="middle">
                        <a href="index.php?page=session&action=edit&id=<?= $row["ID"] ?>">Edit</a>
                        <a href="index.php?page=session&action=delete&id=<?= $row["ID"] ?>">Delete</a>
                    </td>
                </tr>
            <?PHP
            }
            } else {
                echo "No Records Found";
            }
            ?>
            </tbody>
        </table>
    </div>
    
    <p align="right" style="font-size:75%"> <?PHP echo "Returned: " . get_Datetime_Now() ?></p>
    <br/>
    <span style="text-align:right;"><form method="get" action="index.php">
            <input type="submit" value="Add Session" class="buttonStyle1"/>
            <input type="hidden" name="page" value="session"/>
            <input type="hidden" name="action" value="add"/>
        </form></span>

    
</div>