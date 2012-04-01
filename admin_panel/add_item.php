<?php

include ("db_connect.php");







if(isset($_POST['add_item'])){


	$error_message = "";



    if(!is_numeric($_POST['quantity']))

    	 $error_message .=  "<font color = red><b>Item not changed, quantity field must be a number!</b></font><BR>";





	$sql = "SELECT * FROM items_on WHERE id_user = '".$_POST['user_id']."' AND active = '1'";

	$result = mysql_query($sql) or die(mysql_error());

   	$num_items_on = mysql_num_rows($result);



	$sql = "SELECT * FROM items_home WHERE id_user = '".$_POST['user_id']."' AND active = '1'";

	$result = mysql_query($sql) or die(mysql_error());

   	$num_items_home = mysql_num_rows($result);



   	$sql = "SELECT slot FROM items_inventory WHERE id_item = '".$_POST['id_item']."'";

	$result = mysql_query($sql) or die(mysql_error());

   	$row = mysql_fetch_array($result);

   	if($row['slot'] != 7 && $_POST['quantity'] !=1)

   		$error_message .= "<font color = red><b>Item not changed, quantity field must be equal to 1 for slot not equal 7 !</b></font><BR>";







    if($error_message == ""){



		if($_POST['item_type'] == "on"){



			$sql = "SELECT io.id, io.quantity

						FROM items_on io

						LEFT JOIN items_inventory ii ON ii.id_item = io.id_item

			 WHERE io.id_user = '".$_POST['user_id']."' AND io.id_item = '".$_POST['id_item']."' AND ii.slot = '7'";

			$result = mysql_query($sql) or die(mysql_error());

			$row = mysql_fetch_array($result);

			$num_result = mysql_num_rows($result);

			if ($num_result > 0){ // daca exista item adaugat pentru userul curent



					$new_quantity = $_POST['quantity'] + $row['quantity'];

					$sql = "UPDATE items_on SET quantity = '".$new_quantity."' WHERE id = ".$row['id'] ;

					$res_insert = mysql_query($sql) or die(mysql_error());

					echo "<BR><i><font color = 'green'>The item's quantity was updated</font></i>";





				}

				else{
					if($num_items_on >= 15){
						echo "<font color = red><b>The user has already 15 items. Item not added</b></font><BR>";
						}

						else{

							$sql = "INSERT INTO items_on (`id` ,`id_user` ,`id_item` ,`quantity` ,`active` ,`add_time`) VALUES (NULL , '".$_POST['user_id']."', '".$_POST['id_item']."', '".$_POST['quantity']."', '0', '0')";

							$res_insert = mysql_query($sql) or die(mysql_error());

							echo "<BR><i><font color = 'green'>The item was added</font></i>";

						}

					}

			}

		if($_POST['item_type'] == "home"){



			$sql = "SELECT ih.id, ih.quantity

				FROM items_home ih

				LEFT JOIN items_inventory ii ON ii.id_item = ih.id_item

			 WHERE ih.id_user = '".$_POST['user_id']."' AND ih.id_item = '".$_POST['id_item']."' AND ii.slot = '7'";

			$result = mysql_query($sql);

			$row = mysql_fetch_array($result);

			$num_result = mysql_num_rows($result);

			if ($num_result > 0){ // daca exista item adaugat pentru userul curent



					$new_quantity = $_POST['quantity'] + $row['quantity'];

					$sql = "UPDATE items_home SET quantity = '".$new_quantity."' WHERE id = ".$row['id'] ;

					$res_insert = mysql_query($sql) or die(mysql_error());

					echo "<BR><i><font color = 'green'>The item's quantity was updated</font></i>";





				}

				else{

					if($num_items_home >= 15){

						echo "<font color = red><b>The user has already 15 items. Item not added</b></font><BR>";

						}

						else{

							$sql = "INSERT INTO items_home (`id` ,`id_user` ,`id_item` ,`quantity` ,`active`) VALUES (NULL , '".$_POST['user_id']."', '".$_POST['id_item']."', '".$_POST['quantity']."', '0')";

							$res_insert = mysql_query($sql) or die(mysql_error());

							echo "<BR><i><font color = 'green'>The item was added</font></i>";

						}

					}

			}









	}

	else echo $error_message;

}











?>







<form action="add_item.php" method="POST">

Please select a user:



<select name="user_id">

 <?php

   	$res_user = mysql_query("SELECT id, username FROM users ORDER BY id ASC") or die(mysql_error());

    while($row_user = mysql_fetch_array($res_user)){


        if(isset($_POST['user_id'])){
        	if($row_user['id'] == $_POST['user_id']) $selected = "SELECTED";
        	}
		echo "<option $selected value=".$row_user['id'].">".$row_user['id']." ".$row_user['username']."</option>";

		$selected = "";
    }

?>





</select>



<input type="hidden" name="select_user" value = "1">

<input type="submit" value="Select">

</form>



<?php

