<?php
require 'config.php';
require 'funct.php';
checklogin("yes");
if ($_SESSION["id"] != 1) {
	header('Location: index.php');
	die();
}
if ($_GET["id"] == null) {
	header('Location: users.php');
	die();
}
if (isset($_GET["1"])) {
	$dupe = $duplicate . "<br><br>";
} else {
	$dupe = $rp . "<br><br>";
}
$sql3 = "SELECT * FROM `users` WHERE `users`.`id` = ". santise($_GET["id"]);
$result3 = $conn->query($sql3);
$query = $result3->fetch_assoc();
templ();
echo '<form action="rename.php?id='. santise($_GET["id"]) .'" method="post"><br>
<p class="center" style="font-size:24px;"><strong>'.$rename.'</strong></p>
<div align="center"><br>'. $dupe .'
	<table style="border:0px; width=50%; font-size:15px;">
		<tr>
			<td>'.$user.'</td>
			<td><input type="text" name="name" size="20" value="'. $query["name"] .'"></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" value="'.$submit.'" name="ok"></td>
		</tr>
	</table>
</div></form>';
footer();
if (isset($_POST["ok"])) {
	if ($_POST["name"] == null) {
		$conn->close();
		header('Location: rename.php');
		die();
	}
	$sqldupe = "SELECT * FROM `users` WHERE `name` = '". santise($_POST["name"]) ."'";
	$resultdupe = $conn->query($sqldupe);
	if ($resultdupe->num_rows > 0) {
		header('Location: rename.php?1&id=' . santise($_GET["id"]));
		die();
	}
	$sql2 = "UPDATE `users` SET `name` = '". santise($_POST["name"]) ."' WHERE `users`.`id` = ". santise($_GET["id"]);
	$result2 = $conn->query($sql2);
	$hash = sha1($query["salt2"] . santise($_POST["name"]) . santise($_POST["name"]) . $query["salt"]);
	$sql5 = "UPDATE `users` SET `pass` = '". $hash ."' WHERE `users`.`id` = ". santise($_GET["id"]);
	$result5 = $conn->query($sql5);
	$conn->close();
	header('Location: users.php');
}
?>