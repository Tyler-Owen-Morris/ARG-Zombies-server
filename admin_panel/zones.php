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

<body style="background-color:#ababab;">

<a href="logout.php">Logout</a><br><br>

<?php

include("menu.php");

?>

<br><br>

<input type="button" value="Add zone" onclick="window.location.href='add_zone.php'">

<br><br>



<table style="background-color:black;">

<tr><th style="background-color:#efefef;">Name</th><th style="background-color:#efefef;">Min lat</th><th style="background-color:#efefef;">Max lat</th><th style="background-color:#efefef;">Min long</th><th style="background-color:#efefef;">Max long</th><th>&nbsp;</th></tr>

<?php

$res_miss=mysql_query("SELECT * FROM zone");

while($row_miss=mysql_fetch_array($res_miss)){

echo "<tr>";

echo "<td style=\"background-color:#efefef;\">{$row_miss['name']}</td>";

echo "<td style=\"background-color:#efefef;\">{$row_miss['lat_min']}</td>";

echo "<td style=\"background-color:#efefef;\">{$row_miss['lat_max']}</td>";

echo "<td style=\"background-color:#efefef;\">{$row_miss['long_min']}</td>";

echo "<td style=\"background-color:#efefef;\">{$row_miss['long_max']}</td>";



echo "<td style=\"background-color:#efefef;\"><form action=\"edit_zone.php\" method=\"POST\"><input type=\"hidden\" name=\"zone_id\" value=\"{$row_miss['id']}\"><input type=\"submit\" value=\"Edit\"></form></td>";



echo "</tr>";

}

?>

</table>





</body>



<?php

}

?>

