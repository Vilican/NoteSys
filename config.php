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
$requirehttps = $settings["httpsredir"];
$extsec = $settings["extsec"];

if ($extsec == 1) {
	header('X-XSS-Protection: 1; mode=block', true);
	header('X-Content-Type-Options: nosniff', true);
}

if ($requirehttps == 1 and INSTALL != 1) {
	if(!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == ""){
		$redirect = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		header("HTTP/1.1 301 Moved Permanently");
		header("Location: $redirect");
	}
}

require_once "lang.php";

?>