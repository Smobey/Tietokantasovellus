<div class="menu">
	<a href="index.php">Back to Index</a>
</div>

<div class="threads">
	<table id="forumtable">
	<tr>
		<th>Name</th>
		<th>Date Joined</th> 
	</tr>
	<?php
	if ($data->users == null)
	{
		echo'
		<tr>
			<td>No users to list!</td>
			<td>-</td> 
		</tr>
		';
	}
	else
	{
		foreach ($data->users as $row)
		{
			$phpdate = strtotime($row[2]);
			$mysqldate = date( 'd.m.Y', $phpdate );
			echo'
			<tr>
				<td><a href="userpage.php?id='.$row[0].'">'.htmlspecialchars($row[1]).'</a></td>
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
	$totalpages = ceil(User::countUsers() / 20);
	echo 'Page '.$data->page.' of '.$totalpages.'<br>';
	if ($data->page == 1)
	{
		echo '<s>Previous Page</s> |';
	}
	else
	{
		echo '<a href="userlist.php?page='. ($data->page - 1) .'">Previous Page</a> |';
	}
	if ($data->page == $totalpages)
	{
		echo ' <s>Next Page</s>';
	}
	else
	{
		echo ' <a href="userlist.php?page='. ($data->page + 1) .'">Next Page</a>';
	}
	?>
</div>