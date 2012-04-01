<?php



include ("db_connect.php");



$user = $_POST['user'];

$to = $_POST['to'];

$result3 = mysql_query("SELECT * FROM users WHERE nick='$to'");

$row3 = mysql_fetch_array($result3);

$opt = $_POST['opt'];

if ($opt == '1'){ //add to trade



$item = $_POST['id_item'];

$quantity = $_POST['quantity'];



$result1 = mysql_query("SELECT * FROM trade WHERE `user`='$user' AND `to`='$row3[id]' AND `item`='$item'");

$rows1 = mysql_num_rows($result1);

if ($rows1 > 0){

	$result = mysql_query("SELECT * FROM items_inventory WHERE `id_item`='$item'");

	$row = mysql_fetch_array($result);

	if ($row['slot'] == '7'){

			$row1 = mysql_fetch_array($result1);

			$quantity1 = $row1['quantity']+$quantity;

			//echo $quantity1;

			mysql_query("UPDATE trade SET `quantity`='$quantity1' WHERE `user`='$user' AND `to`='$row3[id]' AND `item`='$item'");

			//echo "yes1";

			

	}else{

		mysql_query("INSERT INTO trade (`user`, `to`, `item`, `quantity`) VALUES ('$user', '$row3[id]', '$item', '$quantity')");

		//echo "yes2";

	}





}else{

	mysql_query("INSERT INTO trade (`user`, `to`, `item`, `quantity`) VALUES ('$user', '$row3[id]', '$item', '$quantity')");

	//echo "yes3";

}

$result1 = mysql_query("SELECT * FROM trade_ready WHERE `user1`='$user'");

$rows1 = mysql_num_rows($result1);

$row1 = mysql_fetch_array($result1);

if ($rows1 > 0){

	mysql_query("UPDATE trade_ready SET `ready1`='0', `ready2`='0', `fin`='0', `update2`='1' WHERE `user1`='$user'");

}else{

	$result2 = mysql_query("SELECT * FROM trade_ready WHERE `user2`='$user'");

	$rows2 = mysql_num_rows($result2);

	$row2 = mysql_fetch_array($result2);

	if ($rows2 > 0){

		mysql_query("UPDATE trade_ready SET `ready1`='0', `ready2`='0', `fin`='0', `update1`='1' WHERE `user2`='$user'");

	}else{

		mysql_query("INSERT INTO trade_ready (`user1`, `user2`, `ready1`, `ready2`, `update2`, `fin`) VALUES ('$user', '$row3[id]', '0', '0', '1', '0')");

	}

}

}

elseif ($opt == '2'){//view trade

$result = mysql_query("SELECT * FROM trade WHERE `user` = '$user'");

while ($row = mysql_fetch_array($result)){

	echo $row['id'].";".$row['item'].";".$row['quantity']."<br />";

}

echo "~~!!~~";

$result2 = mysql_query("SELECT * FROM trade WHERE `user` = '$row3[id]'");

while ($row2 = mysql_fetch_array($result2)){

	echo $row2['id'].";".$row2['item'].";".$row2['quantity']."<br />";

}



}

elseif ($opt == '3'){//change money

$money = $_POST['money'];

$sql = "SELECT * FROM trade WHERE `user`='$user' AND `to`='$row3[id]' AND `item`='-1' ";

$result = mysql_query($sql) or die($sql);

$rows = mysql_num_rows($result);

if ($rows > 0){

$row = mysql_fetch_array($result);

$money1 = $row['quantity']+$money;



mysql_query("UPDATE trade SET `quantity`='$money1' WHERE `user`='$user' AND `to`='$row3[id]' AND `item`='-1'");

}else{

mysql_query("INSERT INTO trade (`user`, `to`, `item`, `quantity`) VALUES ('$user', '$row3[id]', '-1', '$money')");

}



$result1 = mysql_query("SELECT * FROM trade_ready WHERE `user1`='$user'");

$rows1 = mysql_num_rows($result1);

$row1 = mysql_fetch_array($result1);

if ($rows1 > 0){

	mysql_query("UPDATE trade_ready SET `ready1`='0', `ready2`='0', `fin`='0', `update2`='1' WHERE `user1`='$user'");

}else{

	$result2 = mysql_query("SELECT * FROM trade_ready WHERE `user2`='$user'");

	$rows2 = mysql_num_rows($result2);

	$row2 = mysql_fetch_array($result2);

	if ($rows2 > 0){

		mysql_query("UPDATE trade_ready SET `ready1`='0', `ready2`='0', `fin`='0', `update1`='1' WHERE `user2`='$user'");

	}else{

		mysql_query("INSERT INTO trade_ready (`user1`, `user2`, `ready1`, `ready2`, `update2`, `fin`) VALUES ('$user', '$row3[id]', '0', '0', '1', '0')");

	}

}

}

elseif ($opt == '4'){//delete trade

$trade = $_POST['trade'];

mysql_query("DELETE FROM trade WHERE id='$trade'");



$result1 = mysql_query("SELECT * FROM trade_ready WHERE `user1`='$user'");

$rows1 = mysql_num_rows($result1);

$row1 = mysql_fetch_array($result1);

if ($rows1 > 0){

	mysql_query("UPDATE trade_ready SET `ready1`='0', `ready2`='0', `fin`='0', `update2`='1' WHERE `user1`='$user'");

}else{

	$result2 = mysql_query("SELECT * FROM trade_ready WHERE `user2`='$user'");

	$rows2 = mysql_num_rows($result2);

	$row2 = mysql_fetch_array($result2);

	if ($rows2 > 0){

		mysql_query("UPDATE trade_ready SET `ready1`='0', `ready2`='0', `fin`='0', `update1`='1' WHERE `user2`='$user'");

	}else{

		mysql_query("INSERT INTO trade_ready (`user1`, `user2`, `ready1`, `ready2`, `update2`, `fin`) VALUES ('$user', '$row3[id]', '0', '0', '1', '0')");

	}

}

}

elseif ($opt == '5'){//leave trade

$result = mysql_query("SELECT * FROM trade WHERE user='$user'");

$rows = mysql_num_rows($result);

if ($rows > 0){

mysql_query("DELETE FROM trade WHERE user='$user'");

}

$result = mysql_query("SELECT * FROM trade WHERE to='$user'");

$rows = mysql_num_rows($result);

if ($rows > 0){

mysql_query("DELETE FROM trade WHERE to='$user'");

}

$result1 = mysql_query("SELECT * FROM trade_ready WHERE user1='$user' OR user2='$user'");

$rows1 = mysql_num_rows($result1);

if ($rows1 > 0){

mysql_query("DELETE FROM trade_ready WHERE user1='$user' OR user2='$user'");

}



mysql_query("INSERT INTO trade_chat (id_to, id_from, text) VALUES ('$row3[id]', '0', '0')");

}



