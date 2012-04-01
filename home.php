<?php 

ob_start();

session_start();

include "db_connect.php";

?>



<html>

<head><link rel="stylesheet" href="style.css"></head>



<div class="divider">



<?php

if($_SESSION['id'])

{

$id = $_SESSION['id'];

if (!isset($_GET['user'])){

echo "<strong>Welcome ",$_SESSION['username'],"</strong><br />";

$result = mysql_query("SELECT * FROM users");

while ($row = mysql_fetch_array($result)){

	echo "<br /><a href=\"".$_SERVER['PHP_SELF']."?user=".$row['id']."\"  style='text-decoration:none;'><b><font color='red'>".$row['nick']."</font></a>";



}

}else{

	echo "Update ";

	$result = mysql_query("SELECT * FROM users WHERE id='$_GET[user]'");

	$row = mysql_fetch_array($result);

	echo "<b>".$row['nick']."</b>";

	echo "<br /><br />";

	

	$result2 = mysql_query("SELECT * FROM user_desc WHERE id_user='$_GET[user]' ORDER BY id");

	$row2 = mysql_fetch_array($result2);

		

	if (!isset($_POST['submit'])){

		

		//echo $_GET['user'];

		?>

			<form method="POST" action=''>

				<div class="formElm">

					<label>brutality</label>

					<input type="text" name="brutality" size="15" value="<?php echo $row2['brutality']; ?>">

				</div>

				

				<div class="formElm">

					<label>accuracy</label>

					<input type="text" name="accuracy" size="15" value="<?php echo $row2['accuracy']; ?>">

				</div>

				

				<div class="formElm">

					<label>energy</label>

					<input type="text" name="energy" size="15" value="<?php echo $row2['energy']; ?>">

				</div>

				

				<div class="formElm">

					<label>defense</label>

					<input type="text" name="defense" size="15" value="<?php echo $row2['defense']; ?>">

				</div>

				

				<div class="formElm">

					<label>fortitude</label>

					<input type="text" name="fortitude" size="15" value="<?php echo $row2['fortitude']; ?>">

				</div>

				

				<div class="formElm">

					<label>hp</label>

					<input type="text" name="hp" size="15" value="<?php echo $row2['hp']; ?>">

				</div>

				

				<div class="formElm">

					<label>evasion</label>

					<input type="text" name="evasion" size="15" value="<?php echo $row2['evasion']; ?>">

				</div>

				

				<div class="formElm">

					<label>attack</label>

					<input type="text" name="attack" size="15" value="<?php echo $row2['attack']; ?>">

				</div>

				

				<div class="formElm">

					<label>experience</label>

					<input type="text" name="experience" size="15" value="<?php echo $row2['experience']; ?>">

				</div>

				

				<div class="formElm">

					<label>level</label>

					<input type="text" name="level" size="15" value="<?php echo $row2['level']; ?>">

				</div>

				

				<div class="formElm">

					<label>regen</label>

					<input type="text" name="regen" size="15" value="<?php echo $row2['regen']; ?>">

				</div>

				<br />

				<input type="submit" name="submit" value="Update">

				<a href='home.php'>Leave</a>

			</form>

		<?php

	}elseif (!is_numeric($_POST['brutality']) || !is_numeric($_POST['accuracy']) || !is_numeric($_POST['energy']) || !is_numeric($_POST['defense']) || !is_numeric($_POST['fortitude']) || 

			!is_numeric($_POST['hp']) || !is_numeric($_POST['evasion']) || !is_numeric($_POST['attack']) || !is_numeric($_POST['experience']) || !is_numeric($_POST['level']) || !is_numeric($_POST['regen'])){

			?>

			

			<form method="POST" action=''>

			

				<div class="formElm">

					<label>brutality</label>

					<input type="text" name="brutality" size="15" value="<?php echo $_POST['brutality']; ?>">

					<?php

						if (!is_numeric($_POST['brutality']))

						echo "<br /><font color='red'>This is not a number</font>";

					?>

				</div>

				

				<div class="formElm">

					<label>accuracy</label>

					<input type="text" name="accuracy" size="15" value="<?php echo $_POST['accuracy']; ?>">

					<?php

						if (!is_numeric($_POST['accuracy']))

						echo "<br /><font color='red'>This is not a number</font>";

					?>

				</div>

				

				<div class="formElm">

					<label>energy</label>

					<input type="text" name="energy" size="15" value="<?php echo $_POST['energy']; ?>">

					<?php

						if (!is_numeric($_POST['energy']))

						echo "<br /><font color='red'>This is not a number</font>";

					?>

				</div>

				

				<div class="formElm">

					<label>defense</label>

					<input type="text" name="defense" size="15" value="<?php echo $_POST['defense']; ?>">

					<?php

						if (!is_numeric($_POST['defense']))

						echo "<br /><font color='red'>This is not a number</font>";

					?>

				</div>

				

				<div class="formElm">

					<label>fortitude</label>

					<input type="text" name="fortitude" size="15" value="<?php echo $_POST['fortitude']; ?>">

					<?php

						if (!is_numeric($_POST['fortitude']))

						echo "<br /><font color='red'>This is not a number</font>";

					?>

				</div>

				

				<div class="formElm">

					<label>hp</label>

					<input type="text" name="hp" size="15" value="<?php echo $_POST['hp']; ?>">

					<?php

						if (!is_numeric($_POST['hp']))

						echo "<br /><font color='red'>This is not a number</font>";

					?>

				</div>

				

				<div class="formElm">

					<label>evasion</label>

					<input type="text" name="evasion" size="15" value="<?php echo $_POST['evasion']; ?>">

					<?php

						if (!is_numeric($_POST['evasion']))

						echo "<br /><font color='red'>This is not a number</font>";

					?>

				</div>

				

				<div class="formElm">

					<label>attack</label>

					<input type="text" name="attack" size="15" value="<?php echo $_POST['attack']; ?>">

					<?php

						if (!is_numeric($_POST['attack']))

						echo "<br /><font color='red'>This is not a number</font>";

					?>

				</div>

				

				<div class="formElm">

					<label>experience</label>

					<input type="text" name="experience" size="15" value="<?php echo $_POST['experience']; ?>">

					<?php

						if (!is_numeric($_POST['experience']))

						echo "<br /><font color='red'>This is not a number</font>";

					?>

				</div>

				

				<div class="formElm">

					<label>level</label>

					<input type="text" name="level" size="15" value="<?php echo $_POST['level']; ?>">

					<?php

						if (!is_numeric($_POST['level']))

						echo "<br /><font color='red'>This is not a number</font>";

					?>

				</div>

				

				<div class="formElm">

					<label>regen</label>

					<input type="text" name="regen" size="15" value="<?php echo $_POST['regen']; ?>">

					<?php

						if (!is_numeric($_POST['regen']))

						echo "<br /><font color='red'>This is not a number</font>";

					?>

				</div>

				<br />

				<input type="submit" name="submit" value="Update">

			</form>

			

			<?php

	}else{

	

		$brutality = round($_POST['brutality'], 2);

		$accuracy = round($_POST['accuracy'], 2);

		$energy = round($_POST['energy'], 2);

		$defense = round($_POST['defense'], 2);

		$fortitude = round($_POST['fortitude'], 2);

		$hp = round($_POST['hp'], 2);

		$evasion = round($_POST['evasion'], 2);

		$attack = round($_POST['attack'], 2);

		$level = round($_POST['level'], 2);

		$experience = round($_POST['experience'], 2);

		$regen = round($_POST['regen'], 2);

				

	

		mysql_query("UPDATE user_desc SET brutality='$brutality', accuracy='$accuracy', energy='$energy', defense='$defense', fortitude='$fortitude', hp='$hp', evasion='$evasion', attack='$attack', 

					level='$level', experience='$experience', regen='$regen' WHERE id_user='$_GET[user]'");

		header("Location:home.php");

	}

}

}

else

{

echo "You don't belong here!";

}

ob_end_flush();

?>

</div>

</html>