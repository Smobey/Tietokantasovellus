<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Foorumi</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="titlewrapper">
	<div class="title">
		Foorumi
	</div>

	<div class="useroptions">
		Signed in as:<br>
		Admin<br>
		<br>
		<a href="">Log out</a><br>
		<a href="userpage.php?id=1">My profile</a>
	</div>
</div>

<div class="menu">
	<a href="index.php">Back to Index</a> | 
	<a href="userlist.php">User List</a>
</div>

<div class="inputblock">
<?php
$id=$_GET['id'];

if($id == 1)
{
	echo '
		<b>Private email:</b> <input type="text" name="privateemail" value="admin@bunbunmaru.com"><br>
		<b>Public email:</b> <input type="text" name="publicemail" value="admin@bunbunmaru.com"><br>
		<b>Information:</b> <input type="text" name="information" value="HTML5 valid!"><br>
		<b>Group:</b> Administrator<br>
		<br>
		<b>Change Group (admin only):</b><br>
		<select>
			<option value="volvo">User</option>
			<option value="saab">Moderator</option>
			<option value="mercedes">Administrator</option>
		</select><br>
		<br>
		<button type="button">Commit</button>
	';
}

elseif($id == 2)
{
	echo '
		<b>Public email:</b> bethanym@gmail.com<br>
		<b>Information:</b> "I am BethanyM!"<br>
		<b>Group:</b> User<br>
		<br>
		<b>Change Group (admin only):</b><br>
		<select>
			<option value="volvo">User</option>
			<option value="saab">Moderator</option>
			<option value="mercedes">Administrator</option>
		</select><br>
		<br>
		<button type="button">Commit</button>
	';
}

else
{
	echo '
		<b>Incorrect profile ID!</b>
	';
}
?>
</div>
</body>
</html>