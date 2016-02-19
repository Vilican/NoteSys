<?php
function templ() {
require 'config.php';
require 'lang.php';
session_start();
echo '<!DOCTYPE html><html><head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
<link href="css.css" rel="stylesheet">
<meta name="generator" content="NoteSys">
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>'.$title.'</title>
<style>input,select,textarea{color:black}body{color:'. $text .';background-color:'. $backgrnd .';}a,a:hover,a:visited,a:active{color:'. $links .';}.navbar{background-color:'. $navcolor .';color:'. $textnavcolor .'}</style>
</head><body>
<div class="navbar">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-warning-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
	  <a class="navbar-brand" href="index.php" style="font-weight:bold;">'. $name .'</a>
    </div>
    <div class="navbar-collapse collapse navbar-warning-collapse">
      <ul class="nav navbar-nav navbar-right">';
if($_SESSION["id"] == null) {
	echo '<li class="withripple"><a href="login.php">'. $login .'</li></a>';
	} else {
	echo '<li class="withripple"><a href="logout.php">'. $logout .'</li></a><li class="withripple"><a href="index.php">'. $notes .'</li></a><li class="withripple"><a href="addnote.php">'. $addnote .'</li></a>';

if ($_SESSION["id"] == 1) {
	echo '<li class="withripple"><a href="users.php">'. $users .'</li></a><li class="withripple"><a href="adduser.php">'. $newuser .'</li></a><li class="withripple"><a href="setup.php">'. $sysconf .'</li></a>';
	} else {
	echo '<li class="withripple"><a href="chpass.php">'. $chpass .'</li></a>'; }}
echo "</ul></div></div></div>";
}
function footer() {
echo '<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="js.js"></script><script>$.material.init();</script>
<p id="copyright">Powered by <a href="https://notesys.sufix.cz">NoteSys</a></p></body></html>';	
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