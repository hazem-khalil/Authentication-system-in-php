<?php 
session_start();
require_once("Facebook/autoload.php");

$fb = new \Facebook\Facebook([
	'app_id' => '500815993730777',
	'app_secret' => 'f40813c4c57058288693f07f85e4b235',
	'default_graph_version' => 'v2.10'
]);

$helper = $fb->getRedirectLoginHelper();


?>