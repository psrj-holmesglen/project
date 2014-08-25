<div id='map_google'>
    <link rel='stylesheet' type='text/css' href='CSS/std_form.css'>
    <?php
    /*
     _____ _____ _____ _____    _____ _____ _____ _____ _____ _____
    |_   _|   __|  _  |     |  |   __|  _  |  _  | __  |_   _|  _  |
      | | |   __|     | | | |  |__   |   __|     |    -| | | |     |
      |_| |_____|__|__|_|_|_|  |_____|__|  |__|__|__|__| |_| |__|__|

     * File: map_g.php
     * Display fixed map for the dstc e conference web application.
     * Written by TEAM SPARTA
     * Last updated: 19-05-14 by Shohei Masunaga */


    ////
    //// Setup START
    ////

    // Import libraries.
    require "PHP_DB/dbObject.php";

    $validated = false;

    // Get a copy of the DAL object.
    $data = new Data();

    ////
    //// Setup END
    ////


    // Get ID of selected conference
    $MapId = $_GET["id"];

    $row = $data->map->getRow($_GET["id"]);

    // Get Location of selected conference
    $directory = $row["Map_Directory"];
    $filepath = $row["FilePath"];

    ///HTML Start
    ///
    ?>

    <!-- Start HTML -->

    <!-- Back button -->
    <div id='backButton' style='float: left;'>
        <form action='index.php' method='get'>
            <input type='hidden' name='page' value='map'/>
            <input type='submit' class='buttonStyle1' value='Go Back'/>
        </form>
    </div>
    <!-- Heading -->
    <h1 align="center">View Map</h1>
    <br/>
    <!-- Form START -->
    <div align="center">
        <img src="<?php echo $directory . $filepath; // import URL of Map?>" width="70%" alt="No Image"/>
    </div>
</div>

