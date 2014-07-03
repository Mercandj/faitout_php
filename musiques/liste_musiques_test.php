<?php

	include_once 'class.mp3file.php';

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

		

		$m = id3_get_tag($dir.$var);

		echo $i.' m='.$m.'<br />';
		

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
