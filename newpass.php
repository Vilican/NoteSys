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

echo '<p id="title">'. $name .'</p><a href="users.php">'.$discard.'</a><!doctype html><html><head>
<meta name="generator" content="NoteSys">
<meta name="robots" content="noindex,nofollow">
<META http-equiv="cache-control" content="no-cache">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
<title>'. $title .'</title>
<!--mstheme--><link rel="stylesheet" href="sono1011-1250.css">
<style>body{color:'. $text .';background-color:'. $backgrnd .';}a{color:'. $links .';}</style>
<meta name="Microsoft Theme" content="sonora 1011">
</head><body>
<form action="newpass.php?id='. $_GET["id"] .'" method="post">
<p align="center">&nbsp;</p>
<p align="center"><b><font size="5">'.$resetpass.'</font></b></p>
<div align="center">
	<p align="center">&nbsp;</p>
	<table border="0" width="50%">
		<tr>
			<td>'.$newpass.'</td>
			<td><input type="text" name="pass" size="20"></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" value="'.$submit.'" name="ok"></td>
		</tr>
	</table>
</div></form></body></html>';

if (isset($_POST["ok"])) {
	if ($_POST["pass"] == null) {
		$conn->close();
		header('Location: users.php');
		die();
	}
	
	$sql3 = "SELECT * FROM `users` WHERE `users`.`id` = ". $_GET["id"];
	$result3 = $conn->query($sql3);
	$query = $result3->fetch_assoc();
	
	$hash = sha1($query["salt2"] . $query["name"] . $_POST["pass"] . $query["name"] . $query["salt"]);

	$sql2 = "UPDATE `users` SET `pass` = '". $hash ."' WHERE `users`.`id` = ". $_GET["id"];
	$result2 = $conn->query($sql2);
	$conn->close();
	header('Location: users.php');
}
?>