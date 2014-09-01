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

    // Import libraries.
    require "PHP_DB/dbObject.php";

    // Get a copy of the DAL object.
    $data = new Data();
    //set file upload variables
    //$uploLoc = "UPLOADED_FILES/Venues/";
    ////
    //// Setup END
    ////

    $validated = false;

    $newData = array(
      "name" => "",
      "company" => "",
      "street" => "",
      "suburb" => "",
      "Post_Code" => "",
    );

    $NameErr = "";
    $CompanyErr = "";
    $StreetErr = "";
    $SuburbErr = "";
    $PostCodeErr = "";

    if (isset($_POST['clicked_submit'])) {

      $newData = array(
        'Name' => $_POST['data_name'],
        'Company' => $_POST['data_company'],
        'Street' => $_POST['data_street'],
        'suburb' => $_POST['data_suburb'],
        'Post_Code' => $_POST['data_postcode'],
      );

      $validated = true;

      if (empty($_POST['data_name'])) {
        $validated = false;
        $NameErr = "Name cannot be empty";
      }
      if (empty($_POST['data_company'])) {
        $validated = false;
        $CompanyErr = "Company cannot be empty";
      }
      if (empty($_POST['data_street'])) {
        $validated = false;
        $StreetErr = "Street cannot be empty";
      }
      if (empty($_POST['data_suburb'])) {
        $validated = false;
        $SuburbErr = "Suburb cannot be empty";
      }
      if (empty($_POST['data_postcode']) || !is_numeric($_POST['data_postcode'])) {
        $validated = false;
        $PostCodeErr = "Post code cannot be empty and must be number";
      }

    }

    // Once the data has been validated, let's insert the data.
    if ($validated) {

        if($data->venue->addRow($newData)) {
          header('Location: ' . 'index.php?page=venue&amp;action=view');
        } else {
          print 'hoge';
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
                <input type='hidden' name='page' value='venue'/>
                <input type='submit' class='buttonStyle1' value='Go Back'/>
            </form>
        </div>
        <!-- Heading -->
        <h1 align="center">Add a Venue</h1>
        <!-- Form START -->
        <form method='post' action='index.php?page=venue&amp;action=add'>

          <table class='std_form'>

              <tr>
                <td class='label'>Name</td>
                <td><input type='text' name='data_name' class='textBoxStyle1' value='<?=$newData["Name"]?>' /></td>
                <td><span class='errorText'><?= $NameErr ?></span></td>
              </tr>
              <tr>
                  <td colspan="2">
                      <hr>
                  </td>
              </tr>
              <tr>
                <td class='label'>Company</td>
                <td><input type='text' name='data_company' class='textBoxStyle1' value='<?=$newData["Company"]?>' /></td>
                <td><span class='errorText'><?= $CompanyErr ?></span></td>
              </tr>
              <tr>
                  <td colspan="2">
                      <hr>
                  </td>
              </tr>
              <tr>
                <td class='label'>Street</td>
                <td><input type='text' name='data_street' class='textBoxStyle1' value='<?=$newData["Street"]?>' /></td>
                <td><span class='errorText'><?= $StreetErr ?></span></td>
              </tr>
              <tr>
                  <td colspan="2">
                      <hr>
                  </td>
              </tr>
              <tr>
                <td class='label'>Suburb</td>
                <td><input type='text' name='data_suburb' class='textBoxStyle1' value='<?=$newData["Suburb"]?>' /></td>
                <td><span class='errorText'><?= $SuburbErr ?></span></td>
              </tr>
              <tr>
                  <td colspan="2">
                      <hr>
                  </td>
              </tr>
              <tr>
                <td class='label'>Post Code</td>
                <td><input type='text' name='data_postcode' class='textBoxStyle1' value='<?=$newData["PostCode"]?>' /></td>
                <td><span class='errorText'><?= $PostCodeErr ?></span></td>
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

<!--
                    <form method="get" action="index.php">
                      <input type="submit" name='clicked_submit' class='buttonStyle1' value="Go back"/>
                      <input type="hidden" name="page" value="venue"/>
                      <input type="hidden" name="action" value="view"/>
                    </form>
-->

                    <a href='#' id='clicked_reset' class="buttonStyle1">Reset</a>
                    <input type="submit" name='clicked_submit' class='buttonStyle1' value="Save"/>
                    <input type="hidden" name="page" value="venue"/>
                    <input type="hidden" name="action" value="add"/>

                  </span>

                </td>
              </tr>
          </table>

        </form>
    <?PHP
    }
    ?>
</div>
<script>
$(function(){
  $('#clicked_reset').click(function(e){
    e.preventDefault();
    $('.errorText').remove();
  });
});
</script>

