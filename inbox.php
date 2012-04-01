<?php

include ("db_connect.php");

$id = $_GET['id'];

$result = mysql_query("SELECT * FROM mail WHERE id_to='$id' ORDER BY id ASC");

$rows = mysql_num_rows($result);



if ($rows > 0){

echo $rows."~~!!~~<br />";

while ($row = mysql_fetch_array($result)){

	$result2 = mysql_query("SELECT * FROM users WHERE id='$row[id_from]'");

	$row2 = mysql_fetch_array($result2);

	echo $row2['nick']."~~!!~~<br />".$row['text']."~~!!~~<br />";

	mysql_query("DELETE FROM mail WHERE id='$row[id]'");

}

	mysql_query("UPDATE notification SET mail_new='0' WHERE id_to='$id'");

}else{

	echo "0";

}

?>