<?php
require_once 'libs/common.php';
require_once 'libs/user.php';
session_start();

$error=$_GET['error'];

if($error == 1)
{
	if (empty($_POST["username"])) 
	{
		showView("login_view.php", array(
		'error' => "Login failed! You did not provide a username.",
		));
	}

	$username = $_POST["username"];

	if (empty($_POST["password"])) 
	{
		showView("login_view.php", array(
		'username' => $username,
		'error' => "Login failed! You did not provide a password.",
		));
	}
	
	$password = $_POST["password"];

	if (User::findUser($username, $password))
	{
		$user = User::findUser($username, $password);
		$_SESSION['user'] = $user;

		/*showView("login_view.php", array(
		'username' => $username,
		'error' => $_SESSION['user']->getId(),
		));*/
		
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