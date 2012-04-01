<?php session_start();

if(!isset($_SESSION['user']))header('Location:login.php');

include ("db_connect.php");

include("functions.php");

if(!isset($_SESSION['super_user']))$sections=get_access($_SESSION['id']);

else $sections=array(1,2,3,4,5,6,7);

if(!in_array(3,$sections)){

echo "<br><br>You do not have access here!";

}

else{

//page content here

ob_start();

?>

<html>

<head>

<title>Add mob - MMO iPhone</title>



</head>

<body style="background-color:#ababab;">

<a href="logout.php">Logout</a><br><br>

<?php

include("menu.php");

?>

<br><br>

<?php

//seteaza

if(isset($_POST)){

foreach($_POST as $key=>$value){

$bucati=explode("_",$key);

$res_update=mysql_query("UPDATE loot SET name = '{$value}' WHERE value = '{$bucati[2]}'");

}

}

?>



<form action="mob_loot.php" method="POST">

<?php

$res=mysql_query("SELECT DISTINCT value, name FROM loot ORDER BY CAST(value AS signed) ASC");

while($row=mysql_fetch_array($res)){

echo $row['value']."&nbsp;";

echo "<input name=\"the_name_{$row['value']}\" value=\"{$row['name']}\"><br><br>";

}

?>

<input type="submit" value="Rename">

</form>



</body>

</html>



<?php

}

?>