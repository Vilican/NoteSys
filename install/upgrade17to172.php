<?php

DEFINE("INSTALL", 1);
require "../config.php";

echo '<!doctype html><html><head>
<meta name="generator" content="NoteSys">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>NoteSys Installer</title>
<link rel="stylesheet" href="../css.css">
<style>body{color:white;background-color:green}</style>
</head><body><br><br>
<p class="center" style="color:#FFFF00 !important; font-size:25px !important">'. $inst_welcome .'</p>
<p class="center" style="color:#FFFF00 !important; font-size:16px !important">'. $upgrade2_instruct .'</p><br>
<form class="center" action="upgrade17to172.php" method="post"><input type="submit" name="ok" value="'.$do_upgrade.'" class="center"></form>
<p id="copyright">Powered by <a style="color:#FFFF00 !important;" href="https://notesys.sufix.cz">NoteSys</a></p></body></html>';

if (isset($_POST["ok"])) {
$ok = 1;
$sql="INSERT INTO `settings` (`id`, `value`) VALUES ('extsec', '0'), ('httpsredir', '0');";
if ($conn->query($sql) === TRUE) {} else { echo "ERROR: " . $conn->error. "<br>"; $ok = 0;}
if ($ok == 1) {echo "<p class='center'>". $upgraded ."</p>";}
$conn->close();
}
?>