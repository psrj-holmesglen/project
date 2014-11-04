<div id='user_edit'>
    <link rel='stylesheet' type='text/css' href='CSS/std_form.css'>
    <?PHP
    /*
_____ _____ _____ _____    _____ _____ _____ _____ _____ _____
|_   _|   __|  _  |     |  |   __|  _  |  _  | __  |_   _|  _  |
| | |   __|     | | | |  |__   |   __|     |    -| | | |     |
|_| |_____|__|__|_|_|_|  |_____|__|  |__|__|__|__| |_| |__|__|

* File: Edit.php
* Edit User for the dstc e conference web application.
* Written by TEAM SPARTA
* Last updated: 02-04-14 by Jennifer de Peyrecave */

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

        $FNam = $_POST['txtFNam'];
        $LNam = $_POST['txtLNam'];
        $UNam = $_POST['txtUNam'];
        $Emai = $_POST['txtEmai'];
        //$Pass = $_POST['txtPass'];
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

        // Validate first name:
        if (vIsBlank($FNam) || !vMaxChars($FNam, 25) || !vIsAlpha($FNam)) // not blank, max 25 chars.
            $FNamErr = nv();
        // Validate last name:
        if (vIsBlank($LNam) || !vMaxChars($LNam, 30) || !vIsAlpha($LNam)) // not blank, max 30 chars.
            $LNamErr = nv();
        // Validate user name:
        if (vIsBlank($UNam) || !vMaxChars($UNam, 30) || !vIsAlpha($UNam)) // not blank, max 30 chars.
            $UNamErr = nv();
        // Validate email:
        if (vIsBlank($Emai) || !vIsEmail($Emai) || !vMaxChars($Emai, 50)) // not blank, max 50 chars.
            $EmaiErr = nv();
        ////
        //// Validation Checking END.
        ////

        // Once the data has been validated, let's insert the data.
        if ($validated) {
            ///
            ///Database write Start
            ///

            $newData = array(

                    "First_Name" => $FNam,
                    "Last_Name" => $LNam,
                    "User_name" => $UNam,
                    "Email" => $Emai,

            );

            if ($data->user->updateRow($_GET["id"], $newData))
                header('Location: index.php?page=user&action=view');

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

        $row = $data->user->getRow($_GET["id"]);


        $FNam = $row['First_Name'];
        $LNam = $row['Last_Name'];
        $UNam = $row['User_name'];
        $Emai = $row['Email'];

    }


    ///HTML Start
    ///
    ?>

    <!-- Back button -->
    <div id='backButton' style='float: left;'>
        <form action='index.php' method='get'>
            <input type='hidden' name='page' value='user'/>
            <input type='submit' class='buttonStyle1' value='Go Back'/>
        </form>
    </div>

    <!-- Heading -->
    <h1 align="center">Edit a User</h1>
    <!-- Form START -->
    <form method='post' action='index.php?page=user&action=edit&id=<?= $_GET["id"] ?>'>
        <table class='std_form'>
            <tr>
                <td colspan="2"></td>
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
                <td class='label'>User Name:</td>
                <td><input type='text' name='txtUNam' class='textBoxStyle1' value='<?= $UNam ?>'/></td>
                <td><span class='errorText'><?= $UNamErr ?></span></td>
            </tr>
            <tr>
                <td colspan="2">
                    <hr>
                </td>
            </tr>
            <tr>
                <td class='label'>Email:</td>
                <td><input type='text' name='txtEmai' class='textBoxStyle1' value='<?= $Emai ?>'/></td>
                <td><span class='errorText'><?= $EmaiErr ?></span></td>
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