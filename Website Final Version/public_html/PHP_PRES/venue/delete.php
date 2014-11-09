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
    $values = $data->venue->getRow($_GET['id']);

    // If they clicked confirm delete:
    if (isset($_POST["clicked_delete"])) {
        $data->venue->deleteRow($_POST["id"]);
        header('Location: index.php?page=venue');
    } // if they clicked cancel:
    else if (isset($_POST["clicked_no"])) {
        header('Location: index.php?page=venue');
    }

    ?>

    <!-- Back button -->
    <div id='backButton' style='float: left;'>
        <form action='index.php' method='get'>
            <input type='hidden' name='page' value='venue'/>
            <input type='submit' class='buttonStyle1' value='Go Back'/>
        </form>
    </div>

    <h1 style='; text-align:center;'>Delete the Venue</h1>
    <table width='100%' border='1' cellpadding='5' cellspacing='0' class='stdDataTable'>
        <thead>
        <tr style='background-color:#999'>
          <td>ID</td>
          <td>Name</td>
          <td>Company</td>
          <td>Address</td>
        </tr>
        </thead>
        <tbody>
        <tr style='font-size:86%;'>
          <td><?=$values['ID'];?></td>
          <td><?=$values['Name'];?></td>
          <td><?=$values['Company'];?></td>
          <td><?=sprintf('%s, %s %d', $values["Street"], $values["Suburb"], $values["Post_Code"]); ?></td>
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
                    <p>You are now deleting the above venue</p>

                </td>
            </tr>
        </table>
    </div>

    <table>
        <tr>
            <td>Are you sure you want to delete this venue?</td>
            <td style='text-align:right;'>
              <form method='post' action='index.php?page=venue&amp;action=delete'>
                <input type='submit' name='clicked_no' value='Cancel' class="buttonStyle1"/>
                <span style='padding-left:10px'>
<!--
                  <input type='submit' name='clicked_delete' value='Delete' class="buttonStyle1"/>
-->
                    <input type="submit" name='clicked_delete' class='buttonStyle1' value="Delete"/>
                    <input type="hidden" name="page" value="venue"/>
                    <input type="hidden" name="action" value="delete"/>
                    <input type="hidden" name="id" value="<?=$values['ID']?>"/>
                </span>
              </form>
            </td>
        </tr>
    </table>
</div>
