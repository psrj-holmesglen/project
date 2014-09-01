<?
// Import libraries.
require "PHP_DB/dbObject.php";
// Get a copy of the DAL object.
$data = new Data();

//Declare checking variables
$ConId = NULL;
$SecId = NULL;
$SesId = NULL;
$All = NULL;

////
//// Setup END
////
if (isset($_POST["conference_selected"]) || $_REQUEST["con"] == "conPost") {
    // Grab our data from the form.
    $ConId = $_POST["selConId"];
    $SecId = "";
    $SesId = "";
    //If selected All Conferences, set all Ids to NULL so that all Polling Questions will be displayed
    if ($_POST["selConId"] == "All") {
        $ConId = NULL;
        $SecId = NULL;
        $SesId = NULL;
    }
}
if (isset($_POST["section_selected"]) || $_REQUEST["sec"] == "secPost") {
    // Grab our data from the form.
    $ConId = $_POST["selConId"];
    $SecId = $_POST["selSecId"];
    $SesId = "";
}
if (isset($_POST["session_selected"]) || $_REQUEST["ses"] == "sesPost") {
    // Grab our data from the form.
    $ConId = $_POST["selConId"];
    $SecId = $_POST["selSecId"];
    $SesId = $_POST["selSesId"];
}
//If chosen not to display all polling questions at first view, comment out this code together with line 156
if ($ConId == NULL && $SecId == NULL && $SesId == NULL) {
    $All = true;
}
//Until here.

?>

<div id='report'>
    <link rel="stylesheet" type="text/css" href="CSS/std_data_table.css"/>

    <h1>Polling Question</h1>

    <form method='post' action='index.php?page=report&action=polling'>
        <table>
            <tr>
                <td class='label' align='left'>Select Conference:</td>
                <td align='left'>
                    <select name='selConId' class='selectStyle1' onchange='this.form.submit()'>
                        <option value="All">All Conferences</option>
                        <?php
                        $data->conference->printDropDownOptions($ConId, "Title");
                        ?>
                    </select>
                    <!-- Control if user has already selected conference before-->
                    <input type='hidden' name='con' value='conPost'>
                </td>
            </tr>
    </form>
    <form method='post' action='index.php?page=polling_question&action=view'>
        <tr>
            <td class='label' align='left'>Select Section:</td>
            <td align='left'>
                <select name='selSecId' class='selectStyle1' onchange='this.form.submit()'>
                    <option value='<?= $SecId ?>'>Select a section</option>
                    <?php
                    $data->section->printDropDownOptionsByMatch($SecId, "Conference", $ConId, "Section_Title");
                    ?>
                </select>
                <!-- Control if user has already selected section before-->
                <input type='hidden' name='sec' value='secPost'>
                <!-- Keep control of which conference user has already chosen-->
                <input type='hidden' name='selConId' value='<?= $ConId ?>'/>
            </td>
        </tr>
    </form>
    <form method='post' action='index.php?page=polling_question&action=view'>
        <tr>
            <td class='label' align='left'>Select Session:</td>
            <td align='left'>
                <select name='selSesId' class='selectStyle1' onchange='this.form.submit()'>
                    <option value='<?= $SesId ?>'>Select a session</option>
                    <?php
                    $data->session->printDropDownOptionsByMatch($SesId, "Conference_Section", $SecId, "Title");
                    ?>
                </select>
                <!-- Control if user has already selected session before-->
                <input type='hidden' name='ses' value='sesPost'>
                <!-- Keep control of which conference and section user has already chosen-->
                <input type='hidden' name='selConId' value='<?= $ConId ?>'/>
                <input type='hidden' name='selSecId' value='<?= $SecId ?>'/>
            </td>
        </tr>
        </table>
    </form>
    <?php
    //if the slection in the drop down list has no values within
    if ($data->pollingQuestion->getRowByMatch("Session", $SesId) || $SesId == "All" || $All){

    ?>
    <!--Add scroll bar to table -->
    <div class='scroll'>
        <table width='100%' border='1' cellpadding='5' cellspacing='0' class='stdDataTable'>
            <thead>
            <tr style='background-color:#999'>
                <td align='left' valign='middle'>Polling question</td>
                <td align='left' valign='middle'></td>
            </tr>
            </thead>
            <tbody>
            <?PHP
            //Get and display sessions from DB
            if ($SesId == "All") {
                //Create an array to hold all session Id's by searching Session table by Section Id
                $table = array();
                //$sesObj = $data->session->getRowBySecondId($SecId);
                $sesObj = $data->session->getRowByMatch("Conference_Section", $SecId);

                for ($i = 0; $i < count($sesObj); $i++) {
                    echo $sesObj["ID"];
                    $table .= $data->pollingQuestion->getRowByMatch("Session", $sesObj["ID"]);
                }
            } //If chosen not to display all polling questions at first view, comment out this code together with line 66
            else if ($SesId == NULL) {
                // Populate the table with all records
                $table = $data->pollingQuestion->getRow("all");
            } //Until here.
            else {
                $table = $data->pollingQuestion->getRowByMatch("Session", $SesId);
            }
            // TODO: alert no entries.
            foreach ($table as $row) {
                ?>
                <tr style='font-size:86%;'>
                    <td align='left' valign='middle'><?= $row["Polling_Question"] ?></td>
                    <td align='center' valign='middle'>
                        <a href='index.php?page=polling_question&action=edit&id=<?= $row["ID"] ?>'>Edit</a>
                        <a href='index.php?page=polling_question&action=delete&id=<?= $row["ID"] ?>'>Delete</a>
                        <a href='index.php?page=polling_question&action=availability&id=<?= $row["ID"] ?>'>Availability</a>
                        <a href='index.php?page=polling_question&action=result&id=<?= $row["ID"] ?>'>Display Result</a>
                    </td>
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

<img src="http://localhost/epworth/root/ASSETS/IMG/header.png" id="myimage" hidden="true" />
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

