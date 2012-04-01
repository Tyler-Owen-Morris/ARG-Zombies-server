<?php

include ("db_connect.php");



if (isset($_GET['id_user']))

	$id_user = $_GET['id_user'];

else $id_user = 1;

if (isset($_GET['auction']))

	$id_auction = $_GET['auction'];

else $id_auction = 1;

//opt=1 => sell to vendor

//opt=2 => backpack

//opt=3 => resell

$date = strtotime("now");

//echo $date;

	$result = mysql_query("SELECT * FROM auction WHERE quantity='0'");

	$rows = mysql_num_rows($result);

	if ($rows > 0){

		$row = mysql_fetch_array($result);

		mysql_query("DELETE FROM auction WHERE id='$row[id]'");

	}else{}



if(!isset($_GET['opt'])){

$result = mysql_query("SELECT * FROM auction WHERE id_user='$id_user'");

$rows = mysql_num_rows($result);

if ($rows > 0){

while ($row = mysql_fetch_array($result)){

	$date1 = 24*3600;

	$date2 = $row['exp']+$date1;

	if ($date2 > $date)

	{

		if ($row['exp'] > $date){

			

		}else{

			$result2 = mysql_query("SELECT * FROM items_inventory WHERE id_item='$row[id_item]'");

			$row2 = mysql_fetch_array($result2);

			$price = $row['price']/$row['quantity'];

			$date1 = date("d-m-Y H:i", $date2);

			echo $row['id'].";".$row['id_item'].";".$row2['name'].";".$row['quantity'].";".$price.";".$date1.";0<br />";

		}

	}else{

		$result2 = mysql_query("SELECT * FROM items_inventory WHERE id_item='$row[id_item]'");

		$row2 = mysql_fetch_array($result2);

		

		$result3 = mysql_query("SELECT * FROM home WHERE id_user='$row[id_user]'");

		$row3 = mysql_fetch_array($result3);

		

		$value = $row2['price']*$row['quantity'];

		$money = $row3['money'] + $value;

		mysql_query("UPDATE home SET money='$money' WHERE id_user='$row[id_user]'");

		mysql_query("DELETE FROM auction WHERE id='$row[id]'");

		

	}



}

}

}elseif (isset($_GET['opt']))

