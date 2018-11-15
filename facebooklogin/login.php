<?php 
require_once("config.php");
$redirectURL = 'http://loalhost:8080/tasks/facebooklogin/fb-callback.php';
$permissions = ['email'];
$loginURL = $helper->getLoginUrl($redirectURL, $permissions);
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<hr>
	<form>

		<input type="text" name="email" value="" placeholder="email"><br>

		<input type="password" name="password" value="" placeholder="password"><br>

		<input type="submit" name="submit" value="Login"><br>
		
		<input type="button" onclick="window.location = '<?php echo $loginURL; ?>';" value="Login with facebook"><br>


	</form>

</body>
</html>