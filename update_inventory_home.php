<?php
	include ("db_connect.php");
	//print_r($_POST);
	$user = $_POST['user_id'];
	$number = $_POST['number'];
	mysql_query("DELETE FROM items_home WHERE id_user='$user'");
	for($i=0;$i<$number;$i++){
		$item = $_POST[$i.'_item_id'];
		$quantity = $_POST[$i.'_quantity'];
		$active = $_POST[$i.'_active'];
		
		mysql_query("INSERT INTO items_home (id_user, id_item, quantity, active) VALUES ('$user', '$item', '$quantity', '$active')");

	}
		
			//mysql_query("DELETE FROM items_on WHERE quantity='0' AND id_user='$user'");
		
	echo "done";
	
?>