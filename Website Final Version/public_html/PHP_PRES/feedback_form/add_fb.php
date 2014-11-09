<div id='feedback_form_add'>
<link rel='stylesheet' type='text/css' href='CSS/std_form.css'>
<?PHP
/*

 * File: add_fb.php
 * Add Section for the dstc e conference web application.
 * Written by JRPS Squad
 * Last updated: 27-10-14 by Rudhra
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
    if (vIsBlank($Titl) || !vMaxChars($Titl, 100) /*|| vRegexString($Titl)*/) // not blank, max 100 chars, no special character.
        $TitlErr = nv();

    // Validate Description:
    if (vIsBlank($Desc) || !vMaxChars($Desc, 400) /*|| vRegexString($Desc)*/) // not blank, max 400 chars, no special character.
        $DescErr = nv();


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
            "Feedback_Title" => $Titl,
            "Feedback_Desc" => $Desc,
    );
    if ($data->feedback->addRow($newData))
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
    <h1 style='text-align:center'>Add a Feedback Form</h1>


    <!-- Form START -->
    <form method='post' action='index.php?page=feedback_form&action=add_fb'>

        <h2 style='text-align:center'>&nbsp;</h2>
        <table class="std_form">
            <tr>
                <td class='label'>Feedback Title:</td>
                <td><input type='text' class='textBoxStyle1' name='txtTitl' value='<?= $Titl ?>'/></td>
                <td><span class='errorText'><?= $TitlErr ?></span></td>
            </tr>
            <tr>
                <td colspan="2">
                    <hr>
                </td>
            </tr>
            <tr>
                <td class='label'>Feedback Description:</td>
                <td><input type='text' class='textBoxStyle1' name='txtDesc' value='<?= $Desc ?>'/></td>
                <td><span class='errorText'><?= $DescErr ?></span></td>
            </tr>
            <tr>
                <td colspan="2">
                    <hr>
                </td>
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