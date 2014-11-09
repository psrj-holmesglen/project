<?
// Import libraries.
require "PHP_DB/dbObject.php";
//require "PHP_PRES/helpers/dateTimepicker.php";
// Get a copy of the DAL object.
$data = new Data();

$CoId = "All";
$SesId = "All";
$SecId = "All";
////
//// Setup END
////
// If submit has been clicked:
if (isset($_POST['conference_selected']) || $_REQUEST["con"] == "ConPost") {

    // Grab our data from the form.

    $CoId = $_POST["selCoId"];
}

if (isset($_POST['session_selected']) || $_REQUEST["ses"] == "SesPost") {

    // Grab our data from the form.

    $SesId = $_POST["selSesId"];


}

if (isset($_POST['section_selected']) || $_REQUEST["sec"] == "SecPost") {

    // Grab our data from the form.

    $SecId = $_POST["selSecId"];
}

if ($CoId == "All" && $SesId == "All") {
    $Method = 0;
} else {
    $Method = $_REQUEST["radiobutton"];
}
?>

<script type="text/javascript">
    function Conference() {
        document.getElementById('conf').style.display = "";
        document.getElementById('sect').style.display = "";
        document.getElementById('sess').style.display = "none";
    }

    function Session() {
        document.getElementById('sess').style.display = "";
        document.getElementById('sect').style.display = "";
        document.getElementById('conf').style.display = "none";
    }

</script>
    <h1>Feedback Form</h1>
    <link rel="stylesheet" type="text/css" href="CSS/std_data_table.css"/>
<table>
    <tr>
        <td>Select Method:</td>
        <td colspan="2">
            <input name='radiobutton' type='radio' value='1' onclick='Conference();' checked="checked">Conference-Feedback<br/>
            <input name='radiobutton' type='radio' value='2' onclick='Session();'>Session-Feedback.
        </td>
    </tr>
    <tr id="conf">
        <td class='label'>Select Conference:</td>
        <td>
            <form method="post" action="index.php?page=report&action=feedback">
                <select name='selCoId' class='selectStyle1' onchange='this.form.submit()'>
                    <option value="All">All Conferences</option>
                    <?php
                    // Create selectbox for sorting by conference

                    $data->conference->printDropDownOptions($CoId, "Title");
                    ?>

                </select>
        </td>
        <td>


            <input type='hidden' name='con' value='ConPost'></form>
        </td>
    </tr>
    <tr id="sess" style="display:none">
        <td class='label'>Select Session:</td>
        <td>
            <form method="post" action="index.php?page=report&action=feedback">
                <select name='selSesId' class='selectStyle1' onchange='this.form.submit()'>
                    <option value="All">All Sessions</option>
                    <?php
                    // Create selectbox for sorting by conference

                    $data->session->printDropDownOptions($SesId, "Title");
                    ?>

                </select>
        </td>
        <td>


            <input type='hidden' name='ses' value='SesPost'></form>
        </td>
    </tr>
    <tr id="sect">
        <td class='label'>Select Section:</td>
        <td>
            <form method="post" action="index.php?page=report&action=feedback">
                <select name='selSecId' class='selectStyle1' onchange='this.form.submit()'>
                    <option value="All">All Sections</option>
                    <?PHP
                    // Create selectbox for section 
                    if ($CoId != "All" || $SesId != "All") {
                        if ($CoId != "All") {
                            $Stmt = "SELECT ID, Section_Title FROM feedback_section WHERE Feedback IN (SELECT Feedback FROM conference WHERE ID = '$CoId') ORDER BY ID";
                        }
                        if ($SesId != "All") {
                            $Stmt = "SELECT ID, Section_Title FROM feedback_section WHERE Feedback IN (SELECT Feedback FROM session WHERE ID = $SesId) ORDER BY ID";
                        }
                        $data->feedback->printDropDownOptions_fb($Stmt);
                    } else {
                        $data->feedbackSection->printDropDownOptions(NULL, "Section_Title");
                    }
                    ?>

                </select>
        </td>
        <td>


            <input type='hidden' name='sec' value='SecPost'></form>
        </td>
    </tr>
    <tr>
        <td colspan="3">
            <hr>
        </td>
    </tr>
</table>

<div id='report'>
<h2>Section</h2>

<div class="scroll">
    <table width="100%" border="1" cellpadding="5" cellspacing="0" class="stdDataTable">
        <thead>
        <tr style="background-color:#999" align="left" valign="middle">
            <td>ID</td>
            <td>Section Title</td>
            <td>Section Description</td>
            <td>Type</td>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($CoId != "All" || $SesId != "All" || $SecId != "All") {

            if ($SecId != "All") {
                $table = $data->feedbackSection->getRowbyMatch("ID", $SecId);
            } else {
                if ($CoId != "All")
                    $table = $data->feedbackSection->getRowByMatch_fb("feedback_section", "conference", "Feedback", "Feedback", $CoId);
                if ($SesId != "All")
                    $table = $data->feedbackSection->getRowByMatch_fb("feedback_section", "session", "Feedback", "Feedback", $SesId);

            }
        } else {
            $table = $data->feedbackSection->getRow();
        }


        foreach ($table as $row) {
            ?>
            <tr style="font-size:86%;">
                <td><?= $row["ID"] ?></td>
                <td><?= $row["Section_Title"] ?></td>
                <td><?= $row["Section_Desc"] ?></td>
                <td><?= $row["Type"] ?></td>
            </tr>
        <?php }; ?>
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

