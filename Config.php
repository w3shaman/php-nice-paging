<?php
// trying out git on linux terminal.

Class Config {

	private static $_dbType = 'mysql';
	private static $_host = 'localhost';
	private static $_username = 'root';
	private static $_password = '123xyz';
	private static $_dbname = 'lab';

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
