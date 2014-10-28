<div id='presenter_delete'>
   <link rel='stylesheet' type='text/css' href='CSS/std_data_table.css'>
   <?PHP
      // _____ _____ _____ _____    _____ _____ _____ _____ _____ _____
      //|_   _|   __|  _  |     |  |   __|  _  |  _  | __  |_   _|  _  |
      //  | | |   __|     | | | |  |__   |   __|     |    -| | | |     |
      //  |_| |_____|__|__|_|_|_|  |_____|__|  |__|__|__|__| |_| |__|__|
      //
      // * File: Delete.php
      // * Delete presenters for the dstc e conference web application.
      // * Written by TEAM SPARTA
      // * Last updated: 31-03-14 by Jennifer de Peyrecave -->
      
      
      // Import libraries.
      require "PHP_DB/dbObject.php";
      
      // Make our DAL Object.
      $data = new Data();
      
      // If they clicked confirm delete:
      if (isset($_POST["clicked_delete"])) {
          $data->presenter->deleteRow($_GET["id"]);
          header('Location: index.php?page=presenter');
      } // if they clicked cancel:
      else if (isset($_POST["clicked_no"])) {
          header('Location: index.php?page=presenter');
      }
      
      ?>
   <h1 style='; text-align:center;'>Delete a Presenter</h1>
   <table width='100%' border='1' cellpadding='5' cellspacing='0' class='stdDataTable'>
      <thead>
         <tr style='background-color:#999'>
            <td>Presenter Id</td>
            <td>Title</td>
            <td>First Name</td>
            <td>Last Name</td>
            <td>Organisation</td>
            <td>Medical Field</td>
            <td>Position</td>
            <td>Qualification</td>
            <td>Short Bio</td>
            <td>Photo Filepath</td>
         </tr>
      </thead>
      <tbody>
         <?PHP $row = $data->presenter->getRow($_GET["id"]); ?>
         <tr style='font-size:86%;'>
            <td><?= $row["ID"]; ?></td>
            <td><?= $row["Title"]; ?></td>
            <td><?= $row["First_Name"]; ?></td>
            <td><?= $row["Last_Name"]; ?></td>
            <td><?= $row["Organisation"]; ?></td>
            <td><?= $row["Medical_Field"]; ?></td>
            <td><?= $row["Position"]; ?></td>
            <td><?= $row["Qualification"]; ?></td>
            <td><?= $row["Short_Bio"]; ?></td>
            <td><?= $row["Photo_Filepath"]; ?></td>
         </tr>
      </tbody>
   </table>
   <div style='background-color:#328ABA; color:#FFFFFF; padding-left:20px; margin-top:24px; border-radius:3px;'>
      <table width="100%">
         <tr>
            <td align='left' valign='middle' width='120px'>
               <img src='http://www.clker.com/cliparts/H/Z/0/R/f/S/warning-icon-md.png' width='100px'/>
            </td>
            <td>
               <p>You are now deleting the above presenter</p>
            </td>
         </tr>
      </table>
   </div>
   <table>
      <tr>
         <td>Are you sure you want to delete this presenter?</td>
         <td style='text-align:right;'>
            <form method='post' action='index.php?page=presenter&amp;action=delete&amp;id=<?= $_GET['id'] ?>'>
               <input type='submit' name='clicked_no' value='Cancel' class="buttonStyle1"/>
               <span style='padding-left:10px'><input type='submit' name='clicked_delete' value='Delete'
                  class="buttonStyle1"/></span>
            </form>
         </td>
      </tr>
   </table>
</div>