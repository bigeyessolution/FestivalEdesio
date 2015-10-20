<?php

class Database extends PDO {
    protect static $db = FALSE;
    
    public function __construct () {
        parent::__construct (
            "mysql:dbname=${application ['database']['database']};".
            "host=${application ['database']['host']};".
            "port=${application ['database']['port']};",
            $application ['database']['user'],
            $application ['database']['password']
        );
    }
    
    public static function getDatabase() {
        if (Database::$db === FALSE) {
            Database::$db = new Database();
        }
        
        return Database::$db;
    }
}