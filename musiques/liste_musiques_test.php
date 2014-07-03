<?php

	include_once('mp3.php');


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
			echo $i.' <br />';

			$musicfile = fopen($dir.$var, 'r');
			fseek($musicfile, -128, SEEK_END);

			$tag = fread($musicfile, 3);

			if($tag == "TAG") {
				$res.='"song": "'.($data["song"] = trim(fread($musicfile, 30))).'",';
				$res.='"artist": "'.($data["artist"] = trim(fread($musicfile, 30))).'",';
				$res.='"album": "'.($data["album"] = trim(fread($musicfile, 30))).'",';
			}

			$res.='"size": "'.filesize($dir.$var).'",';

		    fclose($musicfile);
		}
		

		$res.='"titre": "'.$var.'"';

		/*$a = $m->get_metadata();
		 
		if ($a['Encoding']=='Unknown')
		    $res.='"url": "?",';
		else if ($a['Encoding']=='VBR')
			$res.='"url": "'.$a.'",';
		else if ($a['Encoding']=='CBR')
		    $res.='"url": "'.$a.'",';
		unset($a);*/


		$res.='}';
		$i++;
	}

	echo $res.']}';
?>
