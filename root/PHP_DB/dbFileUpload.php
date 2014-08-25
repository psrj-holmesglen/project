<?php
//file upload: 		
if (isset($_POST['clicked_submit'])) {
    if ($page == "presenter") {
        $uploLoc = "UPLOADED_FILES/Presenter/";
    } else if ($page == "conference") {
        $uploLoc = "UPLOADED_FILES/Conference/";
    } else if ($page == "sponsor") {
        $uploLoc = "UPLOADED_FILES/Sponsors/";
    } else if ($page == "map") {
        $uploLoc = "UPLOADED_FILES/Maps/";
    } else {
        echo "Page error";
    }

    //begin file upload to correct folder
    if ($_FILES["file"]["error"] > 0) {
        $uploErr = "Error: " . $_FILES["file"]["error"] . "<br>";
    } else {
        //Set file name as ID:
        //$name = id;

        //show details of file uploaded:
        /*echo "Upload: " . $_FILES["file"]["name"] . "<br>";
        echo "Type: " . $_FILES["file"]["type"] . "<br>";
        echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
        echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";*/
    }

    //store in temp file
    $allowedExts = array("gif", "jpeg", "jpg", "png");
    $temp = explode(".", $_FILES["file"]["name"]);
    $extension = end($temp);
    //add restrictions on the type and size of uploaded file
    if ((($_FILES["file"]["type"] == "image/gif")
                    || ($_FILES["file"]["type"] == "image/jpeg")
                    || ($_FILES["file"]["type"] == "image/jpg")
                    || ($_FILES["file"]["type"] == "image/png"))
            && ($_FILES["file"]["size"] < 200000)
            && in_array($extension, $allowedExts)
    ) {

        //check if file already exists in Images folder - this will not be needed when name is set as ID
        if (file_exists("UPLOADED_FILES/" . $_FILES["file"]["name"])) {
            $uploErr = $_FILES["file"]["name"] . " already exists. ";
        }
        //save the uploaded file into a permanent folder
        //else{


        //}
    } else {

        $validated = false;
        //echo "<br/>Invalid file type or size";
        $uploErr = "<br/>Invalid file type or size";

    }
}
//end of file upload
?>
			
