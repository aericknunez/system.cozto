<?php
include_once '../../application/common/Helpers.php'; // [Para todo]
include_once '../../application/includes/variables_db.php';
include_once '../../application/common/Mysqli.php';
include_once '../../application/includes/DataLogin.php';
$db = new dbConn();
$seslog = new Login();
$seslog->sec_session_start();
include_once '../../application/common/Fechas.php';



if ($r = $db->select("td", "config_root", "WHERE id = 1")) { 
    $_SESSION["temporal_td"] = $r["td"];
} unset($r);  


if($r = $db->select("max(version)", "system_version", "WHERE td = ".$_SESSION["temporal_td"])) {
	$version = $r["max(version)"];
} unset($r);  



// busca todos los archivos en el directorio
$archivos = glob("*.sql", GLOB_BRACE);  
  foreach($archivos as $data){ 

  	$hash = str_replace(".sql", "", $data);


// echo "<br>" . $data;
 if($hash > $version){

	if (file_exists($data)) {
	    $sql = explode(";",file_get_contents($data));
		foreach($sql as $query){
		@$db->query($query);
		} 

		$datox = array();
	    $datox["version"] = $hash;
	    $datox["fecha"] = date("d-m-Y");
	    $datox["hora"] = date("H:i:s");
	    $datox["hash"] = Helpers::HashId();
		$datox["time"] = Helpers::TimeId();
	    $datox["td"] = $_SESSION["temporal_td"];
	    $db->insert("system_version", $datox);
	} 


 } // version

} // termina busqueda de archivos en la carpeta




/// voy a buscar las ultimas tablas para ingresarlas al sistema
$check = strtoupper(sha1(date("d:m:Y:H")));

$vesiones =  file_get_contents("https://app.hibridosv.com/api/version.php?x=2&check=" . $check); 
$ver = json_decode($vesiones, true);




if($ver["version"] != $version){


$data =  file_get_contents("https://app.hibridosv.com/api/tablas_update.php?x=2&check=" . $check); 
$datos = json_decode($data, true);

	if($datos != NULL){
	    $db->query("TRUNCATE sync_tabla");
		foreach ($datos as $valores) { 
			$data = array();
			$data["tabla"] = $valores["tabla"];
			$data["edo"] = 1;
	      	$data["hash"] = Helpers::HashId();
	      	$data["time"] = Helpers::TimeId();
			$data["td"] = $_SESSION["temporal_td"];
			$db->insert("sync_tabla", $data); 
		}
	}
}


unset($_SESSION["temporal_td"]);

?>