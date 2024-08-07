<?php
date_default_timezone_set('America/El_Salvador');


// define("HOST", "localhost");	 
// define("USER", "sistxtyv_erick"); 					
// define("PASSWORD", Encrypt::decrypt('ZmdEV09vNnBIU2pOTVVWczBMR2dnZz09', 'https://hibridosv.com')); 			
// define("DATABASE", "sistxtyv_cozto");
// define("XSERV", "http://sistema-sv.pro/");
// define("TYPE", "OnLine");			


define("HOST", "127.0.0.1");	 
define("USER", Encrypt::decrypt('K0lDVGNlaEs2TEJYOUx4dGpJdFZSQT09', 'https://hibridosv.com')); 					
define("PASSWORD", Encrypt::decrypt('enJwV1N5bnhlL1NyWHJTcEdZMWNqZz09', 'https://hibridosv.com')); 			
define("DATABASE", Encrypt::decrypt('U2pZZHVwb2ZmUWlTWlZIUms5Vit4dz09', 'https://hibridosv.com'));
define("XSERV", "https://sistema-sv.pro/");
define("TYPE", "OnLine");			

define("URL_TRANSFERENCIA", "https://sistema-sv.pro/coztoapi/");  


define("CAN_REGISTER", "any");
define("DEFAULT_ROLE", "member");
define("SECURE", FALSE);    						// For development purposes only!!!!

// para el sistema
define("BASE_URL", "https://sistema-sv.pro/");
define("BASEPATH", "https://sistema-sv.pro/");	

define("VERSION", 01.04);	
?>