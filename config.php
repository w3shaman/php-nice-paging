<?php
<<<<<<< HEAD

$username = "";
$password = "";

// Connect to database
$pdo=new PDO("mysql:host=localhost;dbname=db;", $username, $password);

//i.e orcl or whatever you named your service during installation
?>
=======
// trying out git on linux terminal.

Class Config {

private static $_dbType = 'mysql';
private static $_host = '127.0.0.1';
private static $_username = 'root';
private static $_password = '';
private static $_dbname = 'db';

private function __construct() {
	$this->_dbType = $_dbType;
	$this->_host = $_host;
	$this->_username = $_username;
	$this->_password = $_password;
	$this->_dname = $_dname;

}

public static function getDbType() {
	return self::$_dbType;
}

public static function getHost() {
	return self::$_host;
}

public static function getUser() {
	return self::$_username;
}

public static function getPass() {
	return self::$_password;
}

public static function getDbname() {
	return self::$_dbname;
}
	

} //end of class config
>>>>>>> 57cdb31cd7c69f2748834f7f790e0fce454d500f
