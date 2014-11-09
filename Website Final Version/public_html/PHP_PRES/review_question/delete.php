<div id='presenter_delete'>
    <link rel='stylesheet' type='text/css' href='CSS/std_data_table.css'>
    <?PHP
    // _____ _____ _____ _____    _____ _____ _____ _____ _____ _____
    //|_   _|   __|  _  |     |  |   __|  _  |  _  | __  |_   _|  _  |
    //  | | |   __|     | | | |  |__   |   __|     |    -| | | |     |
    //  |_| |_____|__|__|_|_|_|  |_____|__|  |__|__|__|__| |_| |__|__|
    //
    // * File: Delete.php
    // * Delete presenters for the dstc e conference web application.
    // * Written by TEAM SPARTA
    // * Last updated: 31-03-14 by Jennifer de Peyrecave -->


    // Import libraries.
    require "PHP_DB/dbObject.php";

    // Make our DAL Object.
    $data = new Data();

    // If they clicked confirm delete:
    if (isset($_POST["clicked_delete"])) {
        $data->sessionQuestion->deleteRow($_GET["id"]);
        header('Location: index.php?page=review_question');
    } // if they clicked cancel:
    else if (isset($_POST["clicked_no"])) {
        header('Location: index.php?page=review_question');
    }

    ?>
    <h1 style='; text-align:center;'>Delete the Question</h1>
    <table width='100%' border='1' cellpadding='5' cellspacing='0' class='stdDataTable'>
        <thead>
        <tr style='background-color:#999'>
            <td>ID</td>
            <td>Question</td>
            <td>Status</td>
            <td>Session</td>

        </tr>
        </thead>
        <tbody>
        <?PHP $row = $data->sessionQuestion->getRow($_GET["id"]); ?>
        <tr style='font-size:86%;'>
            <td><?= $row["ID"]; ?></td>
            <td><?= $row["Question"]; ?></td>
            <td><?= $row["Accepted"]; ?></td>
            <td><?= $row["Session"]; ?></td>
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
                    <p>You are now deleting the above question</p>

                </td>
            </tr>
        </table>
    </div>

    <table>
        <tr>
            <td>Are you sure you want to delete this question?</td>
            <td style='text-align:right;'>
                <form method='post' action='index.php?page=review_question&amp;action=delete&amp;id=<?= $_GET['id'] ?>'>
                    <input type='submit' name='clicked_no' value='Cancel' class="buttonStyle1"/>
                    <span style='padding-left:10px'><input type='submit' name='clicked_delete' value='Delete'
                                                           class="buttonStyle1"/></span>
                </form>
            </td>
        </tr>
    </table>
</div>