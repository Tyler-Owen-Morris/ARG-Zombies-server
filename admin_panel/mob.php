<?php session_start();

if(!isset($_SESSION['user']))header('Location:login.php');

include ("db_connect.php");

include("functions.php");

if(!isset($_SESSION['super_user']))$sections=get_access($_SESSION['id']);

else $sections=array(1,2,3,4,5,6,7);

if(!in_array(3,$sections)){

echo "<br><br>You do not have access here!";

}

else{

//page content here

ob_start();

?>

<html>

<head>

<title>Add mob - MMO iPhone</title>



</head>

<body style="background-color:#ababab;">

<a href="logout.php">Logout</a><br><br>

<?php

include("menu.php");

?>

<br><br>

<?php

if (isset($_GET['view'])){

$result = mysql_query("SELECT * FROM mobs_desc ORDER BY name");

?>

<table style="width: 1200px;margin: 0 auto;clear: right;margin: 10px 0px 40px 0px;">

<tr>

<td style="background: #eeeeee;width: auto;text-align: center;"><a href="mob.php" style="text-decoration:none;">Back</td>

</tr>

<tr>

<th></th>

<th style="font-weight: bold; background: #5b7480;width:12%">Name</th>

<th style="font-weight: bold; background: #5b7480;width:5%">HP</th>

<th style="font-weight: bold; background: #5b7480;width:5%">Energy</th>

<th style="font-weight: bold; background: #5b7480;width:5%">Regen</th>

<th style="font-weight: bold; background: #5b7480;width:5%">Defense</th>

<th style="font-weight: bold; background: #5b7480;width:7%">Damage</th>

<th style="font-weight: bold; background: #5b7480;width:5%">Evasion</th>

<th style="font-weight: bold; background: #5b7480;width:7%">Level</th>

<th style="font-weight: bold; background: #5b7480;width:10%">Special Attack</th>

<th style="font-weight: bold; background: #5b7480;width:5%">Loot</th>

<th style="font-weight: bold; background: #5b7480;width:12%">Special Area</th>

<th style="font-weight: bold; background: #5b7480;width:5%">COOLDOWN</th>

<th style="font-weight: bold; background: #5b7480;width:7%">Money</th>

<th style="font-weight: bold; background: #5b7480;width:5%">XP</th>

</tr>

<?php

while ($row = mysql_fetch_array($result)){

?>

<tr>

<td style="background: #eeeeee;width: auto;text-align: center;"><a href="mob.php?id=<?php echo $row['id']; ?>&edit" style="text-decoration:none">[edit]</td>

<td style="background: #eeeeee;width: auto;text-align: center;"><?php echo $row['name']; ?></td>

<td style="background: #eeeeee;width: auto;text-align: center;"><?php echo $row['hp']; ?></td>

<td style="background: #eeeeee;width: auto;text-align: center;"><?php echo $row['energy']; ?></td>

<td style="background: #eeeeee;width: auto;text-align: center;"><?php echo $row['regen']; ?></td>

<td style="background: #eeeeee;width: auto;text-align: center;"><?php echo $row['defense']; ?></td>

<td style="background: #eeeeee;width: auto;text-align: center;"><?php echo $row['attack']; ?></td>

<td style="background: #eeeeee;width: auto;text-align: center;"><?php echo $row['evasion']; ?></td>

<td style="background: #eeeeee;width: auto;text-align: center;"><?php echo $row['level']; ?></td>

<td style="background: #eeeeee;width: auto;text-align: center;"><?php echo $row['special_attack']; ?></td>

<td style="background: #eeeeee;width: auto;text-align: center;"><?php echo $row['loot']; ?></td>

<td style="background: #eeeeee;width: auto;text-align: center;">

<?php

	$result2 = mysql_query("SELECT * FROM mobs WHERE id_mobs = '$row[id]' ORDER BY id_area");

	$rows2 = mysql_num_rows($result2);

	if ($rows2 > 0){

	while ($row2 = mysql_fetch_array($result2)){

	if ($row2['id_area'] == '0'){

		echo "World Wide<br />";

	}else{

		$result3 = mysql_query("SELECT * FROM zone WHERE id='$row2[id_area]'");

		$row3 = mysql_fetch_array($result3);

		echo $row3['name']."<br />";

	}

	}

	}else{

		echo "No selected zones";

	}

?>

</td>

<td style="background: #eeeeee;width: auto;text-align: center;"><?php echo $row['cooldown']; ?></td>

<td style="background: #eeeeee;width: auto;text-align: center;"><?php echo $row['money']; ?></td>

<td style="background: #eeeeee;width: auto;text-align: center;"><?php echo $row['xp']; ?></td>

</tr>

<?php

}

?>

<tr>

<td style="background: #eeeeee;width: auto;text-align: center;"><a href="mob.php" style="text-decoration:none;">Back</td>

</tr>

</table>

<?php

}elseif (isset($_GET['edit'])){

$id = $_GET['id'];

$result = mysql_query("SELECT * FROM mobs_desc WHERE id = '$id'");

$row = mysql_fetch_array($result);

$level = explode("-", $row['level']);

$damage = explode("-", $row['attack']);

$loot = explode("-", $row['loot']);

$money = explode("-", $row['money']);

if (!isset($_POST['submit1']) && (!isset($_POST['submit2']))){

?>

	<form method="POST" action="">

	<div style="float:left;width:170px;">Name: </div><div style="float:left;width:130px;"><input type='text' name='name' value="<?php echo $row['name']; ?>"></div><br /><br />

	<div style="float:left;width:170px;">Model name: </div><div style="float:left;width:130px;"><input type='text' name='model_name' value="<?php echo $row['model_name']; ?>"></div><br /><br />

	<div style="float:left;width:170px;">HP: </div><div style="float:left;width:130px;"><input type='text' name='hp' value="<?php echo $row['hp']; ?>"></div><br /><br />

	<div style="float:left;width:170px;">Energy: </div><div style="float:left;width:130px;"><input type='text' name='energy' value="<?php echo $row['energy']; ?>"></div><br /><br />

	<div style="float:left;width:170px;">Regen: </div><div style="float:left;width:130px;"><input type='text' name='regen' value="<?php echo $row['regen']; ?>"></div><br /><br />

	<div style="float:left;width:170px;">Defense: </div><div style="float:left;width:130px;"><input type='text' name='defense' value="<?php echo $row['defense']; ?>"></div><br /><br />

	<div style="float:left;width:170px;">Evasion: </div><div style="float:left;width:130px;"><input type='text' name='evasion' value="<?php echo $row['evasion']; ?>"></div><br /><br />

	<div style="float:left;width:170px;">Level Range: </div><div style="float:left;width:150px;"><input type='text' name='level1' size='5' value="<?php echo $level[0]; ?>"> - <input type='text' name='level2' size='5' value="<?php echo $level[1]; ?>"></div><br /><br />

	<div style="float:left;width:170px;">Damage: </div><div style="float:left;width:150px;"><input type='text' name='damage1' size='5' value="<?php echo $damage[0]; ?>"> - <input type='text' name='damage2' size='5' value="<?php echo $damage[1]; ?>"></div><br /><br />

	<div style="float:left;width:170px;">Special Attack: </div><div style="float:left;width:130px;"><input type='text' name='attack' value="<?php echo $row['special_attack']; ?>"></div><br /><br />

	<div style="float:left;width:170px;">Loot Pack: </div>

	<?php

	$loot = explode(";", $row['complete']);

	$count = count($loot);

	$i = 1;

	foreach($loot as $val){

		$level = explode("-", $val);

		?>

		<div style="clear:both"></div>



<div style="float:left;padding-left:170px;width:250px;">



<?php

			$result2 = mysql_query("SELECT DISTINCT(value) FROM loot");

			$row2 = mysql_fetch_assoc($result2);

			?>

				<select name="loot<?php echo $i; ?>">

				<option value='-'>Loot pack</option>

	<?php do { ?>

	<option value="<?php echo $row2['value']; ?>" <?php if ($row2['value'] == $level[0]) echo "selected"; ?>><?php echo $row2['value']; ?></option>

    <?php } while ($row2 = mysql_fetch_assoc($result2)); ?>

    </select>

	Drop Chance: <input type='text' name='proc<?php echo $i; ?>' size='5' value="<?php echo $level[1]; ?>">%

</div>

<?php

		$i++;

	}

	for ($i=$count+1;$i<=10;$i++){

				?>

		<div style="clear:both"></div>



<div style="float:left;padding-left:170px;width:280px;">



<?php

			$result2 = mysql_query("SELECT DISTINCT(value) FROM loot");

			$row2 = mysql_fetch_assoc($result2);

			?>

				<select name="loot<?php echo $i; ?>">

				<option value='-'>Loot pack</option>

	<?php do { ?>

	<option value="<?php echo $row2['value']; ?>" ><?php echo $row2['value']; ?></option>

    <?php } while ($row2 = mysql_fetch_assoc($result2)); ?>

    </select>

	Drop Chance: <input type='text' name='proc<?php echo $i; ?>' size='5' value="0">%

</div>

<?php

	}



	?>

	<br /><br />

	<div style="float:left;width:170px;">Money: </div><div style="float:left;width:150px;"><input type='text' name='money1' size='5' value="<?php echo $money[0]; ?>"> - <input type='text' name='money2' size='5' value="<?php echo $money[1]; ?>"></div><br /><br />

	<div style="float:left;width:170px;">XP: </div><div style="float:left;width:130px;"><input type='text' name='xp' size='5' value="<?php echo $row['xp']; ?>"></div><br /><br />

	<div style="float:left;width:170px;">World Wide: </div><div style="float:left;width:130px;"><input type="checkbox" name="world"

	<?php

		$result2 = mysql_query("SELECT * FROM mobs WHERE id_mobs='$id' AND id_area='0'");

		$rows2 = mysql_num_rows($result2);

		if ($rows2 > 0){

			echo "checked";

		}

	?>

	/></div><br /><br />

<div style="float:left;width:170px;">Special Area: </div><div style="float:left;width:130px;">

<?php

			$result2 = mysql_query("SELECT * FROM zone");

			?>

		<select name="area[]" multiple="multiple">  

			<?php

				while ($row2 = mysql_fetch_assoc($result2)){

			?>



	<option value="<?php echo $row2['id']; ?>"

	<?php

		$result3 = mysql_query("SELECT * FROM mobs WHERE id_area='$row2[id]' AND id_mobs='$id'");

		$rows3 = mysql_num_rows ($result3);

		if ($rows3 > 0)

			echo "selected";

	?>

	><?php echo $row2['name']; ?></option>

    <?php } ?>

    </select>

</div><br /><br /><br /><br /><br /><br />

	<div style="float:left;width:170px;">COOLDOWN Round: </div><div style="float:left;width:130px;"><input type='text' name='cooldown' size='5' value="<?php echo $row['cooldown']; ?>"></div><br /><br />



	<input type='submit' name='submit1' value='Edit'><input type='submit' name='submit2' value='Remove'><a href='mob.php?view' style='text-decoration:none'>Leave</a>

	</form>

<?php

}elseif(isset($_POST['submit1'])){

	$name = addslashes($_POST['name']);

	$model_name = addslashes($_POST['model_name']);

	$level = $_POST['level1']."-".$_POST['level2'];

	$damage = $_POST['damage1']."-".$_POST['damage2'];

	$attack = addslashes($_POST['attack']);

	$loot = $_POST['loot'];

	$area = addslashes($_POST['area']);

	$money = $_POST['money1']."-".$_POST['money2'];

	

	$loot = "";

	$proc = "";

	$show = "";

	

	if (isset($_POST['loot1']) && $_POST['loot1'] != '-'){

		$loot .= $_POST['loot1'].";";

		if (isset($_POST['proc1'])){

			$proc .= $_POST['proc1'].";";

			$show .= $_POST['loot1']."-".$_POST['proc1'].";";

			}

	}

	if (isset($_POST['loot2']) && $_POST['loot2'] != '-'){

		$loot .= $_POST['loot2'].";";

		if (isset($_POST['proc2'])){

			$proc .= $_POST['proc2'].";";

			$show .= $_POST['loot2']."-".$_POST['proc2'].";";

			}

	}

	if (isset($_POST['loot3']) && $_POST['loot3'] != '-'){

		$loot .= $_POST['loot3'].";";

		if (isset($_POST['proc3'])){

			$proc .= $_POST['proc3'].";";

			$show .= $_POST['loot3']."-".$_POST['proc3'].";";

			}

	}

	if (isset($_POST['loot4']) && $_POST['loot4'] != '-'){

		$loot .= $_POST['loot4'].";";

		if (isset($_POST['proc4'])){

			$proc .= $_POST['proc4'].";";

			$show .= $_POST['loot4']."-".$_POST['proc4'].";";

			}

	}

	if (isset($_POST['loot5']) && $_POST['loot5'] != '-'){

		$loot .= $_POST['loot5'].";";

		if (isset($_POST['proc5'])){

			$proc .= $_POST['proc5'].";";

			$show .= $_POST['loot5']."-".$_POST['proc5'].";";

			}

	}

	if (isset($_POST['loot6']) && $_POST['loot6'] != '-'){

		$loot .= $_POST['loot6'].";";

		if (isset($_POST['proc6'])){

			$proc .= $_POST['proc6'].";";

			$show .= $_POST['loot6']."-".$_POST['proc6'].";";

			}

	}

	if (isset($_POST['loot7']) && $_POST['loot7'] != '-'){

		$loot .= $_POST['loot7'].";";

		if (isset($_POST['proc7'])){

			$proc .= $_POST['proc7'].";";

			$show .= $_POST['loot7']."-".$_POST['proc7'].";";

			}

	}

	if (isset($_POST['loot8']) && $_POST['loot8'] != '-'){

		$loot .= $_POST['loot8'].";";

		if (isset($_POST['proc8'])){

			$proc .= $_POST['proc8'].";";

			$show .= $_POST['loot8']."-".$_POST['proc8'].";";

			}

	}

	if (isset($_POST['loot9']) && $_POST['loot9'] != '-'){

		$loot .= $_POST['loot9'].";";

		if (isset($_POST['proc9'])){

			$proc .= $_POST['proc9'].";";

			$show .= $_POST['loot9']."-".$_POST['proc9'].";";

			}

	}

	if (isset($_POST['loot10']) && $_POST['loot10'] != '-'){

		$loot .= $_POST['loot10'].";";

		if (isset($_POST['proc10'])){

			$proc .= $_POST['proc10'].";";

			$show .= $_POST['loot10']."-".$_POST['proc10'].";";

			}

	}

	$loot = substr_replace($loot, "", -1, 1);

	$proc = substr_replace($proc, "", -1, 1);

	$show = substr_replace($show, "", -1, 1);

	

	mysql_query("UPDATE mobs_desc SET name='$name', model_name ='$model_name', hp='$_POST[hp]', energy='$_POST[energy]', regen='$_POST[regen]', defense='$_POST[defense]', 

				evasion='$_POST[evasion]', level='$level', attack='$damage', special_attack='$attack', loot='$loot', procent='$proc',

				complete='$show', cooldown='$_POST[cooldown]', 

				money='$money', xp='$_POST[xp]' WHERE id='$id'");

				

	mysql_query("DELETE FROM mobs WHERE id_mobs='$id'");

	

	if ($_POST['world'] == 'on'){

		mysql_query("INSERT INTO mobs (id_mobs, id_area) VALUES ('$id', '0')");

	}

	foreach ($_POST['area'] as $val){

		mysql_query("INSERT INTO mobs (id_mobs, id_area) VALUES ('$id', '$val')");

	}

	

	header("Location: mob.php?view");

	//print_r($_POST);

}elseif(isset($_POST['submit2'])){

	mysql_query("DELETE FROM mobs WHERE id_mobs='$id'");

	mysql_query("DELETE FROM mobs_desc WHERE id='$id'");

	header("Location: mob.php?view");

}

}elseif (!isset($_POST['submit'])){

?>

<form method="POST" action="">



<div style="float:left;width:170px;">Name: </div><div style="float:left;width:130px;"><input type='text' name='name' ></div><br /><br />

<div style="float:left;width:170px;">Model name: </div><div style="float:left;width:130px;"><input type='text' name='model_name' ></div><br /><br />

<div style="float:left;width:170px;">HP: </div><div style="float:left;width:130px;"><input type='text' name='hp' ></div><br /><br />

<div style="float:left;width:170px;">Energy: </div><div style="float:left;width:130px;"><input type='text' name='energy' ></div><br /><br />

<div style="float:left;width:170px;">Regen: </div><div style="float:left;width:130px;"><input type='text' name='regen' ></div><br /><br />

<div style="float:left;width:170px;">Defense: </div><div style="float:left;width:130px;"><input type='text' name='defense' ></div><br /><br />

<div style="float:left;width:170px;">Evasion: </div><div style="float:left;width:130px;"><input type='text' name='evasion' ></div><br /><br />

<div style="float:left;width:170px;">Level Range: </div><div style="float:left;width:150px;"><input type='text' name='level1' size='5'> - <input type='text' name='level2' size='5'></div><br /><br />

<div style="float:left;width:170px;">Damage: </div><div style="float:left;width:150px;"><input type='text' name='damage1' size='5'> - <input type='text' name='damage2' size='5'></div><br /><br />

<div style="float:left;width:170px;">Special Attack: </div><div style="float:left;width:130px;"><input type='text' name='attack' ></div><br /><br />

<div style="float:left;width:170px;">Loot Pack: </div><div style="float:left;width:280px;">

<?php

			$result = mysql_query("SELECT DISTINCT(value) FROM loot");

			$row = mysql_fetch_assoc($result);

			?>

				<select name="loot">

				<option value='-'>Loot pack</option>

	<?php do { ?>

	<option value="<?php echo $row['value']; ?>"><?php echo $row['value']; ?></option>

    <?php } while ($row = mysql_fetch_assoc($result)); ?>

    </select>

	Drop Chance: <input type='text' name='proc' size='5' value='0'>%

</div>





<a href="javascript:void(0);" onClick="document.getElementById('sublink').style.display='block';"><b>

<img src="add.png" border="0" width="20px" height="20px" /></a></b>

<div style="clear:both"></div>

<div id="sublink" style="display:none;padding-left:170px;">

<div style="float:left;width:280px;">



<?php

			$result = mysql_query("SELECT DISTINCT(value) FROM loot");

			$row = mysql_fetch_assoc($result);

			?>

				<select name="loot1">

				<option value='-'>Loot pack</option>

	<?php do { ?>

	<option value="<?php echo $row['value']; ?>"><?php echo $row['value']; ?></option>

    <?php } while ($row = mysql_fetch_assoc($result)); ?>

    </select>

	Drop Chance: <input type='text' name='proc1' size='5' value='0'>%

</div>

<a href="javascript:void(0);" onClick="document.getElementById('sublink1').style.display='block';"><b>

<img src="add.png" border="0" width="20px" height="20px" /></a></b>

</div>



<div style="clear:both"></div>

<div id="sublink1" style="display:none;padding-left:170px;">

<div style="float:left;width:280px;">



<?php

			$result = mysql_query("SELECT DISTINCT(value) FROM loot");

			$row = mysql_fetch_assoc($result);

			?>

				<select name="loot2">

				<option value='-'>Loot pack</option>

	<?php do { ?>

	<option value="<?php echo $row['value']; ?>"><?php echo $row['value']; ?></option>

    <?php } while ($row = mysql_fetch_assoc($result)); ?>

    </select>

	Drop Chance: <input type='text' name='proc2' size='5' value='0'>%

</div>

<a href="javascript:void(0);" onClick="document.getElementById('sublink2').style.display='block';"><b>

<img src="add.png" border="0" width="20px" height="20px" /></a></b>

</div>



<div style="clear:both"></div>

<div id="sublink2" style="display:none;padding-left:170px;">

<div style="float:left;width:280px;">



<?php

			$result = mysql_query("SELECT DISTINCT(value) FROM loot");

			$row = mysql_fetch_assoc($result);

			?>

				<select name="loot3">

				<option value='-'>Loot pack</option>

	<?php do { ?>

	<option value="<?php echo $row['value']; ?>"><?php echo $row['value']; ?></option>

    <?php } while ($row = mysql_fetch_assoc($result)); ?>

    </select>

	Drop Chance: <input type='text' name='proc3' size='5' value='0'>%

</div>

<a href="javascript:void(0);" onClick="document.getElementById('sublink3').style.display='block';"><b>

<img src="add.png" border="0" width="20px" height="20px" /></a></b>

</div>



<div style="clear:both"></div>

<div id="sublink3" style="display:none;padding-left:170px;">

<div style="float:left;width:280px;">



<?php

			$result = mysql_query("SELECT DISTINCT(value) FROM loot");

			$row = mysql_fetch_assoc($result);

			?>

				<select name="loot4">

				<option value='-'>Loot pack</option>

	<?php do { ?>

	<option value="<?php echo $row['value']; ?>"><?php echo $row['value']; ?></option>

    <?php } while ($row = mysql_fetch_assoc($result)); ?>

    </select>

	Drop Chance: <input type='text' name='proc4' size='5' value='0'>%

</div>

<a href="javascript:void(0);" onClick="document.getElementById('sublink4').style.display='block';"><b>

<img src="add.png" border="0" width="20px" height="20px" /></a></b>

</div>



<div style="clear:both"></div>

<div id="sublink4" style="display:none;padding-left:170px;">

<div style="float:left;width:280px;">



<?php

			$result = mysql_query("SELECT DISTINCT(value) FROM loot");

			$row = mysql_fetch_assoc($result);

			?>

				<select name="loot5">

				<option value='-'>Loot pack</option>

	<?php do { ?>

	<option value="<?php echo $row['value']; ?>"><?php echo $row['value']; ?></option>

    <?php } while ($row = mysql_fetch_assoc($result)); ?>

    </select>

	Drop Chance: <input type='text' name='proc5' size='5' value='0'>%

</div>

<a href="javascript:void(0);" onClick="document.getElementById('sublink5').style.display='block';"><b>

<img src="add.png" border="0" width="20px" height="20px" /></a></b>

</div>



<div style="clear:both"></div>

<div id="sublink5" style="display:none;padding-left:170px;">

<div style="float:left;width:280px;">



<?php

			$result = mysql_query("SELECT DISTINCT(value) FROM loot");

			$row = mysql_fetch_assoc($result);

			?>

				<select name="loot6">

				<option value='-'>Loot pack</option>

	<?php do { ?>

	<option value="<?php echo $row['value']; ?>"><?php echo $row['value']; ?></option>

    <?php } while ($row = mysql_fetch_assoc($result)); ?>

    </select>

	Drop Chance: <input type='text' name='proc6' size='5' value='0'>%

</div>

<a href="javascript:void(0);" onClick="document.getElementById('sublink6').style.display='block';"><b>

<img src="add.png" border="0" width="20px" height="20px" /></a></b>

</div>



<div style="clear:both"></div>

<div id="sublink6" style="display:none;padding-left:170px;">

<div style="float:left;width:280px;">



<?php

			$result = mysql_query("SELECT DISTINCT(value) FROM loot");

			$row = mysql_fetch_assoc($result);

			?>

				<select name="loot7">

				<option value='-'>Loot pack</option>

	<?php do { ?>

	<option value="<?php echo $row['value']; ?>"><?php echo $row['value']; ?></option>

    <?php } while ($row = mysql_fetch_assoc($result)); ?>

    </select>

	Drop Chance: <input type='text' name='proc7' size='5' value='0'>%

</div>

<a href="javascript:void(0);" onClick="document.getElementById('sublink7').style.display='block';"><b>

<img src="add.png" border="0" width="20px" height="20px" /></a></b>

</div>



<div style="clear:both"></div>

<div id="sublink7" style="display:none;padding-left:170px;">

<div style="float:left;width:280px;">



<?php

			$result = mysql_query("SELECT DISTINCT(value) FROM loot");

			$row = mysql_fetch_assoc($result);

			?>

				<select name="loot8">

				<option value='-'>Loot pack</option>

	<?php do { ?>

	<option value="<?php echo $row['value']; ?>"><?php echo $row['value']; ?></option>

    <?php } while ($row = mysql_fetch_assoc($result)); ?>

    </select>

	Drop Chance: <input type='text' name='proc8' size='5' value='0'>%

</div>

<a href="javascript:void(0);" onClick="document.getElementById('sublink8').style.display='block';"><b>

<img src="add.png" border="0" width="20px" height="20px" /></a></b>

</div>



<div style="clear:both"></div>

<div id="sublink8" style="display:none;padding-left:170px;">

<div style="float:left;width:280px;">



<?php

			$result = mysql_query("SELECT DISTINCT(value) FROM loot");

			$row = mysql_fetch_assoc($result);

			?>

				<select name="loot9">

				<option value='-'>Loot pack</option>

	<?php do { ?>

	<option value="<?php echo $row['value']; ?>"><?php echo $row['value']; ?></option>

    <?php } while ($row = mysql_fetch_assoc($result)); ?>

    </select>

	Drop Chance: <input type='text' name='proc9' size='5' value='0'>%

</div>



</div>

<br /><br />



<div style="float:left;width:170px;">Money: </div><div style="float:left;width:150px;"><input type='text' name='money1' size='5'> - <input type='text' name='money2' size='5'></div><br /><br />

<div style="float:left;width:170px;">XP: </div><div style="float:left;width:130px;"><input type='text' name='xp' size='5' ></div><br /><br />

<div style="float:left;width:170px;">World Wide: </div><div style="float:left;width:130px;"><input type="checkbox" name="world"/></div><br /><br />

<div style="float:left;width:170px;">Special Area: </div><div style="float:left;width:130px;">

<?php

			$result = mysql_query("SELECT * FROM zone");

			$row = mysql_fetch_assoc($result);

			?>

		<select name="area[]" multiple="multiple">  

			

	<?php do { ?>

	<option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>

    <?php } while ($row = mysql_fetch_assoc($result)); ?>

    </select>

</div><br /><br /><br /><br /><br /><br />

<div style="float:left;width:170px;">COOLDOWN Round: </div><div style="float:left;width:130px;"><input type='text' name='cooldown' size='5'></div><br /><br />



<input type='submit' name='submit' value='Save'>

</form>

<br /><br />



<div>

<a href="mob.php?view" style="text-decoration:none;">View all entries from database</a>

</div>

<?php

}else{

	$name = addslashes($_POST['name']);

	$model_name = addslashes($_POST['model_name']);

	if (isset($_POST['damage1']))

		$damage1 = $_POST['damage1'];

	else $damage1 = 0;

	if (isset($_POST['damage2']))

		$damage2 = $_POST['damage2'];

	else $damage2 = 0;

	if (isset($_POST['level1']))

		$level1 = $_POST['level1'];

	else $level1 = 0;

	if (isset($_POST['level2']))

		$level2 = $_POST['level2'];

	else $level2 = 0;

	

	$damage = $damage1."-".$damage2;

	$level = $level1."-".$level2;

	$attack = addslashes($_POST['attack']);



	if (isset($_POST['hp']))

		$hp = $_POST['hp'];

	else $hp = 0;

	if (isset($_POST['energy']))

		$energy = $_POST['energy'];

	else $energy = 0;

	if (isset($_POST['regen']))

		$regen = $_POST['regen'];

	else $regen = 0;

	if (isset($_POST['defense']))

		$defense = $_POST['defense'];

	else $defense = 0;

	if (isset($_POST['evasion']))

		$evasion = $_POST['evasion'];

	else $evasion = 0;

	if (isset($_POST['xp']))

		$xp = $_POST['xp'];

	else $xp = 0;

	

	$money = $_POST['money1']."-".$_POST['money2'];

	$loot = "";

	$proc = "";

	$show = "";

	if (isset($_POST['loot']) && $_POST['loot'] != '-'){

		$loot .= $_POST['loot'].";";

		if (isset($_POST['proc'])){

			$proc .= $_POST['proc'].";";

			$show .= $_POST['loot']."-".$_POST['proc'].";";

			}

	}

	if (isset($_POST['loot1']) && $_POST['loot1'] != '-'){

		$loot .= $_POST['loot1'].";";

		if (isset($_POST['proc1'])){

			$proc .= $_POST['proc1'].";";

			$show .= $_POST['loot1']."-".$_POST['proc1'].";";

			}

	}

	if (isset($_POST['loot2']) && $_POST['loot2'] != '-'){

		$loot .= $_POST['loot2'].";";

		if (isset($_POST['proc2'])){

			$proc .= $_POST['proc2'].";";

			$show .= $_POST['loot2']."-".$_POST['proc2'].";";

			}

	}

	if (isset($_POST['loot3']) && $_POST['loot3'] != '-'){

		$loot .= $_POST['loot3'].";";

		if (isset($_POST['proc3'])){

			$proc .= $_POST['proc3'].";";

			$show .= $_POST['loot3']."-".$_POST['proc3'].";";

			}

	}

	if (isset($_POST['loot4']) && $_POST['loot4'] != '-'){

		$loot .= $_POST['loot4'].";";

		if (isset($_POST['proc4'])){

			$proc .= $_POST['proc4'].";";

			$show .= $_POST['loot4']."-".$_POST['proc4'].";";

			}

	}

	if (isset($_POST['loot5']) && $_POST['loot5'] != '-'){

		$loot .= $_POST['loot5'].";";

		if (isset($_POST['proc5'])){

			$proc .= $_POST['proc5'].";";

			$show .= $_POST['loot5']."-".$_POST['proc5'].";";

			}

	}

	if (isset($_POST['loot6']) && $_POST['loot6'] != '-'){

		$loot .= $_POST['loot6'].";";

		if (isset($_POST['proc6'])){

			$proc .= $_POST['proc6'].";";

			$show .= $_POST['loot6']."-".$_POST['proc6'].";";

			}

	}

	if (isset($_POST['loot7']) && $_POST['loot7'] != '-'){

		$loot .= $_POST['loot7'].";";

		if (isset($_POST['proc7'])){

			$proc .= $_POST['proc7'].";";

			$show .= $_POST['loot7']."-".$_POST['proc7'].";";

			}

	}

	if (isset($_POST['loot8']) && $_POST['loot8'] != '-'){

		$loot .= $_POST['loot8'].";";

		if (isset($_POST['proc8'])){

			$proc .= $_POST['proc8'].";";

			$show .= $_POST['loot8']."-".$_POST['proc8'].";";

			}

	}

	if (isset($_POST['loot9']) && $_POST['loot9'] != '-'){

		$loot .= $_POST['loot9'].";";

		if (isset($_POST['proc9'])){

			$proc .= $_POST['proc9'].";";

			$show .= $_POST['loot9']."-".$_POST['proc9'].";";

			}

	}

	$loot = substr_replace($loot, "", -1, 1);

	$proc = substr_replace($proc, "", -1, 1);

	$show = substr_replace($show, "", -1, 1);



	mysql_query("INSERT INTO mobs_desc (name, model_name, hp, energy, regen, defense, evasion, attack, level, special_attack, loot, procent, complete,  cooldown, money, xp) 

				VALUES ('$name', '$model_name', '$hp', '$energy', '$regen', '$defense', '$evasion', '$damage', '$level', '$attack', '$loot', '$proc', '$show', '$_POST[cooldown]', '$money', '$xp')");

	$r=mysql_insert_id();



	if ($_POST['world'] == 'on'){

		mysql_query("INSERT INTO mobs (id_mobs, id_area) VALUES ('$r', '0')");

	}

	foreach ($_POST['area'] as $val){

		mysql_query("INSERT INTO mobs (id_mobs, id_area) VALUES ('$r', '$val')");

	}

	

	header("Location:mob.php");

	//print_r($_POST);

	//echo "<br />";

	//echo $loot."<br />".$proc."<br />".$show."<br />";

}

ob_end_flush();

?>

</body>

</html>



<?php

}

?>