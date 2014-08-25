<div id='venue_add'>
    <link rel='stylesheet' type='text/css' href='CSS/std_form.css'>
    <?PHP
    // _____ _____ _____ _____    _____ _____ _____ _____ _____ _____
    //|_   _|   __|  _  |     |  |   __|  _  |  _  | __  |_   _|  _  |
    //  | | |   __|     | | | |  |__   |   __|     |    -| | | |     |
    //  |_| |_____|__|__|_|_|_|  |_____|__|  |__|__|__|__| |_| |__|__|
    //
    // * File: Add.php
    // * Delete Sections for the dstc e conference web application.
    // * Written by TEAM SPARTA
    // * Last updated: 20-05-14 by Jennifer de Peyrecave -->


    ////
    //// Setup START
    ////

/*
    // Import libraries.
    require "PHP_DB/dbObject.php";

    $validated = false;

    // Get a copy of the DAL object.
    $data = new Data();
    //set file upload variables
    $uploLoc = "UPLOADED_FILES/Venues/";
    ////
    //// Setup END
    ////

    // If submit has been clicked:
    if (isset($_POST['clicked_submit'])) {

        // Grab our data from the form.
        $Dire = $_POST['txtDire'];
        $CoId = $_POST['selCoId'];
        //$PFil = $_POST['selCoId'];


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

        // Validate Venue Directory:
        if (vIsBlank($Dire)) // not blank, only numbers.
            $OrdrErr = nv();
        //validate file upload
        if (fileUpload($page, $_files, $_post))
            $uploErr = nv();
        ////
        //// Validation Checking END.
        ////
        // Assume validated for now.
        //$validated = true;
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

        $newData = array(
                "Venue_Directory" => $Dire,
                "Conference" => $CoId,
                "Filepath" => $PFil,

        );
        $newID = $data->venue->addRow($newData);
        if ($newID) {
            if ($PFil != "No File Uploaded") {
                $fileData = explode(".", $_FILES['file']['name']);
                $target_file = $uploLoc . $newID . "." . $fileData[1];
                move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
            }

            header("Location: index.php?page=venue");

        }
        ////
        //// Database Write END
        ////
    } else {
        ////
        //// HTML Form START
        ////

*/
        ?>

        <!-- Back button -->
        <div id='backButton' style='float: left;'>
            <form action='index.php' method='get'>
                <input type='hidden' name='page' value='venue'/>
                <input type='submit' class='buttonStyle1' value='Go Back'/>
            </form>
        </div>
        <!-- Heading -->
        <h1 align="center">Add a Venue</h1>
        <!-- Form START -->
        <form method='post' action='index.php?page=venue&amp;action=add' enctype="multipart/form-data">

          <table class='std_form'>

              <tr>
                <td class='label'>Name</td>
                <td><input type='text' name='txtDire' class='textBoxStyle1' value='' /></td>
                <td><span class='errorText'></span></td>
              </tr>
              <tr>
                  <td colspan="2">
                      <hr>
                  </td>
              </tr>
              <tr>
                <td class='label'>Company</td>
                <td><input type='text' name='txtDire' class='textBoxStyle1' value='' /></td>
                <td><span class='errorText'></span></td>
              </tr>
              <tr>
                  <td colspan="2">
                      <hr>
                  </td>
              </tr>
              <tr>
                <td class='label'>Street</td>
                <td><input type='text' name='txtDire' class='textBoxStyle1' value='' /></td>
                <td><span class='errorText'></span></td>
              </tr>
              <tr>
                  <td colspan="2">
                      <hr>
                  </td>
              </tr>
              <tr>
                <td class='label'>Suburb</td>
                <td><input type='text' name='txtDire' class='textBoxStyle1' value='' /></td>
                <td><span class='errorText'></span></td>
              </tr>
              <tr>
                  <td colspan="2">
                      <hr>
                  </td>
              </tr>
              <tr>
                <td class='label'>Post Code</td>
                <td><input type='text' name='txtDire' class='textBoxStyle1' value='' /></td>
                <td><span class='errorText'></span></td>
              </tr>
              <tr>
                  <td colspan="2">
                      <hr>
                  </td>
              </tr>
              <tr>
                <td></td>
                <td colspan='2'>
<!--
                  <span style='float: right;'>

                    <input type='reset' value='Reset' name='clicked_reset' class="buttonStyle1"/>
                    <input type='submit' value='Submit' name='clicked_submit' class="buttonStyle1"/>

                  </span>
-->

                  <span style='float: right;'>

                    <form method="get" action="index.php">
                      <input type="submit" class='buttonStyle1' value="Go back"/>
                      <input type="hidden" name="page" value="venue"/>
                      <input type="hidden" name="action" value="view"/>
                    </form>

                    <form method="get" action="index.php">
                      <input type="submit" class='buttonStyle1' value="Save"/>
                      <input type="hidden" name="page" value="venue"/>
                      <input type="hidden" name="action" value="view"/>
                    </form>

                  </span>

                </td>
              </tr>
          </table>

        </form>
    <?PHP
/*
    }
*/
    ?>
</div>

