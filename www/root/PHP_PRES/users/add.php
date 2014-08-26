<div id='user_add'>
    <link rel='stylesheet' type='text/css' href='CSS/std_form.css'>
    <?PHP
    // _____ _____ _____ _____    _____ _____ _____ _____ _____ _____
    //|_   _|   __|  _  |     |  |   __|  _  |  _  | __  |_   _|  _  |
    //  | | |   __|     | | | |  |__   |   __|     |    -| | | |     |
    //  |_| |_____|__|__|_|_|_|  |_____|__|  |__|__|__|__| |_| |__|__|
    //
    // * File: add.php
    // * Add User for the dstc e conference web application.
    // * Written by TEAM SPARTA
    // * Last updated: 02-04-14 by Jennifer de Peyrecave -->


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
        $Pass = $_POST['txtPass'];
        $Pas2 = $_POST['txtPas2'];


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
        if (vIsBlank($FNam) || !vMaxChars($FNam, 25) || !vIsAlphaNB($FNam)) // not blank, max 100 chars.
            $FNamErr = nv();
        // Validate last name:
        if (vIsBlank($LNam) || !vMaxChars($LNam, 30) || !vIsAlpha($LNam)) // not blank, max 100 chars.
            $LNamErr = nv();
        // Validate user name:
        if (vIsBlank($UNam) || !vMaxChars($UNam, 30) || !vIsAlpha($UNam)) // not blank, max 100 chars.
            $UNamErr = nv();
        // Validate email:
        if (vIsBlank($Emai) || !vIsEmail($Emai) || !vMaxChars($Emai, 50)) // not blank, max 100 chars.
            $EmaiErr = nv();
        // Validate password:
        if (vIsBlank($Pass) || !vRangeChars($Pass, 8, 16) || !vIsMixedCase($Pass) || !vHasNumeral($Pass)) // .
            $PassErr = nv();
        //check passwords match
        if (vIsBlank($Pas2) || $Pass != $Pas2)
            $Pas2Err = "Passwords do not Match";
        ////
        //// Validation Checking END.
        ////

    }

    // Once the data has been validated, let's insert the data.
    if ($validated) {
        ////
        //// Database Write START
        ////

        //Hash password for security
        $hashPass = md5($Pass);

        $newData = array(

                "First_Name" => $FNam,
                "Last_Name" => $LNam,
                "User_name" => $UNam,
                "Email" => $Emai,
                "Password" => $hashPass,

        );
        if ($data->user->addRow($newData))
            header('Location: index.php?page=user&action=view');
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
                <input type='hidden' name='page' value='user'/>
                <input type='submit' class='buttonStyle1' value='Go Back'/>
            </form>
        </div>
        <!-- Heading -->
        <h1 align="center">Add a User</h1>
        <!-- Form START -->
        <form method='post' action='index.php?page=user&amp;action=add'>
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
                    <td colspan="2">
                        <hr>
                    </td>
                </tr>
                <tr>
                    <td class='label'>Password:</td>
                    <td><input type='password' name='txtPass' class='textBoxStyle1' value='<?= $Pass ?>'/></td>
                    <td><span class='errorText'><?= $PassErr ?></span></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td class='label'>Re-enter Password:</td>
                    <td><input type='text' name='txtPas2' class='textBoxStyle1' value='<?= $Pas2 ?>'/></td>
                    <td><span class='errorText'><?= $Pas2Err ?></span></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Password must contain:<br/> Between 8-16 characters, <br/>Upper and lower case characters,<br/>
                        Numbers
                    </td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan='2'><span style='float: right;'>
                <input type='reset' value='Reset' name='clicked_reset' class="buttonStyle1"/>
            	<input type='submit' value='Submit' name='clicked_submit' class="buttonStyle1"/>
                </span></td>
                </tr>
            </table>


        </form>
    <?PHP
    }
    ?>
</div>