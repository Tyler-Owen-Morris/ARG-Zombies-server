<?php
	include ("db_connect.php");
	$opt = $_POST['opt'];
	$user = $_POST['user'];
	$nick = $_POST['nick'];

	if ($opt == '1'){	//nick2username
		$result = mysql_query("SELECT * FROM users WHERE nick='$nick'");
		$rows = mysql_num_rows($result);
		if ($rows > 0){
			$row = mysql_fetch_array($result);
			echo $row['username'];
		}else{
			echo "no user with this nick";
		}
	}
	
	if ($opt == '2'){	//username2nick
		$result = mysql_query("SELECT * FROM users WHERE username='$user'");
		$rows = mysql_num_rows($result);
		if ($rows > 0){
			$row = mysql_fetch_array($result);
			echo $row['nick'];
		}else{
			echo "no user with this username";
		}
	}
?>