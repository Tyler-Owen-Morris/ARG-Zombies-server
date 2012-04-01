<?php session_start();

if(!isset($_SESSION['user']))header('Location:login.php');

include ("db_connect.php");

include("functions.php");

if(!isset($_SESSION['super_user']))$sections=get_access($_SESSION['id']);

else $sections=array(1,2,3,4,5,6,7);

if(!in_array(2,$sections)){

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

<br><br>



<?php



if(isset($_POST['fname'])){

if($_POST['pass']=="")$res_insert=mysql_query("UPDATE users SET first = '{$_POST['fname']}', last = '{$_POST['lname']}', username = '{$_POST['uname']}', email = '{$_POST['email']}', nick = '{$_POST['nick']}', about =  '{$_POST['email']}' WHERE id = {$_POST['user_id']}");

else $res_insert=mysql_query("UPDATE users SET first = '{$_POST['fname']}', last = '{$_POST['lname']}', username = '{$_POST['uname']}', password = md5('{$_POST['pass']}'), email = '{$_POST['email']}', nick = '{$_POST['nick']}', about =  '{$_POST['email']}' WHERE id = {$_POST['user_id']}");



$res_insert=mysql_query("UPDATE user_desc SET brutality = {$_POST['brutality']}, accuracy = {$_POST['accuracy']}, energy = {$_POST['energy']}, defense = {$_POST['defense']}, fortitude = {$_POST['fortitude']}, hp = {$_POST['hp']}, evasion = {$_POST['evasion']}, attack = {$_POST['attack']}, level = {$_POST['level']}, experience = {$_POST['xp']}, regen = {$_POST['regen']} WHERE id_user = {$_POST['user_id']}");

header('Location:characters.php');

}

?>



<script>

$(function(){

$('#but_form').click(function(){

var post_form=1;

if($('input[name="fname"]').val()==""){alert("First name can`t be blank");post_form=0;}

if($('input[name="lname"]').val()==""){alert("Last name can`t be blank");post_form=0;}

if($('input[name="uname"]').val()==""){alert("Username can`t be blank");post_form=0;}

if($('input[name="email"]').val()==""){alert("Email can`t be blank");post_form=0;}

if(post_form==1)$('#myform').submit();

});

});

</script>



<?php

$res_user=mysql_query("SELECT * FROM users WHERE id = {$_POST['user_id']}");

$row_user=mysql_fetch_array($res_user);

?>



<form id="myform" action="edit_character.php" method="POST">

<table>

<tr><td>First name</td><td><input name="fname" value="<?php echo $row_user['first']; ?>"></td></tr>

<tr><td>Last name</td><td><input name="lname" value="<?php echo $row_user['last']; ?>"></td></tr>

<tr><td>Username</td><td><input name="uname" value="<?php echo $row_user['username']; ?>"></td></tr>

<tr><td>Email</td><td><input name="email" value="<?php echo $row_user['email']; ?>"></td></tr>

<tr><td>Password</td><td><input name="pass" value=""></td></tr>

<tr><td colspan="2">Leave blank if you don`t want to change</td></tr>

<tr><td>Nick</td><td><input name="nick" value="<?php echo $row_user['nick']; ?>"></td></tr>

<tr><td>About</td><td><input name="about" value="<?php echo $row_user['about']; ?>"></td></tr>

<tr><td colspan="2"><hr></td></tr>



<tr><td colspan="2" align="center">Character stats</td></tr>



<?php

$res_user=mysql_query("SELECT * FROM user_desc WHERE id_user = {$_POST['user_id']}");

$row_user=mysql_fetch_array($res_user);

?>



<tr><td>Brutality</td><td><input name="brutality" value="<?php echo $row_user['brutality']; ?>"></td></tr>

<tr><td>Accuracy</td><td><input name="accuracy" value="<?php echo $row_user['accuracy']; ?>"></td></tr>

<tr><td>Energy</td><td><input name="energy" value="<?php echo $row_user['energy']; ?>"></td></tr>

<tr><td>Defense</td><td><input name="defense" value="<?php echo $row_user['defense']; ?>"></td></tr>

<tr><td>Fortitude</td><td><input name="fortitude" value="<?php echo $row_user['fortitude']; ?>"></td></tr>

<tr><td>Hp</td><td><input name="hp" value="<?php echo $row_user['hp']; ?>"></td></tr>

<tr><td>Evasion</td><td><input name="evasion" value="<?php echo $row_user['evasion']; ?>"></td></tr>

<tr><td>Attack</td><td><input name="attack" value="<?php echo $row_user['attack']; ?>"></td></tr>

<tr><td>Level</td><td><input name="level" value="<?php echo $row_user['level']; ?>"></td></tr>

<tr><td>Experience</td><td><input name="xp" value="<?php echo $row_user['experience']; ?>"></td></tr>

<tr><td>Regen</td><td><input name="regen" value="<?php echo $row_user['regen']; ?>"></td></tr>



<input type="hidden" name="user_id" value="<?php echo $_POST['user_id']; ?>">



<tr><td><input id="but_form" type="button" value="Edit character"></td><td>&nbsp;</td></tr>



</table>

</form>



</body>



<?php

}

?>