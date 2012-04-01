<?php

include("qrcode.php");



$qr = new qrcode();



$qr->text($rand_string);

//$qr->text($_GET['textul']);

//Header("Content-Type: image/png");

//echo $qr->get_image();

echo "<p><img src='".$qr->get_link()."' border='0'/>(right click and save as)</p>";



?>