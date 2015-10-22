<?php

class votacao extends RESTObject {
	public function GET() { 
		//Retorna a hora e se há alguma votacao em aberto
		//Se receber uuid, verifica se o dispositivo pode votar (1 voto por dia) 
		throw new RESTMethodNotImplemented ('TotalDeVotos', 'GET');
	}

	public function POST() {
		$flag_pode_votar = TRUE;
		$message = '';
		
		$d1start = getConf()['dia1_inicio'];
		$d1end = getConf()['dia1_fim'];
		$d2start = getConf()['dia2_inicio'];
		$d2end = getConf()['dia2_fim'];
		
		$ctime = (new DateTime()) -> getTimestamp();
		
		$day = $d1start < $ctime and $ctime < $d1end ? 1 :
				$d2start < $ctime and $ctime < $d2end ? 2 : 
				FALSE;
		
        //Fazer verificacoes
        if (! $day) {
        	$flag_pode_votar = FALSE;
        	$error = "NOTOPEN";
        	$message = "Votações fechadas ou encerradas.";
        } elseif (!isset($_POST['idmusica']) or !isset($_POST['uuid'])) {
        	$flag_pode_votar = FALSE;
        	$error = "MISSING_PARAM";
        	$message = "Parâmetros insuficientes.";
        } elseif (! Application::checkAuth() ) {
        	$flag_pode_votar = FALSE;
        	$error = "NOT_AUTH";
        	$message = "Dispositivo não autorizado para votação";
        } elseif (! podeVotar($_POST['uuid'], $day)) { //O uuid tem 0 votos no dia?
        	$flag_pode_votar = FALSE;
        	$error = "CANTVOTE";
        	$message = "Dispositivo já votou em uma música hoje.";
        } elseif (! podeSerVotada ($_POST['idmusica'], $day)) {
        	$flag_pode_votar = FALSE;
        	$error = "CANTVOTE";
        	$message = "Esta música não existe ou não está disponível para votação";
        }
        
		if ($flag_pode_votar) {
			if (Database::getDatabase()->insert('votacao', 
                array('idmusica'), array($_POST['idmusica']), array(PDO::PARAM_INT) )) {
		        $message = "Voto computado com sucesso!";
		    } else {
		       	$flag_pode_votar = FALSE;
		    	$error = "SQLERR";
		    	$message = "Ocorreu um erro ao computar o voto.";
		    }
		}
        
		$result ['status'] = $flag_pode_votar ? 'OK' : 'ERROR';
		$result ['message'] = $message;
		if (isset ($error)) $result ['error'] = $error;
		
		$this->setResult ($result);
    }
    
    public function PUT () {
        throw new RESTMethodNotImplemented ('TotalDeVotos', 'PUT');
    }
    
    public function DELETE() {
        throw new RESTMethodNotImplemented ('TotalDeVotos', 'DELETE');
    }
    
    private function podeVotar($uuid, $dia) {
    	if ($dia == FALSE) return FALSE;
    
    	$podeVotar = FALSE;
    
		$resultSet = Database::getDatabase()->select(
				'dispositivos', "uuid = '$uuid'"
		)->fetch(PDO::FETCH_ASSOC);
			
		if ($resultSet) {
			$v1 = (boolean) $resultSet['dia1'];
			$v2 = (boolean) $resultSet['dia2'];
				
			$votou = $dia == 1 ? $v1 : $dia == 2 ? $v2 : FALSE; 
				
			$podeVotar = $dia != FALSE and $votou == FALSE;
		}
 		
 		return $podeVotar;       
    }
    
    private function podeSerVotada ($idmusica, $dia) {
    	if ($dia == FALSE) return FALSE;
    	
    	$podeSerVotada = FALSE;
    	
    	$resultSet = Database::getDatabase()->select(
				'musicas', "idmusica = '$idmusica'"
		)->fetch(PDO::FETCH_ASSOC);
			
		if ($resultSet) {
			$mdia = (int) $resultSet['dia'];
				
			$podeSerVotada = $dia == $mdia;
		}
    	
    	return $podeSerVotada;
    }
}
