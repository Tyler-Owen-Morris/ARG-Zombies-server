<?php
	include ("db_connect.php");
	//print_r($_POST);
	$user = $_POST['user_id'];
	$number = $_POST['number'];
	mysql_query("DELETE FROM items_on WHERE id_user='$user'");
	/*$res_check=mysql_query("SELECT * FROM items_on WHERE id_user='$user' AND add_time <> 0");
	while($row_check=mysql_fetch_array($res_check)){
	if(time()-$row_check['add_time']>60*60)$res_del=mysql_query("DELETE FROM items_on WHERE id = {$row_check['id']}");
	}*///epic fail :P
	for($i=0;$i<$number;$i++){
		$item = $_POST[$i.'_item_id'];
		$quantity = $_POST[$i.'_quantity'];
		$active = $_POST[$i.'_active'];
		$add_time=$_POST[$i.'_add_time'];
		//if($add_time==0)$time=0;
		//else $time=time();
		
		//if($time!=0){
		//$res_check=mysql_query("SELECT * FROM items_on WHERE id_user = $user AND id_item = $item");
		//$row_check=mysql_fetch_array($res_check);
		//if(time()-$row_check['add_time']>60*60)$res_del=mysql_query("DELETE FROM items_on WHERE id_user = $user AND id_item = $item");
		//}
		//else 
		mysql_query("INSERT INTO items_on (id_user, id_item, quantity, active, add_time) VALUES ('$user', '$item', '$quantity', '$active', '$add_time')");
		
	}
		
			//mysql_query("DELETE FROM items_on WHERE quantity='0' AND id_user='$user'");
		
	echo "done";
	
?>