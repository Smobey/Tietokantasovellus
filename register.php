<?php
require_once 'libs/common.php';
require_once 'libs/user.php';
session_start();

$error=$_GET['error'];

if($error == 1)
{
	$username = $_POST["username"];
	$password = $_POST["password"];
	$email = $_POST["email"];

	if (empty($_POST["username"])) 
	{
		showView("register_view.php", array(
		'email' => $email,
		'error' => "Registration failed! You did not provide a username.",
		));
	}

	elseif (empty($_POST["password"])) 
	{
		showView("register_view.php", array(
		'username' => $username,
		'email' => $email,
		'error' => "Registration failed! You did not provide a password.",
		));
	}

	elseif (empty($_POST["email"])) 
	{
		showView("register_view.php", array(
		'username' => $username,
		'error' => "Registration failed! You did not provide an email.",
		));
	}
	
	elseif (strcmp($_POST["password"], $_POST["password_again"]) != 0) 
	{
		showView("register_view.php", array(
		'username' => $username,
		'email' => $email,
		'error' => "Registration failed! The passwords provided did not match.",
		));
	}
	
	elseif (strlen($_POST["username"]) > 18 || strlen($_POST["username"]) < 3) 
	{
		showView("register_view.php", array(
		'username' => $username,
		'email' => $email,
		'error' => "Registration failed! Your username must be between 3 and 18 characters long.",
		));
	}
	
	elseif (strlen($_POST["password"]) > 32 || strlen($_POST["password"]) < 5) 
	{
		showView("register_view.php", array(
		'username' => $username,
		'email' => $email,
		'error' => "Registration failed! Your password must be between 5 and 32 characters long.",
		));
	}
	
	elseif (strlen($_POST["email"]) > 60) 
	{
		showView("register_view.php", array(
		'username' => $username,
		'email' => $email,
		'error' => "Registration failed! Your email address must be 60 characters or less.",
		));
	}
	
	elseif (User::checkExisting($username))
	{
		showView("register_view.php", array(
		'username' => $username,
		'email' => $email,
		'error' => "Registration failed! An account with that name already exists.",
		));
	}

	else
	{    
		$newuser = new User(); 
		$newuser->setUsername(htmlspecialchars($username));
		$newuser->setPassword($password);
		$newuser->setPrivEmail(htmlspecialchars($email));
		
		$newuser->toDatabase();
		
		//$_SESSION['notification'] = "Registration successful! Feel free to log in.";
		header('Location: index.php?r=true');
	} 

}

showView('register_view.php');