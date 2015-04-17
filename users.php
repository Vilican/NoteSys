<?php
require 'config.php';
require 'funct.php';
checklogin("yes");
if ($_SESSION["id"] != 1) {
	header('Location: index.php');
	die();
}
$sql = "SELECT * FROM `users`";
$result = $conn->query($sql);
templ();
echo '<br><br>';
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
		$access = "editor - ERROR";
		break;
	}
	if ($row["id"] == 1) {
		$access = $su;
	}
    echo "<p class='center'>". $row["name"]. "&nbsp;(". $access .")&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='newpass.php?id=". $row["id"]. "'>".$resetpass."</a>&nbsp;&nbsp;<a href='accessswitch.php?id=". $row["id"]. "'>".$rights."</a>&nbsp;&nbsp;<a href='deluser.php?id=". $row["id"]. "'>".$delete."</a></p>";
}
$conn->close();
footer();
?>