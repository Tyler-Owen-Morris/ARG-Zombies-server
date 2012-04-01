<?php

include ("db_connect.php");



$id = $_GET['id'];



$result2 = mysql_query("SELECT * FROM notification WHERE id_to='$id'");

$rows2 = mysql_num_rows($result2);

if ($rows2 > 0){

	$row2 = mysql_fetch_array($result2);

	echo $row2['mail_new'].";".$row2['trade_new'].";";

	if ($row2['id_from'] != '0'){

		$result = mysql_query("SELECT * FROM users WHERE id='$row2[id_from]'");

		$row = mysql_fetch_array($result);

		echo $row['nick'];

	}

	mysql_query("UPDATE notification SET trade_new='0' WHERE id_to='$id'");

}

?>