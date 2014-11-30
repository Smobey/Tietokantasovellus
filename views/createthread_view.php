<div class="menu">
	<a href="index.php">Back to Index</a> | 
	<a href="userlist.php">User List</a>
</div>

<?php 
if ($data->loggedin == false)
{
    echo '<br><br>You must be logged in to view this page!';
}

else
{
    echo '<div class="inputblock">
	<h2>Create a New Thread</h2>
	<form action="createthread.php?error=1" method="POST">
		<b>Title:</b><br>
		<input style="width:50%" type="text" name="title" value="'.$data->title.'"/><br>
		<b>Message:</b><br>
		<textarea style="width:50%" rows="20" name="message">'.$data->message.'</textarea><br>
		<br>
		<button type="submit">Submit</button>
	</form>';
}
?>


