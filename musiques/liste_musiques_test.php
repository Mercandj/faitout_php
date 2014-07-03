<?php

	include_once('mp3.php');




	function get_mp3_len ($file) {

        $rate1=array(0, 32, 64, 96, 128, 160, 192, 224, 256, 288, 320, 352, 384, 416, 448, "bad");
        $rate2=array(0, 32, 48, 56, 64, 80, 96, 112, 128, 160, 192, 224, 256, 320, 384, "bad");
        $rate3=array(0, 32, 40, 48, 56, 64, 80, 96, 112, 128, 160, 192, 224, 256, 320, "bad");
        $rate4=array(0, 32, 48, 56, 64, 80, 96, 112, 128, 144, 160, 176, 192, 224, 256, "bad");
        $rate5=array(0, 8, 16, 24, 32, 40, 48, 56, 64, 80, 96, 112, 128, 144, 160, "bad");

        $bitrate=array(
                '1'  => $rate5,
                '2'  => $rate5,
                '3'  => $rate4,
                '9'  => $rate5,
                '10' => $rate5,
                '11' => $rate4,
                '13' => $rate3,
                '14' => $rate2,
                '15' => $rate1
        );

        $sample=array(
                '0'  => 11025,
                '1'  => 12000,
                '2'  => 8000,
                '8'  => 22050,
                '9'  => 24000,
                '10' => 16000,
                '12' => 44100,
                '13' => 48000,
                '14' => 32000
        );

        $fd=fopen($file, 'rb');
        $header=fgets($fd, 5);
        fclose($fd);

        $bits="";
        while (strlen($header) > 0) {

                //var_dump($header);
                $bits.=str_pad(base_convert(ord($header{0}), 10, 2), 8, '0', STR_PAD_LEFT);
                $header=substr($header, 1);
        }

        $bits=substr($bits, 11); // lets strip the frame sync bits first.

        $version=substr($bits, 0, 2); // this gives us the version
        $layer=base_convert(substr($bits, 2, 2), 2, 10); // this gives us the layer
        $verlay=base_convert(substr($bits, 0, 4), 2, 10); // this gives us both

        $rateidx=base_convert(substr($bits, 5, 4), 2, 10); // this gives us the bitrate index
        $sampidx=base_convert($version.substr($bits, 9, 2), 2, 10); // this gives the sample index
        $padding=substr($bits, 11, 1); // are we padding frames?

        $rate=$bitrate[$verlay][$rateidx];
        $samp=$sample[$sampidx];

        $framelen=0;
        $framesize=384; // Size of the frame in samples
        if ($layer == 3) { // layer 1?
                $framelen=(12 * ($rate * 1000) / $samp + $padding) * 4;
        } else { // Layer 2 and 3
                $framelen=144 * ($rate * 1000) / $samp + $padding;
                $framesize=1152;
        }

        $headerlen=4 + ($bits{4} == 0 ? '2' : '0');

        return (filesize($file) - $headerlen) / $framelen / ($samp / $framesize);
	}









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

		    $m = get_mp3_len($dir.$var);


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
