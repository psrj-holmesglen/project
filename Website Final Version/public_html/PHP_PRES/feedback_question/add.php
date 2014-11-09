<!--                                                            
 _____ _____ _____ _____    _____ _____ _____ _____ _____ _____ 
|_   _|   __|  _  |     |  |   __|  _  |  _  | __  |_   _|  _  |
  | | |   __|     | | | |  |__   |   __|     |    -| | | |     |
  |_| |_____|__|__|_|_|_|  |_____|__|  |__|__|__|__| |_| |__|__|
                                                                
 * File: add.php
 * Add Feedback Question for the dstc e conference web application.
 * Written by TEAM SPARTA 
 * Last updated: 01-04-14 by Shohei Masunaga

  -->


<div id='feedback_question_add'>
<link rel='stylesheet' type='text/css' href='CSS/std_form.css'>
<?PHP

////
//// Setup START
////

// Import libraries.
require "PHP_PRES/helpers/dateTimePicker.php";
require "PHP_DB/dbObject.php";

$validated = false;

// Get a copy of the DAL object.
$data = new Data();

////
//// Setup END
////


// If submit has been clicked:
if (isset($_POST['clicked_submit'])) {

    // Import libraries.
    require "PHP_VALIDATION/validation.php";

    //Get Question No from no of rows in database
    $row = $data->feedbackQuestion->getRow_MAX();

    // Grab our data from the form.
    $Qtxt = $_POST['txtQuestionText'];
    $Type = $_REQUEST["radiobutton"];
    $Qtype = $_POST['txtQtype'];
    $Sect = $_POST['txtSect'];


    //Get data when it's multiple choice
    if ($Type == 1) {
        // Get number of options
        $Options = $_POST['txtOptionNo'];

        // Set array for txtOptionText?
        $input = array();
        $ON = array_pad($input, $Options, 0);
        $input2 = array();
        $OT = array_pad($input2, $Options, 0);


        $s = 1;
        foreach ($ON as &$value) {
            if ($s <= $Options) {
                $value = $s;
            }
            $s++;
        }

        $s = 1;
        foreach ($OT as &$value) {
            if ($s <= $Options) {
                $value = $_POST['txtOptionText' . $s];
            }
            $s++;
        }


    }


    //A Boolean flag that determines validation success
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


    // Validate Multiple Choice when it's multiple choice
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

                //Insert error message
                if ($n == 0) {
                    $OpNoErr = "Error found in ";
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

}
// Once the data has been validated, let's insert the data.
if ($validated) {


    //$sql = "INSERT INTO e_Presenter (Presenter_Id, Title, First_Name, Last_Name, Organisation, Medical_Field, Position, Qualification, Short_Bio, Photo_Filepath)
    //		VALUES ('$PrId','$Titl','$FNam','$LNam','$Orga','$MedF','$Posi','$Qual', '$SBio', '$PFil')";

    ////
    //// Database Write START
    ////

    $newData = array(
            "Question_Text" => $Qtxt,
            "Type" => $Type,
            "Question_Type" => $Qtype,
            "Feedback_Section" => $Sect,
    );

    // Execute sql query to add new data
    $insert = $data->feedbackQuestion->addRow($newData);


    // Add new multiple choice when it's multiple choice
    if ($insert) {
        if ($Type == 1) {

            // Get ID of new feedback question
            $FQ_ID = $data->feedbackQuestion->getRowByMatch("Question_Text", $Qtxt);
            $IdFQ = $FQ_ID[0]["ID"];
            for ($i = 0; $i < $Options; $i++) {
                $OptionText = $OT[$i];
                $j = $i + 1;

                //Create array for Polling_Options table
                $newData2 = array(
                        "Option_Number" => $j,
                        "Option_Text" => $OptionText,
                        "Feedback_Question" => $IdFQ,
                );
                $data->feedbackOption->addRow($newData2);
            }
        }
        header('Location: index.php?page=feedback_question&action=view');

    }

    ////
    //// Database Write END
    ////
} else {
    ////
    //// HTML Form START
    ////


    // If invalid data, or no submission yet, lets display the form:
    ?>
    <!-- Back button -->
    <div id='backButton' style='float: left;'>
        <form action='index.php' method='get'>
            <input type='hidden' name='page' value='feedback_question'/>
            <input type='submit' class='buttonStyle1' value='Go Back'/>
        </form>
    </div>

    <!-- Heading -->
    <h1 align="center">Add a Feedback Question</h1>


    <!-- Form START -->
    <form method='post' action='index.php?page=feedback_question&action=add'>
    <table class='std_form'>
        <tr>
            <td>Section:</td>
            <td><select name="txtSect" class='selectStyle1'>
                    <?PHP
                    $data->feedbackSection->printDropDownOptions(NULL, "Section_Title");
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
                // Keep user's input for Type
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
        // Reflect user's input in Type
        if ($Type == 1) {
            echo "<tr id='options' >";
        } else {
            echo "<tr id='options' style='display:none;'>";
        }
        ?>
        <td>Multiple Choice:</td>
        <td>
            <select name="txtOptionNo" id="OptionNo" class='selectStyle2' onchange='addChoice();'>
                <?PHP
                // Create selectbox for number of option
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
        // Reflect user's input in Type
        if ($Type == 1) {
            echo "<table id='0' class='std_form' >";
        } else {
            echo "<table id='0' class='std_form' style='display:none;'>";
        }

        ?>
        <div class='std_form'>
            <tr id="1">
                <td>&nbsp; 1.&nbsp;</td>
                <td><input type='text' name='txtOptionText1' value='<?= $OT[0] ?>' size='50' class='textBoxStyle1'/>
                </td>
                <td><span class='errorText'><?= $Op_TextErr1 ?></span></td>
            </tr>
            <tr id="2">
                <td>&nbsp; 2.&nbsp;</td>
                <td><input type='text' name='txtOptionText2' value='<?= $OT[1] ?>' size='50' class='textBoxStyle1'/>
                </td>
                <td><span class='errorText'><?= $Op_TextErr2 ?></span></td>
            </tr>
            <?php
            // Reflect user's input in Type
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
            // Reflect user's input in Type
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
            // Reflect user's input in Type
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
            // Reflect user's input in Type
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
            // Reflect user's input in Type
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
            // Reflect user's input in Type
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
            // Reflect user's input in Type
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
            // Reflect user's input in Type
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
            return true;
        }

        // Hide a section for Multiple Choice
        function hideOption() {
            document.getElementById('options').style.display = "none";
            document.getElementById('0').style.display = "none";
            document.getElementById('addOp').style.display = "none";
            return true;
        }

        // Add new text fields for Multiple Choice

        function addChoice() {
            //Set timeout to fix bug caused by calling the function from reset form button
            setTimeout(function () {
                var option = document.getElementById("OptionNo");
                var Op_no = option.options[option.selectedIndex].value;


                for (var i = 1; i <= Op_no; i++) {
                    document.getElementById(i).style.display = "";
                }

                for (var j = 10; j > Op_no; j--) {
                    document.getElementById(j).style.display = "none";
                }
            }, 100);
            return true;
        }

        /*
         var no = 4;
         var no2 = 3;
         function add()
         {
         if(no<10)
         {
         var str = "<tr><td>&nbsp;"+no+".&nbsp;</td><td><input type='text' name='txtOptionText"+no+"' value='' size='50' class='textBoxStyle1' /></td><td><span class='errorText'></span></td></tr><div id="+ no +"  class='std_form'></div>";
         }
         else
         {

         var str = "<tr><td>"+no+".</td><td><input type='text' name='txtOptionText"+no+"' value='' size='50' class='textBoxStyle1' /></td><td><span class='errorText'></span></td></tr><div id="+ no +"></div>";
         }
         document.getElementById(no2).innerHTML = str;
         no++;
         no2++;

         }
         */

    </script>


    <table class='std_form'>
        <tr>
            <td colspan="2"><span style='float: right;'>
                                <br/>
                        <input type='submit' value='Reset' name='clicked_reset' class="buttonStyle1"
                               onclick="addChoice();hideOption();"/>
                        <input type='submit' value='Submit' name='clicked_submit' class="buttonStyle1"/></td>
        </tr>
    </table>
    </form>
<?PHP
}

////
//// HTML Form END
////


?>
</div>
