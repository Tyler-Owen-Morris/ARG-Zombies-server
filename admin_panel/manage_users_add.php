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



<?php

//add user

if(isset($_POST['user_name'])){

$res_insert=mysql_query("INSERT INTO admin_user (name,email,pass,active) VALUES ('{$_POST['user_name']}','{$_POST['email']}',md5('{$_POST['pass']}'),".intval($_POST['active']).")");

$id=mysql_insert_id();

for($i=1;$i<=7;$i++)

if(intval($_POST['sect_'.$i])==1)$res_insert=mysql_query("INSERT INTO admin_section_access (section_id,user_id) VALUES ({$i},{$id})");

header('Location:manage_users.php');

}

?>



<br><br><br>

<font style="color:#dedede;font-size:30px;font-weight:bold;">Manage Users: Add User</font><br><br>

<hr style="color:black;width:500px;margin-left:0px;"><br>



<script>

$(function(){

$('#but_form').click(function(){

var go_sub=1;

if($('input[name="user_name"]').val()==""){alert("Name can`t be blank");go_sub=0;}

if($('input[name="email"]').val()==""){alert("Email can`t be blank");go_sub=0;}

if($('input[name="pass"]').val()==""){alert("Password can`t be blank");go_sub=0;}

if(go_sub==1)$('#add_form').submit();

});

});

</script>



<table>

<form id="add_form" action="manage_users_add.php" method="POST">

<tr><td>Name</td><td><input name="user_name"></td></tr>

<tr><td>Email</td><td><input name="email"></td></tr>

<tr><td>Password</td><td><input name="pass" type="password"></td></tr>

<tr><td>Active</td><td>Yes&nbsp;<input CHECKED type="radio" name="active" value="1">&nbsp;No&nbsp;<input type="radio" name="active" value="0"></td></tr>

<tr><td colspan="2"><hr></td></tr>

<tr><td colspan="2" align="center">Permissions</td></tr>

<?php

$res_sect=mysql_query("SELECT * FROM admin_section");

while($row_sect=mysql_fetch_array($res_sect)){

echo "<tr>";

echo "<td>{$row_sect['name']}</td>";

echo "<td>";

echo "Yes&nbsp;<input type=\"radio\" name=\"sect_".$row_sect['id']."\" value=\"1\">";

echo "&nbsp;No&nbsp;<input type=\"radio\" name=\"sect_".$row_sect['id']."\" value=\"0\" CHECKED>";

echo "</td>";

echo "</tr>";

}

?>

<tr><td><input id="but_form" type="button" value="Add user"></td><td>&nbsp;</td></tr>

</form>

</table>



</body>