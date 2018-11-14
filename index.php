<?php require_once('functions.php'); ?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<?php confirm_logged_in(); ?>

	<center> <?php echo $_SESSION['username']; ?> </center>
	<?php
		$welcome_message = flash_message();
		echo $welcome_message;
	?>		
		<h1>There is our project for you</h1>
		<br>
		
		<h3>
			You can logout from here <a href="logout.php">Logout</a> 
		</h3>

</body>
</html>