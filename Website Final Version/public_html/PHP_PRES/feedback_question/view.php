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
    // * Written by TEAM SPARTA
    // * Last updated: 01-04-14 by Shohei Masuanga -->


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
  <form id="rdoForm" method="post" action="index.php?page=feedback_question&action=view">
    <h1>Feedback Question</h1>
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

                <td>ID</td>
                <td>Question Text</td>
                <td>Type</td>
             <!--   <td>Section</td>   -->
                <td>Action</td>
            </tr>
            </thead>
            <tbody>
              <?PHP
			  if($IsSessionSelected  )
			  {
				  //echo $SesId;
				 $table = $data->sessionQuestion->getRowByMatch_sq($SesId);
	
			  }
			  else
			  {
				   $table = $data->feedbackQuestion->getRowByMatch_fq('ID',$CoId);	 
				   
			  }
			  // if ($table= $data->feedback->getRowByMatch_fb_conference("conference", $CoId) || $CoId == "All") {
            // TODO: alert no entries.
			if ($table == null) echo "<tr><td colspan='9'><strong><em>No Entries Found.</em></strong></td></tr>";
			
            foreach ($table as $row) {
                ?>
              <tr style="font-size:86%;">

                    <td align="left" valign="middle"><?= $row["ID"] ?></td>
                    <td align="left" valign="middle"><?= $row["Question_Text"] ?></td>
                    <td align="left" valign="middle"><?php if ($row["Type"] == 1) {
                            echo "Multiple Choice";
                        } else {
                            echo "Text Response";
                        } ?></td>
<!--                    <td align="left" valign="middle">
                        <?php
                        //$sect = $row["Feedback_Section"];
                        //$row2 = $data->feedbackSection->getRow($sect);
                        $secid = $row["Feedback_Section"] - 1; //$row2["Section_Title"];
                        echo $SecTitle[$secid];
                        ?>
                    </td> -->
                    <td align="center" valign="middle">
                        <a href='index.php?page=feedback_question&action=edit&id=<?= $row["ID"] ?>'>Edit</a>
                        <a href='index.php?page=feedback_question&action=delete&id=<?= $row["ID"] ?>'>Delete</a>
                    </td>
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
    <span style="text-align:right;"><form method="get" action="index.php">
            <input type="submit" value="Add FQ" class="buttonStyle1"/>
            <input type="hidden" name="page" value="feedback_question"/>
            <input type="hidden" name="action" value="add"/>
        </form></span>
 </div><!-- End of displaying feedback Question -->


