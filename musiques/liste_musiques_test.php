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
		$res.='"titre": "'.$var.'"';

		if (strpos($var,'mp3')) {
			echo $i.' <br />';
		    //$fp = fopen($dir.$var, 'r'); 

			$musicfile = fopen($dir.$var, 'r');
			fseek($musicfile, -128, SEEK_END);

			$tag = fread($musicfile, 3);

			if($tag == "TAG")
			{
			$data["song"] = trim(fread($musicfile, 30));
			$data["artist"] = trim(fread($musicfile, 30));
			$data["album"] = trim(fread($musicfile, 30));
			}
			else
			{
			echo "MP3 file does not have any ID3 tag!";

			}

			echo $i.' $m='.$m.'<br />';
		    //fclose($fp);
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
