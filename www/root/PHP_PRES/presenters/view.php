<?PHP
/*
 _____ _____ _____ _____    _____ _____ _____ _____ _____ _____
|_   _|   __|  _  |     |  |   __|  _  |  _  | __  |_   _|  _  |
  | | |   __|     | | | |  |__   |   __|     |    -| | | |     |
  |_| |_____|__|__|_|_|_|  |_____|__|  |__|__|__|__| |_| |__|__|

 * File: View.php
 * View Presenter for the dstc e conference web application.
 * Written by TEAM SPARTA
 * Last updated: 30-03-14 by William Budds


*/

// Import Libraries
require "PHP_DB/dbObject.php";
require "PHP_PRES/helpers/dateTimePicker.php";

// Get a copy of the DAL object
$data = new Data();

////
//// Setup END
////


?>

<div class="presenters_view">
    <link rel="stylesheet" type="text/css" href="CSS/std_data_table.css"/>

    <!-- Heading -->
    <h1 align="left">Presenters</h1>

    <div class="scroll"> <!--Add scroll bar to table -->
        <table width="100%" border="1" cellpadding="5" cellspacing="0" class="stdDataTable">
            <thead>
            <tr style="background-color:#999" align="left" valign="middle">

                <td>Title</td>
                <td>First Name</td>
                <td>Last Name</td>
                <td>Organisation</td>
                <td>Medical Field</td>
                <td>Position</td>
                <td>Qualification</td>
                <td>Short Bio</td>
                <td>Photo Filepath</td>
                <td>Actions</td>

            </tr>
            </thead>
            <tbody>
            <?PHP

            $table = $data->presenter->getRow("all");
            //Populates the Table from database.
            foreach ($table as $row) {
                ?>

                <tr align="left" valign="middle" style="font-size:86%;">

                    <td><?= $row["Title"]; ?></td>
                    <td><?= $row["First_Name"]; ?></td>
                    <td><?= $row["Last_Name"]; ?></td>
                    <td><?= $row["Organisation"]; ?></td>
                    <td><?= $row["Medical_Field"]; ?></td>
                    <td><?= $row["Position"]; ?></td>
                    <td><?= $row["Qualification"]; ?></td>
                    <td><?= $row["Short_Bio"]; ?></td>
                    <td><?= $row["Filepath"]; ?></td>


                    <td align="center" valign="middle">

                        <a href="index.php?page=presenter&action=edit&id=<?= $row["ID"] ?>">Edit</a>
                        <a href="index.php?page=presenter&action=delete&id=<?= $row["ID"] ?>">Delete</a>

                    </td>
                </tr>
            <?PHP
            }

            ?>
            </tbody>
        </table>
    </div>
    <p align="right" style="font-size:75%"> <?PHP echo "Returned: " . get_Datetime_Now() ?></p> 
    <span style="text-align:right;"><form method="get" action="index.php">
            <input type="submit" class='buttonStyle1' value="Add Presenter"/>
            <input type="hidden" name="page" value="presenter"/>
            <input type="hidden" name="action" value="add"/>
        </form></span>

</div>