<?php
require 'config.php';
require 'funct.php';
checklogin("yes");
if ($_GET["id"] == null) {
	header('Location: index.php');
	die();
}
if(isset($_GET["agreed"])) {
	$sql = "SELECT autor FROM `entries` WHERE `entries`.`id` = ". santise($_GET["id"]);
	$result = $conn->query($sql);
	$val = $result->fetch_assoc();
	if (($val["autor"] == $_SESSION["id"]) or ($_SESSION["id"] == 1) or ($_SESSION["isadmin"] == 1)) {
		$sql2 = "DELETE FROM `entries` WHERE `entries`.`id` = ". santise($_GET["id"]);
		$result2 = $conn->query($sql2);
	}
	$conn->close();
	header('Location: index.php');
} else {
	echo '<DOCTYPE html><html><body onload="onLoad()"><script>function onLoad() { var r = confirm("'. $confdelno .'"); if (r == true) { window.location.assign(window.location.href + "&agreed"); } else { window.location.assign("index.php"); } }</script></body></html>';
}
?>