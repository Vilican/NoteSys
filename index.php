<?php
require "config.php";
require_once "funct.php";
templ();
checklogin("no");
echo "<br><br>";
$sql = "SELECT * FROM `entries` ORDER BY `date` DESC";
$result = $conn->query($sql);
$field2 = $field;
$date2 = $date;
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        if (($row["autor"] == $_SESSION["id"]) or ($_SESSION["id"] == 1) or ($_SESSION["isadmin"] == 1)) {
			echo "<p class='center'><a href='delete.php?id=". $row["id"] ."'>". $delete ."</a> - <a href='edit.php?id=". $row["id"] ."'>". $edit ."</a></p><p class='center'>". $date2 . " " . date('d.m.Y', $row["date"]). "</p><p class='center'>". $field2 . " " . $row["value"]. "</p><br>";
		} else {
			echo "<p class='center'>". $date2 . " " . date('d.m.Y', $row["date"]). "</p><p class='center'>". $field2 . " " . $row["value"]. "</p><br>";
		}
	}
} else {
    echo "<p class='center'>".$noetries."</p>";
}
$conn->close();
footer();
?>
