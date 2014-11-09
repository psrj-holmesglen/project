<?
// Import libraries.
require "PHP_DB/dbObject.php";
//require "PHP_PRES/helpers/dateTimepicker.php";
// Get a copy of the DAL object.
$data = new Data();

$CoId = "All";
    ////
    //// Setup END
    ////
    // If submit has been clicked:
    if (isset($_POST['conference_selected']) || $_REQUEST["con"] == "ConPost") {

        // Grab our data from the form.
        $CoId = $_POST["selCoId"];
}

?>

<div id='report'>
    <link rel="stylesheet" type="text/css" href="CSS/std_data_table.css"/>

    <h1>Feedback Question</h1>
    <table>
        <tr>
            <td class='label'>Select Conference:</td>
            <td>
                <form method="post" action="index.php?page=report&action=question">
                    <select name='selCoId' class='selectStyle1' style="width:auto" onchange='this.form.submit()'>
                        <option value="All">All Conferences</option>
                        <?php
                        // Create selectbox for sorting by conference
                        $data->conference->printDropDownOptions($CoId, "Title");
                        ?>
                    </select>
            </td>
            <td>


                <input type='hidden' name='con' value='ConPost'>
                </form>
            </td>
        </tr>
    </table>
    <div class="scroll"> <!--Add scroll bar to table -->
        <table width="100%" border="1" cellpadding="5" cellspacing="0" class="stdDataTable">
            <thead>
            <tr style="background-color:#999" align="left" valign="middle">

                <td>ID</td>
                <td>Question Text</td>
                <td>Type</td>
                <td>Section</td>
            </tr>
            </thead>
            <tbody>
            <?PHP
            //Store Section Title before creating table
            $SecTitle = array();

            $table = $data->feedbackSection->getRow("all");
            foreach ($table as $row) {
                $SecTitle[] = $row["Section_Title"];
            }


            // Sort table by conference

            if ($CoId == "All")
                $table = $data->feedbackQuestion->getRow("all");

            else
                $table = $data->feedbackQuestion->getRowByMatch_fq("ID", $CoId);

            // TODO: alert no entries.
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
                    <td align="left" valign="middle">
                        <?php
                        //$sect = $row["Feedback_Section"];
                        //$row2 = $data->feedbackSection->getRow($sect);
                        $secid = $row["Feedback_Section"] - 1; //$row2["Section_Title"];
                        echo $SecTitle[$secid];
                        ?>
                    </td>
                </tr>
            <?PHP } ?>
            </tbody>
        </table>
    </div>

    <p align='right' style='font-size:75%'> <?PHP //echo get_Datetime_Now(); ?></p>
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

<script type="text/javascript" src="<?=SCRIPT_PATH?>jspdf/from-html.js"></script>
<script type="text/javascript" src="<?=SCRIPT_PATH?>jspdf/jspdf.debug.js"></script>
<script type="text/javascript" src="<?=SCRIPT_PATH?>jspdf/jspdf.min.js"></script>
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

