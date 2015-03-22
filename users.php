<?php

require 'config.php';
require 'checklogin.php';

if ($_SESSION["id"] != 0) {
	die("<h2>Přístup odepřen!</h2>");
}

$sql = "SELECT * FROM `users`";
$result = $conn->query($sql);

echo '<a href="logout.php">'.$logout.'</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="newuser.php">'.$newuser.'</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="notes.php">'.$goback.'</a><!doctype html><html><head>
<meta name="generator" content="NoteSys">
<META http-equiv="cache-control" content="no-cache">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
<title>'.$title.'</title>
<!--mstheme--><link rel="stylesheet" href="sono1011-1250.css">
<meta name="Microsoft Theme" content="sonora 1011">
</head><body><p align="left"></p><p align="center">&nbsp;</p>';

while($row = $result->fetch_assoc()) {
	$access = "undefined";
	switch ($row["admin"]) {
	case 0:
		$access = "editor";
		break;
	case 1:
		$access = "admin";
		break;
	default:
		$conn->close();
		header('Location: users.php');
		die("<h2>Internal database error</2>");
		break;
	}
    echo "<p align='center'>". $row["name"]. "&nbsp;(". $access .")&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='newpass.php?id=". $row["id"]. "'>".$resetpass."</a>&nbsp;&nbsp;<a href='accessswitch.php?id=". $row["id"]. "'>".$rights."</a>&nbsp;&nbsp;<a href='deluser.php?id=". $row["id"]. "'>".$delete."</a></p>";
}

$conn->close();
echo '<p id="copyright">Powered by <a href="https://notesys.sufix.cz">NoteSys</a></p></body></html>';
?>