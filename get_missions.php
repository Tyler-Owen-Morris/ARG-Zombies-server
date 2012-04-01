<?php

include ("db_connect.php");

?>



<?php

$level=$_GET['level'];

$player_id=$_GET['player_id'];



$res_missions=mysql_query("SELECT * FROM missions WHERE level <= {$level} AND special_mission = 0");

if(mysql_num_rows($res_missions)>0)

while($row_mission=mysql_fetch_array($res_missions)){

//filtre de prereq si daca exista deja



//filtru daca exista

$row_check=mysql_query("SELECT * FROM mission_player WHERE mission_id = {$row_mission['id']} AND user_id = {$player_id}");

if(mysql_num_rows($row_check)==0){



//filtru de prereq

$prereqs=explode(";",$row_mission['prereq']);

$total=count($prereqs)-1;

$cont_check=0;

for($i=0;$i<count($prereqs)-1;$i++)

{

$row_check=mysql_query("SELECT * FROM mission_player WHERE mission_id = {$prereqs[$i]} AND user_id = {$player_id} AND completed = 1");

if(mysql_num_rows($row_check)>0)$cont_check++;

}

if($total==$cont_check){

echo $row_mission['id']."-";

echo $row_mission['name']."-";

echo $row_mission['obiectiv']."-";

echo $row_mission['cantitate']."-";

echo $row_mission['level']."-";

if($row_mission['reward']==1)echo "XP-";

if($row_mission['reward']==2)echo "Cash-";

if($row_mission['reward']==3)echo "Loot-";

echo $row_mission['reward_cantitate']."-{$row_mission['mission_cost']}-";

if(trim($row_mission['info'])=="")echo "No additional info-";

else echo $row_mission['info']."-";

echo $row_mission['specific_item']."<br />";

}}

}





?>