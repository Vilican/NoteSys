<?php

DEFINE("INSTALL", 1);
require "../config.php";

$sql = "UPDATE `settings` SET `value` = '0' WHERE `settings`.`id` = 'httpsredir';";
$sql2 = "UPDATE `settings` SET `value` = '0' WHERE `settings`.`id` = 'extsec';";
$result = $conn->query($sql);
$result2 = $conn->query($sql2);
die("ALL EXTENDED SECURITY DISABLED");

?>