{

	$opt = $_GET['opt'];

	if ($opt == '1'){ // sell to vendor

		$result = mysql_query("SELECT * FROM auction WHERE id='$id_auction'");

		$row = mysql_fetch_array($result);

		

		$result2 = mysql_query("SELECT * FROM items_inventory WHERE id_item='$row[id_item]'");

		$row2 = mysql_fetch_array($result2);

			

		$result3 = mysql_query("SELECT * FROM home WHERE id_user='$row[id_user]'");

		$row3 = mysql_fetch_array($result3);

			

		$value = $row2['price']*$row['quantity'];

		$money = $row3['money'] + $value;

		mysql_query("UPDATE home SET money='$money' WHERE id_user='$row[id_user]'");

		mysql_query("DELETE FROM auction WHERE id='$id_auction'");

		echo "1 item sold!";

	}elseif ($opt == '2'){ // backpack

		$result0 = mysql_query("SELECT * FROM auction WHERE id='$id_auction'");

		$row0 = mysql_fetch_array($result0);

	

		$result2 = mysql_query("SELECT * FROM items_on WHERE id_user='$id_user' AND id_item !='0'");

		$rows2 = mysql_num_rows($result2);



		$result = mysql_query("SELECT * FROM items_inventory WHERE id_item='$row0[id_item]'");

		$row = mysql_fetch_array($result);

		

		$q = 999 - $row0['quantity'];

		$result1 = mysql_query("SELECT * FROM items_on WHERE id_item='$row0[id_item]' AND id_user='$id_user' AND active='0' AND quantity <= '$q'");

		$rows1 = mysql_num_rows($result1);

		$row1 = mysql_fetch_array($result1);

		if ($rows1 > 0){

			if ($row['slot'] == '7'){

					

						$quantity = $row1['quantity'] + $row0['quantity'];

						mysql_query("UPDATE items_on SET quantity='$quantity' WHERE id='$row1[id]'");

						mysql_query("DELETE FROM auction WHERE id='$id_auction'");

						echo "yes1";

					

			}else{

				if ($rows2 < 15){

					mysql_query("INSERT INTO items_on (id_user, id_item, quantity, active) VALUES ('$id_user', '$row0[id_item]', '$row0[quantity]', '0')");

					mysql_query("DELETE FROM auction WHERE id='$id_auction'");

					echo "yes2";

				}else{

						echo "no2";

					}

			}

			

		}else{

			if ($row['slot'] == '7'){

					if ($rows2 < 15){

						

						$result5 = mysql_query("SELECT * FROM items_on WHERE id_item='$row0[id_item]' AND id_user='$id_user' AND active='0'");

						$quantity = 0;

						while ($row5 = mysql_fetch_array($result5)){

							$quantity += $row5['quantity'];

						}

						$quantity2 = $quantity + $row0['quantity'];

						$imp = (int)($quantity2/999);

							mysql_query("DELETE FROM items_on WHERE id_user='$id_user' AND id_item='$row0[id_item]' AND active='0'");

							if ($imp > 0){

								$i = 1;

								while($i <= $imp){

									mysql_query("INSERT INTO items_on (id_user, id_item, quantity, active) VALUES ('$id_user', '$row0[id_item]', '999', '0')");

									$i++;

								}

								$quantity_after = $quantity2 - $imp*999;

								mysql_query("INSERT INTO items_on (id_user, id_item, quantity, active) VALUES ('$id_user', '$row0[id_item]', '$quantity_after', '0')");

								

							}else{

								mysql_query("INSERT INTO items_on (id_user, id_item, quantity, active) VALUES ('$id_user', '$row0[id_item]', '$quantity2', '0')");

							}

						

						/*$result1 = mysql_query("SELECT * FROM items_on WHERE id_item='$row0[id_item]' AND id_user='$id_user' AND active='0' AND quantity BETWEEN '$q' AND '999'");

						$row1 = mysql_fetch_array($result1);



						$quantity = $row0['quantity'] + $row1['quantity'];	



						mysql_query("UPDATE items_on SET quantity='999' WHERE id='$row1[id]'");

						mysql_query("INSERT INTO items_on (id_user, id_item, quantity, active) VALUES ('$id_user', '$row0[id_item]', '$quantity', '0')");*/

						mysql_query("DELETE FROM auction WHERE id='$id_auction'");

						echo "yes3";

					}else{

						echo "no3";

					}

			}else{

				if ($rows2 < 15){

					mysql_query("INSERT INTO items_on (id_user, id_item, quantity, active) VALUES ('$id_user', '$row0[id_item]', '$row0[quantity]', '0')");

					mysql_query("DELETE FROM auction WHERE id='$id_auction'");

					echo "yes4";

				}else{

						echo "no4";

					}

			}

		}

		

	}elseif ($opt == '3'){ // resell

		if (isset($_GET['quantity']))

			$quantity = $_GET['quantity'];

		else $quantity = 1;

		if (isset($_GET['exp']))

			$exp = $_GET['exp'];

		else $exp = 24;

		if (isset($_GET['price']))

			$price1 = $_GET['price'];

		else $price1 = 1;

		

		$expire = strtotime("+$exp hours");

		

		$result = mysql_query("SELECT * FROM auction WHERE id='$id_auction'");

		$row = mysql_fetch_array($result);

		$price = $quantity*$price1;

		$quantity1 = $row['quantity']-$quantity;

		

		$price3 = $row['price']/$row['quantity'];

		$price2 = $price3*$quantity1;

		

		mysql_query("UPDATE auction SET quantity='$quantity1', price='$price2' WHERE id='$id_auction'");

		mysql_query("INSERT INTO auction (id_user, id_item, quantity, price, exp) VALUES ('$id_user', '$row[id_item]', '$quantity', $price, '$expire')");

		

		

	}

}



?>