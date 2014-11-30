<?php if($data->registered == 'true')
echo 'Registration successful! Feel free to log in.<br><br>'; ?>

<div class="menu">
	<?php if(isset($_SESSION['user'])) echo '<a href="createthread.php">Create New Thread</a> |'; ?>
	<a>Change View</a> | 
	<a href="userlist.php">User List</a>
</div>

<div class="threads">
	<table id="forumtable">
	  <tr>
		<th>Title</th>
		<th>Tags</th> 
		<th>Created By</th>
		<th>Messages</th>
		<th>Last Post</th>
	  </tr>
	<?php
	if ($data->threads == null)
	{
		echo'
		<tr>
			<td>No threads to list!</td>
			<td>-</td> 
            <td>-</td> 
            <td>-</td> 
            <td>-</td> 
		</tr>
		';
	}
	else
	{
		foreach ($data->threads as $row)
		{
			$phpdate = strtotime($row['Lastpost']);
			$mysqldate = date( 'd.m.Y H:m:s', $phpdate );
			echo'
			<tr>
				<td><a href="showthread.php?id='.$row['ThreadID'].'">'.htmlspecialchars($row['Title']).'</a></td>
                <td>'.$row['Tag1Name'].'</td>
                <td><a href="userpage.php?id='.$row['Creator'].'">'.htmlspecialchars($row['Username']).'</a></td>
                <td>'.$row['MessageCount'].'</td>
				<td>'.$mysqldate.'</td> 
			</tr>
			';
		}
	}
	?>
	</table>
</div>

<div class="pageswitch">
	<?php
	$totalpages = ceil(Thread::countThreads() / 20);
	echo 'Page '.$data->page.' of '.$totalpages.'<br>';
	if ($data->page == 1)
	{
		echo '<s>Previous Page</s> |';
	}
	else
	{
		echo '<a href="index.php?page='. ($data->page - 1) .'">Previous Page</a> |';
	}
	if ($data->page == $totalpages)
	{
		echo ' <s>Next Page</s>';
	}
	else
	{
		echo ' <a href="index.php?page='. ($data->page + 1) .'">Next Page</a>';
	}
	?>
</div>