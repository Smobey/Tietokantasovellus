<?php

function getConnection()
{
	$username = "databasetest";
	$password= "testymctest";

	static $connection = null; 

	if ($connection == null) 
	{ 

	$connection = new PDO("mysql:host=board.bunbunmaru.com;dbname=forumproject", $username, $password);
	$connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	}

	return $connection;
}