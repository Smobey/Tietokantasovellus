<?php

require_once 'libs/common.php';
require_once 'libs/user.php';
session_start();

$user = User::findById($_GET['id']);

if($_GET['action'] == 'commit')
{
	if (isset($_SESSION['user']) && $user->getId() != $_SESSION['user']->getId())
	{
		showView("userpage_view.php", array(
		'error' => "Don't even try.",
		'user' => $user
		));
	}
	
	elseif (empty($_POST["privemail"])) 
	{
		showView("userpage_view.php", array(
		'error' => "Error: You must provide a private email address.",
		'user' => $user
		));
	}
	
	elseif (strlen($_POST["privemail"]) > 60 || strlen($_POST["pubemail"]) > 60) 
	{
		showView("userpage_view.php", array(
		'error' => "Error: Your email address must be 60 characters or less.",
		'user' => $user
		));
	}
	
	elseif (strlen($_POST["information"]) > 300) 
	{
		showView("userpage_view.php", array(
		'error' => "Error: Your information must be 300 characters or less.",
		'user' => $user
		));
	}
	
	
	else
	{
		$user->setPrivEmail(htmlspecialchars($_POST["privemail"]));
		$user->setPubEmail(htmlspecialchars($_POST["pubemail"]));
		$user->setUserinfo(htmlspecialchars($_POST["information"]));
		$user->setUsergroup($_POST["usergroup"]);
		
		$user->updateInfo();
		
		$_SESSION['user'] = $user;
			
		$_SESSION['notification'] = "Changes successful!";
	}
}

elseif($_GET['action'] == 'changegroup')
{
	$user->setUsergroup($_POST["usergroup"]);
	
	$user->updateInfo();
		
	$_SESSION['notification'] = "Changes successful!";
}

showView("userpage_view.php", array('user' => $user));