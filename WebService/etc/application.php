<?php
/**
 *
 */
function getConf() {
    $conf ['database'] = 'juazeiro24';
    $conf ['host'] = 'localhost';
//    $conf ['host'] = 'mysql.juazeiro.ba.gov.br';
    $conf ['port'] = '3306';
    $conf ['user'] = 'juazeiro24';
    $conf ['password'] = '9TnP37Wx9S';
    $conf ['secret_key'] = 'aWynosC7nNQrxSWFuoofpgyoDmRwDr';
    $conf ['dia1_inicio'] = (new DateTime ('2015-10-22 20:00:00.000000'))->getTimestamp();
    $conf ['dia1_fim'] = (new DateTime ('2015-10-22 23:59:59.999999'))->getTimestamp();
    $conf ['dia2_inicio'] = (new DateTime ('2015-10-23 20:00:00.000000'))->getTimestamp();
    $conf ['dia2_fim'] = (new DateTime ('2015-10-23 23:59:59.999999'))->getTimestamp();
    
    return $conf;
}
