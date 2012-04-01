<?php session_start();

if(!isset($_SESSION['user']))header('Location:login.php');

if(!isset($_SESSION['super_user']))if($_SESSION['active']===0)header('Location:login.php?inactive=1');

?>

<body style="background-color:#ababab;">

<?php

include("db_connect.php");

include("functions.php");

?>

<a href="logout.php">Logout</a><br><br>

<?php

include("menu.php");

?>



<br><br><br>



<center>



</center>



</body>