<?php
require 'config.php';
require_once 'funct.php';
checklogin("yes");
templ();
echo '<form action="chpass.php" method="post"><br>
<p class="center" style="font-size:24px;"><strong>'.$chpass.'</strong></p>
<div align="center"><br>
	<table style="border:0px; width=30%; font-size:15px;">
		<tr>
			<td>'.$newpass.'</td>
			<td><input type="password" name="pass" size="20"></td>
		</tr>
		<tr>
			<td>'.$newpass2.'</td>
			<td><input type="password" name="pass2" size="20"></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" value="'.$submit.'" name="ok"></td>
		</tr>
	</table>
</div></form>';
footer();
if (isset($_POST["ok"])) {
	if (($_POST["pass"] == null) or ($_POST["pass2"] == null) or ($_POST["pass"] != $_POST["pass2"])) {
		$conn->close();
		header('Location: index.php');
		die();
	}
	$sql3 = "SELECT * FROM `users` WHERE `users`.`id` = ". $_SESSION["id"];
	$result3 = $conn->query($sql3);
	$query = $result3->fetch_assoc();
	$hash = sha1($query["salt2"] . $query["name"] . $_POST["pass"] . $query["name"] . $query["salt"]);
	$sql2 = "UPDATE `users` SET `pass` = '". $hash ."' WHERE `users`.`id` = ". $_SESSION["id"];
	$result2 = $conn->query($sql2);
	$conn->close();
	header('Location: index.php');
}
?>