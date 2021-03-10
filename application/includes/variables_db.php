<?php
date_default_timezone_set('America/El_Salvador');

if(Helpers::ServerDomain() == TRUE){

	if(Helpers::ServerDemo() == TRUE){
		define("HOST", "db5001821073.hosting-data.io"); 			//35.225.56.157 The host you want to connect to. 
		define("USER", "dbu687558"); 			// The database username. 
		define("PASSWORD", "Caca007125-"); 	// The database password. 
		define("DATABASE", "dbs1499036");
		define("XSERV", "http://s862695801.onlinehome.us/demo/");	
	} elseif(Helpers::ServerPractica() == TRUE){
		define("HOST", "db5001821462.hosting-data.io"); 			//35.225.56.157 The host you want to connect to. 
		define("USER", "dbu666364"); 			// The database username. 
		define("PASSWORD", "Caca007125-"); 	// The database password. 
		define("DATABASE", "dbs1499280");
		define("XSERV", "http://s862695801.onlinehome.us/practica/");		
	} else { /// para sistema normal
		define("HOST", "db5001821416.hosting-data.io"); 			//35.225.56.157 The host you want to connect to. 
		define("USER", "dbu690380"); 			// The database username. 
		define("PASSWORD", "Caca007125-"); 	// The database password. 
		define("DATABASE", "dbs1499253");
		define("XSERV", "http://s862695801.onlinehome.us/cozto/");		
	}
  

} else {

define("HOST", "localhost"); 			//35.225.56.157 The host you want to connect to. 
define("USER", "root"); 			// The database username. 
define("PASSWORD", "erick"); 	// The database password. 
define("DATABASE", "cozto_ventas"); 
define("XSERV", "http://localhost/cozto/");	

}

define("CAN_REGISTER", "any");
define("DEFAULT_ROLE", "member");
define("SECURE", FALSE);    // For development purposes only!!!!

// para el sistema
define("BASE_URL", "https://pizto.com/admin/");
define("BASEPATH", "https://pizto.com/admin/");	

define("VERSION", 2.8);	
?>