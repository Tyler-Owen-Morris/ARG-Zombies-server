<?php

include ("db_connect.php");

if (isset($_POST['id_user']))

	$user = $_POST['id_user'];

if (isset($_POST['id_item']))

	$item = $_POST['id_item'];

if (isset($_POST['quantity']))

	$quantity = $_POST['quantity'];

$opt = $_POST['opt'];

$max_bank = 15;

$max_backpack = 15;



$result = mysql_query("SELECT * FROM items_inventory WHERE id_item='$item'");

$row = mysql_fetch_array($result);



if (isset($_POST['opt'])){

	if ($opt == '1'){//from backpack to bank

		if ($row['slot'] == '7'){

			$result2 = mysql_query("SELECT * FROM items_on WHERE id_item='$item' AND id_user='$user' AND active='0'");

			$quantity2 = 0;

			while ($row2 = mysql_fetch_array($result2)){

				$quantity2 += $row2['quantity'];

			}

			

		}

		$result3 = mysql_query("SELECT * FROM items_home WHERE id_user='$user' AND id_item !='0'");

		$rows3 = mysql_num_rows($result3);

		if ($rows3 < 15){

			if ($row['slot'] == '7'){

				$result4 = mysql_query("SELECT * FROM items_home WHERE id_item='$item' AND id_user='$user'");

				$quantity4 = 0;

				while ($row4 = mysql_fetch_array($result4)){

					$quantity4 += $row4['quantity'];

				}

				$quantity_total = $quantity4 + $quantity;

				//echo "quantity home ".$quantity_total.";";

				$imp = (int)($quantity_total/999);

						mysql_query("DELETE FROM items_home WHERE id_user='$user' AND id_item='$item'");

						if ($imp > 0){

							$i = 1;

							while($i <= $imp){

								mysql_query("INSERT INTO items_home (id_user, id_item, quantity) VALUES ('$user', '$item', '999')");

								$i++;

							}

							$quantity_after = $quantity_total - $imp*999;

							mysql_query("INSERT INTO items_home (id_user, id_item, quantity) VALUES ('$user', '$item', '$quantity_after')");

							

						}else{

							mysql_query("INSERT INTO items_home (id_user, id_item, quantity) VALUES ('$user', '$item', '$quantity_total')");

						}

				

				$quantity_total = $quantity2 - $quantity;

				//echo "quantity on ".$quantity_total.";";

				$imp = (int)($quantity_total/999);

						mysql_query("DELETE FROM items_on WHERE id_user='$user' AND id_item='$item' AND active='0'");

						if ($imp > 0){

							$i = 1;

							while($i <= $imp){

								mysql_query("INSERT INTO items_on (id_user, id_item, quantity) VALUES ('$user', '$item', '999')");

								$i++;

							}

							$quantity_after = $quantity_total - $imp*999;

							mysql_query("INSERT INTO items_on (id_user, id_item, quantity) VALUES ('$user', '$item', '$quantity_after')");

							

						}else{

							mysql_query("INSERT INTO items_on (id_user, id_item, quantity) VALUES ('$user', '$item', '$quantity_total')");

						}

				mysql_query("DELETE FROM items_on WHERE id_user='$user' AND id_item='$item' AND quantity='0'");

				mysql_query("DELETE FROM items_home WHERE id_user='$user' AND id_item='$item' AND quantity='0'");

			}else{

				mysql_query("INSERT INTO items_home (id_user, id_item, quantity) VALUES ('$user', '$item', '$quantity')");

				mysql_query("DELETE FROM items_on WHERE id_user='$user' AND id_item='$item' AND active='0' LIMIT 1");

			}

			echo "1";

		}else{

			echo "0";

		}

	}elseif ($opt == '2'){//from bank to backpack

		if ($row['slot'] == '7'){

			$result2 = mysql_query("SELECT * FROM items_home WHERE id_item='$item' AND id_user='$user'");

			$quantity2 = 0;

			while ($row2 = mysql_fetch_array($result2)){

				$quantity2 += $row2['quantity'];

			}

		}

		$result3 = mysql_query("SELECT * FROM items_on WHERE id_user='$user' AND id_item !='0' AND active='0'");

		$rows3 = mysql_num_rows($result3);

		if ($rows3 < 15){

			if ($row['slot'] == '7'){

				$result4 = mysql_query("SELECT * FROM items_on WHERE id_item='$item' AND id_user='$user' AND active='0'");

				$quantity4 = 0;

				while ($row4 = mysql_fetch_array($result4)){

					$quantity4 += $row4['quantity'];

				}

				$quantity_total = $quantity4 + $quantity;

				//echo "quantity on ".$quantity_total.";";

				$imp = (int)($quantity_total/999);

						mysql_query("DELETE FROM items_on WHERE id_user='$user' AND id_item='$item' AND active='0'");

						if ($imp > 0){

							$i = 1;

							while($i <= $imp){

								mysql_query("INSERT INTO items_on (id_user, id_item, quantity) VALUES ('$user', '$item', '999')");

								$i++;

							}

							$quantity_after = $quantity_total - $imp*999;

							mysql_query("INSERT INTO items_on (id_user, id_item, quantity) VALUES ('$user', '$item', '$quantity_after')");

							

						}else{

							mysql_query("INSERT INTO items_on (id_user, id_item, quantity) VALUES ('$user', '$item', '$quantity_total')");

						}

				

				$quantity_total = $quantity2 - $quantity;

				//echo "quantity on ".$quantity_total.";";

				$imp = (int)($quantity_total/999);

						mysql_query("DELETE FROM items_home WHERE id_user='$user' AND id_item='$item'");

						if ($imp > 0){

							$i = 1;

							while($i <= $imp){

								mysql_query("INSERT INTO items_home (id_user, id_item, quantity) VALUES ('$user', '$item', '999')");

								$i++;

							}

							$quantity_after = $quantity_total - $imp*999;

							mysql_query("INSERT INTO items_home (id_user, id_item, quantity) VALUES ('$user', '$item', '$quantity_after')");

							

						}else{

							mysql_query("INSERT INTO items_home (id_user, id_item, quantity) VALUES ('$user', '$item', '$quantity_total')");

						}

				mysql_query("DELETE FROM items_home WHERE id_user='$user' AND id_item='$item' AND quantity='0'");

				mysql_query("DELETE FROM items_on WHERE id_user='$user' AND id_item='$item' AND quantity='0'");

			}else{

				mysql_query("INSERT INTO items_on (id_user, id_item, quantity) VALUES ('$user', '$item', '$quantity')");

				mysql_query("DELETE FROM items_home WHERE id_user='$user' AND id_item='$item' LIMIT 1");

			}

			echo "1";

		}else{

			echo "0";

		}

	}

}else{

	echo "no option selected";

}

?>