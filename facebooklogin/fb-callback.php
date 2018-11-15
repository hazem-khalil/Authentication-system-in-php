<?php 
require_once("config.php");
require_once("includes/functions.php");

use Facebook\Exceptions\FacebookResponseException;
use \Facebook\Exceptions\FacebookSDKException;
try{
	$accessToken = $helper->getAccessToken();
} catch (FacebookResponseException $e) {
	echo "Response Exception: " . $e->getMessage();
	exit();
} catch (FacebookSDKException $e) {
	echo "SDK Exception: " . $e->getMessage();
	exit();
}

if (!$accessToken) {
	redirect_to("login.php");
}

$oAuth2Client = $fb->getOAuth2Client();

if (!$accessToken->isLongLived()) {
	$accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
}

$response = $fb->get(endpoint: "/me?fields=id, first_name, last_name, picture, email");
$userData = $response->getGraphNode()->asArray();

// var_dump($userData);

$_SESSION['userData'] = $userData;
$_SESSION['access_token'] = (string) $accessToken;

redirect_to("tasks/public/index.php");
?>