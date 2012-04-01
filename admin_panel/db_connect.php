<?php

//db_connect.php

$con = mysql_connect(localhost,"admin","z0m3ie!") or die(mysql_error());

$db = mysql_select_db("admin_mmo-iphone",$con);

//$con = mysql_connect(localhost,"root","") or die(mysql_error());

//$db = mysql_select_db("admin_mmo-iphone",$con);







?>