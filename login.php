<?php

include ("db_connect.php");
if (!isset($_GET['logout'])){
if (isset($_GET['User']))
$user=$_GET['User'];
if (isset($_GET['Pass']))
$pass=$_GET['Pass'];
$pass = md5($pass);
$sql="SELECT * FROM users WHERE username='$user' AND password='$pass'";
$result = mysql_query($sql) or die ($sql);
$rows=mysql_num_rows($result);
if ($rows == 1){
	echo "Login successful!";
	$result3 = mysql_query("SELECT * FROM users WHERE username='$user'");
	$row3 = mysql_fetch_array($result3);
	
	$result2 = mysql_query("SELECT * FROM stat WHERE id_user='$row3[id]'");
	$rows2 = mysql_num_rows($result2);
	if($rows2 > 0){
		mysql_query("UPDATE stat SET stat='1' WHERE id_user='$row3[id]'");
	}else{
		mysql_query("INSERT INTO stat (id_user, stat) VALUES ('$row3[id]', '1')");
	}
}else
echo "Error! Username or Password incorrect!";
}else{
	$logout=$_GET['logout'];
		
	$result2 = mysql_query("SELECT * FROM stat WHERE id_user='$logout'");
	$rows2 = mysql_num_rows($result2);
	if($rows2 > 0){
		mysql_query("UPDATE stat SET stat='0' WHERE id_user='$logout'");
	}else{
		mysql_query("INSERT INTO stat (id_user, stat) VALUES ('$logout', '0')");
	}
	
	mysql_query("DELETE FROM trade WHERE user='$logout'");
	mysql_query("DELETE FROM trade WHERE to='$logout'");
	mysql_query("DELETE FROM trade_ready WHERE user1='$logout'");
	mysql_query("DELETE FROM trade_ready WHERE user2='$logout'");
}
?>