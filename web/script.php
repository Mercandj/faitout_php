<?php
	$url = $_GET['url'];
	$c = curl_init($url);
	$authString = 'user:pass';
	curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($c, CURLOPT_USERPWD, $authString);

	$content = curl_exec($c);
	$contentType = curl_getinfo($c, CURLINFO_CONTENT_TYPE);
	header('Content-Type:'.$contentType);
	print $content;
?>