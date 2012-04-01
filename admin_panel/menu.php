<?php session_start();

if(!isset($_SESSION['super_user'])){

$sections=get_access($_SESSION['id']);



echo "Normal admin<br>";



echo "<input type=\"button\" value=\"Home\" onclick=\"window.location.href='index.php'\">";



if(in_array(1,$sections)){echo "<input type=\"button\" value=\"My Account\" onclick=\"window.location.href='account.php'\">";}



if(in_array(2,$sections)){echo "<input type=\"button\" value=\"Characters\" onclick=\"window.location.href='characters.php'\">";}



if(in_array(3,$sections)){echo "<input type=\"button\" value=\"Mob\" onclick=\"window.location.href='mob.php'\">";}



if(in_array(4,$sections)){echo "<input type=\"button\" value=\"Items\" onclick=\"window.location.href='item.php'\">";}



if(in_array(5,$sections)){echo "<input type=\"button\" value=\"Missions\" onclick=\"window.location.href='mission.php'\">";}



if(in_array(6,$sections)){echo "<input type=\"button\" value=\"Zones\" onclick=\"window.location.href='zones.php'\">";}



if(in_array(7,$sections)){echo "<input type=\"button\" value=\"QR Codes\" onclick=\"window.location.href='view_qr_rewards.php'\">";}



if(in_array(8,$sections)){echo "<input type=\"button\" value=\"Add Item\" onclick=\"window.location.href='add_item.php'\">";}



}

else{

echo "Super admin<br>";

echo "<input type=\"button\" value=\"Home\" onclick=\"window.location.href='index.php'\">";



echo "<input type=\"button\" value=\"Manage Users\" onclick=\"window.location.href='manage_users.php'\">";



echo "<input type=\"button\" value=\"Characters\" onclick=\"window.location.href='characters.php'\">";



echo "<input type=\"button\" value=\"Mob\" onclick=\"window.location.href='mob.php'\">";



echo "<input type=\"button\" value=\"Items\" onclick=\"window.location.href='item.php'\">";



echo "<input type=\"button\" value=\"Missions\" onclick=\"window.location.href='mission.php'\">";



echo "<input type=\"button\" value=\"Zones\" onclick=\"window.location.href='zones.php'\">";



echo "<input type=\"button\" value=\"QR Codes\" onclick=\"window.location.href='view_qr_rewards.php'\">";



echo "<input type=\"button\" value=\"Add Item\" onclick=\"window.location.href='add_item.php'\">";

}

?>