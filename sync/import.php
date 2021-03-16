<?php
include_once '../application/common/Helpers.php'; // [Para todo]
include_once '../application/includes/variables_db.php';
include_once '../application/common/Mysqli.php';
include_once '../application/includes/DataLogin.php';
$db = new dbConn();
$seslog = new Login();
$seslog->sec_session_start();
include_once '../application/common/Fechas.php';




// busca todos los archivos en el directorio
$archivos = glob("database/*.sql");  
  foreach($archivos as $data){ 

  	$data = str_replace("database/", "", $data);
  	$hash = str_replace(".sql", "", $data);

    $archx = "database/" . $data;            


		// si no es sincronizacion lo ejecuto siempre
			if (file_exists($archx)) {
		    $sql = explode(";",file_get_contents($archx));//
			foreach($sql as $query){
			@$db->query($query);
			} @unlink($archx); } 

} // termina busqueda de archivos en la carpeta







?>