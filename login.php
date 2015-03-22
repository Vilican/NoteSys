<?php

require 'config.php';

echo '<a href="index.php">'.$goback.'</a><!doctype html><html><head>
<meta name="generator" content="NoteSys">
<meta name="robots" content="noindex,nofollow">
<META http-equiv="cache-control" content="no-cache">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
<title>'. $title .'</title>
<!--mstheme--><link rel="stylesheet" href="sono1011-1250.css">
<meta name="Microsoft Theme" content="sonora 1011">
</head><body>
<form action="processlogin.php" method="post">
<p align="center">&nbsp;</p>
<p align="center"><b><font size="5" color="#FFFF00">'. $login_heading .'</font></b></p>
<div align="center">
	<p align="center">&nbsp;</p>
	<table border="0" width="30%">
		<tr>
			<td>'. $user .'</td>
			<td><input type="text" name="name" size="20"></td>
		</tr>
		<tr>
			<td>'. $password .'</td>
			<td><input type="password" name="password" size="20"></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" value="'. $dologin .'" name="ok"></td>
		</tr>
	</table>
</div></form><p id="copyright">Powered by <a href="https://notesys.sufix.cz">NoteSys</a></p></body></html>';

?>