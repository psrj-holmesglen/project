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
$SId = "all";
$SStatusId = "all";
////
//// Setup END
////
if (isset($_POST['session_selected'])) {
    $SId = $_POST["selSId"];
    $SStatusId = $_POST["selStatusFilter"];

}


?>

<div class="presenters_view">
    <link rel="stylesheet" type="text/css" href="CSS/std_data_table.css"/>

    <!-- Heading -->
    <h1 align="left">Review Questions</h1>

    <!-- Try to populate drop down with Sessions -->
    <form method="post" action="index.php?page=review_question&action=view">
        <table>
            <tr>
                <td class='label'>Select Session:</td>
                <td>
                    <select name='selSId' class='selectStyle1' style="width:auto">
                        <option value="all">All Sessions</option>
                        <?php
                        //Populating the Session Drop Down
                        $data->session->printDropDownOptions($SId, "Title");

                        ?>
                    </select>
                </td>
                <td>
                    <select name='selStatusFilter' class='selectStyle1' style="width:auto">

                        <option value="all">
                            All
                        </option>
                        <option value="1">
                            Approved
                        </option>
                        <option value="0">
                            Pending
                        </option>
                    </select>

                </td>
                <td>

                    <input type="submit" name="session_selected" value="Filter" class="buttonStyle1"/>
                </td>
            </tr>
        </table>
    </form>

    <form method="get" action="index.php" name="displaySessionQuestionsForm">
        <div class="scroll"> <!--Add scroll bar to table -->
            <table width="100%" border="1" cellpadding="5" cellspacing="0" class="stdDataTable">
                <thead>
                <tr style="background-color:#999" align="left" valign="middle">
                    <td>Display Select</td>
                    <td>Question</td>
                    <td>Status</td>
                    <td>Actions</td>
                </tr>
                </thead>
                <tbody>

                <?PHP
                //Gives all Audience questions
                if ($SId == "all" && $SStatusId == "all") {
                    $table = $data->sessionQuestion->getRow("all");
                    //Gives the session related questions
                } else {
                    //$table = $data->reviewQuestion->getRowByMatch_rq($SId);
                    $table = $data->sessionQuestion->filterResponseQuestions($SId, $SStatusId);
                }

                foreach ($table as $row) {
                    ?>

                    <tr align="left" valign="middle" style="font-size:86%;">
                        <td style="width:110px; text-align: center"><input type="checkbox" name="questionChkBx[]"
                                                                           value="<?= $row["ID"]; ?>"/></td>
                        <td><?= $row["Question"]; ?></td>
                        <td>
                            <?PHP
                            $Accepted = $row["Accepted"];
                            if ($Accepted == 0) {
                                echo "Pending";
                            } else {
                                echo "Accepted";
                            }

                            ?>
                        </td>
                        <td align="center" valign="middle">
                            <a href="index.php?page=review_question&action=edit&id=<?= $row["ID"] ?>">Edit Approval</a>
                            <a href="index.php?page=review_question&action=delete&id=<?= $row["ID"] ?>">Delete</a>
                        </td>
                    </tr>


                <?PHP
                }
                //End of $table foreach.

                //No questions could be located
                if ($table == null) {
                    echo "No Records Found, retry in a moment.";
                }
                ?>
                </tbody>
            </table>


        </div>

        <p align="right" style="font-size:75%"> <?PHP echo "Returned: " . get_Datetime_Now() ?></p>

        <div style="text-align:right;">
            <input type="submit" value="Presenter Display Selected Questions" class="buttonStyle1"
                   name="display_selected" onClick="return checkSelected()"/>
            <input type="hidden" name="page" value="review_question"/>
            <input type="hidden" name="action" value="displaySelected"/>
        </div>
    </form>

    <script>

        // checks that at least one item has been selected
        // alerts the user if nothing is selected, and prevents the submit.
        function checkSelected() {
            var chks = document.getElementsByName('questionChkBx[]');
            var hasChecked = false;
            for (var i = 0; i < chks.length; i++) {
                if (chks[i].checked) {
                    hasChecked = true;
                    break;
                }
            }
            if (hasChecked == false) {
                alert("Please select at least one.");
                return false;
            }
            return true;
        }
    </script>
</div>