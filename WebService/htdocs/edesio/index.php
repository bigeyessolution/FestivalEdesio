<?php 
require_once '../../autoconf.php';

Router::init();

Router::executeMethod();

Router::getObject()->printJSON();
