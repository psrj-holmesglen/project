<?PHP
/*
     _____ _____ _____ _____    _____ _____ _____ _____ _____ _____
    |_   _|   __|  _  |     |  |   __|  _  |  _  | __  |_   _|  _  |
      | | |   __|     | | | |  |__   |   __|     |    -| | | |     |
      |_| |_____|__|__|_|_|_|  |_____|__|  |__|__|__|__| |_| |__|__|

     * File: view.php
     * View Conferences for the dstc e conference web application.
     * Written by TEAM  SPARTA
     * Last updated: 25-03-14 by Andy
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
<div class='conferences_view'>
    <link rel="stylesheet" type="text/css" href="CSS/std_data_table.css"/>

    <h1>Conferences</h1>

    <div class="scroll">
        <table width='100%' border='1' cellpadding='5' cellspacing='0' class='stdDataTable'>
            <thead>
            <tr style=''>
                <th align='left' valign='middle'>Title</th>
                <th align='left' valign='middle'>Description</th>
                <th align='left' valign='middle'>Start Time</th>
                <th align='left' valign='middle'>End Time</th>
                <th align='left' valign='middle'>Organiser</th>
                <th align='left' valign='middle'>Location</th>
                <th align='left' valign='middle'>Venue</th>
                <th align='left' valign='middle'>Token</th>
                <th align='left' valign='middle'>Contact</th>
                <th align='middle' valign='middle'>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?PHP
            $table = $data->conference->getRowWithVenueName(null);
            if ($table == null) echo "<tr><td colspan='9'><strong><em>No Entries Found.</em></strong></td></tr>";
            foreach ($table as $row) {
                ?>
                <tr style="font-size:86%;">
                    <td align='left' valign='middle'><?= $row["Title"] ?></td>
                    <td align='left' valign='middle'><?= $row["Description"] ?></td>
                    <td align='left' valign='middle'><?= $row["Start_Time"] ?></td>
                    <td align='left' valign='middle'><?= $row["End_Time"] ?></td>
                    <td align='left' valign='middle'><?= $row["Organiser"] ?></td>
                    <td align='left' valign='middle'><?= $row["Location"] ?></td>
                    <td align='left' valign='middle'><?= $row["Name"] ?></td>
                    <td align='left' valign='middle'><?= $row["Token"] ?></td>
                    <td align='left' valign='middle'><?= $row["Contact"] ?></td>
                    <td align='center' valign='middle'>
                        <a href='index.php?page=conference&action=edit&id=<?= $row["ID"] ?>'>Edit</a>
                        <a href='index.php?page=conference&action=delete&id=<?= $row["ID"] ?>'>Delete</a>
                    </td>
                </tr>
            <?PHP
            }
            ?>
            </tbody>
        </table>
    </div>
    <br/>

    <p align='right' style='font-size:75%'> <?PHP echo "Returned: " . date("Y-m-d H:i:s"); ?></p>
    <br/>
    <!-- Add and clone buttons -->
    <table width="100%">
        <tr>
            <td>
                <div style='text-align:left;'>
                    <form method='get' action='index.php'>
                        <input type='submit' value='Clone Conference' class='buttonStyle1'/>
                        <input type='hidden' name='page' value='conference'/>
                        <input type='hidden' name='action' value='cloneView'/>
                    </form>
                </div>
            </td>
            <td>
                <div style='text-align:right;'>
                    <form method='get' action='index.php'>
                        <input type='submit' value='Add Conference' class='buttonStyle1'/>
                        <input type='hidden' name='page' value='conference'/>
                        <input type='hidden' name='action' value='add'/>
                    </form>
                </div>
            </td>
        </tr>
    </table>
    <!-- Add and clone buttons END -->
</div>