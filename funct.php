<?php
function templ() {
require 'config.php';
require 'lang.php';
session_start();
echo '<!doctype html>
<html><head>
<meta name="generator" content="NoteSys">
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>'.$title.'</title>
<link rel="stylesheet" href="style.css">
<style>body{color:'. $text .';background-color:'. $backgrnd .';}a{color:'. $links .';}</style>
</head><body>
<p id="title">'. $name .'</p>';
if($_SESSION["id"] == null) {
	echo '<div id="menu"><a href="login.php">'. $login .'</a></div>';
	} else {
	echo '<div id="menu"><a href="logout.php">'.$logout.'</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="index.php">'.$notes.'</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="addnote.php">'.$addnote.'</a>';

if ($_SESSION["id"] == 1) {
	echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="users.php">'.$users.'</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="adduser.php">'.$newuser.'</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="setup.php">'.$sysconf.'</a></div>';
	} else {
	echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="chpass.php">'.$chpass.'</a></div>'; }}
}
function footer() {
echo '<p id="copyright">Powered by <a href="https://notesys.sufix.cz">NoteSys</a></p></body></html>';	
}
function checklogin($require){
require 'config.php';
require 'lang.php';
session_start();
$sql_login = "SELECT * FROM `users` WHERE id = '". $_SESSION["id"] ."'";
$result_login = $conn->query($sql_login);
$userrow = $result_login->fetch_assoc();
if (sha1($userrow["pass"] . $userrow["name"]) != $_SESSION["hash"]) {
	if ($require == "no") {
	session_unset();
	session_destroy();		
	} else {
	session_unset();
	session_destroy();
	header('Location: login.php');
	die();
	}
}
$_SESSION["isadmin"] = "0";
$_SESSION["isadmin"] = $userrow["admin"];
}
function santise($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
function slow_equals($a, $b) {
	$diff = strlen($a) ^ strlen($b);
	for($i = 0; $i < strlen($a) && $i < strlen($b); $i++) {
		$diff |= ord($a[$i]) ^ ord($b[$i]);
	}
	return $diff === 0;
}
?>