<div id='section_edit'>
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
        $Ordr = $_POST["txtOrdr"];
        $CoId = $_POST["selCoId"];
        $Titl = $_POST["txtTitl"];

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


        // Validate Ordering:
        if (vIsBlank($Ordr) || !vIsNumer($Ordr) || !vMaxChars($Ordr, 6)) // not blank, only numbers.
            $OrdrErr = nv();

        // Validate Title:
        if (vIsBlank($Titl) || !vMaxChars($Titl, 100)) // not blank, max 100 chars.
            $TitlErr = nv();
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
                    "Ordering" => $Ordr,
                    "Conference" => $CoId,
                    "Section_Title" => $Titl,


            );
            if ($data->section->updateRow($_GET["id"], $newData))
                header("Location: index.php?page=section");

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

        $row = $data->section->getRow($_GET["id"]);

        $Ordr = $row["Ordering"];
        $CoId = $row["Conference"];
        $Titl = $row["Section_Title"];


    }


    ///HTML Start
    ///
    ?>

    <!-- Back button -->
    <div id='backButton' style='float: left;'>
        <form action='index.php' method='get'>
            <input type='hidden' name='page' value='section'/>
            <input type='submit' class='buttonStyle1' value='Go Back'/>
        </form>
    </div>

    <!-- Heading -->
    <h1 align="center">Edit a Conference Section</h1>
    <!-- Form START -->
    <form method='post' action='index.php?page=section&action=edit&id=<?= $_GET["id"] ?>'>
        <table class='std_form'>

            <td class='label'>Section Order:</td>
            <td><input type='text' name='txtOrdr' class='textBoxStyle1' value='<?= $Ordr ?>'/></td>
            <td><span class='errorText'><?= $OrdrErr ?></span></td>
            </tr>
            <tr>
                <td colspan="2">
                    <hr>
                </td>
            </tr>
            <tr>
                <td class='label'>Conference Id:</td>
                <td>
                    <select name='selCoId' class='selectStyle1'>

                        <?PHP

                        $data->conference->printDropDownOptions($CoId, "Title");
                        ?>

                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <hr>
                </td>
            </tr>
            <tr>
                <td class='label'>Section Title:</td>
                <td><input type='text' name='txtTitl' class='textBoxStyle1' value='<?= $Titl ?>'/></td>
                <td><span class='errorText'><?= $TitlErr ?></span></td>
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