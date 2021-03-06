<div id='polling_question_delete'>
   <link rel='stylesheet' type='text/css' href='CSS/std_data_table.css'>
   <?PHP
      /*
       _____ _____ _____ _____    _____ _____ _____ _____ _____ _____
      |_   _|   __|  _  |     |  |   __|  _  |  _  | __  |_   _|  _  |
        | | |   __|     | | | |  |__   |   __|     |    -| | | |     |
        |_| |_____|__|__|_|_|_|  |_____|__|  |__|__|__|__| |_| |__|__|
      
       * File: delete.php
       * Delete a Polling Question confirmation for the dstc eConference web application.
       * Written by TEAM SPARTA
       * Last updated: 24-04-14 by Caue
      */
      
      // Import libraries.
      require "PHP_DB/dbObject.php";
      
      // Make our DAL Object.
      $data = new Data();
      
      // If they clicked confirm delete:
      if (isset($_POST["clicked_delete"])) {
      
          // Execute sql query to delete data
          $delete = $data->pollingQuestion->deleteRow($_GET["id"]);
      
          // If Polling question confirmed, proceed with respective options deletion
          if ($delete) {
              //Fetch Database for respective Polling Options
              $row = $data->pollingOption->getRowByMatch("Polling", $_GET["id"]);
      
              for ($j = 0; $j < count($row); $j++) {
                  //Loop through all options related to this specific question and delete them
                  $data->pollingQuestion->deleteRow($row[$j]["ID"]);
              }
              //Redirect user to Polling Question view page
              header("Location: index.php?page=polling_question");
          }
      } // if they clicked cancel:
      else if (isset($_POST["clicked_no"])) {
          //Redirect user to Polling Question view page
          header("Location: index.php?page=polling_question");
      }
      // Display confirmation page:
      ?>
   <!-- Back button -->
   <div id='backButton' style='float: left;'>
      <form action='index.php' method='get'>
         <input type='hidden' name='page' value='polling_question'/>
         <input type='submit' class='buttonStyle1' value='Go Back'/>
      </form>
   </div>
   <h1 style='; text-align:center;'>Delete a Polling Question</h1>
   <!-- Create table and populate with question values -->
   <table width='100%' border='1' cellpadding='5' cellspacing='0' class='stdDataTable'>
      <thead>
         <tr style='background-color:#999'>
            <td align='left' valign='middle'>Question</td>
            <td align='left' valign='middle'>Session</td>
         </tr>
      </thead>
      <tbody>
         <?PHP
            //Retrieves the question and Session Id from the Polling table
            $rowData = $data->pollingQuestion->getRow($_GET["id"]);
            ?>
         <tr style="font-size:86%;">
            <td align='left' valign='middle'><b><?= $rowData["Polling_Question"] ?></b></td>
            <td align='left' valign='middle'><b><?= $rowData["Session"] ?></b></td>
         </tr>
      </tbody>
   </table>
   <!-- Create table and populate with answer option values -->
   <table width='100%' border='1' cellpadding='5' cellspacing='0' class='stdDataTable'>
      <thead>
         <tr style='background-color:#999'>
            <td align='left' valign='middle'>Options</td>
         </tr>
      </thead>
      <tbody>
         <?PHP
            //Retrieves all the options related to this specific question from the Polling_Options table
            $rowData = $data->pollingOption->getRowByMatch("Polling", $_GET["id"]);
            
            foreach ($rowData as $rowData2) {
                ?>
         <tr style="font-size:86%;">
            <td align='left' valign='middle'><b><?= $rowData2["Option_Text"] ?></b></td>
         </tr>
         <?PHP } ?>
      </tbody>
   </table>
   <div style='background-color:#328ABA; color:#FFFFFF; padding-left:20px; margin-top:24px; border-radius:3px;'>
      <table width="100%">
         <tr>
            <td align='left' valign='middle' width='120px'>
               <img src='http://www.clker.com/cliparts/H/Z/0/R/f/S/warning-icon-md.png' width='100px'/>
            </td>
            <td>
               <p>By deleting this question, it will be permanently removed from the database along with all its
                  options.
               </p>
            </td>
         </tr>
      </table>
   </div>
   <table style='width:100%; margin-top:20px;'>
      <tr>
         <td>Are you sure you want to delete this Polling Question?</td>
         <td style='text-align:right;'>
            <form method='post' action='index.php?page=polling_question&action=delete&id=<?= $_GET["id"] ?>'>
               <input type='submit' name='clicked_no' class='buttonStyle1' value='Cancel'/>
               <span style='padding-left:10px'><input type='submit' name='clicked_delete' class='buttonStyle1'
                  value='DELETE'/></span>
            </form>
         </td>
      </tr>
   </table>
</div>