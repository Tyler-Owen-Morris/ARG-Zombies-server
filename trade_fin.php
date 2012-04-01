<?php

include ("db_connect.php");



$user = $_GET['user'];



	$result = mysql_query("SELECT * FROM trade_ready WHERE user1='$user'");

	$rows = mysql_num_rows($result);

	if ($rows > 0){

		mysql_query("UPDATE trade_ready SET ready1='1' WHERE user1='$user'");

		//echo "ok1";

	}

	$result1 =  mysql_query("SELECT * FROM trade_ready WHERE user2='$user'");

	$rows1 = mysql_num_rows($result1);

	if ($rows1 > 0){

		mysql_query("UPDATE trade_ready SET ready2='1' WHERE user2='$user'");

		//echo "ok2";

	}

	$sql4 = "SELECT * FROM trade_ready WHERE ready1='1' AND ready2='1' ";

	$result4 = mysql_query($sql4) or die ($sql4);

	$rows4 = mysql_num_rows($result4);

	if ($rows4 > 0){

		$row4 = mysql_fetch_array($result4);

		mysql_query("UPDATE trade_ready SET fin='1' WHERE id='$row4[id]'");

		//echo "ok";

	}

	$result = mysql_query("SELECT * FROM trade_ready WHERE (user1='$user' OR user2='$user') AND `fin`='1'");

	$rows = mysql_num_rows($result);

	

	$result2 = mysql_query("SELECT * FROM trade WHERE user='$user'");

	$row2 = mysql_fetch_array($result2);

	

	$result4 = mysql_query("SELECT * FROM items_on WHERE id_user='$row2[to]'");

	$variabila = mysql_num_rows($result4);

	

	if ($rows > 0){

		$result2 = mysql_query("SELECT * FROM trade WHERE user='$user' AND item ='-1'");

		while($row2 = mysql_fetch_array($result2)){

			

				$result3 = mysql_query("SELECT * FROM home WHERE id_user='$user'");

				$row3 = mysql_fetch_array($result3);

				

				$money = $row3['money']-$row2['quantity'];

				//echo $money."<br />";

				if ($money < 0){

					//echo "Insufficient funds";

					$flag1 = 0;

					mysql_query("UPDATE trade_ready SET ok1='0' WHERE user1='$user'");

					mysql_query("UPDATE trade_ready SET ok2='0' WHERE user2='$user'");

				}else{

				//mysql_query("UPDATE home SET money='$money' WHERE id_user='$row2[user]'");

				

				$sql4 = "SELECT * FROM home WHERE id_user='$row2[to]'";

				$result4 = mysql_query($sql4) or die($sql4);

				$row4 = mysql_fetch_array($result4);

				$money2 = $row4['money']+$row2['quantity'];

				//mysql_query("UPDATE home SET money='$money2' WHERE id_user='$row2[to]'");

				//mysql_query("DELETE * FROM trade WHERE id='$row2[id]'");

				mysql_query("UPDATE trade_ready SET ok1='1' WHERE user1='$user'");

				mysql_query("UPDATE trade_ready SET ok2='1' WHERE user2='$user'");

				$flag1 = 1;

				}

				

				$flag[] = $flag1;

			}

			

				$ok = array();



				$result2 = mysql_query("SELECT * FROM trade WHERE user='$user' AND item !='-1'");

					while ($row2 = mysql_fetch_array($result2)){

				

					$flag1 = 0;

					$result3 = mysql_query("SELECT * FROM items_inventory WHERE id_item='$row2[item]'");

					$row3 = mysql_fetch_array($result3);

						if ($row3['slot'] !='7'){

							$result4 = mysql_query("SELECT * FROM items_on WHERE id_user='$row2[to]'");

							$rows4 = mysql_num_rows($result4);

							if ($rows4 < 15 && $variabila < 15){

								//mysql_query("INSERT INTO items_on (id_user, id_item, quantity, active) VALUES ('$row2[to]', '$row2[item]', '$row2[quantity]', '0')");

								//mysql_query("DELETE FROM trade WHERE id='$row2[id]'");

								$variabila++;

								$flag1 = 1;

								$ok[] = 'yes1';

							}else{

								$flag1 = 0;

								$ok[] = 'no1';

							}

						}

						if ($row3['slot'] =='7'){

							$quantity_rest = 999-$row2['quantity'];

							//echo $quantity_rest."<br />";

							$result5 = mysql_query("SELECT * FROM items_on WHERE id_user='$row2[to]' AND id_item='$row2[item]'");

							$rows5 = mysql_num_rows($result5);

							if ($rows5 > 0){

								$result4 = mysql_query("SELECT * FROM items_on WHERE id_user='$row2[to]' AND id_item='$row2[item]' AND quantity<='$quantity_rest'");

								$rows4 = mysql_num_rows($result4);

								if ($rows4 > 0){

									$row4 = mysql_fetch_array($result4);

									$quantity_insert = $row4['quantity']+$row2['quantity'];

									//mysql_query("UPDATE items_on SET quantity='$quantity_rest' WHERE id_user='$row2[to]' AND id_item='$row2[item]' AND quantity<='$quantity_insert' AND active='0'");

									$flag1 = 1;

									$ok[] = 'yes2';

								}else{

									$result7 = mysql_query("SELECT * FROM items_on WHERE id_user='$row2[to]'");

									$rows7 = mysql_num_rows($result7);

									if ($rows7 < 15 && $variabila < 15){

										$result6 = mysql_query("SELECT * FROM items_on WHERE id_user='$user' AND id_item='$row2[item]' AND quantity BETWEEN '$quantity_rest' AND '999'");

										$row6 = mysql_fetch_array($result6);

										$quantity_after = 999 - $row6['quantity'];

										$quantity_after2 = $row2['quantity'] - $quantity_after;

										//mysql_query("UPDATE items_on SET quantity='999' WHERE id_user='$row2[to]' AND id_item='$row2[item]' AND active='0' AND quantity BETWEEN '$quantity_rest' AND '999'");

										//mysql_query("INSERT INTO items_on (id_user, id_item, quantity, active) VALUES ('$row2[to]', '$row2[item]', '$quantity_after2', '0')");

										$variabila++;

										$flag1 = 1;

										$ok[] = 'yes3';

									}else{

										$flag1 = 0;

										$ok[] = 'no3';

									}

								}

							}else{

								$result4 = mysql_query("SELECT * FROM items_on WHERE id_user='$row2[to]'");

								$rows4 = mysql_num_rows($result4);

								if ($rows4 < 15 && $variabila < 15){

									//mysql_query("INSERT INTO items_on (id_user, id_item, quantity, active) VALUES ('$row2[to]', '$row2[item]', '$row2[quantity]', '0')");

									//mysql_query("DELETE FROM trade WHERE id='$row2[id]'");

									$variabila++;

									$flag1 = 1;

									$ok[] = 'yes4';

								}else{

									$flag1 = 0;

									$ok[] = 'no4';

								}

							}

						}

						

					$flag[] = $flag1;

					

				}

				

				if (count($flag) == '0'){

					$flag[] = 1;

				}

				print_r($flag);

				//print_r($ok);

				

				

				

				if (!in_array(0, $flag)){

					mysql_query("UPDATE trade_ready SET ok1='1' WHERE user1='$user'");

					mysql_query("UPDATE trade_ready SET ok2='1' WHERE user2='$user'");

				}else{

					$result2 = mysql_query("SELECT * FROM trade WHERE user='$user'");

					$row2 = mysql_fetch_array($result2);

					echo "fail ".$row2['to'];

					mysql_query("UPDATE trade_ready SET `ready1`='0', `ready2`='0', `fin`='0', WHERE `user1`='$user'");

					mysql_query("UPDATE trade_ready SET `ready1`='0', `ready2`='0', `fin`='0', WHERE `user2`='$user'");

				}

			

		

		

		

		

		$result10 = mysql_query("SELECT * FROM trade_ready WHERE (user1='$user' OR user2='$user') AND (ok1='1' AND ok2='1')");

		$rows10 = mysql_num_rows($result10);

		if ($rows10 > 0){

			$result2 = mysql_query("SELECT * FROM trade WHERE user='$user' AND item ='-1'");

			while($row2 = mysql_fetch_array($result2)){

				

					$result3 = mysql_query("SELECT * FROM home WHERE id_user='$user'");

					$row3 = mysql_fetch_array($result3);

					

					$money = $row3['money']-$row2['quantity'];

					//echo $money."<br />";

					if ($money < 0){

						echo "Insufficient funds";

					}else{

					mysql_query("UPDATE home SET money='$money' WHERE id_user='$row2[user]'");

					

					$sql4 = "SELECT * FROM home WHERE id_user='$row2[to]'";

					$result4 = mysql_query($sql4) or die($sql4);

					$row4 = mysql_fetch_array($result4);

					$money2 = $row4['money']+$row2['quantity'];

					mysql_query("UPDATE home SET money='$money2' WHERE id_user='$row2[to]'");

					mysql_query("DELETE FROM trade WHERE id='$row2[id]'");

					//mysql_query("UPDATE trade_ready SET ok1='1' WHERE user1='$user'");

					//mysql_query("UPDATE trade_ready SET ok2='1' WHERE user2='$user'");

					}

			}	

				

					$result2 = mysql_query("SELECT * FROM trade WHERE user='$user' AND item !='-1'");

					while ($row2 = mysql_fetch_array($result2)){

					

						$result3 = mysql_query("SELECT * FROM items_inventory WHERE id_item='$row2[item]'");

						$row3 = mysql_fetch_array($result3);

							if ($row3['slot'] !='7'){

								$result4 = mysql_query("SELECT * FROM items_on WHERE id_user='$row2[to]'");

								$rows4 = mysql_num_rows($result4);

								if ($rows4 < 15){

									mysql_query("INSERT INTO items_on (id_user, id_item, quantity, active) VALUES ('$row2[to]', '$row2[item]', '$row2[quantity]', '0')");

									mysql_query("DELETE FROM items_on WHERE id_user='$user' AND id_item='$row2[item]' LIMIT 1");

									mysql_query("DELETE FROM trade WHERE id='$row2[id]'");

									

								}

							}

							if ($row3['slot'] =='7'){

								$quantity_rest = 999-$row2['quantity'];

								//echo $quantity_rest."<br />";

								$result15 = mysql_query("SELECT * FROM items_on WHERE id_user='$row2[to]' AND id_item='$row2[item]'");

								$rows15 = mysql_num_rows($result15);

								if ($rows15 > 0){

									$result4 = mysql_query("SELECT * FROM items_on WHERE id_user='$row2[to]' AND id_item='$row2[item]' AND quantity<='$quantity_rest'");

									$rows4 = mysql_num_rows($result4);

									if ($rows4 > 0){

										$row4 = mysql_fetch_array($result4);

										$quantity_insert = $row4['quantity']+$row2['quantity'];

										mysql_query("UPDATE items_on SET quantity='$quantity_insert' WHERE id_user='$row2[to]' AND id_item='$row2[item]' AND quantity<='$quantity_rest'");

										$sql5 = "SELECT * FROM items_on WHERE id_user='$user' AND id_item='$row2[item]'";

										$result5 = mysql_query($sql5) or die ($sql5);

												$quantity = 0;

											while ($row5 = mysql_fetch_array($result5)){

												$quantity +=$row5['quantity'].";";

											}

											$quantity -= $row2['quantity'];

											echo "q4: ".$quantity." ";

											$imp = (int)($quantity/999);

											mysql_query("DELETE FROM items_on WHERE id_user='$user' AND id_item='$row2[item]'");

											if ($imp > 0){

												$i = 1;

												while($i <= $imp){

													mysql_query("INSERT INTO items_on (id_user, id_item, quantity, active) VALUES ('$user', '$row2[item]', '999', '0')");

													$i++;

												}

												$quantity2 = $quantity - $imp*999;

												mysql_query("INSERT INTO items_on (id_user, id_item, quantity, active) VALUES ('$user', '$row2[item]', '$quantity2', '0')");

												mysql_query("DELETE FROM trade WHERE id='$row2[id]'");

											}else{

												mysql_query("INSERT INTO items_on (id_user, id_item, quantity, active) VALUES ('$user', '$row2[item]', '$quantity', '0')");

											}

											

										mysql_query("DELETE FROM trade WHERE id='$row2[id]'");

									}else{

										$result7 = mysql_query("SELECT * FROM items_on WHERE id_user='$row2[to]'");

										$rows7 = mysql_num_rows($result7);

										if ($rows7 < 15){

											$result6 = mysql_query("SELECT * FROM items_on WHERE id_user='$row2[to]' AND id_item='$row2[item]' AND quantity BETWEEN '$quantity_rest' AND '999'");

											$row6 = mysql_fetch_array($result6);

											$quantity_after = 999 - $row6['quantity'];

											$quantity_after2 = $row2['quantity'] - $quantity_after;

											mysql_query("UPDATE items_on SET quantity='999' WHERE id_user='$row2[to]' AND id_item='$row2[item]' AND quantity BETWEEN '$quantity_rest' AND '999'");

											mysql_query("INSERT INTO items_on (id_user, id_item, quantity, active) VALUES ('$row2[to]', '$row2[item]', '$quantity_after2', '0')");

											$sql5 = "SELECT * FROM items_on WHERE id_user='$user' AND id_item='$row2[item]'";

										$result5 = mysql_query($sql5) or die ($sql5);

												$quantity = 0;

											while ($row5 = mysql_fetch_array($result5)){

												$quantity +=$row5['quantity'].";";

											}

											$quantity -= $row2['quantity'];

											//echo "q3: ".$quantity." ";

											$imp = (int)($quantity/999);

											mysql_query("DELETE FROM items_on WHERE id_user='$user' AND id_item='$row2[item]'");

											if ($imp > 0){

												$i = 1;

												while($i <= $imp){

													mysql_query("INSERT INTO items_on (id_user, id_item, quantity, active) VALUES ('$user', '$row2[item]', '999', '0')");

													$i++;

												}

												$quantity2 = $quantity - $imp*999;

												mysql_query("INSERT INTO items_on (id_user, id_item, quantity, active) VALUES ('$user', '$row2[item]', '$quantity2', '0')");

												mysql_query("DELETE FROM trade WHERE id='$row2[id]'");

											}else{

												mysql_query("INSERT INTO items_on (id_user, id_item, quantity, active) VALUES ('$user', '$row2[item]', '$quantity', '0')");

											}

											

										}

									}

								}else{

									$result4 = mysql_query("SELECT * FROM items_on WHERE id_user='$row2[to]'");

									$rows4 = mysql_num_rows($result4);

									if ($rows4 < 15){

										mysql_query("INSERT INTO items_on (id_user, id_item, quantity, active) VALUES ('$row2[to]', '$row2[item]', '$row2[quantity]', '0')");

										

										$sql5 = "SELECT * FROM items_on WHERE id_user='$user' AND id_item='$row2[item]'";

										$result5 = mysql_query($sql5) or die ($sql5);

												$quantity = 0;

											while ($row5 = mysql_fetch_array($result5)){

												$quantity +=$row5['quantity'].";";

											}

											$quantity -= $row2['quantity'];

											//echo "q4: ".$quantity." ";

											$imp = (int)($quantity/999);

											mysql_query("DELETE FROM items_on WHERE id_user='$user' AND id_item='$row2[item]'");

											if ($imp > 0){

												$i = 1;

												while($i <= $imp){

													mysql_query("INSERT INTO items_on (id_user, id_item, quantity, active) VALUES ('$user', '$row2[item]', '999', '0')");

													$i++;

												}

												$quantity2 = $quantity - $imp*999;

												mysql_query("INSERT INTO items_on (id_user, id_item, quantity, active) VALUES ('$user', '$row2[item]', '$quantity2', '0')");

												mysql_query("DELETE FROM trade WHERE id='$row2[id]'");

											}else{

												mysql_query("INSERT INTO items_on (id_user, id_item, quantity, active) VALUES ('$user', '$row2[item]', '$quantity', '0')");

											}

											

										mysql_query("DELETE FROM trade WHERE id='$row2[id]'");

									}

								}

							}

							

						

					}

					

					

			

			mysql_query("DELETE FROM items_on WHERE quantity='0' AND id_user='$user'");

			mysql_query("INSERT INTO trade_chat (id_to, id_from, text) VALUES ('$user', '0', '1')");

		

		}else{//end if ($rows10 > 0)

			//echo "not";

		}

	}else{

		echo "No active trade!";

	}

	$sql = "SELECT * FROM trade WHERE `user`='$user' OR `to`='$user'";

	$result = mysql_query($sql) or die ($sql);

	$rows = mysql_num_rows($result);

	if ($rows == 0){

		mysql_query("DELETE FROM trade_ready WHERE user1='$user' OR user2='$user'");

		//echo "deleted";

	}

	

?>