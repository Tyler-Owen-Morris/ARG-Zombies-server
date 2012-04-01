<?php
	include("db_connect.php");
	if (isset($_GET['id']))
		$id = $_GET['id'];
	else $id = 1;
	
	if( isset($_GET['delevel'] ) )
		$delevel = 1;
	else 
		$delevel = 0;
	
	$sql = "SELECT * FROM user_desc WHERE id_user='$id'";
	$result = mysql_query($sql) or die($sql);
	$rows = mysql_num_rows($result);
	if ($rows > 0)
	{		
		$row = mysql_fetch_array($result);
		if( $delevel == 0 ) 
			$level = $row['level'] + 1;
		else
			$level = $row['level'];//if deleveling, get xp for level

			//echo "{level}$level{/level}";

			
		$result2 = mysql_query("SELECT * FROM player_xp WHERE level='$level'");
		$row2 = mysql_fetch_array($result2);
		echo $row2['xp'].":";
		
		$special = explode(";", $row2['special']);
		$special_attack = "";
		foreach ($special as $val){
			$result3 = mysql_query("SELECT * FROM special_attacks WHERE id_attack='$val'");
			$row3 = mysql_fetch_array($result3);
			$special_attack .= $row3['name'].";";
		}
		$special_attack = substr_replace($special_attack, "", -1, 1);
		echo $special_attack.":";
		
		//if deleveling get attributes for level - 1
		if( $delevel == 1 )
		{
			$level -= 1;
			$result2 = mysql_query("SELECT * FROM player_xp WHERE level='$level'");
			$row2 = mysql_fetch_array($result2);			
		}
		echo $row2['brut'].":".$row2['acc'].":".$row2['fort'].":".$row2['def'];
	}
	else
	{
		echo "No user";
	}
?>