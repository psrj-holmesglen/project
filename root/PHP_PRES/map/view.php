<?PHP
/*
 _____ _____ _____ _____    _____ _____ _____ _____ _____ _____
|_   _|   __|  _  |     |  |   __|  _  |  _  | __  |_   _|  _  |
  | | |   __|     | | | |  |__   |   __|     |    -| | | |     |
  |_| |_____|__|__|_|_|_|  |_____|__|  |__|__|__|__| |_| |__|__|

 * File: View.php
 * View list of maps for the dstc e conference web application.
 * Written by TEAM SPARTA
 * Last updated: 18-05-14 by Shohei Masunaga


*/

// Import Libraries
require "PHP_DB/dbObject.php";

// Get a copy of the DAL object
$data = new Data();


//Store Conference Titles before creating table
$ConTitle = array();

$table = $data->conference->getRow();
foreach ($table as $row) {
    $ConTitle[] = $row["Title"];
}

////
//// Setup END
////


?>

<div class="map_view">
    <link rel="stylesheet" type="text/css" href="CSS/std_data_table.css"/>

    <!-- Heading -->
    <h1 align="left">Map</h1>

    <table>
        <tr>
            <td>Select Tyope:</td>
            <td colspan="2">
                <input name='radiobutton' type='radio' value='1' onclick='Map_F();' checked="checked">Fixed Map<br/>
                <input name='radiobutton' type='radio' value='2' onclick='Map_G();'>Google Map
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <hr>
            </td>
        </tr>
    </table>

    <div class="scroll" id="mapf"> <!--Add scroll bar to table -->
        <table width="100%" border="1" cellpadding="5" cellspacing="0" class="stdDataTable">
            <thead>
            <tr style="background-color:#999" align="left" valign="middle">

                <th>ID</th>
                <th>Conference</th>
                <th>Action</th>

            </tr>
            </thead>
            <tbody>
            <?PHP

            $table = $data->map->getRow("all");
            //Populates the Table from database.
            foreach ($table as $row) {
                ?>

                <tr align="left" valign="middle" style="font-size:86%;">

                    <td><?= $row["ID"]; ?></td>
                    <td><?php
                        $CoId = $row["Conference"] - 1;
                        echo $ConTitle[$CoId];
                        ?>
                    </td>


                    <td align="center" valign="middle">

                        <a href="index.php?page=map&action=map_f&id=<?= $row["ID"] ?>">View Map</a>

                    </td>
                </tr>
            <?PHP
            }

            ?>
            </tbody>
        </table>
    </div>


    <div class="scroll" id="mapg" style="display:none"> <!--Add scroll bar to table -->
        <table width="100%" border="1" cellpadding="5" cellspacing="0" class="stdDataTable">
            <thead>
            <tr style="background-color:#999" align="left" valign="middle">

                <th>ID</th>
                <th>Conference</th>
                <th>Location</th>
                <th>Action</th>

            </tr>
            </thead>
            <tbody>
            <?PHP

            $table = $data->conference->getRow("all");
            //Populates the Table from database.
            foreach ($table as $row) {
                ?>

                <tr align="left" valign="middle" style="font-size:86%;">

                    <td><?= $row["ID"]; ?></td>
                    <td><?= $row["Title"]; ?></td>
                    <td><?= $row["Location"]; ?></td>


                    <td align="center" valign="middle">

                        <a href="index.php?page=map&action=map_g&id=<?= $row["ID"] ?>">View Map</a>

                    </td>
                </tr>
            <?PHP
            }

            ?>
            </tbody>
        </table>
    </div>

    <p align="right" style="font-size:75%"> <?PHP echo "Returned: " . date('Y-m-d H:i:s'); ?></p> 
    <span style="text-align:right;"><form method="get" action="index.php">
            <input type="submit" class='buttonStyle1' value="Add Map"/>
            <input type="hidden" name="page" value="map"/>
            <input type="hidden" name="action" value="add"/>
        </form></span>

</div>

<script type="text/javascript">

    function Map_F() {
        document.getElementById('mapf').style.display = "";
        document.getElementById('mapg').style.display = "none";
    }

    function Map_G() {
        document.getElementById('mapf').style.display = "none";
        document.getElementById('mapg').style.display = "";
    }

</script>