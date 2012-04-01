<?php



include ("db_connect.php");



$id = $_GET['id_item'];

$result = mysql_query("SELECT * FROM items_inventory WHERE id_item='$id'");

$rows = mysql_num_rows($result);

if ($rows > 0){

$row = mysql_fetch_array($result);

if ($row['weapon_items'] == "")

	$weapon_damage = '0';

else $weapon_damage = $row['weapon_items'];

echo $row['id_item']."~!".$row['name']."~!".$row['brutality']."~!".$row['accuracy']."~!".$row['fortitude']."~!".$row['attack']."~!".$row['defense']."~!".$row['health']."~!".$row['regen']."~!".$weapon_damage."~!".$row['price']."~!".$row['level']."~!".$row['description']."~!";

}else{

	echo "no";

}

?>