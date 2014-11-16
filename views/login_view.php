<div class="menu">
	<a href="index.php">Back to Index</a> | 
	<a href="userlist.php">User List</a>
</div>

<div class="inputblock">
	<h2>Login</h2>
	<form action="login.php?error=1" method="POST">
	<b>Username:</b><br>
	<input type="text" name="username" value="<?php echo $data->username; ?>"/><br>
	<b>Password:</b><br>
	<input type="password" name="password" /><br>
	<br>
	<button type="submit">Login</button>
	</form>