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
		$res.='"titre": "'.$var.'"';

		if (strpos($var,'mp3')) {
		    $fp = fopen($dir.$var, 'r'); 
		}
		

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
