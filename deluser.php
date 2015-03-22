<?php

require 'config.php';
require 'checklogin.php';

if ($_SESSION["id"] != 0) {
	die("<h2>Přístup odepřen!</h2>");
}

if (($_GET["id"] == null) or ($_GET["id"] == 0)) {
	header('Location: users.php');
	die();
}

$sql2 = "DELETE FROM `users` WHERE `users`.`id` = ". $_GET["id"];
$result2 = $conn->query($sql2);
$conn->close();
header('Location: users.php');
?>