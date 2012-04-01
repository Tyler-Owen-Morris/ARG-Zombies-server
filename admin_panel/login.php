<?php session_start();

include("db_connect.php");

include("functions.php");

if(isset($_POST['user'])){

//check if super user

$res_check=mysql_query("SELECT * FROM admin_super WHERE super_user = '{$_POST['user']}' AND super_pass = md5('{$_POST['pass']}')");

if(mysql_num_rows($res_check)>0){

                     $_SESSION['super_user']=true;

					 $_SESSION['user']=true;					 

					 header('Location:index.php');

                                }

else{

     $res_check=mysql_query("SELECT * FROM admin_user WHERE email = '{$_POST['user']}' AND pass = md5('{$_POST['pass']}')");

	 if(mysql_num_rows($res_check)>0){

	                                $row_check=mysql_fetch_array($res_check);

									$_SESSION['user']=$row_check['name'];

									$_SESSION['email']=$row_check['email'];

									$_SESSION['id']=$row_check['id'];

									$_SESSION['active']=$row_check['active'];

									header('Location:index.php');

	                                 }

	else echo "Incorrect login";

    }								

}

?>



<?php

if(isset($_GET['inactive']))echo "Inactive user";

?>



<br><br><br>



<center>

<form action="login.php" method="POST">



<table>

<tr><td>User:</td><td><input name="user"></td></tr>

<tr><td>Pass:</td><td><input name="pass" type="password"></td></tr>

<tr><td><input type="submit" value="Login"></td><td>&nbsp;</td></tr>

</table>



</form>

</center>