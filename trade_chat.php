<?php

include ("db_connect.php");

$to = $_POST['to'];

$id = $_POST['id'];

$text = mysql_real_escape_string($_POST['message']);

$result = mysql_query("SELECT * FROM users WHERE nick='$to'");

$row = mysql_fetch_array($result);

$rows = mysql_num_rows($result);

if ($rows > 0)

{

$result2 = mysql_query("SELECT * FROM users WHERE id='$id'");

$row2 = mysql_fetch_array($result2);

$read = 0;

mysql_query("INSERT INTO trade_chat (id_to, id_from, text) VALUES ('$row[id]', '$id', '$text')");

echo "mail sent";

}

else

{

echo "invalid user";

}

?>