<!--                                                            
 _____ _____ _____ _____    _____ _____ _____ _____ _____ _____ 
|_   _|   __|  _  |     |  |   __|  _  |  _  | __  |_   _|  _  |
  | | |   __|     | | | |  |__   |   __|     |    -| | | |     |
  |_| |_____|__|__|_|_|_|  |_____|__|  |__|__|__|__| |_| |__|__|
                                                                
 * File: Delete.php
 * Delete Sponsors for the dstc e conference web application.
 * Written by TEAM SPARTA 
 * Last updated: 04-05-14 by Thomas Budds

  -->
<div id='sponsor_delete'>
    <link rel='stylesheet' type='text/css' href='CSS/std_data_table.css'>
    <?PHP


    //require "PHP_DB/db_functions.php";
    require "PHP_DB/dbObject.php";
    //$id = $_GET["id"];

    $data = new Data();
    // If they clicked confirm delete:
    if (isset($_POST["clicked_delete"])) {
        $data->sponsor->deleteRow($_GET["id"]);
        header('Location: index.php?page=sponsor&action=view');
        // if they clicked cancel:
    } else if (isset($_POST["clicked_no"])) {
        header('Location: index.php?page=sponsor&action=view');
    }
    ?>


    <div id='backButton' style='float: left;'>
        <form action='index.php' method='get'>
            <input type='hidden' name='page' value='sponsor'/>
            <input type='submit' class='buttonStyle1' value='Go Back'/>
        </form>
    </div>

    <h1 style='; text-align:center;'>Delete a Sponsor</h1>
    <table width='100%' border='1' cellpadding='5' cellspacing='0' class='stdDataTable'>
        <thead>
        <tr style='background-color:#999 align=' left
        ' valign='middle'' >
        <th>Name</th>
        <th>Logo</th>
        <th>Short Description</th>
        <th>URL</th>
        <th>Last Updated</th>
        </tr>
        </thead>
        <tbody>


        <?PHP $row = $data->sponsor->getRow($_GET["id"]); ?>
        <tr style='font-size:86%;' align='left' valign='middle'>
            <td><?= $row["Name"] ?></td>
            <td><?= $row["FilePath"] ?></td>
            <td><?= $row["Short_Desc"] ?></td>
            <td><?= $row["URL"] ?></td>
            <td><?= $row["Last_Updated"] ?></td>

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
                    <p>By deleting this sponsor, the following items associated with this sponsor will also be
                        deleted:</p>
                    <ul>
                        <li>Equipment</li>
                    </ul>
                </td>
            </tr>
        </table>
    </div>
    <table>
        <tr>
            <td>Are you sure you want to delete this Sponsor?</td>
            <td style='text-align:right;'>
                <form method='post' action='index.php?page=sponsor&amp;action=delete&amp;id=<?= $_GET['id'] ?>'>
                    <input type='submit' name='clicked_no' value='Cancel' class="buttonStyle1"/>
            	<span style='padding-left:10px'>
                <input type='submit' name='clicked_delete' value='Delete' class="buttonStyle1"/>
                </span>
                </form>
            </td>
        </tr>
    </table>
</div>