<!--                                                            
 _____ _____ _____ _____    _____ _____ _____ _____ _____ _____ 
|_   _|   __|  _  |     |  |   __|  _  |  _  | __  |_   _|  _  |
  | | |   __|     | | | |  |__   |   __|     |    -| | | |     |
  |_| |_____|__|__|_|_|_|  |_____|__|  |__|__|__|__| |_| |__|__|
                                                                
 * File: Add.php
 * Add Sponsor for the dstc e conference web application.
 * Written by TEAM SPARTA 
 * Last updated: 04-05-14 by Thomas Budds

  -->
<div id='session_add'>
    <link rel='stylesheet' type='text/css' href='CSS/std_form.css'>
    <?PHP


    require "PHP_PRES/helpers/dateTimePicker.php";
    require "PHP_DB/dbObject.php";
    //set file upload variables
    $uploLoc = "UPLOADED_FILES/Sponsors/";

    $validated = false;
    $data = new Data();

    $Star = dtConvertToArray(date('Y-m-d H:i:s'));
    $EndT = dtConvertToArray(date('Y-m-d H:i:s'));

    // If submit has been clicked:
    if (isset($_POST['clicked_submit'])) {
        require "PHP_VALIDATION/validation.php";

        // Grab our data from the form
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

        if (vIsBlank($Name) || !vMaxChars($Name, 40)) // not blank, max 100 chars.
            $NamErr = nv();
        if (vIsBlank($Desc) || !vMaxChars($Desc, 10000)) // not blank, max 1000 chars.
            $DescErr = nv();
        if (vIsBlank($URL) || !vMaxChars($URL, 100) || !vIsURL($URL)) // not blank, max 400 chars.
            $URLErr = nv();
        if (fileUpload($page, $_files, $_post)) //validate file upload
            $uploErr = nv();


    }

    // Once the data has been validated, let's insert the data.
    if ($validated) {

        //Check for file in file upload
        if (empty($_FILES["file"]["name"])) {
            $PFil = "No File Uploaded";
        } else { //if file found then move and save to folder

            //send link to database:..
            $PFil = $target_file;
            $PFil = "File Uploaded";
        }

        $newData = array(
                "Name" => $Name,
                "FilePath" => $PFil,
                "Short_Desc" => $Desc,
                "URL" => $URL,
                "Session_Equipment" => $equipID,
        );


        $newID = $data->sponsor->addRow($newData);
        if ($newID) {
            if ($PFil != "No File Uploaded") {
                $fileData = explode(".", $_FILES['file']['name']);
                $target_file = $uploLoc . $newID . "." . $fileData[1];
                move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
            }

            header("Location: index.php?page=sponsor");
        }
    } else {
        // If invalid data, or no submission yet, lets display the form:
        ?>
        <!-- Back button -->
        <div id='backButton' style='float: left;'>
            <form action='index.php' method='get'>
                <input type='hidden' name='page' value='sponsor'/>
                <input type='submit' class='buttonStyle1' value='Go Back'/>
            </form>
        </div>


        <h1 style='text-align:center'>Add a Sponsor</h1>

        <form method='post' action='index.php?page=sponsor&action=add' enctype="multipart/form-data">
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
                    <td><input type='text' name='txtDesc' class='textBoxStyle1' value='<?= $Desc ?>'/></td>
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
                    <td class='label'><label for="file" class='label'>Upload Logo:</label></td>
                    <td class="file_add"><input type="file" name="file" id="file" onchange="PreviewImage();"
                                                style="opacity:0;filter:alpha(opacity:0);z-index:9999;cursor:default;">
                    </td>
                    <td><img id="uploadPreview" style="width: 100px; height: 100px;"/></td>
                    <script type="text/javascript">

                        function PreviewImage() {
                            var oFReader = new FileReader();
                            oFReader.readAsDataURL(document.getElementById("file").files[0]);

                            oFReader.onload = function (oFREvent) {
                                document.getElementById("uploadPreview").src = oFREvent.target.result;
                            };
                        }
                        ;

                    </script>
                    <td><span class='errorText'><?= $uploErr ?></span></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td colspan='2'><span style='float: right;'>
                    <br/>
                    <input type='reset' value='Reset' name='clicked_reset' class="buttonStyle1"/>
                <input type='submit' value='Submit' name='clicked_submit' class='buttonStyle1'/></span>
                    </td>
                </tr>
            </table>


        </form>
    <?PHP } ?>
</div>
