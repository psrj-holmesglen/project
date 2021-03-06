<div id='conference_delete'>
<link rel='stylesheet' type='text/css' href='CSS/std_data_table.css'>
<link rel='stylesheet' type='text/css' href='CSS/std_form.css'>
<?PHP
/*
 _____ _____ _____ _____    _____ _____ _____ _____ _____ _____
|_   _|   __|  _  |     |  |   __|  _  |  _  | __  |_   _|  _  |
  | | |   __|     | | | |  |__   |   __|     |    -| | | |     |
  |_| |_____|__|__|_|_|_|  |_____|__|  |__|__|__|__| |_| |__|__|

 * File: clone.php
 * Clone a conference confirmation for the dstc e conference web application.
 * Written by TEAM SPARTA
 * Last updated: 21-04-14 by Andy
*/

ini_set('max_execution_time', 3000);

$TitlErr = "";


// Import libraries.
require "PHP_DB/dbObject.php";
require "PHP_VALIDATION/validation.php";

// Make our DAL Object.
$data = new Data();

$txtTitl = $data->conference->getRow($_GET['id']);
$txtTitl = $txtTitl ["Title"] . " Copy";

// If they clicked confirm delete:
if (isset($_POST["clicked_clone"])) {

    $validated = false;
    // VALIDATION
    if (!vIsBlank($_POST["txtNewTitle"])) {
        $validated = true;
    }
	$CAdmi = $_POST["selCAdmi"];


    if ($validated) {

        ////
        //// Database Read/Write Begin.
        ////

        // copy conference
        $confID = $_GET["id"];

        $res = $data->conference->getRow($confID);
        unset($res["ID"]);
       // $res["Title"] = $_POST["txtNewTitle"];
		//$res["Conference_Admin_Id"] = $_POST["selCAdmi"];
		
		
		$newData = array(
            "Title" => $_POST["txtNewTitle"],
            "Description" => $res["Description"],
            "Start_Time" => $res["Start_Time"],
            "End_Time" => $res["End_Time"],
            "Organiser" => $res["Organiser"],
            "Location" => $res["Location"],
            "Contact" => $res["Contact"],
            "Venue" => $res["Venue"],
            "FilePath" => $res["FilePath"], 
            "Feedback" => $res["Feedback"],
            "Conference_Admin_Id" => $_POST["selCAdmi"]
    );
		
        $newConfID = $data->conference->addRow($newData);
		
		//To add token to the last inserted conference
		$tNum = 1200 + $newConfID; // Auto number for conference 1200 + current conference id
		$tokenData = array("Token"=> $tNum);
		$data->conference->updateRow($newConfID, $tokenData);
		
        // copy map
       /* $allMap = $data->map->getRowByMatch("Conference", $confID);
        if ($allMap != null) {
            foreach ($allMap as $rowMap) {
                $rowMap["Conference"] = $newConfID;
                unset($rowMap["ID"]);
                $data->map->addRow($rowMap);
            }
        }
		
        // copy conference sponsor link
        $allConferenceSponsor = $data->conferenceSponsor->getRowByMatch("Conference", $confID);
        if ($allConferenceSponsor != null) {
            foreach ($allConferenceSponsor as $rowConferenceSponsor) {
                $rowConferenceSponsor["Conference"] = $newConfID;
                $data->conferenceSponsor->addRow($rowConferenceSponsor);
            }
        }

        // copy sections
        $allSection = $data->section->getRowByMatch("Conference", $confID);
        if ($allSection != null) {
            foreach ($allSection as $rowSection) {
                $rowSection["Conference"] = $newConfID;
                $oldSectionID = $rowSection["ID"];
                unset($rowSection["ID"]);
                $newSectionID = $data->section->addRow($rowSection);

                // copy sessions
                $allSession = $data->session->getRowByMatch("Conference_Section", $oldSectionID);
                foreach ($allSession as $rowSession) {
                    $oldSessionID = $rowSession["ID"];
                    $rowSession["Conference_Section"] = $newSectionID;
                    unset($rowSession["ID"]);
                    $newSessionID = $data->session->addRow($rowSession);

                    // copy presenters link
                    $allSessionPresenter = $data->sessionPresenter->getRowByMatch("Session", $oldSessionID);
                    foreach ($allSessionPresenter as $rowSessionPresenter) {
                        $rowSessionPresenter["Session"] = $newSessionID;
                        $data->sessionPresenter->addRow($rowSessionPresenter);
                    }

                    // copy polling
                    $allPolling = $data->polling->getRowByMatch("Session", $oldSessionID);
                    foreach ($allPolling as $rowPolling) {
                        $rowPolling["Session"] = $newSessionID;
                        $oldPollingID = $rowPolling["ID"];
                        unset($rowPolling["ID"]);
                        $newPollingID = $data->polling->addRow($rowPolling);

                        // copy polling options
                        $allPollingOption = $data->pollingOption->getRowByMatch("Polling", $oldPollingID);
                        foreach ($allPollingOption as $rowPollingOption) {
                            $rowPollingOption["Polling"] = $newPollingID;
                            unset($rowPollingOption["ID"]);
                            $data->pollingOption->addRow($rowPollingOption);
                        }
                    }
                }
            }
        }
		
//        // copy conference feedback
//        if ($res["Feedback"] != null) {
//            $feedback = $data->feedback->getRow(intval($res["Feedback"]));
//
//            $oldFeedbackID = $feedback["ID"];
//            unset($feedback["ID"]);
//            $newFeedbackID = $data->feedback->addRow($feedback);
//            $conferenceData = array("Feedback" => $newFeedbackID);
//            $data->conference->updateRow($newConfID, $conferenceData);
//
//            // feedback section
//            $allFeedbackSection = $data->feedbackSection->getRowByMatch("Feedback", $oldFeedbackID);
//            if ($allFeedbackSection != null) {
//                foreach ($allFeedbackSection as $rowFeedbackSection) {
//                    $oldFeedbackSectionID = $rowFeedbackSection["ID"];
//                    unset($rowFeedbackSection["ID"]);
//                    $rowFeedbackSection["Feedback"] = $newFeedbackID;
//                    $newFeedbackSectionID = $data->feedbackSection->addRow($rowFeedbackSection);
//
//                    // copy conference feedback links
//
//                    // feedback question
//                    $allfeedbackQuestion = $data->feedbackQuestion->getRowByMatch("Feedback_Section", $oldFeedbackSectionID);
//                    if ($allfeedbackQuestion != null) {
//                        foreach ($allfeedbackQuestion as $rowFeedbackQuestion) {
//                            $oldFeedbackQuestionID = $rowFeedbackQuestion["ID"];
//                            unset($rowFeedbackQuestion["ID"]);
//                            $rowFeedbackQuestion["Feedback_Section"] = $newFeedbackSectionID;
//                            $newFeedbackQuestionID = $data->feedbackQuestion->addRow($rowFeedbackQuestion);
//
//                            // copy feedback option
//                            $allFeedbackOption = $data->feedbackOption->getRowByMatch("Feedback_Question", $oldFeedbackQuestionID);
//                            if ($allFeedbackOption != null) {
//                                foreach ($allFeedbackOption as $rowFeedbackOption) {
//                                    unset($rowFeedbackOption["ID"]);
//                                    $rowFeedbackOption["Feedback_Question"] = $newFeedbackQuestionID;
//                                    $data->feedbackOption->addRow($rowFeedbackOption);
//                                }
//                            }
//                        }
//                    }
//                }
//            }
//        }
*/
        ////
        //// Database Read/Write End.
        ////

        header('Location: index.php?page=conference');
    }
    $TitlErr = "Please Enter a new Conference Title.";
} // if they clicked cancel:
else if (isset($_POST["clicked_no"])) {
    header('Location: index.php?page=conference');
}
// Display confirmation page:
?>


