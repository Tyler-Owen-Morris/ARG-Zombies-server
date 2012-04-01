<?php
include ("db_connect.php");
$id = $_GET['id'];
$resp = $_GET['resp'];

	$result2 = mysql_query("SELECT * FROM notification WHERE id_to='$id' AND trade_new='1'");
	$rows2 = mysql_num_rows($result2);
	if ($rows2 > 0){
		mysql_query("UPDATE notification SET resp='$resp' WHERE id_to='$id' AND trade_new='1'");
	}
?>