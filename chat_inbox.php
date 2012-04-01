<?php

include ("db_connect.php");

$id = $_GET['id'];

$result = mysql_query("SELECT * FROM trade_chat WHERE id_to='$id' ORDER BY id_chat ASC");

$rows = mysql_num_rows($result);

$result3 = mysql_query("SELECT * FROM trade_ready WHERE `user1`='$id'");

$rows3 = mysql_num_rows($result3);

if ($rows3 > 0){

	$row3 = mysql_fetch_array($result3);

	echo $row3['update1']."-";

	echo $row3['update2']."-";

	echo $row3['ready1']."-";

	echo $row3['ready2']."-";

	mysql_query("UPDATE trade_ready SET update1='0' WHERE `user1`='$id'");

}else{

	$result4 = mysql_query("SELECT * FROM trade_ready WHERE `user2`='$id'");

	$row4 = mysql_fetch_array($result4);

	echo $row4['update2']."-";

	echo $row4['update1']."-";

	echo $row4['ready2']."-";

	echo $row4['ready1']."-";

	mysql_query("UPDATE trade_ready SET update2='0' WHERE `user2`='$id'");

}

if ($rows > 0){

echo $rows."~~!!~~<br />";

while ($row = mysql_fetch_array($result)){

	if ($row['id_from'] == '0'){

		echo "System~~!!~~<br />".$row['text']."~~!!~~<br />";

		mysql_query("DELETE FROM trade_chat WHERE id_chat='$row[id_chat]'");

	}else{

		$result2 = mysql_query("SELECT * FROM users WHERE id='$row[id_from]'");

		$row2 = mysql_fetch_array($result2);

		echo $row2['nick']."~~!!~~<br />".$row['text']."~~!!~~<br />";

		mysql_query("DELETE FROM trade_chat WHERE id_chat='$row[id_chat]'");

	}

}

}else{

	echo "0";

}

?>