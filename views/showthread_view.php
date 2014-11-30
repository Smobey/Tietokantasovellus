<div class="menu">
	<a href="index.php">Back to Index</a> |<?php if(Thread::threadExists($data->id) && isset($_SESSION['user'])) echo '
    <a href="postmessage.php?id='.$data->id.'">Post New Message</a> | '; ?>
	<a href="userlist.php">User List</a>
</div>

<div class="threads">
	<table id="threadtable">
    <?php
    if(!Thread::threadExists($data->id))
    {
		echo'<tr>
            <td><div class="message">Invalid thread ID.</div></td>
          </tr>
		';
    }
	elseif ($data->messages == null)
	{
		echo'<tr>
            <td><div class="message">No messages to display.</div></td>
          </tr>
		';
	}
    else
    {
        $index = 0;
        foreach ($data->messages as $row)
        {
            $phpdate = strtotime($row['Postdate']);
            $mysqldate = date( 'd.m.Y H:m:s', $phpdate );
            $message = ($row['Message']);
            
            if ($row['Deleted'] == 1)
                $message = '[Message deleted]';

            echo'
            <tr>
            <th><b>From:</b> <a href="userpage.php?id='.$row['Creator'].'">'.$row['Username'].'</a> | <b>Posted:</b> '.$mysqldate;
            if (isset($_SESSION['user']) && $row['Deleted'] == 0)
            {
                if ($_SESSION['user']->getUsergroup() > 0)
                {
                    if ($index == 0)
                        echo ' | <a href="deletemessage.php?id='.$row['MessageID'].'">Delete Post</a> | <a href="deletethread.php?id='.$data->id.'">Delete Thread</a></th>';
                    else
                        echo ' | <a href="deletemessage.php?id='.$row['MessageID'].'">Delete Post</a></th>';
                }
                elseif ($_SESSION['user']->getId() == $row['Creator'])
                    echo ' | <a href="deletemessage.php?id='.$row['MessageID'].'">Delete Post</a></th>';
            }
            echo '</tr>
            <tr>
            <td><div class="message">'.$message.'</div></td>
            </tr>';
            $index++;
        }
    }
      ?>
	</table>
</div>

<div class="pageswitch">
	<?php
    if(Thread::threadExists($data->id))
    {
        $totalpages = ceil(Message::countMessages($data->id) / 20);
        echo 'Page '.$data->page.' of '.$totalpages.'<br>';
        if ($data->page == 1)
        {
            echo '<s>Previous Page</s> |';
        }
        else
        {
            echo '<a href="showthread.php?page='. ($data->page - 1) .'">Previous Page</a> |';
        }
        if ($data->page == $totalpages)
        {
            echo ' <s>Next Page</s>';
        }
        else
        {
            echo ' <a href="showthread.php?page='. ($data->page + 1) .'">Next Page</a>';
        }
    }
	?>
</div>