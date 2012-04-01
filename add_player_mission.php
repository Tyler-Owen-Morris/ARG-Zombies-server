<?php

include ("db_connect.php");

?>



<?php

$level=$_GET['level'];

$player_id=$_GET['player_id'];



$res_missions=mysql_query("SELECT * FROM missions WHERE level = {$level}");

if(mysql_num_rows($res_missions)>0)

while($row_missions=mysql_fetch_array($res_missions)){

$result_check=mysql_query("SELECT * FROM mission_player WHERE mission_id = {$row_missions['id']} AND user_id = {$player_id}");

if(mysql_num_rows($result_check)==0)$result=mysql_query("INSERT INTO mission_player (mission_id,user_id,procent) VALUES ({$row_missions['id']},{$player_id},0.00)");

}



?>