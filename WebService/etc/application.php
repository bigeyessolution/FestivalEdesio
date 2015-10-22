<?php
/**
 *
 */
function getConf() {
    return array (
        'database' => array (
            'database' => 'juazeiro24',
            'host' => 'localhost',
            'port' => '3306',
            'user' => 'juazeiro24',
            'password' => '9TnP37Wx9S'
        ),
        'security' => array (
            'secret_key' => 'SenhaDeTeste'
        ),
        'dia01' => array (
        	'inicio' => (new DateTime ('2015-10-22 20:00:00.000000'))->getTimestamp(),
        	'fim' => (new DateTime ('2015-10-22 23:59:59.999999'))->getTimestamp()
        ),
        'dia02' => array (
        	'inicio' => (new DateTime ('2015-10-23 20:00:00.000000'))->getTimestamp(),
        	'fim' => (new DateTime ('2015-10-23 23:59:59.999999'))->getTimestamp()
        )
    );
  
} 
