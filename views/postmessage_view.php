<div class="menu">
	<a href="index.php">Back to Index</a> |<?php if(Thread::threadExists($data->id)) echo '
    <a href="showthread.php?id='.$data->id.'">Back to Thread</a> | '; ?>
	<a href="userlist.php">User List</a>
</div>

<?php 
if ($data->loggedin == false)
{
    echo '<br><br>You must be logged in to view this page!';
}

elseif (!Thread::threadExists($data->id))
{
    echo '<br><br>Invalid thread ID!';
}

else
{
    echo '<div class="inputblock">
	<h2>Post a New Message</h2>
    <h3>Thread: '.$data->threadname.'</h3>
	<form action="postmessage.php?id='.$data->id.'&error=1" method="POST">
		<b>Message:</b><br>
		<textarea style="width:50%" rows="20" name="message">'.$data->message.'</textarea><br>
		<br>
		<button type="submit">Submit</button>
	</form>';
}
?>


