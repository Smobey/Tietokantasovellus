<?php

require_once 'libs/common.php';
require_once 'libs/thread.php';
require_once 'libs/user.php';
require_once 'libs/tag.php';

$page = $_GET['page'];
if ($page == null)
{
	$page = 1;
}

$registered = $_GET['r'];

$threads = Thread::getNThreads(20, $page);

foreach ($threads as &$row)
{
    $user = User::findById($row['Creator']);
    $row['Username'] = $user->getUsername();
    
    $tag = Tag::findById($row['Tag1']);
    $row['Tag1Name'] = $tag->getTagName();
}

showView('index_view.php', array('threads' => $threads, 'page' => $page, 'registered' => $registered));