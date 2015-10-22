<?php

class Index extends RESTObject {
	public function GET() {
		
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
    
    public function printJSON () {
        header ('Content-Type: text/html');
        
        ?>

<html>
<header>
	<meta charset="utf-8">
    <title>Festival Ed&eacute;sio Santos da Can&ccedil;&atilde;o</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
</header>
<body>
<div style="text-align: center">
	<img src="/edesio/logo.png">
</div>
<div>
<h1 style="text-align: center;">
Inscri&ccedil;&otilde;es encerradas.
</h1>
</div>
</body>
</html>
        
<?php  }
}
