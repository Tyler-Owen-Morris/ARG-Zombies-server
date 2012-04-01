<?php

	include ("db_connect.php");

	

	$result = mysql_query("SELECT * FROM items_inventory WHERE craft='1' ORDER BY id_item");

	while ($row = mysql_fetch_array($result)){

		if ($row['name'] !="")

			$name = $row['name'];

		else $name = '0';

		if ($row['brutality'] !="")

			$brutality = $row['brutality'];

		else $brutality = '0';

		if ($row['accuracy'] !="")

			$accuracy = $row['accuracy'];

		else $accuracy = '0';

		if ($row['fortitude'] !="")

			$fortitude = $row['fortitude'];

		else $fortitude = '0';

		if ($row['attack'] !="")

			$attack = $row['attack'];

		else $attack = '0';

		if ($row['defense'] !="")

			$defense = $row['defense'];

		else $defense = '0';

		if ($row['health'] !="")

			$health = $row['health'];

		else $health = '0';

		if ($row['regen'] !="")

			$regen = $row['regen'];

		else $regen = '0';

		if ($row['duration'] !="")

			$duration = $row['duration'];

		else $duration = '0';

		if ($row['slot'] !="")

			$slot = $row['slot'];

		else $slot = '0';

		if ($row['craft'] !="")

			$craft = $row['craft'];

		else $craft = '0';

		if ($row['craft_items'] !="")

			$craft_items = $row['craft_items'];

		else $craft_items = '0';

		if ($row['weapon_items'] !="")

			$weapon_items = $row['weapon_items'];

		else $weapon_items = '0';

		if ($row['price'] !="")

			$price = $row['price'];

		else $price = '0';

		if ($row['level'] !="")

			$level = $row['level'];

		else $level = '0';

		

		echo $row['id_item'].":".$name.":".$brutality.":".$accuracy.":".$fortitude.":".$attack.":".

		$defense.":".$health.":".$regen.":".$duration.":".$slot.":".$craft.":".$craft_items.":".$weapon_items.":".$price.":".$level."<br />";

	}

?>