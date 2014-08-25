<div id='presenter_add'>
    <link rel='stylesheet' type='text/css' href='CSS/std_form.css'>
    <?PHP
    /*
     _____ _____ _____ _____    _____ _____ _____ _____ _____ _____
    |_   _|   __|  _  |     |  |   __|  _  |  _  | __  |_   _|  _  |
      | | |   __|     | | | |  |__   |   __|     |    -| | | |     |
      |_| |_____|__|__|_|_|_|  |_____|__|  |__|__|__|__| |_| |__|__|

     * File: add.php
     * Add Presenter for the dstc e conference web application.
     * Written by TEAM SPARTA Will
     * Last updated: 17/05/14 by Jenny
    */

    ////
    //// Setup START
    ////

    // Import libraries.
    require "PHP_PRES/helpers/dateTimePicker.php";
    require "PHP_DB/dbObject.php";


    // Get a copy of the DAL object
    $data = new Data();


    // Default times:
    $Star = dtConvertToArray(date('Y-m-d H:i:s'));
    $EndT = dtConvertToArray(date('Y-m-d H:i:s'));

    ////
    //// Setup END
    ////

    // implode the array of selected ids into a comma delimited string.
    $selectedIDDelString = implode(', ', $_GET['questionChkBx']);

    ?>


    <!-- Back button -->
    <div id='backButton' style='float: left;'>
        <form action='index.php' method='get'>
            <input type='hidden' name='page' value='review_question'/>
            <input type='submit' class='buttonStyle1' value='Go Back'/>
        </form>
    </div>

    <!-- Heading -->
    <h1 align="center">Display Selected Questions</h1>

    <div class="scroll"> <!--Add scroll bar to table -->
        <table width="100%" border="1" cellpadding="5" cellspacing="0" class="stdDataTable"
               id="sessionQuestionDisplayTable">
            <thead>
            <tr style="background-color:#999" align="left" valign="middle">
                <td>Highlight</td>
                <td>Question</td>
            </tr>
            </thead>
            <tbody>

            <?PHP
            //Gives all Audience questions
            $table = $data->sessionQuestion->fetchSelectedSessionQuestions($selectedIDDelString);


            foreach ($table as $row) {
                ?>

                <tr class="session-question-row" id="question-row-<?= $row["ID"]; ?>" align="left" valign="middle"
                    style="font-size:86%;">
                    <td style="width:50px; text-align: center"><input type="radio" name="questionRadio"
                                                                      value="<?= $row["ID"]; ?>"
                                                                      onchange="highlightRow()"/></td>
                    <td><?= $row["Question"]; ?></td>
                </tr>


            <?PHP
            }
            //End of $table foreach.

            //No questions could be located
            if ($table == null) {
                echo "No Records Found, retry in a moment.";
            }
            ?>
            </tbody>
        </table>


    </div>
    <p align="right" style="font-size:75%"> <?PHP echo "Returned: " . date('Y-m-d H:i:s'); ?></p>
    <script>


        // highlights the selected row, by adding the highlight class to the selected row.
        // unhighlights other unselected rows.
        function highlightRow() {
            var radios = document.getElementsByName("questionRadio");
            for (i = 0; i < radios.length; i++) {
                if (radios[i].checked) {
                    var row = document.getElementById("question-row-" + radios[i].value);
                    addClass(row, "highlight");
                } else {
                    var row = document.getElementById("question-row-" + radios[i].value);
                    removeClass(row, "highlight");
                }
            }
        }

        // checks that the element has a certain class
        function hasClass(el, name) {
            return new RegExp('(\\s|^)' + name + '(\\s|$)').test(el.className);
        }

        // adds a class to an element
        function addClass(el, name) {
            if (!hasClass(el, name)) {
                el.className += (el.className ? ' ' : '') + name;
            }
        }

        // removes a class from an element
        function removeClass(el, name) {
            if (hasClass(el, name)) {
                el.className = el.className.replace(new RegExp('(\\s|^)' + name + '(\\s|$)'), ' ').replace(/^\s+|\s+$/g, '');
            }
        }
    </script>

    <style>
        .highlight {
            background: orange;
        }

        .highlight td {
            font-size: 2em;
            font-weight: bold;
        }
    </style>
</div>
