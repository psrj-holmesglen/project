<div id='polling_question_edit'>
   <link rel='stylesheet' type='text/css' href='CSS/std_form.css'>
   <?PHP
      /*                                                            
       _____ _____ _____ _____    _____ _____ _____ _____ _____ _____ 
      |_   _|   __|  _  |     |  |   __|  _  |  _  | __  |_   _|  _  |
        | | |   __|     | | | |  |__   |   __|     |    -| | | |     |
        |_| |_____|__|__|_|_|_|  |_____|__|  |__|__|__|__| |_| |__|__|
      																
       * File: edit.php
       * Edit Polling Questions for the dstc e polling_question web application.
       * Written by TEAM SPARTA 
       * Last updated: 24-04-14 by Caue
      */
      
      ////
      //// Setup START 
      ////
      
      //Sets the timeout limit to 3000 to make sure that it will run even if it takes too long to process
        	ini_set("max_execution_time", 3000);
      
      // Import libraries.
      require "PHP_DB/dbObject.php";
      
      //Declare checking variables
      $validated = false;
      $subClicked = false;
      
      // Get a copy of the DAL object.
      $data = new Data();
      
      ////
      //// Setup END
      ////
      
      //Managing Dropdown box for session by choosing conference  and section
      if(isset($_POST["conference_selected"])||$_REQUEST["con"]=="conPost") {   
            // Grab our data from the form.     
                $ConId = $_POST["selConId"];    
                $SecId = "";   
                $Session = "";
      	//If selected All Conferences, set all Ids to NULL so that all Polling Questions will be displayed
      	if ($_POST["selConId"] == "All"){
      		$ConId = NULL;    
      		$SecId = NULL;   
      		$Session = NULL;
      	}
            }
      if(isset($_POST["section_selected"])||$_REQUEST["sec"]=="secPost") {   
      	// Grab our data from the form.  
      	$ConId = $_POST["selConId"];    
      	$SecId = $_POST["selSecId"];   
      	$Session = "";
            }
            if(isset($_POST["session_selected"])||$_REQUEST["ses"]=="sesPost") {   
      	// Grab our data from the form.  
      	$ConId = $_POST["selConId"];    
      	$SecId = $_POST["selSecId"];   
      	$Session = $_POST["selectSession"];
            }
      //If chosen not to display all polling questions at first view, comment out this code together with line 156
      if($ConId==NULL&&$SecId==NULL&&$Session==NULL) {
      	$All = true;  
            }
      //Until here.
      
      
      // If submit has been clicked:
      if(isset($_POST["clicked_submit"])) {
      	
      	////
      	//// Validation Checking START.
      	////
      	require "PHP_VALIDATION/validation.php";
      	
      	// Grab our data from the form.
      	$Ques = $_POST['txtQuestion'];
      	$Session = $_POST['selectSession'];
      	
      	// Get number of options
      		$Options = $_POST['txtOptionNo'];
      		
      		// Set array for txtOptionText?
      		$input = array();
      		$OT = array_pad($input, $Options, 0);
      			
      		$s = 1;
      		
      		//assigns the value of the options text boxes to each option
      		foreach ($OT as &$value)
      		{
      			if($s<=$Options)
      			{
      		  		$value = $_POST['txtOptionText'.$s];
      			}
      		    $s++;
      		}
      	// A bool flag that determines validation success.
      	$validated = true;
      	
      	function nv() { global $validated; $validated = false; return vGetErr(); }
      
      
      	// Validate Question Text:
                if(vIsBlank($Ques) || !vMaxChars($Ques, 200) )   // not blank, max 200 chars.
                    $Q_TextErr = nv();
      		
      	
      	// Validate Multiple Choice options
      		$n = 0;
      		for($k = 0; $k<$Options; $k++)
      		{
      			if(vIsBlank($OT[$k]) || !vMaxChars($OT[$k], 100) )
      			{
      				switch($k)
      				{
      					case 0: $Op_TextErr1 = nv();
      					break;
      					case 1: $Op_TextErr2 = nv();
      					break;
      					case 2: $Op_TextErr3 = nv();
      					break;
      					case 3: $Op_TextErr4 = nv();
      					break;
      					case 4: $Op_TextErr5 = nv();
      					break;
      					case 5: $Op_TextErr6 = nv();
      					break;
      					case 6: $Op_TextErr7 = nv();
      					break;
      					case 7: $Op_TextErr8 = nv();
      					break;
      					case 8: $Op_TextErr9 = nv();
      					break;
      					case 9: $Op_TextErr10 = nv();
      					break;
      				}
      				
      				//Insert error message
      				if($n==0)
      				{ 
      					$OpNoErr = "Error found in ";
      					$n++; 
      				}
      				$m = $k+1;
      				$OpNoErr .= strval($m)." ";
      			}
      		}
      
      	////
      	//// Validation Checking END.
      	////
      	
      	// Once the data has been validated, let's insert the data.
      	if($validated) { 
      	
      		////
      		//// Database Write START
      		////
      		
      		//Create array with values to update in Polling Questions table
      		$newData = array(
      			"Polling_Question"	=> $Ques,
      			"session"		 	=> $Session,
      
      		);
      		
      		// Execute sql query to add new data to the Polling questions
      		$insert = $data->pollingQuestion->updateRow($_GET["id"], $newData);
      		//echo $newData["Polling_Question"]." ".$newData["session"];
      		
      		// Update multiple choice Polling options
                    if($insert)
      		{	
      			//Retrieve an array of options that belong to the specific question and assign it to variable $row3
      			$row3 = $data->pollingOption->getRowByMatch("Polling", $_GET["id"]);
      			
      			//If user doesn't change the number of options for this question, just update the values in each option
      			if (count($row3) == $Options)
      			{
      				for ($j=0;$j<count($row3);$j++)
      				{
      					//Assign the value of the option to the variable $OptionText
      					$OptionText = $OT[$j];
      							
      					//Create array for Polling_Options table
      					$newData2 = array(
      					"Option_Text"	=> $OptionText,
      					"polling"	 	=> $_GET["id"],
      					);
      					//Run the query to update the database
      					$data->pollingOption->updateRow($row3[$j]["ID"],$newData2);
      				}
      				//redirect user to Polling view page
      				header('Location: index.php?page=polling_question');
      			}
      			//If user adds options to this question
      			
      			else if (count($row3) < $Options)
      			{
      				//Update everything that has been kept
      				for ($j=0;$j<count($row3);$j++)
      				{
      					$OptionText = $OT[$j];
      							
      					//Create array for Polling_Options table
      					$newData2 = array(
      					"Option_Text"	=> $OptionText,
      					"polling"	 	=> $_GET["id"],
      					);
      					//Run the query to update the database
      					$data->pollingOption->updateRow($row3[$j]["ID"],$newData2);
      				}
      				//Add whatever is new
      				for ($j=count($row3);$j<=$Options;$j++)
      				{
      					$OptionText = $OT[$j];
      							
      					//Create array for Polling_Options table
      					$newData2 = array(
      					"Option_Text"	=> $OptionText,
      					"polling"	 	=> $_GET["id"],
      					);
      					//Run the query to add new options to the database
      					$data->pollingOption->addRow($newData2);
      				}
      				//redirect user to Polling view page
      			
      				header("Location: index.php?page=polling_question");
      			}
      			//If user deletes options from this question
      			else
      			{
      				$subClicked = true;
      				//Update everything that has been kept
      				for ($j=0;$j<$Options;$j++)
      				{
      					$OptionText = $OT[$j];
      							
      					//Create array for Polling_Options table
      					$newData2 = array(
      					"Option_Text"	=> $OptionText,
      					"polling"	 	=> $_GET["id"],
      					);
      					//Run the query to update the database
      					$data->pollingOption->updateRow($row3[$j]["ID"],$newData2);
      				}
      				//Delete whatever has been discarded
      				for ($j=$Options;$j<=count($row3);$j++)
      				{
      					$OptionText = $OT[$j];
      							
      					//Create array for Polling_Options table
      					$newData2 = array(
      					"Option_Text"	=> $OptionText,
      					"polling"	 	=> $_GET["id"],
      					);
      					//Run the query to delete unwanted options from the database
      					$data->pollingOption->deleteRow($row3[$j]["ID"]);
      				}
      				//redirect user to Polling view page
      				header("Location: index.php?page=polling_question");
      			}
      		}
      		////
      		//// Database Write END
      		////
      	}
      } 
      else { 
      	// First page view:
      	// Lets load the data from the DB.
      
      	////
      	//// Database Read START
      	////
      	
      	//Assign first values to the Question fields
      	$row = $data->pollingQuestion->getRow($_GET["id"]);
      	$Id = $row["ID"];
      	$Ques = $row["Polling_Question"];
      	$Session = $row["Session"];
      	
      	//Retrieves all options available for this specific question in the database
      	$row2 = $data->pollingOption->getRowByMatch("polling", $Id);
      	
      	$Options = count($row2);
      	
      	//Assigns them to each option text field
      	for ($i=0;$i<=count($row2);$i++)
      	{
      		$OT[$i] = $row2[$i]["Option_Text"];
      	}
      	
      }
      ////
      //// Database Read END
      ////
      
      ////
      //// HTML Form START
      ////
      
      ?>
   <!--Script to show loading message when click Submit button while the queries are being processed -->
   <script type='text/javascript'>
      function showLoading() {
          document.getElementById('load').style.display='';
          return true;
      }
   </script>
   <!--Style of loading window -->
   <style type='text/css'>
      #load{
      position:absolute;
      z-index:1;
      border-color: #034C75;
      border-style: solid;
      border-width: 5px;
      border-radius: 5px;
      box-shadow: 7px 7px 6px 0px rgba(50, 50, 50, 0.58);
      background:#FFF;
      width:300px;
      height:200px;
      margin-top:-100px;
      margin-left:-150px;
      top:50%;
      left:50%;
      text-align:center;
      font-size: 120%;
      line-height:80px;
      }
   </style>
   <!--Div tag that contains the body of the loading window -->
   <div id='load' style='display:none;'>
      <p>Updating data. Please wait.</p>
      <img src='ASSETS/TMPIMG/working.gif'>
   </div>
   <!-- Back button -->
   <div id='backButton' style='float: left;'>
      <form action='index.php' method='get'> 
         <input type='hidden' name='page' value='polling_question' />
         <input type='submit' class='buttonStyle1' value='Go Back' />
      </form>
   </div>
   <!-- Heading -->
   <h1 style='text-align:center'>Edit a Polling Question</h1>
   <!-- Form START -->
   <form method='post' action='index.php?page=polling_question&action=edit&id=<?=$_GET["id"]?>' onsubmit="showLoading();">
      <table class='std_form'>
   <form method='post' action='index.php?page=polling_question&action=edit&id=<?=$_GET["id"]?>' onsubmit='showLoading();'>
   <tr>
   <td>Select Conference:</td>
   <td>
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
   <form method='post' action='index.php?page=polling_question&action=edit&id=<?=$_GET["id"]?>' onsubmit='showLoading();'>
   <tr>
   <td>Select Section:</td>
   <td>
   <select name='selSecId' class='selectStyle1' onchange='this.form.submit()'>
   <option value='<?=$SecId?>'>Select a section</option>
   <?php 
      $data->section->printDropDownOptionsByMatch($SecId, "Conference", $ConId, "Section_Title");
      ?>           
   </select>
   <!-- Control if user has already selected section before-->
   <input type='hidden' name='sec' value='secPost'>
   <!-- Keep control of which conference user has already chosen-->
   <input type='hidden' name='selConId' value='<?=$ConId?>' />
   </td>
   </tr>
   </form>
   <form method='post' action='index.php?page=polling_question&action=edit&id=<?=$_GET["id"]?>' onsubmit="showLoading();">
   <tr>
   <td>Link to Session:</td>
   <td><select name='selectSession' id='selectSession' size='1' class='selectStyle1'>
   <option value='<?=$Session?>'>
   <?php
      $rowSes = $data->session->getRow($Session);
      echo $Session." ".$rowSes["Title"];
      ?>
   </option>
   <?php 
      // Create selectbox for sorting by conference
      
                           $data->session->printDropDownOptionsByMatch($Session, "Conference_Section", $SecId, "Title");
      		?>
   </select>
   </td>
   </tr>
   <tr><td colspan='2'> <hr> </td> </tr>
   <tr>
   <td>Question Text:</td>
   <td><textarea name='txtQuestion' class='textAreaStyle1'  rows='4' cols='40'><?=$Ques?></textarea></td>
   <td><span class='errorText'><?=$Q_TextErr?></span></td>
   </tr>
   <tr> 
   <td colspan="2"> <hr> </td> </tr>
   <td>Multiple Choice:</td>
   <td>
   <select name='txtOptionNo' id='OptionNo' class='selectStyle2' onchange='refreshOptions();'>
   <?PHP
      if($subClicked=true) {
      	// Create selectbox for number of option
      	for($q=2; $q<=10; $q++)	{
      		if($q == $Options){
      			echo "<option value='$q' selected='selected'>$q</option>";
      		}
      		else {
      			echo "<option value='$q'>$q</option>";
      		}
      	}
      }
      else {
      	// Create selectbox for number of option
      	for($q=2; $q<=10; $q++){
      		if($q == count($row2)){
      			echo "<option value='$q' selected='selected'>$q</option>";
      		}
      		else{
      			echo "<option value='$q'>$q</option>";
      		}
      	}
      }
      ?>
   </select> options&nbsp;
   </td>
   <td><span class='errorText'><?=$OpNoErr?></span></td>
   </tr>
   </table>
   <div style='margin-left:85px'>
   <table id='0' class='std_form' >
   <div class='std_form'>
   <tr id='1'>
   <td>&nbsp; 1.&nbsp;</td>
   <td><input type='text' name='txtOptionText1' value='<?=$OT[0]?>' size='50' class='textBoxStyle1' /></td>
   <td><span class='errorText'><?=$Op_TextErr1?></span></td>
   </tr>
   <tr id="2">
   <td>&nbsp; 2.&nbsp;</td>
   <td><input type='text' name='txtOptionText2' value='<?=$OT[1]?>' size='50' class='textBoxStyle1' /></td>
   <td><span class='errorText'><?=$Op_TextErr2?></span></td>
   </tr>
   <?php
      // Reflect user's input in Type
      		if($Options>=3)
      		{
      			echo "<tr id='3'>";
      		}
      		else
      		{
      			echo "<tr id='3'  style='display:none;'>";
      		}
      	?>
   <td>&nbsp; 3.&nbsp;</td>
   <td><input type='text' name='txtOptionText3' value='<?=$OT[2]?>' size='50' class='textBoxStyle1' /></td>
   <td><span class='errorText'><?=$Op_TextErr3?></span></td>
   </tr>
   <?php
      // Reflect user's input in Type
      		if($Options>=4)
      		{
      			echo "<tr id='4'>";
      		}
      		else
      		{
      			echo "<tr id='4'  style='display:none;'>";
      		}
      	?>
   <td>&nbsp; 4.&nbsp;</td>
   <td><input type='text' name='txtOptionText4' value='<?=$OT[3]?>' size='50' class='textBoxStyle1' /></td>
   <td><span class='errorText'><?=$Op_TextErr4?></span></td>
   </tr>
   <?php
      // Reflect user's input in Type
      		if($Options>=5)
      		{
      			echo "<tr id='5'>";
      		}
      		else
      		{
      			echo "<tr id='5'  style='display:none;'>";
      		}
      	?>
   <td>&nbsp; 5.&nbsp;</td>
   <td><input type='text' name='txtOptionText5' value='<?=$OT[4]?>' size='50' class='textBoxStyle1' /></td>
   <td><span class='errorText'><?=$Op_TextErr5?></span></td>
   </tr>
   <?php
      // Reflect user's input in Type
      		if($Options>=6)
      		{
      			echo "<tr id='6'>";
      		}
      		else
      		{
      			echo "<tr id='6'  style='display:none;'>";
      		}
      	?>
   <td>&nbsp; 6.&nbsp;</td>
   <td><input type='text' name='txtOptionText6' value='<?=$OT[5]?>' size='50' class='textBoxStyle1' /></td>
   <td><span class='errorText'><?=$Op_TextErr6?></span></td>
   </tr>
   <?php
      // Reflect user's input in Type
      		if($Options>=7)
      		{
      			echo "<tr id='7'>";
      		}
      		else
      		{
      			echo "<tr id='7'  style='display:none;'>";
      		}
      	?>
   <td>&nbsp; 7.&nbsp;</td>
   <td><input type='text' name='txtOptionText7' value='<?=$OT[6]?>' size='50' class='textBoxStyle1' /></td>
   <td><span class='errorText'><?=$Op_TextErr7?></span></td>
   </tr>
   <?php
      // Reflect user's input in Type
      		if($Options>=8)
      		{
      			echo "<tr id='8'>";
      		}
      		else
      		{
      			echo "<tr id='8'  style='display:none;'>";
      		}
      	?>
   <td>&nbsp; 8.&nbsp;</td>
   <td><input type='text' name='txtOptionText8' value='<?=$OT[7]?>' size='50' class='textBoxStyle1' /></td>
   <td><span class='errorText'><?=$Op_TextErr8?></span></td>
   </tr>
   <?php
      // Reflect user's input in Type
      		if($Options>=9)
      		{
      			echo "<tr id='9'>";
      		}
      		else
      		{
      			echo "<tr id='9'  style='display:none;'>";
      		}
      	?>
   <td>&nbsp; 9.&nbsp;</td>
   <td><input type='text' name='txtOptionText9' value='<?=$OT[8]?>' size='50' class='textBoxStyle1' /></td>
   <td><span class='errorText'><?=$Op_TextErr9?></span></td>
   </tr>
   <?php
      // Reflect user's input in Type
      		if($Options>=10)
      		{
      			echo "<tr id='10'>";
      		}
      		else
      		{
      			echo "<tr id='10'  style='display:none;'>";
      		}
      	?>
   <td>10.&nbsp;</td>
   <td><input type='text' name='txtOptionText10' value='<?=$OT[9]?>' size='50' class='textBoxStyle1' /></td>
   <td><span class='errorText'><?=$Op_TextErr10?></span></td>
   </tr>
   </div>
   </table>
   </div>
   <script type='text/javascript'>
      //Calls the refreshOptions() everytime the page loads in order to promptly display the correct amount of options from the question to be edited
                        refreshOptions();
      
                        // Add or remove new text fields for Multiple Choice
      function refreshOptions()
      {
      	//Set timeout fix error due to calling the function when pressing reset button
      	setTimeout(function(){
      	var option = document.getElementById('OptionNo');
      	var Op_no = option.options[option.selectedIndex].value;
      	for(var i = 1; i<= Op_no; i++)
      	{
      		document.getElementById(i).style.display='';
      	}
      	
      	for(var j = 10; j> Op_no; j--)
      	{
      		document.getElementById(j).style.display='none';
      	}
      	},100);
      }
                        
   </script>
   </table>
   <table class='std_form'>
   <tr>
   <td colspan='2'><span style='float: right;'>
   <br />
   <input type='reset' value='Reset' name='clicked_reset' class='buttonStyle1' onclick='refreshOptions();'/>
   <input type='submit' value='Submit' name='clicked_submit' class='buttonStyle1'/>
   </span>
   </td>
   </tr>
   </table>
   </form>
   <!-- Form End -->
</div>