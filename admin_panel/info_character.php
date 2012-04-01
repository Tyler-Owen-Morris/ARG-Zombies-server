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



<script>

function sure1(sigur){

var check=confirm("Are you sure you want to complete?");

if(check==true)$('#complete_'+sigur).submit();

}



function sure2(sigur){

var check=confirm("Are you sure you want to reset?");

if(check==true)$('#reset_'+sigur).submit();

}



$(function(){





var mp='<?php echo "<table style=\x22background-color:black;\x22><tr><th style=\x22background-color:#dedede;\x22>Mission name</th><th style=\x22background-color:#dedede;\x22>Percent</th><th style=\x22background-color:#dedede;\x22>Status</th></tr>";

$res_miss=mysql_query("SELECT * FROM mission_player INNER JOIN missions ON mission_player.mission_id = missions.id WHERE user_id = {$_POST['user_id']}") or die(mysql_error());

if(mysql_num_rows($res_miss)==0)echo "<tr><td style=\x22background-color:#dedede;\x22 colspan=\x223\x22>No missions</td></tr>";

while($row_miss=mysql_fetch_array($res_miss)){

echo "<tr>";echo "<td style=\x22background-color:#dedede;\x22>{$row_miss['name']}</td>";

echo "<td style=\x22background-color:#dedede;\x22>{$row_miss['procent']}</td>";

echo "<td style=\x22background-color:#dedede;\x22>";

if($row_miss['completed']==0)echo "In progress";

if($row_miss['completed']==1)echo "Completed";

echo "</td>";

echo "<td style=\x22background-color:#dedede;\x22><form id=\x22complete_{$row_miss['id']}\x22 action=\x22complete_mission.php\x22 method=\x22POST\x22><input type=\x22hidden\x22 name=\x22miss_id\x22 value=\x22{$row_miss['id']}\x22><input type=\x22button\x22 value=\x22Complete\x22 onclick=\x22sure1({$row_miss['id']});\x22></form></td>";

echo "<td style=\x22background-color:#dedede;\x22><form id=\x22reset_{$row_miss['id']}\x22 action=\x22reset_mission.php\x22 method=\x22POST\x22><input type=\x22hidden\x22 name=\x22miss_id\x22 value=\x22{$row_miss['id']}\x22><input type=\x22button\x22 value=\x22Reset\x22 onclick=\x22sure2({$row_miss['id']});\x22></form></td>";

echo "</tr>";}

echo "</table>";?>';



var io='<?php echo "<table style=\x22background-color:black;\x22><tr><th style=\x22background-color:#dedede;\x22>Item name (on)</th><th style=\x22background-color:#dedede;\x22>Quantity</th><th style=\x22background-color:#dedede;\x22>Active</th></tr>";

$res_miss=mysql_query("SELECT * FROM `items_home` INNER JOIN items_inventory ON items_home.id_item = items_inventory.id_item WHERE id_user = {$_POST['user_id']}") or die(mysql_error());

if(mysql_num_rows($res_miss)==0)echo "<tr><td style=\x22background-color:#dedede;\x22 colspan=\x223\x22>No items on</td></tr>";

while($row_miss=mysql_fetch_array($res_miss)){

echo "<tr>";echo "<td style=\x22background-color:#dedede;\x22>{$row_miss['name']}</td>";

echo "<td style=\x22background-color:#dedede;\x22>{$row_miss['quantity']}</td>";

echo "<td style=\x22background-color:#dedede;\x22>";

if($row_miss['active']==0)echo "Active";

if($row_miss['active']==1)echo "Inactive";

echo "</td>";

echo "</tr>";}

echo "</table>";?>';



var ih='<?php echo "<table style=\x22background-color:black;\x22><tr><th style=\x22background-color:#dedede;\x22>Item name (home)</th><th style=\x22background-color:#dedede;\x22>Quantity</th><th style=\x22background-color:#dedede;\x22>Active</th></tr>";

$res_miss=mysql_query("SELECT * FROM `items_on` INNER JOIN items_inventory ON items_on.id_item = items_inventory.id_item WHERE id_user = {$_POST['user_id']}") or die(mysql_error());

if(mysql_num_rows($res_miss)==0)echo "<tr><td style=\x22background-color:#dedede;\x22 colspan=\x223\x22>No items home</td></tr>";

while($row_miss=mysql_fetch_array($res_miss)){

echo "<tr>";echo "<td style=\x22background-color:#dedede;\x22>{$row_miss['name']}</td>";

echo "<td style=\x22background-color:#dedede;\x22>{$row_miss['quantity']}</td>";

echo "<td style=\x22background-color:#dedede;\x22>";

if($row_miss['active']==0)echo "Active";

if($row_miss['active']==1)echo "Inactive";

echo "</td>";

echo "</tr>";}

echo "</table>";?>';



$('#mp').click(function(){

$('#my_div').html(mp);

});



$('#io').click(function(){

$('#my_div').html(io);

});



$('#ih').click(function(){

$('#my_div').html(ih);

});



});

</script>



<br><br>

<input id="mp" type="button" value="Mission progress">

<input id="io" type="button" value="Items on">

<input id="ih" type="button" value="Items home">

<br><br>



<div id="my_div">







</div>









</body>



<?php

}

?>