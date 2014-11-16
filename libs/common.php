<?php
function showView($sivu, $data = array())
{
	$data = (object)$data;
	require 'views/template.php';
	exit();
}

function loggedIn()
{
	if (isset($_SESSION['user'])
		return true;
	else
		return false;
}