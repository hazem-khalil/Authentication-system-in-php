<?php require_once('db_connection.php'); ?>
<?php require_once('functions.php'); ?>

<?php  
$errors = array();
// validation
if (isset($_POST['submit'])) {
	$email = $_POST['email'];
	$password = $_POST['password'];

	$fields_required = array('email', 'password');
	foreach($fields_required as $field) {
		$value = trim($_POST[$field]);
		if(!has_presence($value)) {
			$errors[$field] = ucfirst($field) . " can't be bclank";
		}
	}

	if (strpos($email, '@') === false) {
		$errors['invalide_email'] = "Please enter a valid email";
	}


	if (empty($errors)) {
		$found_user = attempt_login($email, $password);
		if ($found_user) {
			// may be found a refactoring here!!
			$_SESSION["logged_in"] = $found_user["username"];
			$_SESSION["message"] = $found_user["username"];
			$_SESSION["user_id"] = $found_user["id"];
			$_SESSION["username"] = $found_user["username"];


	    	redirect_to("index.php");
		} else {
			$_SESSION['errors'] = "Email/Password is incorrect.";

		}
	}
	
}




?>



<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<h2>login</h2>
	<hr>
	<?php 
		echo session_errors();
		echo form_errors($errors);
	?>
	<form method="POST" action="/tasks/login.php">
		<p>Email:
			<input type="text" name="email" value="">
		</p>

		<p>Password:
			<input type="password" name="password" value="">
		</p>

		<input type="submit" name="submit" value="Login">
	</form>
<h4>
	Create your account from <a href="register.php"> here </a>
</h4>
</body>
</html>