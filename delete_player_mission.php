<?php

include ("db_connect.php");

?>



<?php

$player_id=$_GET['player_id'];

$mission_id=$_GET['mission_id'];

$result=mysql_query("DELETE FROM mission_player WHERE user_id = {$player_id} AND mission_id = {$mission_id}");





?>