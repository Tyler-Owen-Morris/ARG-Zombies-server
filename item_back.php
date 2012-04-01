<?php

include ("db_connect.php");

if (isset($_GET['id_user']))

$id_user = $_GET['id_user'];

else

$id_user = 1;

if (isset($_GET['id_item']))

$id_item = $_GET['id_item'];

else

$id_item = 1;



$result2 = mysql_query("SELECT * FROM items_on WHERE id_user='$id_user' AND id_item !='0'");

$rows2 = mysql_num_rows($result2);



$result = mysql_query("SELECT * FROM items_inventory WHERE id_item='$id_item'");

$row = mysql_fetch_array($result);



$result1 = mysql_query("SELECT * FROM items_on WHERE id_item='$id_item' AND id_user='$id_user' AND active='0' AND quantity < 999");

$rows1 = mysql_num_rows($result1);

$row1 = mysql_fetch_array($result1);

if ($rows1 > 0){

	if ($row['slot'] == '7'){

			

				$quantity = $row1['quantity']+'1';

				mysql_query("UPDATE items_on SET quantity='$quantity' WHERE id='$row1[id]'");

				echo "yes";

			

	}else{

		if ($rows2 <= 14){

			mysql_query("INSERT INTO items_on (id_user, id_item, quantity, active) VALUES ('$id_user', '$id_item', '1', '0')");

			echo "yes";

		}else{

				echo "no";

			}

	}

	

}else{

	if ($row['slot'] == '7'){

			if ($rows2 <= 14){

				mysql_query("INSERT INTO items_on (id_user, id_item, quantity, active) VALUES ('$id_user', '$id_item', '1', '0')");

				echo "yes";

			}else{

				echo "no";

			}

	}else{

		if ($rows2 <= 14){

			mysql_query("INSERT INTO items_on (id_user, id_item, quantity, active) VALUES ('$id_user', '$id_item', '1', '0')");

			echo "yes";

		}else{

				echo "no";

			}

	}

}



?>