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



<form action="info_character.php" method="POST">

Item:

<select name="id_item">

<option value="default">Choose item</option>

<?php

$res_item=mysql_query("SELECT * FROM items_inventory ORDER BY name ASC");

while($row_items=mysql_fetch_array($res_item)){

echo "<option value=\"{$row_items['id_item']}\">{$row_items['name']}</option>";

}

?>

</select><br><br>

Quantity:<input name="cant"><br><br>

Active:

&nbsp;Yes<input type="radio" name="active" value="1">

&nbsp;No<input type="radio" name="active" value="0" CHECKED><br><br>

Location:

&nbsp;On<input type="radio" name="location" value="1">

&nbsp;Home<input type="radio" name="location" value="0" CHECKED><br><br>

<input type="hidden" name="user_id" value="<?php echo $_POST['user_id']; ?>">

<input type="submit" value="Add item">

</form>



</body>

<?php

}

?>