<?php
	$gaSql['user']     = 'root';
	$gaSql['password'] = '';   
	$gaSql['db']       = 'db_ordering';
	$gaSql['server']   = '127.0.0.1';   
	$gaSql['port']     = 3306; // default MySQL port
	$gaSql['charset']  = 'utf8';
	
	$mysqli = new mysqli($gaSql['server'], $gaSql['user'], $gaSql['password'], $gaSql['db'], $gaSql['port']);
	if (mysqli_connect_error()) {
		die( 'Error connecting to MySQL server (' . mysqli_connect_errno() .') '. mysqli_connect_error() );
	}
	
	if (!$mysqli->set_charset($gaSql['charset'])) {
		die( 'Error loading character set "'.$gaSql['charset'].'": '.$mysqli->error );
	}
	?>