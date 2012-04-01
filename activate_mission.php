<?php

include ("db_connect.php");

?>



<?php

$player_id=$_GET['player_id'];

$mission_id=$_GET['mission_id'];



$result_check=mysql_query("SELECT * FROM mission_player WHERE mission_id = {$mission_id} AND user_id = {$player_id}");

if(mysql_num_rows($result_check)==0)$result=mysql_query("INSERT INTO mission_player (mission_id,user_id,procent) VALUES ({$mission_id},{$player_id},0.00)");





?>