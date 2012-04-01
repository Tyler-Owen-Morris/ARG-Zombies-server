<?php

include ("db_connect.php");

$user = $_POST['user'];

$item = $_POST['item'];

$quantity = $_POST['quantity'];



$result2 = mysql_query("SELECT * FROM items_inventory WHERE id_item='$item' AND slot !='7'");

$row2 = mysql_fetch_array($result2);

$rows2 = mysql_num_rows($result2);

if ($rows2 > 0){

	mysql_query("DELETE FROM items_on WHERE id_user='$user' AND id_item='$item' LIMIT 1");

	$result3 = mysql_query("SELECT * FROM home WHERE id_user = '$user'");

	$row3 = mysql_fetch_array($result3);

	$money += $row3['money'] + $row2['price'];

	//echo $money;

	mysql_query("UPDATE home SET money = '$money' WHERE id_user = '$user'");

	

}else{

	$result2 = mysql_query("SELECT * FROM items_inventory WHERE id_item='$item'");

	$row2 = mysql_fetch_array($result2);

	

	$result = mysql_query("SELECT * FROM items_on WHERE id_user='$user' AND id_item='$item'");

	$quant = 0;

	while ($row = mysql_fetch_array($result)){

		$quant += $row['quantity'];

	}

	$rest = $quant - $quantity;

	$money = $quantity*$row2['price'];

	

	$result3 = mysql_query("SELECT * FROM home WHERE id_user='$user'");

	$row3 = mysql_fetch_array($result3);

	$money1 = $row3['money'] + $money;

	mysql_query("UPDATE home SET money='$money1' WHERE id_user='$user'");

	

	$imp = (int)($rest/999);

	mysql_query("DELETE FROM items_on WHERE id_user='$user' AND id_item='$item'");

		if ($imp > 0){

			$i = 1;

			while($i <= $imp){

				mysql_query("INSERT INTO items_on (id_user, id_item, quantity, active) VALUES ('$user', '$item', '999', '0')");

				$i++;

			}

			$quantity2 = $rest - $imp*999;

			mysql_query("INSERT INTO items_on (id_user, id_item, quantity, active) VALUES ('$user', '$item', '$quantity2', '0')");

			

		}else{

			mysql_query("INSERT INTO items_on (id_user, id_item, quantity, active) VALUES ('$user', '$item', '$rest', '0')");

		}



}

	mysql_query("DELETE FROM items_on WHERE id_user='$user' AND quantity='0'");

?>