<?php

	$id_item=$_GET['crafted'];

	

	include ("db_connect.php");

	

	if ($id_item!=0)

	{		

			

			$result = mysql_query("SELECT * FROM items_inventory ORDER BY id_item");

			$row = mysql_fetch_array($result);

			$nr =mysql_num_rows($result);

			$i=1;

			?>

			<br />

			<select name="items_crafted[]" multiple="multiple"> 

    

	<?php do { ?>

	<option value="<?php echo $row['id_item']; ?>" onclick="document.getElementById('container<?php print $i;?>').style.display='block';"><?php echo $row['name']; ?></option>

    <?php $i++;} while ($row = mysql_fetch_assoc($result)); ?>

    </select>

			<br />

			<?php

			

			

	

	?>

	<div>

	<?php

	for($i=0;$i<=$nr;$i++){

	print "<div id='container$i' style='display:none;'><input type='text' name='details$i' size='5' ><a href='javascript:void(0);' onclick=\"document.getElementById('container$i').style.display='none'\">hide</a></div>";

	}

	?>

	</div>

	<?php

	}

	?>