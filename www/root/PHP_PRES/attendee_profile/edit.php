<div id='attendee_profile_edit'>
<link rel='stylesheet' type='text/css' href='CSS/std_form.css'>
<?PHP
/*
 _____ _____ _____ _____    _____ _____ _____ _____ _____ _____
|_   _|   __|  _  |     |  |   __|  _  |  _  | __  |_   _|  _  |
  | | |   __|     | | | |  |__   |   __|     |    -| | | |     |
  |_| |_____|__|__|_|_|_|  |_____|__|  |__|__|__|__| |_| |__|__|

 * File: edit.php
 * Edit Attendee Profile for the dstc e attendee_profile web application.
 * Written by TEAM SPARTA
 * Last updated: 31-03-14 by Caue
*/

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
if (isset($_POST["clicked_submit"])) {

    ////
    //// Validation Checking START.
    ////
    require "PHP_VALIDATION/validation.php";

    // Grab our data from the form.

    $Pos = $_POST['txtPos'];
    $Exp = $_POST['txtExp'];
    $Age = $_POST['selectAge'];
    $Gen = $_POST['txtGen'];

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

    // Validate Position type:
    if (vIsBlank($Pos) || /* (\__( o)< */
            !vMaxChars($Pos, 100)
    ) // not blank, max 100 chars.
        $PosErr = nv();

    // Validate Years of experience:
    if (vIsBlank($Exp) || !vMaxChars($Exp, 400)) // not blank, max 400 chars.
        $ExpErr = nv();

    ////
    //// Validation Checking END.
    ////
    // Once the data has been validated, let's insert the data.
    if ($validated) {
        ////
        //// Database Write START
        ////
        $newData = array(
                "Position_Type" => $Pos,
                "Years_Experience" => $Exp,
                "Age_Group" => $Age,
                "Gender" => $Gen,

        );
        if ($data->attendeeProfile->updateRow($_GET["id"], $newData))
            header("Location: index.php?page=attendee_profile");

        ////
        //// Database Write END
        ////
    }
} else {
    // First page view:
    // Lets load the data from the DB.

    ////
    //// Database Read START
    ////

    $row = $data->attendeeProfile->getRow($_GET["id"]);

    $Pos = $row["Position_Type"];
    $Exp = $row["Years_Experience"];
    $Age = $row["Age_Group"];
    $Gen = $row["Gender"];

    $selGen = array();

    if ($Gen == "Male")
        $selGen[0] = "selected";

    else if ($Gen == "Female")
        $selGen[1] = "selected";

    $selAge = array();

    if ($Age == "20-30")
        $selAge[0] = "selected";

    else if ($Age == "30-40")
        $selAge[1] = "selected";

    else if ($Age == "40-45")
        $selAge[2] = "selected";

    else if ($Age == "45-50")
        $selAge[3] = "selected";

    else if ($Age == "50-55")
        $selAge[4] = "selected";

    else if ($Age == "55-60")
        $selAge[5] = "selected";

    else if ($Age == "60-65")
        $selAge[6] = "selected";

    else if ($Age == "65-70")
        $selAge[7] = "selected";

    else if ($Age == "70-80")
        $selAge[8] = "selected";

    else if ($Age == "80-90")
        $selAge[9] = "selected";

}
////
//// Database Read END
////

////
//// HTML Form START
////

?>

<!-- Back button -->
<div id='backButton' style='float: left;'>
    <form action='index.php' method='get'>
        <input type='hidden' name='page' value='attendee_profile'/>
        <input type='submit' class='buttonStyle1' value='Go Back'/>
    </form>
</div>

<!-- Heading -->
<h1 style='text-align:center'>Edit an Attendee Profile</h1>

<!-- Form START -->
<form method='post' action='index.php?page=attendee_profile&action=edit&id=<?= $_GET["id"] ?>'>
    <table class='std_form'>
        <tr>
            <td>Position type:</td>
            <td><input type='text' name='txtPos' value='<?= $Pos ?>' class='textBoxStyle1'/></td>
            <td><span class='errorText'><?= $PosErr ?></span></td>
        </tr>
        <tr>
            <td>Years experience:</td>
            <td><input type='text' name='txtExp' value='<?= $Exp ?>' class='textBoxStyle1'/></td>
            <td><span class='errorText'><?= $ExpErr ?></span></td>
        </tr>
        <tr>
            <td>Age group:</td>
            <td><select name='selectAge' id='selectAge' size='1' class='selectStyle1'>
                    <option value='20-30' <?= $selAge[0] ?>>20-30</option>
                    <option value='30-40' <?= $selAge[1] ?>>30-40</option>
                    <option value='40-45' <?= $selAge[2] ?>>40-45</option>
                    <option value='45-50' <?= $selAge[3] ?>>45-50</option>
                    <option value='50-55' <?= $selAge[4] ?>>50-55</option>
                    <option value='55-60' <?= $selAge[5] ?>>55-60</option>
                    <option value='60-65' <?= $selAge[6] ?>>60-65</option>
                    <option value='65-70' <?= $selAge[7] ?>>65-70</option>
                    <option value='70-80' <?= $selAge[8] ?>>70-80</option>
                    <option value='80-90' <?= $selAge[9] ?>>80-90</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Gender:</td>
            <td>
                <select name='txtGen' size='1' class='selectStyle1'>
                    <option value='Male' <?= $selGen[0] ?>>Male</option>
                    <option value='Female' <?= $selGen[1] ?>>Female</option>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan='2'><span style='float: right;'>
                	<br/>
                    <input type='reset' value='Reset' name='clicked_reset' class="buttonStyle1"/>
                    <input type='submit' value='Submit' name='clicked_submit' class='buttonStyle1'/>
                    </span>
            </td>
        </tr>
    </table>

</form>
<!-- Form End -->
</div>