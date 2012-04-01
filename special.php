<?php



include("db_connect.php");

	if (isset($_GET['id']))

		$id = $_GET['id'];

	else $id = 1;

	

	if (isset($_GET['weapon'])){

		$weapon = $_GET['weapon'];

		if ($weapon == 0)

			$weapon = 1;

		}

	else $weapon = 1;

	$sql = "SELECT * FROM user_desc WHERE id_user='$id'";

	$result = mysql_query($sql) or die($sql);

	$rows = mysql_num_rows($result);

	if ($rows > 0){

	$row = mysql_fetch_array($result);

	//echo $row['level'];

	$result2 = mysql_query("SELECT * FROM special_attacks WHERE (level <= '$row[level]') AND (weapon='$weapon' OR weapon='0')");

	$rows2 = mysql_num_rows($result2);

	echo $rows2."<br />";

	while ($row2 = mysql_fetch_array($result2)){

		echo $row2['name'].":".$row2['animation'].":".$row2['damage'].":".$row2['regen'].":".$row2['target'].":".$row2['accuracy'].":".$row2['lost_sec']."<br />";

	}

	}else{

		echo "No user";

	}

?>