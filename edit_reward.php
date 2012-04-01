<?php

include ("db_connect.php");



//inserare reward

if(isset($_POST['xp_reward'])){

if($_POST['xp_reward']!="")$xp_reward=$_POST['xp_reward'];

else $xp_reward=0;

if($_POST['miss_reward']!="default")$miss_reward=$_POST['miss_reward'];

else $miss_reward=0;

if($_POST['mon_reward']!="default")$mon_reward=$_POST['mon_reward'];

else $mon_reward=0;

if($_POST['cash_reward']!="")$cash_reward=$_POST['cash_reward'];

else $cash_reward=0;

if($_POST['item_reward']!="")$item_reward=$_POST['item_reward'];

else $item_reward=0;



$cooldown=intval($_POST['h'])*3600+intval($_POST['m'])*60+intval($_POST['s']);

$res_insert=mysql_query("UPDATE qr_reward SET `xp` = {$xp_reward},`mission` = {$miss_reward},`monster` = {$mon_reward},`item` = {$item_reward},`cash` = {$cash_reward}, `cooldown` = '{$cooldown}' WHERE id = {$_POST['care_rew']}") or die(mysql_error());





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

	

<?php

$res_edit=mysql_query("SELECT * FROM qr_reward WHERE id = {$_POST['care_rew']}");

$row_edit=mysql_fetch_array($res_edit);

$rand_string=$row_edit['sn'];

echo "Generated string: ".$rand_string."<br>";

echo "Generated QR code: ";include("gen_qr.php");

echo "<br>";

?>

<font><b>Edit QR reward</b></font><br><br>



<form action="edit_reward.php" method="POST">

<input type="hidden" name="care_rew" value="<?php echo $_POST['care_rew']; ?>">

XP:<input name="xp_reward" value="<?php echo $row_edit['xp']; ?>"><br><br>

Mission:<select name="miss_reward">

<option value="default">choose mission</option>

<?php

$res_monster=mysql_query("SELECT * FROM missions");

while($row_monster=mysql_fetch_array($res_monster))

{echo "<option ";

if($row_monster['id']==$row_edit['mission'])echo "SELECTED";

echo " value=\"{$row_monster['id']}\">{$row_monster['name']}</option>";}

?>

</select><br><br>

Monster:<select name="mon_reward">

<option value="default">choose monster</option>

<?php

$res_monster=mysql_query("SELECT * FROM mobs_desc");

while($row_monster=mysql_fetch_array($res_monster))

{echo "<option ";

if($row_monster['id']==$row_edit['monster'])echo "SELECTED";

echo " value=\"{$row_monster['id']}\">{$row_monster['name']}</option>";}

?>

</select><br><br>

Cash:<input name="cash_reward" value="<?php echo $row_edit['cash']; ?>"><br><br>

Item:<input name="item_reward" value="<?php echo $row_edit['item']; ?>"><br><br>

<?php

$cooldown=intval($row_edit['cooldown']);

$h=floor($cooldown/3600);

$m=floor(($cooldown-$h*3600)/60);

$s=$cooldown-$h*3600-$m*60;

?>

Cooldown:<input style="width:40px;" name="h" value="<?php echo $h; ?>">h&nbsp;<input style="width:40px;" name="m" value="<?php echo $m; ?>">m&nbsp;<input style="width:40px;" name="s" value="<?php echo $s; ?>">s&nbsp;<br><br>

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

<input type="submit" value="Save reward">



</form>