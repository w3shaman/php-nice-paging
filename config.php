<?php

// Some needed sonnection variables.
$host = "localhost";
$username = "root";
$password = "";
$database = "db";

// Connect to database.
$pdo=new PDO("mysql:host=$host;dbname=$database;", $username, $password);

try {
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}
catch (PDOException $e) {
	die("Connection error: ". $e->getMessage());
}
