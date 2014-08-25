<div id='presenter_edit'>
<link rel='stylesheet' type='text/css' href='CSS/std_form.css'>
<?PHP
/*
 _____ _____ _____ _____    _____ _____ _____ _____ _____ _____
|_   _|   __|  _  |     |  |   __|  _  |  _  | __  |_   _|  _  |
  | | |   __|     | | | |  |__   |   __|     |    -| | | |     |
  |_| |_____|__|__|_|_|_|  |_____|__|  |__|__|__|__| |_| |__|__|

 * File: Edit.php
 * Edit Sections for the dstc e conference web application.
 * Written by TEAM SPARTA
 * Last updated: 28-03-14 by Jennifer de Peyrecave */

////
//// Setup START
////

// Import libraries.
require "PHP_DB/dbObject.php";


$validated = false;

// Get a copy of the DAL object.
$data = new Data();

////
//// Setup END
////

// If submit has been clicked:
if (isset($_POST['clicked_submit'])) {

    // Grab our data from the form.
    $Titl = $_POST['txtTitl'];
    $FNam = $_POST['txtFNam'];
    $LNam = $_POST['txtLNam'];
    $Orga = $_POST['txtOrga'];
    $MedF = $_POST['txtMedF'];
    $Posi = $_POST['txtPosi'];
    $Qual = $_POST['txtQual'];
    $SBio = $_POST['txtSBio'];
    //$PFil = $_POST['txtPFil'];

    ////
    //// Validation Checking START.
    ////
    require "PHP_VALIDATION/validation.php";

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

    if (vRegexString($Titl)) {
        $TitlErr = nv();
    }

    if (vIsBlank($Titl) || !vMaxChars($Titl, 20)) { // not blank, max 20 chars.
        $TitlErr = nv();
    }
    // Validate First Name:
    if (vRegexString($FNam)) {
        $FNamErr = nv();
    }
    if (vIsBlank($FNam) || !vMaxChars($FNam, 30)) { // not blank, max 30 chars.
        $FNamErr = nv();
    }
    // Validate Last Name:
    if (vRegexString($LNam)) {
        $LNamErr = nv();
    }
    if (vIsBlank($LNam) || !vMaxChars($LNam, 30)) { // not blank, max 30 chars.
        $LNamErr = nv();
    }
    // Validate Organisation:
    if (vRegexString($Orga)) {
        $OrgaErr = nv();
    }
    if (vIsBlank($Orga) || !vMaxChars($Orga, 150)) { // not blank, max 40 chars.
        $OrgaErr = nv();
    }
    // Validate Medical Field:
    if (vIsBlank($MedF) || !vMaxChars($MedF, 50)) { // not blank, max 50 chars.
        $MedFErr = nv();
    }
    // Validate Position:
    if (vRegexString($Posi)) {
        $PosiErr = nv();
    }
    if (vIsBlank($Posi) || !vMaxChars($Posi, 100)) { // not blank, max 30 chars.
        $PosiErr = nv();
    }
    // Validate Qualification:
    if (vRegexString($Qual)) {
        $QualErr = nv();
    }
    if (vIsBlank($Qual) || !vMaxChars($Qual, 100)) { // not blank, max 100 chars.
        $QualErr = nv();
    }
    // Validate Short Bio:
    if (vRegexString($SBio)) {
        $SBioErr = nv();
    }
    if (vIsBlank($SBio) || !vMaxChars($SBio, 250)) { // not blank, max 250 chars.
        $SBioErr = nv();
    }
    //validate file upload
    if (fileUpload($page, $_files, $_post, $uploLoc)) {
        $uploErr = nv();
    }
    ////
    //// Validation Checking END.
    ////
}
// Once the data has been validated, let's insert the data.
if ($validated) {
    //Check for file in file upload
    if (empty($_FILES["file"]["name"])) {
        $PFil = "No File Uploaded";
    } else { //if file found then move and save to folder

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
            "Filepath" => $PFil,
    );
    if ($data->presenter->updateRow($_GET["id"], $newData)) {
        header('Location: index.php?page=presenter&action=view');

    }


    ////
    //// Database Write END
    ////
} else {
    // First page view:
    // Lets load the data from the DB.
    ////
    //// Database Read START
    ////

    $row = $data->presenter->getRow($_GET["id"]);

    $Titl = $row["Title"];
    $FNam = $row["First_Name"];
    $LNam = $row["Last_Name"];
    $Orga = $row["Organisation"];
    $MedF = $row["Medical_Field"];
    $Posi = $row["Position"];
    $Qual = $row["Qualification"];
    $SBio = $row["Short_Bio"];
    //$PFil = $row["Filepath"];
}
///HTML Start
///
?>

