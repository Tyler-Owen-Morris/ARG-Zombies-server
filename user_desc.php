<?php

include ("db_connect.php");

if (isset($_GET['username']))

$user = $_GET['username'];

else

$user = 'admin';

$result2 = mysql_query("SELECT * FROM users WHERE username='$user'");

$row2 = mysql_fetch_array($result2);

$sql = "SELECT * FROM user_desc WHERE id_user = '$row2[id]'";

$result = mysql_query($sql) or die ($sql);



$result3 = mysql_query("SELECT * FROM home WHERE id_user = '$row2[id]'");

$row3 = mysql_fetch_array($result3);

$rows = mysql_num_rows($result);

if ($rows > 0 ){





$row = mysql_fetch_array($result);

if($row['brutality']!="")echo $row['brutality']."<br />";

else echo "0<br />";

if($row['accuracy']!="")echo $row['accuracy']."<br />";

else echo "0<br />";

if($row['energy']!="")echo $row['energy']."<br />";

else echo "0<br />";

if($row['defense']!="")echo $row['defense']."<br />";

else echo "0<br />";

if($row['fortitude']!="")echo $row['fortitude']."<br />";

else echo "0<br />";

if($row['hp'])echo $row['hp']."<br />";

else echo "0<br />";

if($row['evasion'])echo $row['evasion']."<br />";

else echo "0<br />";

if($row['attack'])echo $row['attack']."<br />";

else echo "0<br />";

if($row['level'])echo $row['level']."<br />";

else echo "0<br />";

if($row['experience']!="")echo $row['experience']."<br />";

else echo "0<br />";

if($row['regen']!="")echo $row['regen']."<br />";

else echo "0<br />";

if($row2['nick']!="")echo $row2['nick']."<br />";

else echo "0<br />";

if($row2['id']!="")echo $row2['id']."<br />";

else echo "0<br />";

if($row['hands'])echo $row['hands']."<br />";

else echo "0<br />";

if($row['helmet']!="")echo $row['helmet']."<br />";

else echo "0<br />";

if($row['chest']!="")echo $row['chest']."<br />";

else echo "0<br />";

if($row['pants']!="")echo $row['pants']."<br />";

else echo "0<br />";

if($row['shoes']!="")echo $row['shoes']."<br />";

else echo "0<br />";

if($row['weapon']!="")echo $row['weapon']."<br />";

else echo "0<br />";

if($row['difficulty']!="")echo $row['difficulty']."<br />";

else echo "0<br />";

if($row3['money']!="")echo $row3['money']."<br />";

else echo "0<br />";

if($row2['avatar']!="")echo $row2['avatar']."<br />";

else echo "0<br />";

if($row3['latitude']!="")echo $row3['latitude']."<br />";

else echo "0<br />";

if($row3['longitude']!="")echo $row3['longitude']."<br />";

else echo "0<br />";

if($row2['body']!="")echo $row2['body'];

else echo "0<br />";





}else{

echo "Invalid user ID";

}

?>