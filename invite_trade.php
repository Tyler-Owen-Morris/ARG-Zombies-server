<?php
include ("db_connect.php");
$to = $_POST['to'];
$id = $_POST['id'];

$resp = $_POST['resp'];

$result = mysql_query("SELECT * FROM users WHERE nick='$to'");
$row = mysql_fetch_array($result);
$rows = mysql_num_rows($result);
if ($rows > 0)
{
		$result2 = mysql_query("SELECT * FROM notification WHERE id_to='$row[id]'");
		$rows2 = mysql_num_rows($result2);
		if ($rows2 > 0){
			$row2 = mysql_fetch_array($result2);
			if ($row2['trade_new'] !='0'){}else{
			mysql_query("UPDATE notification SET id_from='$id', trade_new='$resp' WHERE id_to='$row[id]' AND trade_new='0'");
			}
		}else{
			mysql_query("INSERT INTO notification (id_to, id_from, trade_new) VALUES ('$row[id]', '$id', '$resp')");
		}
	
}else{
	echo "invalid user";
}
?>