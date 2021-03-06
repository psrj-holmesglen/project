<!--                                                            
 _____ _____ _____ _____    _____ _____ _____ _____ _____ _____ 
|_   _|   __|  _  |     |  |   __|  _  |  _  | __  |_   _|  _  |
  | | |   __|     | | | |  |__   |   __|     |    -| | | |     |
  |_| |_____|__|__|_|_|_|  |_____|__|  |__|__|__|__| |_| |__|__|
                                                                
 * File: Edit.php
 * Edit Sponsor for the dstc e conference web application.
 * Written by TEAM SPARTA 
 * Last updated: 04-05-14 by Thomas Budds

  -->
<div id='sponsor_edit'>
    <link rel='stylesheet' type='text/css' href='CSS/std_form.css'>
    <?PHP


    require "PHP_PRES/helpers/dateTimePicker.php";
    require "PHP_DB/dbObject.php";
    $validated = false;

    $data = new Data();
    $SesErr;
    $TitErr;
    $DescErr;
    $StarErr;
    $EndTErr;
    $LocaErr;
    $ChaiErr;
    $FeedErr;

    // If submit has been clicked:
    if (isset($_POST['clicked_submit'])) {

        require "PHP_VALIDATION/validation.php";

        $Name = $_POST['txtName'];
        //$Logo = $_POST['txtLogo'];
        $Desc = $_POST['txtDesc'];
        $URL = $_POST['txtURL'];
        $equipID = $_POST['txtEquip'];

        $validated = true;

        function nv()
        {
            global $validated;
            $validated = false;
            return vGetErr();
        }

        //validate the data inputted from the form
        if (vIsBlank($Name) || !vMaxChars($Name, 40)) // not blank, max 100 chars.
            $NamErr = nv();
        if (vIsBlank($Desc) || !vMaxChars($Desc, 1000)) // not blank, max 1000 chars.
            $DescErr = nv();
        if (vIsBlank($URL) || !vMaxChars($URL, 100) || !vIsURL($URL)) // not blank, max 400 chars.
            $URLErr = nv();


        // Once the data has been validated, let's insert the data.
        if ($validated) {

            $newData = array(
                    "Name" => $Name,
                //"Logo"             		=> $Logo,
                    "Short_Desc" => $Desc,
                    "URL" => $URL,
                    "Session_Equipment" => $equipID
            );


            if ($data->sponsor->updateRow($_GET["id"], $newData))
                header("Location: index.php?page=sponsor");

        }
    } else {
        $row = $data->sponsor->getRow($_GET["id"]);

        $Name = $row['Name'];
        //$Logo = $row['Logo'];
        $Desc = $row['Short_Desc'];
        $URL = $row['URL'];
        $equipID = $row['Session_Equipment'];
    }
    ?>

    <div id='backButton' style='float: left;'>
        <form action='index.php' method='get'>
            <input type='hidden' name='page' value='sponsor'/>
            <input type='submit' class='buttonStyle1' value='Go Back'/>
        </form>
    </div>

    <h1 style='text-align:center'>Edit a Sponsor</h1>

    <form method='post' action='index.php?page=sponsor&action=edit&id=<?= $_GET["id"] ?>'>
        <table class='std_form'>
            <tr>
                <td class='label'>Name:</td>
                <td><input type='text' name='txtName' class='textBoxStyle1' value='<?= $Name ?>'/></td>
                <td><span class='errorText'><?= $NamErr ?></span></td>
            </tr>

            <tr>
                <td colspan="2">
                    <hr>
                </td>
            </tr>

            <tr>
                <td class='label'>Description:</td>
                <td><textarea type='text' cols='30' rows='8' class='textAreaStyle1'
                              name='txtDesc'><?= $Desc ?></textarea></td>
                <td><span class='errorText'><?= $DescErr ?></span></td>
            </tr>

            <tr>
                <td colspan="2">
                    <hr>
                </td>
            </tr>

            <tr>
                <td class='label'>URL:</td>
                <td><input type='text' name='txtURL' class='textBoxStyle1' value='<?= $URL ?>'/></td>
                <td><span class='errorText'><?= $URLErr ?></span></td>
            </tr>

            <tr>
                <td colspan="2">
                    <hr>
                </td>
            </tr>

            <tr>
                <td class='label'>Equipment Id:</td>
                <td>
                    <select name='txtEquip' class='selectStyle1'>

                        <?PHP
                        $data->equipment->printDropDownOptions($equipID, "ID", "Equipment_Name");
                        ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <hr>
                </td>
            </tr>

            <tr>
                <td colspan='2'><span style='float: right;'>
                    <br/>
                    <input type='submit' value='Reset' name='clicked_reset' class="buttonStyle1"/>
                    <input type='submit' value='Submit' name='clicked_submit' class='buttonStyle1'/>
                    </span>
                </td>
            </tr>
        </table>
    </form>
</div>