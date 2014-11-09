<div id='section_delete'>
    <link rel='stylesheet' type='text/css' href='CSS/std_data_table.css'>
    <?PHP
    // _____ _____ _____ _____    _____ _____ _____ _____ _____ _____
    //|_   _|   __|  _  |     |  |   __|  _  |  _  | __  |_   _|  _  |
    //  | | |   __|     | | | |  |__   |   __|     |    -| | | |     |
    //  |_| |_____|__|__|_|_|_|  |_____|__|  |__|__|__|__| |_| |__|__|
    //
    // * File: Delete.php
    // * Delete Sections for the dstc e conference web application.
    // * Written by TEAM SPARTA
    // * Last updated: 17-09-14 by Rudhra -->


    // Import libraries.
    require "PHP_DB/dbObject.php";

    // Make our DAL Object.
    $data = new Data();

    // If they clicked confirm delete:
    if (isset($_POST["clicked_delete"])) {
        $data->conference->deleteRow($_GET["id"]);
        header('Location: index.php?page=conference');
    } // if they clicked cancel:
    else if (isset($_POST["clicked_no"])) {
        header('Location: index.php?page=conference');
    }
    // Display confirmation page:
    ?>


    <h1 style='; text-align:center;'>Delete a Conference</h1>
    <table width='100%' border='1' cellpadding='5' cellspacing='0' class='stdDataTable'>
        <thead>
        <tr style='background-color:#999'>
            <td align='left' valign='middle'>Title</td>
            <td align='left' valign='middle'>Description</td>
            <td align='left' valign='middle'>Start Time</td>
            <td align='left' valign='middle'>End Time</td>
            <td align='left' valign='middle'>Organiser</td>
            <td align='left' valign='middle'>Location</td>
            <td align='left' valign='middle'>Venue</td>
            <td align='left' valign='middle'>Contact</td>
        </tr>
        </thead>
        <tbody>
        <?php $row = $data->conference->getRow($_GET["id"]); ?>
        <tr style="font-size:86%;">
            <td align='left' valign='middle'><?= $row["Title"] ?></td>
            <td align='left' valign='middle'><?= $row["Description"] ?></td>
            <td align='left' valign='middle'><?= $row["Start_Time"] ?></td>
            <td align='left' valign='middle'><?= $row["End_Time"] ?></td>
            <td align='left' valign='middle'><?= $row["Organiser"] ?></td>
            <td align='left' valign='middle'><?= $row["Location"] ?></td>
            <td align='left' valign='middle'><?= $row["Name"] ?></td>
            <td align='left' valign='middle'><?= $row["Contact"] ?></td>
        </tr>
        </tbody>
    </table>
    <div style='background-color:#328ABA; color:#FFFFFF; padding-left:20px; margin-top:24px; border-radius:3px;'>
        <table width="100%">
            <tr>
                <td align='left' valign='middle' width='120px'>
                    <img src='http://www.clker.com/cliparts/H/Z/0/R/f/S/warning-icon-md.png' width='100px'/>
                </td>
                <td>
                    <p>By deleting this conference, the following items associated with this conference will also be
                        deleted:</p>
                    <ul>
                        <li>Sections and Sessions</li>
                        <li>Polling items</li>
                        <li>Maps</li>
                        <li>Sponsors</li>
                    </ul>
                </td>
            </tr>
        </table>
    </div>
    <table style='width:100%; margin-top:20px;'>
        <tr>
            <td>Are you sure you want to delete this Conference (and all child records dependant on this conference)?
            </td>
            <td style='text-align:right;'>
                <form method='post' action='index.php?page=conference&action=delete&id=<?= $_GET['id'] ?>'>
                    <input type='submit' name='clicked_no' class='buttonStyle1' value='Cancel'/>
                    <span style='padding-left:10px'><input type='submit' name='clicked_delete' class='buttonStyle1'
                                                           value='Delete'/></span>

                </form>
            </td>
        </tr>
    </table>
</div>

	
