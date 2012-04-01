<?php

header('Location:../index.php');

 session_start();

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

$res_insert=mysql_query("INSERT INTO users (first,last,username,email,nick,about) VALUES ('{$_POST['fname']}','{$_POST['lname']}','{$_POST['uname']}','{$_POST['email']}','{$_POST['nick']}','{$_POST['email']}')");

$id=mysql_insert_id();

$res_insert=mysql_query("INSERT INTO user_desc (id_user,brutality,accuracy,energy,defense,fortitude,hp,evasion,attack,level,experience,regen) VALUES ({$id},{$_POST['brutality']},{$_POST['accuracy']},{$_POST['energy']},{$_POST['defense']},{$_POST['fortitude']},{$_POST['hp']},{$_POST['evasion']},{$_POST['attack']},{$_POST['level']},{$_POST['xp']},{$_POST['regen']})");

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



<form id="myform" action="add_character.php" method="POST">

<table>

<tr><td>First name</td><td><input name="fname"></td></tr>

<tr><td>Last name</td><td><input name="lname"></td></tr>

<tr><td>Username</td><td><input name="uname"></td></tr>

<tr><td>Email</td><td><input name="email"></td></tr>

<tr><td>Nick</td><td><input name="nick"></td></tr>

<tr><td>About</td><td><input name="about"></td></tr>

<tr><td colspan="2"><hr></td></tr>



<tr><td colspan="2" align="center">Character stats</td></tr>



<tr><td>Brutality</td><td><input name="brutality"></td></tr>

<tr><td>Accuracy</td><td><input name="accuracy"></td></tr>

<tr><td>Energy</td><td><input name="energy"></td></tr>

<tr><td>Defense</td><td><input name="defense"></td></tr>

<tr><td>Fortitude</td><td><input name="fortitude"></td></tr>

<tr><td>Hp</td><td><input name="hp"></td></tr>

<tr><td>Evasion</td><td><input name="evasion"></td></tr>

<tr><td>Attack</td><td><input name="attack"></td></tr>

<tr><td>Level</td><td><input name="level"></td></tr>

<tr><td>Experience</td><td><input name="xp"></td></tr>

<tr><td>Regen</td><td><input name="regen"></td></tr>



<tr><td><input id="but_form" type="button" value="Add character"></td><td>&nbsp;</td></tr>



</table>

</form>



</body>



<?php

}

?>