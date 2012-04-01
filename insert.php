<?php



include ("db_connect.php");



if (isset($_GET['User']))

	$user = $_GET['User'];

if (isset($_GET['Pass']))

	$pass = $_GET['Pass'];

if (isset($_GET['Nick']))

	$nick = $_GET['Nick'];

if (isset($_GET['Email']))

	$email = $_GET['Email'];

if (isset($_GET['FirstN']))

	$first = $_GET['FirstN'];

if (isset($_GET['LastN']))

	$last = $_GET['LastN'];

if (isset($_GET['avatar']))

	$avatar = $_GET['avatar'];

	$body=1;

if (isset($_GET['body']))

	$body = $_GET['body'];

	

$result = mysql_query("SELECT * FROM users WHERE username='$user'");

$rows=mysql_num_rows($result);

if ($rows == 1)

echo "Error! User already exists!";

else{

	$result2 = mysql_query("SELECT * FROM users WHERE nick='$nick'");

	$rows2=mysql_num_rows($result2);

	if ($rows2 > 0){

		echo "Error! Nick already exists!";

	}else{

		$pass= md5($pass);

		mysql_query("INSERT INTO users (first, last, username, password, email, nick, avatar, body) VALUES ('$first', '$last', '$user', '$pass', '$email', '$nick', '$avatar', {$body})");

		$r = mysql_insert_id();

		

		$result3 = mysql_query("SELECT * FROM player_xp WHERE level='1'");

		$row3 = mysql_fetch_array($result3);

		

		$level = 1;

		$brut = $row3['brut'];

		$acc = $row3['acc'];

		$fort = $row3['fort'];

		$def = $row3['def'];

		$energy = 10;

		$hp = 300;

		$att = $level + ($brut*2);

		$evasion = $level + ($def/2);

		$regen = 1;

		$exp = 0;

		

		mysql_query("INSERT INTO user_desc (id_user, brutality, accuracy, energy, defense, fortitude, hp, evasion, attack, level, experience, regen, hands, helmet, chest, pants, shoes, weapon) 

										VALUES ('$r', '$brut', '$acc', '$energy', '$def', '$fort', '$hp', '$evasion', '$att', '$level', '$exp', '$regen', '0', '0', '0', '0', '0', '0')");

		mysql_query("INSERT INTO home (id_user, money) VALUES ('$r', '0')");

		mysql_query("INSERT INTO items_on (id_user, id_item, quantity, active) VALUES ('$r', '0', '0', '0')");

		echo "Registered successfully!";

	}

}