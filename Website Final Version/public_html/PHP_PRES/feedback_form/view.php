<div class="section_view">
  <link rel="stylesheet" type="text/css" href="CSS/std_data_table.css"/>
  <?php
// _____ _____ _____ _____    _____ _____ _____ _____ _____ _____ 
//|_   _|   __|  _  |     |  |   __|  _  |  _  | __  |_   _|  _  |
//  | | |   __|     | | | |  |__   |   __|     |    -| | | |     |
//  |_| |_____|__|__|_|_|_|  |_____|__|  |__|__|__|__| |_| |__|__|
//                                                                
// * File: View.php
// * View Feedback Question for the dstc e conference web application.
// * Written by JPRS SQUAD
// * Last updated: 21-09-14 by Rudhra -->


////
//// Setup START
////

  // Import libraries.
    require "PHP_DB/dbObject.php";
	require "PHP_PRES/helpers/dateTimePicker.php";

    // Get a copy of the DAL object.
    $data = new Data();
	
	
  
$CoId = "All";
$SesId = "All";

$IsConferenceSelected = true;
$IsSessionSelected = false;

//$SecId = "All";


////
//// Setup END
////
// If submit has been clicked:


if (isset($_POST['radiobutton']) && $_POST['radiobutton'] == '1')
{
	
	$CoId = $_POST["selCoId"];
	// $table = $data->feedback->getRowByMatch_fb_conference($CoId);
	$IsConferenceSelected = true;
	$IsSessionSelected = false;

}

if (isset($_POST['radiobutton']) && $_POST['radiobutton'] == '2')
{
	
    $SesId = $_POST["selSesId"];
	
	$IsConferenceSelected = false;
	$IsSessionSelected = true;
}
if (isset($_POST['radConf']) ) {

    // Grab our data from the form.

    $CoId = $_POST["selCoId"];

	$IsConferenceSelected = true;
	$IsSessionSelected = false;
}

if (isset($_POST['radSess']) ) {

    // Grab our data from the form.

    $SesId = $_POST["selSesId"];

	$IsConferenceSelected = false;
	$IsSessionSelected = true;
}


if ($CoId == "All" && $SesId == "All") {
    $Method = 0;
}
else {
    $Method = $_REQUEST["radiobutton"];
}

?>
  <script type="text/javascript">
    function Conference() {
        //document.getElementById('conf').style.display = "";
        //document.getElementById('sess').style.display = "none";
		//var type = document.getElementById('radConf').value;
		<?php
		$_REQUEST["con"] = "ConPost";
		$_REQUEST["ses"] = "";
		?>
		document.forms["rdoForm"].submit();
		
    }

    function Session() {
       // document.getElementById('sess').style.display = "";
        //document.getElementById('conf').style.display = "none";
		<?php
		$_REQUEST["con"] = "";
		$_REQUEST["ses"] = "SesPost";
		?>
		document.forms["rdoForm"].submit();
    }

