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
templ();
echo '<form action="newpass.php?id='. $_GET["id"] .'" method="post"><br>
<p class="center" style="font-size:24px;"><strong>'.$resetpass.'</strong></p>
<div align="center"><br>
	<table style="border:0px; width=50%; font-size:15px;">
		<tr>
			<td>'.$newpass.'</td>
			<td><input type="text" name="pass" size="20"></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" value="'.$submit.'" name="ok"></td>
		</tr>
	</table>
</div></form>';
footer();
if (isset($_POST["ok"])) {
	if ($_POST["pass"] == null) {
		$conn->close();
		header('Location: users.php');
		die();
	}
	$sql3 = "SELECT * FROM `users` WHERE `users`.`id` = ". $_GET["id"];
	$result3 = $conn->query($sql3);
	$query = $result3->fetch_assoc();
	$hash = sha1($query["salt2"] . $query["name"] . $_POST["pass"] . $query["name"] . $query["salt"]);
	$sql2 = "UPDATE `users` SET `pass` = '". $hash ."' WHERE `users`.`id` = ". $_GET["id"];
	$result2 = $conn->query($sql2);
	$conn->close();
	header('Location: users.php');
}
?>