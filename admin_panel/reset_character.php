<?php



include("db_connect.php");



$res_info=mysql_query("SELECT * FROM user_desc WHERE id_user = {$_POST['user_id']}");

$row_info=mysql_fetch_array($res_info);

$level=intval($row_info['level']);

if($row_info['level']>50)$level=50;

$weapon=$row_info['weapon'];

$attack=0;





$res_stats=mysql_query("SELECT * FROM player_xp WHERE level = {$level}");

$row_stat=mysql_fetch_array($res_stats);



$fort=intval($row_stat['fort']);

$hp=100+($fort-10)*5+($level-1)*10;

$en=50+($level-1)*5;

$ev=floatval($level)/10.0+floatval($row_stat['def'])/2.0;



if($weapon==0)$attack=$level+$row_stat['acc']+$row_stat['brut'];

else{

$res_w=mysql_query("SELECT * FROM items_inventory WHERE id_item = {$weapon}");

$row_w=mysql_fetch_array($res_w);

$bucati=explode("-",$row_w['weapon_items']);

if(count($bucati)==3){if($bucati[2]=="M")$attack=$level+$row_stat['brut']*2;

                     if($bucati[2]=="R")$attack=$level+$row_stat['acc']*2;

                      }

}



$res_update=mysql_query("UPDATE user_desc SET brutality = {$row_stat['brut']}, accuracy = {$row_stat['acc']}, energy = {$en}, defense = {$row_stat['def']}, fortitude = {$row_stat['fort']}, hp = {$hp}, evasion = {$ev}, attack = {$attack}, experience = {$row_stat['xp']} WHERE id_user = {$_POST['user_id']}");



header('Location:characters.php');



?>