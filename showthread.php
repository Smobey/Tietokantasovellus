<?php

require_once 'libs/common.php';
require_once 'libs/user.php';
require_once 'libs/thread.php';
require_once 'libs/message.php';

$page = $_GET['page'];
if ($page == null)
{
	$page = 1;
}

$id = $_GET['id'];
if ($id == null)
{
	$id = 1;
}

if(Thread::threadExists($id))
{
    $messages = Message::showMessages(20, $page, $id);

    foreach ($messages as &$row)
    {
        $user = User::findById($row['Creator']);
        $row['Username'] = $user->getUsername();
    }
}

showView('showthread_view.php', array('messages' => $messages, 'page' => $page, 'id' => $id));