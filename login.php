<?php

require "config.php";
require_once "funct.php";
templ();
echo '<form action="login.php" method="post"><br>
<p class="center" style="font-size:24px;"><strong>'. $login_heading .'</strong></p>
<div align="center">
	<br>
	<table style="border:0px; width=30%; font-size:15px;">
		<tr>
			<td>'. $user .'</td>
			<td><input type="text" name="name" size="20"></td>
		</tr>
		<tr>
			<td>'. $password .'</td>
			<td><input type="password" name ="password" size="20"></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" value="'. $dologin .'" name="ok"></td>
		</tr>
	</table>
</div></form>';
footer();

if (isset($_POST["ok"])) {

$sql = "SELECT * FROM `users` WHERE name = '" . $_POST["name"] . "'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
    $hash = sha1($row["salt2"] . $row["name"] . $_POST["password"] . $row["name"] . $row["salt"]);
	if ($hash == $row["pass"]) {
		session_start();
		session_unset();
		session_destroy();
		session_start();
		$_SESSION["hash"] = sha1($hash . $row["name"]);
		$_SESSION["id"] = $row["id"];
		$conn->close();
		header('Location: index.php');
		die();
	} else {
		$conn->close();
		header('Location: login.php');
	}
} else {
	$conn->close();
	header('Location: login.php');
}
$conn->close();
}
?>