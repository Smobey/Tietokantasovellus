<?php
function showView($sivu, $data = array())
{
	$data = (object)$data;
	require 'views/template.php';
	exit();
}