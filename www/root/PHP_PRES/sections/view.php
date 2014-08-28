<div class="view sections">
    <link rel="stylesheet" type="text/css" href="CSS/std_data_table.css"/>

    <?php
    // _____ _____ _____ _____    _____ _____ _____ _____ _____ _____
    //|_   _|   __|  _  |     |  |   __|  _  |  _  | __  |_   _|  _  |
    //  | | |   __|     | | | |  |__   |   __|     |    -| | | |     |
    //  |_| |_____|__|__|_|_|_|  |_____|__|  |__|__|__|__| |_| |__|__|
    //
    // * File: view.php
    // * View Sections for the dstc e conference web application.
    // * Written by TEAM SPARTA
    // * Last updated: 06-05-14 by Jennifer de Peyrecave -->


    ////
    //// Setup START
    ////

    // Import libraries.
    require "PHP_DB/dbObject.php";
	require "PHP_PRES/helpers/dateTimePicker.php";

    // Get a copy of the DAL object.
    $data = new Data();


    $CoId = "All";
    ////
    //// Setup END
    ////
    // If submit has been clicked:
    if (isset($_POST['conference_selected'])) {

        // Grab our data from the form.
        $CoId = $_POST["selCoId"];
    }
    ?>

    <h1>Sections</h1>

    <form method="post" action="index.php?page=section&action=view">
        <table>
            <tr>
                <td class='label'>Select Conference:</td>
                <td>
                    <select name='selCoId' class='selectStyle1' style="width:auto">
                        <option value="All">All Conferences</option>
                        <?php
                        $data->conference->printDropDownOptions($CoId, "Title");


                        ?>

                    </select>
                </td>
                <td>

                    <input type="submit" name="conference_selected" value="Filter" class="buttonStyle1"/>
                </td>
            </tr>
        </table>
    </form>
    <?php
    //if data is found for the selected conference then the table will show
    if ($data->section->getRowByMatch("Conference", $CoId) || $CoId == "All")
    {

    ?>

    <div class="scroll"> <!--Add scroll bar to table -->
        <table width="100%" border="1" cellpadding="5" cellspacing="0" class="stdDataTable">
            <thead>
            <tr style="background-color:#999" align="left" valign="middle">
           <!-- <td>admin id</td>-->
                <td>Section Order</td>
                <td>Title</td>
                <td>Actions</td>

            </tr>
            </thead>

            <tbody>

            <?PHP

            if ($CoId == "All")
                $table = $data->section->getRow("all");

            else
                $table = $data->section->getRowByMatch("Conference", $CoId);

            // TODO: alert no entries.
            foreach ($table as $row) {
                ?>
                <tr style="font-size:86%;">
                	<!--<td align="left" valign="middle"><?= $row["Conference_Admin_Id"] ?></td>-->
                    <td align="left" valign="middle"><?= $row["Ordering"] ?></td>
                    <td align="left" valign="middle"><?= $row["Section_Title"] ?></td>
                    <td align="center" valign="middle">
                        <a href='index.php?page=section&action=edit&id=<?= $row["ID"] ?>'>Edit</a>
                        <a href='index.php?page=section&action=delete&id=<?= $row["ID"] ?>'>Delete</a>
                    </td>
                </tr>
            <?PHP
            }
            //if data is not found for the selected conference then a message will show
            } else
                echo "No Records Found";

            ?>

            </tbody>

        </table>
    </div>

    <p align="right" style="font-size:75%"> <?PHP echo "Returned: " . get_Datetime_Now() ?></p>
    <br/>
    <span style="text-align:right;"><form method="get" action="index.php">
            <input type="submit" value="Add Section" class="buttonStyle1"/>
            <input type="hidden" name="page" value="section"/>
            <input type="hidden" name="action" value="add"/>
        </form></span>

</div>