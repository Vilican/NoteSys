<?php

require 'config.php';
require 'checklogin.php';

echo '<p id="title">'. $name .'</p><a href="logout.php">'.$logout.'</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="addnote.php">'.$addnote.'</a>';
if ($_SESSION["id"] == 0) { echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="users.php">'.$users.'</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="setup.php">'.$sysconf.'</a>'; } else { echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="chpass.php">'.$chpass.'</a>'; }
echo '<!doctype html><html><head>
<meta name="generator" content="NoteSys">
<meta name="robots" content="noindex,nofollow">
<META http-equiv="cache-control" content="no-cache">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
<title>'. $title .'</title>
<!--mstheme--><link rel="stylesheet" href="sono1011-1250.css">
<style>body{color:'. $text .';background-color:'. $backgrnd .';}a{color:'. $links .';}</style>
<meta name="Microsoft Theme" content="sonora 1011">
</head>
<body>
<p align="center">&nbsp;</p>';

$sql = "SELECT * FROM `entries` ORDER BY `date` DESC";
$result = $conn->query($sql);
$field2 = $field;
$date2 = $date;
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        if (($row["autor"] == $_SESSION["id"]) or ($_SESSION["id"] == 0) or ($isadmin == 1)) {
			echo "<p align='center'><a href='delete.php?id=". $row["id"] ."'>". $delete ."</a> - <a href='edit.php?id=". $row["id"] ."'>". $edit ."</a></p><p align='center'>". $date2 . " " . date('d.m.Y', $row["date"]). "</p><p align='center'>". $field2 . " " . $row["value"]. "</p><br>";
		} else {
			echo "<p align='center'>". $date2 . " " . date('d.m.Y', $row["date"]). "</p><p align='center'>". $field2 . " " . $row["value"]. "</p><br>";
		}
	}
} else {
    echo "<p align='center'>".$noetries."</p>";
}
$conn->close();

echo '<p id="copyright">Powered by <a href="https://notesys.sufix.cz">NoteSys</a></p></body></html>';
?>