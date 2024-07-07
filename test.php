<?php
$fullname = "Abdul Sahabi";
$fname = explode(" ", $fullname);
$username = array_pop($fname);
echo $username;
print_r($fname);
?>
