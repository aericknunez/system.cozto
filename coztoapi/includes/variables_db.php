<?php
date_default_timezone_set('America/El_Salvador');


define("HOST", "127.0.0.1");	 
define("USER", Encrypt::decrypt('SmhpQU5jT0FGUkdSTXZRZUpnM1BCUT09', 'https://hibridosv.com')); 					
define("PASSWORD", Encrypt::decrypt('eTB5TmNOcHBMaFJkemRGSW1ISmdUd0ZRTHdyNWhLVVd2cklIRk9kZmRoOD0=', 'https://hibridosv.com')); 			
define("DATABASE", 'cozto_api');
define("XSERV", "coztoapi.hibridosv.com/");
define("TYPE", "Online");	


define("CAN_REGISTER", "any");
define("DEFAULT_ROLE", "member");
define("SECURE", FALSE);    						// For development purposes only!!!!

define("VERSION", 01.00);	
?>