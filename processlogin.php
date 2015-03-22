<?php

require 'config.php';

$sql = "SELECT * FROM `users` WHERE name = '" . $_POST["name"] . "'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
    $hash = sha1($row["salt2"] . $row["name"] . $_POST["password"] . $row["name"] . $row["salt"]);
	if ($hash == $row["pass"]) {
		session_start();
		$_SESSION["hash"] = sha1($hash . $row["name"]);
		$_SESSION["id"] = $row["id"];
		$conn->close();
		header('Location: notes.php');
		die();
	} else {
		$conn->close();
		header('Location: login.php');
	}
} else {
	$conn->close();
	header('Location: login.php');
}
$conn->close();

?>