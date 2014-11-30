<div class="menu">
	<a href="index.php">Back to Index</a> |<?php if(Message::messageExists($data->id)) echo '
    <a href="showthread.php?id='.$data->message->getThread().'">Back to Thread</a> | '; ?>
	<a href="userlist.php">User List</a>
</div>

<?php

if ($data->loggedin == false)
{
    echo '<br><br>You must be logged in to view this page!';
}

elseif (!Message::messageExists($data->id))
{
    echo '<br><br>Invalid message ID!';
}

elseif ($data->message->getDeleted() == 1)
{
    echo '<br><br>Message already deleted!';
}

elseif ($_SESSION['user']->getUsergroup() < 1 && $_SESSION['user']->getId() != $data->message->getCreator())
{
    echo "<br><br>You don't have the permission to delete this message.";
}

else
{
    echo '<br><br><h2 style="float:left">Really delete this message?</h2><br><br><br>
    <div class="threads">
	<table id="threadtable">
    <tr>
    <td><div class="message">'.$data->message->getMessage().'</div></td>
    </tr>
    </table>
    <br>
	<form action="deletemessage.php?id='.$data->id.'&confirm=1" method="POST">
        <input type="hidden" name="h" value="1" />
		<button type="submit">Confirm</button>
	</form>
    ';
}
?>


