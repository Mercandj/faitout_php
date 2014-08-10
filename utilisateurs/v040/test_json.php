<?php
	$request_body = file_get_contents('php://input');
	$phpArray = json_decode($request_body, true);
	if($phpArray==null) {
		echo 'KO';
	}
	else {
		foreach ($phpArray as $key => $value) {
		    echo "utilisateur : $key<br />";
		    foreach ($value as $k => $v) {
		        echo "$k | $v <br />";
		    }
		}
	}
?>
