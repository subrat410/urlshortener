<?php
	$config['db_host'] = '';
	$config['db_user'] = '';
	$config['db_pass'] = '';
	$config['db_name'] = '';
	
	foreach($config as $k => $v){
		define(strtoupper($k),$v);
	}

?>
