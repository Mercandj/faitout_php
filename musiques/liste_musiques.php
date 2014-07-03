<?php
	$dir = "./../../musiques/";
	$files1 = scandir($dir);

	$res = '{ "musiques" : [';

	$i=0;

	foreach($files1 as $var) {
		if($i!=0) 
			$res.=', ';
		$res.='{';
		$res.='"url": "'.$var.'",';

		if (strpos($var,'mp3')) {
			$musicfile = fopen($dir.$var, 'r');
			fseek($musicfile, -128, SEEK_END);

			$tag = fread($musicfile, 3);

			if($tag == "TAG") {
				$res.='"song": "'.($data["song"] = trim(fread($musicfile, 30))).'",';
				$res.='"artist": "'.($data["artist"] = trim(fread($musicfile, 30))).'",';
				$res.='"album": "'.($data["album"] = trim(fread($musicfile, 30))).'",';
			}			

		    fclose($musicfile);
		}	

		$res.='"size": "'.filesize($dir.$var).'",';
		$res.='"titre": "'.$var.'"';
		$res.='}';
		$i++;
	}

	echo $res.']}';
?>