</script>
  <form id="rdoForm" method="post" action="index.php?page=feedback_form&action=view">
    <h1>Feedback Form</h1>
    <br/>
    <div>
      <table>
        <tr>
          <td>Select Method:</td>
          <td>&nbsp;</td>
          <td><input name='radiobutton' type='radio' value='1' id="radConf" onclick='Conference();'  <?php if($IsConferenceSelected)  echo ' checked="checked"';?> >
            Conference-Feedback<br/>
            <input name='radiobutton' type='radio' value='2' id="radSess" onclick='Session();' <?php if($IsSessionSelected)  echo ' checked="checked"';?>>
            Session-Feedback </td>
        </tr>
        <table>
          <tr id="conf"  <?php if($IsConferenceSelected)  {echo ' style="display:block"' ;}
	else {echo ' style="display:none"' ;} 	?> >
            <td class='label'>Select Conference:</td>
            <td>&nbsp;</td>
            <td><select name='selCoId' class='selectStyle1' onchange='this.form.submit()'>
                <option value="All">All Conferences</option>
                <?php
                    // Create selectbox for sorting by conference
                    $data->conference->printDropDownOptions($CoId, "Title");
                    ?>
              </select></td>
            <td><input type='hidden' name='con' value='ConPost'></td>
          </tr>
          <tr id="sess"  <?php if($IsSessionSelected)  {echo ' style="display:block"' ;} 
	else {echo ' style="display:none"' ;}	?> >
            <td class='label'>Select Session:</td>
            <td>&nbsp;</td>
            <td><select name='selSesId' class='selectStyle1' onchange='this.form.submit()'>
                <option value="All">All Sessions</option>
                <?php
                    // Create selectbox for sorting by conference
                    $data->session->printDropDownOptions_session($SesId, "Title");
                    ?>
              </select></td>
            <td><input type='hidden' name='ses' value='SesPost'></td>
          </tr>
        </table>
        <br/>
        <div class="scroll"> <!--Add scroll bar to table -->
          <table width="100%" border="1" cellpadding="5" cellspacing="0" class="stdDataTable">
            <thead>
              <tr style="background-color:#999" align="left" valign="middle">
                <td>Title</td>
                <td>Description</td>
                <td>Actions</td>
              </tr>
            </thead>
            <tbody>
              <?PHP  //Display feedback forms
			  if($IsSessionSelected  )
			  {
				  //echo $SesId;
				  $table = $data->feedback->getRowByMatch_fb_session($SesId);

			  }
			  else
			  {
				   $table = $data->feedback->getRowByMatch_fb_conference($CoId);	 
				   
			  }
			// TODO: alert no entries.
			if ($table == null) echo "<tr><td colspan='9'><strong><em>No Entries Found.</em></strong></td></tr>";
			
            foreach ($table as $row) {
                ?>
              <tr style="font-size:86%;"> 
                <!--<td align="left" valign="middle"><?= $row["ID"] ?></td>-->
                <td align="left" valign="middle"><?= $row["Feedback_Title"]?></td>
                <td align="left" valign="middle"><?= $row["Feedback_Desc"] ?></td>
                <td align="center" valign="middle"><a href='index.php?page=feedback_form&action=edit_fb&id=<?= $row["ID"] ?>'>Edit</a> <a href='index.php?page=feedback_form&action=delete_fb&id=<?= $row["ID"] ?>'>Delete</a></td>
              </tr>
              <?PHP
			}
			 //  }
			 
            ?>
            </tbody>
          </table>
        </div>
      </table>
    </div>
  </form>
  <p align="right" style="font-size:75%"> <?PHP echo "Returned: " . get_Datetime_Now() ?></p>
  <br/>
  <span style="text-align:right;">
  <form method="get" action="index.php">
    <input type="submit" value="Add Feedback" class="buttonStyle1"/>
    <input type="hidden" name="page" value="feedback_form"/>
    <input type="hidden" name="action" value="add_fb"/>
  </form>
  </span> </div><!-- End of displaying feedback forms -->


<!-- Start of displaying feedback Sections -->  
<form>
  <div> <br/>
    <h2> Feedback Sections</h2>
    <table width="100%" border="1" cellpadding="5" cellspacing="0" class="stdDataTable">
      <thead>
        <tr style="background-color:#999" align="left" valign="middle">
          <td>Title</td>
          <td>Description</td>
          <td>Type</td>
          <td>Actions</td>
        </tr>
      </thead>
      <tbody>
        <?PHP	//Display feedback sections
			  if($IsSessionSelected  )
			  {
				$table = $data->feedbackSection->getRowbyMatch("ID", $SesId);
			  }
			  else
			  {
				  $table = $data->feedback->getRowbyMatch("ID", $CoId);
			  }
			 // TODO: alert no entries.
			if ($table == null) echo "<tr><td colspan='9'><strong><em>No Entries Found.</em></strong></td></tr>";
			
            foreach ($table as $row) {
                ?>
        <tr style="font-size:86%;"> 
          <!--<td align="left" valign="middle"><?= $row["ID"] ?></td>-->
          <td align="left" valign="middle"><?= $row["Section_Title"]?></td>
          <td align="left" valign="middle"><?= $row["Section_Desc"] ?></td>
          <td align="left" valign="middle"><?= $row["Type"] ?></td>
          <td align="center" valign="middle"><a href='index.php?page=feedback_form&action=edit_s&id=<?= $row["ID"] ?>'>Edit</a> <a href='index.php?page=feedback_form&action=delete_s&id=<?= $row["ID"] ?>'>Delete</a></td>
        </tr>
        <?PHP
			}
			 //  }
            ?>
      </tbody>
    </table>
  </div>
</form>
<p align="right" style="font-size:75%"> <?PHP echo "Returned: " . get_Datetime_Now() ?></p>
<br/>
    <span style="text-align:right;"><form method="get" action="index.php">
            <input type="submit" value="Add Section" class="buttonStyle1"/>
            <input type="hidden" name="page" value="feedback_form"/>
            <input type="hidden" name="action" value="add_s"/>
        </form></span>

</div>
