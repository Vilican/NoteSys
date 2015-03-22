<?php

session_start();
$sql_login = "SELECT * FROM `users` WHERE id = '". $_SESSION["id"] ."'";
$result_login = $conn->query($sql_login);
$userrow = $result_login->fetch_assoc();

if (sha1($userrow["pass"] . $userrow["name"]) != $_SESSION["hash"]) {
	header('Location: login.php');
	die();
}

$isadmin = 0;
$isadmin = $userrow["admin"];

?>