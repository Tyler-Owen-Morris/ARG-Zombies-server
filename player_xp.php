<?php

ob_start();

?>

<html>

<head>

<title>Player XP - MMO iPhone</title>



</head>

<?php

include ("db_connect.php");

?>

<h3>Player XP - MMO iPhone</h3>

<?php

if (isset($_GET['view'])){

	?>

	<table style="width: 700px;margin: 0 auto;clear: right;margin: 10px 0px 40px 0px;">

	<tr>

	<td style="background: #eeeeee;width: auto;text-align: center;"><a href="player_xp.php" style="text-decoration:none;">Back</td>

	</tr>

	<tr>

	<th></th>

	<th style="font-weight: bold; background: #5b7480;width:20%">Level</th>

	<th style="font-weight: bold; background: #5b7480;width:30%">XP</th>

	<th style="font-weight: bold; background: #5b7480;width:50%">Special</th>

	<th style="font-weight: bold; background: #5b7480;width:50%">BRUT</th>

	<th style="font-weight: bold; background: #5b7480;width:50%">ACC</th>

	<th style="font-weight: bold; background: #5b7480;width:50%">FORT</th>

	<th style="font-weight: bold; background: #5b7480;width:50%">DEF</th>

	</tr>

	<?php

	$result = mysql_query("SELECT * FROM player_xp ORDER BY level");

	while($row = mysql_fetch_array($result)){

		?>	<tr>

			<td style="background: #eeeeee;width: auto;text-align: center;"><a href="player_xp.php?id=<?php echo $row['id']; ?>&edit" style="text-decoration:none">[edit]</td>

			<td style="background: #eeeeee;width: auto;text-align: center;"><?php echo $row['level']; ?></td>

			<td style="background: #eeeeee;width: auto;text-align: center;"><?php echo $row['xp']; ?></td>

			<td style="background: #eeeeee;width: auto;text-align: center;"><?php

			$special = explode(";", $row['special']);

			foreach ($special as $val){

				$result2 = mysql_query("SELECT * FROM special_attacks WHERE id_attack='$val'");

				$row2 = mysql_fetch_array($result2);

				echo $row2['name']."<br />";

			}

			?></td>

			<td style="background: #eeeeee;width: auto;text-align: center;"><?php echo $row['brut']; ?></td>

			<td style="background: #eeeeee;width: auto;text-align: center;"><?php echo $row['acc']; ?></td>

			<td style="background: #eeeeee;width: auto;text-align: center;"><?php echo $row['fort']; ?></td>

			<td style="background: #eeeeee;width: auto;text-align: center;"><?php echo $row['def']; ?></td>

			</tr>

		<?php

	}

}elseif (isset($_GET['edit'])){

	$id = $_GET['id'];

	if (!isset($_POST['submit'])){

	$result = mysql_query("SELECT * FROM player_xp WHERE id='$id'");

	$row = mysql_fetch_array($result);

	$special = stripslashes($row['special']);

	?>

	<form method="POST" action="">



	<div style="float:left;width:170px;">Level: </div><div style="float:left;width:130px;"><input type='text' name='level' size='5' value="<?php echo $row['level']; ?>"></div><br /><br />

	<div style="float:left;width:170px;">XP: </div><div style="float:left;width:130px;"><input type='text' name='xp' size='8' value="<?php echo $row['xp']; ?>"></div><br /><br />

	<div style="float:left;width:170px;">Special (if exists) : </div><div style="float:left;width:130px;">

	<?php

		$special = explode(";", $row['special']);

		//print_r($special);

		$result2 = mysql_query("SELECT * FROM special_attacks ORDER BY id");

		$row2 = mysql_fetch_array($result2);

		?>

			<select name="special[]" multiple="multiple"> 

		

    <?php do { ?>

	<option value="<?php echo $row2['id_attack']; ?>" <?php if (in_array("$row2[id_attack]", $special)) echo "selected"; ?>><?php echo $row2['name']; ?></option>

    <?php } while ($row2 = mysql_fetch_assoc($result2)); ?>

    </select>



	</div><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />

	<div style="float:left;width:170px;">BRUT: </div><div style="float:left;width:130px;"><input type='text' name='brut' size='8' value="<?php echo $row['brut']; ?>"></div><br /><br />

	<div style="float:left;width:170px;">ACC: </div><div style="float:left;width:130px;"><input type='text' name='acc' size='8' value="<?php echo $row['acc']; ?>"></div><br /><br />

	<div style="float:left;width:170px;">FORT: </div><div style="float:left;width:130px;"><input type='text' name='fort' size='8' value="<?php echo $row['fort']; ?>"></div><br /><br />

	<div style="float:left;width:170px;">DEF: </div><div style="float:left;width:130px;"><input type='text' name='def' size='8' value="<?php echo $row['def']; ?>"></div><br /><br />

	

	<input type='submit' name='submit' value='Save' /> 



<a href="player_xp.php?view" style="text-decoration:none;">Leave</a>

</form>

<?php

}else{

	$special='';

	foreach ($_POST['special'] as $val){

		$special.=$val.";";

	}

	if (empty($_POST['brut']))

		$brut = '0';

	else $brut = $_POST['brut'];



	if (empty($_POST['acc']))

		$acc = '0';

	else $acc = $_POST['acc'];

	

	if (empty($_POST['fort']))

		$fort = '0';

	else $fort = $_POST['fort'];

	

	if (empty($_POST['def']))

		$def = '0';

	else $def = $_POST['def'];

	$special=substr_replace($special, "", -1, 1);

	//print_r($_POST);

	mysql_query("UPDATE player_xp SET level='$_POST[level]', xp='$_POST[xp]', special='$special', brut='$brut', acc='$acc', fort='$fort', def='$def' WHERE id='$id'");

	header("Location:player_xp.php?view");

}

}elseif(!isset($_POST['submit'])){

?>

	<form method="POST" action="">



	<div style="float:left;width:170px;">Level: </div><div style="float:left;width:130px;"><input type='text' name='level' size='5'></div><br /><br />

	<div style="float:left;width:170px;">XP: </div><div style="float:left;width:130px;"><input type='text' name='xp' size='8'></div><br /><br />

	<div style="float:left;width:170px;">Special (if exists) : </div><div style="float:left;width:130px;">

	<?php

		$result = mysql_query("SELECT * FROM special_attacks ORDER BY id");

		$row = mysql_fetch_array($result);

		?>

			<select name="special[]" multiple="multiple"> 

		

    <?php do { ?>

	<option value="<?php echo $row['id_attack']; ?>"><?php echo $row['name']; ?></option>

    <?php } while ($row = mysql_fetch_assoc($result)); ?>

    </select>



	</div><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />

	<div style="float:left;width:170px;">BRUT: </div><div style="float:left;width:130px;"><input type='text' name='brut' size='8'></div><br /><br />

	<div style="float:left;width:170px;">ACC: </div><div style="float:left;width:130px;"><input type='text' name='acc' size='8'></div><br /><br />

	<div style="float:left;width:170px;">FORT: </div><div style="float:left;width:130px;"><input type='text' name='fort' size='8'></div><br /><br />

	<div style="float:left;width:170px;">DEF: </div><div style="float:left;width:130px;"><input type='text' name='def' size='8'></div><br /><br />

	<input type='submit' name='submit' value='Save' /> 

	</form>

<div>

<a href="player_xp.php?view" style="text-decoration:none;">View all entries from database</a>

</div>

	<?php

}elseif (empty($_POST['level']) || empty($_POST['xp'])){

	$error = "";

	if (empty($_POST['level']))

		$error .= "<font color='red'><b>Please insert level</b></font><br />";

	if (empty($_POST['xp']))

		$error .= "<font color='red'><b>Please insert XP</b></font><br />";

	echo $error;

	?>

	<form method="POST" action="">



	<div style="float:left;width:170px;">Level: </div><div style="float:left;width:130px;"><input type='text' name='level' size='5' value="<?php echo $_POST['level']; ?>"></div><br /><br />

	<div style="float:left;width:170px;">XP: </div><div style="float:left;width:130px;"><input type='text' name='xp' size='8' value="<?php echo $_POST['xp']; ?>"></div><br /><br />

	<div style="float:left;width:170px;">Special (if exists) : </div><div style="float:left;width:130px;">

	<?php

		$result = mysql_query("SELECT * FROM special_attacks ORDER BY id");

		$row = mysql_fetch_array($result);

		?>

			<select name="special[]" multiple="multiple"> 

		

    <?php do { ?>

	<option value="<?php echo $row['id_attack']; ?>" <?php if ($_POST['special'] !=''){ if (in_array("$row[id_attack]", $_POST['special'])) echo "selected"; }?>><?php echo $row['name']; ?></option>

    <?php } while ($row = mysql_fetch_assoc($result)); ?>

    </select>



	</div><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />

	<div style="float:left;width:170px;">BRUT: </div><div style="float:left;width:130px;"><input type='text' name='brut' size='8' value="<?php echo $_POST['brut']; ?>"></div><br /><br />

	<div style="float:left;width:170px;">ACC: </div><div style="float:left;width:130px;"><input type='text' name='acc' size='8' value="<?php echo $_POST['acc']; ?>"></div><br /><br />

	<div style="float:left;width:170px;">FORT: </div><div style="float:left;width:130px;"><input type='text' name='fort' size='8' value="<?php echo $_POST['fort']; ?>"></div><br /><br />

	<div style="float:left;width:170px;">DEF: </div><div style="float:left;width:130px;"><input type='text' name='def' size='8' value="<?php echo $_POST['def']; ?>"></div><br /><br />

	<input type='submit' name='submit' value='Save' /> 

	<?php

}else{



	$result2 = mysql_query("SELECT * FROM player_xp WHERE level='$_POST[level]'");

	$rows2 = mysql_num_rows($result2);

	if ($rows2 > 0){

		$error .= "<font color='red'><b>Level allready inserted!</b></font><br />";

		echo $error;

		?>

		<form method="POST" action="">



		<div style="float:left;width:170px;">Level: </div><div style="float:left;width:130px;"><input type='text' name='level' size='5' value="<?php echo $_POST['level']; ?>"></div><br /><br />

		<div style="float:left;width:170px;">XP: </div><div style="float:left;width:130px;"><input type='text' name='xp' size='8' value="<?php echo $_POST['xp']; ?>"></div><br /><br />

		<div style="float:left;width:170px;">Special (if exists) : </div><div style="float:left;width:130px;">

		<?php

			$result = mysql_query("SELECT * FROM special_attacks ORDER BY id");

			$row = mysql_fetch_array($result);

			?>

				<select name="special[]" multiple="multiple"> 

			

		<?php do { ?>

		<option value="<?php echo $row['id_attack']; ?>" <?php if ($_POST['special'] !=''){ if (in_array("$row[id_attack]", $_POST['special'])) echo "selected"; }?>><?php echo $row['name']; ?></option>

		<?php } while ($row = mysql_fetch_assoc($result)); ?>

		</select>



		</div><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />

		<div style="float:left;width:170px;">BRUT: </div><div style="float:left;width:130px;"><input type='text' name='brut' size='8' value="<?php echo $_POST['brut']; ?>"></div><br /><br />

		<div style="float:left;width:170px;">ACC: </div><div style="float:left;width:130px;"><input type='text' name='acc' size='8' value="<?php echo $_POST['acc']; ?>"></div><br /><br />

		<div style="float:left;width:170px;">FORT: </div><div style="float:left;width:130px;"><input type='text' name='fort' size='8' value="<?php echo $_POST['fort']; ?>"></div><br /><br />

		<div style="float:left;width:170px;">DEF: </div><div style="float:left;width:130px;"><input type='text' name='def' size='8' value="<?php echo $_POST['def']; ?>"></div><br /><br />

		<input type='submit' name='submit' value='Save' /> 

		<?php

	}else{



	$special='';

	foreach ($_POST['special'] as $val){

		$special.=$val.";";

	}

	if (empty($_POST['brut']))

		$brut = '0';

	else $brut = $_POST['brut'];



	if (empty($_POST['acc']))

		$acc = '0';

	else $acc = $_POST['acc'];

	

	if (empty($_POST['fort']))

		$fort = '0';

	else $fort = $_POST['fort'];

	

	if (empty($_POST['def']))

		$def = '0';

	else $def = $_POST['def'];

	$special=substr_replace($special, "", -1, 1);

	mysql_query("INSERT INTO player_xp (level, xp, special, brut, acc, fort, def) VALUES ('$_POST[level]', '$_POST[xp]', '$special', '$brut', '$acc', '$fort', '$def')");

	header("Location:player_xp.php");

	//print_r($_POST);

	}

}