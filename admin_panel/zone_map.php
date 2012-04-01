<?php session_start();

if(!isset($_SESSION['user']))header('Location:login.php');

include ("db_connect.php");

include("functions.php");

if(!isset($_SESSION['super_user']))$sections=get_access($_SESSION['id']);

else $sections=array(1,2,3,4,5,6,7);

if(!in_array(6,$sections)){

echo "<br><br>You do not have access here!";

}

else{

//page content here



?>



<?php

//get zone

$res_zone=mysql_query("SELECT * FROM zone WHERE id = {$_POST['zone_id']}");

$row_zone=mysql_fetch_array($res_zone);

$min_lat=floatval($row_zone['lat_min']);

$max_lat=floatval($row_zone['lat_max']);

$min_long=floatval($row_zone['long_min']);

$max_long=floatval($row_zone['long_max']);

$center_lat=($min_lat+$max_lat)/2;

$center_long=($min_long+$max_long)/2;

?>

 <script src="//maps.google.com/maps?file=api&amp;v=2&amp;key=AIzaSyAbpVa6_SBymmzy-jzcX1dVk6u3cjrkHCw"

            type="text/javascript"></script>

    <script type="text/javascript">

    function initialize() {

      if (GBrowserIsCompatible()) {

        var map = new GMap2(document.getElementById("map_canvas"));

        map.setCenter(new GLatLng(<?php echo $center_lat; ?>, <?php echo $center_long; ?>), 13);

        var polyline = new GPolyline([

  		  new GLatLng(<?php echo $min_lat; ?>, <?php echo $min_long; ?>),//min lat min long

  		  new GLatLng(<?php echo $min_lat; ?>, <?php echo $max_long; ?>),//min lat max long

		  new GLatLng(<?php echo $max_lat; ?>, <?php echo $max_long; ?>),//max lat max long

		  new GLatLng(<?php echo $max_lat; ?>, <?php echo $min_long; ?>),//max lat min long  		  

		  new GLatLng(<?php echo $min_lat; ?>, <?php echo $min_long; ?>)//min lat min long

		], "#ff0000", 5);

		

		 var center = new GLatLng(<?php echo $center_lat; ?>, <?php echo $center_long; ?>);

		 var marker = new GMarker(center);

		 marker.openInfoWindowHtml("<?php echo $row_zone['name']; ?>");

		 

		 

		map.addOverlay(polyline);		

		map.addOverlay(marker);

      }

    }  

    </script>

<body style="background-color:#ababab;" onload="initialize()" onunload="GUnload()">

<a href="logout.php">Logout</a><br><br>

<?php

include("menu.php");

?>

<br><br>

<font style="font-size:20px;font-weight:bold;"><?php echo $row_zone['name']; ?></font>

<br><br>

 <div id="map_canvas" style="width: 500px; height: 300px"></div>

    <div id="message"></div>



</body>



<?php

}

?>

