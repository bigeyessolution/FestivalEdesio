<?php 

class Application {
    public static function checkAuth () {
        return isset($_GET['secret']) and
            $_GET['secret'] != getConf()['security'];
    }
}