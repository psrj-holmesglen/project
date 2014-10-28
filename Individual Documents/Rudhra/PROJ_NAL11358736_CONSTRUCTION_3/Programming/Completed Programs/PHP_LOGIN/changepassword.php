<div id='changepassword'>
    <link rel='stylesheet' type='text/css' href='CSS/std_form.css'>
    <?PHP
    
    // * File: changepassword.php
    // * changepassword for the dstc e conference web application.
    // * Written by JPRS Squad
    // * Last updated: 26-10-14 by Rudhra -->


    ////
    //// Setup START
    ////
	$userId = $_SESSION["userID"];
	
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
		$pwdChangeMessage = "";
        // Grab our data from the form.

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

        // Validate password:
        if (vIsBlank($Pass) || !vRangeChars($Pass, 8, 16) || !vIsMixedCase($Pass) || !vHasNumeral($Pass)) // .
            $PassErr = nv();
        //check passwords match
        if (vIsBlank($Pas2) || !vRangeChars($Pass, 8, 16) || !vIsMixedCase($Pas2) || !vHasNumeral($Pas2))
			$Pas2Err = nv();
		//Hash password for security
        $hashPas1 = md5($Pass);
		$hashPas2 = md5($Pas2);
		
		if($hashPas1 != $hashPas2)
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

                "Password" => $hashPass,
		);
        if ($data->user->updateRow($userId, $newData)){
			 //$pwdChangeMessage="Pasword Successfully changed";
            // header('Location: index.php?page=changepassword&action=changepassword');
			 ?>
             
              <!-- Back button -->
        <div id='backButton' style='float: left;'>
            <form action='index.php' method='get'>
                <input type='hidden' name='page' value='home'/>
                <input type='submit' class='buttonStyle1' value='Go Back'/>
            </form>
        </div>
        <!-- Heading -->
        <h2 align="center">Password Successfully changed </h2> <br /><br />
        <p style="margin-left:39%"> You will be redirected to login page..Please Login..</p>
        
        <meta http-equiv="refresh" content="3;url=http://www.dstcapp.com/PHP_LOGIN/login.php">
	<?	
	}
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
                <input type='hidden' name='page' value='home'/>
                <input type='submit' class='buttonStyle1' value='Go Back'/>
            </form>
        </div>
        <!-- Heading -->
        <h1 align="center">Change Password </h1>
        <!-- Form START -->
        <form method='post' action='index.php?page=changepassword&amp;action=changepassword'>
            <table class='std_form'>
                <tr>
                    <td colspan="2">
                        <hr>
                    </td>
                </tr>
                <tr>
                    <td class='label'>New Password:</td>
                    <td><input type='password' name='txtPass' class='textBoxStyle1' value='<?= $Pass ?>'/></td>
                    <td><span class='errorText'><?= $PassErr ?></span></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td class='label'>Re-enter New Password:</td>
                    <td><input type='password' name='txtPas2' class='textBoxStyle1' value='<?= $Pas2 ?>'/></td>
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
                <input type='submit' value='Reset' name='clicked_reset' class="buttonStyle1"/>
            	<input type='submit' value='Submit' name='clicked_submit' class="buttonStyle1"/>
                </span></td>
                </tr>
            </table>


        </form>
    <?PHP
    }
    ?>
</div>