<div id='feedback_form_add'>
<link rel='stylesheet' type='text/css' href='CSS/std_form.css'>
<?PHP
/*
 _____ _____ _____ _____    _____ _____ _____ _____ _____ _____
|_   _|   __|  _  |     |  |   __|  _  |  _  | __  |_   _|  _  |
  | | |   __|     | | | |  |__   |   __|     |    -| | | |     |
  |_| |_____|__|__|_|_|_|  |_____|__|  |__|__|__|__| |_| |__|__|

 * File: add_s.php
 * Add Section for the dstc e conference web application.
 * Written by TEAM SPARTA
 * Last updated: 09-04-14 by Shohei
*/

////
//// Setup START
////

// Import libraries.
require "PHP_PRES/helpers/dateTimePicker.php";
require "PHP_DB/dbObject.php";

$validated = false;

// Get a copy of the DAL object.
$data = new Data();

// Default times:
$Star = dtConvertToArray(date('Y-m-d H:i:s'));
$EndT = dtConvertToArray(date('Y-m-d H:i:s'));

////
//// Setup END
////

// If submit has been clicked:
if (isset($_POST["clicked_submit"])) {

    ////
    //// Validation Checking START.
    ////
    require "PHP_VALIDATION/validation.php";

    // Grab our data from the form.
    $Titl = $_POST["txtTitl"];
    $Desc = $_POST["txtDesc"];
    $Type = $_POST["txtType"];
	$Fbid = $_POST["selFbId"];

    // A bool flag that determines validation success.
    $validated = true;

    // nv() is a small shorthand function that switches the validation flag
    // to false.  It then returns the current validation error from our validation lib.
    function nv()
    {
        global $validated;
        $validated = false;
        return vGetErr();
    }

    // Validate Title:
    if (vIsBlank($Titl) || !vMaxChars($Titl, 100) || vRegexString($Titl)) // not blank, max 100 chars, no special character.
        $TitlErr = nv();

    // Validate Description:
    if (vIsBlank($Desc) || !vMaxChars($Desc, 400) || vRegexString($Desc)) // not blank, max 400 chars, no special character.
        $DescErr = nv();

    // Validate Type
    if (vIsBlank($Type) || !vMaxChars($Type, 20)) // not blank, max 100 chars.
        $TypeErr = nv();

    ////
    //// Validation Checking END.
    ////
}
// Once the data has been validated, let's insert the data.
if ($validated) {
    ////
    //// Database Write START
    ////
    $newData = array(
            "Section_Title" => $Titl,
            "Section_Desc" => $Desc,
            "Type" => $Type,
			"Feedback" =>$Fbid,
    );
	//get last inserted record ID and update conference_fb_section table
     $newID =$data->feedbackSection->addRow($newData);
	
	 $table_conference = $data->feedbackSection->getRowByMatch_fb_section_confID("Feedback", $Fbid);
	 $Conf = $table_conference[ID];
	 $table_session = $data->feedbackSection->getRowByMatch_fb_section_confID("ID", $newID);
	 $Conf_Sec = $table_session[Conference];
	if($Conf != NULL)
	{
		$newData_Conf_fb_secID = array(
				"Conference" => $Conf,
				"Feedback_Section" =>$newID,
		);
		$data->conferenceFbSection->addRow($newData_Conf_fb_secID);
	}
	else if($Conf_Sec != NULL)
	{
		$newData_Conf_fb_secID = array(
				"Conference" => $Conf_Sec,
				"Feedback_Section" =>$newID,
		);
		$data->conferenceFbSection->addRow($newData_Conf_fb_secID);
	
	}
	
        header("Location: index.php?page=feedback_form");
		
		
		
    ////
    //// Database Write END
    ////
} else {
    ////
    //// HTML Form START
    ////
    ?>
    <!-- Back button -->
    <div id='backButton' style='float: left;'>
        <form action='index.php' method='get'>
            <input type='hidden' name='page' value='feedback_form'/>
            <input type='submit' class='buttonStyle1' value='Go Back'/>
        </form>
    </div>

    <!-- Heading -->
    <h1 style='text-align:center'>Add a Feedback Section for a Form</h1>


    <!-- Form START -->
    <form method='post' action='index.php?page=feedback_form&action=add_s'>

        <h2 style='text-align:center'>&nbsp;</h2>
        <table class="std_form">
            <tr>
                <td class='label'>Section Title:</td>
                <td><input type='text' class='textBoxStyle1' name='txtTitl' value='<?= $Titl ?>'/></td>
                <td><span class='errorText'><?= $TitlErr ?></span></td>
            </tr>
            <tr>
                <td colspan="2">
                    <hr>
                </td>
            </tr>
            <tr>
                <td class='label'>Section Description:</td>
                <td><input type='text' class='textBoxStyle1' name='txtDesc' value='<?= $Desc ?>'/></td>
                <td><span class='errorText'><?= $DescErr ?></span></td>
            </tr>
            <tr>
                <td colspan="2">
                    <hr>
                </td>
            </tr>
            <tr>
                <td class='label'>Section Type:</td>
                <td>
                    <select name='txtType' class='selectStyle1'>
                        <option value='Conference' <?php if ($Type == "Conference") echo "selected='selected'" ?>>
                            Conference
                        </option>
                        <option value='Session' <?php if ($Type == "Session") echo "selected='selected'" ?>>Session
                        </option>
                        <option value='Demographic' <?php if ($Type == "Demographic") echo "selected='selected'" ?>>
                            Demographic
                        </option>
                    </select>
                </td>
                <td><span class='errorText'><?= $TypeErr ?></span></td>
            </tr>
         <!--Rudhra - Adding feedback number to a section --> 
          <tr>
                <td colspan="2">
                    <hr>
                </td>
            </tr>
          <tr>
                <td class='label'>FeedBack:</td>
                <td>
                     <select name='selFbId' class='selectStyle1Dt'>
						 <?PHP
                            $data->feedback->printDropDownOptions($FbId, "ID", "Feedback_Title");
                            ?>


                        </select>
                </td>
                <td><span class='errorText'><?= $TypeErr ?></span></td>
            </tr>
            
            
            <tr>
                <td colspan='2'><span style='float: right;'>
                	<br/>
                    <input type='submit' value='Reset' name='clicked_reset' class="buttonStyle1"/>
                    <input type='submit' value='Submit' name='clicked_submit' class='buttonStyle1'/>
                    </span>
                </td>
            </tr>
        </table>
    </form>
    <!-- Form End -->

<?PHP
}
////
//// HTML Form END
////
?>
</div>