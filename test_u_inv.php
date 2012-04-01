<form action="update_inventory.php" method="POST">



user id:<input name="user_id" value="">

<?php

include("db_connect.php");

$res=mysql_query("SELECT * FROM items_on WHERE id_user ='748'");

$num=mysql_num_rows($res);

?>

<input type="hidden" name="number" value="<?php echo $num; ?>">



<?php

$i=0;

while($row=mysql_fetch_array($res)){

?>

<input type="hidden" name="<?php echo $i; ?>_item_id" value="<?php echo $row['id_item']; ?>">

<input type="hidden" name="<?php echo $i; ?>_quantity" value="<?php echo $row['quantity']; ?>">

<input type="hidden" name="<?php echo $i; ?>_active" value="<?php echo $row['active']; ?>">

<input type="hidden" name="<?php echo $i; ?>_add_time" value="<?php if($row['add_time']==0)echo 0;else echo 1; ?>">



<?php

$i++;

}



?>





<input type="submit" value="goforit">



</form>

