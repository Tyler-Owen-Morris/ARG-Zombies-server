<?php

include ("db_connect.php");

$log = $_POST['log'];

mysql_query("INSERT INTO logs (log) VALUES ('$log')");

?>