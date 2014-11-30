<?php
require_once 'libs/common.php';
require_once 'libs/user.php';
require_once 'libs/thread.php';
session_start();

$id=$_GET['id'];
$confirm=$_GET['confirm'];
$error=$_GET['error'];
$loggedin = isset($_SESSION['user']);
$thread = null;

if(Thread::threadExists($id))
{
    $thread = Thread::findById($id);
}

if ($confirm == 1)
{
	if ($loggedin == false) 
	{
		showView("deletethread_view.php", array(
        'loggedin' => $loggedin,
        'id' => $id,
        'thread' => $thread,
		'error' => "You must be logged in.",
		));
	}
    
	elseif (!Thread::threadExists($id)) 
	{
		showView("deletethread_view.php", array(
        'loggedin' => $loggedin,
        'id' => $id,
        'thread' => $thread,
		'error' => "Thread doesn't exist.",
		));
	}

	elseif ($_SESSION['user']->getUsergroup() < 1) 
	{
		showView("deletethread_view.php", array(
        'loggedin' => $loggedin,
        'id' => $id,
        'thread' => $thread,
		'error' => "Nice try.",
		));
	}
    
	elseif ($_POST["h"] != '1') 
	{
		showView("deletethread_view.php", array(
        'loggedin' => $loggedin,
        'id' => $id,
        'thread' => $thread,
		'error' => "Nice try!",
		));
	}
    
    else
    {
        Thread::deleteThread($id);
        $_SESSION['notification'] = "Thread successfully deleted!";
        header('Location: index.php');
    }
}

showView('deletethread_view.php', array('loggedin' => $loggedin, 'id' => $id, 'thread' => $thread));