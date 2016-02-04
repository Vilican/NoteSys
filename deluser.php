<?php

require 'config.php';
require 'funct.php';
checklogin("yes");
if ($_SESSION["id"] != 1) {
	header('Location: index.php');
	die();
}
if (($_GET["id"] == null) or ($_GET["id"] == 1)) {
	header('Location: users.php');
	die();
}
$sql2 = "DELETE FROM `users` WHERE `users`.`id` = ". santise($_GET["id"]);
$result2 = $conn->query($sql2);
$conn->close();
header('Location: users.php');
?>