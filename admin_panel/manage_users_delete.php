<?php session_start();

if(!isset($_SESSION['super_user']))header('Location:login.php');

include("db_connect.php");

if(isset($_POST['user_id'])){

$res_del=mysql_query("DELETE FROM admin_user WHERE id = {$_POST['user_id']}") or die(mysql_error());

header('Location:manage_users.php');

}

?>