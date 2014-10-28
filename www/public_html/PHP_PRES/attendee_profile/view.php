<div class="attendee_view">
    <link rel="stylesheet" type="text/css" href="CSS/std_data_table.css"/>
    <?PHP
    /*
         _____ _____ _____ _____    _____ _____ _____ _____ _____ _____
        |_   _|   __|  _  |     |  |   __|  _  |  _  | __  |_   _|  _  |
          | | |   __|     | | | |  |__   |   __|     |    -| | | |     |
          |_| |_____|__|__|_|_|_|  |_____|__|  |__|__|__|__| |_| |__|__|

         * File: view.php
         * View Attendee Profiles for the dstc e conference web application.
         * Written by TEAM  SPARTA
         * Last updated: 31-03-14 by Caue
        */

    ////
    //// Setup START
    ////

    // Import libraries.
    require "PHP_DB/dbObject.php";

    // Get a copy of the DAL object.
    $data = new Data();

    ////
    //// Setup END
    ////
    ?>

    <div class="scroll"> <!--Add scroll bar to table -->
        <h1>Attendee Profile</h1>
        <table width="100%" border="1" cellpadding="5" cellspacing="0" class="stdDataTable">
            <thead>
            <tr style="background-color:#999">

                <td align="left" valign="middle">Position type</td>
                <td align="left" valign="middle">Years experience</td>
                <td align="left" valign="middle">Age group</td>
                <td align="left" valign="middle">Gender</td>
                <td align="left" valign="middle"></td>
            </tr>
            </thead>
            <tbody>
            <?PHP
            $table = $data->attendeeProfile->getRow("all");
            // TODO: alert no entries.
            foreach ($table as $row) {
                ?>
                <tr style="font-size:86%;">
                    <td align='left' valign='middle'><?= $row["Position_Type"] ?></td>
                    <td align='left' valign='middle'><?= $row["Years_Experience"] ?></td>
                    <td align='left' valign='middle'><?= $row["Age_Group"] ?></td>
                    <td align='left' valign='middle'><?= $row["Gender"] ?></td>
                    <td align='center' valign='middle'>
                        <a href='index.php?page=attendee_profile&action=edit&id=<?= $row["ID"] ?>'>Edit</a>
                        <a href='index.php?page=attendee_profile&action=delete&id=<?= $row["ID"] ?>'>Delete</a>
                    </td>
                </tr>
            <?PHP
            }
            ?>
            </tbody>
        </table>
    </div>
    <p align='right' style='font-size:75%'> <?PHP echo "Returned: " . date("Y-m-d H:i:s"); ?></p> 
    <span style='text-align:right;'>
        <form method='get' action='index.php'>
            <input type='submit' value='Add Attendee Profile' class='buttonStyle1'/>
            <input type='hidden' name='page' value='attendee_profile'/>
            <input type='hidden' name='action' value='add'/>
        </form>
    </span>
</div>
