<?php
require_once 'libs/common.php';
require_once 'libs/user.php';
require_once 'libs/thread.php';
require_once 'libs/message.php';
session_start();

$error=$_GET['error'];
$loggedin = isset($_SESSION['user']);

if ($error == 1)
{
	$title = $_POST["title"];
	$message = $_POST["message"];
    
	if (!$loggedin) 
	{
		showView("createthread_view.php", array(
        'loggedin' => $loggedin,
		'error' => "Error: Nice try.",
		));
	}
	
	if (strlen($_POST["title"]) > 40 || strlen($_POST["title"]) < 5) 
	{
		showView("createthread_view.php", array(
        'loggedin' => $loggedin,
		'title' => $title,
		'message' => $message,
		'error' => "Error: The title must be between 5 and 40 characters long.",
		));
	}
	
	elseif (strlen($_POST["message"]) > 1000 || strlen($_POST["message"]) < 5) 
	{
		showView("createthread_view.php", array(
        'loggedin' => $loggedin,
		'title' => $title,
		'message' => $message,
		'error' => "Error: The message must be between 5 and 1000 characters long.",
		));
	}

	else
	{
		$newthread = new Thread(); 
		$newthread->setThreadTitle(htmlspecialchars($title));
		$newthread->setCreator($_SESSION['user']->getId());
        $newthread->setTag1('1');
		$threadid = $newthread->toDatabase();
        
        $newmessage = new Message(); 
        $newmessage->setMessage(htmlspecialchars($message));
        $newmessage->setThread(htmlspecialchars($threadid));
        $newmessage->setCreator($_SESSION['user']->getId());
        $newmessage->toDatabase();
		
		$_SESSION['notification'] = "Thread successfully created!";
		header('Location: showthread.php?id='.$threadid);
	} 

}

showView('createthread_view.php', array('loggedin' => $loggedin));