<?php session_start();

if(!isset($_SESSION['user']))header('Location:login.php');

include ("db_connect.php");

include("functions.php");

if(!isset($_SESSION['super_user']))$sections=get_access($_SESSION['id']);

else $sections=array(1,2,3,4,5,6,7);

if(!in_array(4,$sections)){

echo "<br><br>You do not have access here!";

}

else{

//page content here

ob_start();

?>

<html>

<head>

<title></title>

 <script language="JavaScript">

 <!--

	function changeModel()

	{

		var crafted=document.getElementById("crafted");

		var id=crafted.options[crafted.selectedIndex].value;		

		var craft_items=document.getElementById("craft_items");				

					

		var xmlhttp;		

		if (window.XMLHttpRequest)

  		{

  			// code for IE7+, Firefox, Chrome, Opera, Safari

  			xmlhttp=new XMLHttpRequest();

  		}

		else if (window.ActiveXObject)

  		{

  			// code for IE6, IE5

  			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

  		}

		else

  		{

  			alert("Your browser does not support XMLHTTP!");

  		}		

		xmlhttp.onreadystatechange=function()

		{

			if (xmlhttp.readyState==4)

			{

				craft_items.innerHTML=xmlhttp.responseText;

			}

		}

		var a="crafted.php?crafted="+id;

		xmlhttp.open("GET",a,true);

		xmlhttp.send(null);

	}

 //-->

 </script>

 

  <script language="JavaScript">

 <!--

	function changeModel2()

	{

		var weapon=document.getElementById("weapon");

		var id=weapon.options[weapon.selectedIndex].value;		

		var weapon_value=document.getElementById("weapon_value");				

					

		var xmlhttp;		

		if (window.XMLHttpRequest)

  		{

  			// code for IE7+, Firefox, Chrome, Opera, Safari

  			xmlhttp=new XMLHttpRequest();

  		}

		else if (window.ActiveXObject)

  		{

  			// code for IE6, IE5

  			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

  		}

		else

  		{

  			alert("Your browser does not support XMLHTTP!");

  		}		

		xmlhttp.onreadystatechange=function()

		{

			if (xmlhttp.readyState==4)

			{

				weapon_value.innerHTML=xmlhttp.responseText;

			}

		}

		var a="weapon.php?weapon="+id;

		xmlhttp.open("GET",a,true);

		xmlhttp.send(null);

	}

 //-->

 </script>



</head>

<body style="background-color:#ababab;">

<a href="logout.php">Logout</a><br><br>

<?php

include("menu.php");

?>

<br><br>

<?php

if (isset($_GET['view'])){

$query="SELECT * FROM items_inventory ORDER BY id_item";

if(isset($_GET['id']))$query="SELECT * FROM items_inventory ORDER BY id_item {$_GET['id']}";

if(isset($_GET['name']))$query="SELECT * FROM items_inventory ORDER BY name {$_GET['name']}";

if(isset($_GET['loot']))$query="SELECT * FROM items_inventory ORDER BY loot {$_GET['loot']}";

$result = mysql_query($query);

?>

<table style="width: 1200px;margin: 0 auto;clear: right;margin: 10px 0px 40px 0px;">

<tr>

<td style="background: #eeeeee;width: auto;text-align: center;"><a href="item.php" style="text-decoration:none;">Back</td>

</tr>

<tr>

<th></th>

<th style="font-weight: bold; background: #5b7480;width:10%">ID

&nbsp;<a href="item.php?view&id=ASC">^</a>

&nbsp;<a href="item.php?view&id=DESC">v</a>

</th>

<th style="font-weight: bold; background: #5b7480;width:15%">Name

&nbsp;<a href="item.php?view&name=ASC">^</a>

&nbsp;<a href="item.php?view&name=DESC">v</a>

</th>

<th style="font-weight: bold; background: #5b7480;width:10%">Brutality</th>

<th style="font-weight: bold; background: #5b7480;width:10%">Accuracy</th>

<th style="font-weight: bold; background: #5b7480;width:10%">Fortitude</th>

<th style="font-weight: bold; background: #5b7480;width:10%">Attack</th>

<th style="font-weight: bold; background: #5b7480;width:15%">Defense stat</th>

<th style="font-weight: bold; background: #5b7480;width:10%">Health</th>

<th style="font-weight: bold; background: #5b7480;width:10%">Regen</th>

<th style="font-weight: bold; background: #5b7480;width:10%">Duration</th>

<th style="font-weight: bold; background: #5b7480;width:10%">Min level</th>

<th style="font-weight: bold; background: #5b7480;width:10%">Repeating</th>

<th style="font-weight: bold; background: #5b7480;width:10%">Wearoff</th>

<th style="font-weight: bold; background: #5b7480;width:10%">Slot</th>

<th style="font-weight: bold; background: #5b7480;width:10%">Crafted</th>

<th style="font-weight: bold; background: #5b7480;width:10%">Craft items</th>

<th style="font-weight: bold; background: #5b7480;width:10%">Weapon</th>

<th style="font-weight: bold; background: #5b7480;width:10%">Weapon damage</th>

<th style="font-weight: bold; background: #5b7480;width:10%">Sale Price</th>

<th style="font-weight: bold; background: #5b7480;width:10%">Loot

&nbsp;<a href="item.php?view&loot=ASC">^</a>

&nbsp;<a href="item.php?view&loot=DESC">v</a>

</th>

<th style="font-weight: bold; background: #5b7480;width:10%">Boss</th>

</tr>

<?php

while ($row = mysql_fetch_array($result)){

?>

<tr>

<td style="background: #eeeeee;width: auto;text-align: center;"><a href="item.php?id=<?php echo $row['id']; ?>&edit" style="text-decoration:none">[edit]</td>

<td style="background: #eeeeee;width: auto;text-align: center;"><?php echo $row['id_item']; ?></td>

<td style="background: #eeeeee;width: auto;text-align: center;"><?php echo $row['name']; ?></td>

<td style="background: #eeeeee;width: auto;text-align: center;"><?php echo $row['brutality']; ?></td>

<td style="background: #eeeeee;width: auto;text-align: center;"><?php echo $row['accuracy']; ?></td>

<td style="background: #eeeeee;width: auto;text-align: center;"><?php echo $row['fortitude']; ?></td>

<td style="background: #eeeeee;width: auto;text-align: center;"><?php echo $row['attack']; ?></td>

<td style="background: #eeeeee;width: auto;text-align: center;"><?php echo $row['defense']; ?></td>

<td style="background: #eeeeee;width: auto;text-align: center;"><?php echo $row['health']; ?></td>

<td style="background: #eeeeee;width: auto;text-align: center;"><?php echo $row['regen']; ?></td>

<td style="background: #eeeeee;width: auto;text-align: center;"><?php echo $row['duration']; ?></td>

<td style="background: #eeeeee;width: auto;text-align: center;"><?php echo $row['level']; ?></td>

<td style="background: #eeeeee;width: auto;text-align: center;"><?php echo $row['repeating']; ?></td>

<td style="background: #eeeeee;width: auto;text-align: center;"><?php echo $row['wearoff']; ?></td>

<td style="background: #eeeeee;width: auto;text-align: center;"><?php echo $row['slot']; ?></td>

<td style="background: #eeeeee;width: auto;text-align: center;"><?php echo $row['craft']; ?></td>

<td style="background: #eeeeee;width: auto;text-align: center;"><?php echo $row['craft_items']; ?></td>

<td style="background: #eeeeee;width: auto;text-align: center;"><?php echo $row['weapon']; ?></td>

<td style="background: #eeeeee;width: auto;text-align: center;"><?php echo $row['weapon_items']; ?></td>

<td style="background: #eeeeee;width: auto;text-align: center;"><?php echo $row['price']; ?></td>

<td style="background: #eeeeee;width: auto;text-align: center;"><?php echo $row['loot']; ?></td>

<td style="background: #eeeeee;width: auto;text-align: center;"><?php

	if ($row['id_mob'] != '0'){

		$result2 = mysql_query("SELECT * FROM mobs_desc WHERE id='$row[id_mob]'");

		$row2 = mysql_fetch_array($result2);

		echo $row2['name'];

	}else{

		echo "-";

	}

?></td>

</tr>

<?php

}

?>

<tr>

<td style="background: #eeeeee;width: auto;text-align: center;"><a href="item.php" style="text-decoration:none;">Back</td>

</tr>

</table>

<?php

}elseif (isset($_GET['edit'])){

$result = mysql_query("SELECT * FROM items_inventory WHERE id='$_GET[id]'");

$row = mysql_fetch_array($result);

if (!isset($_POST['submit'])){

?>

	<form method="POST" action="">

	<div style='float:left;'>

		<div style="float:left;width:130px;">ID: </div><div style="float:left;width:130px;"><input type='text' name='id' value="<?php echo $row['id_item']; ?>"></div><br /><br />

		<div style="float:left;width:130px;">Name: </div><div style="float:left;width:130px;"><input type='text' name='name' value="<?php echo $row['name']; ?>"></div><br /><br />

		<div style="float:left;width:130px;">Brutality: </div><div style="float:left;width:130px;"><input type='text' name='brutality' value="<?php echo $row['brutality']; ?>"></div><br /><br />

		<div style="float:left;width:130px;">Accuracy: </div><div style="float:left;width:130px;"><input type='text' name='accuracy' value="<?php echo $row['accuracy']; ?>"></div><br /><br />

		<div style="float:left;width:130px;">Fortitude: </div><div style="float:left;width:130px;"><input type='text' name='fortitude' value="<?php echo $row['fortitude']; ?>"></div><br /><br />

		<div style="float:left;width:130px;">Attack: </div><div style="float:left;width:130px;"><input type='text' name='attack' value="<?php echo $row['attack']; ?>"></div><br /><br />

		<div style="float:left;width:130px;">Defense stat: </div><div style="float:left;width:130px;"><input type='text' name='defense' value="<?php echo $row['defense']; ?>"></div><br /><br />

		<div style="float:left;width:130px;">Health: </div><div style="float:left;width:130px;"><input type='text' name='health' value="<?php echo $row['health']; ?>"></div><br /><br />

		<div style="float:left;width:130px;">Regen: </div><div style="float:left;width:130px;"><input type='text' name='regen' value="<?php echo $row['regen']; ?>"></div><br /><br />

		<div style="float:left;width:130px;">Duration: </div><div style="float:left;width:130px;"><input type='text' name='duration' value="<?php echo $row['duration']; ?>"></div><br /><br />

		<div style="float:left;width:130px;">Min level: </div><div style="float:left;width:130px;"><input type='text' name='level' value="<?php echo $row['level']; ?>"></div><br /><br />

		<div style="float:left;width:130px;">Loot: </div><div style="float:left;width:130px;"><input type='text' name='loot' value="<?php echo $row['loot']; ?>"></div><br />

		<div style="float:left;width:130px;">

<a href="javascript:void(0);" onClick="document.getElementById('sublink').style.display='block';">Loot packs</a>

</div>

<div id="sublink" style="display:none;float:left;width:130px;">

	<?php

		$result3 = mysql_query("SELECT DISTINCT(value) FROM loot");

		$rows3 = mysql_num_rows($result3);

		if ($rows3 > 0){

		?>

		<table><tr><td style="background: #5b7480">Loot no</td><td style="background: #5b7480">Items</td></tr>

		<?php

		while ($row3 = mysql_fetch_array($result3)){

			echo "<tr><td style='background: #eeeeee'>".$row3['value']."</td><td style='background: #eeeeee'>";

			$result2 = mysql_query("SELECT * FROM items_inventory WHERE loot = '$row3[value]' ORDER BY id_item");

			while ($row2 = mysql_fetch_array($result2)){

				echo $row2['id_item']." ";

			}

			echo "</td></tr>";

		}

		?>

		</table>

		<?php

		}else

			echo "No loot pack";

	?>

</div>

<br /><br />

		<div style="float:left;width:130px;">Repeating: </div><div style="float:left;width:130px;">

		<select name='repeating'>

			<option value='0' <?php if ($row['repeating'] == '0') echo "selected"; ?>>0</option>

			<option value='1' <?php if ($row['repeating'] == '1') echo "selected"; ?>>1</option>

		</select>

		</div><br /><br />

		<div style="float:left;width:130px;">Wearoff: </div><div style="float:left;width:130px;">

		<select name='wearoff'>

			<option value='0' <?php if ($row['wearoff'] == '0') echo "selected"; ?>>0</option>

			<option value='1' <?php if ($row['wearoff'] == '1') echo "selected"; ?>>1</option>

		</select></div><br /><br />

		<div style="float:left;width:130px;">Sale Price: </div><div style="float:left;width:130px;"><input type='text' name='price' value="<?php if ($row['price'] == "") echo "0"; else echo $row['price']; ?>"></div><br /><br />

		<input type='submit' name='submit' value='Edit' >

		<a href="item.php?view">Leave</a>

		

<br /><br /><br />



<div>

<a href="item.php?view" style="text-decoration:none;">View all entries from database</a>

</div>

</div>



<div style='float:left;margin-left:100px;'>

<div style="float:left;width:130px;">Crafted: </div>

<div>



<select name="crafted" id="crafted" onchange="changeModel()">

					

					<option value="0" <?php if($row['craft'] == 0) echo "selected"; ?>>no</option>					

					<option value="1" <?php if($row['craft'] == 1) echo "selected"; ?>>yes</option>

						

					

				</select>

<span id="craft_items">



		<?php

		$result2 = mysql_query("SELECT * FROM items_inventory");

			$row2 = mysql_fetch_array($result2);

			if ($row['craft_items'] != ""){

			$count = explode(",", $row['craft_items']);

			foreach ($count as $val){

			$count2 = explode(";", $val);

			$count1[] = $count2[0];

			$count3[] = $count2[1];

			

			}

				

			?>

			

			<br />

			<select name="items_crafted[]" multiple="multiple"> 

    

	<?php do { ?>

	<option value="<?php echo $row2['id_item']; ?>" <?php if (in_array($row2['id_item'], $count1)) echo "selected"; ?>><?php echo $row2['name']; ?></option>

    <?php } while ($row2 = mysql_fetch_assoc($result2)); ?>

    </select>

			<br />

			<?php

			$i=0;

			foreach($count1 as $val){

			?>

				<br /><input type='text' name='details<?php echo $val; ?>' value="<?php print($count3[$i]); ?>" size='5' >

			<?php

			$i++;

			}

			

			}

			?>

	</span>



</div>

<br />

<div style="float:left;width:130px;">Weapon: </div>

<div style="float:left;">



<select name="weapon" id="weapon" onchange="changeModel2()">

					

					<option value="0" <?php if ($row['weapon'] == 0) echo "selected"; ?>>no</option>						

					<option value="2" <?php if ($row['weapon'] == 2) echo "selected"; ?>>yes</option>	

					<?php

						$result3 = mysql_query("SELECT * FROM items_categ WHERE name='hands'");

						$row3 = mysql_fetch_array($result3);

						?>

						<option value="<?php echo $row3['id_item']; ?>" <?php if ($row['weapon'] == 1) echo "selected"; ?>><?php echo $row3['name']; ?></option>

					

				</select>



<span id="weapon_value">

	<?php

		if ($row['weapon'] != 0){

		$weapon_items = explode("-", $row['weapon_items']);

	?>

		<input type='text' name='damage1' size='3' value="<?php echo $weapon_items[0] ?>">-<input type='text' name='damage2' size='3' value="<?php echo $weapon_items[1] ?>">

		<?php

			if ($row['weapon'] =='2')

		{

		?>

		<select name='w_type'>

		  <option value="M" <?php if ($weapon_items[2] == 'M') echo "selected"; ?>>MELE</option>

		  <option value="R" <?php if ($weapon_items[2] == 'R') echo "selected"; ?>>RANGE</option>

		</select>

		<?php

		}elseif($row['weapon'] =='1'){

		?>

		<select name='w_type'>

		  <option value="M" <?php if ($weapon_items[2] == 'M') echo "selected"; ?>>MELE</option>

		</select>

		<?php

		}

		}

		?>

	</span>

</div><br /><br />

<div style="float:left;width:130px;">Armour: </div>

<div style="float:left;">

	<input type="checkbox" name="armour" id="armour" onchange="if(this.checked) document.getElementById('armour2').style.display='block'; else document.getElementById('armour2').style.display='none';" <?php if ($row['slot'] > 1 && $row['slot'] <= 5) echo "checked"; ?> /><br />					

	<?php if ($row['slot'] > 1 && $row['slot'] <= 5) {?>

	<div id="armour2" style="display:block;">

	<?php }else{ ?>

	<div id="armour2" style="display:none;">

	<?php } ?>

<?php

		$result2 = mysql_query("SELECT * FROM items_categ WHERE id_item BETWEEN 2 AND 5");

			$row2 = mysql_fetch_array($result2);

			?>

			<select name="armour2"> 

    

	<?php do { ?>

	<option value="<?php echo $row2['id_item']; ?>" <?php if ($row['slot'] == $row2['id_item']) echo "selected"; ?>><?php echo $row2['name']; ?></option>

    <?php } while ($row2 = mysql_fetch_assoc($result2)); ?>

    </select>

			<br />

			

</div>

</div>

<br /><br />

<div style="float:left;width:130px;">Boss: </div>

<div style="float:left;">

	<input type="checkbox" name="boss" id="boss" onchange="if(this.checked) document.getElementById('boss2').style.display='block'; else document.getElementById('boss2').style.display='none';" <?php if ($row['slot'] == '8') echo "checked"; ?> /><br />					

	<?php if ($row['slot'] == '8') {?>

	<div id="boss2" style="display:block;">

	<?php }else{ ?>

	<div id="boss2" style="display:none;">

	<?php } ?>

<?php

		$result2 = mysql_query("SELECT * FROM mobs_desc");

			$row2 = mysql_fetch_array($result2);

			?>

			<select name="boss2"> 

    

	<?php do { ?>

	<option value="<?php echo $row2['id']; ?>" <?php if ($row['id_mob'] == $row2['id']) echo "selected"; ?>><?php echo $row2['name']; ?></option>

    <?php } while ($row2 = mysql_fetch_assoc($result2)); ?>

    </select>

			<br />

			

</div>

</div>

<br /><br />

</div>

</div>

</form>

	

<?php

}elseif (empty($_POST['id']) || empty($_POST['name']) || !is_numeric($_POST['loot'])){

	$error = "";

	if (empty($_POST['id']))

		$error .= "<font color='red'><b>Please insert ID</b></font><br />";

	if (empty($_POST['name']))

		$error .= "<font color='red'><b>Please insert Name</b></font><br />";

	if (empty($_POST['loot']))

		$error .= "<font color='red'><b>Loot must be a number</b></font><br />";

	echo $error;

	?>

	<form method="POST" action="">

		<div style='float:left;'>

		<div style="float:left;width:130px;">ID: </div><div style="float:left;width:130px;"><input type='text' name='id' value="<?php echo $_POST['id']; ?>"></div><br /><br />

		<div style="float:left;width:130px;">Name: </div><div style="float:left;width:130px;"><input type='text' name='name' value="<?php echo $_POST['name']; ?>"></div><br /><br />

		<div style="float:left;width:130px;">Brutality: </div><div style="float:left;width:130px;"><input type='text' name='brutality' value="<?php echo $_POST['brutality']; ?>"></div><br /><br />

		<div style="float:left;width:130px;">Accuracy: </div><div style="float:left;width:130px;"><input type='text' name='accuracy' value="<?php echo $_POST['accuracy']; ?>"></div><br /><br />

		<div style="float:left;width:130px;">Fortitude: </div><div style="float:left;width:130px;"><input type='text' name='fortitude' value="<?php echo $_POST['fortitude']; ?>"></div><br /><br />

		<div style="float:left;width:130px;">Attack: </div><div style="float:left;width:130px;"><input type='text' name='attack' value="<?php echo $_POST['attack']; ?>"></div><br /><br />

		<div style="float:left;width:130px;">Defense stat: </div><div style="float:left;width:130px;"><input type='text' name='defense' value="<?php echo $_POST['defense']; ?>"></div><br /><br />

		<div style="float:left;width:130px;">Health: </div><div style="float:left;width:130px;"><input type='text' name='health' value="<?php echo $_POST['health']; ?>"></div><br /><br />

		<div style="float:left;width:130px;">Regen: </div><div style="float:left;width:130px;"><input type='text' name='regen' value="<?php echo $_POST['regen']; ?>"></div><br /><br />

		<div style="float:left;width:130px;">Duration: </div><div style="float:left;width:130px;"><input type='text' name='duration' value="<?php echo $_POST['duration']; ?>"></div><br /><br />

		<div style="float:left;width:130px;">Min level: </div><div style="float:left;width:130px;"><input type='text' name='level' value="<?php echo $_POST['level']; ?>"></div><br /><br />

		<div style="float:left;width:130px;">Loot: </div><div style="float:left;width:130px;"><input type='text' name='loot' value="<?php echo $_POST['loot']; ?>"></div><br />

		<div style="float:left;width:130px;">

<a href="javascript:void(0);" onClick="document.getElementById('sublink').style.display='block';">Loot packs</a>

</div>

<div id="sublink" style="display:none;float:left;width:130px;">

	<?php

		$result = mysql_query("SELECT DISTINCT(value) FROM loot");

		$rows = mysql_num_rows($result);

		if ($rows > 0){

		?>

		<table><tr><td style="background: #5b7480">Loot no</td><td style="background: #5b7480">Items</td></tr>

		<?php

		while ($row = mysql_fetch_array($result)){

			echo "<tr><td style='background: #eeeeee'>".$row['value']."</td><td style='background: #eeeeee'>";

			$result2 = mysql_query("SELECT * FROM items_inventory WHERE loot = '$row[value]' ORDER BY id_item");

			while ($row2 = mysql_fetch_array($result2)){

				echo $row2['id_item']." ";

			}

			echo "</td></tr>";

		}

		?>

		</table>

		<?php

		}else

			echo "No loot pack";

	?>

</div>

<br /><br />

		<div style="float:left;width:130px;">Repeating: </div><div style="float:left;width:130px;">

			<select name='repeating'>

				<option value='0' <?php if ($_POST['repeating'] == '0') echo "selected"; ?>>0</option>

				<option value='1' <?php if ($_POST['repeating'] == '1') echo "selected"; ?>>1</option>

			</select>

			</div><br /><br />

		<div style="float:left;width:130px;">Wearoff: </div><div style="float:left;width:130px;">

			<select name='wearoff'>

				<option value='0' <?php if ($_POST['wearoff'] == '0') echo "selected"; ?>>0</option>

				<option value='1' <?php if ($_POST['wearoff'] == '1') echo "selected"; ?>>1</option>

			</select></div><br /><br />

			<div style="float:left;width:130px;">Sale Price: </div><div style="float:left;width:130px;"><input type='text' name='price' value="<?php echo $_POST['price']; ?>"></div><br /><br />

		<input type='submit' name='submit' value='Edit' >

		

<br /><br /><br />



<div>

<a href="item.php?view" style="text-decoration:none;">View all entries from database</a>

</div>

</div>



<div style='float:left;margin-left:100px;'>

<div style="float:left;width:130px;">Crafted: </div>

<div>



<select name="crafted" id="crafted" onchange="changeModel()">

					

					<option value="0" <?php if ($_POST['crafted'] == '0') echo "selected"; ?>>no</option>						

					<option value="1" <?php if ($_POST['crafted'] == '1') echo "selected"; ?>>yes</option>

					

				</select>

<span id="craft_items">

		<?php

		if ($_POST['crafted'] == 1){

		$result2 = mysql_query("SELECT * FROM items_inventory");

			$row2 = mysql_fetch_array($result2);

			?>

			<br />

			<select name="items_crafted[]" multiple="multiple"> 

    

	<?php do { ?>

	<option value="<?php echo $row2['id_item']; ?>" <?php if (in_array($row2['id_item'], $_POST['items_crafted'])) echo "selected"; ?>><?php echo $row2['name']; ?></option>

    <?php } while ($row2 = mysql_fetch_assoc($result2)); ?>

    </select>

			<br />

		<?php } ?>

</span>



</div>

<br />

<div style="float:left;width:130px;">Weapon: </div>

<div style="float:left;">



<select name="weapon" id="weapon" onchange="changeModel2()">

					

					<option value="0" <?php if ($_POST['weapon'] == '0') echo "selected"; ?>>no</option>						

					<option value="2" <?php if ($_POST['weapon'] == '2') echo "selected"; ?>>yes</option>

					<?php

						$result3 = mysql_query("SELECT * FROM items_categ WHERE name='hands'");

						$row3 = mysql_fetch_array($result3);

						?>

						<option value="<?php echo $row3['id_item']; ?>" <?php if ($_POST['weapon'] == $row3['id_item']) echo "selected"; ?>><?php echo $row3['name']; ?></option>

					

				</select>



<span id="weapon_value">

	<?php

		if ($_POST['weapon'] != 0){

	?>

		<input type='text' name='damage1' size='3' value="<?php echo $_POST['damage1'] ?>">-<input type='text' name='damage2' size='3' value="<?php echo $_POST['damage2'] ?>">

	<?php

	if ($_POST['weapon'] =='2')

		{

		?>

		<select name='w_type'>

		  <option value="M" <?php if ($_POST['w_type'] == 'M') echo "selected"; ?>>MELE</option>

		  <option value="R" <?php if ($_POST['w_type'] == 'R') echo "selected"; ?>>RANGE</option>

		</select>

		<?php

		}elseif($_POST['weapon'] =='1'){

		?>

		<select name='w_type'>

		  <option value="M" <?php if ($_POST['w_type'] == 'M') echo "selected"; ?>>MELE</option>

		</select>

		<?php

		}

		}

	?>

	</span>

</div><br /><br />

<div style="float:left;width:130px;">Armour: </div>

<div style="float:left;">

	<input type="checkbox" name="armour" id="armour" onchange="if(this.checked) document.getElementById('armour2').style.display='block'; else document.getElementById('armour2').style.display='none';" <?php if ($_POST['armour'] == 'on') echo "checked"; ?> /><br />					

	<?php if ($_POST['armour'] == 'on') {?>

	<div id="armour2" style="display:block;">

	<?php }else{ ?>

	<div id="armour2" style="display:none;">

	<?php } ?>

<?php

		$result2 = mysql_query("SELECT * FROM items_categ WHERE id_item BETWEEN 2 AND 5");

			$row2 = mysql_fetch_array($result2);

			?>

			<select name="armour2"> 

    

	<?php do { ?>

	<option value="<?php echo $row2['id_item']; ?>" <?php if ($_POST['armour2'] == $row2['id_item']) echo "selected"; ?>><?php echo $row2['name']; ?></option>

    <?php } while ($row2 = mysql_fetch_assoc($result2)); ?>

    </select>

			<br />

			

</div>

</div>

<br /><br />

<div style="float:left;width:130px;">Boss: </div>

<div style="float:left;">

<input type="checkbox" name="boss" id="boss" onchange="if(this.checked) document.getElementById('boss2').style.display='block'; else document.getElementById('boss2').style.display='none';" <?php if ($_POST['boss'] == 'on') echo "checked"; ?>/><br />

<?php if ($_POST['boss'] == 'on') {?>

	<div id="boss2" style="display:block;">

	<?php }else{ ?>

	<div id="boss2" style="display:none;">

	<?php } ?>

<?php

		$result2 = mysql_query("SELECT * FROM mobs_desc");

			$row2 = mysql_fetch_array($result2);

			?>

			<select name="boss2"> 

    

	<?php do { ?>

	<option value="<?php echo $row2['id']; ?>" <?php if ($_POST['boss2'] == $row2['id']) echo "selected"; ?>><?php echo $row2['name']; ?></option>

    <?php } while ($row2 = mysql_fetch_assoc($result2)); ?>

    </select>

			<br />

			

</div>

</div>

<br /><br />



</div>

</div>

</form>

	<?php

}else{

		$result = mysql_query("SELECT * FROM items_inventory WHERE id_item = '$_POST[id]'");

		$rows = mysql_num_rows ($result);

		if ($rows > 0)

		{

			$row = mysql_fetch_array($result);

			if ($row['id'] == $_GET['id'])

			{

			if (!empty($_POST['brutality']))

			$brutality = $_POST['brutality'];

		else $brutality = 0;

		if (!empty($_POST['accuracy']))

			$accuracy = $_POST['accuracy'];

		else $accuracy = 0;

		if (!empty($_POST['fortitude']))

			$fortitude = $_POST['fortitude'];

		else $fortitude = 0;

		if (!empty($_POST['attack']))

			$attack = $_POST['attack'];

		else $attack = 0;

		if (!empty($_POST['defense']))

			$defense = $_POST['defense'];

		else $defense = 0;

		if (!empty($_POST['health']))

			$health = $_POST['health'];

		else $health = 0;

		if (!empty($_POST['regen']))

			$regen = $_POST['regen'];

		else $regen = 0;

		if (!empty($_POST['duration']))

			$duration = $_POST['duration'];

		else $duration = 0;

		if ($_POST['crafted'] == 1){

		$crafted = "";

		sort($_POST['items_crafted']);

		foreach ($_POST['items_crafted'] as $val)

		{	

			$q = $_POST['details'.$val];

			$crafted .=$val.";".$q.",";

			

		}

		$crafted = substr_replace($crafted,"",-1);

		}

		if ($_POST['weapon'] != 0){

		$damage= $_POST['damage1']."-".$_POST['damage2']."-".$_POST['w_type'];

		}

			$result = mysql_query("SELECT * FROM items_categ WHERE name='hands'");

			$row = mysql_fetch_array($result);

		if ($_POST['weapon'] == '2')

			$slot = '6';

		elseif ($_POST['weapon'] == $row['id_item'])

			$slot = $row['id_item'];

		elseif ($_POST['armour'] == 'on')

			$slot = $_POST['armour2'];

		elseif ($_POST['boss'] == 'on')

			$slot = '8';

		else

			$slot = '7';

		if ($slot =='8'){

			if (!empty($_POST['boss2']))

				$id_boss = $_POST['boss2'];

			else

				$id_boss = 0;

		}else{

			$id_boss = 0;

		}		

		

		if (!empty ($_POST['price']))

			$price = $_POST['price'];

		else $price = 0;

		$name = addslashes($_POST['name']);

		$result = mysql_query("SELECT * FROM loot WHERE item='$_POST[id]'");

		$rows = mysql_fetch_array($result);

		if ($rows > 0){

			mysql_query("UPDATE loot SET value='$_POST[loot]' WHERE item='$_POST[id]'");

		}else{

			mysql_query("INSERT INTO loot (value, item) VALUES ('$_POST[loot]', '$_POST[id]')");

		}

				mysql_query("UPDATE items_inventory SET id_item='$_POST[id]', name='$name', brutality='$brutality', accuracy='$accuracy', 

					fortitude='$fortitude', attack='$attack', defense='$defense', health='$health', regen='$regen', duration='$duration', 

					repeating='$_POST[repeating]', wearoff='$_POST[wearoff]', slot='$slot', craft='$_POST[crafted]', weapon='$_POST[weapon]', 

					craft_items='$crafted', weapon_items='$damage', price='$price', level='$_POST[level]', loot='$_POST[loot]', id_mob='$id_boss' WHERE id='$_GET[id]'");

				header ("Location:item.php?view");

				//print_r($_POST);

			}else{

				echo "<font color='red'><b>ID is in database!</b></font><br />";

		?>

			<form method="POST" action="">

		<div style='float:left;'>

		<div style="float:left;width:130px;">ID: </div><div style="float:left;width:130px;"><input type='text' name='id' ></div><br /><br />

		<div style="float:left;width:130px;">Name: </div><div style="float:left;width:130px;"><input type='text' name='name' value="<?php echo $_POST['name']; ?>"></div><br /><br />

		<div style="float:left;width:130px;">Brutality: </div><div style="float:left;width:130px;"><input type='text' name='brutality' value="<?php echo $_POST['brutality']; ?>"></div><br /><br />

		<div style="float:left;width:130px;">Accuracy: </div><div style="float:left;width:130px;"><input type='text' name='accuracy' value="<?php echo $_POST['accuracy']; ?>"></div><br /><br />

		<div style="float:left;width:130px;">Fortitude: </div><div style="float:left;width:130px;"><input type='text' name='fortitude' value="<?php echo $_POST['fortitude']; ?>"></div><br /><br />

		<div style="float:left;width:130px;">Attack: </div><div style="float:left;width:130px;"><input type='text' name='attack' value="<?php echo $_POST['attack']; ?>"></div><br /><br />

		<div style="float:left;width:130px;">Defense stat: </div><div style="float:left;width:130px;"><input type='text' name='defense' value="<?php echo $_POST['defense']; ?>"></div><br /><br />

		<div style="float:left;width:130px;">Health: </div><div style="float:left;width:130px;"><input type='text' name='health' value="<?php echo $_POST['health']; ?>"></div><br /><br />

		<div style="float:left;width:130px;">Regen: </div><div style="float:left;width:130px;"><input type='text' name='regen' value="<?php echo $_POST['regen']; ?>"></div><br /><br />

		<div style="float:left;width:130px;">Duration: </div><div style="float:left;width:130px;"><input type='text' name='duration' value="<?php echo $_POST['duration']; ?>"></div><br /><br />

		<div style="float:left;width:130px;">Min level: </div><div style="float:left;width:130px;"><input type='text' name='level' value="<?php echo $_POST['level']; ?>"></div><br /><br />

		<div style="float:left;width:130px;">Loot: </div><div style="float:left;width:130px;"><input type='text' name='loot' value="<?php echo $_POST['loot']; ?>"></div><br />

		<div style="float:left;width:130px;">

<a href="javascript:void(0);" onClick="document.getElementById('sublink').style.display='block';">Loot packs</a>

</div>

<div id="sublink" style="display:none;float:left;width:130px;">

	<?php

		$result = mysql_query("SELECT DISTINCT(value) FROM loot");

		$rows = mysql_num_rows($result);

		if ($rows > 0){

		?>

		<table><tr><td style="background: #5b7480">Loot no</td><td style="background: #5b7480">Items</td></tr>

		<?php

		while ($row = mysql_fetch_array($result)){

			echo "<tr><td style='background: #eeeeee'>".$row['value']."</td><td style='background: #eeeeee'>";

			$result2 = mysql_query("SELECT * FROM items_inventory WHERE loot = '$row[value]' ORDER BY id_item");

			while ($row2 = mysql_fetch_array($result2)){

				echo $row2['id_item']." ";

			}

			echo "</td></tr>";

		}

		?>

		</table>

		<?php

		}else

			echo "No loot pack";

	?>

</div>

<br /><br />

		<div style="float:left;width:130px;">Repeating: </div><div style="float:left;width:130px;">

			<select name='repeating'>

				<option value='0' <?php if ($_POST['repeating'] == '0') echo "selected"; ?>>0</option>

				<option value='1' <?php if ($_POST['repeating'] == '1') echo "selected"; ?>>1</option>

			</select>

			</div><br /><br />

		<div style="float:left;width:130px;">Wearoff: </div><div style="float:left;width:130px;">

			<select name='wearoff'>

				<option value='0' <?php if ($_POST['wearoff'] == '0') echo "selected"; ?>>0</option>

				<option value='1' <?php if ($_POST['wearoff'] == '1') echo "selected"; ?>>1</option>

			</select></div><br /><br />

			<div style="float:left;width:130px;">Sale Price: </div><div style="float:left;width:130px;"><input type='text' name='price' value="<?php echo $_POST['price']; ?>"></div><br /><br />

		<input type='submit' name='submit' value='Edit' >

		

<br /><br /><br />



<div>

<a href="item.php?view" style="text-decoration:none;">View all entries from database</a>

</div>

</div>



<div style='float:left;margin-left:100px;'>

<div style="float:left;width:130px;">Crafted: </div>

<div>



<select name="crafted" id="crafted" onchange="changeModel()">

					

					<option value="0" <?php if ($_POST['crafted'] == '0') echo "selected"; ?>>no</option>						

					<option value="1" <?php if ($_POST['crafted'] == '1') echo "selected"; ?>>yes</option>

					

				</select>

<span id="craft_items">

		<?php

		if ($_POST['crafted'] == 1){

		$result2 = mysql_query("SELECT * FROM items_inventory");

			$row2 = mysql_fetch_array($result2);

			?>

			<br />

			<select name="items_crafted[]" multiple="multiple"> 

    

	<?php do { ?>

	<option value="<?php echo $row2['id_item']; ?>" <?php if (in_array($row2['id_item'], $_POST['items_crafted'])) echo "selected"; ?>><?php echo $row2['name']; ?></option>

    <?php } while ($row2 = mysql_fetch_assoc($result2)); ?>

    </select>

			<br />

		<?php } ?>

</span>



</div>

<br />

<div style="float:left;width:130px;">Weapon: </div>

<div style="float:left;">



<select name="weapon" id="weapon" onchange="changeModel2()">

					

					<option value="0" <?php if ($_POST['weapon'] == '0') echo "selected"; ?>>no</option>						

					<option value="2" <?php if ($_POST['weapon'] == '2') echo "selected"; ?>>yes</option>

					<?php

						$result3 = mysql_query("SELECT * FROM items_categ WHERE name='hands'");

						$row3 = mysql_fetch_array($result3);

						?>

						<option value="<?php echo $row3['id_item']; ?>" <?php if ($_POST['weapon'] == $row3['id_item']) echo "selected"; ?>><?php echo $row3['name']; ?></option>

					

				</select>



<span id="weapon_value">

	<?php

		if ($_POST['weapon'] != 0){

	?>

		<input type='text' name='damage1' size='3' value="<?php echo $_POST['damage1'] ?>">-<input type='text' name='damage2' size='3' value="<?php echo $_POST['damage2'] ?>">

	<?php

	if ($_POST['weapon'] =='2')

		{

		?>

		<select name='w_type'>

		  <option value="M" <?php if ($_POST['w_type'] == 'M') echo "selected"; ?>>MELE</option>

		  <option value="R" <?php if ($_POST['w_type'] == 'R') echo "selected"; ?>>RANGE</option>

		</select>

		<?php

		}elseif($_POST['weapon'] =='1'){

		?>

		<select name='w_type'>

		  <option value="M" <?php if ($_POST['w_type'] == 'M') echo "selected"; ?>>MELE</option>

		</select>

		<?php

		}

		}

	?>

	</span>

</div>

<br /><br />

<div style="float:left;width:130px;">Armour: </div>

<div style="float:left;">

	<input type="checkbox" name="armour" id="armour" onchange="if(this.checked) document.getElementById('armour2').style.display='block'; else document.getElementById('armour2').style.display='none';" <?php if ($_POST['armour'] == 'on') echo "checked"; ?> /><br />					

	<?php if ($_POST['armour'] == 'on') {?>

	<div id="armour2" style="display:block;">

	<?php }else{ ?>

	<div id="armour2" style="display:none;">

	<?php } ?>

<?php

		$result2 = mysql_query("SELECT * FROM items_categ WHERE id_item BETWEEN 2 AND 5");

			$row2 = mysql_fetch_array($result2);

			?>

			<select name="armour2"> 

    

	<?php do { ?>

	<option value="<?php echo $row2['id_item']; ?>" <?php if ($_POST['armour2'] == $row2['id_item']) echo "selected"; ?>><?php echo $row2['name']; ?></option>

    <?php } while ($row2 = mysql_fetch_assoc($result2)); ?>

    </select>

			<br />

			

</div>

</div>

<br /><br />

<div style="float:left;width:130px;">Boss: </div>

<div style="float:left;">

<input type="checkbox" name="boss" id="boss" onchange="if(this.checked) document.getElementById('boss2').style.display='block'; else document.getElementById('boss2').style.display='none';" <?php if ($_POST['boss'] == 'on') echo "checked"; ?>/><br />

<?php if ($_POST['boss'] == 'on') {?>

	<div id="boss2" style="display:block;">

	<?php }else{ ?>

	<div id="boss2" style="display:none;">

	<?php } ?>

<?php

		$result2 = mysql_query("SELECT * FROM mobs_desc");

			$row2 = mysql_fetch_array($result2);

			?>

			<select name="boss2"> 

    

	<?php do { ?>

	<option value="<?php echo $row2['id']; ?>" <?php if ($_POST['boss2'] == $row2['id']) echo "selected"; ?>><?php echo $row2['name']; ?></option>

    <?php } while ($row2 = mysql_fetch_assoc($result2)); ?>

    </select>

			<br />

			

</div>

</div>

<br /><br />



</div>

</div>

</form>

		<?php

			}

		}else{

			if (!empty($_POST['brutality']))

			$brutality = $_POST['brutality'];

		else $brutality = 0;

		if (!empty($_POST['accuracy']))

			$accuracy = $_POST['accuracy'];

		else $accuracy = 0;

		if (!empty($_POST['fortitude']))

			$fortitude = $_POST['fortitude'];

		else $fortitude = 0;

		if (!empty($_POST['attack']))

			$attack = $_POST['attack'];

		else $attack = 0;

		if (!empty($_POST['defense']))

			$defense = $_POST['defense'];

		else $defense = 0;

		if (!empty($_POST['health']))

			$health = $_POST['health'];

		else $health = 0;

		if (!empty($_POST['regen']))

			$regen = $_POST['regen'];

		else $regen = 0;

		if (!empty($_POST['duration']))

			$duration = $_POST['duration'];

		else $duration = 0;

		if ($_POST['crafted'] == 1){

		$crafted = "";

		sort($_POST['items_crafted']);

		foreach ($_POST['items_crafted'] as $val)

		{	

			$q = $_POST['details'.$val];

			$crafted .=$val.";".$q.",";

			

		}

		$crafted = substr_replace($crafted,"",-1);

		}

		if ($_POST['weapon'] != 0){

		$damage= $_POST['damage1']."-".$_POST['damage2']."-".$_POST['w_type'];

		}

			$result = mysql_query("SELECT * FROM items_categ WHERE name='hands'");

			$row = mysql_fetch_array($result);

		if ($_POST['weapon'] == '2')

			$slot = '6';

		elseif ($_POST['weapon'] == $row['id_item'])

			$slot = $row['id_item'];

		elseif ($_POST['armour'] == 'on')

			$slot = $_POST['armour2'];

		elseif ($_POST['boss'] == 'on')

			$slot = '8';

		else

			$slot = '7';

		if ($slot =='8'){

			if (!empty($_POST['boss2']))

				$id_boss = $_POST['boss2'];

			else

				$id_boss = 0;

		}else{

			$id_boss = 0;

		}		

		

		if (!empty ($_POST['price']))

			$price = $_POST['price'];

		else $price = 0;

		$name = addslashes($_POST['name']);

		$result = mysql_query("SELECT * FROM loot WHERE item='$_POST[id]'");

		$rows = mysql_fetch_array($result);

		if ($rows > 0){

			mysql_query("UPDATE loot SET value='$_POST[loot]' WHERE item='$_POST[id]'");

		}else{

			mysql_query("INSERT INTO loot (value, item) VALUES ('$_POST[loot]', '$_POST[id]')");

		}

			mysql_query("UPDATE items_inventory SET id_item='$_POST[id]', name='$name', brutality='$brutality', accuracy='$accuracy', 

					fortitude='$fortitude', attack='$attack', defense='$defense', health='$health', regen='$regen', duration='$duration', 

					repeating='$_POST[repeating]', wearoff='$_POST[wearoff]', slot='$slot', craft='$_POST[crafted]', weapon='$_POST[weapon]', 

					craft_items='$crafted', weapon_items='$damage', price='$price', level='$_POST[level]', loot='$_POST[loot]', id_mob='$id_boss' WHERE id='$_GET[id]'");

			header ("Location:item.php?view");

			//print_r($_POST);

		}

}

}else{

if (!isset($_POST['submit'])){

?>

<form method="POST" action="">

<div style='float:left;'>



<div style="float:left;width:130px;">ID: </div><div style="float:left;width:130px;"><input type='text' name='id' ></div><br /><br />

<div style="float:left;width:130px;">Name: </div><div style="float:left;width:130px;"><input type='text' name='name' ></div><br /><br />

<div style="float:left;width:130px;">Brutality: </div><div style="float:left;width:130px;"><input type='text' name='brutality' ></div><br /><br />

<div style="float:left;width:130px;">Accuracy: </div><div style="float:left;width:130px;"><input type='text' name='accuracy' ></div><br /><br />

<div style="float:left;width:130px;">Fortitude: </div><div style="float:left;width:130px;"><input type='text' name='fortitude' ></div><br /><br />

<div style="float:left;width:130px;">Attack: </div><div style="float:left;width:130px;"><input type='text' name='attack' ></div><br /><br />

<div style="float:left;width:130px;">Defense stat: </div><div style="float:left;width:130px;"><input type='text' name='defense' ></div><br /><br />

<div style="float:left;width:130px;">Health: </div><div style="float:left;width:130px;"><input type='text' name='health' ></div><br /><br />

<div style="float:left;width:130px;">Regen: </div><div style="float:left;width:130px;"><input type='text' name='regen' ></div><br /><br />

<div style="float:left;width:130px;">Duration: </div><div style="float:left;width:130px;"><input type='text' name='duration' ></div><br /><br />

<div style="float:left;width:130px;">Min level: </div><div style="float:left;width:130px;"><input type='text' name='level' value='1'></div><br /><br />

<div style="float:left;width:130px;">Loot: </div><div style="float:left;width:130px;"><input type='text' name='loot' ></div><br />

<div style="float:left;width:130px;">

<a href="javascript:void(0);" onClick="document.getElementById('sublink').style.display='block';">Loot packs</a>

</div>

<div id="sublink" style="display:none;float:left;width:130px;">

	<?php

		$result = mysql_query("SELECT DISTINCT(value) FROM loot");

		$rows = mysql_num_rows($result);

		if ($rows > 0){

		?>

		<table><tr><td style="background: #5b7480">Loot no</td><td style="background: #5b7480">Items</td></tr>

		<?php

		while ($row = mysql_fetch_array($result)){

			echo "<tr><td style='background: #eeeeee'>".$row['value']."</td><td style='background: #eeeeee'>";

			$result2 = mysql_query("SELECT * FROM items_inventory WHERE loot = '$row[value]' ORDER BY id_item");

			while ($row2 = mysql_fetch_array($result2)){

				echo $row2['id_item']." ";

			}

			echo "</td></tr>";

		}

		?>

		</table>

		<?php

		}else

			echo "No loot pack";

	?>

</div>

<br /><br />

<div style="float:left;width:130px;">Repeating: </div><div style="float:left;width:130px;">

<select name='repeating'>

	<option value='0' >0</option>

	<option value='1' >1</option>

</select>

</div><br /><br />

<div style="float:left;width:130px;">Wearoff: </div><div style="float:left;width:130px;">

<select name='wearoff'>

	<option value='0' >0</option>

	<option value='1' >1</option>

</select>



</div>

<br /><br />

<div style="float:left;width:130px;">Sale Price: </div><div style="float:left;width:130px;"><input type='text' name='price' value="0"></div><br /><br />

<input type='submit' name='submit' value='Save' >

<br /><br /><br />



<div>

<a href="item.php?view" style="text-decoration:none;">View all entries from database</a>

</div>

</div>



<div style='float:left;margin-left:100px;'>

<div style="float:left;width:130px;">Crafted: </div>

<div>



<select name="crafted" id="crafted" onchange="changeModel()">

					

					<?php

						print '<option value="0">no</option>';							

						print '<option value="1">yes</option>';	

						

					?>

				</select>

<span id="craft_items">

		

	</span>



</div>

<br />

<div style="float:left;width:130px;">Weapon: </div>

<div style="float:left;">



<select name="weapon" id="weapon" onchange="changeModel2()">

					

					<?php

						print '<option value="0">no</option>';							

						print '<option value="2">yes</option>';	

						$result = mysql_query("SELECT * FROM items_categ WHERE name='hands'");

						$row = mysql_fetch_array($result);

						print '<option value="'.$row['id_item'].'">'.$row['name'].'</option>';

					?>

				</select>



<span id="weapon_value">

				

	</span>

</div><br /><br />

<div style="float:left;width:130px;">Armour: </div>

<div style="float:left;">

	<input type="checkbox" name="armour" id="armour" onchange="if(this.checked) document.getElementById('armour2').style.display='block'; else document.getElementById('armour2').style.display='none';"><br />					

<div id="armour2" style="display:none;">

<?php

		$result2 = mysql_query("SELECT * FROM items_categ WHERE id_item BETWEEN 2 AND 5");

			$row2 = mysql_fetch_array($result2);

			?>

			<select name="armour2"> 

    

	<?php do { ?>

	<option value="<?php echo $row2['id_item']; ?>" ><?php echo $row2['name']; ?></option>

    <?php } while ($row2 = mysql_fetch_assoc($result2)); ?>

    </select>

			<br />

			

</div>

</div><br /><br />

<div style="float:left;width:130px;">Boss: </div>

<div style="float:left;">

	<input type="checkbox" name="boss" id="boss" onchange="if(this.checked) document.getElementById('boss2').style.display='block'; else document.getElementById('boss2').style.display='none';"><br />					

<div id="boss2" style="display:none;">

<?php

		$result2 = mysql_query("SELECT * FROM mobs_desc");

			$row2 = mysql_fetch_array($result2);

			?>

			<select name="boss2"> 

    

	<?php do { ?>

	<option value="<?php echo $row2['id']; ?>" ><?php echo $row2['name']; ?></option>

    <?php } while ($row2 = mysql_fetch_assoc($result2)); ?>

    </select>

			<br />

			

</div>

</div><br /><br />



</form>

<?php

}elseif (empty($_POST['id']) || empty($_POST['name']) || !is_numeric($_POST['loot'])){

	$error = "";

	if (empty($_POST['id']))

		$error .= "<font color='red'><b>Please insert ID</b></font><br />";

	if (empty($_POST['name']))

		$error .= "<font color='red'><b>Please insert Name</b></font><br />";

	if (!is_numeric($_POST['loot']))

		$error .= "<font color='red'><b>Loot must be a number</b></font><br />";

	echo $error;

	?>

	<form method="POST" action="">

		<div style='float:left;'>

		<div style="float:left;width:130px;">ID: </div><div style="float:left;width:130px;"><input type='text' name='id' value="<?php echo $_POST['id']; ?>"></div><br /><br />

		<div style="float:left;width:130px;">Name: </div><div style="float:left;width:130px;"><input type='text' name='name' value="<?php echo $_POST['name']; ?>"></div><br /><br />

		<div style="float:left;width:130px;">Brutality: </div><div style="float:left;width:130px;"><input type='text' name='brutality' value="<?php echo $_POST['brutality']; ?>"></div><br /><br />

		<div style="float:left;width:130px;">Accuracy: </div><div style="float:left;width:130px;"><input type='text' name='accuracy' value="<?php echo $_POST['accuracy']; ?>"></div><br /><br />

		<div style="float:left;width:130px;">Fortitude: </div><div style="float:left;width:130px;"><input type='text' name='fortitude' value="<?php echo $_POST['fortitude']; ?>"></div><br /><br />

		<div style="float:left;width:130px;">Attack: </div><div style="float:left;width:130px;"><input type='text' name='attack' value="<?php echo $_POST['attack']; ?>"></div><br /><br />

		<div style="float:left;width:130px;">Defense stat: </div><div style="float:left;width:130px;"><input type='text' name='defense' value="<?php echo $_POST['defense']; ?>"></div><br /><br />

		<div style="float:left;width:130px;">Health: </div><div style="float:left;width:130px;"><input type='text' name='health' value="<?php echo $_POST['health']; ?>"></div><br /><br />

		<div style="float:left;width:130px;">Regen: </div><div style="float:left;width:130px;"><input type='text' name='regen' value="<?php echo $_POST['regen']; ?>"></div><br /><br />

		<div style="float:left;width:130px;">Duration: </div><div style="float:left;width:130px;"><input type='text' name='duration' value="<?php echo $_POST['duration']; ?>"></div><br /><br />

		<div style="float:left;width:130px;">Min level: </div><div style="float:left;width:130px;"><input type='text' name='level' value="<?php echo $_POST['level']; ?>"></div><br /><br />

		<div style="float:left;width:130px;">Loot: </div><div style="float:left;width:130px;"><input type='text' name='loot' value="<?php echo $_POST['loot']; ?>"></div><br />

		<div style="float:left;width:130px;">

<a href="javascript:void(0);" onClick="document.getElementById('sublink').style.display='block';">Loot packs</a>

</div>

<div id="sublink" style="display:none;float:left;width:130px;">

	<?php

		$result = mysql_query("SELECT DISTINCT(value) FROM loot");

		$rows = mysql_num_rows($result);

		if ($rows > 0){

		?>

		<table><tr><td style="background: #5b7480">Loot no</td><td style="background: #5b7480">Items</td></tr>

		<?php

		while ($row = mysql_fetch_array($result)){

			echo "<tr><td style='background: #eeeeee'>".$row['value']."</td><td style='background: #eeeeee'>";

			$result2 = mysql_query("SELECT * FROM items_inventory WHERE loot = '$row[value]' ORDER BY id_item");

			while ($row2 = mysql_fetch_array($result2)){

				echo $row2['id_item']." ";

			}

			echo "</td></tr>";

		}

		?>

		</table>

		<?php

		}else

			echo "No loot pack";

	?>

</div>

<br /><br />

		<div style="float:left;width:130px;">Repeating: </div><div style="float:left;width:130px;">

			<select name='repeating'>

				<option value='0' <?php if ($_POST['repeating'] == '0') echo "selected"; ?>>0</option>

				<option value='1' <?php if ($_POST['repeating'] == '1') echo "selected"; ?>>1</option>

			</select>

			</div><br /><br />

		<div style="float:left;width:130px;">Wearoff: </div><div style="float:left;width:130px;">

			<select name='wearoff'>

				<option value='0' <?php if ($_POST['wearoff'] == '0') echo "selected"; ?>>0</option>

				<option value='1' <?php if ($_POST['wearoff'] == '1') echo "selected"; ?>>1</option>

			</select></div><br /><br />

		<div style="float:left;width:130px;">Sale Price: </div><div style="float:left;width:130px;"><input type='text' name='price' value="<?php echo $_POST['price']; ?>"></div><br /><br />

		<input type='submit' name='submit' value='Save' >

<br /><br /><br />



<div>

<a href="item.php?view" style="text-decoration:none;">View all entries from database</a>

</div>

</div>



<div style='float:left;margin-left:100px;'>

<div style="float:left;width:130px;">Crafted: </div>

<div>



<select name="crafted" id="crafted" onchange="changeModel()">

					

					<option value="0" <?php if ($_POST['crafted'] == '0') echo "selected"; ?>>no</option>						

					<option value="1" <?php if ($_POST['crafted'] == '1') echo "selected"; ?>>yes</option>

						

					

				</select>

<span id="craft_items">

		<?php

		if ($_POST['crafted'] == 1){

		$result2 = mysql_query("SELECT * FROM items_inventory");

			$row2 = mysql_fetch_array($result2);

			?>

			<br />

			<select name="items_crafted[]" multiple="multiple"> 

    

	<?php do { ?>

	<option value="<?php echo $row2['id_item']; ?>" <?php if (in_array($row2['id_item'], $_POST['items_crafted'])) echo "selected"; ?>><?php echo $row2['name']; ?></option>

    <?php } while ($row2 = mysql_fetch_assoc($result2)); ?>

    </select>

			<br />

			<?php

			}

			?>

			

</span>



</div>

<br />

<div style="float:left;width:130px;">Weapon: </div>

<div style="float:left;">



<select name="weapon" id="weapon" onchange="changeModel2()">

					

					<option value="0" <?php if ($_POST['weapon'] == '0') echo "selected"; ?>>no</option>						

					<option value="2" <?php if ($_POST['weapon'] == '2') echo "selected"; ?>>yes</option>	

					<?php

						$result = mysql_query("SELECT * FROM items_categ WHERE name='hands'");

						$row = mysql_fetch_array($result);

						?>

						<option value="<?php echo $row['id_item']; ?>" <?php if ($_POST['weapon'] == $row['id_item']) echo "selected"; ?>><?php echo $row['name']; ?></option>

					

				</select>



<span id="weapon_value">

		<?php

		if ($_POST['weapon'] != 0){

		?>

		<input type='text' name='damage1' size='3' value="<?php echo $_POST['damage1'] ?>">-<input type='text' name='damage2' size='3' value="<?php echo $_POST['damage2'] ?>">

		<?php

		if ($_POST['weapon'] =='2')

		{

		?>

		<select name='w_type'>

		  <option value="M" <?php if ($_POST['w_type'] == 'M') echo "selected"; ?>>MELE</option>

		  <option value="R" <?php if ($_POST['w_type'] == 'R') echo "selected"; ?>>RANGE</option>

		</select>

		<?php

		}elseif($_POST['weapon'] =='1'){

		?>

		<select name='w_type'>

		  <option value="M" <?php if ($_POST['w_type'] == 'M') echo "selected"; ?>>MELE</option>

		</select>

		<?php

		}

		

		}

		?>

	</span>

</div><br /><br />



<div style="float:left;width:130px;">Armour: </div>

<div style="float:left;">

	<input type="checkbox" name="armour" id="armour" onchange="if(this.checked) document.getElementById('armour2').style.display='block'; else document.getElementById('armour2').style.display='none';" <?php if ($_POST['armour'] == 'on') echo "checked"; ?> /><br />					

	<?php if ($_POST['armour'] == 'on') {?>

	<div id="armour2" style="display:block;">

	<?php }else{ ?>

	<div id="armour2" style="display:none;">

	<?php } ?>

<?php

		$result2 = mysql_query("SELECT * FROM items_categ WHERE id_item BETWEEN 2 AND 5");

			$row2 = mysql_fetch_array($result2);

			?>

			<select name="armour2"> 

    

	<?php do { ?>

	<option value="<?php echo $row2['id_item']; ?>" <?php if ($_POST['armour2'] == $row2['id_item']) echo "selected"; ?>><?php echo $row2['name']; ?></option>

    <?php } while ($row2 = mysql_fetch_assoc($result2)); ?>

    </select>

			<br />

			

</div>

</div>

<br /><br />

<div style="float:left;width:130px;">Boss: </div>

<div style="float:left;">

<input type="checkbox" name="boss" id="boss" onchange="if(this.checked) document.getElementById('boss2').style.display='block'; else document.getElementById('boss2').style.display='none';" <?php if ($_POST['boss'] == 'on') echo "checked"; ?>/><br />

<?php if ($_POST['boss'] == 'on') {?>

	<div id="boss2" style="display:block;">

	<?php }else{ ?>

	<div id="boss2" style="display:none;">

	<?php } ?>

<?php

		$result2 = mysql_query("SELECT * FROM mobs_desc");

			$row2 = mysql_fetch_array($result2);

			?>

			<select name="boss2"> 

    

	<?php do { ?>

	<option value="<?php echo $row2['id']; ?>" <?php if ($_POST['boss2'] == $row2['id']) echo "selected"; ?>><?php echo $row2['name']; ?></option>

    <?php } while ($row2 = mysql_fetch_assoc($result2)); ?>

    </select>

			<br />

			

</div>

</div>

<br /><br />

</form>

	<?php

}else{

	$result = mysql_query("SELECT * FROM items_inventory WHERE id_item = '$_POST[id]'");

	$rows = mysql_num_rows($result);

	if ($rows > 0)

	{

		echo "<font color='red'><b>ID is in database!</b></font><br />";

		?>

	<form method="POST" action="">

		<div style='float:left;'>

		<div style="float:left;width:130px;">ID: </div><div style="float:left;width:130px;"><input type='text' name='id'></div><br /><br />

		<div style="float:left;width:130px;">Name: </div><div style="float:left;width:130px;"><input type='text' name='name' value="<?php echo $_POST['name']; ?>"></div><br /><br />

		<div style="float:left;width:130px;">Brutality: </div><div style="float:left;width:130px;"><input type='text' name='brutality' value="<?php echo $_POST['brutality']; ?>"></div><br /><br />

		<div style="float:left;width:130px;">Accuracy: </div><div style="float:left;width:130px;"><input type='text' name='accuracy' value="<?php echo $_POST['accuracy']; ?>"></div><br /><br />

		<div style="float:left;width:130px;">Fortitude: </div><div style="float:left;width:130px;"><input type='text' name='fortitude' value="<?php echo $_POST['fortitude']; ?>"></div><br /><br />

		<div style="float:left;width:130px;">Attack: </div><div style="float:left;width:130px;"><input type='text' name='attack' value="<?php echo $_POST['attack']; ?>"></div><br /><br />

		<div style="float:left;width:130px;">Defense stat: </div><div style="float:left;width:130px;"><input type='text' name='defense' value="<?php echo $_POST['defense']; ?>"></div><br /><br />

		<div style="float:left;width:130px;">Health: </div><div style="float:left;width:130px;"><input type='text' name='health' value="<?php echo $_POST['health']; ?>"></div><br /><br />

		<div style="float:left;width:130px;">Regen: </div><div style="float:left;width:130px;"><input type='text' name='regen' value="<?php echo $_POST['regen']; ?>"></div><br /><br />

		<div style="float:left;width:130px;">Duration: </div><div style="float:left;width:130px;"><input type='text' name='duration' value="<?php echo $_POST['duration']; ?>"></div><br /><br />

		<div style="float:left;width:130px;">Min level: </div><div style="float:left;width:130px;"><input type='text' name='level' value="<?php echo $_POST['level']; ?>"></div><br /><br />

		<div style="float:left;width:130px;">Loot: </div><div style="float:left;width:130px;"><input type='text' name='loot' value="<?php echo $_POST['loot']; ?>"></div><br />

		<div style="float:left;width:130px;">

<a href="javascript:void(0);" onClick="document.getElementById('sublink').style.display='block';">Loot packs</a>

</div>

<div id="sublink" style="display:none;float:left;width:130px;">

	<?php

		$result = mysql_query("SELECT DISTINCT(value) FROM loot");

		$rows = mysql_num_rows($result);

		if ($rows > 0){

		?>

		<table><tr><td style="background: #5b7480">Loot no</td><td style="background: #5b7480">Items</td></tr>

		<?php

		while ($row = mysql_fetch_array($result)){

			echo "<tr><td style='background: #eeeeee'>".$row['value']."</td><td style='background: #eeeeee'>";

			$result2 = mysql_query("SELECT * FROM items_inventory WHERE loot = '$row[value]' ORDER BY id_item");

			while ($row2 = mysql_fetch_array($result2)){

				echo $row2['id_item']." ";

			}

			echo "</td></tr>";

		}

		?>

		</table>

		<?php

		}else

			echo "No loot pack";

	?>

</div>

<br /><br />

		<div style="float:left;width:130px;">Repeating: </div><div style="float:left;width:130px;">

			<select name='repeating'>

				<option value='0' <?php if ($_POST['repeating'] == '0') echo "selected"; ?>>0</option>

				<option value='1' <?php if ($_POST['repeating'] == '1') echo "selected"; ?>>1</option>

			</select>

			</div><br /><br />

		<div style="float:left;width:130px;">Wearoff: </div><div style="float:left;width:130px;">

			<select name='wearoff'>

				<option value='0' <?php if ($_POST['wearoff'] == '0') echo "selected"; ?>>0</option>

				<option value='1' <?php if ($_POST['wearoff'] == '1') echo "selected"; ?>>1</option>

			</select></div><br /><br />

		<div style="float:left;width:130px;">Sale Price: </div><div style="float:left;width:130px;"><input type='text' name='price' value="<?php echo $_POST['price']; ?>"></div><br /><br />

		<input type='submit' name='submit' value='Save' >

<br /><br /><br />



<div>

<a href="item.php?view" style="text-decoration:none;">View all entries from database</a>

</div>

</div>



<div style='float:left;margin-left:100px;'>

<div style="float:left;width:130px;">Crafted: </div>

<div>



<select name="crafted" id="crafted" onchange="changeModel()">

					

					<option value="0" <?php if ($_POST['crafted'] == '0') echo "selected"; ?>>no</option>						

					<option value="1" <?php if ($_POST['crafted'] == '1') echo "selected"; ?>>yes</option>

						

					

				</select>

<span id="craft_items">

		<?php

		if ($_POST['crafted'] == 1){

		$result2 = mysql_query("SELECT * FROM items_inventory");

			$row2 = mysql_fetch_array($result2);

			?>

			<br />

			<select name="items_crafted[]" multiple="multiple"> 

    

	<?php do { ?>

	<option value="<?php echo $row2['id_item']; ?>" <?php if (in_array($row2['id_item'], $_POST['items_crafted'])) echo "selected"; ?>><?php echo $row2['name']; ?></option>

    <?php } while ($row2 = mysql_fetch_assoc($result2)); ?>

    </select>

			<br />

		<?php

		}

		?>

			

</span>



</div>

<br />

<div style="float:left;width:130px;">Weapon: </div>

<div style="float:left;">



<select name="weapon" id="weapon" onchange="changeModel2()">

					

					<option value="0" <?php if ($_POST['weapon'] == '0') echo "selected"; ?>>no</option>						

					<option value="2" <?php if ($_POST['weapon'] == '2') echo "selected"; ?>>yes</option>	

					<?php

						$result = mysql_query("SELECT * FROM items_categ WHERE name='hands'");

						$row = mysql_fetch_array($result);

						?>

						<option value="<?php echo $row['id_item']; ?>" <?php if ($_POST['weapon'] == $row['id_item']) echo "selected"; ?>><?php echo $row['name']; ?></option>

					

				</select>



<span id="weapon_value">

		<?php

		if ($_POST['weapon'] != 0){

		?>

		<input type='text' name='damage1' size='3' value="<?php echo $_POST['damage1'] ?>">-<input type='text' name='damage2' size='3' value="<?php echo $_POST['damage2'] ?>">		

		

		<?php

		if ($_POST['weapon'] =='2')

		{

		?>

		<select name='w_type'>

		  <option value="M" <?php if ($_POST['w_type'] == 'M') echo "selected"; ?>>MELE</option>

		  <option value="R" <?php if ($_POST['w_type'] == 'R') echo "selected"; ?>>RANGE</option>

		</select>

		<?php

		}elseif($_POST['weapon'] =='1'){

		?>

		<select name='w_type'>

		  <option value="M" <?php if ($_POST['w_type'] == 'M') echo "selected"; ?>>MELE</option>

		</select>

		<?php

		}

		}

		?>

	</span>

</div><br /><br />

<div style="float:left;width:130px;">Armour: </div>

<div style="float:left;">

	<input type="checkbox" name="armour" id="armour" onchange="if(this.checked) document.getElementById('armour2').style.display='block'; else document.getElementById('armour2').style.display='none';" <?php if ($_POST['armour'] == 'on') echo "checked"; ?> /><br />					

	<?php if ($_POST['armour'] == 'on') {?>

	<div id="armour2" style="display:block;">

	<?php }else{ ?>

	<div id="armour2" style="display:none;">

	<?php } ?>

<?php

		$result2 = mysql_query("SELECT * FROM items_categ WHERE id_item BETWEEN 2 AND 5");

			$row2 = mysql_fetch_array($result2);

			?>

			<select name="armour2"> 

    

	<?php do { ?>

	<option value="<?php echo $row2['id_item']; ?>" <?php if ($_POST['armour2'] == $row2['id_item']) echo "selected"; ?>><?php echo $row2['name']; ?></option>

    <?php } while ($row2 = mysql_fetch_assoc($result2)); ?>

    </select>

			<br />

			

</div>

</div>

<br /><br />

<div style="float:left;width:130px;">Boss: </div>

<div style="float:left;">

<input type="checkbox" name="boss" id="boss" onchange="if(this.checked) document.getElementById('boss2').style.display='block'; else document.getElementById('boss2').style.display='none';" <?php if ($_POST['boss'] == 'on') echo "checked"; ?>/><br />

<?php if ($_POST['boss'] == 'on') {?>

	<div id="boss2" style="display:block;">

	<?php }else{ ?>

	<div id="boss2" style="display:none;">

	<?php } ?>

<?php

		$result2 = mysql_query("SELECT * FROM mobs_desc");

			$row2 = mysql_fetch_array($result2);

			?>

			<select name="boss2"> 

    

	<?php do { ?>

	<option value="<?php echo $row2['id']; ?>" <?php if ($_POST['boss2'] == $row2['id']) echo "selected"; ?>><?php echo $row2['name']; ?></option>

    <?php } while ($row2 = mysql_fetch_assoc($result2)); ?>

    </select>

			<br />

			

</div>

</div>

<br /><br />

</form>

	<?php

	}else{

		if (!empty($_POST['brutality']))

			$brutality = $_POST['brutality'];

		else $brutality = 0;

		if (!empty($_POST['accuracy']))

			$accuracy = $_POST['accuracy'];

		else $accuracy = 0;

		if (!empty($_POST['fortitude']))

			$fortitude = $_POST['fortitude'];

		else $fortitude = 0;

		if (!empty($_POST['attack']))

			$attack = $_POST['attack'];

		else $attack = 0;

		if (!empty($_POST['defense']))

			$defense = $_POST['defense'];

		else $defense = 0;

		if (!empty($_POST['health']))

			$health = $_POST['health'];

		else $health = 0;

		if (!empty($_POST['regen']))

			$regen = $_POST['regen'];

		else $regen = 0;

		if (!empty($_POST['duration']))

			$duration = $_POST['duration'];

		else $duration = 0;

		if ($_POST['crafted'] == 1){

		$crafted = "";

		sort($_POST['items_crafted']);

		foreach ($_POST['items_crafted'] as $val)

		{	

			$q = $_POST['details'.$val];

			$crafted .=$val.";".$q.",";

			

		}

		$crafted = substr_replace($crafted,"",-1);

		}

		if ($_POST['weapon'] != 0){

		$damage= $_POST['damage1']."-".$_POST['damage2']."-".$_POST['w_type'];

		}

			$result = mysql_query("SELECT * FROM items_categ WHERE name='hands'");

			$row = mysql_fetch_array($result);

		if ($_POST['weapon'] == 2)

			$slot = '6';

		elseif ($_POST['weapon'] == $row['id_item'])

			$slot = $row['id_item'];

		elseif ($_POST['armour'] == 'on')

			$slot = $_POST['armour2'];

		elseif ($_POST['boss'] == 'on')

			$slot = '8';

		else

			$slot = '7';

		if ($slot =='8'){

			if (!empty($_POST['boss2']))

				$id_boss = $_POST['boss2'];

			else

				$id_boss = 0;

		}else{

			$id_boss = 0;

		}		

			

		if (!empty ($_POST['price']))

			$price = $_POST['price'];

		else $price = 0;

		$name = addslashes($_POST['name']);

		mysql_query("INSERT INTO loot (value, item) VALUES ('$_POST[loot]', '$_POST[id]')");

		mysql_query("INSERT INTO items_inventory (id_item, name, brutality, accuracy, fortitude, attack, defense, health, regen, duration, repeating, wearoff, craft, craft_items, weapon, weapon_items, slot, price, level, loot, id_mob) VALUES

					('$_POST[id]', '$name', '$brutality', '$accuracy', '$fortitude', '$attack', '$defense', '$health', '$regen', '$duration', '$_POST[repeating]', '$_POST[wearoff]', '$_POST[crafted]', '$crafted', '$_POST[weapon]', '$damage', '$slot', '$price', '$_POST[level]', '$_POST[loot]', '$id_boss')");

		header ("Location:item.php");

		//print_r($_POST);

		

	}

	}

}

ob_end_flush();

?>

</body>

</html>

<?php

}

?>