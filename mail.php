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

mysql_query("INSERT INTO mail (id_to, id_from, text) VALUES ('$row[id]', '$id', '$text')");

$result2 = mysql_query("SELECT * FROM notification WHERE id_to='$row[id]'");

$rows2 = mysql_num_rows($result2);

if ($rows2 > 0){

	mysql_query("UPDATE notification SET id_from='0' mail_new='1' WHERE id_to='$row[id]'");

}else{

	mysql_query("INSERT INTO notification (id_to, id_from, mail_new) VALUES ('$row[id]', '0', '1')");

}

echo "mail sent";

}

else

{

echo "invalid user";

}

?>