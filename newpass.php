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
	$err = $blankp . "<br><br>";
}
templ();
echo '<form action="newpass.php?id='. santise($_GET["id"]) .'" method="post"><br>
<p class="center" style="font-size:24px;"><strong>'.$resetpass.'</strong></p>
<div align="center"><br>'. $err .'
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
		header('Location: newpass.php?1&id=' . $_GET["id"]);
		die();
	}
	$sql3 = "SELECT * FROM `users` WHERE `users`.`id` = ". santise($_GET["id"]);
	$result3 = $conn->query($sql3);
	$query = $result3->fetch_assoc();
	$salt = substr( "abwxdNOefghiLMjkEFuyzADIJKlmnopTPQUqrstRSVBCcvGHWXYZ" ,mt_rand( 0 ,50 ) ,1 ) .substr( md5( time() ), 1);
	$salt2 = substr( "STUVabdefghiLMNOPQjkuyzADEFcvwxBCGqHIJKlmnoprstRWXYZ" ,mt_rand( 0 ,50 ) ,1 ) .substr( md5( time() ), 1);
	$hash = sha1($salt2 . $query["name"] . $_POST["pass"] . $query["name"] . $salt);
	$sql2 = "UPDATE `users` SET `pass` = '". $hash ."', `salt` = '". $salt ."', `salt2` = '". $salt2 ."' WHERE `users`.`id` = ". santise($_GET["id"]);
	$result2 = $conn->query($sql2);
	$conn->close();
	header('Location: users.php');
}
?>
