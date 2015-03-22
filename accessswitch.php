<?php

require 'config.php';
require 'checklogin.php';

if ($_SESSION["id"] != 0) {
	die("<h2>Přístup odepřen!</h2>");
}

if ($_GET["id"] == null) {
	header('Location: users.php');
	die();
}

if ($_GET["id"] == 0) {
	header('Location: users.php');
	die();
}

$sql = "SELECT * FROM `users` WHERE `users`.`id` = ". $_GET["id"];
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
		$conn->close();
		header('Location: users.php');
		die("<h2>Internal database error</2>");
		break;
}

$sql2 = "UPDATE `users` SET `admin` = '". $new ."' WHERE `users`.`id` = ". $_GET["id"];
$result2 = $conn->query($sql2);
$conn->close();
header('Location: users.php');
?>