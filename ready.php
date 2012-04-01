<?php
	include ("db_connect.php");

	if (isset($_GET['user'])){
	$user = $_GET['user'];
	$result = mysql_query("SELECT * FROM trade_ready WHERE user1 = '$user'");
	$rows = mysql_num_rows($result);
	if ($rows > 0){
		$row = mysql_fetch_array($result);
		if ($row['ready1'] == '1'){
			echo "1";
		}else{
			echo "0";
		}
	}else{
		$result2 = mysql_query("SELECT * FROM trade_ready WHERE user2 = '$user'");

		$row2 = mysql_fetch_array($result2);
		
			if ($row2['ready2'] == '1'){
				echo "1";
			}else{
				echo "0";
			}
		}
	}
	
	if (isset($_GET['username'])){
	$username = $_GET['username'];
	$result3 = mysql_query("SELECT * FROM users WHERE nick='$username'");
	$row3 = mysql_fetch_array($result3);
	
	$result = mysql_query("SELECT * FROM trade_ready WHERE user1 = '$row3[id]'");
	$rows = mysql_num_rows($result);
	if ($rows > 0){
		$row = mysql_fetch_array($result);
		if ($row['ready1'] == '1'){
			echo "1";
		}else{
			echo "0";
		}
	}else{
		$result2 = mysql_query("SELECT * FROM trade_ready WHERE user2 = '$row3[id]'");
		$row2 = mysql_fetch_array($result2);
		
			if ($row2['ready2'] == '1'){
				echo "1";
			}else{
				echo "0";
			}
		}
	}
	
?>