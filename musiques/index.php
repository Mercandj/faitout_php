<?php
	$id = $_GET['pseudo'];
	$pass = $_GET['mot_de_passe'];
	$dir = "./musiques/";
	$files1 = scandir($dir);
	$res = "";
	foreach($files1 as $var) {
		$res.=$var."#";
	}
	echo $res;
?>
