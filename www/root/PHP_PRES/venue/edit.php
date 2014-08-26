<div id='review_question_edit'>
    <link rel='stylesheet' type='text/css' href='CSS/std_form.css'>
    <?PHP
    /*
     _____ _____ _____ _____    _____ _____ _____ _____ _____ _____
    |_   _|   __|  _  |     |  |   __|  _  |  _  | __  |_   _|  _  |
      | | |   __|     | | | |  |__   |   __|     |    -| | | |     |
      |_| |_____|__|__|_|_|_|  |_____|__|  |__|__|__|__| |_| |__|__|

     * File: Edit.php
     * Edit Q&A sessionquestions for the dstc e conference web application.
     * Written by TEAM SPARTA
     * Last updated: 23-05-14 by William Budds */

    ////
    //// Setup START
    ////

/*
    // Import libraries.
    require "PHP_DB/dbObject.php";

    // Get a copy of the DAL object.
    $data = new Data();

    ////
    //// Setup END
    ////

    // If submit has been clicked:
    if (isset($_POST['clicked_submit'])) {

        // Grab our data from the form.
        // in this case it is only the checkbox
        $Accepted = $_REQUEST["acceptedCheckbox"];

        // No validation required as user input is only in the form of a checkbox


        $newData = array(
                "Accepted" => $Accepted,
        );

        if ($data->sessionQuestion->updateRow($_GET["id"], $newData))
            header("Location: index.php?page=review_question");

        $row = $data->sessionQuestion->getRow($_GET["id"]);

        $Question = $row["Question"];


        ////
        //// Database Write END
        ////


    } else {
        // First page view:
        // Lets load the data from the DB.

        ////
        //// Database Read START
        ////

        $row = $data->sessionQuestion->getRow($_GET["id"]);

        $ID = $row["ID"];
        $Question = $row["Question"];
        $Accepted = $row["Accepted"];
        $Session = $row["Session"];

    }


    ///HTML Start
    ///
*/
    ?>

    <!-- Back button -->
    <div id='backButton' style='float: left;'>
        <form action='index.php' method='get'>
            <input type='hidden' name='page' value='review_question'/>
            <input type='submit' class='buttonStyle1' value='Go Back'/>
        </form>
    </div>
    <!-- Heading -->
    <h1 align="center">Edit Venue</h1>
    <!-- Form START -->
    <form method='post' action='index.php?page=review_question&action=edit&id=1'>
        
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

                    <input type='submit' value='Reset' name='clicked_reset' class="buttonStyle1"/>
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

</div>
