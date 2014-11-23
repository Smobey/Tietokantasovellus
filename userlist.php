<?php

require_once 'libs/common.php';
require_once 'libs/user.php';

$page = $_GET['page'];
if ($page == null)
{
	$page = 1;
}

$users = User::getNUsers(20, $page);
showView('userlist_view.php', array('users' => $users, 'page' => $page));