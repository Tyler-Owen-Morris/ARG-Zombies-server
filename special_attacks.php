<?php

ob_start();

?>

<html>

<head>

<title>Add special attacks - MMO iPhone</title>

</head>

<?php

include ("db_connect.php");

?>

<h3>Add special attacks - MMO iPhone</h3>

<?php

if (isset($_GET['view'])){

$result = mysql_query("SELECT * FROM special_attacks ORDER BY id_attack");

?>

<table style="width: 1000px;margin: 0 auto;clear: right;margin: 10px 0px 40px 0px;">

<tr>

<td style="background: #eeeeee;width: auto;text-align: center;"><a href="special_attacks.php" style="text-decoration:none;">Back</td>

</tr>

<tr>

<th></th>

<th style="font-weight: bold; background: #5b7480;width:10%">ID</th>

<th style="font-weight: bold; background: #5b7480;width:15%">Name</th>

<th style="font-weight: bold; background: #5b7480;width:15%">Regen</th>

<th style="font-weight: bold; background: #5b7480;width:15%">Damage</th>

<th style="font-weight: bold; background: #5b7480;width:15%">Formula</th>

<th style="font-weight: bold; background: #5b7480;width:15%">Coeficient</th>

<th style="font-weight: bold; background: #5b7480;width:15%">Min level</th>

<th style="font-weight: bold; background: #5b7480;width:15%">Weapon type</th>

<th style="font-weight: bold; background: #5b7480;width:15%">Type</th>

<th style="font-weight: bold; background: #5b7480;width:15%">Target</th>

<th style="font-weight: bold; background: #5b7480;width:15%">100% accuracy</th>

<th style="font-weight: bold; background: #5b7480;width:15%">% lost/sec</th>

</tr>

<?php

while ($row = mysql_fetch_array($result)){

?>

<tr>

<td style="background: #eeeeee;width: auto;text-align: center;"><a href="special_attacks.php?id=<?php echo $row['id']; ?>&edit" style="text-decoration:none">[edit]</td>

<td style="background: #eeeeee;width: auto;text-align: center;"><?php echo $row['id_attack']; ?></td>

<td style="background: #eeeeee;width: auto;text-align: center;"><?php echo $row['name']; ?></td>

<td style="background: #eeeeee;width: auto;text-align: center;"><?php echo $row['regen']; ?></td>

<td style="background: #eeeeee;width: auto;text-align: center;"><?php echo $row['damage']; ?></td>

<td style="background: #eeeeee;width: auto;text-align: center;"><?php echo $row['formula']; ?></td>

<td style="background: #eeeeee;width: auto;text-align: center;"><?php echo $row['coef']; ?></td>

<td style="background: #eeeeee;width: auto;text-align: center;"><?php echo $row['level']; ?></td>

<td style="background: #eeeeee;width: auto;text-align: center;"><?php

switch( $row['weapon']){

	case 1:

		echo "Fists";

		break;

	case 2:

		echo "Edge";

		break;

	case 3:

		echo "Ranged";

		break;

	default:

		echo "none";

		break;

}

?></td>

<td style="background: #eeeeee;width: auto;text-align: center;"><?php

switch( $row['type']){

	case 1:

		echo "P.C.";

		break;

	case 2:

		echo "mob";

		break;

	default:

		echo "none";

		break;

}

?></td>

<td style="background: #eeeeee;width: auto;text-align: center;"><?php

switch( $row['target']){

	case 1:

		echo "self";

		break;

	case 2:

		echo "enemy";

		break;

	case 3:

		echo "AOE";

		break;

	default:

		echo "none";

		break;

}

?></td>

<td style="background: #eeeeee;width: auto;text-align: center;"><?php echo $row['accuracy']; ?></td>

<td style="background: #eeeeee;width: auto;text-align: center;"><?php echo $row['lost_sec']; ?></td>

</tr>

<?php

}

?>

<tr>

<td style="background: #eeeeee;width: auto;text-align: center;"><a href="special_attacks.php" style="text-decoration:none;">Back</td>

</tr>

</table>

<?php

}elseif (isset($_GET['edit'])){

	$result = mysql_query("SELECT * FROM special_attacks WHERE id='$_GET[id]'");

	$row = mysql_fetch_array($result);

	$damage = explode("-", $row['damage']);

	if (!isset($_POST['submit'])){

		?>

		<form method="POST" action="">

		<div style="float:left;">

		<div style="float:left;width:170px;">ID: </div><div style="float:left;width:230px;"><input type='text' name='id' value="<?php echo $row['id_attack']; ?>"></div><br /><br />

		<div style="float:left;width:170px;">Name: </div><div style="float:left;width:230px;"><input type='text' name='name' value="<?php echo $row['name']; ?>"></div><br /><br />

		<div style="float:left;width:170px;">Regen cost: </div><div style="float:left;width:230px;"><input type='text' name='regen' value="<?php echo $row['regen']; ?>"></div><br /><br />

		<div style="float:left;width:170px;">Damage: </div><div style="float:left;width:230px;"><input type='text' name='damage1' size='5' value="<?php echo $damage[0]; ?>"> - <input type='text' name='damage2' size='5' value="<?php echo $damage[1]; ?>"></div><br /><br />

		<div style="float:left;width:170px;">Formula: </div><div style="float:left;width:230px;"><input type='text' name='formula' value="<?php echo $row['formula']; ?>"></div><br /><br />

		<div style="float:left;width:170px;">Coeficient: </div><div style="float:left;width:230px;"><input type='text' name='coef' value="<?php echo $row['coef']; ?>"></div><br /><br />

		<div style="float:left;width:170px;">Min Level: </div><div style="float:left;width:20px;"><input type='text' name='level' size='5' value="<?php echo $row['level']; ?>"></div><br /><br />

		<div style="float:left;width:170px;">Animation ID: </div><div style="float:left;width:230px;"><input type='text' name='animation' value="<?php echo $row['animation']; ?>"></div><br /><br />

		<div style="float:left;width:170px;">100% accuracy: </div><div style="float:left;width:230px;"><input type='text' name='accuracy'  value="<?php echo $row['accuracy']; ?>" size='5'></div><br /><br />

		<div style="float:left;width:170px;">% lost/sec: </div><div style="float:left;width:230px;"><input type='text' name='lost_sec'  value="<?php echo $row['lost_sec']; ?>" size='5'></div><br /><br />

		<input type='submit' name='submit' value='Save' ><a href="special_attacks.php?view">Leave</a>

		<br /><br />

		<a href="special_attacks.php?view" style="text-decoration:none;">View all entries from database</a>

	</div>

	<div style="float:left;">

	Weapon Type<br />

		<input type="radio" name="weapon" value="1" <?php if ($row['weapon'] == '1') echo "checked"; ?>/> Fists<br />

		<input type="radio" name="weapon" value="2" <?php if ($row['weapon'] == '2') echo "checked"; ?>/> Edge<br />

		<input type="radio" name="weapon" value="3" <?php if ($row['weapon'] == '3') echo "checked"; ?>/> Ranged<br />

		<input type="radio" name="weapon" value="0" <?php if ($row['weapon'] == '0') echo "checked"; ?>/> none<br />

	<br /><br />

	Type<br />

		<input type="radio" name="type" value="1" <?php if ($row['type'] == '1') echo "checked"; ?>/> P.C.<br />

		<input type="radio" name="type" value="2" <?php if ($row['type'] == '2') echo "checked"; ?>/> mob<br />

		<input type="radio" name="type" value="0" <?php if ($row['type'] == '0') echo "checked"; ?>/> none<br />

	<br /><br />

	Target<br />

		<input type="radio" name="target" value="1" <?php if ($row['target'] == '1') echo "checked"; ?>/> Self<br />

		<input type="radio" name="target" value="2" <?php if ($row['target'] == '2') echo "checked"; ?>/> Enemy<br />

		<input type="radio" name="target" value="3" <?php if ($row['target'] == '3') echo "checked"; ?>/> AOE<br />

		<input type="radio" name="target" value="0" <?php if ($row['target'] == '0') echo "checked"; ?>/> none<br />		

	</div>

		</form>

<?php

	}elseif (empty($_POST['id']) || empty($_POST['name'])){

		$error = "";

		if (empty($_POST['id']))

			$error .= "<font color='red'><b>Please insert ID</b></font><br />";

		if (empty($_POST['name']))

			$error .= "<font color='red'><b>Please insert Name</b></font><br />";

		echo $error;

		?>

		<form method="POST" action="">

		<div style="float:left;">

		<div style="float:left;width:170px;">ID: </div><div style="float:left;width:130px;"><input type='text' name='id' value="<?php echo $_POST['id']; ?>"></div><br /><br />

		<div style="float:left;width:170px;">Name: </div><div style="float:left;width:130px;"><input type='text' name='name' value="<?php echo $_POST['name']; ?>"></div><br /><br />

		<div style="float:left;width:170px;">Regen cost: </div><div style="float:left;width:130px;"><input type='text' name='regen' value="<?php echo $_POST['regen']; ?>"></div><br /><br />

		<div style="float:left;width:170px;">Damage: </div><div style="float:left;width:130px;"><input type='text' name='damage1' size='5' value="<?php echo $_POST['damage1']; ?>"> - <input type='text' name='damage2' size='5' value="<?php echo $_POST['damage2']; ?>"></div><br /><br />

		<div style="float:left;width:170px;">Formula: </div><div style="float:left;width:130px;"><input type='text' name='formula' value="<?php echo $_POST['formula']; ?>"></div><br /><br />

		<div style="float:left;width:170px;">Coeficient: </div><div style="float:left;width:130px;"><input type='text' name='coef' value="<?php echo $_POST['coef']; ?>"></div><br /><br />

		<div style="float:left;width:170px;">Min Level: </div><div style="float:left;width:130px;"><input type='text' name='level' size='5' value="<?php echo $_POST['level']; ?>"></div><br /><br />

		<div style="float:left;width:170px;">Animation ID: </div><div style="float:left;width:230px;"><input type='text' name='animation' value="<?php echo $_POST['animation']; ?>"></div><br /><br />

		<div style="float:left;width:170px;">100% accuracy: </div><div style="float:left;width:230px;"><input type='text' name='accuracy'  value="<?php echo $_POST['accuracy']; ?>" size='5'></div><br /><br />

		<div style="float:left;width:170px;">% lost/sec: </div><div style="float:left;width:230px;"><input type='text' name='lost_sec'  value="<?php echo $_POST['lost_sec']; ?>" size='5'></div><br /><br />

		<input type='submit' name='submit' value='Save' >

		</div>

	<div style="float:left;">

	Weapon Type<br />

		<input type="radio" name="weapon" value="1" <?php if ($_POST['weapon'] == '1') echo "checked"; ?>/> Fists<br />

		<input type="radio" name="weapon" value="2" <?php if ($_POST['weapon'] == '2') echo "checked"; ?>/> Edge<br />

		<input type="radio" name="weapon" value="3" <?php if ($_POST['weapon'] == '3') echo "checked"; ?>/> Ranged<br />

		<input type="radio" name="weapon" value="0" <?php if ($_POST['weapon'] == '0') echo "checked"; ?>/> none<br />

	<br /><br />

	Type<br />

		<input type="radio" name="type" value="1" <?php if ($_POST['type'] == '1') echo "checked"; ?>/> P.C.<br />

		<input type="radio" name="type" value="2" <?php if ($_POST['type'] == '2') echo "checked"; ?>/> mob<br />

		<input type="radio" name="type" value="0" <?php if ($_POST['type'] == '0') echo "checked"; ?>/> none<br />

	<br /><br />

	Target<br />

		<input type="radio" name="target" value="1" <?php if ($_POST['target'] == '1') echo "checked"; ?>/> Self<br />

		<input type="radio" name="target" value="2" <?php if ($_POST['target'] == '2') echo "checked"; ?>/> Enemy<br />

		<input type="radio" name="target" value="3" <?php if ($_POST['target'] == '3') echo "checked"; ?>/> AOE<br />

		<input type="radio" name="target" value="0" <?php if ($_POST['target'] == '0') echo "checked"; ?>/> none<br />		

	</div>

		</form>

<?php

	}else{

		$result = mysql_query("SELECT * FROM special_attacks WHERE id_attack = '$_POST[id]'");

		$rows = mysql_num_rows ($result);

		if ($rows > 0)

		{

			$row = mysql_fetch_array($result);

			if ($row['id'] == $_GET['id'])

			{

				$name = addslashes($_POST['name']);

				$animation = addslashes($_POST['animation']);

				if (!empty($_POST['regen']))

					$regen = $_POST['regen'];

				else $regen = 0;

				if (!empty($_POST['formula']))

					$formula = $_POST['formula'];

				else $formula = 0;

				if (!empty($_POST['coef']))

					$coef = $_POST['coef'];

				else $coef = 0;

				if (!empty($_POST['accuracy']))

					$accuracy = (int)$_POST['accuracy'];

				else $accuracy = 0;

				if (!empty($_POST['lost_sec']))

					$lost_sec = (int)$_POST['lost_sec'];

				else $lost_sec = 0;

				$damage = $_POST['damage1']."-".$_POST['damage2'];

					mysql_query("UPDATE special_attacks SET id_attack='$_POST[id]', name='$name', regen='$regen', formula='$formula', coef='$coef', 

								damage='$damage', level='$_POST[level]', weapon='$_POST[weapon]', animation='$_POST[animation]', 

								type='$_POST[type]', target='$_POST[target]', accuracy='$accuracy', lost_sec='$lost_sec' WHERE id='$_GET[id]'");

					header ("Location:special_attacks.php?view");

						//print_r($_POST);

			}else{

				echo "<font color='red'><b>ID is in database!</b></font><br />";

				?>

					<form method="POST" action="">

					<div style="float:left;">

					<div style="float:left;width:170px;">ID: </div><div style="float:left;width:130px;"><input type='text' name='id'></div><br /><br />

					<div style="float:left;width:170px;">Name: </div><div style="float:left;width:130px;"><input type='text' name='name' value="<?php echo $_POST['name']; ?>"></div><br /><br />

					<div style="float:left;width:170px;">Regen cost: </div><div style="float:left;width:130px;"><input type='text' name='regen' value="<?php echo $_POST['regen']; ?>"></div><br /><br />

					<div style="float:left;width:170px;">Damage: </div><div style="float:left;width:130px;"><input type='text' name='damage1' size='5' value="<?php echo $_POST['damage1']; ?>"> - <input type='text' name='damage2' size='5' value="<?php echo $_POST['damage2']; ?>"></div><br /><br />

					<div style="float:left;width:170px;">Formula: </div><div style="float:left;width:130px;"><input type='text' name='formula' value="<?php echo $_POST['formula']; ?>"></div><br /><br />

					<div style="float:left;width:170px;">Coeficient: </div><div style="float:left;width:130px;"><input type='text' name='coef' value="<?php echo $_POST['coef']; ?>"></div><br /><br />

					<div style="float:left;width:170px;">Min Level: </div><div style="float:left;width:130px;"><input type='text' name='level' size='5' value="<?php echo $_POST['level']; ?>"></div><br /><br />

					<div style="float:left;width:170px;">Animation ID: </div><div style="float:left;width:230px;"><input type='text' name='animation' value="<?php echo $_POST['animation']; ?>"></div><br /><br />

					<div style="float:left;width:170px;">100% accuracy: </div><div style="float:left;width:230px;"><input type='text' name='accuracy'  value="<?php echo $_POST['accuracy']; ?>" size='5'></div><br /><br />

					<div style="float:left;width:170px;">% lost/sec: </div><div style="float:left;width:230px;"><input type='text' name='lost_sec'  value="<?php echo $_POST['lost_sec']; ?>" size='5'></div><br /><br />

					<input type='submit' name='submit' value='Save' >

		</div>

	<div style="float:left;">

	Weapon Type<br />

		<input type="radio" name="weapon" value="1" <?php if ($_POST['weapon'] == '1') echo "checked"; ?>/> Fists<br />

		<input type="radio" name="weapon" value="2" <?php if ($_POST['weapon'] == '2') echo "checked"; ?>/> Edge<br />

		<input type="radio" name="weapon" value="3" <?php if ($_POST['weapon'] == '3') echo "checked"; ?>/> Ranged<br />

		<input type="radio" name="weapon" value="0" <?php if ($_POST['weapon'] == '0') echo "checked"; ?>/> none<br />

	<br /><br />

	Type<br />

		<input type="radio" name="type" value="1" <?php if ($_POST['type'] == '1') echo "checked"; ?>/> P.C.<br />

		<input type="radio" name="type" value="2" <?php if ($_POST['type'] == '2') echo "checked"; ?>/> mob<br />

		<input type="radio" name="type" value="0" <?php if ($_POST['type'] == '0') echo "checked"; ?>/> none<br />

	<br /><br />

	Target<br />

		<input type="radio" name="target" value="1" <?php if ($_POST['target'] == '1') echo "checked"; ?>/> Self<br />

		<input type="radio" name="target" value="2" <?php if ($_POST['target'] == '2') echo "checked"; ?>/> Enemy<br />

		<input type="radio" name="target" value="3" <?php if ($_POST['target'] == '3') echo "checked"; ?>/> AOE<br />

		<input type="radio" name="target" value="0" <?php if ($_POST['target'] == '0') echo "checked"; ?>/> none<br />		

	</div>

		</form>

				<?php

			}

		}else{

			$name = addslashes($_POST['name']);

				if (!empty($_POST['regen']))

					$regen = $_POST['regen'];

				else $regen = 0;

				if (!empty($_POST['formula']))

					$formula = $_POST['formula'];

				else $formula = 0;

				if (!empty($_POST['coef']))

					$coef = $_POST['coef'];

				else $coef = 0;

				if (!empty($_POST['accuracy']))

					$accuracy = (int)$_POST['accuracy'];

				else $accuracy = 0;

				if (!empty($_POST['lost_sec']))

					$lost_sec = (int)$_POST['lost_sec'];

				else $lost_sec = 0;

				$damage = $_POST['damage1']."-".$_POST['damage2'];

					mysql_query("UPDATE special_attacks SET id_attack='$_POST[id]', name='$name', regen='$regen', formula='$formula', coef='$coef', 

								damage='$damage', level='$_POST[level]', weapon='$_POST[weapon]', animation='$_POST[animation]', 

								type='$_POST[type]', target='$_POST[target]', accuracy='$accuracy', lost_sec='$lost_sec' WHERE id='$_GET[id]'");

					header ("Location:special_attacks.php?view");

		}

	}

}else{

if (!isset($_POST['submit'])){

?>

	<form method="POST" action="">

	<div style="float:left;">

		<div style="float:left;width:170px;">ID: </div><div style="float:left;width:230px;"><input type='text' name='id' ></div><br /><br />

		<div style="float:left;width:170px;">Name: </div><div style="float:left;width:230px;"><input type='text' name='name' ></div><br /><br />

		<div style="float:left;width:170px;">Regen cost: </div><div style="float:left;width:230px;"><input type='text' name='regen' ></div><br /><br />

		<div style="float:left;width:170px;">Damage: </div><div style="float:left;width:230px;"><input type='text' name='damage1' size='5'> - <input type='text' name='damage2' size='5'></div><br /><br />

		<div style="float:left;width:170px;">Formula: </div><div style="float:left;width:230px;"><input type='text' name='formula' ></div><br /><br />

		<div style="float:left;width:170px;">Coeficient: </div><div style="float:left;width:230px;"><input type='text' name='coef' ></div><br /><br />

		<div style="float:left;width:170px;">Min Level: </div><div style="float:left;width:230px;"><input type='text' name='level' size='5'></div><br /><br />

		<div style="float:left;width:170px;">Animation ID: </div><div style="float:left;width:230px;"><input type='text' name='animation' ></div><br /><br />

		<div style="float:left;width:170px;">100% accuracy: </div><div style="float:left;width:230px;"><input type='text' name='accuracy' size='5'></div><br /><br />

		<div style="float:left;width:170px;">% lost/sec: </div><div style="float:left;width:230px;"><input type='text' name='lost_sec' size='5'></div><br /><br />

		<input type='submit' name='submit' value='Save' >

		<br /><br />

		<a href="special_attacks.php?view" style="text-decoration:none;">View all entries from database</a>

	</div>

	<div style="float:left;">

	Weapon Type<br />

		<input type="radio" name="weapon" value="1" /> Fists<br />

		<input type="radio" name="weapon" value="2" /> Edge<br />

		<input type="radio" name="weapon" value="3" /> Ranged<br />

		<input type="radio" name="weapon" value="0" /> none<br />

	<br /><br />

	Type<br />

		<input type="radio" name="type" value="1" /> P.C.<br />

		<input type="radio" name="type" value="2" /> mob<br />

		<input type="radio" name="type" value="0" /> none<br />

	<br /><br />

	Target<br />

		<input type="radio" name="target" value="1" /> Self<br />

		<input type="radio" name="target" value="2" /> Enemy<br />

		<input type="radio" name="target" value="3" /> AOE<br />

		<input type="radio" name="target" value="0" /> none<br />

	</div>

		</form>

		

<?php

}elseif (empty($_POST['id']) || empty($_POST['name']) || empty($_POST['weapon'])){

	$error = "";

	if (empty($_POST['id']))

		$error .= "<font color='red'><b>Please insert ID</b></font><br />";

	if (empty($_POST['name']))

		$error .= "<font color='red'><b>Please insert Name</b></font><br />";

	echo $error;

	?>

	<form method="POST" action="">

	<div style="float:left;">

		<div style="float:left;width:170px;">ID: </div><div style="float:left;width:230px;"><input type='text' name='id' value="<?php echo $_POST['id']; ?>"></div><br /><br />

		<div style="float:left;width:170px;">Name: </div><div style="float:left;width:230px;"><input type='text' name='name' value="<?php echo $_POST['name']; ?>"></div><br /><br />

		<div style="float:left;width:170px;">Regen cost: </div><div style="float:left;width:230px;"><input type='text' name='regen' value="<?php echo $_POST['regen']; ?>"></div><br /><br />

		<div style="float:left;width:170px;">Damage: </div><div style="float:left;width:230px;"><input type='text' name='damage1' size='5' value="<?php echo $_POST['damage1']; ?>"> - <input type='text' name='damage2' size='5' value="<?php echo $_POST['damage2']; ?>"></div><br /><br />

		<div style="float:left;width:170px;">Formula: </div><div style="float:left;width:230px;"><input type='text' name='formula' value="<?php echo $_POST['formula']; ?>"></div><br /><br />

		<div style="float:left;width:170px;">Coeficient: </div><div style="float:left;width:230px;"><input type='text' name='coef' value="<?php echo $_POST['coef']; ?>"></div><br /><br />

		<div style="float:left;width:170px;">Min Level: </div><div style="float:left;width:230px;"><input type='text' name='level' size='5' value="<?php echo $_POST['level']; ?>"></div><br /><br />

		<div style="float:left;width:170px;">Animation ID: </div><div style="float:left;width:230px;"><input type='text' name='animation' value="<?php echo $_POST['animation']; ?>"></div><br /><br />

		<div style="float:left;width:170px;">100% accuracy: </div><div style="float:left;width:230px;"><input type='text' name='accuracy'  value="<?php echo $_POST['accuracy']; ?>" size='5'></div><br /><br />

		<div style="float:left;width:170px;">% lost/sec: </div><div style="float:left;width:230px;"><input type='text' name='lost_sec'  value="<?php echo $_POST['lost_sec']; ?>" size='5'></div><br /><br />

		<input type='submit' name='submit' value='Save' >

		<br /><br />

		<a href="special_attacks.php?view" style="text-decoration:none;">View all entries from database</a>

	</div>

	<div style="float:left;">

	Weapon Type<br />

		<input type="radio" name="weapon" value="1" <?php if ($_POST['weapon'] == '1') echo "checked"; ?>/> Fists<br />

		<input type="radio" name="weapon" value="2" <?php if ($_POST['weapon'] == '2') echo "checked"; ?>/> Edge<br />

		<input type="radio" name="weapon" value="3" <?php if ($_POST['weapon'] == '3') echo "checked"; ?>/> Ranged<br />

		<input type="radio" name="weapon" value="0" <?php if ($_POST['weapon'] == '0') echo "checked"; ?>/> none<br />

	<br /><br />

	Type<br />

		<input type="radio" name="type" value="1" <?php if ($_POST['type'] == '1') echo "checked"; ?>/> P.C.<br />

		<input type="radio" name="type" value="2" <?php if ($_POST['type'] == '2') echo "checked"; ?>/> mob<br />

		<input type="radio" name="type" value="0" <?php if ($_POST['type'] == '0') echo "checked"; ?>/> none<br />

	<br /><br />

	Target<br />

		<input type="radio" name="target" value="1" <?php if ($_POST['target'] == '1') echo "checked"; ?>/> Self<br />

		<input type="radio" name="target" value="2" <?php if ($_POST['target'] == '2') echo "checked"; ?>/> Enemy<br />

		<input type="radio" name="target" value="3" <?php if ($_POST['target'] == '3') echo "checked"; ?>/> AOE<br />

		<input type="radio" name="target" value="0" <?php if ($_POST['target'] == '0') echo "checked"; ?>/> none<br />	

	</div>

		</form>

<?php

}else{

	$result = mysql_query("SELECT * FROM special_attacks WHERE id_attack = '$_POST[id]'");

	$rows = mysql_num_rows($result);

	if ($rows > 0)

	{

		echo "<font color='red'><b>ID is in database!</b></font><br />";

		?>

		<form method="POST" action="">

		<div style="float:left;">

		<div style="float:left;width:170px;">ID: </div><div style="float:left;width:230px;"><input type='text' name='id'></div><br /><br />

		<div style="float:left;width:170px;">Name: </div><div style="float:left;width:230px;"><input type='text' name='name' value="<?php echo $_POST['name']; ?>"></div><br /><br />

		<div style="float:left;width:170px;">Regen cost: </div><div style="float:left;width:230px;"><input type='text' name='regen' value="<?php echo $_POST['regen']; ?>"></div><br /><br />

		<div style="float:left;width:170px;">Damage: </div><div style="float:left;width:230px;"><input type='text' name='damage1' size='5' value="<?php echo $_POST['damage1']; ?>"> - <input type='text' name='damage2' size='5' value="<?php echo $_POST['damage2']; ?>"></div><br /><br />

		<div style="float:left;width:170px;">Formula: </div><div style="float:left;width:230px;"><input type='text' name='formula' value="<?php echo $_POST['formula']; ?>"></div><br /><br />

		<div style="float:left;width:170px;">Coeficient: </div><div style="float:left;width:230px;"><input type='text' name='coef' value="<?php echo $_POST['coef']; ?>"></div><br /><br />

		<div style="float:left;width:170px;">Min Level: </div><div style="float:left;width:230px;"><input type='text' name='level' size='5' value="<?php echo $_POST['level']; ?>"></div><br /><br />

		<div style="float:left;width:170px;">Animation ID: </div><div style="float:left;width:230px;"><input type='text' name='animation' value="<?php echo $_POST['animation']; ?>"></div><br /><br />

		<div style="float:left;width:170px;">100% accuracy: </div><div style="float:left;width:230px;"><input type='text' name='accuracy'  value="<?php echo $_POST['accuracy']; ?>" size='5'></div><br /><br />

		<div style="float:left;width:170px;">% lost/sec: </div><div style="float:left;width:230px;"><input type='text' name='lost_sec'  value="<?php echo $_POST['lost_sec']; ?>" size='5'></div><br /><br />

		<input type='submit' name='submit' value='Save' >

		<br /><br />

		<a href="special_attacks.php?view" style="text-decoration:none;">View all entries from database</a>

	</div>

	<div style="float:left;">

	Weapon Type<br />

		<input type="radio" name="weapon" value="1" <?php if ($_POST['weapon'] == '1') echo "checked"; ?>/> Fists<br />

		<input type="radio" name="weapon" value="2" <?php if ($_POST['weapon'] == '2') echo "checked"; ?>/> Edge<br />

		<input type="radio" name="weapon" value="3" <?php if ($_POST['weapon'] == '3') echo "checked"; ?>/> Ranged<br />

		<input type="radio" name="weapon" value="0" <?php if ($_POST['weapon'] == '0') echo "checked"; ?>/> none<br />

	<br /><br />

	Type<br />

		<input type="radio" name="type" value="1" <?php if ($_POST['type'] == '1') echo "checked"; ?>/> P.C.<br />

		<input type="radio" name="type" value="2" <?php if ($_POST['type'] == '2') echo "checked"; ?>/> mob<br />

		<input type="radio" name="type" value="0" <?php if ($_POST['type'] == '0') echo "checked"; ?>/> none<br />

	<br /><br />

	Target<br />

		<input type="radio" name="target" value="1" <?php if ($_POST['target'] == '1') echo "checked"; ?>/> Self<br />

		<input type="radio" name="target" value="2" <?php if ($_POST['target'] == '2') echo "checked"; ?>/> Enemy<br />

		<input type="radio" name="target" value="3" <?php if ($_POST['target'] == '3') echo "checked"; ?>/> AOE<br />

		<input type="radio" name="target" value="0" <?php if ($_POST['target'] == '0') echo "checked"; ?>/> none<br />		

	</div>

		</form>

<?php

}else{

	$name = addslashes($_POST['name']);

	$animation = addslashes($_POST['animation']);

	if (!empty($_POST['regen']))

		$regen = $_POST['regen'];

	else $regen = 0;

	if (!empty($_POST['formula']))

		$formula = $_POST['formula'];

	else $formula = 0;

	if (!empty($_POST['coef']))

		$coef = $_POST['coef'];

	else $coef = 0;

	if (!empty($_POST['accuracy']))

		$accuracy = (int)$_POST['accuracy'];

	else $accuracy = 0;

	if (!empty($_POST['lost_sec']))

		$lost_sec = (int)$_POST['lost_sec'];

	else $lost_sec = 0;

	$damage = $_POST['damage1']."-".$_POST['damage2'];

		mysql_query("INSERT INTO special_attacks (id_attack, name, regen, damage, formula, coef, level, weapon, type, animation, target, accuracy, lost_sec) 

					VALUES ('$_POST[id]', '$name', '$regen', '$damage', '$formula', '$coef', '$_POST[level]', '$_POST[weapon]', '$_POST[type]', 

					'$animation', '$_POST[target]', '$accuracy', '$lost_sec')");

	header ("Location:special_attacks.php");

}

}

}

ob_end_flush();

?>

</html>