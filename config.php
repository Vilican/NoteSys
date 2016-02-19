<?php

// BEGIN OF CONFIGURATION - DO NOT CHANGE ANYTHING ABOVE

// language (en,cz)
$lng = "en";

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
	if(INSTALL != 1) {
		die("<h2>NoteSys is not installed! <a href=\"./install\">Install now</a>");
	}
}
while ($row = mysqli_fetch_array($resspg)){
	$settings[$row["id"]] = $row["value"];
}

$backgrnd = $settings["backgrnd"];
$date = $settings["date"];
$field = $settings["field"];
$name = $settings["name"];
$text = $settings["text"];
$title = $settings["title"];
$links = $settings["zlinks"];
$navcolor = $settings["navcol"];
$textnavcolor = $settings["textnavcol"];

require_once "lang.php";

?>