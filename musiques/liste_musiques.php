<?php
	$dir = "./../../musiques/";
	$files1 = scandir($dir);

	$res = '{ "musiques" : [';

	int $i=0;

	foreach($files1 as $var) {
		if($i!=0) 
			$res.=', ';
		$res.='{';
		$res.='"url": "'.$var.'",';
		$res.='"titre": "'.$var.'"';
		$res.='}';
		$i++;
	}

	echo $res.']}';
?>
