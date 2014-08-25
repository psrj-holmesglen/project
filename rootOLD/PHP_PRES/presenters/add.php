<div id='presenter_add'>
<link rel='stylesheet' type='text/css' href='CSS/std_form.css'>
<?PHP

/*
 _____ _____ _____ _____    _____ _____ _____ _____ _____ _____
|_   _|   __|  _  |     |  |   __|  _  |  _  | __  |_   _|  _  |
  | | |   __|     | | | |  |__   |   __|     |    -| | | |     |
  |_| |_____|__|__|_|_|_|  |_____|__|  |__|__|__|__| |_| |__|__|

 * File: add.php
 * Add Presenter for the dstc e conference web application.
 * Written by TEAM SPARTA Will
 * Last updated: 17/05/14 by Jenny
 */

////
//// Setup START
////

// Import libraries.
require "PHP_PRES/helpers/dateTimePicker.php";
require "PHP_DB/dbObject.php";
//require "PHP_VALIDATION/validation.php";

//set file upload variables
$uploLoc = "UPLOADED_FILES/Presenter/";

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
if (isset($_POST['clicked_submit'])) {
    // Import libraries.
    require "PHP_VALIDATION/validation.php";
    //require "PHP_DB/dbFileUpload.php";

    // Grab our data from the form.
    $Titl = $_POST['txtTitl'];
    $FNam = $_POST['txtFNam'];
    $LNam = $_POST['txtLNam'];
    $Orga = $_POST['txtOrga'];
    $MedF = $_POST['txtMedF'];
    $Posi = $_POST['txtPosi'];
    $Qual = $_POST['txtQual'];
    $SBio = $_POST['txtSBio'];
    //$PFil = $_POST['file'];

    //A Boolean flag that determines validation success
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
    if (vRegexString($Titl)) {
        $TitlErr = nv();
    }
    if (vIsBlank($Titl) || !vMaxChars($Titl, 20)) // not blank, max 20 chars.
        $TitlErr = nv();

    // Validate First Name:
    if (vRegexString($FNam)) {
        $FNamErr = nv();
    }
    if (vIsBlank($FNam) || !vMaxChars($FNam, 30)) // not blank, max 30 chars.
        $FNamErr = nv();

    // Validate Last Name:
    if (vRegexString($LNam)) {
        $LNamErr = nv();
    }
    if (vIsBlank($LNam) || !vMaxChars($LNam, 30)) // not blank, max 30 chars.
        $LNamErr = nv();

    // Validate Organisation:
    if (vRegexString($Orga)) {
        $OrgaErr = nv();
    }
    if (vIsBlank($Orga) || !vMaxChars($Orga, 40)) // not blank, max 40 chars.
        $OrgaErr = nv();

    // Validate Qualification:
    if (vRegexString($Qual)) {
        $QualErr = nv();
    }
//            if(vIsBlank($Qual) || !vMaxChars($Qual, 100) )   // not blank, max 100 chars.
//                $QualErr = nv();

    // Validate Short Bio:
//            if(vRegexString($SBio)){
//                $SBioErr = nv();
//            }
//            if(vIsBlank($SBio) || !vMaxChars($SBio, 250) )   // not blank, max 250 chars.
//                $SBioErr = nv();


    if (vRegexString($MedF)) {
        $MedFErr = nv();
    }
    if (vRegexString($Posi)) {
        $PosiErr = nv();
    }
    //validate file upload
    if (fileUpload($page, $_files, $_post)) {
        $uploErr = nv();
    }
}
////
//// Validation Checking END.
////

