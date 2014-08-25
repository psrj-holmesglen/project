<div id='map_google'>
    <link rel='stylesheet' type='text/css' href='CSS/std_form.css'>
    <?php
    /*
     _____ _____ _____ _____    _____ _____ _____ _____ _____ _____
    |_   _|   __|  _  |     |  |   __|  _  |  _  | __  |_   _|  _  |
      | | |   __|     | | | |  |__   |   __|     |    -| | | |     |
      |_| |_____|__|__|_|_|_|  |_____|__|  |__|__|__|__| |_| |__|__|

     * File: map_g.php
     * Display google map for the dstc e conference web application.
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


    //Store Conference Titles before creating table
    $ConTitle = array();

    $table = $data->conference->getRow();
    foreach ($table as $row) {
        $ConTitle[] = $row["Title"];
    }

    ////
    //// Setup END
    ////


    // Get ID of selected conference
    $CoId = $_GET["id"];

    $row = $data->conference->getRow($_GET["id"]);

    // Get Location of selected conference
    $Location = $row["Location"];

    ///HTML Start
    ///
    ?>



    <script type="text/javascript">
        //// Display Google Map

        //Prepare connection to google API
        var my_google_map;
        var my_google_geo;

        function googlemap_init(id_name, addr_name) {
            //alert("googlemap_init");
            var latlng = new google.maps.LatLng(41, 133);
            var opts = {
                zoom: 15,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                center: latlng
            };
            my_google_map = new google.maps.Map(document.getElementById(id_name), opts);

            my_google_geo = new google.maps.Geocoder();
            var req = {
                address: addr_name,
            };
            my_google_geo.geocode(req, geoResultCallback);
        }


        function geoResultCallback(result, status) {
            //alert("geoResultCallback");
            if (status != google.maps.GeocoderStatus.OK) {
                alert(status);
                return;
            }
            var latlng = result[0].geometry.location;
            my_google_map.setCenter(latlng);
            var marker = new google.maps.Marker({position: latlng, map: my_google_map, title: latlng.toString(), draggable: true});
            google.maps.event.addListener(marker, 'dragend', function (event) {
                marker.setTitle(event.latLng.toString());
            });
        }

    </script>

    <script src="http://maps.google.com/maps/api/js?v=3&sensor=false" type="text/javascript" charset="UTF-8">
        // Connecting Google Map API
    </script>


    <script type="text/javascript">
        // Send the location of map to google map
        $(document).ready(function () {
            //alert("Display Map");
            googlemap_init('google_map', '<?php echo $Location;  ?>');
        });
    </script>

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
        <div id="google_map" style="width: 600px; height: 600px"></div>
    </div>

    <br/>

    <div class="scroll" id="mapf"> <!--Add scroll bar to table -->
        <table width="100%" border="1" cellpadding="5" cellspacing="0" class="stdDataTable">
            <thead>
            <tr style="background-color:#999" align="left" valign="middle">

                <th>ID</th>
                <th>Conference</th>
                <th>Action</th>

            </tr>
            </thead>
            <tbody>
            <?PHP
            // Retrieve related map by matching with ID of conference
            $table = $data->map->getRowbyMatch("conference", $_GET["id"]);
            //Populates the Table from database.
            foreach ($table as $row) {
                ?>

                <tr align="left" valign="middle" style="font-size:86%;">

                    <td><?= $row["ID"]; ?></td>
                    <td><?php
                        $CoId = $row["Conference"] - 1;
                        echo $ConTitle[$CoId];
                        ?>
                    </td>


                    <td align="center" valign="middle">

                        <a href="index.php?page=map&action=map_f&id=<?= $row["ID"] ?>" target="_blank">View Map</a>

                    </td>
                </tr>
            <?PHP
            }

            ?>
            </tbody>
        </table>
    </div>

</div>