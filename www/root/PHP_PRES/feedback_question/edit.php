<div id='feedback_question_edit'>
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
* Last updated: 20-04-14 by Shohei Masunaga */

////
//// Setup START
////

// Import libraries.
require "PHP_DB/dbObject.php";

$validated = false;

// Get a copy of the DAL object.
$data = new Data();


$input = array();
$ON = array_pad($input, $Options, 0);
$input2 = array();
$OT = array_pad($input2, $Options, 0);


////
//// Setup END
////

// If submit has been clicked:
if (isset($_POST['clicked_submit'])) {

    // Grab our data from the form.
    $row = $data->feedbackQuestion->getRow($_GET["id"]);

    $Id = $row["ID"];
    $QuesNo = $row["Question_Number"];

    $Qtxt = $_POST['txtQuestionText'];
    $Type = $_REQUEST["radiobutton"];
    $Qtype = $_POST['txtQtype'];
    $Sect = $_POST['txtSect'];

    if ($Type == 1) {
        $Options = $_POST['txtOptionNo'];

        $Option_original = $data->feedbackOption->getRowCount_fo($Id);

        $table = $data->feedbackOption->getRowByMatch_fo_no("Feedback_Question", $Id);

        $s = 0;
        $OID = array();
        foreach ($table as $row) {
            switch ($s) {
                case 0:
                    $OID[0] = $row["ID"];
                    break;
                case 1:
                    $OID[1] = $row["ID"];
                    break;
                case 2:
                    $OID[2] = $row["ID"];
                    break;
                case 3:
                    $OID[3] = $row["ID"];
                    break;
                case 4:
                    $OID[4] = $row["ID"];
                    break;
                case 5:
                    $OID[5] = $row["ID"];
                    break;
                case 6:
                    $OID[6] = $row["ID"];
                    break;
                case 7:
                    $OID[7] = $row["ID"];
                    break;
                case 8:
                    $OID[8] = $row["ID"];
                    break;
                case 9:
                    $OID[9] = $row["ID"];
                    break;
            }
            $s++;
        }


        $s = 1;
        foreach ($ON as &$value) {
            if ($s <= $Options) {
                $value = $s;
            }
            $s++;
        }

        $s = 0;
        while ($Options >= $s) {

            switch ($s) {
                case 0:
                    $OT[0] = $_POST['txtOptionText1'];
                    break;
                case 1:
                    $OT[1] = $_POST['txtOptionText2'];
                    break;
                case 2:
                    $OT[2] = $_POST['txtOptionText3'];
                    break;
                case 3:
                    $OT[3] = $_POST['txtOptionText4'];
                    break;
                case 4:
                    $OT[4] = $_POST['txtOptionText5'];
                    break;
                case 5:
                    $OT[5] = $_POST['txtOptionText6'];
                    break;
                case 6:
                    $OT[6] = $_POST['txtOptionText7'];
                    break;
                case 7:
                    $OT[7] = $_POST['txtOptionText8'];
                    break;
                case 8:
                    $OT[8] = $_POST['txtOptionText9'];
                    break;
                case 9:
                    $OT[9] = $_POST['txtOptionText10'];
                    break;
            }

            $s++;
        }
    }

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


    // Validate Question Text:
    if (vIsBlank($Qtxt) || !vMaxChars($Qtxt, 200)) // not blank, max 200 chars.
        $Q_TextErr = nv();


    // Validate Multiple Choice
    if ($Type == 1) {
        $n = 0;
        for ($k = 0; $k < $Options; $k++) {
            if (vIsBlank($OT[$k]) || !vMaxChars($OT[$k], 100)) {
                switch ($k) {
                    case 0:
                        $Op_TextErr1 = nv();
                        break;
                    case 1:
                        $Op_TextErr2 = nv();
                        break;
                    case 2:
                        $Op_TextErr3 = nv();
                        break;
                    case 3:
                        $Op_TextErr4 = nv();
                        break;
                    case 4:
                        $Op_TextErr5 = nv();
                        break;
                    case 5:
                        $Op_TextErr6 = nv();
                        break;
                    case 6:
                        $Op_TextErr7 = nv();
                        break;
                    case 7:
                        $Op_TextErr8 = nv();
                        break;
                    case 8:
                        $Op_TextErr9 = nv();
                        break;
                    case 9:
                        $Op_TextErr10 = nv();
                        break;
                }

                if ($n == 0) {
                    $Q_TypeErr = "Error found in your input of multiple choice.";
                    $OpNoErr = "Invalid Input in ";
                    $n++;
                }
                $m = $k + 1;
                $OpNoErr .= strval($m) . " ";


            }
        }
    }

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
                "Question_Number" => $QuesNo,
                "Question_Text" => $Qtxt,
                "Type" => $Type,
                "Question_Type" => $Qtype,
                "Feedback_Section" => $Sect,

        );
        if ($data->feedbackQuestion->updateRow($_GET["id"], $newData)) {
            if ($Type == 1) {

                if ($Options == $Options_original) {
                    $p = 0;

                    while ($Options > $p) {
                        $OTxt = $OT[$p];
                        $OId2 = $OID[$p];

                        $newData2 = array(
                                "Option_Text" => $OTxt,
                        );
                        $data->feedbackOption->updateRow_fo($OId2, $newData2);
                        $p++;
                    }
                }

                if ($Options != $Options_original) {
                    if ($Options > $Option_original) {
                        $p = 0;

                        while ($Option_original > $p) {
                            $OTxt = $OT[$p];
                            $OId2 = $OID[$p];

                            $newData2 = array(
                                    "Option_Text" => $OTxt,
                            );
                            $data->feedbackOption->updateRow_fo($OId2, $newData2);
                            $p++;
                        }

                        $Option_next = $Option_original + 1;

                        for ($Option_next; $Option_next <= $Options; $Option_next++) {
                            $p = $Option_next - 1;
                            $newData3 = array(
                                    "Option_Number" => $Option_next,
                                    "Option_Text" => $OT[$p],
                                    "Feedback_Question" => $Id,
                            );
                            $data->feedbackOption->addRow($newData3);
                        }
                    }

                    if ($Options < $Option_original) {
                        $p = 0;

                        while ($Options > $p) {
                            $OTxt = $OT[$p];
                            $OId2 = $OID[$p];

                            $newData2 = array(
                                    "Option_Text" => $OTxt,
                            );
                            $data->feedbackOption->updateRow_fo($OId2, $newData2);
                            $p++;
                        }

                        for ($Option_original; $Options < $Option_original; $Option_original--) {
                            $sql = "DELETE FROM response_option WHERE Feedback_Option IN (SELECT ID FROM feedback_option WHERE Feedback_Question = $Id) ";
                            $data->responseOpt->deleteRow_multiple($sql);


                            $sql = "DELETE FROM feedback_option WHERE Feedback_Question = $Id AND Option_Number = $Option_original";
                            $data->feedbackOption->deleteRow_multiple($sql);
                        }

                    }

                }
            }

            header("Location: index.php?page=feedback_question");
        }

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

    $row = $data->feedbackQuestion->getRow($_GET["id"]);

    $Id = $row["ID"];
    $QuesNo = $row["Question_Number"];
    $Qtxt = $row['Question_Text'];
    $Type = $row["Type"];
    $Qtype = $row['Question_Type'];
    $Sect = $row['Feedback_Section'];

    $Options = $data->feedbackOption->getRowCount_fo($Id);

    if ($Type == 1) {
        $row2 = $data->feedbackOption->getRowByMatch_fo("Feedback_Question", $Id);

        for ($i = 0; $i <= count($row2); $i++) {
            $OT[$i] = $row2[$i]["Option_Text"];
        }
    }


}

