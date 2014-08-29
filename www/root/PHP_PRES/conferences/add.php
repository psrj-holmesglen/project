<div id='conference_add'>
<link rel='stylesheet' type='text/css' href='CSS/std_form.css'>

<?PHP
/*
 _____ _____ _____ _____    _____ _____ _____ _____ _____ _____
|_   _|   __|  _  |     |  |   __|  _  |  _  | __  |_   _|  _  |
  | | |   __|     | | | |  |__   |   __|     |    -| | | |     |
  |_| |_____|__|__|_|_|_|  |_____|__|  |__|__|__|__| |_| |__|__|

 * File: add.php
 * Edit Presenter for the dstc e conference web application.
 * Written by TEAM SPARTA
 * Last updated: 25-03-14 by Andy
*/

////
//// Setup START
////

// Import libraries.
require "PHP_PRES/helpers/dateTimePicker.php";
require "PHP_DB/dbObject.php";


$uploLoc = "UPLOADED_FILES/Conference/";
$validated = false;

// Get a copy of the DAL object.
$data = new Data();

// Default times:
$Star = dtConvertToArray(date('Y-m-d H:i:s'));
$EndT = dtConvertToArray(date('Y-m-d H:i:s'));

$TitlErr = null;
$DescErr = null;
$StarErr = null;
$EndTErr = null;
$OrgaErr = null;
$LocaErr = null;
$ContErr = null;

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
    $Desc = $_POST["txaDesc"];
    $Orga = $_POST["txtOrga"];
    $Loca = $_POST["txtLoca"];
    $Cont = $_POST["txtCont"];
    $Venu = $_POST["selVenu"]; // taking the venue id only, not full string.
	$Febk = $_POST["selFbform"];
	$CAdmi = $_POST["selCAdmi"];
	//echo $CAdmi;
	

    // Grab our datetime date and convert it into a mySQL dateTime
    $Star["year"] = $_POST["selStarYear"];
    $Star["month"] = $_POST["selStarMonth"];
    $Star["day"] = $_POST["selStarDay"];
    $Star["hour"] = $_POST["selStarHour"];
    $Star["minute"] = $_POST["selStarMinute"];
    $Star["second"] = "00";
    //$Star["string"] = dtConvertToString($Star);
	$StartDate = $Star["string"] = dtConvertToString($Star);

    $EndT["year"] = $_POST["selEndTYear"];
    $EndT["month"] = $_POST["selEndTMonth"];
    $EndT["day"] = $_POST["selEndTDay"];
    $EndT["hour"] = $_POST["selEndTHour"];
    $EndT["minute"] = $_POST["selEndTMinute"];
    $EndT["second"] = "00";
    //$EndT["string"] = dtConvertToString($EndT);
	$EndDate = $EndT["string"] = dtConvertToString($EndT);

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
    if (vIsBlank($Titl) || !vMaxChars($Titl, 100)) // not blank, max 100 chars.
        $TitlErr = nv();

    // Validate Description:
    if (vIsBlank($Desc) || !vMaxChars($Desc, 400)) // not blank, max 400 chars.
        $DescErr = nv();

    // Validate Start date:
    if (vIsBlank($Star["string"]) || !vIsDate($Star)) // not blank, is sql datetime.
        $StarErr = nv();

    // Validate End date:
    if (vIsBlank($EndT["string"]) || !vIsDate($EndT)|| vIsValidDate($StartDate,$EndDate)) // not blank, is sql datetime.
        $EndTErr = nv();

    // Validate Organisation:
    if (vIsBlank($Orga) || !vMaxChars($Orga, 30)) // not blank, max 30 chars.
        $OrgaErr = nv();

    // Validate Location:
    if (vIsBlank($Loca) || !vMaxChars($Loca, 50)) // not blank, max 50 chars.
        $LocaErr = nv();

    // Validate Cont:
    if (vIsBlank($Cont) || !vMaxChars($Cont, 25)) // not blank, max 25 chars.
        $ContErr = nv();
    //validate file upload
    if (fileUpload($page, $_files, $_post)) {
        $uploErr = nv();
    }
    ////
    //// Validation Checking END.
    ////
}
// Once the data has been validated, let's insert the data.
if ($validated) {
    ////
    //// Database Write START
    ////

    //Check for file in file upload
    if (empty($_FILES["file"]["name"])) {
        $PFil = "No File Uploaded";
    } else { //if file found then move and save to folder
        //send link to database:..
        $PFil = $target_file;
        $PFil = "File Uploaded";
    }

    //echo "valid";
    $newData = array(
            "Title" => $Titl,
            "Description" => $Desc,
            "Start_Time" => dtConvertToString($Star),
            "End_Time" => dtConvertToString($EndT),
            "Organiser" => $Orga,
            "Location" => $Loca,
            "Contact" => $Cont,
            "Venue" => $Venu,
			"Feedback" => $Febk,
            "FilePath" => $PFil,
			"Conference_Admin_Id" => $CAdmi
    );
	/*
echo "Title" . $Titl;
echo "<br/>";
echo "Description".  $Desc;
echo "<br/>";
echo            "Start_Time" . dtConvertToString($Star);
echo "<br/>";
    echo        "End_Time" . dtConvertToString($EndT);
	echo "<br/>";
        echo    "Organiser" . $Orga;
		echo "<br/>";
           echo "Location" . $Loca;
		   echo "<br/>";
echo            "Contact" . $Cont;
echo "<br/>";
    echo        "Venue" . $Venu;
	echo "<br/>";
		echo	"Feedback" . $Febk;
		echo "<br/>";
echo            "FilePath" . $PFil;
echo "<br/>";
	echo		"Conference_Admin_Id" . $CAdmi;
	echo "<br/>";
	
	*/
    $newID = $data->conference->addRow($newData);
    if ($newID) {
        if ($PFil != "No File Uploaded") {
            $fileData = explode(".", $_FILES['file']['name']);
            $target_file = $uploLoc . $newID . "." . $fileData[1];
            move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
        }

      //  header("Location: index.php?page=conference");
//			       header('Location: index.php?page=presenter&action=view');
    }

    //if($data->conference->addRow($newData))

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
            <input type='hidden' name='page' value='conference'/>
            <input type='submit' class='buttonStyle1' value='Go Back'/>
        </form>
    </div>

    <!-- Heading -->
    <h1 style='text-align:center'>Add a Conference</h1>

    <!-- Form START -->
    <form method='post' action='index.php?page=conference&action=add' enctype="multipart/form-data">
        <table class='std_form'>
            <tr>
                <td class='label'>Conference Title:</td>
                <td><input type='text' class='textBoxStyle1' name='txtTitl' value='<?= $Titl ?>'/></td>
                <td><span class='errorText'><?= $TitlErr ?></span></td>
            </tr>
            <tr>
                <td colspan="2">
                    <hr>
                </td>
            </tr>
            <tr>
                <td class='label'>Description:</td>
                <td><textarea name='txaDesc' class='textAreaStyle1' rows='4' value=><?= $Desc ?></textarea></td>
                <td><span class='errorText'><?= $DescErr ?></span></td>
            </tr>
            <tr>
                <td colspan="2">
                    <hr>
                </td>
            </tr>
            <tr>
                <td class='label'>Start Time:</td>
                <td>
                    <table style="width:100%; margin:0px; border:0px; padding:0px;">
                        <tr>
                            <td>
                                <select name='selStarDay' class='selectStyle1Dt'>
                                    <?= printOptionDays($Star["day"]) ?>
                                </select>
                            </td>
                            <td>
                                <select name='selStarMonth' class='selectStyle1Dt'>
                                    <?= printOptionMonths($Star["month"]) ?>
                                </select>
                            </td>
                            <td>
                                <select name='selStarYear' class='selectStyle1Dt'>
                                    <?= printOptionYears($Star["year"]) ?>
                                </select>
                            </td>
                            <td style='padding-left:20px;'>
                                <select name='selStarHour' class='selectStyle1Dt'>
                                    <?= printOptionHours($Star["hour"]) ?>
                                </select>
                            </td>
                            <td>
                                <strong style='color:black'>:</strong>
                            </td>
                            <td>
                                <select name='selStarMinute' class='selectStyle1Dt'>
                                    <?= printOptionMinutes($Star["minute"]) ?>
                                </select>
                            </td>
                        </tr>
                    </table>
                </td>
                <td><span class='errorText'><?= $StarErr ?></span></td>
            </tr>

            <tr>
                <td colspan="2">
                    <hr>
                </td>
            </tr>
            <tr>
                <td class='label'>End Time:</td>
                <td>
                    <table style="width:100%; margin:0px; border:0px; padding:0px;">
                        <tr>
                            <td>
                                <select name='selEndTDay' class='selectStyle1Dt'>
                                    <?= printOptionDays($EndT["day"]) ?>
                                </select>
                            </td>
                            <td>
                                <select name='selEndTMonth' class='selectStyle1Dt'>
                                    <?= printOptionMonths($EndT["month"]) ?>
                                </select>
                            </td>
                            <td>
                                <select name='selEndTYear' class='selectStyle1Dt'>
                                    <?= printOptionYears($EndT["year"]) ?>
                                </select>
                            </td>
                            <td style='padding-left:20px;'>
                                <select name='selEndTHour' class='selectStyle1Dt'>
                                    <?= printOptionHours($EndT["hour"]) ?>
                                </select>
                            </td>
                            <td>
                                <strong style='color:black'>:</strong>
                            </td>
                            <td>
                                <select name='selEndTMinute' class='selectStyle1Dt'>
                                    <?= printOptionMinutes($EndT["minute"]) ?>
                                </select>
                            </td>
                        </tr>
                    </table>
                </td>
                <td><span class='errorText'><?= $EndTErr ?></span></td>
            </tr>
            <tr>
                <td colspan="2">
                    <hr>
                </td>
            </tr>
            <tr>
                <td class='label'>Organiser:</td>
                <td><input type='text' class='textBoxStyle1' name='txtOrga' value='<?= $Orga ?>'/></td>
                <td><span class='errorText'><?= $OrgaErr ?></span></td>
            </tr>
            <tr>
                <td colspan="2">
                    <hr>
                </td>
            </tr>
            <tr>
                <td class='label'>Location:</td>
                <td><input type='text' class='textBoxStyle1' name='txtLoca' value='<?= $Loca ?>'/></td>
                <td><span class='errorText'><?= $LocaErr ?></span></td>
            </tr>
            <tr>
                <td colspan='2'>
                    <hr>
                </td>
            </tr>
            <tr>
                <td class='label'>Contact:</td>
                <td><input type='text' class='textBoxStyle1' name='txtCont' value='<?= $Cont ?>'/></td>
                <td><span class='errorText'><?= $ContErr ?></span></td>
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
                <td colspan='2'>
                    <hr>
                </td>
            </tr>
            <tr>
                <td class='label'>Venue:</td>
                <td>
                    <select name='selVenu' class='selectStyle1'>
                        <?PHP
                        $data->venue->printDropDownOptions(NULL, "Name");
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <hr>
                </td>
            </tr>
            <tr>
                <td class='label'>Feedback Form:</td>
                <td>
                    <select name='selFbform' class='selectStyle1'>
                        <?PHP
                        $data->feedback->printDropDownOptions(NULL, "Feedback_Title");
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <hr>
                </td>
            </tr>
            <tr>
                <td class='label'><label for="file" class='label'>Upload Picture:</label></td>
                <td class="file_add"><input type="file" name="file" id="file" onchange="PreviewImage();"
                                            style="opacity:0;filter:alpha(opacity:0);z-index:9999;cursor:default;"></td>
                <td><img id="uploadPreview" style="width: 100px; height: 100px;"/></td>
                <script type="text/javascript">

                    function PreviewImage() {
                        var oFReader = new FileReader();
                        oFReader.readAsDataURL(document.getElementById("file").files[0]);

                        oFReader.onload = function (oFREvent) {
                            document.getElementById("uploadPreview").src = oFREvent.target.result;
                        };
                    }
                    ;

                </script>
                <td><span class='errorText'><?= $uploErr ?></span></td>
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