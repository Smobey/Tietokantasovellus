<div class="menu">
	<a href="index.php">Back to Index</a> |<?php if(Thread::threadExists($data->id)) echo '
    <a href="showthread.php?id='.$data->thread->getThreadId().'">Back to Thread</a> | '; ?>
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

elseif ($_SESSION['user']->getUsergroup() < 1)
{
    echo "<br><br>You don't have the permission to delete this thread.";
}

else
{
    echo '<br><br><h2 style="float:left">Really delete this thread? This absolutely CANNOT be undone.</h2><br><br><br><br><br>
    <h3 style="float:left">'.$data->thread->getThreadTitle().'</h3><br><br><br><br><br>
	<form action="deletethread.php?id='.$data->id.'&confirm=1" method="POST">
        <input type="hidden" name="h" value="1" />
		<button type="submit">Confirm</button>
	</form>
    ';
}
?>


