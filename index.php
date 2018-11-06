<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<p>welcome, 
		<?php 
			$_SESSION['username'] = $_POST['username'];
			$name = $_SESSION['username'];
			echo $name;
		?>
	</p>
</body>
</html>