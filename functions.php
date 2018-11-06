<?php 



function redirect_to ($new_location)
{
	header("Location: " . $new_location);
	exit;
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
