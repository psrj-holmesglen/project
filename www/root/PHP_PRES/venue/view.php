<?PHP
/*
 _____ _____ _____ _____    _____ _____ _____ _____ _____ _____
|_   _|   __|  _  |     |  |   __|  _  |  _  | __  |_   _|  _  |
  | | |   __|     | | | |  |__   |   __|     |    -| | | |     |
  |_| |_____|__|__|_|_|_|  |_____|__|  |__|__|__|__| |_| |__|__|

 * File: View.php
 * View list of venues for the dstc e conference web application.
 * Written by TEAM SPARTA
 * Last updated: 18-05-14 by Shohei Masunaga

*/

// Import Libraries
require "PHP_DB/dbObject.php";

// Get a copy of the DAL object
$data = new Data();


//Store Conference Titles before creating table
$ConTitle = array();

$table = $data->venue->getRow();
foreach ($table as $row) {
    $ConTitle[] = $row["Title"];
}

////
//// Setup END
////

?>

<div class="venue_view">
    <link rel="stylesheet" type="text/css" href="CSS/std_data_table.css"/>

    <!-- Heading -->
    <h1 align="left">Venue</h1>

    <div class="scroll" id="venuef"> <!--Add scroll bar to table -->
        <table width="100%" border="1" cellpadding="5" cellspacing="0" class="stdDataTable">
            <thead>
            <tr style="background-color:#999" align="left" valign="middle">

                <th>ID</th>
                <th>Name</th>
                <th>Company</th>
                <th>Address</th>
                <th>Action</th>

            </tr>
            </thead>
            <tbody>

<!--
                <tr align="left" valign="middle" style="font-size:86%;">
                    <td>1</td>
                    <td>Venue1</td>
                    <td>Epworth</td>
                    <td>100 Elizabeth Street, Melbourne 3000</td>
                    <td align="center" valign="middle"> 
                      <a href="index.php?page=venue&action=edit&id=1">Edit</a>
                      <a href="index.php?page=venue&action=delete&id=1">Delete</a>
                    </td>
               </tr>
                <tr align="left" valign="middle" style="font-size:86%;">
                    <td>2</td>
                    <td>Venue2</td>
                    <td>Principal Solutions</td>
                    <td>200 City Road, Southbank 3006</td>
                    <td align="center" valign="middle"> 
                      <a href="index.php?page=venue&action=edit&id=2">Edit</a>
                      <a href="index.php?page=venue&action=delete&id=2">Delete</a>
                    </td>
               </tr>
                <tr align="left" valign="middle" style="font-size:86%;">
                    <td>3</td>
                    <td>Venue3</td>
                    <td>Victoria Cookery</td>
                    <td>300 Warrigal Road, Chadstone 3045</td>
                    <td align="center" valign="middle"> 
                      <a href="index.php?page=venue&action=edit&id=3">Edit</a>
                      <a href="index.php?page=venue&action=delete&id=3">Delete</a>
                    </td>
               </tr>
-->
            <?PHP
            $table = $data->venue->getRow("all");
            //Populates the Table from database.
            foreach ($table as $row) {
                ?>

                <tr align="left" valign="middle" style="font-size:86%;">

                    <td><?= $row["ID"]; ?></td>
                    <td><?= $row["Name"]; ?></td>
                    <td><?= $row["Company"]; ?></td>
                    <td><?= printf('%s, %s %s', $row["Street"], $row["Suburb"], $row["Postcode"]); ?></td>
                    
                    <td align="center" valign="middle"> 
                      <a href="index.php?page=venue&action=edit&id=<?= $row["ID"] ?>">Edit</a>
                      <a href="index.php?page=venue&action=delete&id=<?= $row["ID"] ?>">Delete</a>
                    </td>
                </tr>
            <?PHP
            }
            ?>
            </tbody>
        </table>
    </div>

    <p align="right" style="font-size:75%"> <?PHP echo "Returned: " . date('Y-m-d H:i:s'); ?></p> 
    <span style="text-align:right;">
      <form method="get" action="index.php">
        <input type="submit" class='buttonStyle1' value="Add Venue"/>
        <input type="hidden" name="page" value="venue"/>
        <input type="hidden" name="action" value="add"/>
      </form>
    </span>

</div>
