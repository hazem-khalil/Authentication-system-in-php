<?php

// Connection to database

try {
	$handler = new PDO('mysql:host=127.0.0.1;dbname=tasks', 'root', '');
	$handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	echo $e->getMessage();
	die();
}