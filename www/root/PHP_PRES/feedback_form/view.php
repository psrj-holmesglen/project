<div class="section_view">
<link rel="stylesheet" type="text/css" href="CSS/std_data_table.css"/>

<?php
// _____ _____ _____ _____    _____ _____ _____ _____ _____ _____ 
//|_   _|   __|  _  |     |  |   __|  _  |  _  | __  |_   _|  _  |
//  | | |   __|     | | | |  |__   |   __|     |    -| | | |     |
//  |_| |_____|__|__|_|_|_|  |_____|__|  |__|__|__|__| |_| |__|__|
//                                                                
// * File: View.php
// * View Feedback Question for the dstc e conference web application.
// * Written by TEAM SPARTA 
// * Last updated: 20-04-14 by Shohei Masuanga -->


////
//// Setup START
////

// Import libraries.
require "PHP_DB/dbObject.php";

// Get a copy of the DAL object.
$data = new Data();


$CoId = "All";
$SesId = "All";
$SecId = "All";
////
//// Setup END
////
// If submit has been clicked:
if (isset($_POST['conference_selected']) || $_REQUEST["con"] == "ConPost") {

    // Grab our data from the form.

    $CoId = $_POST["selCoId"];


}
if (isset($_POST['session_selected']) || $_REQUEST["ses"] == "SesPost") {

    // Grab our data from the form.

    $SesId = $_POST["selSesId"];


}
if (isset($_POST['section_selected']) || $_REQUEST["sec"] == "SecPost") {

    // Grab our data from the form.

    $SecId = $_POST["selSecId"];
}

if ($CoId == "All" && $SesId == "All") {
    $Method = 0;
} else {
    $Method = $_REQUEST["radiobutton"];
}
?>
<script type="text/javascript">
    function Conference() {
        document.getElementById('conf').style.display = "";
        document.getElementById('sect').style.display = "";
        document.getElementById('sess').style.display = "none";
    }

    function Session() {
        document.getElementById('sess').style.display = "";
        document.getElementById('sect').style.display = "";
        document.getElementById('conf').style.display = "none";
    }

</script>

<h1>Feedback Form</h1>
<table>
    <tr>
        <td>Select Method:</td>
        <td colspan="2">
            <input name='radiobutton' type='radio' value='1' onclick='Conference();' checked="checked">Conference-Feedback<br/>
            <input name='radiobutton' type='radio' value='2' onclick='Session();'>Session-Feedback
        </td>
    </tr>
    <tr id="conf">
        <td class='label'>Select Conference:</td>
        <td>
            <form method="post" action="index.php?page=feedback_form&action=view">
                <select name='selCoId' class='selectStyle1' onchange='this.form.submit()'>
                    <option value="All">All Conferences</option>
                    <?php
                    // Create selectbox for sorting by conference

                    $data->conference->printDropDownOptions($CoId, "Title");
                    ?>

                </select>
        </td>
        <td>


            <input type='hidden' name='con' value='ConPost'></form>
        </td>
    </tr>
    <tr id="sess" style="display:none">
        <td class='label'>Select Session:</td>
        <td>
            <form method="post" action="index.php?page=feedback_form&action=view">
                <select name='selSesId' class='selectStyle1' onchange='this.form.submit()'>
                    <option value="All">All Sessions</option>
                    <?php
                    // Create selectbox for sorting by conference

                    $data->session->printDropDownOptions($SesId, "Title");
                    ?>

                </select>
        </td>
        <td>


            <input type='hidden' name='ses' value='SesPost'></form>
        </td>
    </tr>
    <tr id="sect">
        <td class='label'>Select Section:</td>
        <td>
            <form method="post" action="index.php?page=feedback_form&action=view">
                <select name='selSecId' class='selectStyle1' onchange='this.form.submit()'>
                    <option value="All">All Sections</option>
                    <?PHP
                    // Create selectbox for section 
                    if ($CoId != "All" || $SesId != "All") {
                        if ($CoId != "All") {
                            $Stmt = "SELECT ID, Section_Title FROM feedback_section WHERE Feedback IN (SELECT Feedback FROM conference WHERE ID = '$CoId') ORDER BY ID";
                        }
                        if ($SesId != "All") {
                            $Stmt = "SELECT ID, Section_Title FROM feedback_section WHERE Feedback IN (SELECT Feedback FROM session WHERE ID = $SesId) ORDER BY ID";
                        }
                        $data->feedback->printDropDownOptions_fb($Stmt);
                    } else {
                        $data->feedbackSection->printDropDownOptions(NULL, "Section_Title");
                    }
                    ?>

                </select>
        </td>
        <td>


            <input type='hidden' name='sec' value='SecPost'></form>
        </td>
    </tr>
    <tr>
        <td colspan="3">
            <hr>
        </td>
    </tr>
