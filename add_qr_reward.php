<?php



include ("db_connect.php");

function genRandomString() {

$length=20;

$characters="0123456789AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwZxYyZz";

//$real_string_length=strlen($characters)–1;

$string="";



for ($p = 0; $p < $length; $p++) {

$string .= $characters[mt_rand(0, 62)];  //$real_string_length

}

return $string;

}



if($_POST['user_code'] != "" && $_POST['xp_reward'] != ""  && $_POST['cash_reward'] != ""  && $_POST['item_reward'] != "" && $_POST['miss_reward'] != "default" && $_POST['mon_reward'] != "default"  && $_POST['h'] != "" && $_POST['m'] != "" && $_POST['s'] != "" )

//date complete



{



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



$gata=0;

while(!$gata){

$rand_string=genRandomString();

$res_check_rand=mysql_query("SELECT * FROM qr_reward WHERE sn = '{$rand_string}'");

if(mysql_num_rows($res_check_rand)==0)$gata=1;

}

$cooldown=intval($_POST['h'])*3600+intval($_POST['m'])*60+intval($_POST['s']);

if(isset($_POST['user_code']))if($_POST['user_code']!="")$rand_string=$_POST['user_code'];

$res_insert=mysql_query("INSERT INTO qr_reward (`sn`,`xp`,`mission`,`monster`,`item`,`cash`,`cooldown`) VALUES ('{$rand_string}',{$xp_reward},{$miss_reward},{$mon_reward},{$item_reward},{$cash_reward},'{$cooldown}')") or die(mysql_error());







echo "Generated string: ".$rand_string."<br>";

echo "Generated QR code: ";include("gen_qr.php");

echo "<br>";

}

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





<font><b>Add QR reward</b></font><br><br>

<form action="add_qr_reward.php" method="POST">

Code:<input name="user_code" value = <?php echo $_POST['user_code']?> ><sup><font color="red">*</font></sup>

<?php

if($_POST['validare'] && $_POST['user_code'] == "") echo "<sup><font color='red'>Campul este obligatoriu</font></sup>";

?>

<br><br>



XP:<input name="xp_reward" value = <?php echo $_POST['xp_reward']?>><sup><font color="red">*</font></sup>

<?php

if($_POST['validare'] && $_POST['xp_reward'] == "") echo "<sup><font color='red'>Campul este obligatoriu</font></sup>";



?>



<br><br>

Mission:<select name="miss_reward">

<option value="default">choose mission</option>

<?php

$res_monster=mysql_query("SELECT * FROM missions");

while($row_monster=mysql_fetch_array($res_monster)){
	if($row_monster['id'] == $_POST['miss_reward']) $selected = "SELECTED";

	 else $selected = "";

//echo "<option value = '{$row_monster['id']}'>{$row_monster['name']} </option>";

echo "<option value=\"{$row_monster['id']}\" $selected>{$row_monster['name']}</option>";

}

?>

</select>

<?php

if($_POST['validare'] && $_POST['miss_reward'] == "default") echo "<sup><font color='red'>Trebuie sa alegeti o optiune</font></sup>";



?>



<br><br>

Monster:<select name="mon_reward">

<option value="default">choose monster</option>

<?php

$res_monster=mysql_query("SELECT * FROM mobs_desc");

while($row_monster=mysql_fetch_array($res_monster)) {

	if($row_monster['id'] == $_POST['mon_reward']) $selected = "SELECTED";

	 else $selected = "";

	echo "<option value=\"{$row_monster['id']}\" $selected >{$row_monster['name']}</option>";

}

?>

</select>

<?php

if($_POST['validare'] && $_POST['mon_reward'] == "default") echo "<sup><font color='red'>Trebuie sa alegeti o optiune</font></sup>";



?>

<br><br>

Cash:<input name="cash_reward" value = <?php echo $_POST['cash_reward']?>><sup><font color="red">*</font></sup>

<?php

if($_POST['validare'] && $_POST['cash_reward'] == "") echo "<sup><font color='red'>Campul este obligatoriu</font></sup>";

?>

<br><br>

Item:<input name="item_reward" value = <?php echo $_POST['item_reward']?>><sup><font color="red">*</font></sup>

<?php

if($_POST['validare'] && $_POST['item_reward'] == "") echo "<sup><font color='red'>Campul este obligatoriu</font></sup>";

?>

<br><br>

Cooldown:<input style="width:40px;" name="h" value = <?php echo $_POST['h']?>>h&nbsp;<input style="width:40px;" name="m" value = <?php echo $_POST['m']?>>m&nbsp;<input style="width:40px;" name="s" value = <?php echo $_POST['s']?>>s<sup><font color="red">*</font></sup>&nbsp;

<?php

if($_POST['validare'] && ($_POST['h'] == "" || $_POST['m'] == "" || $_POST['s'] == "")) echo "<sup><font color='red'>Campul este obligatoriu</font></sup>";

?>

<br><br>

<input name="validare" type="hidden" value="1">

<sup><font color="red">Campurile marcate cu * sunt obligatorii</font></sup><br><br>

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

<input type="submit" value="Add reward">



</form>