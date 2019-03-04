<?php
	include 'functions.php';
	
	$url = $_POST['url'];
	if(urlvalidator($url)){
		echo $url;
	}
	else {
		http_response_code(400);
	}
?>