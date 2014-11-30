<?php
session_start();
?>
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
	
	<div class="useroptions"><?php
	if (isset($_SESSION['user']))
	{
		echo 
		'Signed in as:<br>'.
		$_SESSION['user']->getUsername().'<br>
		<br>
		<a href="logout.php">Log out</a><br>
		<a href="userpage.php?id='.$_SESSION['user']->getId().'">My profile</a>';
	}
	else
	{
		echo '<a href="login.php">Log in</a><br>
		<a href="register.php">Register</a><br>';
	}
	?>
	</div>
</div>

<?php if (!empty($data->error)): ?>
<div class="alert alert-danger"> <?php
echo $data->error;
print_r ($_SESSION['notification']);
?><br><br></div>
<?php endif; ?>
<?php if (!empty($_SESSION['notification'])): ?>
  <div class="alert alert-danger">
    <?php echo $_SESSION['notification']; ?>
  </div><br><br>
<?php
  unset($_SESSION['notification']); 
  endif;
?>

<?php 
require 'views/'.$sivu; 
?>
  
</body>
</html>