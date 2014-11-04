<div id='conference_edit'>
<link rel='stylesheet' type='text/css' href='CSS/std_form.css'>
<?PHP
/*
 * File: edit.php
 * Edit Presenter for the dstc e conference web application.
 * Written by TEAM SPARTA
 * Last updated: 28-10-14 by Rudhra
*/

////
//// Setup START
////

// Import libraries.
require "PHP_PRES/helpers/dateTimePicker.php";
require "PHP_DB/dbObject.php";

$validated = false;
global $userid;

// Get a copy of the DAL object.
$data = new Data();

$TitlErr = null;
$DescErr = null;
$StarErr = null;
$EndTErr = null;
$OrgaErr = null;
$LocaErr = null;
$ContErr = null;
////
//// Setup END
////

// If submit has been clicked:
if (isset($_POST["clicked_submit"])) {

    ////
    //// Validation Checking START.
    ////
    require "PHP_VALIDATION/validation.php";

    // Grab our data from the form.
    $Titl = $_POST["txtTitl"];
    $Desc = $_POST["txaDesc"];
    $Orga = $_POST["txtOrga"];
    $Loca = $_POST["txtLoca"];
    $Cont = $_POST["txtCont"];
    $Venu = $_POST["selVenu"];
	$Febk = $_POST["selFbform"];
	//$CAdmi = $_POST["selCAdmi"];
	$Spon = $_POST['txtSponNo'];
	$ConAvail = $_POST['selConAvail'];
	
	if ($userid=='1'){
		$CAdmi = $_POST["selCAdmi"];
	}
	else if($userid != '1'){
		$CAdmi = $userid;
	}
		
		
	 //Store data of Sponsor
    for ($i = 0; $i < $Spon; $i++) {
        switch ($i) {
            case 0:
                $Sponsor1 = $_POST['txtSponsor1'];
                break;
            case 1:
                $Sponsor2 = $_POST['txtSponsor2'];
                break;
            case 2:
                $Sponsor3 = $_POST['txtSponsor3'];
                break;
            case 3:
                $Sponsor4 = $_POST['txtSponsor4'];
                break;
            case 4:
                $Sponsor5 = $_POST['txtSponsor5'];
                break;
        }
    }
		
	
    // Grab our datetime date and convert it into a mySQL dateTime
    $Star["year"] = $_POST["selStarYear"];
    $Star["month"] = $_POST["selStarMonth"];
    $Star["day"] = $_POST["selStarDay"];
    $Star["hour"] = $_POST["selStarHour"];
    $Star["minute"] = $_POST["selStarMinute"];
    $Star["second"] = "00";
    //$Star["string"] = dtConvertToString($Star);
	$StartDate = $Star["string"] = dtConvertToString($Star);

    $EndT["year"] = $_POST["selEndTYear"];
    $EndT["month"] = $_POST["selEndTMonth"];
    $EndT["day"] = $_POST["selEndTDay"];
    $EndT["hour"] = $_POST["selEndTHour"];
    $EndT["minute"] = $_POST["selEndTMinute"];
    $EndT["second"] = "00";
    //$EndT["string"] = dtConvertToString($EndT);
	$EndDate = $EndT["string"] = dtConvertToString($EndT);

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
    if (vIsBlank($Desc) || !vMaxChars($Desc, 400)) // not blank, max 400 chars.
        $DescErr = nv();

    // Validate Start date:
    if (vIsBlank($Star["string"]) || !vIsDate($Star)) // not blank, is sql datetime.
        $StarErr = nv();

    // Validate End date:
    if (vIsBlank($EndT["string"]) || !vIsDate($EndT)|| vIsValidDate($StartDate,$EndDate)) // not blank, is sql datetime.
        $EndTErr = nv();

    // Validate Organisation:
    if (vIsBlank($Orga) || !vMaxChars($Orga, 30)) // not blank, max 30 chars.
        $OrgaErr = nv();

    // Validate Location:
    if (vIsBlank($Loca) || !vMaxChars($Loca, 70)) // not blank, max 70 chars.
        $LocaErr = nv();

    // Validate Cont:
    if (vIsBlank($Cont) || !vMaxChars($Cont, 25)) // not blank, max 25 chars.
        $ContErr = nv();


	 for ($i = 0; $i < $Spon; $i++) {
        $count = 0;

        switch ($i) {
            case 0:
                $Sponsor = $Sponsor1;
                break;
            case 1:
                $Sponsor = $Sponsor2;
                break;
            case 2:
                $Sponsor = $Sponsor3;
                break;
            case 3:
                $Sponsor = $Sponsor4;
                break;
            case 4:
                $Sponsor = $Sponsor5;
                break;
        }

        for ($j = 0; $j < $Spon; $j++) {
            switch ($j) {
                case 0:
                    $SponTest = $Sponsor1;
                    break;
                case 1:
                    $SponTest = $Sponsor2;
                    break;
                case 2:
                    $SponTest = $Sponsor3;
                    break;
                case 3:
                     $SponTest = $Sponsor4;
                    break;
                case 4:
                     $SponTest = $Sponsor5;
                    break;
            }
            if ($Sponsor == $SponTest) {
				
                $count++;
            }

        }
        if ($count != 1) {
            $validated = false;
            $SponNoErr .= "Cannot assign same Sponsor";
            break;
        }
    }
	
    ////
    //// Validation Checking END.
    ////

    // Once the data has been validated, let's insert the data.
    if ($validated) {
	
        ////
        //// Database Write START
        ////
     echo   $newData = array(
                "Title" => $Titl,
                "Description" => $Desc,
                "Start_Time" => dtConvertToString($Star),
                "End_Time" => dtConvertToString($EndT),
                "Organiser" => $Orga,
                "Location" => $Loca,
                "Contact" => $Cont,
                "Venue" => $Venu,
				"Feedback" => $Febk,
				"Download_Avail" =>$ConAvail,
				"Conference_Admin_Id" => $CAdmi
        );

// if ($data->conference->updateRow($_GET["id"], $newData))

        //var_dump($newData);
      	if ($data->conference->updateRow($_GET["id"], $newData)){
		
		
		 $ConferenceId = $_GET["id"];

            if ($data->conferenceSponsor->deleteRow_cs($ConferenceId)) {
			
				if($Spon != 0){

                for ($i = 0; $i < $Spon; $i++) {
                    switch ($i) {
                        case 0:
                            $Sponsor = $Sponsor1;
                            break;
                        case 1:
                            $Sponsor = $Sponsor2;
                            break;
                        case 2:
                            $Sponsor = $Sponsor3;
                            break;
                        case 3:
                            $Sponsor = $Sponsor4;
                            break;
                        case 4:
                            $Sponsor = $Sponsor5;
                            break;
                    }

                    $newDataSponsor = array(
                            "Conference" => $ConferenceId,
                            "Sponsor" => $Sponsor,
                    );

                    $data->conferenceSponsor->addRow($newDataSponsor);
                }
			}
		
		
			}
		
		}
           header("Location: index.php?page=conference");
			
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

    $row = $data->conference->getRow($_GET["id"]);

    //$CoId = $row["ID"];
    $Titl = $row["Title"];
    $Desc = $row["Description"];
    $Star = dtConvertToArray($row["Start_Time"]);
    $EndT = dtConvertToArray($row["End_Time"]);
    $Orga = $row["Organiser"];
    $Loca = $row["Location"];
    $Cont = $row["Contact"];
    $Venu = $row["Venue"];
	$Febk = $row["Feedback"];
	$CAdmi = $row["Conference_Admin_Id"];
 
 	$Spon = $data->conferenceSponsor->getRowCount_cs($_GET["id"]);
    $row = $data->conferenceSponsor->getRowByMatch_cs($_GET["id"]);

    for ($i = 0; $i < $Spon; $i++) {
        switch ($i) {
            case 0:
                $Sponsor1 = $row[$i]["ID"];
                break;
            case 1:
                $Sposor2 = $row[$i]["ID"];
                break;
            case 2:
                $Sponsor3 = $row[$i]["ID"];
                break;
            case 3:
                $Sponsor4 = $row[$i]["ID"];
                break;
            case 4:
                $Sponsor5 = $row[$i]["ID"];
                break;
        }
    }
   
}
////
//// Database Read END
////

////
//// HTML Form START
////
?>

<!-- Back button -->
<div id='backButton' style='float: left;'>
    <form action='index.php' method='get'>
        <input type='hidden' name='page' value='conference'/>
        <input type='submit' class='buttonStyle1' value='Go Back'/>
    </form>
</div>

<!-- Heading -->
<h1 style='text-align:center'>Edit a Conference</h1>

<!-- Form START -->
<form method='post' action='index.php?page=conference&action=edit&id=<?= $_GET["id"] ?>'>
    <table class='std_form'>
        <tr>
            <td class='label'>Conference Title:</td>
            <td><input type='text' class='textBoxStyle1' name='txtTitl' value='<?= $Titl ?>'/></td>
            <td><span class='errorText'><?= $TitlErr ?></span></td>
        </tr>
        <tr>
            <td colspan="2">
                <hr>
            </td>
        </tr>
        <tr>
            <td class='label'>Description:</td>
            <td><textarea name='txaDesc' class='textAreaStyle1' rows='4' value=><?= $Desc ?></textarea></td>
            <td><span class='errorText'><?= $DescErr ?></span></td>
        </tr>
        <tr>
            <td colspan="2">
                <hr>
            </td>
        </tr>
        <tr>
            <td class='label'>Start Time:</td>
            <td>
                <table style="width:100%; margin:0px; border:0px; padding:0px;">
                    <tr>
                        <td>
                            <select name='selStarDay' class='selectStyle1Dt'>
                                <?= printOptionDays($Star["day"]) ?>
                            </select>
                        </td>
                        <td>
                            <select name='selStarMonth' class='selectStyle1Dt'>
                                <?= printOptionMonths($Star["month"]) ?>
                            </select>
                        </td>
                        <td>
                            <select name='selStarYear' class='selectStyle1Dt'>
                                <?= printOptionYears($Star["year"]) ?>
                            </select>
                        </td>
                        <td style='padding-left:20px;'>
                            <select name='selStarHour' class='selectStyle1Dt'>
                                <?= printOptionHours($Star["hour"]) ?>
                            </select>
                        </td>
                        <td>
                            <strong style='color:black'>:</strong>
                        </td>
                        <td>
                            <select name='selStarMinute' class='selectStyle1Dt'>
                                <?= printOptionMinutes($Star["minute"]) ?>
                            </select>
                        </td>
                    </tr>
                </table>
            </td>
            <td><span class='errorText'><?= $StarErr ?></span></td>
        </tr>

        <tr>
            <td colspan="2">
                <hr>
            </td>
        </tr>
        <tr>
            <td class='label'>End Time:</td>
            <td>
                <table style="width:100%; margin:0px; border:0px; padding:0px;">
                    <tr>
                        <td>
                            <select name='selEndTDay' class='selectStyle1Dt'>
                                <?= printOptionDays($EndT["day"]) ?>
                            </select>
                        </td>
                        <td>
                            <select name='selEndTMonth' class='selectStyle1Dt'>
                                <?= printOptionMonths($EndT["month"]) ?>
                            </select>
                        </td>
                        <td>
                            <select name='selEndTYear' class='selectStyle1Dt'>
                                <?= printOptionYears($EndT["year"]) ?>
                            </select>
                        </td>
                        <td style='padding-left:20px;'>
                            <select name='selEndTHour' class='selectStyle1Dt'>
                                <?= printOptionHours($EndT["hour"]) ?>
                            </select>
                        </td>
                        <td>
                            <strong style='color:black'>:</strong>
                        </td>
                        <td>
                            <select name='selEndTMinute' class='selectStyle1Dt'>
                                <?= printOptionMinutes($EndT["minute"]) ?>
                            </select>
                        </td>
                    </tr>
                </table>
            </td>
            <td><span class='errorText'><?= $EndTErr ?></span></td>
        </tr>
        <tr>
            <td colspan="2">
                <hr>
            </td>
        </tr>
        <tr>
            <td class='label'>Organiser:</td>
            <td><input type='text' class='textBoxStyle1' name='txtOrga' value='<?= $Orga ?>'/></td>
            <td><span class='errorText'><?= $OrgaErr ?></span></td>
        </tr>
        <tr>
            <td colspan="2">
                <hr>
            </td>
        </tr>
        <tr>
            <td class='label'>Location:</td>
            <td><input type='text' class='textBoxStyle1' name='txtLoca' value='<?= $Loca ?>'/></td>
            <td><span class='errorText'><?= $LocaErr ?></span></td>
        </tr>
        <tr>
            <td colspan='2'>
                <hr>
            </td>
        </tr>
        <tr>
            <td class='label'>Contact:</td>
            <td><input type='text' class='textBoxStyle1' name='txtCont' value='<?= $Cont ?>'/></td>
            <td><span class='errorText'><?= $ContErr ?></span></td>
        </tr>
         <?php if($accesslevel == "1") { ?>
        <tr>
            <td colspan='2'>
                <hr>
            </td>
        </tr>
         <tr>
                <td class='label'>Conference Administrator:</td>
                <td>
                    <select name='selCAdmi' class='selectStyle1'>
                        <?PHP
                        $data->user->printDropDownOptions($user, "User_name");
                        ?>
                    </select>
                </td>
            </tr>
            <?php } ?>
            <tr>
                <td colspan='2'>
                    <hr>
                </td>
            </tr>
        <tr>
            <td class='label'>Venue:</td>
            <td>
                <select name='selVenu' class='selectStyle1'>
                    <?PHP
                    $data->venue->printDropDownOptions($Venu, "Name");
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
                <td class='label'>Feedback Form:</td>
                <td>
                    <select name='selFbform' class='selectStyle1'>
                        <?PHP
                        $data->feedback->printDropDownOptions(NULL, "Feedback_Title");
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <hr>
                </td>
            </tr>
        <!-- Updated by Rudhra  -->
        <tr>
        <td class='label'>Availability:</td>
        <td><select name='selConAvail' id="selConAvail" class='selectStyle1'>
            	
                <?PHP echo "<option value='0'>Off</option>";
                      echo "<option value='1' selected='selected'>On</option> ";
                ?>
          </select></td>
      </tr>
        
        <!-- Edit Sponser -->
        <tr>
            <td class='label'>Sponsor:</td>
            <td>
                <select name="txtSponNo" id="SponsorNo" class='selectStyle2' onchange='editSpon();'>
                    <?PHP
                    // Create selectbox for number of option
                    for ($q = 0; $q <= 5; $q++) {
                        if ($q == $Spon) {
                            echo "<option value='$q' selected='selected'>$q</option>";
                        } else {
                            echo "<option value='$q'>$q</option>";
                        }
                    }
                    ?>
                </select> sponsor&nbsp;
            </td>
            <td><span class='errorText'><?= $SponNoErr ?></span></td>
        </tr>
    </table>


    <div style="margin-left:85px">
        <table id='0' class='std_form'>

            <div class='std_form'>
             <!--   <tr id="1">
                    <td align="right">&nbsp; 1.&nbsp;</td>
                    <td>
                        <select name='txtSponsor1' class='selectStyle1'>
                            <?PHP
                            $data->sponsor->printDropDownOptions($Sponsor1, "Name");
                            ?>
                        </select>
                    </td>
                    <td><span class='errorText'><?= $Op_TextErr1 ?></span></td>
                </tr>
                
                -->
                
                
                    <?php
                // Reflect user's input in Type
                if ($Spon >= 1) {
                    echo "<tr id='1'>";
                } else {
                    echo "<tr id='1'  style='display:none;'>";
                }
                ?>
                <td align="right">&nbsp; 1.&nbsp;</td>
                <td>
                    <select name='txtSponsor1' class='selectStyle1'>
                        <?PHP
                        $data->sponsor->printDropDownOptions($Sponsor1, "Name");
                        ?>
                    </select>
                </td>
                <td><span class='errorText'><?= $Op_TextErr1 ?></span></td>
                </tr>
                <?php
                // Reflect user's input in Type
                if ($Spon >= 2) {
                    echo "<tr id='2'>";
                } else {
                    echo "<tr id='2'  style='display:none;'>";
                }
                ?>
                <td align="right">&nbsp; 2.&nbsp;</td>
                <td>
                    <select name='txtSponsor2' class='selectStyle1'>
                        <?PHP
                        $data->sponsor->printDropDownOptions($Sponsor2, "Name");
                        ?>
                    </select>
                </td>
                <td><span class='errorText'><?= $Op_TextErr2 ?></span></td>
                </tr>
                <?php
                // Reflect user's input in Type
                if ($Spon >= 3) {
                    echo "<tr id='3'>";
                } else {
                    echo "<tr id='3'  style='display:none;'>";
                }
                ?>
                <td align="right">&nbsp; 3.&nbsp;</td>
                <td>
                    <select name='txtSponsor3' class='selectStyle1'>
                        <?PHP
                        $data->sponsor->printDropDownOptions($Sponsor3, "Name");
                        ?>
                    </select>
                </td>
                <td><span class='errorText'><?= $Op_TextErr3 ?></span></td>
                </tr>
                <?php
                // Reflect user's input in Type
                if ($Spon >= 4) {
                    echo "<tr id='4'>";
                } else {
                    echo "<tr id='4'  style='display:none;'>";
                }
                ?>
                <td align="right">&nbsp; 4.&nbsp;</td>
                <td>
                    <select name='txtSponsor4' class='selectStyle1'>
                        <?PHP
                        $data->sponsor->printDropDownOptions($Sponsor4, "Name");
                        ?>
                    </select>
                </td>
                <td><span class='errorText'><?= $Op_TextErr4 ?></span></td>
                </tr>
                <?php
                // Reflect user's input in Type
                if ($Spon >= 5) {
                    echo "<tr id='5'>";
                } else {
                    echo "<tr id='5'  style='display:none;'>";
                }
                ?>
                <td align="right">&nbsp; 5.&nbsp;</td>
                <td>
                    <select name='txtSponsor5' class='selectStyle1'>
                        <?PHP
                        $data->sponsor->printDropDownOptions($Sponsor5, "Name");
                        ?>
                    </select>
                </td>
                <td><span class='errorText'><?= $Op_TextErr5 ?></span></td>
                </tr>
                
<script type="text/javascript">

    // Add new text fields for Multiple Choice

    function editSpon() {
        //Set timeout to fix bug caused by calling the function from reset form button
        setTimeout(function () {
            var option = document.getElementById("SponsorNo");
            var Op_no = option.options[option.selectedIndex].value;


            for (var i = 1; i <= Op_no; i++) {
                document.getElementById(i).style.display = "";
            }

            for (var j = 5; j > Op_no; j--) {
                document.getElementById(j).style.display = "none";
            }
        }, 100);
        return true;
    }

</script>
            
        <tr>
            <td colspan='2'><span style='float: right;'>
                	<br/>
                    <input type='submit' value='Reset' name='clicked_reset' class="buttonStyle1"/>
                    <input type='submit' value='Submit' name='clicked_submit' class='buttonStyle1'/>
                    </span>
            </td>
        </tr>
    </table>

</form>
<!-- Form End -->
</div>