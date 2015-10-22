<?php
class Database extends PDO {
    protected static $db = FALSE;
    
    public function __construct () { 
        $application = getConf();
        
        $database = $application['database']['database'];
        $host = $application['database']['host'];
        $port = $application['database']['port'];
        
        parent::__construct (
            "mysql:dbname=$database;".
            "host=$host;".
            "port=$port;",
            $application['database']['user'],
            $application['database']['password']
        );
    }
    
    public static function getDatabase() {
        if (Database::$db === FALSE) {
            Database::$db = new Database();
        }
        
        return Database::$db;
    }
    
    /**
     * 
     * @param $table string
     * @param $params array
     *
     * @return
     */
    public function select ($table, $params) {
        $result = $this->query("SELECT * FROM $table ".
                               $params ? $params: ''
                               , PDO::FETCH_ASSOC);
                
        return $result;
    }
    
    public function insert ($table, $fields, $values, $types) {
        foreach($fields as $field) {
            $prepare [] = ':'.$field;    
        }
        
        $_fields = implode(',', $fields);
        $_values = implode(',', $values);
        $_prepare = implode(',', $prepare);
        
        $statement = $this->prepare ("INSERT INTO $table($_fields) VALUES ($_prepare)");
        
        foreach($types as $index => $type){
            $statement->bindParam($prepare[$index], $values[index], $type);
        }
        
        return $statement->execute();
    }
}