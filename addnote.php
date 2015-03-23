<?php

require 'config.php';
require 'checklogin.php';

$sqlid = "SELECT * FROM `lastid` WHERE `type` = 'notes'";
$resultid = $conn->query($sqlid);
$valid = $resultid->fetch_assoc();
$newid = $valid["lastid"] + 1;

echo '<p id="title">'. $name .'</p><a href="notes.php">'.$discard.'</a><!doctype html><html><head>
<meta name="generator" content="NoteSys">
<meta name="robots" content="noindex,nofollow">
<META http-equiv="cache-control" content="no-cache">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
<title>'. $title .'</title>
<!--mstheme--><link rel="stylesheet" href="sono1011-1250.css">
<style>body{color:'. $text .';background-color:'. $backgrnd .';}a{color:'. $links .';}</style>
<meta name="Microsoft Theme" content="sonora 1011">
</head><body>
<form action="addnote.php" method="post">
<p align="center">&nbsp;</p>
<p align="center"><b><font size="5">'.$addnote.'</font></b></p>
<div align="center">
	<p align="center">&nbsp;</p>
	<table border="0" width="50%">
		<tr>
			<td>'.$date.'</td>
			<td><input type="text" name="date" size="20"></td>
		</tr>
		<tr>
			<td>'.$field.'</td>
			<td><input type="text" name="value" size="50"></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" value="'. $submit .'" name="ok"></td>
		</tr>
	</table>
</div></form><p id="copyright">Powered by <a href="https://notesys.sufix.cz">NoteSys</a></p></body></html>';

if (isset($_POST["ok"])) {
	if (($_POST["date"] == null) or ($_POST["value"] == null)) {
		header('Location: notes.php');
		die();
	} else {
	$sql2 = "INSERT INTO `entries` (`id`, `date`, `value`, `autor`) VALUES ('".$newid."', '". strtotime($_POST["date"]) ."', '".$_POST["value"]."', '".$_SESSION["id"]."')";
	$result2 = $conn->query($sql2);
	$sqlupid = "UPDATE `lastid` SET `lastid` = '". $newid ."' WHERE `lastid`.`type` = 'notes'";
	$resultupid = $conn->query($sqlupid);
	$conn->close();
	header('Location: notes.php');
	}
}
?>