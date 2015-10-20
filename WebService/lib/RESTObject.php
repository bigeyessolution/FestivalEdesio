<?php 

abstract class RESTObject {
    protected static $object = false;
    
    protected $result = (object) array();
    
    abstract public function GET($id);
    
    abstract public function POST();
    
    abstract public function PUT ();
    
    abstract public function DELETE();
    
    public function getJSON () {
	return json_encode (
		$this->result, 
		JSON_NUMERIC_CHECK | 
		JSON_PRESERVE_ZERO_FRACTION | 
		JSON_ERROR_NONE
		);
    }
    
    public function printJSON () {
        header ('application/json');
        
        print $this->getJSON();
    }
    
    public static function objectFactory () {
        if (RESTObject::$object === false) {
            $object_name = Route::getObjectName ();
            
            if (file_exists("./REST/$object_name.php")) {
                require_once "./REST/$object_name.php";
                
                RESTObject::$object = new $object_name ();
            } else {
                //Exception
            }
        }
        
        RESTObject::$object
    }
}
