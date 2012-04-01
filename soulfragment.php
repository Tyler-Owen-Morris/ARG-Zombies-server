<?php

include ("db_connect.php");

if (isset($_GET['User']))
	$user = $_GET['User'];

$date = strtotime("now");
$expire = strtotime("+23 hours");
$sql="SELECT * FROM users WHERE nick='$user'";
$result=mysql_query($sql) or die ($sql);
$row=mysql_fetch_array($result);
$rows=mysql_num_rows($result);
$id = $row['id'];
$sql1="SELECT * FROM user_desc WHERE id_user='$id'";
$result1=mysql_query($sql1) or die ($sql1);
$rows=mysql_num_rows($result1);

if ($rows  > 0)
{
	$row1 = mysql_fetch_array($result1);
	if ($date < $row1['lastfragment'])
	{
		$dif = $row1['lastfragment'] - $date;
		echo "tosoon";
	}
	else
	{
		mysql_query("UPDATE user_desc SET lastfragment='$expire' WHERE id_user='$id'");
		echo "success";
	}
	
}
else
{
	echo "fail";
}
?>