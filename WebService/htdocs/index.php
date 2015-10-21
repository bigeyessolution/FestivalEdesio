<?php 
require_once '../autoconf.php';

//echo var_dump($_SERVER);

Router::init();

Router::executeMethod();

Router::getObject()->printJSON();