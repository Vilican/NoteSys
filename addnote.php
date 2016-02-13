<?php
require 'config.php';
require_once 'funct.php';
checklogin("yes");
if (isset($_GET["1"])) {
	$err = $blankp . "<br><br>";
}
$sqlid = "SELECT * FROM `lastid` WHERE `type` = 'notes'";
$resultid = $conn->query($sqlid);
$valid = $resultid->fetch_assoc();
$newid = $valid["lastid"] + 1;
templ();
echo '<form action="addnote.php" method="post"><br>
<p class="center" style="font-size:24px;"><strong>'.$addnote.'</strong></p>
<div align="center"><br>'. $err .'
	<table style="border:0px; width=50%; font-size:15px;">
		<tr>
			<td>'.$date.'</td>
			<td><input type="text" name="date" size="20"></td>
		</tr>
		<tr>
			<td>'.$field.'</td>
			<td><input type="text" name="value" size="50"></td>
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
		header('Location: addnote.php?1');
		die();
	} else {
	$sql2 = "INSERT INTO `entries` (`id`, `date`, `value`, `autor`) VALUES ('".$newid."', '". santise(strtotime($_POST["date"])) ."', '". santise($_POST["value"]) ."', '".$_SESSION["id"]."')";
	$result2 = $conn->query($sql2);
	$sqlupid = "UPDATE `lastid` SET `lastid` = '". $newid ."' WHERE `lastid`.`type` = 'notes'";
	$resultupid = $conn->query($sqlupid);
	$conn->close();
	header('Location: index.php');
	}
}
?>
