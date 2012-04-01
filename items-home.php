<?php

include ("db_connect.php");

$id = $_GET['id'];



$sql = "SELECT * FROM items_home WHERE id_user = '$id'";

$result = mysql_query($sql) or die ($sql);

$rows = mysql_num_rows($result);

if ($rows > 0){

$sql1 = "SELECT * FROM items_home WHERE id_user='$id' AND  id_item!='0'";

$result1 = mysql_query($sql1) or die ($sql1);

$rows1 = mysql_num_rows($result1);

if ($rows1 > 0){

echo $rows1."<br />";

while ($row1 = mysql_fetch_array($result1)){

	$result2 = mysql_query("SELECT * FROM items_inventory WHERE id_item = $row1[id_item]");

	$row2 = mysql_fetch_array($result2);

	if ($row2['name'] !="")

		$name = $row2['name'];

	else $name = '0';

	if ($row2['brutality'] !="")

		$brutality = $row2['brutality'];

	else $brutality = '0';

	if ($row2['accuracy'] !="")

		$accuracy = $row2['accuracy'];

	else $accuracy = '0';

	if ($row2['fortitude'] !="")

		$fortitude = $row2['fortitude'];

	else $fortitude = '0';

	if ($row2['attack'] !="")

		$attack = $row2['attack'];

	else $attack = '0';

	if ($row2['defense'] !="")

		$defense = $row2['defense'];

	else $defense = '0';

	if ($row2['health'] !="")

		$health = $row2['health'];

	else $health = '0';

	if ($row2['regen'] !="")

		$regen = $row2['regen'];

	else $regen = '0';

	if ($row2['duration'] !="")

		$duration = $row2['duration'];

	else $duration = '0';

	if ($row2['slot'] !="")

		$slot = $row2['slot'];

	else $slot = '0';

	if ($row2['craft'] !="")

		$craft = $row2['craft'];

	else $craft = '0';

	if ($row2['craft_items'] !="")

		$craft_items = $row2['craft_items'];

	else $craft_items = '0';

	if ($row2['weapon_items'] !="")

		$weapon_items = $row2['weapon_items'];

	else $weapon_items = '0';

	if ($row2['price'] !="")

		$price = $row2['price'];

	else $price = '0';

	if ($row2['level'] !="")

		$level = $row2['level'];

	else $level = '0';

	

	echo $row1['id_item'].":".$row1['quantity'].":".$row1['active'].":".$name.":".$brutality.":".$accuracy.":".$fortitude.":".$attack.":".

	$defense.":".$health.":".$regen.":".$duration.":".$slot.":".$craft.":".$craft_items.":".$weapon_items.":".$price.":".$level."<br />";

}

}else{

	echo $rows1;

}

}else{

	echo "0";

}

?>