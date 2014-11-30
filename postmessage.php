<?php
require_once 'libs/common.php';
require_once 'libs/user.php';
require_once 'libs/thread.php';
require_once 'libs/message.php';
session_start();

$id=$_GET['id'];
$error=$_GET['error'];
$loggedin = isset($_SESSION['user']);
$threadname = '';

if ($error == 1)
{
	$message = $_POST["message"];
    
	if (!$loggedin || !Thread::threadExists($id)) 
	{
		showView("postmessage_view.php", array(
        'loggedin' => $loggedin,
		'error' => "Error: Nice try.",
		));
	}
	
	elseif (strlen($_POST["message"]) > 1000 || strlen($_POST["message"]) < 5) 
	{
		showView("postmessage_view.php", array(
        'loggedin' => $loggedin,
		'message' => $message,
        'id' => $id,
		'error' => "Error: The message must be between 5 and 1000 characters long.",
		));
	}

	else
	{
        $newmessage = new Message(); 
        $newmessage->setMessage(htmlspecialchars($message));
        $newmessage->setThread($id);
        $newmessage->setCreator($_SESSION['user']->getId());
        $newmessage->toDatabase();
        
        $currentthread = Thread::findById($id);
        $currentthread->newPost();
		
		$_SESSION['notification'] = "Message successfully posted!";
		header('Location: showthread.php?id='.$id);
	} 
}

if(Thread::threadExists($id))
{
    $threadname = Thread::findById($id)->getThreadTitle();
}

showView('postmessage_view.php', array('loggedin' => $loggedin, 'id' => $id, 'threadname' => $threadname));