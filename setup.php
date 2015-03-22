<?php

require 'config.php';
require 'checklogin.php';

if ($_SESSION["id"] != 0) {
	die("<h2>Přístup odepřen!</h2>");
}

echo '<p id="title">'. $name .'</p><a href="logout.php"><a href="notes.php">'.$discard.'</a><!doctype html><html><head>
<meta name="generator" content="NoteSys">
<meta name="robots" content="noindex,nofollow">
<META http-equiv="cache-control" content="no-cache">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
<title>'. $title .'</title>
<!--mstheme--><link rel="stylesheet" href="sono1011-1250.css">
<style>body{color:'. $text .';background-color:'. $backgrnd .';}a{color:'. $links .';}</style>
<meta name="Microsoft Theme" content="sonora 1011">
</head><body>
<form action="setup.php" method="post">
<p align="center">&nbsp;</p>
<p align="center"><b><font size="5">'.$sysconf.'</font></b></p>
<div align="center">
	<p align="center">&nbsp;</p>
	<table border="0" width="50%">
		<tr>
			<td>'.$title2.'</td>
			<td><input type="text" name="title" size="20" value="'. $title .'"></td>
		</tr>
		<tr>
			<td>'.$heading.'</td>
			<td><input type="text" name="heading" size="20" value="'. $name .'"></td>
		</tr>
		<tr>
			<td>'.$textcol.'</td>
			<td><input type="text" name="txtcol" size="20" value="'. $text .'"></td>
		</tr>
		<tr>
			<td>'.$bckgrndcol.'</td>
			<td><input type="text" name="bckcol" size="20" value="'. $backgrnd .'"></td>
		</tr>
		<tr>
			<td>'.$linkscol.'</td>
			<td><input type="text" name="links" size="20" value="'. $links .'"></td>
		</tr>
		<tr>
			<td>'.$dtname.'</td>
			<td><input type="text" name="date" size="20" value="'. $date .'"></td>
		</tr>
		<tr>
			<td>'.$entryname.'</td>
			<td><input type="text" name="field" size="20" value="'. $field .'"></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" value="'.$submit.'" name="ok"></td>
		</tr>
	</table>
</div></form><p id="copyright">Powered by <a href="https://notesys.sufix.cz">NoteSys</a></p></body></html>';

if (isset($_POST["ok"])) {
	if (($_POST["title"] == null) or ($_POST["heading"] == null) or ($_POST["txtcol"] == null) or ($_POST["bckcol"] == null) or ($_POST["date"] == null) or ($_POST["field"] == null) or ($_POST["links"] == null)) {
		header('Location: notes.php');
		die();
	} else {
	$sql2 = "UPDATE `settings` SET `value` = '". $_POST["bckcol"] ."' WHERE `settings`.`id` = 'backgrnd'";
	$sql3 = "UPDATE `settings` SET `value` = '". $_POST["date"] ."' WHERE `settings`.`id` = 'date'";
	$sql4 = "UPDATE `settings` SET `value` = '". $_POST["field"] ."' WHERE `settings`.`id` = 'field'";
	$sql5 = "UPDATE `settings` SET `value` = '". $_POST["heading"] ."' WHERE `settings`.`id` = 'name'";
	$sql6 = "UPDATE `settings` SET `value` = '". $_POST["txtcol"] ."' WHERE `settings`.`id` = 'text'";
	$sql7 = "UPDATE `settings` SET `value` = '". $_POST["title"] ."' WHERE `settings`.`id` = 'title'";
	$sql8 = "UPDATE `settings` SET `value` = '". $_POST["links"] ."' WHERE `settings`.`id` = 'zlinks'";
	$result2 = $conn->query($sql2);
	$result3 = $conn->query($sql3);
	$result4 = $conn->query($sql4);
	$result5 = $conn->query($sql5);
	$result6 = $conn->query($sql6);
	$result7 = $conn->query($sql7);
	$result8 = $conn->query($sql8);
	}
	$conn->close();
	header('Location: notes.php');
}
?>