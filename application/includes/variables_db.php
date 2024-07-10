<?php
date_default_timezone_set('America/El_Salvador');


define("HOST", "localhost");	 
define("USER", "sistxtyv_erick"); 					
define("PASSWORD", Encrypt::decrypt('ZmdEV09vNnBIU2pOTVVWczBMR2dnZz09', 'https://hibridosv.com')); 			
define("DATABASE", "sistxtyv_cozto");
define("XSERV", "http://sistema-sv.pro/");
define("TYPE", "OnLine");			


// define("HOST", "127.0.0.1");	 
// define("USER", Encrypt::decrypt('SmhpQU5jT0FGUkdSTXZRZUpnM1BCUT09', 'https://hibridosv.com')); 					
// define("PASSWORD", Encrypt::decrypt('eTB5TmNOcHBMaFJkemRGSW1ISmdUd0ZRTHdyNWhLVVd2cklIRk9kZmRoOD0=', 'https://hibridosv.com')); 			
// define("DATABASE", Encrypt::decrypt('elM4cFozL1pMN2dFWWxRMXk2VGIvUT09', 'https://hibridosv.com'));
// define("XSERV", "https://sistema.pizto.com/");
// define("TYPE", "OnLine");			

define("URL_TRANSFERENCIA", "http://sistema-sv.pro/coztoapi/");  


define("CAN_REGISTER", "any");
define("DEFAULT_ROLE", "member");
define("SECURE", FALSE);    						// For development purposes only!!!!

// para el sistema
define("BASE_URL", "http://sistema-sv.pro/");
define("BASEPATH", "http://sistema-sv.pro/");	

define("VERSION", 01.04);	
?>