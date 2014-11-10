<?PHP
   /*
      
        * File: view.php
        * View Sponors for the dstc e conference web application.
        * Written by TEAM  SPARTA
        * Last updated: 28-10-14 by Rudhra
       */
   
   ////
   //// Setup START
   ////
   
   // Import libraries.
   require "PHP_DB/dbObject.php";
   require "PHP_PRES/helpers/dateTimePicker.php";
   
   // Get a copy of the DAL object.
   $data = new Data();
   $CSId = "All";
   
   ?>
<div class="session_view">
   <link rel="stylesheet" type="text/css" href="CSS/std_data_table.css"/>
   <h1>Sponsors</h1>
   <div class="scroll">
      <table width="100%" border="1" cellpadding="5" cellspacing="0" class="stdDataTable">
         <thead>
            <tr style="background-color:#999" align="left" valign="middle">
               <td>Name</td>
               <td>Logo</td>
               <td>Short Description</td>
               <td>URL</td>
               <td>Equipment</td>
               <td>Actions</td>
            </tr>
         </thead>
         <tbody>
            <?PHP
               $table = $data->sponsor->getRow("all");
               foreach ($table as $row) {
                   ?>
            <tr align="left" valign="middle" style="font-size:86%;">
               <td><?= $row["Name"] ?></td>
               <td><?= $row["FilePath"] ?></td>
               <td><?= $row["Short_Desc"] ?></td>
               <td><?= $row["URL"] ?></td>
               <td><?= $row["Session_Equipment"] ?></td>
               <td align="center" valign="middle">
                  <a href="index.php?page=sponsor&action=edit&id=<?= $row["ID"] ?>">Edit</a>
                  <a href="index.php?page=sponsor&action=delete&id=<?= $row["ID"] ?>">Delete</a>
               </td>
            </tr>
            <?PHP
               }
               ?>
         </tbody>
      </table>
   </div>
   <p align="right" style="font-size:75%"> <?PHP echo "Returned: " . get_Datetime_Now(); ?></p>
   <br/>
   <span style="text-align:right;">
      <form method="get" action="index.php"><input type="submit" value="Add Sponsor"
         class="buttonStyle1"/>
         <input type="hidden" name="page" value="sponsor"/>
         <input type="hidden" name="action" value="add"/>
      </form>
   </span>
</div>