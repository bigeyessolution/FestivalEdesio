<?php 

class Application {
    public static function checkAuth () {
        return isset($_POST['secret']) and
            $_POST['secret'] != getConf()['security'];
    }
}