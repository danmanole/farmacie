<?php
namespace App\Models\Services;

class DBService {

	static $db;
	
	public function __construct() {
	    if (!isset(self::$db)) {
		  self::$db = \Config\Database::connect();
	    }
	}
	
	public function getDB() {
	    return self::$db;
	}
}