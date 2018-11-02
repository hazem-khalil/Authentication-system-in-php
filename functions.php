<?php 

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

function form_error ($errors = array())
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
}