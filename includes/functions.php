<?php

session_start();

function redirect_to ($new_location)
{
	header("Location: " . $new_location);
	exit;
}

function flash_message ()
{
	if (isset($_SESSION['message'])){
		$welcome = "welcome, ";
		$output = $welcome . htmlentities($_SESSION['message']);

		// Clear sessions
		$_SESSION['message'] = null;
		$welcome = null;
		return $output;
	}
}

function session_errors ()
{
	if (isset($_SESSION['errors'])) {
		$errors = $_SESSION['errors'];

		// Clear session
		$_SESSION["errors"] = null;
		return $errors;
	}
}

function has_presence ($value)
{
	return isset($value) && $value !== "";
}

function has_max_length ($value, $max)
{
	return strlen($value) <= $max;
}

function has_min_length ($value, $min)
{
	return strlen($value) >= $min;
}


function validate_with_max_length ($fields_with_max_length)
{
	global $errors;

	foreach ($fields as $field => $max) {
		$value = trim($_POST['$field']);
		if (!has_max_length($value, $max)) {
			$errors[$fields] = ucfirst($field) . "is to long";
		}
	}
}

function form_errors ($errors = array())
{
	$output = "";
	if(!empty($errors)) {
		$output .= "<div class=\"errors\">";
		$output .= "Please fix the errors: ";
		$output .= "<ul>";
		foreach($errors as $key => $error) {
			$output .= "<li>{$error}</li>";
		}
		$output .= "</ul>";
		$output .= "</div>";
	}
	return $output;
}

function find_user_by_email ($email)
{
	require_once('db_connection.php');
	global $handler;

	$sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
	$query = $handler->prepare($sql);
	$result = $query->execute(array(
		':email' => $email
	));	

	if($user = $query->fetch(PDO::FETCH_ASSOC != null)) {
		return $user;
	} else {
		return null;
	}
}

function password_encrypt ($password)
{
	$hash_format = "$2y$11$";
	$salt_length = 22;
	$salt = generate_salt($salt_length);
	$format_and_salt = $hash_format . $salt;
	$hash = crypt($password, $format_and_salt);
	return $hash;
}


function generate_salt ($length)
{
	$unique_random_string = md5(uniqid(mt_rand(), true));
	$base64_string = base64_encode($unique_random_string);
	$modefied_base64_string = str_replace('+', '.', $base64_string);
	$salt = substr($modefied_base64_string, 0, $length);
	return $salt;
}

function password_check($password, $existing_hash) {
	// existing hash contains format and salt at start
  $hash = crypt($password, $existing_hash);
  if ($hash === $existing_hash) {
    return true;
  } else {
    return false;
  }
}

function attempt_login ($email, $password)
{
	$user = find_user_by_email($email);
	if($user) {
		if(password_check($password, $user['password'])) {
			return $user;
		} else {
			return false;
		}
	} else {
		return false;
	}
}

function logged_in ()
{
	return isset($_SESSION['user_id']);
}

function confirm_logged_in ()
{
	if (!logged_in()) {
		redirect_to('login.php');
	}
}
