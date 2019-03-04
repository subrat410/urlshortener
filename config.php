<?php
	$config['db_host'] = 'us-cdbr-iron-east-03.cleardb.net';
	$config['db_user'] = 'b25bb9feeb70ad';
	$config['db_pass'] = '6c187c3e';
	$config['db_name'] = 'heroku_52ead61bfd0a60f';
	
	foreach($config as $k => $v){
		define(strtoupper($k),$v);
	}

?>