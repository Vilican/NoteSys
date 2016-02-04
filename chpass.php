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
	$salt = substr( "abwxdNOefghiLMjkEFuyzADIJKlmnopTPQUqrstRSVBCcvGHWXYZ" ,mt_rand( 0 ,50 ) ,1 ) .substr( md5( time() ), 1);
	$salt2 = substr( "STUVabdefghiLMNOPQjkuyzADEFcvwxBCGqHIJKlmnoprstRWXYZ" ,mt_rand( 0 ,50 ) ,1 ) .substr( md5( time() ), 1);
	$hash = sha1($salt2 . $query["name"] . $_POST["pass"] . $query["name"] . $salt);
	$sql2 = "UPDATE `users` SET `pass` = '". $hash ."', `salt` = '". $salt ."', `salt2` = '". $salt2 ."' WHERE `users`.`id` = ". $_SESSION["id"];
	$result2 = $conn->query($sql2);
	$conn->close();
	header('Location: index.php');
}
?>