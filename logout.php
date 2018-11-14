<?php require_once('functions.php'); ?>

<?php 
	$_SESSION['user_id'] = null;
	$_SESSION['username'] = null;

	redirect_to('login.php');


 ?>