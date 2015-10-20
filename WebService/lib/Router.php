<?php 

class Router {
    const GET = -2365;
    const POST = -2366;
    const PUT = -2367;
    const DELETE = -2368;
    
    public function __construct () {
        
    }
    
    /**
     *
     * @return RESTObject
     */
    public static function getObjectName () {
        
        return $object;
    }
    
    public function getMethod () {
        return false;
    }
}