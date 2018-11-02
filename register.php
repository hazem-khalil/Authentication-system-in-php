<?php require_once("db_connection.php"); ?>
<?php require_once("functions.php"); ?>


<?php 

$errors = array();

if(isset($_POST['submit'])) {
	$username = trim($_POST['username']);
	$email = trim($_POST['email']);
	$password = trim($_POST['password']);

	// validations
	$fields_required = array("username", "email", "password");
	foreach ($fields_required as $field) {
		$value = trim($_POST[$field]);
		if(!has_presence($value)) {
			$errors[$field] = ucfirst($field) . " can't be blank";
		}
	}

	// email has contain @ symbol
	if(strpos($email, "@") === false) {
		$errors['invalide_email'] = "please enter a valid email";
	}

	// max length
	$fields_with_max_lengths = array("username" => 5, "email" => 4, "password" => 8);
	foreach($fields_with_max_lengths as $field => $max) {
		$value = $_POST[$field];
		if(!has_max_length($value, $max)) {
			$key = "max_".$field;
			$errors[$key] = ucfirst($field) . " is too long";
		}
	}

}




?>

<!DOCTYPE html>
<html>
<head>
	<title>Registeration Page</title>
</head>
<body>

	<?php echo form_errors($errors); ?>

	<form method="POST" action="/tasks/register.php">

		<p>Username:
			<input type="text" name="username" value="">
		</p>

		<p>Email:
			<input type="text" name="email" vssalue="">
		</p>

		<p>Password:
			<input type="password" name="password" value="">
		</p>

		<input type="submit" name="submit" value="Register">
	</form>
	


</body>
</html>