<!-- Back button -->
<div id='backButton' style='float: left;'>
    <form action='index.php' method='get'>
        <input type='hidden' name='page' value='presenter'/>
        <input type='submit' class='buttonStyle1' value='Go Back'/>
    </form>
</div>
<!-- Heading -->
<h1 align="center">Edit a Presenter</h1>
<!-- Form START -->
<form method='post' action='index.php?page=presenter&action=edit&id=<?= $_GET["id"] ?>' enctype="multipart/form-data">
    <table class='std_form'>

        <tr>
            <td colspan="2"></td>
        </tr>

        <td class='label'>Title:</td>
        <td><input type='text' name='txtTitl' class='textBoxStyle1' value='<?= $Titl ?>'/></td>
        <td><span class='errorText'><?= $TitlErr ?></span></td>
        </tr>
        <tr>
            <td colspan="2">
                <hr>
            </td>
        </tr>
        <tr>
            <td class='label'>First Name:</td>
            <td><input type='text' name='txtFNam' class='textBoxStyle1' value='<?= $FNam ?>'/></td>
            <td><span class='errorText'><?= $FNamErr ?></span></td>
        </tr>
        <tr>
            <td colspan="2">
                <hr>
            </td>
        </tr>
        <tr>
            <td class='label'>Last Name:</td>
            <td><input type='text' name='txtLNam' class='textBoxStyle1' value='<?= $LNam ?>'/></td>
            <td><span class='errorText'><?= $LNamErr ?></span></td>
        </tr>
        <tr>
            <td colspan="2">
                <hr>
            </td>
        </tr>
        <tr>
            <td class='label'>Organisation:</td>
            <td><input type='text' name='txtOrga' class='textBoxStyle1' value='<?= $Orga ?>'/></td>
            <td><span class='errorText'><?= $OrgaErr ?></span></td>
        </tr>
        <tr>
            <td colspan="2">
                <hr>
            </td>
        </tr>
        <tr>
            <td class='label'>Medical Field:</td>
            <td><input type='text' name='txtMedF' class='textBoxStyle1' value='<?= $MedF ?>'/></td>
            <td><span class='errorText'><?= $MedFErr ?></span></td>
        </tr>
        <tr>
            <td colspan="2">
                <hr>
            </td>
        </tr>
        <tr>
            <td class='label'>Position:</td>
            <td><input type='text' name='txtPosi' class='textBoxStyle1' value='<?= $Posi ?>'/></td>
            <td><span class='errorText'><?= $PosiErr ?></span></td>
        </tr>
        <tr>
            <td colspan="2">
                <hr>
            </td>
        </tr>
        <tr>
            <td class='label'>Qualification:</td>
            <td><input type='text' name='txtQual' class='textBoxStyle1' value='<?= $Qual ?>'/></td>
            <td><span class='errorText'><?= $QualErr ?></span></td>
        </tr>
        <tr>
            <td colspan="2">
                <hr>
            </td>
        </tr>
        <tr>
            <td class='label'>Short Bio:</td>
            <td><textarea type='text' cols='30' rows='8' name='txtSBio' class='textBoxStyle1'><?= $SBio ?></textarea>
            </td>
            <td><span class='errorText'><?= $SBioErr ?></span></td>
        </tr>
        <tr>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td></td>
            <td colspan='2'><span style='float: right;'><input type='reset' value='Reset' name='clicked_reset'
                                                               class='buttonStyle1'/>
                <input type='submit' value='Submit' name='clicked_submit' class='buttonStyle1'/>
                </span></td>
        </tr>
    </table>

</form>

</div>