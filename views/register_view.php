<div class="menu">
	<a href="index.php">Back to Index</a> | 
	<a href="userlist.php">User List</a>
</div>

<div class="inputblock">
	<h2>Register</h2>
	<form action="register.php?error=1" method="POST">
		<b>Username:</b><br>
		<input type="text" name="username" value="<?php echo $data->username; ?>"/><br>
		<b>Password:</b><br>
		<input type="password" name="password" /><br>
		<b>Password again:</b><br>
		<input type="password" name="password_again" /><br>
		<b>Email:</b><br>
		<input type="email" name="email" value="<?php echo $data->email; ?>"/><br>
		<br>
		<button type="submit">Register</button>
	</form>