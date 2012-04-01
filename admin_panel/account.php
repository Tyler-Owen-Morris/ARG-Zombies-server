<?php session_start();

if(!isset($_SESSION['user']))header('Location:login.php');



include("db_connect.php");

include("functions.php");

$sections=get_access($_SESSION['id']);

if(!in_array(1,$sections)){

echo "<br><br>You do not have access here!";

}

else{

//page content here

?>

<head>

<script src="js/jquery-1.7.1.min.js"></script>

</head>

<body style="background-color:#ababab;">

<a href="logout.php">Logout</a><br><br>

<?php

include("menu.php");





?>

<?php

//if changes are made

if(isset($_POST['user_name'])){

$res_update=mysql_query("UPDATE admin_user SET name = '{$_POST['user_name']}', email = '{$_POST['email']}' WHERE id = {$_SESSION['id']}");

$_SESSION['user']=$_POST['user_name'];

$_SESSION['email']=$_POST['email'];

}

?>



<br><br><br>

<font style="color:#dedede;font-size:30px;font-weight:bold;">My Account</font><br><br>

<hr style="color:black;width:500px;margin-left:0px;"><br><br>



<?php

//get user info

$res_info=mysql_query("SELECT * FROM admin_user WHERE id = {$_SESSION['id']}");

$row_info=mysql_fetch_array($res_info);

?>



<table>

<form id="form_details" action="account.php" method="POST">

<tr><td>Screen Name</td><td><input style="border:1px solid black;" name="user_name" value="<?php echo $row_info['name']; ?>"></td></tr>

<tr><td>Email</td><td><input style="border:1px solid black;" name="email" value="<?php echo $row_info['email']; ?>"></td></tr>

</form>

</table>

<br><br>

<font>Change password</font><br><br>



<div style="background-color:#dedede;width:400px;height:150px;border:1px solid black;">

<?php

//change pass if old one correct

if(isset($_POST['old_pass'])){

$res_check_old=mysql_query("SELECT * FROM admin_user WHERE email = '{$_SESSION['email']}' AND pass = md5('{$_POST['old_pass']}')") or die(mysql_error());

if(mysql_num_rows($res_check_old)==0)echo "<font style=\"color:red;\">Incorrect password</font>";

else{

    $res_update=mysql_query("UPDATE admin_user SET pass = md5('{$_POST['new_pass']}') WHERE id = {$_SESSION['id']}");

	echo "<font style=\"color:green;\">Password changed succefully</font>";

    }

}

?>

<br>

<form id="form_pass" action="account.php" method="POST">

<table>

<tr><td><font>Old Password</font></td><td><input name="old_pass"></td></tr>

<tr><td><font style="color:green;">New Password</font></td><td><input type="password" name="new_pass"></td></tr>

<tr><td><font style="color:green;">Re-Enter</font></td><td><input type="password" name="re_enter"></td></tr>

<script>

$(function(){

$('#pass_but').click(function(){

var camp1=$('input[name="new_pass"]').val();

var camp2=$('input[name="re_enter"]').val();

if(camp1==camp2){

if(camp1=="")alert("Password can`t be blank");

else $('#form_pass').submit();}

else alert("Passwords don`t match");

});

});

</script>

<tr><td>&nbsp;</td><td><input id="pass_but" style="color:white;background-color:#00dd00;" type="button" value="Submit"></td></tr>

</table>

</form>

</div><br><br>

<script>

$(function(){

$('#form1_but').click(function(){

$('#form_details').submit();

});

});

</script>

<input style="background-color:#9fc5f8;" id="form1_but" type="button" value="Save changes">



</body>





<?php

}

?>