<?php

	include ("db_connect.php");

	//print_r($_POST);

	$user = $_POST['user_id'];

	$number = $_POST['number'];

	

	for($i=0;$i<=$number;$i++){

		$item = $_POST[$i.'_item_id'];

		$quantity = $_POST[$i.'_quantity'];

		$active = $_POST[$i.'_active'];

		$result = mysql_query("SELECT * FROM items_on WHERE id_user='$user' AND id_item='$item'");

		$rows = mysql_num_rows($result);

		if ($rows > 0){

			mysql_query("UPDATE items_on SET quantity='$quantity', active='$active' WHERE id_user='$user' AND id_item='$item'");

		}else{

			mysql_query("INSERT INTO items_on (id_user, id_item, quantity, active) VALUES ('$user', '$item', '$quantity', '$active')");

		}

		$result = mysql_query("SELECT * FROM items_on WHERE quantity='0' AND id_user='$user'");

		$rows = mysql_num_rows($result);

		if ($rows > 0){

			mysql_query("DELETE FROM items_on WHERE quantity='0' AND id_user='$user'");

		}

		

	}

		

	echo "done";

	

?>