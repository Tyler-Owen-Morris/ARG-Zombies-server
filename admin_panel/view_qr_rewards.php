<?php session_start();

if(!isset($_SESSION['user']))header('Location:login.php');

include ("db_connect.php");

include("functions.php");

if(!isset($_SESSION['super_user']))$sections=get_access($_SESSION['id']);

else $sections=array(1,2,3,4,5,6,7);

if(!in_array(7,$sections)){

echo "<br><br>You do not have access here!";

}

else{

//page content here

include("qrcode.php");

?>

<body style="background-color:#ababab;">

<a href="logout.php">Logout</a><br><br>

<?php

include("menu.php");

?>

<br><br>

<input type="button" value="Add QR reward" onclick="window.location.href='add_qr_reward.php'">

<br><br>

<?php



$query="SELECT * FROM qr_reward";

if(isset($_GET['code']))$query.=" ORDER BY sn {$_GET['code']}";

$res=mysql_query($query);



echo "<table style=\"border:1px solid black;\">";

echo "<th style=\"border:1px solid black;\">Code";

echo "&nbsp;<a href=\"view_qr_rewards.php?code=ASC\">ASC</a>";

echo "&nbsp;<a href=\"view_qr_rewards.php?code=DESC\">DESC</a>";

echo "</th>";

echo "<th style=\"border:1px solid black;\">QR Code</th>";

echo "<th style=\"border:1px solid black;\">XP</th>";

echo "<th style=\"border:1px solid black;\">Mission</th>";

echo "<th style=\"border:1px solid black;\">Monster</th>";

echo "<th style=\"border:1px solid black;\">Cash</th>";

echo "<th style=\"border:1px solid black;\">Item</th>";

echo "<th style=\"border:1px solid black;\">Cooldown</th>";

echo "<th style=\"border:1px solid black;\">Edit</th>";

echo "<th style=\"border:1px solid black;\">Delete</th>";

while($row=mysql_fetch_array($res)){

echo "<tr>";

echo "<td style=\"border:1px solid black;\">{$row['sn']}</td>";

$qr = new qrcode();

$qr->text($row['sn']);

echo "<td style=\"border:1px solid black;\"><img src='".$qr->get_link()."' border='0'/><br>(right click and save as)</td>";

echo "<td style=\"border:1px solid black;\">{$row['xp']}</td>";

echo "<td style=\"border:1px solid black;\">{$row['mission']}</td>";

echo "<td style=\"border:1px solid black;\">{$row['monster']}</td>";

echo "<td style=\"border:1px solid black;\">{$row['cash']}</td>";

echo "<td style=\"border:1px solid black;\">{$row['item']}</td>";



$cooldown=intval($row['cooldown']);

$h=floor($cooldown/3600);

$m=floor(($cooldown-$h*3600)/60);

$s=$cooldown-$h*3600-$m*60;

echo "<td style=\"border:1px solid black;\">{$h}h&nbsp;{$m}m&nbsp;{$s}s</td>";



echo "<td style=\"border:1px solid black;\"><form action=\"edit_reward.php\" method=\"POST\"><input type=\"hidden\" name=\"care_rew\" value=\"{$row['id']}\"><input type=\"submit\" value=\"Edit\"></form></td>";



echo "<td style=\"border:1px solid black;\"><form action=\"del_reward.php\" method=\"POST\"><input type=\"hidden\" name=\"care_rew\" value=\"{$row['id']}\"><input onclick=\"return confirm('Are you sure?');\" type=\"submit\" value=\"Delete\"></form></td>";



echo "</tr>";

}

echo "</table>";

?>

</body>

<?php

}

?>