<?php
require 'config.php';
require 'funct.php';
checklogin("yes");
if ($_GET["id"] == null) {
	header('Location: index.php');
	die();
}
$sql = "SELECT autor FROM `entries` WHERE `entries`.`id` = ". $_GET["id"];
$result = $conn->query($sql);
$val = $result->fetch_assoc();
if (($val["autor"] == $_SESSION["id"]) or ($_SESSION["id"] == 1) or ($_SESSION["isadmin"] == 1)) {
$sql2 = "DELETE FROM `entries` WHERE `entries`.`id` = ". $_GET["id"];
$result2 = $conn->query($sql2);
}
$conn->close();
header('Location: index.php');
?>