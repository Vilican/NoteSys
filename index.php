<?php

require 'config.php';

echo '<p id="title">'. $name .'</p><a href="logout.php"><a href="login.php">'. $login .'</a><!doctype html><html><head>
<meta name="generator" content="NoteSys">
<META http-equiv="cache-control" content="no-cache">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
<title>'.$title.'</title>
<!--mstheme--><link rel="stylesheet" href="sono1011-1250.css">
<style>body{color:'. $text .';background-color:'. $backgrnd .';}a{color:'. $links .';}</style>
<meta name="Microsoft Theme" content="sonora 1011">
</head><body><p align="left"></p><p align="center">&nbsp;</p>';

$sql = "SELECT * FROM `entries` ORDER BY `date` DESC";
$result = $conn->query($sql);
$field2 = $field;
$date2 = $date;
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<p align='center'>". $date2 . " " . date('d.m.Y', $row["date"]). "</p><p align='center'>". $field2 . " " . $row["value"]. "</p><br>";
    }
} else {
    echo "<p align='center'>". $noetries ."</p>";
}
$conn->close();

echo '<p id="copyright">Powered by <a href="https://notesys.sufix.cz">NoteSys</a></p></body></html>';

?>