<?php

include ("db_connect.php");

$id = $_GET['user'];

$result = mysql_query("SELECT * FROM trade_stats WHERE id_user='$id' ORDER BY id ASC");

$rows = mysql_num_rows($result);



if ($rows > 0){

echo $rows."~~!!~~<br />";

while ($row = mysql_fetch_array($result)){

	echo $row['text']."<br />";

	mysql_query("DELETE FROM trade_chat WHERE id='$row[id]'");

}

}else{

	echo "0";

}

?>