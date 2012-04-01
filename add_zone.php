<?php



include ("db_connect.php");



if(isset($_POST['name'])){

$res=mysql_query("INSERT INTO zone (lat_min,lat_max,long_min,long_max,name)

                VALUES 

				(".mysql_real_escape_string($_POST['lat_min']).",

				".mysql_real_escape_string($_POST['lat_max']).",

				".mysql_real_escape_string($_POST['long_min']).",

				".mysql_real_escape_string($_POST['long_max']).",

				'".mysql_real_escape_string($_POST['name'])."')") or die("Error");



}





?>

<script>

function checkit()

{

var error="";

if(l1mi.value>l1ma.value)error+="Min lat must me lower than max lat";

if(l2mi.value>l2ma.value)error+="\nMin long must me lower than max long";

if(error=="")form_s.submit();

else alert(error);

}

</script>



<b>Add zone</b><br>



<form id="form_s"  action="add_zone.php" method="POST" style="width:350px;">

<div id="fc" style="width:250px;">

<div style="text-align:left;float:left;">

<font>Min lat:</font><br>

<font>Max lat:</font><br>

<font>Min long:</font><br>

<font>Max long:</font><br>

<font>Zone name:</font>

</div>

<div style="text-align:left;float:left;">

<input id="l1mi" name="lat_min"><br>

<input id="l1ma" name="lat_max"><br>

<input id="l2mi" name="long_min"><br>

<input id="l2ma" name="long_max"><br>

<input name="name">

</div>

<input type="button" value="Save" onclick="checkit()">

</div>

</form>

