<?php

class votacao extends RESTObject {
    public function GET($id) {
        throw new RESTMethodNotImplemented ('TotalDeVotos', 'GET');
	}
    
    public function POST() {
        
    }
    
    public function PUT () {
        throw new RESTMethodNotImplemented ('TotalDeVotos', 'PUT');
    }
    
    public function DELETE() {
        throw new RESTMethodNotImplemented ('TotalDeVotos', 'DELETE');
    }
}