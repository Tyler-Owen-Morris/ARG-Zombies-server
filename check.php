<?php

include ("db_connect.php");

if (isset($_GET['lat1']))

$lat1 = (float)$_GET['lat1'];

else $lat1 = 00.00;

if (isset($_GET['lat2']))

$lat2 = (float)$_GET['lat2'];

else $lat2 = 00.00;

if (isset($_GET['lon1']))

$lon1 = (float)$_GET['lon1'];

else $lon1 = 00.00;

if (isset($_GET['lon2']))

$lon2 = (float)$_GET['lon2'];

else $lon2 = 00.00;

$sql = "SELECT DISTINCT

mobs.id_area,

zone.lat_min,

zone.lat_max,

zone.long_min,

zone.long_max

FROM

zone

INNER JOIN mobs ON mobs.id_area = zone.id";

$result = mysql_query($sql) or die ($sql);

$count = 0;

while ($row = mysql_fetch_array($result)){

$lat_min = (float)$row['lat_min'];

$lat_max = (float)$row['lat_max'];

$long_min = (float)$row['long_min'];

$long_max = (float)$row['long_max'];

if ($lat2 < $lat_min){

}elseif ($lat1 > $lat_max){

}elseif ($lon1 > $long_max){

}elseif ($lon2 < $long_min){

}else

{

$count ++;

}

}

echo $count."<br />";

$sql = "SELECT DISTINCT

mobs.id_area,

zone.lat_min,

zone.lat_max,

zone.long_min,

zone.long_max,

zone.name

FROM

zone

INNER JOIN mobs ON mobs.id_area = zone.id";

$result = mysql_query($sql) or die ($sql);

while ($row = mysql_fetch_array($result)){

$lat_min = (float)$row['lat_min'];

$lat_max = (float)$row['lat_max'];

$long_min = (float)$row['long_min'];

$long_max = (float)$row['long_max'];

if ($lat2 < $lat_min){

}elseif ($lat1 > $lat_max){

}elseif ($lon1 > $long_max){

}elseif ($lon2 < $long_min){

}else

{

$mobs = "";

$result2 = mysql_query ("SELECT * FROM mobs WHERE id_area='$row[id_area]'");

while ($row2 = mysql_fetch_array($result2)){

$mobs .= $row2['id_mobs'].",";

}

$mobs = substr_replace("$mobs", "", -1, 1);

echo $mobs."!!";

echo "$lat_min,$lat_max,$long_min,$long_max"."!!";

echo $row['name']."<br />";

}

}



?>