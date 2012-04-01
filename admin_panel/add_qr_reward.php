<?php session_start();

if(!isset($_SESSION['user']))header('Location:login.php');

include ("db_connect.php");

include("functions.php");

if(!isset($_SESSION['super_user']))$sections=get_access($_SESSION['id']);

else $sections=array(1,2,3,4,5,6,7);

if(!in_array(7,$sections)){

echo "<br><br>You do not have access here!";

}

else{

//page content here



?>

<body style="background-color:#ababab;">

<a href="logout.php">Logout</a><br><br>

<?php

include("menu.php");

?>

<br><br>

<?php



function genRandomString() {

$length=20;

$characters="0123456789AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwZxYyZz";

//$real_string_length=strlen($characters)–1;

$string="";



for ($p = 0; $p < $length; $p++) {

$string .= $characters[mt_rand(0, 62/*$real_string_length*/)];

}

return $string;

}







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



?>





<script src="js/jquery-1.7.1.min.js"></script>

	



<font><b>Add QR reward</b></font><br><br>

<form action="add_qr_reward.php" method="POST">

Code:<input name="user_code"><br><br>

XP:<input name="xp_reward"><br><br>

Mission:<select name="miss_reward">

<option value="default">choose mission</option>

<?php

$res_monster=mysql_query("SELECT * FROM missions");

while($row_monster=mysql_fetch_array($res_monster))

echo "<option value=\"{$row_monster['id']}\">{$row_monster['name']}</option>";

?>

</select><br><br>

Monster:<select name="mon_reward">

<option value="default">choose monster</option>

<?php

$res_monster=mysql_query("SELECT * FROM mobs_desc");

while($row_monster=mysql_fetch_array($res_monster))

echo "<option value=\"{$row_monster['id']}\">{$row_monster['name']}</option>";

?>

</select><br><br>

Cash:<input name="cash_reward"><br><br>

Item:<input name="item_reward"><br><br>

Cooldown:<input style="width:40px;" name="h">h&nbsp;<input style="width:40px;" name="m">m&nbsp;<input style="width:40px;" name="s">s&nbsp;<br><br>

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



</body>



<?php

}

?>