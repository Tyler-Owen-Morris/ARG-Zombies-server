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



<table style="background-color:black;">

<tr><th style="background-color:#dedede;">First name

&nbsp;<a href="characters.php?first=ASC">ASC</a>

&nbsp;<a href="characters.php?first=DESC">DESC</a>

</th>

<th style="background-color:#dedede;">Last name

&nbsp;<a href="characters.php?last=ASC">ASC</a>

&nbsp;<a href="characters.php?last=DESC">DESC</a>

</th>

<th style="background-color:#dedede;">Username

&nbsp;<a href="characters.php?username=ASC">ASC</a>

&nbsp;<a href="characters.php?username=DESC">DESC</a>

</th>

<th style="background-color:#dedede;">Email

&nbsp;<a href="characters.php?email=ASC">ASC</a>

&nbsp;<a href="characters.php?email=DESC">DESC</a>

</th>

<th style="background-color:#dedede;">Nick

&nbsp;<a href="characters.php?nick=ASC">ASC</a>

&nbsp;<a href="characters.php?nick=DESC">DESC</a>

</th>

<th style="background-color:#dedede;">About</th>

<th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th></tr>



<?php



$query="SELECT * FROM users";

if(isset($_GET['first']))$query.=" ORDER BY first {$_GET['first']}";

if(isset($_GET['last']))$query.=" ORDER BY last {$_GET['last']}";

if(isset($_GET['username']))$query.=" ORDER BY username {$_GET['username']}";

if(isset($_GET['email']))$query.=" ORDER BY email {$_GET['email']}";

if(isset($_GET['nick']))$query.=" ORDER BY nick {$_GET['nick']}";

$res_user=mysql_query($query);





while($row_user=mysql_fetch_array($res_user)){

echo "<tr>";

echo "<td style=\"background-color:#dedede;\">{$row_user['first']}";

echo "</td>";

echo "<td style=\"background-color:#dedede;\">{$row_user['last']}";

echo "</td>";

echo "<td style=\"background-color:#dedede;\">{$row_user['username']}";

echo "</td>";

echo "<td style=\"background-color:#dedede;\">{$row_user['email']}";

echo "</td>";

echo "<td style=\"background-color:#dedede;\">{$row_user['nick']}";

echo "</td>";

echo "<td style=\"background-color:#dedede;\">{$row_user['about']}</td>";



echo "<td style=\"background-color:#dedede;\"><form action=\"edit_character.php\" method=\"POST\"><input type=\"hidden\" name=\"user_id\" value=\"{$row_user['id']}\"><input type=\"submit\" value=\"Edit\"></form></td>";

echo "<td style=\"background-color:#dedede;\"><form action=\"del_character.php\" method=\"POST\"><input type=\"hidden\" name=\"user_id\" value=\"{$row_user['id']}\"><input type=\"submit\" value=\"Delete\" onclick=\"return confirm('Are you sure you want to delete?');\"></form></td>";

echo "<td style=\"background-color:#dedede;\"><form action=\"info_character.php\" method=\"POST\"><input type=\"hidden\" name=\"user_id\" value=\"{$row_user['id']}\"><input type=\"submit\" value=\"Info\"></form></td>";

echo "<td style=\"background-color:#dedede;\"><form action=\"reset_character.php\" method=\"POST\"><input type=\"hidden\" name=\"user_id\" value=\"{$row_user['id']}\"><input type=\"submit\" value=\"Reset\" onclick=\"return confirm('Are you sure you want to reset?');\"></form></td>";



echo "</tr>";

}

?>



</table>

</body>



<?php

}

?>