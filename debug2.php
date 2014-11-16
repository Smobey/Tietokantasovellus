<?php
require_once 'libs/common.php';
require_once 'libs/user.php';
session_start();

	$user = User::findUser('admin', 'testymctest');
	$_SESSION['user'] = $user;
	header('Location: index.php');
?>