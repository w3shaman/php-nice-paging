<?php

$username = "";
$password = "";

// Connect to database
$pdo=new PDO("mysql:host=localhost;dbname=db;", $username, $password);

try {
		$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
} catch (PDOException $e) {
	die("Connection error: ". $e->getMessage());
}

?>