<?php

// BEGIN OF CONFIGURATION - DO NOT CHANGE ANYTHING ABOVE

// language (en,cz)
$lng = "cz";

// MySQL
$host = "localhost";
$user = "";
$pass = "";
$database = "";

// END OF CONFIGURATION - DO NOT CHANGE ANYTHING BELOW

$conn = new mysqli($host, $user, $pass, $database);

if ($conn->connect_error) {
    die("<h2>Error while conecting to MySQL. Check your config.php or try again later</h2>");
}

$sqlspg = "SELECT * FROM `settings`";
$resspg = $conn->query($sqlspg);

if ($resspg->num_rows == 0) {
	die("<h2>NoteSys is not installed! <a href=\"./install\">Install now</a>");
}
while ($row = mysqli_fetch_array($resspg)){
    $column[] = $row[1];
}

$backgrnd = $column[0];
$date = $column[1];
$field = $column[2];
$name = $column[3];
$text = $column[4];
$title = $column[5];
$links = $column[6];

require_once "lang.php";

?>