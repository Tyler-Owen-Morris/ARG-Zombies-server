<?php session_start();

if(!isset($_SESSION['super_user']))header('Location:login.php');

?>





<head>

<script src="js/jquery-1.7.1.min.js"></script>

</head>

<body style="background-color:#ababab;">

<a href="logout.php">Logout</a><br><br>

<?php

include("db_connect.php");

include("functions.php");

include("menu.php");

?>



<br><br><br>

<font style="color:#dedede;font-size:30px;font-weight:bold;">Manage Users</font><br><br>

<hr style="color:black;width:500px;margin-left:0px;"><br>

<input type="button" value="Add user" onclick="window.location.href='manage_users_add.php'">

<br><br>



<table style="background-color:black;">

<tr><th style="background-color:#dedede;">Name</th><th style="background-color:#dedede;">Email</th><th style="background-color:#dedede;">Access</th><th>&nbsp;</th><th>&nbsp;</th></tr>

<?php

$res_users=mysql_query("SELECT * FROM admin_user");

while($row_users=mysql_fetch_array($res_users)){

echo "<tr>";

echo "<td style=\"background-color:#dedede;\">{$row_users['name']}</td>";

echo "<td style=\"background-color:#dedede;\">{$row_users['email']}</td>";

echo "<td style=\"background-color:#dedede;\">";

$res_access=mysql_query("SELECT * FROM admin_section_access WHERE user_id = {$row_users['id']} ORDER BY section_id");

while($row_access=mysql_fetch_array($res_access)){

$res_section=mysql_query("SELECT * FROM admin_section WHERE id = {$row_access['section_id']}");

$row_section=mysql_fetch_array($res_section);

echo "-{$row_section['name']}<br>";

}

echo "</td>";

echo "<td style=\"background-color:#dedede;\"><form action=\"manage_users_edit.php\" method=\"POST\"><input type=\"hidden\" name=\"user_id\" value=\"{$row_users['id']}\"><input type=\"submit\" value=\"Edit\"></form></td>";

echo "<td style=\"background-color:#dedede;\"><form action=\"manage_users_delete.php\" method=\"POST\"><input type=\"hidden\" name=\"user_id\" value=\"{$row_users['id']}\"><input onclick=\"return confirm('Are you sure you want to delete user?');\" type=\"submit\" value=\"Delete\"></form></td>";

echo "</tr>";

}

?>

</table>

</body>