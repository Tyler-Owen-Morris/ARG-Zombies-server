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

if($_POST['pass']!="")

$res_insert=mysql_query("UPDATE admin_user SET name = '{$_POST['user_name']}', email ='{$_POST['email']}', pass = md5('{$_POST['pass']}'), active = ".intval($_POST['active'])."");



if($_POST['pass']=="")

$res_insert=mysql_query("UPDATE admin_user SET name = '{$_POST['user_name']}', email ='{$_POST['email']}', active = ".intval($_POST['active'])."");



$id=$_POST['user_id'];

$res_del=mysql_query("DELETE FROM admin_section_access WHERE user_id = {$id}");

for($i=1;$i<=7;$i++)

if(intval($_POST['sect_'.$i])==1)$res_insert=mysql_query("INSERT INTO admin_section_access (section_id,user_id) VALUES ({$i},{$id})");

header('Location:manage_users.php');

}

?>



<br><br><br>

<font style="color:#dedede;font-size:30px;font-weight:bold;">Manage Users: Edit User</font><br><br>

<hr style="color:black;width:500px;margin-left:0px;"><br>



<script>

$(function(){

$('#but_form').click(function(){

var go_sub=1;

if($('input[name="user_name"]').val()==""){alert("Name can`t be blank");go_sub=0;}

if($('input[name="email"]').val()==""){alert("Email can`t be blank");go_sub=0;}

//if($('input[name="pass"]').val()==""){alert("Password can`t be blank");go_sub=0;}

if(go_sub==1)$('#add_form').submit();

});

});

</script>



<?php

//get current user info

$res_user_edit=mysql_query("SELECT * FROM admin_user WHERE id = {$_POST['user_id']}");

$row_user_edit=mysql_fetch_array($res_user_edit);

?>



<table>

<form id="add_form" action="manage_users_edit.php" method="POST">

<tr><td>Name</td><td><input name="user_name" value="<?php echo $row_user_edit['name']; ?>"></td></tr>

<tr><td>Email</td><td><input name="email" value="<?php echo $row_user_edit['email']; ?>"></td></tr>

<tr><td>Password</td><td><input name="pass" type="password"><br>(leave password blank to not change it)</td></tr>

<tr><td>Active</td><td>Yes&nbsp;<input <?php if($row_user_edit['active']==1)echo "CHECKED"; ?> type="radio" name="active" value="1">&nbsp;No&nbsp;<input <?php if($row_user_edit['active']==0)echo "CHECKED"; ?> type="radio" name="active" value="0"></td></tr>

<tr><td colspan="2"><hr></td></tr>

<tr><td colspan="2" align="center">Permissions</td></tr>

<?php

$res_sect=mysql_query("SELECT * FROM admin_section");

$sections=get_access($_POST['user_id']);

while($row_sect=mysql_fetch_array($res_sect)){

echo "<tr>";

echo "<td>{$row_sect['name']}</td>";

echo "<td>";

echo "Yes&nbsp;<input type=\"radio\" name=\"sect_".$row_sect['id']."\" value=\"1\"  ";

if(in_array($row_sect['id'],$sections))echo "CHECKED";

echo ">";

echo "&nbsp;No&nbsp;<input type=\"radio\" name=\"sect_".$row_sect['id']."\" value=\"0\" ";

if(!in_array($row_sect['id'],$sections))echo "CHECKED";

echo ">";

echo "</td>";

echo "</tr>";

}

?>

<input type="hidden" name="user_id" value="<?php echo $_POST['user_id']; ?>">

<tr><td><input id="but_form" type="button" value="Edit user"></td><td>&nbsp;</td></tr>

</form>

</table>



</body>