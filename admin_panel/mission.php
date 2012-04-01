<?php session_start();

if(!isset($_SESSION['user']))header('Location:login.php');

include ("db_connect.php");

include("functions.php");

if(!isset($_SESSION['super_user']))$sections=get_access($_SESSION['id']);

else $sections=array(1,2,3,4,5,6,7);

if(!in_array(5,$sections)){

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

<input type="button" value="Add mission" onclick="window.location.href='missions.php'">

<br><br>



<table style="background-color:black;">

<tr><th style="background-color:#efefef;">Id</th><th style="background-color:#efefef;">Name</th><th style="background-color:#efefef;">Objective</th><th style="background-color:#efefef;">Quantity</th><th style="background-color:#efefef;">Level</th><th style="background-color:#efefef;">Prerequisites</th><th style="background-color:#efefef;">Mission cost</th><th style="background-color:#efefef;">Special mission</th><th style="background-color:#efefef;">Reward</th><th style="background-color:#efefef;">Reward quantity</th></tr>

<?php

$resm=array();

$res_miss=mysql_query("SELECT * FROM missions ORDER BY level ASC, id ASC");

while($row_miss=mysql_fetch_array($res_miss))

$resm[]=$row_miss;



/*$gata=0;

while(!$gata){

$gata=1;

for($i=0;$i<count($resm)-1;$i++)

{

$start=strpos($resm[$i]['name'],"(");

$end=strpos($resm[$i]['name'],")");

$sub1=substr($resm[$i]['name'],$start+1,($end-$start)-1);

$start=strpos($resm[$i+1]['name'],"(");

$end=strpos($resm[$i+1]['name'],")");

$sub2=substr($resm[$i+1]['name'],$start+1,($end-$start)-1);



if($sub2<$sub1){

                $aux=$resm[$i];

				$resm[$i]=$resm[$i+1];

				$resm[$i+1]=$aux;

				$gata=0;

               }

}

}*/



for($i=0;$i<count($resm);$i++){

$row_miss=$resm[$i];

echo "<tr>";

echo "<td style=\"background-color:#efefef;\">{$row_miss['id']}</td>";

echo "<td style=\"background-color:#efefef;\">{$row_miss['name']}</td>";

echo "<td style=\"background-color:#efefef;\">{$row_miss['obiectiv']}</td>";

echo "<td style=\"background-color:#efefef;\">{$row_miss['cantitate']}</td>";

echo "<td style=\"background-color:#efefef;\">{$row_miss['level']}</td>";

echo "<td style=\"background-color:#efefef;\">{$row_miss['prereq']}</td>";

echo "<td style=\"background-color:#efefef;\">{$row_miss['mission_cost']}</td>";

echo "<td style=\"background-color:#efefef;\">{$row_miss['special_mission']}</td>";

echo "<td style=\"background-color:#efefef;\">";

if($row_miss['reward']==0)echo "No reward";

if($row_miss['reward']==1)echo "XP";

if($row_miss['reward']==2)echo "Cash";

if($row_miss['reward']==3)echo "Loot";

echo "</td>";

echo "<td style=\"background-color:#efefef;\">{$row_miss['reward_cantitate']}</td>";

echo "</tr>";

}

?>

</table>





</body>



<?php

}

?>

