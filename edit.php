<?php

require 'config.php';
require 'checklogin.php';

if ($_GET["id"] == null) {
	header('Location: notes.php');
	die();
}

$sql = "SELECT * FROM `entries` WHERE `entries`.`id` = ". $_GET["id"];
$result = $conn->query($sql);
$val = $result->fetch_assoc();
if (($val["autor"] == $_SESSION["id"]) or ($_SESSION["id"] == 0) or ($isadmin == 1)) {

echo '<a href="notes.php">'.$discard.'</a><!doctype html><html><head>
<meta name="generator" content="NoteSys">
<meta name="robots" content="noindex,nofollow">
<META http-equiv="cache-control" content="no-cache">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
<title>'. $title .'</title>
<!--mstheme--><link rel="stylesheet" href="sono1011-1250.css">
<meta name="Microsoft Theme" content="sonora 1011">
</head><body>
<form action="edit.php?id='. $_GET["id"] .'" method="post">
<p align="center">&nbsp;</p>
<p align="center"><b><font size="5" color="#FFFF00">'.$editnote.'</font></b></p>
<div align="center">
	<p align="center">&nbsp;</p>
	<table border="0" width="50%">
		<tr>
			<td>'.$date.'</td>
			<td><input type="text" name="date" value="' . $val["date"] . '" size="20"></td>
		</tr>
		<tr>
			<td>'.$field.'</td>
			<td><input type="text" name="value" value="' . $val["value"] . '" size="50"></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" value="'. $submit .'" name="ok"></td>
		</tr>
	</table>
</div></form></body></html>';

if (isset($_POST["ok"])) {
	if (($_POST["date"] == null) or ($_POST["value"] == null)) {
		header('Location: notes.php');
		die();
	} else {
	$sql2 = "UPDATE `entries` SET `date` = '" . $_POST["date"] . "', `value` = '" . $_POST["value"] . "' WHERE `entries`.`id` = " . $_GET["id"];
	$result2 = $conn->query($sql2);
	}
	$conn->close();
	header('Location: notes.php');
}
}
?>