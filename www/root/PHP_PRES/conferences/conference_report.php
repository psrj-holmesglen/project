<?php
// Import libraries.
require "PHP_DB/dbObject.php";
require "PHP_PRES/helpers/dateTimepicker.php";
//var_dump(require("PHP_DB/dbObject.php"));
// Get a copy of the DAL object.
$data = new Data();
//echo "data" . var_dump($data);
?>

<div id='report'>
	
    <h1>Report</h1>

    <div class="scroll">
        <table width='100%' border='1' cellpadding='5' cellspacing='0' class='stdDataTable'>
        	<colgroup>
            <col width="10%">
            <col width="20%">
            <col width="10%">
            <col width="10%">
            <col width="10%">
            <col width="10%">
            <col width="10%">
            <col width="10%">
            <col width="10%">
	        </colgroup>
            <thead>
            <tr style=''>
                <th align='left' valign='middle'>Title</th>
                <th align='left' valign='middle'>Description</th>
                <th align='left' valign='middle'>Start Time</th>
                <th align='left' valign='middle'>End Time</th>
                <th align='left' valign='middle'>Organiser</th>
                <th align='left' valign='middle'>Location</th>
                <th align='left' valign='middle'>Venue</th>
                <th align='left' valign='middle'>Token</th>
                <th align='left' valign='middle'>Contact</th>
            </tr>
            </thead>
            <tbody>
            <?PHP
            $table = $data->conference->getRowWithVenueName(null);
			
            if ($table == null) echo "<tr><td colspan='9'><strong><em>No Entries Found.</em></strong></td></tr>";
            foreach ($table as $row) {
                ?>
                <tr style="font-size:86%;">
                    <td align='left' valign='middle'><?= $row["Title"] ?></td>
                    <td align='left' valign='middle'><?= $row["Description"] ?></td>
                    <td align='left' valign='middle'><?= $row["Start_Time"] ?></td>
                    <td align='left' valign='middle'><?= $row["End_Time"] ?></td>
                    <td align='left' valign='middle'><?= $row["Organiser"] ?></td>
                    <td align='left' valign='middle'><?= $row["Location"] ?></td>
                    <td align='left' valign='middle'><?= $row["Name"] ?></td>
                    <td align='left' valign='middle'><?= $row["Token"] ?></td>
                    <td align='left' valign='middle'><?= $row["Contact"] ?></td>
                </tr>
            <?PHP
            }
            ?>
            </tbody>
        </table>
    </div>
    <br/>

    <p align='right' style='font-size:75%'> <?PHP echo get_Datetime_Now(); ?></p>
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

<script type="text/javascript" src="http://localhost/root/SCRIPTS_THIRD_PARTY/jspdf/from-html.js"></script>
<script type="text/javascript" src="http://localhost/root/SCRIPTS_THIRD_PARTY/jspdf/jspdf.debug.js"></script>
<script type="text/javascript" src="http://localhost/root/SCRIPTS_THIRD_PARTY/jspdf/jspdf.min.js"></script>
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
	
	var margins = {
      top: 70,
      bottom: 20,
      left: 10,
      width: 600
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

