<?php

include ("db_connect.php");

if (isset($_POST['lat']))

$lat = $_POST['lat'];

else

$lat = 00.00;

if (isset($_POST['lon']))

$lon = $_POST['lon'];

else

$lon = 00.00;

$min = $_POST['moblvlmin'];

$max = $_POST['moblvlmax'];



$result = mysql_query("SELECT * FROM zone WHERE lat_min <'$lat' AND lat_max > '$lat' AND long_min < '$lon' AND long_max > '$lon'");

$rows = mysql_num_rows($result);

if ($rows > 0)

{

while ($row = mysql_fetch_array($result)){

	$result2 = mysql_query("SELECT * FROM mobs WHERE id_area='$row[id]'");

	while ($row2 = mysql_fetch_array($result2)){

		$result3 = mysql_query("SELECT * FROM mobs_desc WHERE id='$row2[id_mobs]'");

		$row3 = mysql_fetch_array($result3);

		$level = explode("-", $row3['level']);

		$level_min = $level[0];

		$level_max = $level[1];

		//echo $row3['level'].";";

		if ($level_min != "" && $level_max != "")

		{

			if ($max == '0'){

				if ($level_min >= $min || $level_max >= $min){

					$mobs[] = $row2['id_mobs'];

				}

			}else{

				if ($level_max >= $min && $level_max <= $max){

					$mobs[] = $row2['id_mobs'];

				}elseif($level_max >= $max && $level_min <= $max){

					$mobs[] = $row2['id_mobs'];

				}

			}

		}

	}

}

//print_r($mobs);

if (count($mobs) > 0){

	$mob = array_rand($mobs);

	$result3 = mysql_query("SELECT * FROM mobs_desc WHERE id='$mobs[$mob]'");

	$row3 = mysql_fetch_array($result3);

	echo $row3['id']."<br />";

	echo $row3['name']."<br />";

	echo $row3['model_name']."<br />";

	echo $row3['hp']."<br />";

	echo $row3['energy']."<br />";

	echo $row3['regen']."<br />";

	echo $row3['defense']."<br />";

	echo $row3['attack']."<br />";

	echo $row3['evasion']."<br />";

	echo $row3['cooldown']."<br />";

	$level = explode("-", $row3['level']);

	$level_min = $level[0];

	$level_max = $level[1];

	if ($max == '0'){

		if ($level_min > $min){

			$var = rand($level_min, $level_max);

		}else{

			$var = rand($min, $level_max);

		}

		echo $var;

	}else{

		if ($level_min > $min){

			if ($level_max > $max){

				$var = rand($level_min, $max);

			}else{

				$var = rand($level_min, $level_max);

			}

		}else{

			if ($level_max > $max){

				$var = rand($min, $max);

			}else{

				$var = rand($min, $level_max);

			}

		}

		echo $var;

	}

	

}else{

	$result2 = mysql_query("SELECT * FROM mobs WHERE id_area = '0'");

	while ($row2 = mysql_fetch_array($result2)){

		$result3 = mysql_query("SELECT * FROM mobs_desc WHERE id='$row2[id_mobs]'");

		$row3 = mysql_fetch_array($result3);

		$level = explode("-", $row3['level']);

		$level_min = $level[0];

		$level_max = $level[1];

		//echo $row3['level'].";";

		if ($level_min != "" && $level_max != "")

		{

			if ($level_min >= $min || $level_max >= $min){

				if ($level_min >= $max2 && $level_min <= $max){

					$mobs[] = $row2['id_mobs'];

				}

			}else{

				if ($level_max >= $min && $level_max <= $max){

					$mobs[] = $row2['id_mobs'];

				}

			}

		}

	}

	if (count($mobs) > 0){

	$mob = array_rand($mobs);

	$result3 = mysql_query("SELECT * FROM mobs_desc WHERE id='$mobs[$mob]'");

	$row3 = mysql_fetch_array($result3);

	echo $row3['id']."<br />";

	echo $row3['name']."<br />";

	echo $row3['model_name']."<br />";

	echo $row3['hp']."<br />";

	echo $row3['energy']."<br />";

	echo $row3['regen']."<br />";

	echo $row3['defense']."<br />";

	echo $row3['attack']."<br />";

	echo $row3['evasion']."<br />";

	echo $row3['cooldown']."<br />";

	$level = explode("-", $row3['level']);

	$level_min = $level[0];

	$level_max = $level[1];

	if ($max == '0'){

		if ($level_min > $min){

			$var = rand($level_min, $level_max);

		}else{

			$var = rand($min, $level_max);

		}

		echo $var;

	}else{

		if ($level_min > $min){

			if ($level_max > $max){

				$var = rand($level_min, $max);

			}else{

				$var = rand($level_min, $level_max);

			}

		}else{

			if ($level_max > $max){

				$var = rand($min, $max);

			}else{

				$var = rand($min, $level_max);

			}

		}

		echo $var;

	}

	}else{

		//echo "No mobs";

		$result3 = mysql_query("SELECT * FROM mobs_desc WHERE id='9'");

		$row3 = mysql_fetch_array($result3);

		echo $row3['id']."<br />";

		echo "Clown"."<br />";

		echo $row3['model_name']."<br />";

		echo $row3['hp']."<br />";

		echo $row3['energy']."<br />";

		echo $row3['regen']."<br />";

		echo $row3['defense']."<br />";

		echo $row3['attack']."<br />";

		echo $row3['evasion']."<br />";

		echo $row3['cooldown']."<br />";

		$level = explode("-", $row3['level']);

		$level_min = $level[0];

		echo $level_min;

	}

}



}else{

	$result2 = mysql_query("SELECT * FROM mobs WHERE id_area = '0'");

	while ($row2 = mysql_fetch_array($result2)){

		$result3 = mysql_query("SELECT * FROM mobs_desc WHERE id='$row2[id_mobs]'");

		$row3 = mysql_fetch_array($result3);

		$level = explode("-", $row3['level']);

		$level_min = $level[0];

		$level_max = $level[1];

		//echo $row3['level'].";";

		if ($level_min != "" && $level_max != "")

		{

			if ($level_min >= $min || $level_max >= $min){

				if ($level_min >= $max2 && $level_min <= $max){

					$mobs[] = $row2['id_mobs'];

				}

			}else{

				if ($level_max >= $min && $level_max <= $max){

					$mobs[] = $row2['id_mobs'];

				}

			}

		}

	}

	if (count($mobs) > 0){

	$mob = array_rand($mobs);

	$result3 = mysql_query("SELECT * FROM mobs_desc WHERE id='$mobs[$mob]'");

	$row3 = mysql_fetch_array($result3);

	echo $row3['id']."<br />";

	echo $row3['name']."<br />";

	echo $row3['model_name']."<br />";

	echo $row3['hp']."<br />";

	echo $row3['energy']."<br />";

	echo $row3['regen']."<br />";

	echo $row3['defense']."<br />";

	echo $row3['attack']."<br />";

	echo $row3['evasion']."<br />";

	echo $row3['cooldown']."<br />";

	$level = explode("-", $row3['level']);

	$level_min = $level[0];

	$level_max = $level[1];

	if ($max == '0'){

		if ($level_min > $min){

			$var = rand($level_min, $level_max);

		}else{

			$var = rand($min, $level_max);

		}

		echo $var;

	}else{

		if ($level_min > $min){

			if ($level_max > $max){

				$var = rand($level_min, $max);

			}else{

				$var = rand($level_min, $level_max);

			}

		}else{

			if ($level_max > $max){

				$var = rand($min, $max);

			}else{

				$var = rand($min, $level_max);

			}

		}

		echo $var;

	}

	}else{

		//echo "No mobs";

		$result3 = mysql_query("SELECT * FROM mobs_desc WHERE id='9'");

		$row3 = mysql_fetch_array($result3);

		echo $row3['id']."<br />";

		echo "Clown"."<br />";

		echo $row3['model_name']."<br />";

		echo $row3['hp']."<br />";

		echo $row3['energy']."<br />";

		echo $row3['regen']."<br />";

		echo $row3['defense']."<br />";

		echo $row3['attack']."<br />";

		echo $row3['evasion']."<br />";

		echo $row3['cooldown']."<br />";

		$level = explode("-", $row3['level']);

		$level_min = $level[0];

		echo $level_min;

	}

}

?>