<!--                                                            
 _____ _____ _____ _____    _____ _____ _____ _____ _____ _____ 
|_   _|   __|  _  |     |  |   __|  _  |  _  | __  |_   _|  _  |
  | | |   __|     | | | |  |__   |   __|     |    -| | | |     |
  |_| |_____|__|__|_|_|_|  |_____|__|  |__|__|__|__| |_| |__|__|
                                                                
 * File: Delete.php
 * Delete Sessions for the dstc e conference web application.
 * Written by TEAM SPARTA 
 * Last updated: 18-03-14 by Thomas Budds

  -->
<div id='session_delete'>
    <link rel='stylesheet' type='text/css' href='CSS/std_data_table.css'>
    <?PHP


    //require "PHP_DB/db_functions.php";
    require "PHP_DB/dbObject.php";
    //$id = $_GET["id"];
    //echo $id."something else";
    //die;

    $data = new Data();
    //$idUsuable = $row = $data->session->getRow($_GET["id"]);
    //echo $row = $data->session->getRow($_GET["id"])."something else";
    //die;
    //$driver = new mysqli_driver();
    //$driver->report_mode = MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT;
    // If they clicked confirm delete:
    if (isset($_POST["clicked_delete"])) {
        //deleteRow($_GET['id']);
        $data->session->deleteRow($_GET["id"]);
        //deleteRecord("e_session", "Session_Id", $id , "varchar");
        header('Location: index.php?page=session&action=view');
        // if they clicked cancel:
    } else if (isset($_POST["clicked_no"])) {
        header('Location: index.php?page=session&action=view');
    }
    ?>


    <div id='backButton' style='float: left;'>
        <form action='index.php' method='get'>
            <input type='hidden' name='page' value='session'/>
            <input type='submit' class='buttonStyle1' value='Go Back'/>
        </form>
    </div>

    <h1 style='; text-align:center;'>Delete a Session</h1>
    <table width='100%' border='1' cellpadding='5' cellspacing='0' class='stdDataTable'>
        <thead>
        <tr style='background-color:#999 align=' left
        ' valign='middle'' >
        <td>Session Id</td>
        <td>Conference Section Id</td>
        <td>Title Topic</td>
       <!-- <td>Description</td> -->
        <td>Start Time</td>
        <td>End Time</td>
        <td>Room Location</td>
        <td>Session Chairperson</td>
        <td>Feedback Id</td>
        <td>Last Updated</td>
        <td>Polling Available</td>
        <td>Polling Open</td>

        </tr>
        </thead>
        <tbody>


        <?PHP $row = $data->session->getRow($_GET["id"]); ?>
        <tr style='font-size:86%;' align='left' valign='middle'>
            <td><?= $row["ID"] ?></td>
            <td><?= $row["Conference_Section"] ?></td>
            <td><?= $row["Title"] ?></td>
           <!-- <td><?= $row["Description"] ?></td>  -->
            <td><?= $row["Start_Time"] ?></td>
            <td><?= $row["End_Time"] ?></td>
            <td><?= $row["Room_Location"] ?></td>
            <td><?= $row["Session_Chairperson"] ?></td>
            <td><?= $row["Feedback"] ?></td>
            <td><?= $row["Last_Updated"] ?></td>
            <td><?= $row["Polling_Available"] ?></td>
            <td><?= $row["Polling_Open"] ?></td>

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
                    <p>By deleting this session, the following items associated with this session will also be
                        deleted:</p>
                    <ul>
                        <li>Sections</li>
                        <li>Feedback items</li>
                        <li>Polling items</li>
                        <li>Maps</li>
                        <li>Sponsors</li>
                    </ul>
                </td>
            </tr>
        </table>
    </div>
    <table>
        <tr>
            <td>Are you sure you want to delete this Session?</td>
            <td style='text-align:right;'>
                <form method='post' action='index.php?page=session&amp;action=delete&amp;id=<?= $_GET['id'] ?>'>
                    <input type='submit' name='clicked_no' value='Cancel' class="buttonStyle1"/>
            	<span style='padding-left:10px'>
                <input type='submit' name='clicked_delete' value='Delete' class="buttonStyle1"/>
                </span>
                </form>
            </td>
        </tr>
    </table>
</div>