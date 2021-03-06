<div id='conference_delete'>
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

        //Delete from table response_option

        $table = $data->feedbackOption->getRow($_GET["id"]);
        foreach ($table as $row) {
            $opID = $row["ID"];
            $data->responseOpt->deleteRow($opID);
        }

        //Delete from table response_text
        $data->responseTxt->deleteRow($_GET["id"]);
        // Delete from table feedback_option
        $data->feedbackOption->deleteRow($_GET["id"]);
        // Delete from table feedback_question
        $data->feedbackQuestion->deleteRow($_GET["id"]);


        header('Location: index.php?page=feedback_question');
    } // if they clicked cancel:
    else if (isset($_POST["clicked_no"])) {
        header('Location: index.php?page=feedback_question');
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

    <h1 style='; text-align:center;'>Delete a Feedback Question</h1>
    <table width='100%' border='1' cellpadding='5' cellspacing='0' class='stdDataTable'>
        <thead>
        <tr style='background-color:#999'>
            <td align='left' valign='middle'>ID</td>
            <td align='left' valign='middle'>Question Text</td>
            <td align='left' valign='middle'>Type</td>
            <td align='left' valign='middle'>Section</td>
        </tr>
        </thead>
        <tbody>
        <?PHP
        $rowData = $data->feedbackQuestion->getRow($_GET["id"]);
        ?>
        <tr style="font-size:86%;">
            <td align='left' valign='middle'><?= $rowData["ID"] ?></td>
            <td align='left' valign='middle'><?= $rowData["Question_Text"] ?></td>
            <td align='left' valign='middle'><?= $rowData["Type"] ?></td>
            <td align='left' valign='middle'><?= $rowData["Feedback_Section"] ?></td>
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
                    <p>By deleting this Feedback Question, the following items associated with this conference will also
                        be deleted:</p>
                    <ul>
                        <li>Response items</li>
                        <li>Option items</li>
                    </ul>
                </td>
            </tr>
        </table>
    </div>
    <table style='width:100%; margin-top:20px;'>
        <tr>
            <td>Are you sure you want to delete this Feedback Question?</td>
            <td style='text-align:right;'>
                <form method='post' action='index.php?page=feedback_question&action=delete&id=<?= $_GET['id'] ?>'>
                    <input type='submit' name='clicked_no' class='buttonStyle1' value='Cancel'/>
                    <span style='padding-left:10px'><input type='submit' name='clicked_delete' class='buttonStyle1'
                                                           value='DELETE'/></span>

                </form>
            </td>
        </tr>
    </table>
</div>

	
