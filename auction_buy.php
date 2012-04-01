<?php
include ("db_connect.php");
if (isset($_GET['id_user']))
	$id_user = $_GET['id_user'];
else $id_user = 1;
if (isset($_GET['auction']))
	$id_auction = $_GET['auction'];
else $id_auction = 1;
$result = mysql_query("SELECT * FROM auction WHERE id='$id_auction'");
$rows = mysql_num_rows($result);
if ($rows > 0){
$row = mysql_fetch_array($result);


	//$quantity_after = 999 - $row['quantity'];
	$quantity_rest = 999 - $row['quantity'];
$result1 = mysql_query("SELECT * FROM items_on WHERE id_item='$row[id_item]' AND id_user='$id_user' AND active='0' AND quantity BETWEEN '$quantity_rest' AND '999'");
$rows1 = mysql_num_rows($result1);
$row1 = mysql_fetch_array($result1);

	$result6 = mysql_query("SELECT * FROM items_inventory WHERE id_item='$row[id_item]'");
	$row6 = mysql_fetch_array($result6);

if ($rows1 > 0){


	if ($row6['slot'] == '7'){
							
				$result2 = mysql_query("SELECT * FROM home WHERE id_user = '$id_user' AND money > $row[price]");
				$rows2 = mysql_num_rows($result2);
				if ($rows2 > 0){
					$row2 = mysql_fetch_array($result2);
					$money = $row2['money']-$row['price'];
					mysql_query("UPDATE home SET money = '$money' WHERE id_user='$id_user'");
					$result3 = mysql_query("SELECT * FROM home WHERE id_user='$row[id_user]'");
					$row3 = mysql_fetch_array($result3);
					$money2 = $row3['money'] + $row['price'];
					mysql_query("UPDATE home SET money = '$money2' WHERE id_user='$row3[id_user]'");
					
					$quantity = $row1['quantity']+$row['quantity'];
					//echo $quantity;
					
					$result5 = mysql_query("SELECT * FROM items_on WHERE id_item='$row[id_item]' AND id_user='$id_user' AND active='0'");
					$quantity = 0;
					while ($row5 = mysql_fetch_array($result5)){
						$quantity += $row5['quantity'];
					}
					$quantity2 = $quantity + $row['quantity'];
					$imp = (int)($quantity2/999);
						mysql_query("DELETE FROM items_on WHERE id_user='$id_user' AND id_item='$row[id_item]' AND active='0'");
						if ($imp > 0){
							$i = 1;
							while($i <= $imp){
								mysql_query("INSERT INTO items_on (id_user, id_item, quantity, active) VALUES ('$id_user', '$row[id_item]', '999', '0')");
								$i++;
							}
							$quantity_after = $quantity2 - $imp*999;
							mysql_query("INSERT INTO items_on (id_user, id_item, quantity, active) VALUES ('$id_user', '$row[id_item]', '$quantity_after', '0')");
							
						}else{
							mysql_query("INSERT INTO items_on (id_user, id_item, quantity, active) VALUES ('$id_user', '$row[id_item]', '$quantity2', '0')");
						}
					
					//mysql_query("UPDATE items_on SET quantity='$quantity' WHERE id='$row1[id]'");
					
					mysql_query("DELETE FROM auction WHERE id='$id_auction'");
					echo "yes1";
				}else{
					echo "no money";
				}
	}else{
		if ($rows2 < 15){
		
			$result2 = mysql_query("SELECT * FROM home WHERE id_user = '$id_user' AND money > $row[price]");
				$rows2 = mysql_num_rows($result2);
				if ($rows2 > 0){
					$row2 = mysql_fetch_array($result2);
					$money = $row2['money']-$row['price'];
					mysql_query("UPDATE home SET money = '$money' WHERE id_user='$id_user'");
					$result3 = mysql_query("SELECT * FROM home WHERE id_user='$row[id_user]'");
					$row3 = mysql_fetch_array($result3);
					$money2 = $row3['money'] + $row['price'];
					mysql_query("UPDATE home SET money = '$money2' WHERE id_user='$row3[id_user]'");
					
					mysql_query("INSERT INTO items_on (id_user, id_item, quantity, active) VALUES ('$id_user', '$row[id_item]', '$row[quantity]', '0')");
					
					mysql_query("DELETE FROM auction WHERE id='$id_auction'");
					echo "yes2";
				}else{
					echo "no money";
				}
		}else{
				echo "no2";
			}
	}
	
}else{
	if ($row6['slot'] == '7'){
	
				$result2 = mysql_query("SELECT * FROM home WHERE id_user = '$id_user' AND money > $row[price]");
				$rows2 = mysql_num_rows($result2);
				if ($rows2 > 0){
					$row2 = mysql_fetch_array($result2);
					$money = $row2['money']-$row['price'];
					mysql_query("UPDATE home SET money = '$money' WHERE id_user='$id_user'");
					$result3 = mysql_query("SELECT * FROM home WHERE id_user='$row[id_user]'");
					$row3 = mysql_fetch_array($result3);
					$money2 = $row3['money'] + $row['price'];
					mysql_query("UPDATE home SET money = '$money2' WHERE id_user='$row3[id_user]'");
					
					$result5 = mysql_query("SELECT * FROM items_on WHERE id_item='$row[id_item]' AND id_user='$id_user' AND active='0'");
					$quantity = 0;
					while ($row5 = mysql_fetch_array($result5)){
						$quantity += $row5['quantity'];
					}
					$quantity2 = $quantity + $row['quantity'];
					$imp = (int)($quantity2/999);
						mysql_query("DELETE FROM items_on WHERE id_user='$id_user' AND id_item='$row[id_item]' AND active='0'");
						if ($imp > 0){
							$i = 1;
							while($i <= $imp){
								mysql_query("INSERT INTO items_on (id_user, id_item, quantity, active) VALUES ('$id_user', '$row[id_item]', '999', '0')");
								$i++;
							}
							$quantity_after = $quantity2 - $imp*999;
							mysql_query("INSERT INTO items_on (id_user, id_item, quantity, active) VALUES ('$id_user', '$row[id_item]', '$quantity_after', '0')");
							
						}else{
							mysql_query("INSERT INTO items_on (id_user, id_item, quantity, active) VALUES ('$id_user', '$row[id_item]', '$quantity2', '0')");
						}
					echo "yes3";
					mysql_query("DELETE FROM auction WHERE id='$id_auction'");
				}else{
					echo "no money";
				}
	
		
	}else{
		if ($rows2 < 15){
		
				$result2 = mysql_query("SELECT * FROM home WHERE id_user = '$id_user' AND money > $row[price]");
				$rows2 = mysql_num_rows($result2);
				if ($rows2 > 0){
					$row2 = mysql_fetch_array($result2);
					$money = $row2['money']-$row['price'];
					mysql_query("UPDATE home SET money = '$money' WHERE id_user='$id_user'");
					$result3 = mysql_query("SELECT * FROM home WHERE id_user='$row[id_user]'");
					$row3 = mysql_fetch_array($result3);
					$money2 = $row3['money'] + $row['price'];
					mysql_query("UPDATE home SET money = '$money2' WHERE id_user='$row3[id_user]'");
					
					mysql_query("INSERT INTO items_on (id_user, id_item, quantity, active) VALUES ('$id_user', '$row[id_item]', '$row[quantity]', '0')");
					echo "yes4";
					
					mysql_query("DELETE FROM auction WHERE id='$id_auction'");

				}else{
					echo "no money";
				}

		}else{
				echo "no4";
			}
	}
}
}else{
	echo "no";
}
?>