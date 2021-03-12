<?php
include_once '../application/common/Helpers.php'; // [Para todo]
include_once '../application/includes/variables_db.php';
include_once '../application/common/Mysqli.php';
include_once '../application/includes/DataLogin.php';
$db = new dbConn();
$seslog = new Login();
$seslog->sec_session_start();
include_once '../application/common/Fechas.php';


$fecha = date("d-m-Y");
$hora = date("H:i:s");

    if ($r = $db->select("td", "config_root", "WHERE id = 1")) { 
        $_SESSION["temporal_td"] = $r["td"];
    } unset($r);  



$data =  file_get_contents('https://app.hibridosv.com/api/bd_remota.php?x=' . $_SESSION["temporal_td"] . '&type=2');  
$datos = json_decode($data, true);


foreach ($datos as $valores) { // vamos hacer un archivo por cada hash
	$sync = $valores["hash"];
echo $sync;
$a = $db->query("SELECT * FROM login_db_sync WHERE hash = '$sync'");
if($a->num_rows == 0){


$data =  file_get_contents('https://app.hibridosv.com/api/bd_remota.php?validate=1&hash='.$sync.'&x='.$_SESSION["temporal_td"].'&type=2');  
$result = json_decode($data, true);


	print_r($result);

if($result != NULL){
    foreach($result as $keys => $values){
	      if($result[$keys]['success'] == '1'){
	      		$dato = array();
				$dato["hash"] = $sync;
				$dato["fecha"] = $fecha;
				$dato["hora"] = $hora;
				$db->insert("login_db_sync", $dato);

				// aqui ejecuto el sql que deberia estar en el directorio descargado de git
				$archx = "sql/" . $sync . ".sql";            

				if (file_exists($archx)) {
				$sql = explode(";",file_get_contents($archx));//
				foreach($sql as $query){
				@$db->query($query);
				} @unlink($archx); } 

				//
	     }
    }
}


	} $a->close();




} // foreach





///////// actualizar el root
if($data = file_get_contents('https://pizto.com/login/application/includes/root_json.php?x=' . $_SESSION["temporal_td"])){
	$cambio = json_decode($data, true);
	$db->update("config_root", $cambio, "WHERE td=".$_SESSION["temporal_td"]."");
}

unset($_SESSION["temporal_td"]);

?>