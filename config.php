<?php

// language (supported: en,cz)
$lng = "en";

// tilte of pages
$title = "NoteSys";

// field labels
$field = "Entry:";
$date = "Date:";

// MySQL connection
$host = "localhost";
$user = "";
$pass = "";
$database = "";

// END OF CONFIGURATION

$conn = new mysqli($host, $user, $pass, $database);

if ($conn->connect_error) {
    die("<h2>Error while conecting to MySQL. Check config.php or contact administrator.</h2>");
}

require "lang.php";

?>