<?php

include ("db_connect.php");

if (isset($_GET['user_id']))

$user = $_GET['user_id'];

else

$user = 1;



if (isset($_GET['lat1']))

$lat1 = $_GET['lat1'];

else

$lat1 = 1;

if (isset($_GET['lat2']))

$lat2 = $_GET['lat2'];

else

$lat2 = 1;



if (isset($_GET['lon1']))

$lon1 = $_GET['lon1'];

else

$lon1 = 1;

if (isset($_GET['lon2']))

$lon2 = $_GET['lon2'];

else

$lon2 = 1;



/*

$sql = "SELECT * FROM position WHERE (latitude BETWEEN '$lat1' AND '$lat2') AND (longitude BETWEEN '$lon1' AND '$lon2') AND id_user != '$user' AND id_user!='0'";

$result = mysql_query($sql) or die($sql);

$rows = mysql_num_rows($result);

echo $rows."<br />";

while ($row = mysql_fetch_array($result)){

$result2 = mysql_query("SELECT * FROM users WHERE id='$row[id_user]'");

$row2 = mysql_fetch_array($result2);

$result3 = mysql_query("SELECT * FROM user_desc WHERE id_user='$row[id_user]'");

$row3 = mysql_fetch_array($result3);

	echo $row['id_user'].";".$row2['username'].";".$row2['avatar'].";".$row['latitude'].";".$row['longitude'].";".$row2['nick'].";".$row3['level'].":";



	echo "<br />";

}



*/

$result4 = mysql_query("SELECT * FROM stat WHERE id_user='$user'");

$rows4 = mysql_num_rows($result4);

//echo $rows4."<br />";

if ($rows4 > 0){

$i=0;

$sql = "SELECT * FROM position WHERE (latitude BETWEEN '$lat1' AND '$lat2') AND (longitude BETWEEN '$lon1' AND '$lon2') AND id_user != '$user' AND id_user!='0'";

$result = mysql_query($sql) or die($sql);

$rows = mysql_num_rows($result);

while ($row = mysql_fetch_array($result)){

$result2 = mysql_query("SELECT * FROM users WHERE id='$row[id_user]'");

$row2 = mysql_fetch_array($result2);



$result3 = mysql_query("SELECT * FROM user_desc WHERE id_user='$row[id_user]'");

$row3 = mysql_fetch_array($result3);



$result4 = mysql_query("SELECT * FROM stat WHERE id_user='$row[id_user]' AND stat ='1'");

$rows4 = mysql_num_rows($result4);



if ($rows4 > 0){

		$i++;

}

}



echo $i."<br />";

$sql = "SELECT * FROM position WHERE (latitude BETWEEN '$lat1' AND '$lat2') AND (longitude BETWEEN '$lon1' AND '$lon2') AND id_user != '$user' AND id_user!='0'";

$result = mysql_query($sql) or die($sql);

$rows = mysql_num_rows($result);

while ($row = mysql_fetch_array($result)){

$result2 = mysql_query("SELECT * FROM users WHERE id='$row[id_user]'");

$row2 = mysql_fetch_array($result2);



$result3 = mysql_query("SELECT * FROM user_desc WHERE id_user='$row[id_user]'");

$row3 = mysql_fetch_array($result3);



$result4 = mysql_query("SELECT * FROM stat WHERE id_user='$row[id_user]' AND stat ='1'");

$rows4 = mysql_num_rows($result4);



if ($rows4 > 0){

		echo $row['id_user'].";".$row2['username'].";".$row2['avatar'].";".$row['latitude'].";".$row['longitude'].";".$row2['nick'].";".$row3['level']."<br />";

}

}

}

?>