if(isset($_POST['user_id'])){


   	$res_user = mysql_query("SELECT username FROM users where id = ".$_POST['user_id']) or die(mysql_error());

    $row_user = mysql_fetch_array($res_user);



	echo "<BR><BR><BR><font color = 'red'>Selected user: <b>".$_POST['user_id']." ".$row_user['username']."</b></font>";





	//echo "SELECT ih.id, ii.name, ih.id_item, ih.quantity, ih.active FROM items_home ih LEFT JOIN items_inventory ii on ii.id_item = ih.id_item WHERE ih.id_user = ".$_POST['user_id'];



	echo "<BR><BR><BR><B>Items home's table</B>";

	echo "<table style=\"width: 1200px;margin: 0 auto;clear: right;margin: 10px 0px 40px 0px;\">\n";

		echo "<tr>";

			echo "<th style=\"font-weight: bold; background: #5b7480;width:10%\">ID_item</th>\n";

			echo "<th style=\"font-weight: bold; background: #5b7480;width:10%\">Item's name</th>\n";

			echo "<th style=\"font-weight: bold; background: #5b7480;width:10%\">Quantity</th>\n";

			echo "<th style=\"font-weight: bold; background: #5b7480;width:10%\">equipped</th>\n";

		echo "</tr>";







   	$res_items_home = mysql_query("SELECT ih.id, ii.name, ih.id_item, ih.quantity, ih.active FROM items_home ih LEFT JOIN items_inventory ii on ii.id_item = ih.id_item WHERE ih.id_user = ".$_POST['user_id']." ORDER BY ih.id") or die(mysql_error());



    while($row_items_home = mysql_fetch_array($res_items_home)){
    	if($row_items_home['active'] == 0) $equipped = "OFF";

    	if($row_items_home['active'] == 1) $equipped = "ON";

		echo "<tr>";

		  echo "<td style='background: #eeeeee;width: auto;text-align: center;'>".$row_items_home['id_item']."</td>";

		  echo "<td style='background: #eeeeee;width: auto;text-align: center;'>".$row_items_home['name']."</td>";

		  echo "<td style='background: #eeeeee;width: auto;text-align: center;'>".$row_items_home['quantity']."</td>";

		  echo "<td style='background: #eeeeee;width: auto;text-align: center;'>".$equipped."</td>";



		echo "</tr>";

    }



    echo "</table>\n";



///////////////////////////

///////////////////////////



	echo "<BR><BR><BR><B>Items on's table</B>";

	echo "<table style=\"width: 1200px;margin: 0 auto;clear: right;margin: 10px 0px 40px 0px;\">\n";

		echo "<tr>";

			echo "<th style=\"font-weight: bold; background: #5b7480;width:10%\">ID_item</th>\n";

			echo "<th style=\"font-weight: bold; background: #5b7480;width:10%\">Item's name</th>\n";

			echo "<th style=\"font-weight: bold; background: #5b7480;width:10%\">Quantity</th>\n";

			echo "<th style=\"font-weight: bold; background: #5b7480;width:10%\">equipped</th>\n";

		echo "</tr>";



	$sql = "SELECT io.id, ii.name, io.id_item, io.quantity, io.active FROM items_on io LEFT JOIN items_inventory ii on ii.id_item = io.id_item WHERE io.id_user = ".$_POST['user_id']." ORDER BY io.id";



   	$res_items_on = mysql_query($sql) or die(mysql_error());



    while($row_items_on = mysql_fetch_array($res_items_on)){
    	if($row_items_on['active'] == 0) $equipped = "OFF";

    	if($row_items_on['active'] == 1) $equipped = "ON";



		echo "<tr>";

		  echo "<td style='background: #eeeeee;width: auto;text-align: center;'>".$row_items_on['id_item']."</td>";

		  echo "<td style='background: #eeeeee;width: auto;text-align: center;'>".$row_items_on['name']."</td>";

		  echo "<td style='background: #eeeeee;width: auto;text-align: center;'>".$row_items_on['quantity']."</td>";

		  echo "<td style='background: #eeeeee;width: auto;text-align: center;'>".$equipped."</td>";



		echo "</tr>";

    }



    echo "</table>\n";





	echo "<form name='add_item' action='add_item.php' method='post'>";



 	echo "<table>";

 		echo "<tr>";

 			echo "<td>Item</td>";



    		$sql = "SELECT id_item, name FROM items_inventory ORDER BY id_item ASC";





    		echo "<td>";

    		echo "<select size='1' name='id_item'>";

   			$res_items_inventory = mysql_query($sql) or die(mysql_error());

   			while($row_items_inventory = mysql_fetch_array($res_items_inventory)){

				echo  "<option value=".$row_items_inventory[id_item].">".$row_items_inventory[id_item]." ".$row_items_inventory[name]."</option>";

				}

			echo "</select>";

    		echo "</td>";

 		echo "</tr>";

		echo "<tr>";

 			echo "<td>Quantity</td>";

 			echo "<td><input name='quantity' type='text' value=''></td>";

 		echo "</tr>";

		echo "<tr>";

 			echo "<td>Equipped</td>";

 			echo "<td><input size = '3' type='text' name='active_' value='OFF' readonly='readonly' /></td>";

 		echo "</tr>";

		echo "<tr>";

 			echo "<td>Item type</td>";

			echo "<td><select size='1' name='item_type'>";

				echo "<option value='home'>HOME</option>";

				echo "<option value='on'>ON</option>";

			echo "</select></td>";

 		echo "</tr>";

 	echo "</table>";

 	echo "<input name='add_item' type='hidden' value='1'>";

 	echo "<input name='user_id' type='hidden' value='".$_POST['user_id']."'>";



 	echo "<input type='submit' value='Add Item'>";

	echo "</form>";

}







?>

