<?php

include ("db_connect.php");

if (isset($_GET['User']))
	$user = $_GET['User'];
if (isset($_GET['Lat']))
	$latitude = $_GET['Lat'];
if (isset($_GET['Lon']))
	$longitude = $_GET['Lon'];

$date = strtotime("now");
$expire = strtotime("+1 months");
$sql="SELECT * FROM users WHERE nick='$user'";
$result=mysql_query($sql) or die ($sql);
$row=mysql_fetch_array($result);
$rows=mysql_num_rows($result);
$id = $row['id'];
$sql1="SELECT * FROM home WHERE id_user='$id'";
$result1=mysql_query($sql1) or die ($sql1);
$rows=mysql_num_rows($result1);
//echo $date.";".date("d-m-Y", $date)."<br />";
//echo $expire.";".date("d-m-Y", $expire)."<br />";
if ($rows  > 0){
	$row1 = mysql_fetch_array($result1);
	//echo $row1['last_change'].";".date("d-m-Y", $row1['last_change'])."<br />";
	if ($date < $row1['last_change']){
		$dif = $row1['last_change'] - $date;
		echo $dif;
	}else{
		mysql_query("UPDATE home SET latitude='$latitude', longitude='$longitude', last_change='$expire' WHERE id_user='$id'");
		echo "Homebase updated!";
	}
	
}else{
	mysql_query("INSERT INTO home (id_user, latitude, longitude, last_change) VALUES ('$id', '$latitude', '$longitude', '$expire')");
	echo "Homebase set!";
}
?>