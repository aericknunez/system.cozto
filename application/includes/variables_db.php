<?php
date_default_timezone_set('America/El_Salvador');

if(Helpers::ServerDomain() == TRUE){

	if(Helpers::ServerDemo() == TRUE){
		define("HOST", "db5001821073.hosting-data.io");  
		define("USER", "dbu687558"); 					
		define("PASSWORD", "Caca007125-"); 				
		define("DATABASE", "dbs1499036");
		define("XSERV", "cozto.hibridosv.com/demo/");
		define("TYPE", "Demo");	
	} elseif(Helpers::ServerPractica() == TRUE){
		define("HOST", "db5001821462.hosting-data.io");	
		define("USER", "dbu666364"); 				
		define("PASSWORD", "Caca007125-"); 				
		define("DATABASE", "dbs1499280");
		define("XSERV", "http://cozto.hibridosv.com/practica/");
		define("TYPE", "Practica");			
	} else { /// para sistema normal online

		if($_SERVER["SERVER_NAME"] == "sistema.hibridosv.com" or $_SERVER["SERVER_NAME"] == "arguetaautomotriz.com"){
			define("HOST", "db5001821416.hosting-data.io");	 
			define("USER", "dbu690380"); 					
			define("PASSWORD", "Caca007125-"); 			
			define("DATABASE", "dbs1499253");
			define("XSERV", "http://sistema.hibridosv.com/");
			define("TYPE", "OnLine");			
		} else { // para data de los instalados
			define("HOST", "db5001931634.hosting-data.io");
			define("USER", "dbu1170340"); 
			define("PASSWORD", "Caca007125-"); 				
			define("DATABASE", "dbs1580854");
			define("XSERV", "datos.hibridosv.com/");
			define("TYPE", "Respaldos");	
		}
	
	}

define("URL_TRANSFERENCIA", "https://coztoapi.hibridosv.com/");  

} else {

define("HOST", "localhost"); 							//35.225.56.157 The host you want to connect to. 
define("USER", "root"); 								// The database username. 
define("PASSWORD", "erick"); 							// The database password. 
define("DATABASE", "cozto_ventas"); 
define("XSERV", "http://localhost/cozto/");	
define("TYPE", "Local");

define("URL_TRANSFERENCIA", "http://localhost/coztoapi/");

}

define("CAN_REGISTER", "any");
define("DEFAULT_ROLE", "member");
define("SECURE", FALSE);    						// For development purposes only!!!!

// para el sistema
define("BASE_URL", "https://pizto.com/admin/");
define("BASEPATH", "https://pizto.com/admin/");	

define("VERSION", 01.03);	
?>