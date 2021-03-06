<div id='attendee_profile_delete'>
    <link rel='stylesheet' type='text/css' href='CSS/std_data_table.css'>
    <?PHP
    /*
     _____ _____ _____ _____    _____ _____ _____ _____ _____ _____
    |_   _|   __|  _  |     |  |   __|  _  |  _  | __  |_   _|  _  |
      | | |   __|     | | | |  |__   |   __|     |    -| | | |     |
      |_| |_____|__|__|_|_|_|  |_____|__|  |__|__|__|__| |_| |__|__|

     * File: delete.php
     * Delete an Attendee Profile confirmation for the dstc eConference web application.
     * Written by TEAM SPARTA
     * Last updated: 31-03-14 by Caue
    */

    // Import libraries.
    require "PHP_DB/dbObject.php";

    // Make our DAL Object.
    $data = new Data();

    // If they clicked confirm delete:
    if (isset($_POST["clicked_delete"])) {
        $data->attendeeProfile->deleteRow($_GET["id"]);
        header('Location: index.php?page=attendee_profile');
    } // if they clicked cancel:
    else if (isset($_POST["clicked_no"])) {
        header('Location: index.php?page=attendee_profile');
    }
    // Display confirmation page:
    ?>

    <!-- Back button -->
    <div id='backButton' style='float: left;'>
        <form action='index.php' method='get'>
            <input type='hidden' name='page' value='attendee_profile'/>
            <input type='submit' class='buttonStyle1' value='Go Back'/>
        </form>
    </div>

    <h1 style='; text-align:center;'>Delete an Attendee Profile</h1>
    <table width='100%' border='1' cellpadding='5' cellspacing='0' class='stdDataTable'>
        <thead>
        <tr style='background-color:#999'>
            <td align="left" valign="middle">Profile Id</td>
            <td align="left" valign="middle">Position type</td>
            <td align="left" valign="middle">Years experience</td>
            <td align="left" valign="middle">Age group</td>
            <td align="left" valign="middle">Gender</td>
        </tr>
        </thead>
        <tbody>
        <?PHP
        $rowData = $data->attendeeProfile->getRow($_GET["id"]);
        ?>
        <tr style="font-size:86%;">
            <td align='left' valign='middle'><?= $rowData["ID"] ?></td>
            <td align='left' valign='middle'><?= $rowData["Position_Type"] ?></td>
            <td align='left' valign='middle'><?= $rowData["Years_Experience"] ?></td>
            <td align='left' valign='middle'><?= $rowData["Age_Group"] ?></td>
            <td align='left' valign='middle'><?= $rowData["Gender"] ?></td>

        </tbody>
    </table>
    <div style='background-color:#328ABA; color:#FFFFFF; padding-left:20px; margin-top:24px; border-radius:3px;'>
        <table width="100%">
            <tr>
                <td align='left' valign='middle' width='120px'>
                    <img src='http://www.clker.com/cliparts/H/Z/0/R/f/S/warning-icon-md.png' width='100px'/>
                </td>
                <td>
                    <p>By deleting this profile, all the data related to this attendee will be permanently removed from
                        the database.</p>
                </td>
            </tr>
        </table>
    </div>
    <table style='width:100%; margin-top:20px;'>
        <tr>
            <td>Are you sure you want to delete this Attendee Profile?</td>
            <td style='text-align:right;'>
                <form method='post' action='index.php?page=attendee_profile&action=delete&id=<?= $_GET['id'] ?>'>
                    <input type='submit' name='clicked_no' class='buttonStyle1' value='Cancel'/>
                    <span style='padding-left:10px'><input type='submit' name='clicked_delete' class='buttonStyle1'
                                                           value='DELETE'/></span>

                </form>
            </td>
        </tr>
    </table>
</div>

	
