<div id='polling_result'>
   <link rel='stylesheet' type='text/css' href='CSS/std_data_table.css'>
   <?PHP
      /*
       _____ _____ _____ _____    _____ _____ _____ _____ _____ _____
      |_   _|   __|  _  |     |  |   __|  _  |  _  | __  |_   _|  _  |
        | | |   __|     | | | |  |__   |   __|     |    -| | | |     |
        |_| |_____|__|__|_|_|_|  |_____|__|  |__|__|__|__| |_| |__|__|
      
       * File: result.php
       * Display a Polling Result for the dstc eConference web application.
       * Written by TEAM SPARTA
       * Last updated: 24-04-14 by Shohei
      */
      
      // Import libraries.
      require "PHP_DB/dbObject.php";
      
      // Make our DAL Object.
      $data = new Data();
      ?>
   <!-- Back button -->
   <div id='backButton' style='float: left;'>
      <form action='index.php' method='get'>
         <input type='hidden' name='page' value='polling_question'/>
         <input type='submit' class='buttonStyle1' value='Go Back'/>
      </form>
   </div>
   <h1 style='; text-align:center;'>Polling Result</h1>
   <table width='100%' border='1' cellpadding='5' cellspacing='0' class='stdDataTable'>
      <thead>
         <tr style='background-color:#999;'>
            <th align="left" valign="middle">Question
               <?PHP
                  $row = $data->pollingQuestion->getRow_MAX();
                  
                  if ($_GET["id"] != $row["ID"]) {
                      echo "<div  id='backButton' style='float: right;'>
                  	<form action='index.php' method='get'> 
                      <input type='hidden' name='page' value='polling_question' />
                      <input type='hidden' name='action' value='result'/>
                      <input type='hidden' name='id' value='";
                  
                      echo $_GET["id"] + 1;
                      echo "'/>
                      <input type='submit' class='buttonStyle1' value='Next' />
                  	</form>
                  	</div>";
                  }
                  ?>
            </th>
         </tr>
      </thead>
      <tbody>
         <?PHP
            $rowData = $data->pollingQuestion->getRow($_GET["id"]);
            ?>
         <tr style="font-size:86%; font-size:20px">
            <td align='left' valign='middle'><?= $rowData["Polling_Question"] ?></td>
         </tr>
      </tbody>
   </table>
   <div style='margin-top:54px;' align="center">
      <?php
         $table = $data->pollingOption->getRowbyMatch("Polling", $_GET["id"]);
         $count = 0;
         foreach ($table as $row) {
             $count += $data->pollingResponse->getRowCount_pr($row["ID"]);
         }
         
         if ($count == 0) {
             echo "<h2>No data</h2>";
         } else {
         
             echo "<img src='http://chart.apis.google.com/chart?cht=p3&amp;";
             echo "chd=t:";
         
             // Changable in percentage (No need to be 100)
             $percent = "";
             $p = 0;
             $perArray = array();
             foreach ($table as $row) {
                 if ($data->pollingResponse->getRowCount_pr($row["ID"]) != 0) {
                     if ($p != 0) {
                         $percent .= ",";
                     }
                     $per = $data->pollingResponse->getRowCount_pr($row["ID"]);
                     $percent .= $per;
         
                     $p++;
                 }
             }
             echo "$percent";
         
             echo "&amp;chs=850x200&amp;";
             echo "chl=";
         
             // Changable in factors
             $factor = "";
             $p = 0;
             foreach ($table as $row) {
                 if ($data->pollingResponse->getRowCount_pr($row["ID"]) != 0) {
                     if ($p != 0) {
                         $factor .= "|";
                     }
                     $factor .= $row["Option_Text"];
         
                     $p++;
                 }
             }
             echo "$factor";
         
             echo "&chco=034C75' width='100%' height='100%' alt='GRAPH'>";
         }
         ?>
   </div>
   <div align="center">
      <?PHP
         if ($rowData = $data->pollingOption->getRowbyMatch("Polling", $_GET["id"])) {
             ?>
      <table width='40%' border='1' cellpadding='5' cellspacing='0' class='stdDataTable' style='margin-top:44px;'>
         <thead>
            <tr style='background-color:#999'>
               <td align="left" valign="middle">Option</td>
               <td align="left" valign="middle">Result</td>
            </tr>
         </thead>
         <tbody>
            <?php
               foreach ($rowData as $row) {
                   ?>
            <tr style="font-size:13px">
               <td align='left' valign='middle'><?= $row["Option_Text"] ?></td>
               <td align='left' valign='middle'>
                  <?php
                     echo $data->pollingResponse->getRowCount_pr($row["ID"]);
                     ?>
               </td>
            </tr>
            <?php
               }
               ?>
         </tbody>
      </table>
      <?php
         } else {
             echo "No Options exist";
         }
         ?>
   </div>
</div>