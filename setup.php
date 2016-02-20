<?php

require 'config.php';
require 'funct.php';
checklogin("yes");
if ($_SESSION["id"] != 1) {
	header('Location: index.php');
	die();
}
$install = file_exists("./install/");
if ($install === TRUE) {
	$install = "<span style=\"background-color:yellow;color:red\">" . $exists . "</span>";
} else {
	$install = $notexists;
}
if ($requirehttps == 1) {
	$requirehttps = "checked";
} else {
	$requirehttps = null;
}
if ($extsec == 1) {
	$extsec = "checked";
} else {
	$extsec = null;
}
templ();
echo '<form action="setup.php" method="post"><br>
<p class="center" style="font-size:24px;"><strong>'.$sysconf.'</strong></p>
<div align="center"><br>
	<table style="border:0px; width=50%; font-size:15px;">
		<tr>
			<td>'.$nsver.'</td>
			<td>v1.7.2</td>
		</tr>
		<tr>
			<td>'.$instexistch.'</td>
			<td>'.$install.'</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>'.$title2.'</td>
			<td><input type="text" name="title" size="20" value="'. $title .'"></td>
		</tr>
		<tr>
			<td>'.$heading.'</td>
			<td><input type="text" name="heading" size="20" value="'. $name .'"></td>
		</tr>
		<tr>
			<td>'.$navcol.'</td>
			<td><input type="text" name="navcol" size="20" value="'. $navcolor .'"></td>
		</tr>
		<tr>
			<td>'.$textnavcol.'</td>
			<td><input type="text" name="textnavcol" size="20" value="'. $textnavcolor .'"></td>
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
			<td>'.$reqhttps.'</td>
			<td><input type="checkbox" name="httpsredir" '. $requirehttps .'></td>
		</tr>
		<tr>
			<td>'.$extendsecurity.'</td>
			<td><input type="checkbox" name="extsec" '. $extsec .'></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" value="'.$submit.'" name="ok"></td>
		</tr>
	</table>
</div></form>';
footer();
if (isset($_POST["ok"])) {
	if (($_POST["title"] == null) or ($_POST["heading"] == null) or ($_POST["txtcol"] == null) or ($_POST["bckcol"] == null) or ($_POST["date"] == null) or ($_POST["field"] == null) or ($_POST["links"] == null) or ($_POST["navcol"] == null) or ($_POST["textnavcol"] == null)) {
		header('Location: setup.php');
		die();
	} else {
	if (santise($_POST["httpsredir"]) == "on") {
		$httpsredir = 1;
	} else {
		$httpsredir = 0;
	}
	if (santise($_POST["extsec"]) == "on") {
		$extsec = 1;
	} else {
		$extsec = 0;
	}
	$sql2 = "UPDATE `settings` SET `value` = '". santise($_POST["bckcol"]) ."' WHERE `settings`.`id` = 'backgrnd'";
	$sql3 = "UPDATE `settings` SET `value` = '". santise($_POST["date"]) ."' WHERE `settings`.`id` = 'date'";
	$sql4 = "UPDATE `settings` SET `value` = '". santise($_POST["field"]) ."' WHERE `settings`.`id` = 'field'";
	$sql5 = "UPDATE `settings` SET `value` = '". santise($_POST["heading"]) ."' WHERE `settings`.`id` = 'name'";
	$sql6 = "UPDATE `settings` SET `value` = '". santise($_POST["txtcol"]) ."' WHERE `settings`.`id` = 'text'";
	$sql7 = "UPDATE `settings` SET `value` = '". santise($_POST["title"]) ."' WHERE `settings`.`id` = 'title'";
	$sql8 = "UPDATE `settings` SET `value` = '". santise($_POST["links"]) ."' WHERE `settings`.`id` = 'zlinks'";
	$sql9 = "UPDATE `settings` SET `value` = '". santise($_POST["navcol"]) ."' WHERE `settings`.`id` = 'navcol'";
	$sqlA = "UPDATE `settings` SET `value` = '". santise($_POST["textnavcol"]) ."' WHERE `settings`.`id` = 'textnavcol'";
	$sqlB = "UPDATE `settings` SET `value` = '". $httpsredir ."' WHERE `settings`.`id` = 'httpsredir'";
	$sqlC = "UPDATE `settings` SET `value` = '". $extsec ."' WHERE `settings`.`id` = 'extsec'";
	$result2 = $conn->query($sql2);
	$result3 = $conn->query($sql3);
	$result4 = $conn->query($sql4);
	$result5 = $conn->query($sql5);
	$result6 = $conn->query($sql6);
	$result7 = $conn->query($sql7);
	$result8 = $conn->query($sql8);
	$result9 = $conn->query($sql9);
	$resultA = $conn->query($sqlA);
	$resultB = $conn->query($sqlB);
	$resultC = $conn->query($sqlC);
	}
	$conn->close();
	header('Location: setup.php');
}
?>
