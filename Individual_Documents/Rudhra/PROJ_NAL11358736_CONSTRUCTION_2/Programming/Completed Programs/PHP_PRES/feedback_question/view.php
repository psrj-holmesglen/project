<div class="section_view">
    <link rel="stylesheet" type="text/css" href="CSS/std_data_table.css"/>

    <?php
    // _____ _____ _____ _____    _____ _____ _____ _____ _____ _____
    //|_   _|   __|  _  |     |  |   __|  _  |  _  | __  |_   _|  _  |
    //  | | |   __|     | | | |  |__   |   __|     |    -| | | |     |
    //  |_| |_____|__|__|_|_|_|  |_____|__|  |__|__|__|__| |_| |__|__|
    //
    // * File: View.php
    // * View Feedback Question for the dstc e conference web application.
    // * Written by TEAM SPARTA
    // * Last updated: 01-04-14 by Shohei Masuanga -->


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
    if (isset($_POST['conference_selected']) || $_REQUEST["con"] == "ConPost") {

        // Grab our data from the form.

        $CoId = $_POST["selCoId"];
    }
    ?>

    <h1>Feedback Question</h1>
    <table>
        <tr>
            <td class='label'>Select Conference:</td>
            <td>
                <form method="post" action="index.php?page=feedback_question&action=view">
                    <select name='selCoId' class='selectStyle1' style="width:auto" onchange='this.form.submit()'>
                        <option value="All">All Conferences</option>
                        <?php
                        // Create selectbox for sorting by conference
                        $data->conference->printDropDownOptions($CoId, "Title");
                        ?>
                    </select>
            </td>
            <td>


                <input type='hidden' name='con' value='ConPost'>
                </form>
            </td>
        </tr>
    </table>
    <div class="scroll"> <!--Add scroll bar to table -->
        <table width="100%" border="1" cellpadding="5" cellspacing="0" class="stdDataTable">
            <thead>
            <tr style="background-color:#999" align="left" valign="middle">

                <td>ID</td>
                <td>Question Text</td>
                <td>Type</td>
                <td>Section</td>
                <td>Action</td>
            </tr>
            </thead>
            <tbody>
            <?PHP
            //Store Section Title before creating table
            $SecTitle = array();

            $table = $data->feedbackSection->getRow("all");
            foreach ($table as $row) {
                $SecTitle[] = $row["Section_Title"];
            }


            // Sort table by conference

            if ($CoId == "All")
                $table = $data->feedbackQuestion->getRow("all");

            else
                $table = $data->feedbackQuestion->getRowByMatch_fq("ID", $CoId);

            // TODO: alert no entries.
            foreach ($table as $row) {
                ?>
                <tr style="font-size:86%;">

                    <td align="left" valign="middle"><?= $row["ID"] ?></td>
                    <td align="left" valign="middle"><?= $row["Question_Text"] ?></td>
                    <td align="left" valign="middle"><?php if ($row["Type"] == 1) {
                            echo "Multiple Choice";
                        } else {
                            echo "Text Response";
                        } ?></td>
                    <td align="left" valign="middle">
                        <?php
                        //$sect = $row["Feedback_Section"];
                        //$row2 = $data->feedbackSection->getRow($sect);
                        $secid = $row["Feedback_Section"] - 1; //$row2["Section_Title"];
                        echo $SecTitle[$secid];
                        ?>
                    </td>
                    <td align="center" valign="middle">
                        <a href='index.php?page=feedback_question&action=edit&id=<?= $row["ID"] ?>'>Edit</a>
                        <a href='index.php?page=feedback_question&action=delete&id=<?= $row["ID"] ?>'>Delete</a>
                    </td>
                </tr>
            <?PHP } ?>
            </tbody>
        </table>
    </div>
    <p align="right" style="font-size:75%"> <?PHP echo "Returned: " . get_Datetime_Now() ?></p>
    <br/>
    <span style="text-align:right;"><form method="get" action="index.php">
            <input type="submit" value="Add FQ" class="buttonStyle1"/>
            <input type="hidden" name="page" value="feedback_question"/>
            <input type="hidden" name="action" value="add"/>
        </form></span>

</div>