<?php
require_once 'libs/common.php';
require_once 'libs/user.php';
session_start();

$error=$_GET['error'];

if($error == 1)
{
	$username = $_POST["username"];
	$password = $_POST["password"];
	
	if (empty($_POST["username"])) 
	{
		showView("login_view.php", array(
		'error' => "Login failed! You did not provide a username.",
		));
	}

	if (empty($_POST["password"])) 
	{
		showView("login_view.php", array(
		'username' => $username,
		'error' => "Login failed! You did not provide a password.",
		));
	}

	if (User::findUser($username, $password))
	{
		$user = User::findUser($username, $password);
		$_SESSION['user'] = $user;
		header('Location: index.php');
	} 
	else 
	{
		showView("login_view.php", array(
		'username' => $username,
		'error' => "Login failed! The username or password you provided is incorrect.",
		));
	}
}

showView('login_view.php');