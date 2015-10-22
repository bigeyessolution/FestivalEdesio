<?php 

class TotalDeVotos extends RESTObject {
	public function GET() {
        $st = Database::getDatabase()->select('total_de_votos');
        
        $result = array ();
        
        while ($row = $st->fetch(PDO::FETCH_ASSOC)) {
            $result [] = (object) $row;
        }
        
        $this->setResult (
            array (
                'status' => 'OK',
                'content' => (object) $result
            )
        );
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
