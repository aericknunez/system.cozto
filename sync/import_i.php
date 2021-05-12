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


// obtiene el td de cada hash subido
  	$numero = strpos($hash, "-"); // extrae caracteres antes del primer  -
	$td = substr($hash,0,$numero); // extrae el td
	$c_antes = strlen($td); // cuenta el numero de caracteres de td
	$numero2 = strrchr ($hash, "-"); // extrae caracteres antes del segundo  -
	$c_despues = strlen($numero2); // cuenta el numero de caracteres de td
	$codigo_td = substr($hash,$c_antes+1,-$c_despues); // obtiene el td separado por los giones



	if (file_exists($archx) and $_REQUEST["x"] == $codigo_td) {
    $sql = explode(";",file_get_contents($archx));//
	foreach($sql as $query){
	@$db->query($query);
	} @unlink($archx); } 



} // termina busqueda de archivos en la carpeta







?>