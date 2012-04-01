<?php
include ("db_connect.php");
$date = strtotime("now");
$result = mysql_query("SELECT * FROM auction WHERE exp > '$date'");
while ($row = mysql_fetch_array($result)){
	$result2 = mysql_query("SELECT * FROM items_inventory WHERE id_item='$row[id_item]'");
	$row2 = mysql_fetch_array($result2);
	$date1 = date("d-m-Y H:i", $row['exp']);
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
		if ($row2['weapon_items'] !="")
			$weapon_items = $row2['weapon_items'];
		else $weapon_items = '0';
		if ($row2['level'] !="")
			$level = $row2['level'];
		else $level = '0';
	echo $row['id'].";".$row['id_item'].";".$row2['name'].";".$brutality.";".$accuracy.";".$fortitude.";".$attack.";".
		$defense.";".$health.";".$regen.";".$duration.";".$weapon_items.";".$level.";".$row['price'].";".$row['quantity'].";".$date1."<br />";
}
?>