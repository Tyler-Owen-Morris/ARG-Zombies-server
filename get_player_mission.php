<?php

include ("db_connect.php");

?>



<?php

$player_id=$_GET['player_id'];



$res_missions=mysql_query("SELECT * FROM mission_player WHERE user_id = {$player_id}");

if(mysql_num_rows($res_missions)>0)

while($row_mission=mysql_fetch_array($res_missions)){

$res_miss=mysql_query("SELECT * FROM missions WHERE id = {$row_mission['mission_id']}");

$row_missions=mysql_fetch_array($res_miss);

echo $row_missions['id']."-";

echo $row_missions['name']."-";

echo $row_missions['obiectiv']."-";

echo $row_missions['cantitate']."-";

echo $row_missions['level']."-";

if($row_missions['reward']==1)echo "XP-";

if($row_missions['reward']==2)echo "Cash-";

if($row_missions['reward']==3)echo "Loot-";

echo $row_missions['reward_cantitate']."-";

echo $row_mission['procent']."<br />";

}





?>