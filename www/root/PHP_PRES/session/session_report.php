<?php

// Import libraries.
require "PHP_DB/dbObject.php";
// Get a copy of the DAL object.
$data = new Data();

$CSId = "All";

////
//// Setup END
////
if (isset($_POST['conference_selected'])) {
    // Grab our data from the form.
    $CSId = $_POST["selCSId"];
}

?>

<div id='report'>
    <link rel="stylesheet" type="text/css" href="CSS/std_data_table.css"/>

    <h1>Sessions</h1>
    <form method="post" action="index.php?page=report&action=session">
        <table>
            <tr>
                <td class='label'>Select Section:</td>
                <td>
                    <select name='selCSId' class='selectStyle1' style="width:auto">
                        <option value="All">All Sections</option>
                        <?php
                        $data->section->printDropDownOptions($CSId, "Section_Title");
                        ?>
                    </select>
                </td>
                <td>

                    <input type="submit" name="conference_selected" value="Filter" class="buttonStyle1"/>
                </td>
            </tr>
        </table>
    </form>
    <?php
    //if the slection in the drop down list has no values within
    if ($data->session->getRowByMatch("Conference_Section", $CSId) || $CSId == "All"){

    ?>

    <div class="scroll"> <!--Add scroll bar to table -->
        <table width="100%" border="1" cellpadding="5" cellspacing="0" class="stdDataTable">
            <thead>
            <tr style="background-color:#999" align="left" valign="middle">

                <td>Title</td>
                <td>Description</td>
                <td>Start</td>
                <td>Finish</td>
                <td>Location</td>
                <td>Session Chairperson</td>
            </tr>
            </thead>
            <tbody>
            <?PHP
            //Get and display sessions from DB
            if ($CSId == "All")
                $table = $data->session->getRow("all");
            else
                $table = $data->session->getRowByMatch("Conference_Section", $CSId);
            // TODO: alert no entries.
            foreach ($table as $row) {


                ?>
                <tr align="left" valign="middle" style="font-size:86%;">
                    <td><?= $row["Title"] ?></td>
                    <td><?= $row["Description"] ?></td>
                    <td><?= $row["Start_Time"] ?></td>
                    <td><?= $row["End_Time"] ?></td>
                    <td><?= $row["Room_Location"] ?></td>
                    <td><?= $row["Session_Chairperson"] ?></td>
                </tr>
            <?PHP
            }
            } else {
                echo "No Records Found";
            }
            ?>
            </tbody>
        </table>
    </div>
    <br/>

    <p align='right' style='font-size:75%'> <?PHP echo "Returned: " . date("Y-m-d H:i:s"); ?></p>
    <br/>
    
    <!-- Add save pdf buttons -->
    <table width="100%">
        <tr>
            <td>
				<input type='button' value='Generate PDF' class="buttonStyle1" onclick="savePdf();"/>
            </td>
        </tr>
    </table>
</div>

<img src="<?=IMG_PATH?>header.png" id="myimage" hidden="true" />
<canvas width="590" height="50" id="mycanvas" style="display: none;"></canvas>

<script type="text/javascript" src="SCRIPTS_THIRD_PARTY/jspdf/from-html.js"></script>
<script type="text/javascript" src="SCRIPTS_THIRD_PARTY/jspdf/jspdf.debug.js"></script>
<script type="text/javascript" src="SCRIPTS_THIRD_PARTY/jspdf/jspdf.min.js"></script>
<script>

function savePdf() {
	//Add manually the image to the pdf document
	var myImage = document.getElementById('myimage');
	var myCanvas = document.getElementById('mycanvas');

	var ctx = myCanvas.getContext('2d');
	ctx.drawImage(myImage, 0, 0);
	var mydataURL = myCanvas.toDataURL('image/jpg');

	//Create pdf object 
	var pdf = new jsPDF('p', 'pt', 'letter')
		, source = $('#report')[0]
		, specialElementHandlers = {
			'#bypassme': function(element, renderer){
							return true
						}
	}
	
	margins = {
      top: 70,
      bottom: 20,
      left: 10,
      width: 400
    };
	
	
	//alert(width);
	
	pdf.addImage(mydataURL, 'JPEG',10,10,590,50);
	
    pdf.fromHTML(
    	source // HTML string or DOM elem ref.
    	, margins.left // x coord
    	, margins.top // y coord
    	, {
	    		'width': margins.width // max width of content on PDF
    			,'elementHandlers': specialElementHandlers
    	},
    	
    	function (dispose) {
          	pdf.save('Report.pdf');
        },
        
    	margins
    )
}
</script>