</table>

<h2>Section</h2>

<div class="scroll">
    <table width="100%" border="1" cellpadding="5" cellspacing="0" class="stdDataTable">
        <thead>
        <tr style="background-color:#999" align="left" valign="middle">
            <td>ID</td>
            <td>Section Title</td>
            <td>Section Description</td>
            <td>Type</td>
            <td>Action</td>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($CoId != "All" || $SesId != "All" || $SecId != "All") {

            if ($SecId != "All") {
                $table = $data->feedbackSection->getRowbyMatch("ID", $SecId);
            } else {
                if ($CoId != "All")
                    $table = $data->feedbackSection->getRowByMatch_fb("feedback_section", "conference", "Feedback", "Feedback", $CoId);
                if ($SesId != "All")
                    $table = $data->feedbackSection->getRowByMatch_fb("feedback_section", "session", "Feedback", "Feedback", $SesId);

            }
        } else {
            $table = $data->feedbackSection->getRow();
        }


        foreach ($table as $row) {
            ?>
            <tr style="font-size:86%;">
                <td><?= $row["ID"] ?></td>
                <td><?= $row["Section_Title"] ?></td>
                <td><?= $row["Section_Desc"] ?></td>
                <td><?= $row["Type"] ?></td>
                <td align="center" valign="middle">
                    <a href='index.php?page=feedback_form&action=edit_s&Sid=<?= $row["ID"] ?>'>Edit</a>
                    <a href='index.php?page=feedback_form&action=delete_s&Sid=<?= $row["ID"] ?>'>Delete</a>
                </td>

            </tr>
        <?php }; ?>
        </tbody>
    </table>
</div>
<p align="right" style="font-size:75%"> <?PHP echo "Returned: " . date('Y-m-d H:i:s'); ?></p>
    <span style="text-align:right;"><form method="get" action="index.php">
            <input type="submit" value="Add Section" class="buttonStyle1"/>
            <input type="hidden" name="page" value="feedback_form"/>
            <input type="hidden" name="action" value="add_s"/>
        </form></span>
<hr/>
<h2> Questions</h2>

<div class="scroll">
    <table width="100%" border="1" cellpadding="5" cellspacing="0" class="stdDataTable">
        <thead>
        <tr style="background-color:#999" align="left" valign="middle">
            <td>ID</td>
            <td>Question Text</td>
            <td>Type</td>
            <td>Section ID</td>
        </tr>
        </thead>
        <tbody>
        <?PHP
        // Sort table by conference

        if ($SecId == "All") {
            if ($CoId != "All")
                $table = $data->feedbackSection->getRowByMatch_fb2("conference", $CoId);
            else if ($SesId != "All")
                $table = $data->feedbackSection->getRowByMatch_fb2("session", $SesId);
            else
                $table = $data->feedbackQuestion->getRow("all");
        } else
            $table = $data->feedbackQuestion->getRowByMatch_ff($SecId);

        // TODO: alert no entries.
        foreach ($table as $row) {
            ?>
            <tr style="font-size:86%;">
                <td align="left" valign="middle"><?= $row["ID"] ?></td>
                <td align="left" valign="middle"><?= $row["Question_Text"] ?></td>
                <td align="left" valign="middle"><?php if ($row["Type"] == 1) {
                        echo "Multiple Choice";
                    } else {
                        echo "Text Response";
                    } ?></td>
                <td align="left" valign="middle">
                    <?php
                    //$sect = $row["Feedback_Section"];
                    //$row2 = $data->feedbackSection->getRow($sect);
                    echo $row["feedback_section"]; //$row2["Section_Title"];
                    ?>
                </td>
            </tr>
        <?PHP } ?>
        </tbody>
    </table>
</div>

</div>