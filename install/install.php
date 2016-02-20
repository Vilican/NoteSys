<?php

DEFINE("INSTALL", 1);
require "../config.php";

echo '<!doctype html><html><head>
<meta name="generator" content="NoteSys">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>NoteSys Installer</title>
<link rel="stylesheet" href="../css.css">
<style>body{color:white;background-color:green}</style>
</head><body><br><br>
<p class="center" style="color:#FFFF00 !important; font-size:25px !important">'. $inst_welcome .'</p>
<p class="center" style="color:#FFFF00 !important; font-size:16px !important">'. $inst_instruct .'</p><br>
<form class="center" action="install.php" method="post"><input type="submit" name="ok" value="'.$do_install.'" class="center"></form>
<p id="copyright">Powered by <a style="color:#FFFF00 !important;" href="https://notesys.sufix.cz">NoteSys</a></p></body></html>';

if (isset($_POST["ok"])) {
$sql='CREATE TABLE IF NOT EXISTS `entries` (`id` int(11), PRIMARY KEY (`id`),`date` varchar(10) NOT NULL,`value` varchar(100) NOT NULL,`autor` int(11) NOT NULL) DEFAULT CHARSET=utf8;';
$sql2="CREATE TABLE IF NOT EXISTS `lastid` (`type` varchar(10), PRIMARY KEY (`type`),`lastid` int(11) NOT NULL) DEFAULT CHARSET=utf8;";
$sql3="INSERT INTO `lastid` (`type`, `lastid`) VALUES ('notes', 0), ('users', 1);";
$salt = substr( "abcvwxdefghiLMNOPQjkuyzADEFBCGHIJKlmnopqrstRSTUVWXYZ" ,mt_rand( 0 ,50 ) ,1 ) .substr( md5( time() ), 1);
$salt2 = substr( "STUVabdefghiLMNOPQjkuyzADEFcvwxBCGqHIJKlmnoprstRWXYZ" ,mt_rand( 0 ,50 ) ,1 ) .substr( md5( time() ), 1);
$hash = sha1($salt2 . "adminadmin" . $salt);
$sql4="CREATE TABLE IF NOT EXISTS `users` (`id` int(11) NOT NULL, PRIMARY KEY (`id`),`name` varchar(20) NOT NULL,`pass` varchar(50) NOT NULL,`salt` varchar(50) NOT NULL,`salt2` varchar(50) NOT NULL, `admin` int(1) NOT NULL) DEFAULT CHARSET=utf8;";
$sql5="INSERT INTO `users` (`id`, `name`, `pass`, `salt`, `salt2`, `admin`) VALUES (1, 'admin', '". $hash ."', '". $salt ."', '". $salt2 ."', 1);";
$sql6="CREATE TABLE IF NOT EXISTS `settings` (`id` varchar(15) NOT NULL, PRIMARY KEY (`id`),`value` varchar(30) NOT NULL) DEFAULT CHARSET=utf8;";
switch ($lng) {
	case "cz":
		$field = "Zápis:";
		$date = "Datum:";
		break;
	case "en":
		$field = "Entry:";
		$date = "Date:";
		break;
	default:
		$field = "Entry:";
		$date = "Date:";
		break;
}
$sql7="INSERT INTO `settings` (`id`, `value`) VALUES ('backgrnd', 'lightgreen'), ('date', '". $date ."'), ('field', '". $field ."'), ('name', 'NoteSys'), ('navcol', 'green'), ('text', 'black'), ('textnavcol', 'yellow'), ('title', 'NoteSys'), ('zlinks', 'blue'), ('extsec', '0'), ('httpsredir', '0');";
$ok = 1;
if ($conn->query($sql) === TRUE) {} else { echo "ERROR: " . $conn->error. "<br>"; $ok = 0;}
if ($conn->query($sql2) === TRUE) {} else { echo "ERROR: " . $conn->error. "<br>"; $ok = 0;}
if ($conn->query($sql3) === TRUE) {} else { echo "ERROR: " . $conn->error. "<br>"; $ok = 0;}
if ($conn->query($sql4) === TRUE) {} else { echo "ERROR: " . $conn->error. "<br>"; $ok = 0;}
if ($conn->query($sql5) === TRUE) {} else { echo "ERROR: " . $conn->error. "<br>"; $ok = 0;}
if ($conn->query($sql6) === TRUE) {} else { echo "ERROR: " . $conn->error. "<br>"; $ok = 0;}
if ($conn->query($sql7) === TRUE) {} else { echo "ERROR: " . $conn->error. "<br>"; $ok = 0;}
if ($ok == 1) {echo "<p class='center'>". $installed ."</p>";}
$conn->close();
}
?>