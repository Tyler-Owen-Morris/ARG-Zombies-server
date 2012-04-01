<?php

include ("db_connect.php");

?>



<?php

$mission_id=$_GET['mission_id'];

$player_id=$_GET['player_id'];

$procent=$_GET['procent'];



$res_missions=mysql_query("UPDATE mission_player SET procent = {$procent} WHERE mission_id = {$mission_id} AND user_id = {$player_id}") or die(mysql_error());





?>