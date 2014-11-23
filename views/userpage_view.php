<div class="menu">
	<a href="index.php">Back to Index</a> | 
	<a href="userlist.php">User List</a>
</div>

<div class="inputblock">
<?php

if (!isset($data->user))
{
	echo '
		<b>Incorrect profile ID!</b>
	';
}

elseif(isset($_SESSION['user']) && $data->user->getId() == $_SESSION['user']->getId())
{
	echo '
		<h3>'.$data->user->getUserName().'</h3>
		<form action="userpage.php?id='.$data->user->getId().'&action=commit" method="POST">
		<b>Private email:</b> <input type="email" name="privemail" value="'.$data->user->getPrivEmail().'"><br>
		<b>Public email:</b> <input type="email" name="pubemail" value="'.$data->user->getPubEmail().'"><br>
		<b>Information:</b> <input type="text" name="information" value="'.$data->user->getUserinfo().'"><br>
		<b>Group:</b> '.$data->user->getUsergroupName().'<br>
	';
	if (isset($_SESSION['user']) && $_SESSION['user']->getUsergroup() == 2)
		echo '
			<br>
			<b>Change Group (admin only):</b><br>
			<select name="usergroup">
				<option value="0">User</option>
				<option value="1">Moderator</option>
				<option value="2">Administrator</option>
			</select><br>
			<br>
		';
	echo '<button type="submit">Commit</button></form>';
}

else
{
	echo '
		<h3>'.$data->user->getUserName().'</h3>
		<form action="userpage.php?id='.$data->user->getId().'&action=changegroup" method="POST">
		<b>Public email:</b> '.$data->user->getPubEmail().'<br>
		<b>Information:</b> '.$data->user->getUserinfo().'<br>
		<b>Group:</b> '.$data->user->getUsergroupName().'<br>
	';
	if (isset($_SESSION['user']) && $_SESSION['user']->getUsergroup() == 2)
		echo '
			<br>
			<b>Change Group (admin only):</b><br>
			<select name="usergroup">
				<option value="0">User</option>
				<option value="1">Moderator</option>
				<option value="2">Administrator</option>
			</select><br>
			<br>
			<button type="submit">Commit</button></form>
		';
}
?>