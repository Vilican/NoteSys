<?php

require 'config.php';
require 'funct.php';
checklogin("yes");
if ($_SESSION["id"] != 1) {
	header('Location: index.php');
	die();
}
templ();
echo '<form action="setup.php" method="post"><br>
<p class="center" style="font-size:24px;"><strong>'.$sysconf.'</strong></p>
<div align="center"><br>
	<table style="border:0px; width=50%; font-size:15px;">
		<tr>
			<td>'.$title2.'</td>
			<td><input type="text" name="title" size="20" value="'. $title .'"></td>
		</tr>
		<tr>
			<td>'.$heading.'</td>
			<td><input type="text" name="heading" size="20" value="'. $name .'"></td>
		</tr>
		<tr>
			<td>'.$textcol.'</td>
			<td><input type="text" name="txtcol" size="20" value="'. $text .'"></td>
		</tr>
		<tr>
			<td>'.$bckgrndcol.'</td>
			<td><input type="text" name="bckcol" size="20" value="'. $backgrnd .'"></td>
		</tr>
		<tr>
			<td>'.$linkscol.'</td>
			<td><input type="text" name="links" size="20" value="'. $links .'"></td>
		</tr>
		<tr>
			<td>'.$dtname.'</td>
			<td><input type="text" name="date" size="20" value="'. $date .'"></td>
		</tr>
		<tr>
			<td>'.$entryname.'</td>
			<td><input type="text" name="field" size="20" value="'. $field .'"></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" value="'.$submit.'" name="ok"></td>
		</tr>
	</table>
</div></form>';
footer();
if (isset($_POST["ok"])) {
	if (($_POST["title"] == null) or ($_POST["heading"] == null) or ($_POST["txtcol"] == null) or ($_POST["bckcol"] == null) or ($_POST["date"] == null) or ($_POST["field"] == null) or ($_POST["links"] == null)) {
		header('Location: index.php');
		die();
	} else {
	$sql2 = "UPDATE `settings` SET `value` = '". $_POST["bckcol"] ."' WHERE `settings`.`id` = 'backgrnd'";
	$sql3 = "UPDATE `settings` SET `value` = '". $_POST["date"] ."' WHERE `settings`.`id` = 'date'";
	$sql4 = "UPDATE `settings` SET `value` = '". $_POST["field"] ."' WHERE `settings`.`id` = 'field'";
	$sql5 = "UPDATE `settings` SET `value` = '". $_POST["heading"] ."' WHERE `settings`.`id` = 'name'";
	$sql6 = "UPDATE `settings` SET `value` = '". $_POST["txtcol"] ."' WHERE `settings`.`id` = 'text'";
	$sql7 = "UPDATE `settings` SET `value` = '". $_POST["title"] ."' WHERE `settings`.`id` = 'title'";
	$sql8 = "UPDATE `settings` SET `value` = '". $_POST["links"] ."' WHERE `settings`.`id` = 'zlinks'";
	$result2 = $conn->query($sql2);
	$result3 = $conn->query($sql3);
	$result4 = $conn->query($sql4);
	$result5 = $conn->query($sql5);
	$result6 = $conn->query($sql6);
	$result7 = $conn->query($sql7);
	$result8 = $conn->query($sql8);
	}
	$conn->close();
	header('Location: index.php');
}
?>