<?php

ob_start();

?>

<html>

<head>

<title>Add special zones - MMO iPhone</title>

</head>

<?php

include ("db_connect.php");

?>

<h3>Add special zones - MMO iPhone</h3>

<?php

if (isset($_GET['view'])){

$result = mysql_query("SELECT * FROM zone ORDER BY id");

?>

<table style="width: 800px;margin: 0 auto;clear: right;margin: 10px 0px 40px 0px;">

<tr>

<td style="background: #eeeeee;width: auto;text-align: center;"><a href="special_zones.php" style="text-decoration:none;">Back</td>

</tr>

<tr>

<th></th>

<th style="font-weight: bold; background: #5b7480;width:20%">Name</th>

<th style="font-weight: bold; background: #5b7480;width:20%">Lat min</th>

<th style="font-weight: bold; background: #5b7480;width:20%">Lat max</th>

<th style="font-weight: bold; background: #5b7480;width:20%">Lon min</th>

<th style="font-weight: bold; background: #5b7480;width:20%">Lon max</th>

</tr>

<?php

while ($row = mysql_fetch_array($result)){

?>

<tr>

<td style="background: #eeeeee;width: auto;text-align: center;"><a href="special_zones.php?id=<?php echo $row['id']; ?>&edit" style="text-decoration:none">[edit]</td>

<td style="background: #eeeeee;width: auto;text-align: center;"><?php echo $row['name']; ?></td>

<td style="background: #eeeeee;width: auto;text-align: center;"><?php echo $row['lat_min']; ?></td>

<td style="background: #eeeeee;width: auto;text-align: center;"><?php echo $row['lat_max']; ?></td>

<td style="background: #eeeeee;width: auto;text-align: center;"><?php echo $row['long_min']; ?></td>

<td style="background: #eeeeee;width: auto;text-align: center;"><?php echo $row['long_max']; ?></td>

</tr>

<?php

}

?>

<tr>

<td style="background: #eeeeee;width: auto;text-align: center;"><a href="special_zones.php" style="text-decoration:none;">Back</td>

</tr>

</table>

<?php

}elseif (isset($_GET['edit'])){

	$id = $_GET['id'];

	$result = mysql_query("SELECT * FROM zone WHERE id='$id'");

	$row = mysql_fetch_array($result);

	if (!isset($_POST['submit'])){

?>

	<form method='POST' action=''>

		<div style="float:left;width:170px;">Name: </div><div style="float:left;width:130px;"><input type='text' name='name' value="<?php echo $row['name']; ?>"></div><br /><br />

		<div style="float:left;width:170px;">Latitude (min-max): </div><div style="float:left;width:330px;"><input type='text' name='lat1' size='12' value="<?php echo $row['lat_min']; ?>"> - <input type='text' name='lat2' size='12' value="<?php echo $row['lat_max']; ?>"></div><br /><br />

		<div style="float:left;width:170px;">Longitude (min-max): </div><div style="float:left;width:330px;"><input type='text' name='lon1' size='12' value="<?php echo $row['long_min']; ?>"> - <input type='text' name='lon2' size='12' value="<?php echo $row['long_max']; ?>"></div><br /><br />

		<input type='submit' name='submit' value='Edit'><a href='special_zones.php?view' style='text-decoration:none'>Leave</a>

	</form>

<?php

}else{

	$name = mysql_real_escape_string($_POST['name']);

	

	mysql_query("UPDATE zone SET name='$name', lat_min='$_POST[lat1]', lat_max='$_POST[lat2]', long_min='$_POST[lon1]', long_max='$_POST[lon2]' WHERE id='$id'");

	header("Location: special_zones.php?view");

}

}elseif (!isset($_POST['submit'])){

?>

	<form method='POST' action=''>

		<div style="float:left;width:170px;">Name: </div><div style="float:left;width:130px;"><input type='text' name='name'></div><br /><br />

		<div style="float:left;width:170px;">Latitude (min-max): </div><div style="float:left;width:330px;"><input type='text' name='lat1' size='12'> - <input type='text' name='lat2' size='12'></div><br /><br />

		<div style="float:left;width:170px;">Longitude (min-max): </div><div style="float:left;width:330px;"><input type='text' name='lon1' size='12'> - <input type='text' name='lon2' size='12'></div><br /><br />

		<input type='submit' name='submit' value='Save'>

	</form>

<br />



<div>

<a href="special_zones.php?view" style="text-decoration:none;">View all entries from database</a>

</div>

<?php

}else{

	$name = mysql_real_escape_string($_POST['name']);

	mysql_query("INSERT INTO zone (lat_min, lat_max, long_min, long_max, name) VALUES ('$_POST[lat1]', '$_POST[lat2]', '$_POST[lon1]', '$_POST[lon2]', '$name')");

}



?>