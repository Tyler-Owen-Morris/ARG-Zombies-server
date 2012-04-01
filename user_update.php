<?php

include ("db_connect.php");

if (isset($_POST['id'])){

	if (isset($_POST['brutality']))

		$brutality = $_POST['brutality'];

	else

		$brutality = 0;

	mysql_query("UPDATE user_desc SET brutality='$brutality' WHERE id_user='$_POST[id]'");

	if (isset($_POST['accuracy']))

		$accuracy = $_POST['accuracy'];

	else

		$accuracy = 0;

	mysql_query("UPDATE user_desc SET accuracy='$accuracy' WHERE id_user='$_POST[id]'");

	if (isset($_POST['energy']))

		$energy = $_POST['energy'];

	else

		$energy = 0;

	mysql_query("UPDATE user_desc SET energy='$energy' WHERE id_user='$_POST[id]'");

	if (isset($_POST['defense']))

		$defense = $_POST['defense'];

	else

		$defense = 0;

	mysql_query("UPDATE user_desc SET defense='$defense' WHERE id_user='$_POST[id]'");

	if (isset($_POST['fortitude']))

		$fortitude = $_POST['fortitude'];

	else

		$fortitude = 0;

	mysql_query("UPDATE user_desc SET fortitude='$fortitude' WHERE id_user='$_POST[id]'");

	if (isset($_POST['hp']))

		$hp = $_POST['hp'];

	else

		$hp = 0;

	mysql_query("UPDATE user_desc SET hp='$hp' WHERE id_user='$_POST[id]'");

	if (isset($_POST['evasion']))

		$evasion = $_POST['evasion'];

	else

		$evasion = 0;

	mysql_query("UPDATE user_desc SET evasion='$evasion' WHERE id_user='$_POST[id]'");

	if (isset($_POST['attack']))

		$attack = $_POST['attack'];

	else

		$attack = 0;

	mysql_query("UPDATE user_desc SET attack='$attack' WHERE id_user='$_POST[id]'");

	if (isset($_POST['level']))

		$level = $_POST['level'];

	else

		$level = 0;

	mysql_query("UPDATE user_desc SET level='$level' WHERE id_user='$_POST[id]'");

	if (isset($_POST['experience']))

		$experience = $_POST['experience'];

	else

		$experience = 0;

	mysql_query("UPDATE user_desc SET experience='$experience' WHERE id_user='$_POST[id]'");

	if (isset($_POST['regen']))

		$regen = $_POST['regen'];

	else

		$regen = 0;

	mysql_query("UPDATE user_desc SET regen='$regen' WHERE id_user='$_POST[id]'");

	if (isset($_POST['hands']))

		$hands = $_POST['hands'];

	else

		$hands = 0;

	mysql_query("UPDATE user_desc SET hands='$hands' WHERE id_user='$_POST[id]'");

	if (isset($_POST['helmet']))

		$helmet = $_POST['helmet'];

	else

		$helmet = 0;

	mysql_query("UPDATE user_desc SET helmet='$helmet' WHERE id_user='$_POST[id]'");

	if (isset($_POST['chest']))

		$chest = $_POST['chest'];

	else

		$chest = 0;

	mysql_query("UPDATE user_desc SET chest='$chest' WHERE id_user='$_POST[id]'");

	if (isset($_POST['pants']))

		$pants = $_POST['pants'];

	else

		$pants = 0;

	mysql_query("UPDATE user_desc SET pants='$pants' WHERE id_user='$_POST[id]'");

	if (isset($_POST['shoes']))

		$shoes = $_POST['shoes'];

	else

		$shoes = 0;

	mysql_query("UPDATE user_desc SET shoes='$shoes' WHERE id_user='$_POST[id]'");

	if (isset($_POST['weapon']))

		$weapon = $_POST['weapon'];

	else

		$weapon = 0;

	mysql_query("UPDATE user_desc SET weapon='$weapon' WHERE id_user='$_POST[id]'");

	if (isset($_POST['difficulty']))

		$difficulty = $_POST['difficulty'];

	else

		$difficulty = 0;

	mysql_query("UPDATE user_desc SET difficulty='$difficulty' WHERE id_user='$_POST[id]'");

	

	if (isset($_POST['money'])){

		$money = $_POST['money'];

		mysql_query("UPDATE home SET money='$money' WHERE id_user='$_POST[id]'");

	}

	}

?>