///HTML Start
///
?>

<!-- Back button -->
<div id='backButton' style='float: left;'>
    <form action='index.php' method='get'>
        <input type='hidden' name='page' value='feedback_question'/>
        <input type='submit' class='buttonStyle1' value='Go Back'/>
    </form>
</div>

<!-- Heading -->
<h1 align="center">Edit a Feedback Question</h1>
<!-- Form START -->
<form method='post' action='index.php?page=feedback_question&action=edit&id=<?= $_GET["id"] ?>'>
<table class='std_form'>
    <tr>
        <td>Section:</td>
        <td><select name="txtSect" class='selectStyle1'>
                <?PHP

                $data->feedbackSection->printDropDownOptions($Sect, "Section_Title");
                ?>
            </select></td>
        <td><span class='errorText'><?= $SectErr ?></span></td>
    </tr>
    <tr>
        <td colspan="2">
            <hr>
        </td>
    </tr>
    <tr>
        <td>Question Text:</td>
        <td><textarea name='txtQuestionText' class='textAreaStyle1' rows="4" cols="40"><?= $Qtxt ?></textarea></td>
        <td><span class='errorText'><?= $Q_TextErr ?></span></td>
    </tr>
    <tr>
        <td colspan="2">
            <hr>
        </td>
    </tr>
    <tr>
        <td>Type:</td>
        <td>
            <?PHP

            if ($Type == 1) {
                echo "<input name='radiobutton' type='radio' value='2' onclick='hideOption();'>Text Response Question<br/>
                                <input name='radiobutton' type='radio' value='1' onclick='showOption();' checked='checked'>Multiple Choice Question</td>";
            } else {
                echo "<input name='radiobutton' type='radio' value='2' onclick='hideOption();' checked='checked'>Text Response Question<br/>
                                <input name='radiobutton' type='radio' value='1' onclick='showOption();'>Multiple Choice Question</td>";
            }

            ?>
        <td><span class='errorText'></span></td>
    </tr>
    <tr>
        <td colspan="2">
            <hr>
        </td>
    </tr>
    <?PHP
    if ($Type == 1) {
        echo "<tr id='options' >";
    } else {
        echo "<tr id='options' style='display:none;'>";
    }
    ?>
    <td>Multiple Choice:</td>
    <td>
        <select name="txtOptionNo" id="OptionNo" class='selectStyle2' onchange="addChoice();">
            <?PHP
            for ($q = 2; $q <= 10; $q++) {
                if ($q == $Options) {
                    echo "<option value='$q' selected='selected'>$q</option>";
                } else {
                    echo "<option value='$q'>$q</option>";
                }
            }
            ?>
        </select> options&nbsp;
    </td>
    <td><span class='errorText'><?= $OpNoErr ?></span></td>
    </tr>
