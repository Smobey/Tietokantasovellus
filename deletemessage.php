<?php
require_once 'libs/common.php';
require_once 'libs/user.php';
require_once 'libs/message.php';
session_start();

$id=$_GET['id'];
$confirm=$_GET['confirm'];
$error=$_GET['error'];
$loggedin = isset($_SESSION['user']);
$message = null;

if(Message::messageExists($id))
{
    $message = Message::findById($id);
}

if ($confirm == 1)
{
	if ($loggedin == false) 
	{
		showView("deletemessage_view.php", array(
        'loggedin' => $loggedin,
        'id' => $id,
        'message' => $message,
		'error' => "You must be logged in.",
		));
	}
    
	elseif (!Message::messageExists($id)) 
	{
		showView("deletemessage_view.php", array(
        'loggedin' => $loggedin,
        'id' => $id,
        'message' => $message,
		'error' => "Message doesn't exist.",
		));
	}
    
	elseif ($message->getDeleted() == 1) 
	{
		showView("deletemessage_view.php", array(
        'loggedin' => $loggedin,
        'id' => $id,
        'message' => $message,
		'error' => "Message already deleted.",
		));
	}

	elseif ($_SESSION['user']->getUsergroup() < 1 && $_SESSION['user']->getId() != $message->getCreator()) 
	{
		showView("deletemessage_view.php", array(
        'loggedin' => $loggedin,
        'id' => $id,
        'message' => $message,
		'error' => "Nice try.",
		));
	}
    
	elseif ($_POST["h"] != '1') 
	{
		showView("deletemessage_view.php", array(
        'loggedin' => $loggedin,
        'id' => $id,
        'message' => $message,
		'error' => "Nice try!",
		));
	}
    
    else
    {
        Message::deleteMessage($id);
        $_SESSION['notification'] = "Message successfully deleted!";
        header('Location: showthread.php?id='.$message->getThread());
    }
}

showView('deletemessage_view.php', array('loggedin' => $loggedin, 'id' => $id, 'message' => $message));