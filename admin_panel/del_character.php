<?php

include("db_connect.php");

$res_del=mysql_query("DELETE FROM users WHERE id = {$_POST['user_id']}") or die(mysql_error());

$res_del=mysql_query("DELETE FROM user_desc WHERE id_user = {$_POST['user_id']}");

header('Location:characters.php');



?>