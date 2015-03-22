<?php

require 'config.php';
require 'checklogin.php';

$sqlid = "SELECT * FROM `lastid` WHERE `type` = 'users'";
$resultid = $conn->query($sqlid);
$valid = $resultid->fetch_assoc();
$newid = $valid["lastid"] + 1;

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
<form action="newuser.php" method="post">
<p align="center">&nbsp;</p>
<p align="center"><b><font size="5">'. $newuser .'</font></b></p>
<div align="center">
	<p align="center">&nbsp;</p>
	<table border="0" width="50%">
		<tr>
			<td>'.$user.'</td>
			<td><input type="text" name="user" size="20"></td>
		</tr>
		<tr>
			<td>'.$password.'</td>
			<td><input type="text" name="pass" size="50"></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" value="'.$submit.'" name="ok"></td>
		</tr>
	</table>
</div></form></body></html>';

if (isset($_POST["ok"])) {
	if (($_POST["pass"] == null) or ($_POST["user"] == null)) {
		$conn->close();
		header('Location: users.php');
		die();
	}
	
	$salt = substr( "abcvwxdefghiLMNOPQjkuyzADEFBCGHIJKlmnopqrstRSTUVWXYZ" ,mt_rand( 0 ,50 ) ,1 ) .substr( md5( time() ), 1);
	$salt2 = substr( "STUVabdefghiLMNOPQjkuyzADEFcvwxBCGqHIJKlmnoprstRWXYZ" ,mt_rand( 0 ,50 ) ,1 ) .substr( md5( time() ), 1);
	$hash = sha1($salt2 . $_POST["user"] . $_POST["pass"] . $_POST["user"] . $salt);
	$sql2 = "INSERT INTO `users` (`id`, `name`, `pass`, `salt`, `salt2`) VALUES ('". $newid ."', '". $_POST["user"] ."', '". $hash ."', '". $salt ."', '". $salt2 ."')";
	$result2 = $conn->query($sql2);
	$sqlupid = "UPDATE `lastid` SET `lastid` = '". $newid ."' WHERE `lastid`.`type` = 'users'";
	$resultupid = $conn->query($sqlupid);
	$conn->close();
	header('Location: users.php');
}
?>