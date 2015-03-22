<?php

require 'config.php';
require 'checklogin.php';

echo '<a href="notes.php">'.$discard.'</a><!doctype html><html><head>
<meta name="generator" content="NoteSys">
<meta name="robots" content="noindex,nofollow">
<META http-equiv="cache-control" content="no-cache">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
<title>'. $title .'</title>
<!--mstheme--><link rel="stylesheet" href="sono1011-1250.css">
<meta name="Microsoft Theme" content="sonora 1011">
</head><body>
<form action="chpass.php" method="post">
<p align="center">&nbsp;</p>
<p align="center"><b><font size="5" color="#FFFF00">'.$chpass.'</font></b></p>
<div align="center">
	<p align="center">&nbsp;</p>
	<table border="0" width="50%">
		<tr>
			<td>'.$newpass.'</td>
			<td><input type="password" name="pass" size="20"></td>
		</tr>
		<tr>
			<td>'.$newpass2.'</td>
			<td><input type="password" name="pass2" size="20"></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" value="'.$submit.'" name="ok"></td>
		</tr>
	</table>
</div></form></body></html>';

if (isset($_POST["ok"])) {
	if (($_POST["pass"] == null) or ($_POST["pass2"] == null) or ($_POST["pass"] != $_POST["pass2"])) {
		$conn->close();
		header('Location: notes.php');
		die();
	}
	
	$sql3 = "SELECT * FROM `users` WHERE `users`.`id` = ". $_SESSION["id"];
	$result3 = $conn->query($sql3);
	$query = $result3->fetch_assoc();
	
	$hash = sha1($query["salt2"] . $query["name"] . $_POST["pass"] . $query["name"] . $query["salt"]);

	$sql2 = "UPDATE `users` SET `pass` = '". $hash ."' WHERE `users`.`id` = ". $_SESSION["id"];
	$result2 = $conn->query($sql2);
	$conn->close();
	header('Location: users.php');
}
?>