<div class="user_view">
    <link rel="stylesheet" type="text/css" href="CSS/std_data_table.css"/>
    <?php
    // _____ _____ _____ _____    _____ _____ _____ _____ _____ _____
    //|_   _|   __|  _  |     |  |   __|  _  |  _  | __  |_   _|  _  |
    //  | | |   __|     | | | |  |__   |   __|     |    -| | | |     |
    //  |_| |_____|__|__|_|_|_|  |_____|__|  |__|__|__|__| |_| |__|__|
    //
    // * File: View.php
    // * View Sections for the dstc e conference web application.
    // * Written by TEAM SPARTA
    // * Last updated: 31-03-14 by Jennifer de Peyrecave -->


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
    <h1>Users</h1>

    <div class="scroll"> <!--Add scroll bar to table -->
        <table width="100%" border="1" cellpadding="5" cellspacing="0" class="stdDataTable" id="viewUser">
            <thead>
            <tr style="background-color:#999" align="left" valign="middle">

                <td>First Name</td>
                <td>Last Name</td>
                <td>User Name</td>
                <td>Email</td>
                <td>Actions</td>
            </tr>
            </thead>
            <tbody>
            <?PHP
            $table = $data->user->getRow("all");
            // TODO: alert no entries.
            foreach ($table as $row) {
                ?>
                <tr style="font-size:86%;">

                    <td align="left" valign="middle"><?= $row["First_Name"] ?></td>
                    <td align="left" valign="middle"><?= $row["Last_Name"] ?></td>
                    <td align="left" valign="middle"><?= $row["User_name"] ?></td>
                    <td align="left" valign="middle"><?= $row["Email"] ?></td>
                    <td align="center" valign="middle">
                        <a href='index.php?page=user&amp;action=edit&amp;id=<?= $row["ID"] ?>'>Edit</a>
                        <a href='index.php?page=user&amp;action=delete&amp;id=<?= $row["ID"] ?>'>Delete</a>
                    </td>
                </tr>
            <?PHP } ?>
            </tbody>
        </table>
    </div>
    <p align="right" style="font-size:75%"> <?PHP echo "Returned: " . date('Y-m-d H:i:s'); ?></p>
    <span style="text-align:right;"><form method="get" action="index.php">
            <input type="submit" value="Add User" class="buttonStyle1"/>
            <input type="hidden" name="page" value="user"/>
            <input type="hidden" name="action" value="add"/>
        </form></span>
