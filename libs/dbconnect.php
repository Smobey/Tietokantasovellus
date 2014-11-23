<?php

function getConnection()
{

	$ini_array = parse_ini_file("./config.ini");
	$username = $ini_array[username];
	$password = $ini_array[password];
	$host = $ini_array[host];
	$dbname = $ini_array[dbname];

	static $connection = null; 

	if ($connection == null) 
	{ 
		$connection = new PDO('mysql:host='.$host.';dbname='.$dbname.'', $username, $password);
		$connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	}

	return $connection;
}