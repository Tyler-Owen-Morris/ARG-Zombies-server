<?php

	$id_item=$_GET['weapon'];

	

	include ("db_connect.php");

	

	if ($id_item!=0)

	{		

		?>

		

		<input type='text' name='damage1' size='3'>-<input type='text' name='damage2' size='3'>

		<?php

		if ($id_item =='2')

		{

		?>

		<select name='w_type'>

		  <option value="M">MELE</option>

		  <option value="R">RANGE</option>

		</select>

		<?php

		}elseif($id_item =='1'){

		?>

		<select name='w_type'>

		  <option value="M">MELE</option>

		</select>

		<?php

		}

	}													

	



?>