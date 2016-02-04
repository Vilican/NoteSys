<?php
require 'config.php';
require 'funct.php';
checklogin("yes");
if ($_SESSION["id"] != 1) {
	header('Location: index.php');
	die();
}
templ();
$sqlid = "SELECT * FROM `lastid` WHERE `type` = 'users'";
$resultid = $conn->query($sqlid);
$valid = $resultid->fetch_assoc();
$newid = $valid["lastid"] + 1;
if (isset($_GET["1"])) {
	$dupe = $duplicate . "<br><br>";
}
echo '<form action="adduser.php" method="post"><br>
<p class="center" style="font-size:24px;"><strong>'. $newuser .'</strong></p>
<div align="center"><br>'. $dupe .'
	<table style="border:0px; width=30%; font-size:15px;">
		<tr>
			<td>'.$user.'</td>
			<td><input type="text" name="user" size="20"></td>
		</tr>
		<tr>
			<td>'.$password.'</td>
			<td><input type="text" name="pass" size="50"></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" value="'.$submit.'" name="ok"></td>
		</tr>
	</table>
</div></form>';
footer();
if (isset($_POST["ok"])) {
	if (($_POST["pass"] == null) or ($_POST["user"] == null)) {
		$conn->close();
		header('Location: users.php');
		die();
	}
	$sqldupe = "SELECT * FROM `users` WHERE `name` = '". santise($_POST["user"]) ."'";
	$resultdupe = $conn->query($sqldupe);
	if ($resultdupe->num_rows > 0) {
		header('Location: adduser.php?1');
		die();
	}
	$salt = substr( "abwxdNOefghiLMjkEFuyzADIJKlmnopTPQUqrstRSVBCcvGHWXYZ" ,mt_rand( 0 ,50 ) ,1 ) .substr( md5( time() ), 1);
	$salt2 = substr( "STUVabdefghiLMNOPQjkuyzADEFcvwxBCGqHIJKlmnoprstRWXYZ" ,mt_rand( 0 ,50 ) ,1 ) .substr( md5( time() ), 1);
	$hash = sha1($salt2 . $_POST["user"] . $_POST["pass"] . $_POST["user"] . $salt);
	$sql2 = "INSERT INTO `users` (`id`, `name`, `pass`, `salt`, `salt2`) VALUES ('". $newid ."', '". santise($_POST["user"]) ."', '". $hash ."', '". $salt ."', '". $salt2 ."')";
	$result2 = $conn->query($sql2);
	$sqlupid = "UPDATE `lastid` SET `lastid` = '". $newid ."' WHERE `lastid`.`type` = 'users'";
	$resultupid = $conn->query($sqlupid);
	$conn->close();
	header('Location: users.php');
}
?>