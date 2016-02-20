<?php

DEFINE("INSTALL", 1);

echo '<!doctype html><html><head>
<meta name="generator" content="NoteSys">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>NoteSys Installer</title>
<link rel="stylesheet" href="../css.css">
<style>a,a:hover,a:active,a:visited{color:yellow}body{background-color:green}</style>
</head><body><br>
<a href="install.php">NEW INSTALATION OF NOTESYS</a><br><br>
<a href="upgrade16to17.php">UPGRADE DATABASE FROM v1.6 OR OLDER TO v1.7</a><br>
<a href="upgrade17to172.php">UPGRADE DATABASE FROM v1.7 TO v1.7.2</a><br><br>
<a href="resetpass.php">RESET SUPERUSER PASSWORD TO BLANK</a><br>
<a href="resetsec.php">DISABLE REQUIRE OF HTTPS AND EXTENDED SECURITY (only for v1.7.2)</a>
</body></html>';

?>