<script type="text/javascript">
    var cancelNotClicked = true;

    $(function () {
        $("#cloneCancel").click(function () {
            cancelNotClicked = false;
        })
    });

    function showLoading() {
        if (cancelNotClicked) {
            document.getElementById("load").style.display = '';
        }
        return true;
    }
</script>

<style type="text/css">
    #load {
        position: absolute;
        z-index: 1;
        border-color: #034C75;
        border-style: solid;
        border-width: 5px;
        border-radius: 5px;
        box-shadow: 7px 7px 6px 0px rgba(50, 50, 50, 0.58);
        background: #FFF;
        width: 300px;
        height: 200px;
        margin-top: -100px;
        margin-left: -150px;
        top: 40%;
        left: 50%;
        text-align: center;
        font-size: 120%;
        line-height: 80px;
    }
</style>
<div id="load" style="display:none;">
    <p>Copying data. Please wait.</p>
    <img src="ASSETS/TMPIMG/working.gif">
</div>

<!-- Back button -->
<div id='backButton' style='float: left;'>
    <form action='index.php' method='get'>
        <input type='hidden' name='page' value='conference'/>
        <input type='hidden' name='action' value='cloneView'/>
        <input type='submit' class='buttonStyle1' value='Go Back'/>
    </form>
</div>

<h1 style='; text-align:center;'>Clone a Conference</h1>
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
    <?PHP
    $rowData = $data->conference->getRowWithVenueName($_GET["id"]);
    ?>
    <tr style="font-size:86%;">
        <td align='left' valign='middle'><?= $rowData[0]["Title"] ?></td>
        <td align='left' valign='middle'><?= $rowData[0]["Description"] ?></td>
        <td align='left' valign='middle'><?= $rowData[0]["Start_Time"] ?></td>
        <td align='left' valign='middle'><?= $rowData[0]["End_Time"] ?></td>
        <td align='left' valign='middle'><?= $rowData[0]["Organiser"] ?></td>
        <td align='left' valign='middle'><?= $rowData[0]["Location"] ?></td>
        <td align='left' valign='middle'><?= $rowData[0]["Name"] ?></td>
        <td align='left' valign='middle'><?= $rowData[0]["Contact"] ?></td>
    </tr>
    </tbody>
</table>
<br/>

<!-- Form START -->
<form method='post' action='index.php?page=conference&action=clone&id=<?= $_GET['id'] ?>' onsubmit="showLoading()">
    <table class='std_form'>
        <tr>
            <td class='label'>New Conference Title:</td>
            <td><input type="text" name="txtNewTitle" placeholder="" class="textBoxStyle1" value="<?= $txtTitl ?>"/>
            </td>
            <td><span class='errorText'><?= $TitlErr ?></span></td>
        </tr>
        <tr>
                <td colspan='2'>
                    <hr>
                </td>
            </tr>
            <tr>
                <td class='label'>Conference Administrator:</td>
                <td>
                    <select name='selCAdmi' class='selectStyle1'>
                        <?PHP
                        $data->user->printDropDownOptions(NULL, "User_name");
                        ?>
                    </select>
                </td>
            </tr>
        <tr>

            <td colspan="2" style='text-align:right;'>
                <input type='submit' name='clicked_no' id="cloneCancel" class='buttonStyle1' value='Cancel'/>
                <span style='padding-left:10px'><input type='submit' name='clicked_clone' class='buttonStyle1'
                                                       value='Clone'/></span>
            </td>
        </tr>
    </table>
</form>
</div>

	
