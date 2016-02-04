<?php
require 'config.php';
require 'funct.php';
checklogin("yes");
if ($_GET["id"] == null) {
	header('Location: index.php');
	die();
}
$sql = "SELECT * FROM `entries` WHERE `entries`.`id` = ". santise($_GET["id"]);
$result = $conn->query($sql);
$val = $result->fetch_assoc();
if (($val["autor"] == $_SESSION["id"]) or ($_SESSION["id"] == 1) or ($_SESSION["isadmin"] == 1)) {
templ();
echo '<form action="edit.php?id='. santise($_GET["id"]) .'" method="post"><br>
<p class="center" style="font-size:24px;"><strong>'.$editnote.'</strong></p>
<div align="center"><br>
	<table style="border:0px; width=50%; font-size:15px;">
		<tr>
			<td>'.$date.'</td>
			<td><input type="text" name="date" value="' . date('d.m.Y', $val["date"]) . '" size="20"></td>
		</tr>
		<tr>
			<td>'.$field.'</td>
			<td><input type="text" name="value" value="' . $val["value"] . '" size="50"></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" value="'. $submit .'" name="ok"></td>
		</tr>
	</table>
</div></form>';
footer();
if (isset($_POST["ok"])) {
	if (($_POST["date"] == null) or ($_POST["value"] == null)) {
		header('Location: index.php');
		die();
	} else {
	$sql2 = "UPDATE `entries` SET `date` = '" . santise(strtotime($_POST["date"])) . "', `value` = '" . santise($_POST["value"]) . "' WHERE `entries`.`id` = " . santise($_GET["id"]);
	$result2 = $conn->query($sql2);
	}
	$conn->close();
	header('Location: index.php');
}
}
?>