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

if(isset($_GET["agreed"])) {
	$sql2 = "DELETE FROM `users` WHERE `users`.`id` = ". santise($_GET["id"]);
	$result2 = $conn->query($sql2);
	$conn->close();
	header('Location: users.php');
} else {
	echo '<DOCTYPE html><html><body onload="onLoad()"><script>function onLoad() { var r = confirm("'. $confdelnu .'"); if (r == true) { window.location.assign(window.location.href + "&agreed"); } else { window.location.assign("users.php"); } }</script></body></html>';
}
?>