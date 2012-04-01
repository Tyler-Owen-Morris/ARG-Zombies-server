<?php

include ("db_connect.php");

if (isset($_GET['id_mob']))

$id_mobs = $_GET['id_mob'];

else

$id_mobs = 1;

if (isset($_GET['id_user']))

$id_user = $_GET['id_user'];

else

$id_user = 1;



$result = mysql_query("SELECT * FROM mobs_desc WHERE id = '$id_mobs'");

$rows = mysql_num_rows($result);

if ($rows > 0){

$row = mysql_fetch_array($result);

	

	$loot2 = explode(";", $row['loot']);

	//print_r($loot2);

	$loot_1=array_rand($loot2);

	

	$result2 = mysql_query("SELECT * FROM loot WHERE value='$loot2[$loot_1]'");

	$rows2 = mysql_num_rows($result2);

	if ($rows2 > 0){

	

	while ($row2 = mysql_fetch_array($result2)){

		$items[] = $row2['item'];

	}

	$item = array_rand($items);

	echo $items[$item]."<br />";

	$result3 = mysql_query("SELECT * FROM items_inventory WHERE id_item='$items[$item]'");

	$row3 = mysql_fetch_array($result3);

	echo $row3['name']."<br />";

$money = explode("-", $row['money']);

$money1 = rand((int)$money[0], (int)$money[1]);

echo $money1."<br />";

echo $row['xp']."<br />";



$result4 = mysql_query("SELECT * FROM home WHERE id_user='$id_user'");

$row4 = mysql_fetch_array($result4);

$money2 = $row4['money'] + $money1;

//mysql_query("UPDATE home SET money='$money2' WHERE id_user='$id_user'");



$result4 = mysql_query("SELECT * FROM items_on WHERE id_user='$id_user' AND id_item !='0' AND active='0'");

$rows4 = mysql_num_rows($result4);



$result5 = mysql_query("SELECT * FROM items_inventory WHERE id_item='$items[$item]'");

$row5 = mysql_fetch_array($result5);

/*

$result6 = mysql_query("SELECT * FROM items_on WHERE id_item='$items[$item]' AND id_user='$id_user' AND active='0' AND quantity < 999");

$rows6 = mysql_num_rows($result6);

$row6 = mysql_fetch_array($result6);

if ($rows6 > 0){

	if ($row5['slot'] == '7'){

			

				$quantity = $row6['quantity']+'1';

				mysql_query("UPDATE items_on SET quantity='$quantity' WHERE id='$row6[id]'");

				

			

	}else{

		if ($rows4 <= 14){

			mysql_query("INSERT INTO items_on (id_user, id_item, quantity, active) VALUES ('$id_user', '$items[$item]', '1', '0')");

			

		}else{

				

			}

	}

	

}else{

	if ($row5['slot'] == '7'){

			if ($rows4 <= 14){

				mysql_query("INSERT INTO items_on (id_user, id_item, quantity, active) VALUES ('$id_user', '$items[$item]', '1', '0')");

				

			}else{

				

			}

	}else{

		if ($rows4 <= 14){

			mysql_query("INSERT INTO items_on (id_user, id_item, quantity, active) VALUES ('$id_user', '$items[$item]', '1', '0')");

			

		}else{

				

			}

	}

}*/

}else{

	echo "No loot pack for this mob!";

}

}else

	echo "Invalid mob ID!";

?>