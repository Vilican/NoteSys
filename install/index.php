<?php

require '../config.php';

echo '<!doctype html><html><head>
<meta name="generator" content="NoteSys">
<META http-equiv="cache-control" content="no-cache">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
<title>'.$title.'</title>
<!--mstheme--><link rel="stylesheet" href="../sono1011-1250.css">
<style>body{color:#FFFFFF;background-color:#D07000;}</style><meta name="Microsoft Theme" content="sonora 1011">
</head><body><p align="left"></p><p align="center">&nbsp;</p><br>
<p align="center"><font size="5" color="#FFFF00">'. $inst_welcome .'</font></b></p>
<p align="center"><font size="3" color="#FFFF00">'. $inst_instruct .'</font></b></p><br>
<p align="center"><form action="index.php" method="post" align="center"><input type="submit" name="ok" value="'.$do_install.'" align="center"></form></p>
<p id="copyright">Powered by <a href="https://notesys.sufix.cz">NoteSys</a></p></body></html>';

if (isset($_POST["ok"])) {
$sql='CREATE TABLE IF NOT EXISTS `entries` (`id` int(11), PRIMARY KEY (`id`),`date` varchar(10) NOT NULL,`value` varchar(100) NOT NULL,`autor` int(11) NOT NULL) DEFAULT CHARSET=utf8;';
$sql2="CREATE TABLE IF NOT EXISTS `lastid` (`type` varchar(10), PRIMARY KEY (`type`),`lastid` int(11) NOT NULL) DEFAULT CHARSET=utf8;";
$sql3="INSERT INTO `lastid` (`type`, `lastid`) VALUES ('notes', 0), ('users', 0);";
$salt = substr( "abcvwxdefghiLMNOPQjkuyzADEFBCGHIJKlmnopqrstRSTUVWXYZ" ,mt_rand( 0 ,50 ) ,1 ) .substr( md5( time() ), 1);
$salt2 = substr( "STUVabdefghiLMNOPQjkuyzADEFcvwxBCGqHIJKlmnoprstRWXYZ" ,mt_rand( 0 ,50 ) ,1 ) .substr( md5( time() ), 1);
$hash = sha1($salt2 . "admin" . null . "admin" . $salt);
$sql4="CREATE TABLE IF NOT EXISTS `users` (`id` int(11) NOT NULL, PRIMARY KEY (`id`),`name` varchar(20) NOT NULL,`pass` varchar(50) NOT NULL,`salt` varchar(50) NOT NULL,`salt2` varchar(50) NOT NULL, `admin` int(1) NOT NULL) DEFAULT CHARSET=utf8;";
$sql5="INSERT INTO `users` (`id`, `name`, `pass`, `salt`, `salt2`, `admin`) VALUES (0, 'admin', '". $hash ."', '". $salt ."', '". $salt2 ."', 1);";
$sql6="CREATE TABLE IF NOT EXISTS `settings` (`id` varchar(15) NOT NULL, PRIMARY KEY (`id`),`value` varchar(30) NOT NULL) DEFAULT CHARSET=utf8;";
$sql7="INSERT INTO `settings` (`id`, `value`) VALUES ('title', 'NoteSys');";
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
$sql8="INSERT INTO `settings` (`id`, `value`) VALUES ('field', '". $field ."');";
$sql9="INSERT INTO `settings` (`id`, `value`) VALUES ('date', '". $date ."');";
$sql10="INSERT INTO `settings` (`id`, `value`) VALUES ('name', 'NoteSys');";
$sql11="INSERT INTO `settings` (`id`, `value`) VALUES ('text', 'FFFFFF');";
$sql12="INSERT INTO `settings` (`id`, `value`) VALUES ('backgrnd', 'D07000');";
$sql13="INSERT INTO `settings` (`id`, `value`) VALUES ('zlinks', 'C6E33A');";
$ok = 1;
if ($conn->query($sql) === TRUE) {} else { echo "ERROR: " . $conn->error. "<br>"; $ok = 0;}
if ($conn->query($sql2) === TRUE) {} else { echo "ERROR: " . $conn->error. "<br>"; $ok = 0;}
if ($conn->query($sql3) === TRUE) {} else { echo "ERROR: " . $conn->error. "<br>"; $ok = 0;}
if ($conn->query($sql4) === TRUE) {} else { echo "ERROR: " . $conn->error. "<br>"; $ok = 0;}
if ($conn->query($sql5) === TRUE) {} else { echo "ERROR: " . $conn->error. "<br>"; $ok = 0;}
if ($conn->query($sql6) === TRUE) {} else { echo "ERROR: " . $conn->error. "<br>"; $ok = 0;}
if ($conn->query($sql7) === TRUE) {} else { echo "ERROR: " . $conn->error. "<br>"; $ok = 0;}
if ($conn->query($sql8) === TRUE) {} else { echo "ERROR: " . $conn->error. "<br>"; $ok = 0;}
if ($conn->query($sql9) === TRUE) {} else { echo "ERROR: " . $conn->error. "<br>"; $ok = 0;}
if ($conn->query($sql10) === TRUE) {} else { echo "ERROR: " . $conn->error. "<br>"; $ok = 0;}
if ($conn->query($sql11) === TRUE) {} else { echo "ERROR: " . $conn->error. "<br>"; $ok = 0;}
if ($conn->query($sql12) === TRUE) {} else { echo "ERROR: " . $conn->error. "<br>"; $ok = 0;}
if ($conn->query($sql13) === TRUE) {} else { echo "ERROR: " . $conn->error. "<br>"; $ok = 0;}
if ($ok == 1) {echo "<p align='center'>". $installed ."</p>";}
$conn->close();
}
?>