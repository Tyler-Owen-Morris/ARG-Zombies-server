<?php
include ("db_connect.php");
if (isset($_GET['id_user']))
	$id_user = $_GET['id_user'];
else $id_user = 1;
if (isset($_GET['id_item']))
	$id_item = $_GET['id_item'];
else $id_item = 1;
if (isset($_GET['quantity']))
	$quantity = $_GET['quantity'];
else $quantity = 1;
//else $quantity = 0;
if (isset($_GET['exp']))
	$exp = $_GET['exp'];
else $exp = 24;
if (isset($_GET['price']))
	$price1 = $_GET['price'];
else $price1 = 1;

$result = mysql_query("SELECT * FROM items_inventory WHERE id_item='$id_item'");
$row = mysql_fetch_array($result);

$expire = strtotime("+$exp hours");

$price = $quantity*$price1;
	if ($row['slot'] == '7'){
					$result5 = mysql_query("SELECT * FROM items_on WHERE id_item='$id_item' AND id_user='$id_user' AND active='0'");
						$quantity1 = 0;
						while ($row5 = mysql_fetch_array($result5)){
							$quantity1 += $row5['quantity'];
						}
						$quantity2 = $quantity1 - $quantity;
						$imp = (int)($quantity2/999);
							mysql_query("DELETE FROM items_on WHERE id_user='$id_user' AND id_item='$id_item' AND active='0'");
							if ($imp > 0){
								$i = 1;
								while($i <= $imp){
									mysql_query("INSERT INTO items_on (id_user, id_item, quantity, active) VALUES ('$id_user', '$id_item', '999', '0')");
									$i++;
								}
								$quantity_after = $quantity2 - $imp*999;
								mysql_query("INSERT INTO items_on (id_user, id_item, quantity, active) VALUES ('$id_user', '$id_item', '$quantity_after', '0')");
								
							}else{
								mysql_query("INSERT INTO items_on (id_user, id_item, quantity, active) VALUES ('$id_user', '$id_item', '$quantity2', '0')");
							}

	}else{
		mysql_query("DELETE FROM items_on WHERE id_user='$id_user' AND id_item='$id_item' AND active='0' LIMIT 1");
	}
//mysql_query("UPDATE items_on SET quantity='$quantity1' WHERE id='$row[id]'") ;
mysql_query("INSERT INTO auction (id_user, id_item, quantity, price, exp) VALUES ('$id_user', '$id_item', '$quantity', $price, '$expire')");

mysql_query("DELETE FROM items_on WHERE id_user='$id_user' AND id_item='$id_item' AND quantity='0'");
?>