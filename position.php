<?php

include ("db_connect.php");

if (isset($_GET['id']))

$id = $_GET['id'];

else

$id = 1;



if (isset($_GET['lat']))

$lat = $_GET['lat'];

else

$lat = 00.00;

if (isset($_GET['lon']))

$lon = $_GET['lon'];

else

$lon = 00.00;



$sql = "SELECT * FROM position WHERE id_user = '$id'";

$result = mysql_query($sql) or die ($sql);

$rows = mysql_num_rows($result);

if ($rows > 0 ){

mysql_query("UPDATE position SET latitude='$lat', longitude='$lon' WHERE id_user='$id'");

}else{

mysql_query("INSERT INTO position (id_user, latitude, longitude) VALUES ('$id', '$lat', '$lon')");

}

$result = mysql_query("SELECT * FROM zone WHERE lat_min <'$lat' AND lat_max > '$lat' AND long_min < '$lon' AND long_max > '$lon'");

$rows = mysql_num_rows($result);

if ($rows > 0)

{

while ($row = mysql_fetch_array($result)){

	echo $row['id'].";".$row['name']."<br />";

}

}else{

	echo "0";

}

?>