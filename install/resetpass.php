<?php

DEFINE("INSTALL", 1);
require "../config.php";

$sql2 = "SELECT * FROM `users` WHERE `users`.`id` = 1";
$result2 = $conn->query($sql2);
$query = $result2->fetch_assoc();
$salt = substr( "abwxdNOefghiLMjkEFuyzADIJKlmnopTPQUqrstRSVBCcvGHWXYZ" ,mt_rand( 0 ,50 ) ,1 ) .substr( md5( time() ), 1);
$salt2 = substr( "STUVabdefghiLMNOPQjkuyzADEFcvwxBCGqHIJKlmnoprstRWXYZ" ,mt_rand( 0 ,50 ) ,1 ) .substr( md5( time() ), 1);
$hash = sha1($salt2 . $query["name"] . $query["name"] . $salt);
$sql = "UPDATE `users` SET `pass` = '". $hash ."', `salt` = '". $salt ."', `salt2` = '". $salt2 ."' WHERE `users`.`id` = 1;";
$result = $conn->query($sql);
die("SUPERUSER PASSWORD RESETED TO BLANK");

?>