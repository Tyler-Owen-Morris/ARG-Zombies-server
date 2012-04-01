<?php

include ("db_connect.php");

?>

<?php

if(isset($_POST['mission_edit'])){

$res_edit=mysql_query("SELECT * FROM missions WHERE id = {$_POST['mission_edit']}");

$row_edit=mysql_fetch_array($res_edit);

}

if(isset($_POST['name'])&&!isset($_POST['mission_details'])){

$prereq="";

if(isset($_POST['prereq']))

for($i=0;$i<count($_POST['prereq']);$i++)

$prereq.=$_POST['prereq'][$i].";";



$result=mysql_query("INSERT INTO missions (`name`,`obiectiv`,`cantitate`,`level`,`prereq`,`mission_cost`,`special_mission`,`reward`,`reward_cantitate`) VALUES ('{$_POST['name']}','{$_POST['obj']}',{$_POST['cant']},{$_POST['level']},'{$prereq}',".intval($_POST['reward_type']).",".intval($_POST['mission_cost']).",{$_POST['special_mission']},{$_POST['reward_cant']})") or die(mysql_error());

echo "<i>Mission added</i><br><br>";

}

if(isset($_POST['mission_details'])){

$prereq="";

if(isset($_POST['prereq']))

for($i=0;$i<count($_POST['prereq']);$i++)

$prereq.=$_POST['prereq'][$i].";";



$result=mysql_query("UPDATE missions SET `name` = '{$_POST['name']}', `obiectiv` = '{$_POST['obj']}', `cantitate` = {$_POST['cant']}, `level` = {$_POST['level']}, `prereq` = '{$prereq}', `mission_cost` = ".intval($_POST['mission_cost']).", `special_mission` = {$_POST['special_mission']}, `reward` = ".intval($_POST['reward_type']).", `reward_cantitate` = {$_POST['reward_cant']} WHERE id = {$_POST['mission_details']}");

echo "<i>Mission edited</i><br><br>";

}

if(isset($_POST['mission_delete'])){

$result=mysql_query("DELETE FROM missions WHERE id = {$_POST['mission_delete']}");

$result=mysql_query("DELETE FROM mission_player WHERE mission_id = {$_POST['mission_delete']}");

echo "<i>Mission deleted</i><br><br>";

}





?>



<script language="javascript" type="text/javascript" src="js/string.js"></script>

<script language="javascript" type="text/javascript" src="js/calendar.externals.js"></script>

<script language="javascript" type="text/javascript" src="js/calendar.langs.js"></script>

<script language="javascript" type="text/javascript" src="js/calendar.js"></script>

<link type="text/css" href="css/jquery-ui-1.8.9.custom.css" rel="stylesheet" />

<script type="text/javascript" src="js/jquery/jquery.min.js"></script>

	

	<link href="js/jquery/jquery-ui.css" rel="stylesheet" type="text/css"/> <!--calendar prezenta-->

	<script src="js/jquery/jquery.min.js"></script> <!--calendar prezenta-->

	<script src="js/jquery/jquery-ui.min.js"></script> <!--calendar prezenta-->



<b><?php if(isset($_POST['mission_edit']))echo "Edit";else echo "Add"; ?> mission</b>

<?php

if(isset($_POST['mission_edit']))

echo "<form action=\"missions.php\" method=\"POST\">

      <input type=\"hidden\" name=\"mission_delete\" value=\"{$row_edit['id']}\">

	  <input onclick=\"return confirm('Are you sure?')\" type=\"submit\" value=\"DELETE MISSION\">

	  </form>";

?>

<br><br>



<form action="missions.php" method="POST">

<?php

if(isset($_POST['mission_edit']))echo "<input type=\"hidden\" name=\"mission_details\" value=\"{$row_edit['id']}\">";

?>

Name:<input name="name" value="<?php if(isset($row_edit))echo $row_edit['name']; ?>"><br><br>

Objective:<textarea name="obj"><?php if(isset($row_edit))echo $row_edit['obiectiv']; ?></textarea><br><br>

Quantity:<input name="cant" value="<?php if(isset($row_edit))echo $row_edit['cantitate']; ?>"><br><br>

Level:<input name="level" value="<?php if(isset($row_edit))echo $row_edit['level']; ?>"><br><br>



Prerequisites:<br>

<?php

$res_prereq=mysql_query("SELECT * FROM missions");

$contor=0;

while($row_prereq=mysql_fetch_array($res_prereq)){

$contor++;

echo "<input type=\"checkbox\" name=prereq[] value=\"{$row_prereq['id']}\">&nbsp;{$row_prereq['name']}&nbsp;";

if($contor==5){$contor=0;echo "<br>";};

}

?>

<br><br>



Mission Cost:

<input name="mission_cost" value="<?php if(isset($row_edit))echo $row_edit['mission_cost']; ?>">

<br><br>



Special mission:

<input name="special_mission" type="radio" value="1" <?php if(isset($row_edit))if($row_edit['special_mission']==1)echo "CHECKED"; ?>>Yes

<input name="special_mission" type="radio" value="0" <?php if(!isset($row_edit))echo "CHECKED";else if($row_edit['special_mission']==0)echo "CHECKED"; ?>>No

<br><br>



Reward type:

<select name="reward_type">

<option value="0">reward</option>

<option value="1" <?php if(isset($row_edit))if($row_edit['reward']==1)echo "SELECTED"; ?> >XP</option>

<option value="2" <?php if(isset($row_edit))if($row_edit['reward']==2)echo "SELECTED"; ?> >Cash</option>

<option value="3" <?php if(isset($row_edit))if($row_edit['reward']==3)echo "SELECTED"; ?> >Loot</option>

</select>

<br><br>

Reward quantity:<input name="reward_cant" value="<?php if(isset($row_edit))echo $row_edit['reward_cantitate']; ?>"><br><br>

<script>

$(function(){

  $('#loot_font').click(function(){

     if($('#sublink').css('display')=="none")$('#sublink').css('display','block');

	 else $('#sublink').css('display','none');

   });

});

</script>

<font id="loot_font" style="color:blue;cursor:pointer;text-decoration:underline;">Loot pack</font>

<div id="sublink" style="display:none;width:130px;">

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



<br><br>

<input type="submit" value="Save">



<?php

if(isset($_POST['mission_edit']))echo "<input onclick=\"window.location.href='missions.php'\" type=\"button\" value=\"Abort\">";

?>



</form>

<br><br>





<b>Select mission to edit</b>



<form action="missions.php" method="POST">

<select name="mission_edit">

<option value="default">choose mission</option>

<?php

$result=mysql_query("SELECT * FROM missions");

if(mysql_num_rows($result)>0)

while($row=mysql_fetch_array($result))

echo "<option value=\"{$row['id']}\">{$row['name']}</option>";





?>

</select>

<input type="submit" value="Edit">

</form>

