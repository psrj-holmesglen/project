<div id='user_delete'>
    <link rel='stylesheet' type='text/css' href='CSS/std_data_table.css'>
    <?PHP
    // _____ _____ _____ _____    _____ _____ _____ _____ _____ _____
    //|_   _|   __|  _  |     |  |   __|  _  |  _  | __  |_   _|  _  |
    //  | | |   __|     | | | |  |__   |   __|     |    -| | | |     |
    //  |_| |_____|__|__|_|_|_|  |_____|__|  |__|__|__|__| |_| |__|__|
    //
    // * File: Delete.php
    // * Delete User for the dstc e conference web application.
    // * Written by TEAM SPARTA
    // * Last updated: 28-03-14 by Jennifer de Peyrecave -->


    // Import libraries.
    require "PHP_DB/dbObject.php";
	

    // Make our DAL Object.
    $data = new Data();

    // If they clicked confirm delete:
    if (isset($_POST["clicked_delete"])) {
        $data->user->deleteRow($_GET["id"]);
        header('Location: index.php?page=user');
    } // if they clicked cancel:
    else if (isset($_POST["clicked_no"])) {
        header('Location: index.php?page=user');
    }

    ?>
    <h1 style='; text-align:center;'>Delete a User</h1>
    <table width='100%' border='1' cellpadding='5' cellspacing='0' class='stdDataTable'>
        <thead>
        <tr style='background-color:#999'>
            <td>ID</td>
            <td>First Name</td>
            <td>Last Name</td>
            <td>User Name</td>
            <td>Email</td>
            <td>Password</td>

        </tr>
        </thead>
        <tbody>
        <?PHP $row = $data->user->getRow($_GET["id"]); ?>
        <tr style='font-size:86%;'>
            <td align='left' valign='middle'><?= $row["ID"] ?></td>
            <td align='left' valign='middle'><?= $row["First_Name"] ?></td>
            <td align='left' valign='middle'><?= $row["Last_Name"] ?></td>
            <td align='left' valign='middle'><?= $row["User_name"] ?></td>
            <td align='left' valign='middle'><?= $row["Email"] ?></td>
            <td align='left' valign='middle'><?= $row["Password"] ?></td>

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
                    <p>You are now deleting the user shown above</p>

                </td>
            </tr>
        </table>
    </div>

    <table>
        <tr>
            <td>Are you sure you want to delete this User?</td>
            <td style='text-align:right;'>
                <form method='post' action='index.php?page=user&amp;action=delete&amp;id=<?= $_GET['id'] ?>'>
                    <input type='submit' name='clicked_no' value='Cancel' class="buttonStyle1"/>
                    <span style='padding-left:10px'><input type='submit' name='clicked_delete' value='Delete'
                                                           class="buttonStyle1"/></span>
                </form>
            </td>
        </tr>
    </table>
</div>