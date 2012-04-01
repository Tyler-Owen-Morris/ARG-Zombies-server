<?php session_start();

if(!isset($_SESSION['user']))header('Location:login.php');

include ("db_connect.php");

include("functions.php");

if(!isset($_SESSION['super_user']))$sections=get_access($_SESSION['id']);

else $sections=array(1,2,3,4,5,6,7);

if(!in_array(6,$sections)){

echo "<br><br>You do not have access here!";

}

else{

//page content here



?>

<body style="background-color:#ababab;">

<a href="logout.php">Logout</a><br><br>

<?php

include("menu.php");

?>



<?php



if(isset($_POST['name'])){

$res=mysql_query("UPDATE zone SET lat_min = ".mysql_real_escape_string($_POST['lat_min']).", lat_max = ".mysql_real_escape_string($_POST['lat_max']).", long_min = ".mysql_real_escape_string($_POST['long_min']).", long_max = ".mysql_real_escape_string($_POST['long_max']).", name = '".mysql_real_escape_string($_POST['name'])."' WHERE id = {$_POST['zone_id']}") or die("Error");				

				

				

header('Location:zones.php');

}





?>

<script>

function checkit()

{

var error="";

if(l1mi.value>l1ma.value)error+="Min lat must be lower than max lat";

if(l2mi.value>l2ma.value)error+="\nMin long must be lower than max long";

if(error=="")form_s.submit();

else alert(error);

}

</script>



<br><br>



<b>Edit zone</b><br>



<?php

$res_zone=mysql_query("SELECT * FROM zone WHERE id = {$_POST['zone_id']}");

$row_zone=mysql_fetch_array($res_zone);

?>



<form id="form_s"  action="edit_zone.php" method="POST" style="width:350px;">

<input type="hidden" name="zone_id" value="<?php echo $_POST['zone_id']; ?>">

<div id="fc" style="width:250px;">

<div style="text-align:left;float:left;">

<font>Min lat:</font><br>

<font>Max lat:</font><br>

<font>Min long:</font><br>

<font>Max long:</font><br>

<font>Zone name:</font>

</div>

<div style="text-align:left;float:left;">

<input id="l1mi" name="lat_min" value="<?php echo $row_zone['lat_min']; ?>"><br>

<input id="l1ma" name="lat_max" value="<?php echo $row_zone['lat_max']; ?>"><br>

<input id="l2mi" name="long_min" value="<?php echo $row_zone['long_min']; ?>"><br>

<input id="l2ma" name="long_max" value="<?php echo $row_zone['long_max']; ?>"><br>

<input name="name" value="<?php echo $row_zone['name']; ?>">

</div>

<input type="button" value="Save" onclick="checkit()">

</div>

</form>

</body>



<?php

}

?>