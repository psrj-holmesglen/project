<?php
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
       if (isset($_POST['conference_selected'])) {
   
           // Grab our data from the form.
           $CoId = $_POST["selCoId"];
       }
   ?>
<div id='report'>
   <h1>Sections</h1>
   <form method="post" action="index.php?page=report&action=section">
      <table>
         <tr>
            <td class='label'>Select Conference:</td>
            <td>
               <select name='selCoId' class='selectStyle1' style="width:auto">
                  <option value="All">All Conferences</option>
                  <?php
                     $data->conference->printDropDownOptions($CoId, "Title");
                     
                     
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
      //if data is found for the selected conference then the table will show
      if ($data->section->getRowByMatch("Conference", $CoId) || $CoId == "All")
      {
      
      ?>
   <div class="scroll">
      <!--Add scroll bar to table -->
      <table width="100%" border="1" cellpadding="5" cellspacing="0" class="stdDataTable">
         <thead>
            <tr style="background-color:#999" align="left" valign="middle">
               <td>Section Order</td>
               <td>Title</td>
            </tr>
         </thead>
         <tbody>
            <?PHP
               if ($CoId == "All")
                   $table = $data->section->getRow("all");
               
               else
                   $table = $data->section->getRowByMatch("Conference", $CoId);
               
               // TODO: alert no entries.
               foreach ($table as $row) {
                   ?>
            <tr style="font-size:86%;">
               <td align="left" valign="middle"><?= $row["Ordering"] ?></td>
               <td align="left" valign="middle"><?= $row["Section_Title"] ?></td>
            </tr>
            <?PHP
               }
               //if data is not found for the selected conference then a message will show
               } else
                   echo "No Records Found";
               
               ?>
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