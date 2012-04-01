<?php

include("db_connect.php");

$res_update=mysql_query("UPDATE mission_player SET completed = 1, procent = 100.00 WHERE mission_id = {$_POST['miss_id']} AND user_id = {$_POST['user_id']}") or die(mysql_error());

?>

<script src="js/jquery-1.7.1.min.js"></script>



<script>

function redirectit(){

$('#myform').submit();

}

</script>



<body onload="redirectit()">

<form id="myform" action="info_character.php" method="POST">

<input type="hidden" name="user_id" value="<?php echo $_POST['user_id']; ?>">

</form>

</body>