<?php

	include ("db_connect.php");

	if (isset($_GET['user'])){

		$user = $_GET['user'];

	

	$var = 0;

	

	

	$result = mysql_query("SELECT * FROM items_on WHERE id_user='$user' AND active ='0' AND add_time = 0");

	while ($row = mysql_fetch_array($result)){

	

		$result2 = mysql_query("SELECT * FROM items_home WHERE id_user='$user'");

		$rows2 = mysql_num_rows($result2);

	

		$result2 = mysql_query("SELECT * FROM items_inventory WHERE id_item=$row[id_item]");

		$row2 = mysql_fetch_array($result2);

		if ($row2['slot'] != '7'){

			if ($rows2 < 15){

				//echo "1";

				mysql_query("INSERT INTO items_home (id_user, id_item, quantity) VALUES ('$user', '$row[id_item]', '$row[quantity]')");

				mysql_query("DELETE FROM items_on WHERE id='$row[id]'");

			}else{

				$var = 1;

			}

		}else{

			if ($rows2 < 15){

				$result3 = mysql_query("SELECT * FROM items_home WHERE id_item='$row[id_item]' AND id_user='$user'");

				$rows3 = mysql_num_rows($result3);

				if ($rows3 > 0){

					if ($row['quantity'] == 999){

						//echo "2";

						mysql_query("INSERT INTO items_home (id_user, id_item, quantity) VALUES ('$user', '$row[id_item]', '$row[quantity]')");

						mysql_query("DELETE FROM items_on WHERE id='$row[id]'");

					}else{

						while ($row3 = mysql_fetch_array($result3)){

							$result4 = mysql_query("SELECT * FROM items_home WHERE id_user='$user'");

							$rows4 = mysql_num_rows($result4);

								if ($rows4 < 15){

									$quantity_dif = 999 - $row['quantity'];

									$quantity_total = $row3['quantity'] + $row['quantity'];

									if ($quantity_total > 999){

										//echo "3";

										mysql_query("UPDATE items_home SET quantity='999' WHERE id='$row3[id]'");

										$quantity_rest = $quantity_total - 999;

										mysql_query("UPDATE items_on SET quantity='$quantity_rest' WHERE id='$row[id]'");

										$result4 = mysql_query("SELECT * FROM items_home WHERE id_user='$user'");

										$rows4 = mysql_num_rows($result4);

										if ($rows4 < 15){

											//echo "6";

											mysql_query("INSERT INTO items_home (id_user, id_item, quantity) VALUES ('$user', '$row[id_item]', '$quantity_rest')");

											mysql_query("DELETE FROM items_on WHERE id='$row[id]'");

										}else{

											$var = 1;

										}

									}else{

										//echo "4";

										mysql_query("UPDATE items_home SET quantity='$quantity_total' WHERE id='$row3[id]'");

										mysql_query("DELETE FROM items_on WHERE id='$row[id]'");

									}

								}else{

									$var = 1;

								}

						}

					}

					

				}else{

					//echo "5";

					mysql_query("INSERT INTO items_home (id_user, id_item, quantity) VALUES ('$user', '$row[id_item]', '$row[quantity]')");

					mysql_query("DELETE FROM items_on WHERE id='$row[id]'");

				}

			}else{

				$var = 1;

			}

		}

	}

	if ($var == 1)

		echo "fail";

	}else{

		echo "select user";

	}

?>