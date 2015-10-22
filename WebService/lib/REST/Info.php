<?php

class Info extends RESTObject {
	public function GET() {
		$flag_pode_votar = FALSE;
	
		$d1start = getConf()['dia1_inicio'];
		$d1end = getConf()['dia1_fim'];
		$d2start = getConf()['dia2_inicio'];
		$d2end = getConf()['dia2_fim'];
		
		$datetime = new DateTime();
		$ctime = $datetime->getTimestamp();
		
		$day = $d1start < $ctime and $ctime < $d1end ? 1 :
				$d2start < $ctime and $ctime < $d2end ? 2 : 
				FALSE;
		
		if (isset ($_GET['uuid'])){
			$uuid = $_GET['uuid'];
			$resultSet = Database::getDatabase()->select(
				'dispositivos', "uuid = '$uuid'"
			)->fetch(PDO::FETCH_ASSOC);
			
			if ($resultSet) {
				$v1 = (boolean) $resultSet['dia1'];
				$v2 = (boolean) $resultSet['dia2'];
				
				$votou = $day == 1 ? $v1 : $day == 2 ? $v2 : FALSE; 
				
				$podeVotar = $day != FALSE and $votou == FALSE;
				
				$result ['cadastrado'] = TRUE;
			} elseif (isset($_GET['plataforma']) and isset($_GET['modelo'])) {
				if (Database::getDatabase()->insert('dispositivos', 
		            array('uuid', 'plataforma', 'modelo'), 
		            array($_GET['uuid'], $_GET['plataforma'], $_GET['modelo']), 
		            array(PDO::PARAM_STR, PDO::PARAM_STR, PDO::PARAM_STR) )) {
				    $result ['cadastrado'] = TRUE;
		        } else {
		        	$result ['cadastrado'] = FALSE;
		        }
		    
			}
		}
		
        $result ['status'] = 'OK';
        $result ['date_time'] = $datetime;
        $result ['time'] = $ctime;
        
        if ($day) {
        	$result ['votacao'] = 'aberta';
        	$result ['dia'] = $day;
        	$result ['pode_votar'] = $podeVotar;
        } else {
        	$result ['votacao'] = $d2end < $ctime ? 'encerrada' : 'fechada';
        }
        
        $this->setResult ($result);
	}
    
    public function POST() {
        throw new RESTMethodNotImplemented ('TotalDeVotos', 'POST');
    }
    
    public function PUT () {
        throw new RESTMethodNotImplemented ('TotalDeVotos', 'PUT');
    }
    
    public function DELETE() {
        throw new RESTMethodNotImplemented ('TotalDeVotos', 'DELETE');
    }

}