</table>
<div style="margin-left:85px">
    <?PHP
    if ($Type == 1) {
        echo "<table id='0' class='std_form' >";
    } else {
        echo "<table id='0' class='std_form' style='display:none;'>";
    }

    ?>
    <div class='std_form'>
        <tr id="1">
            <td>&nbsp; 1.&nbsp;</td>
            <td><input type='text' name='txtOptionText1' value='<?= $OT[0] ?>' size='50' class='textBoxStyle1'/></td>
            <td><span class='errorText'><?= $Op_TextErr1 ?></span></td>
        </tr>
        <tr id="2">
            <td>&nbsp; 2.&nbsp;</td>
            <td><input type='text' name='txtOptionText2' value='<?= $OT[1] ?>' size='50' class='textBoxStyle1'/></td>
            <td><span class='errorText'><?= $Op_TextErr2 ?></span></td>
        </tr>
        <?php
        if ($Options >= 3) {
            echo "<tr id='3'>";
        } else {
            echo "<tr id='3'  style='display:none;'>";
        }
        ?>
        <td>&nbsp; 3.&nbsp;</td>
        <td><input type='text' name='txtOptionText3' value='<?= $OT[2] ?>' size='50' class='textBoxStyle1'/></td>
        <td><span class='errorText'><?= $Op_TextErr3 ?></span></td>
        </tr>
        <?php
        if ($Options >= 4) {
            echo "<tr id='4'>";
        } else {
            echo "<tr id='4'  style='display:none;'>";
        }
        ?>
        <td>&nbsp; 4.&nbsp;</td>
        <td><input type='text' name='txtOptionText4' value='<?= $OT[3] ?>' size='50' class='textBoxStyle1'/></td>
        <td><span class='errorText'><?= $Op_TextErr4 ?></span></td>
        </tr>
        <?php
        if ($Options >= 5) {
            echo "<tr id='5'>";
        } else {
            echo "<tr id='5'  style='display:none;'>";
        }
        ?>
        <td>&nbsp; 5.&nbsp;</td>
        <td><input type='text' name='txtOptionText5' value='<?= $OT[4] ?>' size='50' class='textBoxStyle1'/></td>
        <td><span class='errorText'><?= $Op_TextErr5 ?></span></td>
        </tr>
        <?php
        if ($Options >= 6) {
            echo "<tr id='6'>";
        } else {
            echo "<tr id='6'  style='display:none;'>";
        }
        ?>
        <td>&nbsp; 6.&nbsp;</td>
        <td><input type='text' name='txtOptionText6' value='<?= $OT[5] ?>' size='50' class='textBoxStyle1'/></td>
        <td><span class='errorText'><?= $Op_TextErr6 ?></span></td>
        </tr>
        <?php
        if ($Options >= 7) {
            echo "<tr id='7'>";
        } else {
            echo "<tr id='7'  style='display:none;'>";
        }
        ?>
        <td>&nbsp; 7.&nbsp;</td>
        <td><input type='text' name='txtOptionText7' value='<?= $OT[6] ?>' size='50' class='textBoxStyle1'/></td>
        <td><span class='errorText'><?= $Op_TextErr7 ?></span></td>
        </tr>
        <?php
        if ($Options >= 8) {
            echo "<tr id='8'>";
        } else {
            echo "<tr id='8'  style='display:none;'>";
        }
        ?>
        <td>&nbsp; 8.&nbsp;</td>
        <td><input type='text' name='txtOptionText8' value='<?= $OT[7] ?>' size='50' class='textBoxStyle1'/></td>
        <td><span class='errorText'><?= $Op_TextErr8 ?></span></td>
        </tr>
        <?php
        if ($Options >= 9) {
            echo "<tr id='9'>";
        } else {
            echo "<tr id='9'  style='display:none;'>";
        }
        ?>
        <td>&nbsp; 9.&nbsp;</td>
        <td><input type='text' name='txtOptionText9' value='<?= $OT[8] ?>' size='50' class='textBoxStyle1'/></td>
        <td><span class='errorText'><?= $Op_TextErr9 ?></span></td>
        </tr>
        <?php
        if ($Options >= 10) {
            echo "<tr id='10'>";
        } else {
            echo "<tr id='10'  style='display:none;'>";
        }
        ?>
        <td>10.&nbsp;</td>
        <td><input type='text' name='txtOptionText10' value='<?= $OT[9] ?>' size='50' class='textBoxStyle1'/></td>
        <td><span class='errorText'><?= $Op_TextErr10 ?></span></td>
        </tr>
    </div>
    </table>
