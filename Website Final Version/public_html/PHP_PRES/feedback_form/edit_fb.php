<div id='feedback_form_add'>
<link rel='stylesheet' type='text/css' href='CSS/std_form.css'>
<?PHP
/*
 _____ _____ _____ _____    _____ _____ _____ _____ _____ _____
|_   _|   __|  _  |     |  |   __|  _  |  _  | __  |_   _|  _  |
  | | |   __|     | | | |  |__   |   __|     |    -| | | |     |
  |_| |_____|__|__|_|_|_|  |_____|__|  |__|__|__|__| |_| |__|__|

 * File: edit_fb.php
 * Edit Feedback for the dstc e conference web application.
 * Written by JRPS Squad
 * Last updated: 20-09-14 by Rudhra
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
    if (isset($_POST['clicked_submit'])) {

        // Grab our data from the form.
        $Titl = $_POST["txtTitl"];
		$Desc = $_POST["txtDesc"];
       
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

	 	// Validate Title:
        if (vIsBlank($Titl) || !vMaxChars($Titl, 100)) // not blank, max 100 chars.
            $TitlErr = nv();
			
        // Validate Description:
        if (vIsBlank($Desc) || !vMaxChars($Desc, 250)) // not blank, only numbers.
            $DescrErr = nv();
			
        ////
        //// Validation Checking END.
        ////

        // HACK: Assume validated for now.
        //$validated = true;

        // Once the data has been validated, let's insert the data.
        if ($validated) {
            ///
            ///Database write Start
            ///

            $newData = array(
             	"Feedback_Title" => $Titl,
				"Feedback_Desc" => $Desc,
            );
            if ($data->feedback->updateRow($_GET["id"], $newData))
                header("Location: index.php?page=feedback_form");

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

        $row = $data->feedback->getRow($_GET["id"]);

        $Titl = $row["Feedback_Title"];
		$Desc = $row["Feedback_Desc"];
        

    }


    ///HTML Start
    ///
    ?>

    <!-- Back button -->
    <div id='backButton' style='float: left;'>
        <form action='index.php' method='get'>
            <input type='hidden' name='page' value='feedback_form'/>
            <input type='submit' class='buttonStyle1' value='Go Back'/>
        </form>
    </div>

    <!-- Heading -->
    <h1 align="center">Edit Feedback Form</h1>
    <!-- Form START -->
    <form method='post' action='index.php?page=feedback_form&action=edit_fb&id=<?= $_GET["id"] ?>'>
        <table class='std_form'>

            <td class='label'>Feedback Title:</td>
            <td><input type='text' name='txtTitl' class='textBoxStyle1' value='<?= $Titl ?>'/></td>
            <td><span class='errorText'><?= $TitlErr ?></span></td>
            </tr>
            <tr>
                <td colspan="2">
                    <hr>
                </td>
            </tr>
            <tr>
                <td class='label'>Feedback Description:</td>
                <td><input type='text' name='txtDesc' class='textBoxStyle1' value='<?= $Desc ?>'/></td>
                <td><span class='errorText'><?= $DescErr ?></span></td>
            </tr>
            <tr>
                <td colspan="2"></td>
            </tr>
            <tr>
                <td></td>
                <td colspan='2'><span style='float: right;'><input type='submit' value='Reset' name='clicked_reset'
                                                                   class='buttonStyle1'/>
                <input type='submit' value='Submit' name='clicked_submit' class='buttonStyle1'/>
                </span></td>
            </tr>
        </table>


    </form>

</div>