// Once the data has been validated, let's insert the data.
if ($validated) {

    ////
    //// Database Write START
    ////

    //Check for file in file upload
    if (empty($_FILES["file"]["name"])) {
        $PFil = "No File Uploaded";
    } else { //if file found then move and save to folder

        //change name of file to presenter ID:
        //$userID = time();
//				$userID = "id";
        //explode the filename so we get the extension
        //considering the filename "avatar.png" $target_file will contain "/absolute/path/to/your/upload/folder/1.png"
//                echo $target_file;
//				echo $uploLoc . $_FILES["file"]["name"];
        //$uploErr = "File Uploaded Successfully " . $_FILES["file"]["name"];
        //send link to database:..
        $PFil = $target_file;
        $PFil = "File Uploaded";
    }


    $newData = array(
            "Title" => $Titl,
            "First_Name" => $FNam,
            "Last_Name" => $LNam,
            "Organisation" => $Orga,
            "Medical_Field" => $MedF,
            "Position" => $Posi,
            "Qualification" => $Qual,
            "Short_Bio" => $SBio,
            "Filepath" => $PFil
    );


    $newID = $data->presenter->addRow($newData);
    if ($newID) {
        if ($PFil != "No File Uploaded") {
            $fileData = explode(".", $_FILES['file']['name']);
            $target_file = $uploLoc . $newID . "." . $fileData[1];
            move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
        }

        echo "<script>window.location.replace('index.php?page=presenter&action=view');</script>";
//			       header('Location: index.php?page=presenter&action=view');
    }

    ////
    //// Database Write END
    ////
} else {
    ////
    //// HTML Form START
    ////


    // If invalid data, or no submission yet, lets display the form:
    ?>

    <!-- Back button -->
    <div id='backButton' style='float: left;'>
        <form action='index.php' method='get'>
            <input type='hidden' name='page' value='presenter'/>
            <input type='submit' class='buttonStyle1' value='Go Back'/>
        </form>
    </div>

    <!-- Heading -->
    <h1 align="center">Add a Presenter</h1>

    <!-- Form START -->
    <form method='post' action='index.php?page=presenter&action=add' enctype="multipart/form-data">
        <table class='std_form'>

            <tr>
                <td class='label'>Title:</td>
                <td><input type='text' class='textBoxStyle1' name='txtTitl' value='<?= $Titl ?>'/></td>
                <td><span class='errorText'><?= $TitlErr ?></span></td>
            </tr>
            <tr>
                <td colspan="2">
                    <hr>
                </td>
            </tr>
            <tr>
                <td class='label'>First Name:</td>
                <td><input type='text' class='textBoxStyle1' name='txtFNam' value='<?= $FNam ?>'/></td>
                <td><span class='errorText'><?= $FNamErr ?></span></td>
            </tr>
            <tr>
                <td colspan="2">
                    <hr>
                </td>
            </tr>
            <tr>
                <td class='label'>Last Name:</td>
                <td><input type='text' class='textBoxStyle1' name='txtLNam' value='<?= $LNam ?>'/></td>
                <td><span class='errorText'><?= $LNamErr ?></span></td>
            </tr>
            <tr>
                <td colspan="2">
                    <hr>
                </td>
            </tr>
            <tr>
                <td class='label'>Organisation:</td>
                <td><input type='text' class='textBoxStyle1' name='txtOrga' value='<?= $Orga ?>'/></td>
                <td><span class='errorText'><?= $OrgaErr ?></span></td>
            </tr>
            <tr>
                <td colspan="2">
                    <hr>
                </td>
            </tr>
            <tr>
                <td class='label'>Medical Field:</td>
                <td><input type='text' class='textBoxStyle1' name='txtMedF' value='<?= $MedF ?>'/></td>
                <td><span class='errorText'><?= $MedFErr ?></span></td>
            </tr>
            <tr>
                <td colspan="2">
                    <hr>
                </td>
            </tr>
            <tr>
                <td class='label'>Position:</td>
                <td><input type='text' class='textBoxStyle1' name='txtPosi' value='<?= $Posi ?>'/></td>
                <td><span class='errorText'><?= $PosiErr ?></span></td>
            </tr>
            <tr>
                <td colspan="2">
                    <hr>
                </td>
            </tr>
            <tr>
                <td class='label'>Qualification:</td>
                <td><input type='text' class='textBoxStyle1' name='txtQual' value='<?= $Qual ?>'/></td>
                <td><span class='errorText'><?= $QualErr ?></span></td>
            </tr>
            <tr>
                <td colspan="2">
                    <hr>
                </td>
            </tr>
            <tr>
                <td class='label'>Short Bio:</td>
                <td><textarea type='text' cols='30' rows='8' class='textAreaStyle1'
                              name='txtSBio'><?= $SBio ?></textarea></td>
                <td><span class='errorText'><?= $SBioErr ?></span></td>
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
                <td colspan="2"></td>
            </tr>
            <tr>
                <td colspan='2'><span style='float: right;'>
                                
                                <input type='reset' value='Reset' class='buttonStyle1' name='clicked_reset'/>
                                <input type='submit' value='Submit' class='buttonStyle1' name='clicked_submit'/>

                </td>
            </tr>
        </table>
    </form>
<?PHP
}
////
//// HTML Form END
////
?>


</div>