</div>
<script type="text/javascript">
    // Display a section for Multiple Choice
    function showOption() {
        document.getElementById('options').style.display = "";
        document.getElementById('0').style.display = "";
        document.getElementById('addOp').style.display = "";
    }
    // Hide a section for Multiple Choice
    function hideOption() {
        document.getElementById('options').style.display = "none";
        document.getElementById('0').style.display = "none";
        document.getElementById('addOp').style.display = "none";
    }

    // Add new text fields for Multiple Choice

    function addChoice() {
        //Set timeout to fix bug caused by calling the function from reset form button
        setTimeout(function () {
            var option = document.getElementById("OptionNo");
            var Op_no = option.options[option.selectedIndex].value;

            var ib;
            var jb;

            for (var i = 1; i <= Op_no; i++) {
                document.getElementById(i).style.display = "";
            }

            for (var j = 10; j > Op_no; j--) {
                document.getElementById(j).style.display = "none";
            }
        }, 100);
        return true;
    }

</script>


<table class='std_form'>


    <table class='std_form'>
        <tr>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td></td>
            <td colspan='2'><span style='float: right;'><input type='reset' value='Reset' name='clicked_reset'
                                                               class='buttonStyle1' onclick="addChoice();"/>
                <input type='submit' value='Submit' name='clicked_submit' class='buttonStyle1'/>
                </span></td>
        </tr>
    </table>


</form>

</div>