<?php

include ("db_connect.php");

if(isset($_POST['care_rew'])){

$res_del=mysql_query("DELETE FROM qr_reward WHERE id = {$_POST['care_rew']}");

}

header('Location: view_qr_rewards.php');

?>