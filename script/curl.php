<?php

// create header who is send to url http on the web server
$post['file'] = new CurlFile('result.json', 'application/json' /* MIME-Type */, 'result.json');
	$target_url = 'http://54.144.23.166/hicloud/recup.php'; //file recup on the web server who get the file json
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$target_url);
	curl_setopt($ch, CURLOPT_POST,true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch, CURLOPT_SAFE_UPLOAD,false);
	$result=curl_exec ($ch);
	curl_close ($ch);
	echo $result;


?>