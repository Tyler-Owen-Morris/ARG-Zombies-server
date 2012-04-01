<?php

session_start();

?>

<html>

<head><link rel="stylesheet" href="style.css"></head>

<?php

include "db_connect.php";

if (isset($_GET['id'])){

$sql="SELECT * from `users` WHERE `id`='".$_GET['id']."'";

$res=mysql_query($sql) or die(mysql_error());



if(mysql_num_rows($res) != 1)

{

echo "<script language=\"Javascript\" type=\"text/javascript\">

	alert(\"This user does not exist\")

	document.location.href='index.php'</script>";

}

else

{

	$row=mysql_fetch_assoc($res);



	?>

<div class="divider">



	<?php echo $row['first']. " " .$row['last'] ?> <br/>

	<?php echo $row['email'] ?> <br/>

	<?php echo $row['about'] ?> <br/>

   

<?php

}

}

if (isset($_GET['home'])){

$id=$_GET['home'];

$x=rand(1,100);

$y=rand(1,100);

$z=rand(1,100);

?>

<div class="divider">

<?php

echo $x;

echo "<br />";

echo $y;

echo "<br />";

echo $z;

$sql="SELECT * FROM home WHERE id_user = '$id'";

$result = mysql_query($sql) or die ($sql);

if (mysql_num_rows($result) > 0){

mysql_query("UPDATE home SET latitude='$x', longitude='$y', money='$z' WHERE id_user='$id'");

}else{

mysql_query("INSERT INTO home (id_user, latitude, longitude, money) VALUES ('$id', '$x', '$y', '$z')");

}

}

?>

<br />

<a href='home.php'>Home</a>

</div>

<?php

?>

</html>

