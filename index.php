<?php require_once('functions.php'); ?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<?php 

		if (!isset($_SESSION['logged_in'])) {
			redirect_to('login.php');
		}


	?>


	<?php 
		$welcome_message = flash_message();
		echo $welcome_message;
	?>
	<h1>There is our project for you</h1>

</body>
</html>