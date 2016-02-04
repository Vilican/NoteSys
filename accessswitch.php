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
$sql = "SELECT * FROM `users` WHERE `users`.`id` = ". santise($_GET["id"]);
$result = $conn->query($sql);
$query = $result->fetch_assoc();
switch ($query["admin"]) {
	case 0:
		$new = 1;
		break;
	case 1:
		$new = 0;
		break;
	default:
		$new = 0;
		break;
}
$sql2 = "UPDATE `users` SET `admin` = '". $new ."' WHERE `users`.`id` = ". santise($_GET["id"]);
$result2 = $conn->query($sql2);
$conn->close();
header('Location: users.php');
?>