<?php
session_start();

	if (isset($_SESSION['user']))
	{
		echo 
		'Signed in as:<br>'.
		$_SESSION['user']->getId().'<br>
		<br>
		<a href="">Log out</a><br>
		<a href="userpage.php?id=1">My profile</a>';
	}
	else
	{
		echo 
		'hamburgers';
	}
?>