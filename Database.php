<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'root');
define('DB_NAME', 'web_service_register');

class Database
{
    
    var $conn;
    
        
	function __construct()
        {
		$this->conn = mysql_connect(DB_HOST,DB_USER,DB_PASS,true) or die('Can\'t connect to DB');
		mysql_select_db(DB_NAME, $this->conn) or die ('Can\'t select the DB');
		
		return $this->conn;		
		
        }
}

$dbObj = new Database();