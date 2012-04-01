<?php
include ("db_connect.php");
if (isset($_GET['id']))
$id_mobs = $_GET['id'];
else
$id_mobs = 1;
$min = $_GET['mob_level_min'];
$max = $_GET['mob_level_max'];

if( is_numeric($id_mobs) )
{
	$sql = "SELECT * FROM mobs_desc WHERE id = '$id_mobs'";	
}
else
{
	$sql = "SELECT * FROM mobs_desc WHERE name = '$id_mobs'";
}

$result = mysql_query($sql) or die ($sql);
$rows = mysql_num_rows($result);
if ($rows > 0 ){
$row = mysql_fetch_array($result);
echo $row['name']."<br />";
echo $row['hp']."<br />";
echo $row['energy']."<br />";
echo $row['regen']."<br />";
echo $row['defense']."<br />";
$attack = explode("-", $row['attack']);
$attack_min = $attack[0];
echo $attack_min;
echo "<br />";
$attack_max = $attack[1];
if ($attack_max != "")
	echo $attack_max;
else
	echo $attack_min;
echo "<br />";
echo $row['evasion']."<br />";
echo $row['cooldown']."<br />";
$level = explode("-", $row['level']);
$level_min = $level[0];
$level_max = $level[1];
$level_show = rand($level_min, $level_max);
echo $level_show."<br />";
echo $row['id']."<br />";
echo $row['model_name']."<br />";
}else{
echo "Invalid mob ID";
}
?>