<!--                                                            
 _____ _____ _____ _____    _____ _____ _____ _____ _____ _____ 
|_   _|   __|  _  |     |  |   __|  _  |  _  | __  |_   _|  _  |
  | | |   __|     | | | |  |__   |   __|     |    -| | | |     |
  |_| |_____|__|__|_|_|_|  |_____|__|  |__|__|__|__| |_| |__|__|
                                                                
 * File: Edit.php
 * Edit Sessions for the dstc e conference web application.
 * Written by TEAM SPARTA 
 * Last updated: 18-03-14 by Thomas Budds

  -->
<div id='session_edit'>
<link rel='stylesheet' type='text/css' href='CSS/std_form.css'>
<?PHP


require "PHP_PRES/helpers/dateTimePicker.php";
require "PHP_DB/dbObject.php";
$validated = false;

$data = new Data();
$SesErr;
$TitErr;
$DescErr;
$StarErr;
$EndTErr;
$LocaErr;
$ChaiErr;
$FeedErr;

// If submit has been clicked:
if (isset($_POST['clicked_submit'])) {

    require "PHP_VALIDATION/validation.php";

    // Grab our data from the form.
    $SeId = $_POST["txtSeId"];
    $CSId = $_POST['txtCSId'];
    $Titl = $_POST['txtTitl'];
    $Desc = $_POST['txtDesc'];
    $Star = $_POST['txtStar'];
    $EndT = $_POST['txtEndT'];
    $Room = $_POST['txtRoom'];
    $Chair = $_POST['txtChai'];
	//$Feed = $_POST['txtFeed'];
    $FbFrm = $_POST['selFbform'];
    //$Last = $_POST['txtLast'];
	//$Poll = $_POST['txtPoll'];
	//$Open = $_POST['txtOpen'];
    $Pres = $_POST['txtPresNo'];
	
    //Store data of presenter
    for ($i = 0; $i < $Pres; $i++) {
        switch ($i) {
            case 0:
                $Presenter1 = $_POST['txtPresenter1'];
                break;
            case 1:
                $Presenter2 = $_POST['txtPresenter2'];
                break;
            case 2:
                $Presenter3 = $_POST['txtPresenter3'];
                break;
            case 3:
                $Presenter4 = $_POST['txtPresenter4'];
                break;
            case 4:
                $Presenter5 = $_POST['txtPresenter5'];
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

    // TODO: Validation code goes here.
    // TODO: Validation code goes here.
    // TODO: Validation code goes here.
	
	$validated = true;

    function nv()
    {
        global $validated;
        $validated = false;
        return vGetErr();
    }

	// Validate Start date:
    if (vIsBlank($Star["string"]) || !vIsDate($Star)) // not blank, is sql datetime.
        $StarErr = nv();

    // Validate End date:
    if (vIsBlank($EndT["string"]) || !vIsDate($EndT)|| vIsValidDate($StartDate,$EndDate)) // not blank, is sql datetime.
        $EndTErr = nv();
		
    // HACK: Assume validated for now.
    
    if (vIsBlank($Titl)) // not blank
        $TitErr = nv();
    if (vIsBlank($Desc)) // not blank
        $DescErr = nv();
    if (vIsBlank($Room)) // not blank
        $LocaErr = nv();

    for ($i = 0; $i < $Pres; $i++) {
        $count = 0;

        switch ($i) {
            case 0:
                $Presenter = $Presenter1;
                break;
            case 1:
                $Presenter = $Presenter2;
                break;
            case 2:
                $Presenter = $Presenter3;
                break;
            case 3:
                $Presenter = $Presenter4;
                break;
            case 4:
                $Presenter = $Presenter5;
                break;
        }

        for ($j = 0; $j < $Pres; $j++) {
            switch ($j) {
                case 0:
                    $PresTest = $Presenter1;
                    break;
                case 1:
                    $PresTest = $Presenter2;
                    break;
                case 2:
                    $PresTest = $Presenter3;
                    break;
                case 3:
                    $PresTest = $Presenter4;
                    break;
                case 4:
                    $PresTest = $Presenter5;
                    break;
            }
            if ($Presenter == $PresTest) {
                $count++;
            }

        }
        if ($count != 1) {
            $validated = false;
            $PresNoErr .= "Cannot assign same presenters";
            break;
        }
    }


    // Once the data has been validated, let's insert the data.
    if ($validated) {

        $lastUpdatedInfo = 'now()';

        $newData = array(
                "Title" => $Titl,
                "Description" => $Desc,
                "Start_Time" => dtConvertToString($Star),
                "End_Time" => dtConvertToString($EndT),
                "Room_Location" => $Room,
                "Session_Chairperson" => $Chair,
				//"Polling_Available"         => $biPoll,
				//"Polling_Open"              => $biOpen,
                "Conference_Section" => $CSId,
				//"Feedback"                  => $Feed,
				//"Feedback_Section"			=> $Sect,
				"Feedback"=> $FbFrm,
        );

        /*if ($Sect != "NULL") {
            $newData['Feedback_Section'] = $Sect;
        }
		*/
        //var_dump($newData);

        if ($data->session->updateRow($_GET["id"], $newData)) {

            $SesId = $_GET["id"];

            if ($data->sessionPresenter->deleteRow_sp($SesId)) {


                for ($i = 0; $i < $Pres; $i++) {
                    switch ($i) {
                        case 0:
                            $Presenter = $Presenter1;
                            break;
                        case 1:
                            $Presenter = $Presenter2;
                            break;
                        case 2:
                            $Presenter = $Presenter3;
                            break;
                        case 3:
                            $Presenter = $Presenter4;
                            break;
                        case 4:
                            $Presenter = $Presenter5;
                            break;
                    }

                    $newDataPresenter = array(
                            "Presenter" => $Presenter,
                            "Session" => $SesId,
                    );

                    $data->sessionPresenter->addRow($newDataPresenter);
                }

                header("Location: index.php?page=session");
            }
        }
    }
} else {
    $row = $data->session->getRow($_GET["id"]);

    $Titl = $row["Title"];
    $Desc = $row["Description"];
    $Star = dtConvertToArray($row["Start_Time"]);
    $EndT = dtConvertToArray($row["End_Time"]);
    $Room = $row["Room_Location"];
    $Chair = $row["Session_Chairperson"];
    $feed = $row["Feedback"];
    $feedSect = $row["Feedback_Section"];
    $Sect = $row["Feedback_Section"];
    $Poll = $row["Polling_Available"];
    $Open = $row["Polling_Open"];

    $Pres = $data->sessionPresenter->getRowCount_sp($_GET["id"]);
    $row = $data->sessionPresenter->getRowByMatch_sp($_GET["id"]);

    for ($i = 0; $i < $Pres; $i++) {
        switch ($i) {
            case 0:
                $Presenter1 = $row[$i]["ID"];
                break;
            case 1:
                $Presenter2 = $row[$i]["ID"];
                break;
            case 2:
                $Presenter3 = $row[$i]["ID"];
                break;
            case 3:
                $Presenter4 = $row[$i]["ID"];
                break;
            case 4:
                $Presenter5 = $row[$i]["ID"];
                break;
        }
    }
    if ($Pres == 0)
        $Pres = 1;

}
?>

<div id='backButton' style='float: left;'>
    <form action='index.php' method='get'>
        <input type='hidden' name='page' value='session'/>
        <input type='submit' class='buttonStyle1' value='Go Back'/>
    </form>
</div>

<h1 style='text-align:center'>Edit a Session</h1>

<form method='post' action='index.php?page=session&action=edit&id=<?= $_GET["id"] ?>'>
<table class='std_form'>

<tr>
    <td class='label'>Conference Section ID:</td>
    <td><select name='txtCSId' class='selectStyle1'>

            <?PHP
            $data->section->printDropDownOptions($CSId, "ID", "Section_Title");
            ?>


        </select></td>
</tr>

<tr>
    <td colspan="2">
        <hr>
    </td>
</tr>


<tr>
    <td class='label'>Title/Topic:</td>
    <td><textarea type='text' class='textAreaStyle1' cols='30' rows='2' name='txtTitl'><?= $Titl ?></textarea></td>
    <td><span class='errorText'><?= $TitErr ?></span></td>
</tr>
<tr>
    <td colspan="2">
        <hr>
    </td>
</tr>
<tr>
    <td class='label'>Description:</td>
    <td><textarea type='text' class='textAreaStyle1' cols='30' rows='8' name='txtDesc'><?= $Desc ?></textarea></td>
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
    <td class='label'>Room Location:</td>
    <td><input type='text' class='textBoxStyle1' name='txtRoom' value='<?= $Room ?>'/></td>
    <td><span class='errorText'><?= $LocaErr ?></span></td>
</tr>
<tr>
    <td colspan="2">
        <hr>
    </td>
</tr>

<tr>
    <td class='label'>Chairperson:</td>
    <td><input type='text' class='textBoxStyle1' name='txtChai' value='<?= $Chair ?>'/></td>
    <td><span class='errorText'><?= $ChaiErr ?></span></td>
</tr>

      <tr> <td colspan="2"> <hr> </td> </tr>
      <tr>
    <td class='label'>Feedback Form:</td>
        <td><select name='selFbform' class='selectStyle1'>
            <?PHP
                        $data->feedback->printDropDownOptions(NULL, "Feedback_Title");
                        ?>
          </select></td>
</tr>

<tr>
    <td colspan="2">
        <hr>
    </td>
</tr>

<tr>
    <td class='label'>Presenter:</td>
    <td>
        <select name="txtPresNo" id="PresenterNo" class='selectStyle2' onchange='addPres();'>
            <?PHP
            // Create selectbox for number of option
            for ($q = 1; $q <= 5; $q++) {
                if ($q == $Pres) {
                    echo "<option value='$q' selected='selected'>$q</option>";
                } else {
                    echo "<option value='$q'>$q</option>";
                }
            }
            ?>
        </select> presenters&nbsp;
    </td>
    <td><span class='errorText'><?= $PresNoErr ?></span></td>
</tr>
</table>


<div style="margin-left:85px">
    <table id='0' class='std_form'>

        <div class='std_form'>
            <tr id="1">
                <td>&nbsp; 1.&nbsp;</td>
                <td>
                    <select name='txtPresenter1' class='selectStyle1'>
                        <?PHP
                        $data->presenter->printDropDownOptions($Presenter1, "First_Name", "Last_Name");
                        ?>
                    </select>
                </td>
                <td><span class='errorText'><?= $Op_TextErr1 ?></span></td>
            </tr>
            <?php
            // Reflect user's input in Type
            if ($Pres >= 2) {
                echo "<tr id='2'>";
            } else {
                echo "<tr id='2'  style='display:none;'>";
            }
            ?>
            <td>&nbsp; 2.&nbsp;</td>
            <td>
                <select name='txtPresenter2' class='selectStyle1'>
                    <?PHP
                    $data->presenter->printDropDownOptions($Presenter2, "First_Name", "Last_Name");
                    ?>
                </select>
            </td>
            <td><span class='errorText'><?= $Op_TextErr2 ?></span></td>
            </tr>
            <?php
            // Reflect user's input in Type
            if ($Pres >= 3) {
                echo "<tr id='3'>";
            } else {
                echo "<tr id='3'  style='display:none;'>";
            }
            ?>
            <td>&nbsp; 3.&nbsp;</td>
            <td>
                <select name='txtPresenter3' class='selectStyle1'>
                    <?PHP
                    $data->presenter->printDropDownOptions($Presenter3, "First_Name", "Last_Name");
                    ?>
                </select>
            </td>
            <td><span class='errorText'><?= $Op_TextErr3 ?></span></td>
            </tr>
            <?php
            // Reflect user's input in Type
            if ($Pres >= 4) {
                echo "<tr id='4'>";
            } else {
                echo "<tr id='4'  style='display:none;'>";
            }
            ?>
            <td>&nbsp; 4.&nbsp;</td>
            <td>
                <select name='txtPresenter4' class='selectStyle1'>
                    <?PHP
                    $data->presenter->printDropDownOptions($Presenter4, "First_Name", "Last_Name");
                    ?>
                </select>
            </td>
            <td><span class='errorText'><?= $Op_TextErr4 ?></span></td>
            </tr>
            <?php
            // Reflect user's input in Type
            if ($Pres >= 5) {
                echo "<tr id='5'>";
            } else {
                echo "<tr id='5'  style='display:none;'>";
            }
            ?>
            <td>&nbsp; 5.&nbsp;</td>
            <td>
                <select name='txtPresenter5' class='selectStyle1'>
                    <?PHP
                    $data->presenter->printDropDownOptions($Presenter5, "First_Name", "Last_Name");
                    ?>
                </select>
            </td>
            <td><span class='errorText'><?= $Op_TextErr5 ?></span></td>
            </tr>
        </div>
    </table>

</div>
    <table class='std_form'>

        <tr>
            <td colspan='2'><span style='float: right;'>
                	<br/>
                	<input type='submit' value='Reset' name='clicked_reset' class="buttonStyle1" onclick="addPres();"/>
                    <input type='submit' value='Submit' name='clicked_submit' class='buttonStyle1'/>
                    </span>
            </td>
        </tr>
    </table>
</form>
</div>

<script type="text/javascript">

    // Add new text fields for Multiple Choice

    function addPres() {
        //Set timeout to fix bug caused by calling the function from reset form button
        setTimeout(function () {
            var option = document.getElementById("PresenterNo");
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



   <!-- Previous team code - rudhra
               <tr>
                <td class='label'>Feedback Id:</td>
                <td>
                    <select name='txtFeed'  class='selectStyle1'>
                <?PHP
//$data->feedback->printDropDownOptions($Feed, "ID", "Feedback_Title");
?>
                	</select>
                </td>
            </tr>

-->
<!--            <tr> <td colspan="2"> <hr> </td> </tr>-->
<!--            -->
<!--            <tr><td class='label'>Feedback Id:</td>-->
<!--            <td><select name='txtFeed' class='selectStyle1'>-->
<!--     -->
<!--            --><?PHP
//                $data->feedback->printDropDownOptions($Feed, "ID", "Feedback_Title");
//
?>
<!--        -->
<!--            -->
<!--                </select></td>-->
<!--                </tr>-->

<!--<tr>
    <td colspan="2">
        <hr>
    </td>
</tr>-->



<!--   //Previous team code
         <tr>-->
<!--            	<td class='label'>Polling Available:</td>-->
<!--                <td>-->
<!--                	<select name="txtPoll"   class='selectStyle1'>-->
<!--                			<option value='Yes'-->
<?php //if($Poll==1) echo " selected=\"selected\" "; ?><!--Yes</option>-->
<!--							<option value='No'-->
<?php //if($Poll==0) echo " selected=\"selected\" "; ?><!--No</option>-->
<!--                    </select>-->
<!--                </td>  	-->
<!--            </tr>-->
<!--            <tr> <td colspan="2"> <hr> </td> </tr>-->
<!--           <tr>-->
<!--            	<td class='label'>Polling Open:</td>-->
<!--                <td>-->
<!--                	<select name="txtOpen"  class='selectStyle1'>-->
<!--                			<option value='Yes'-->
<?php //if($Open==1) echo " selected=\"selected\" "; ?><!--Yes</option>-->
<!--							<option value='No'-->
<?php //if($Open==0) echo " selected=\"selected\" "; ?><!--No</option>-->
<!--                    </select>-->
<!--                </td>-->
<!--                -->
<!--            	-->
<!--            </tr>-->
<!--            <tr> <td colspan="2"> <hr> </td> </tr>-->


<!-- Add Presenter -->



