<div id='feedback_form_delete'>
    <link rel='stylesheet' type='text/css' href='CSS/std_data_table.css'>
    <?PHP
    /*
     _____ _____ _____ _____    _____ _____ _____ _____ _____ _____
    |_   _|   __|  _  |     |  |   __|  _  |  _  | __  |_   _|  _  |
      | | |   __|     | | | |  |__   |   __|     |    -| | | |     |
      |_| |_____|__|__|_|_|_|  |_____|__|  |__|__|__|__| |_| |__|__|

     * File: delete.php
     * Delete a conference confirmation for the dstc e conference web application.
     * Written by TEAM SPARTA
     * Last updated: 01-04-14 by Shohei Masunaga
    */

    // Import libraries.
    require "PHP_DB/dbObject.php";

    // Make our DAL Object.
    $data = new Data();

    // If they clicked confirm delete:
    if (isset($_POST["clicked_delete"])) {
        // Delete from table feedback_question

        // Delete from table section
        mysql_connect($host, $user, $pass);
        mysql_select_db($db);
        $Section = $_GET["id"];

        //DELETE Response Option
        $sql = "DELETE FROM response_option WHERE Feedback_Option IN (SELECT ID FROM feedback_option WHERE Feedback_Question IN (SELECT ID FROM feedback_question WHERE Feedback_Section = $Section))";
        $data->feedbackSection->customQuery($sql);

        //DELETE Response Text
        $sql = "DELETE FROM respons_text WHERE Feedback_Question IN (SELECT ID FROM feedback_question WHERE Feedback_Section = $Section)";
        $data->feedbackSection->customQuery($sql);

        //DELETE Feedback Option
        $sql = "DELETE FROM feedback_option WHERE Feedback_Question IN (SELECT ID FROM feedback_question WHERE Feedback_Section = $Section)";
        $data->feedbackSection->customQuery($sql);

        //DELETE Feedback Question
        $sql = "DELETE FROM feedback_question WHERE Feedback_Section = $Section";
        $data->feedbackSection->customQuery($sql);

        //DELETE Feedback Section
        $sql = "DELETE FROM feedback_section WHERE ID = $Section";
        $data->feedbackSection->customQuery($sql);


        header('Location: index.php?page=feedback_form');
    } // if they clicked cancel:
    else if (isset($_POST["clicked_no"])) {
        header('Location: index.php?page=feedback_form');
    }
    // Display confirmation page:
    ?>

    <!-- Back button -->
    <div id='backButton' style='float: left;'>
        <form action='index.php' method='get'>
            <input type='hidden' name='page' value='feedback_question'/>
            <input type='submit' class='buttonStyle1' value='Go Back'/>
        </form>
    </div>

    <h1 style='; text-align:center;'>Delete a Feedback Section</h1>
    <table width='100%' border='1' cellpadding='5' cellspacing='0' class='stdDataTable'>
        <thead>
        <tr style='background-color:#999'>
            <td align='left' valign='middle'>ID</td>
            <td align='left' valign='middle'>Section Title</td>
            <td align='left' valign='middle'>Section Description</td>
        </tr>
        </thead>
        <tbody>

        <?PHP
        $SecId = $_GET['id'];
        $row = $data->feedbackSection->getRow($SecId);


        ?>
        <tr style="font-size:86%;">
            <td><?= $row["ID"] ?></td>
            <td><?= $row["Section_Title"] ?></td>
            <td><?= $row["Section_Desc"] ?></td>
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
                    <p>By deleting this Feedback Section, the following items associated with this conference will also
                        be deleted:</p>
                    <ul>
                        <li>Feedback Questions</li>
                        <li>Feedback Options</li>
                        <li>Response Text</li>
                        <li>Response Option</li>
                    </ul>
                </td>
            </tr>
        </table>
    </div>
    <table style='width:100%; margin-top:20px;'>
        <tr>
            <td>Are you sure you want to delete this Feedbackck Section?</td>
            <td style='text-align:right;'>
                <form method='post' action='index.php?page=feedback_form&action=delete_s&id=<?= $_GET['id'] ?>'>
           <input type='submit' name='clicked_no' class='buttonStyle1' value='Cancel'/> <span style='padding-left:10px'>
           <input type='submit' name='clicked_delete' class='buttonStyle1' value='DELETE'/></span>

                </form>
            </td>
        </tr>
    </table>
</div>

	
