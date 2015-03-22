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
    die("<h2>Error while conecting to MySQL. Check config.php or contact administrator.</h2>");
}

$sqlspg = "SELECT * FROM `settings`";
$resspg = $conn->query($sqlspg);
if ($resspg->num_rows > 0) {
	$i = 1;
	while($rowspg = $resspg->fetch_assoc()) {
		switch ($i) {
			case 1:
				$backgrnd = $rowspg["value"];
				break;
			case 2:
				$date = $rowspg["value"];
				break;
			case 3:
				$field = $rowspg["value"];
				break;
			case 4:	
				$name = $rowspg["value"];
				break;
			case 5:	
				$text = $rowspg["value"];
				break;
			case 6:	
				$title = $rowspg["value"];
				break;
			case 7:	
				$links = $rowspg["value"];
				break;
		}
		$i = $i + 1;
	}
}

require_once "lang.php";

?>