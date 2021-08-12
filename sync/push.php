<?php
include_once '../application/common/Helpers.php'; // [Para todo]
include_once '../application/includes/variables_db.php';
include_once '../application/common/Mysqli.php';
include_once '../application/includes/DataLogin.php';
$db = new dbConn();
$seslog = new Login();
$seslog->sec_session_start();
include_once '../application/common/Fechas.php';

///sftp
include_once '../application/common/SFTP/Net/SFTP.php';


// busco el numero de local

    if ($r = $db->select("td", "config_root", "WHERE id = 1")) { 
        $_SESSION["temporal_td"] = $r["td"];
    } unset($r);  



// busca todos los respaldo no subidos y los sube
    $aw = $db->query("SELECT * FROM sync_up WHERE subido = 0 and td = ".$_SESSION["temporal_td"]."");
    foreach ($aw as $bw) {
    	$sync = $bw["comprobacion"];
    	$fichero = $sync . ".sql";
			if (file_exists($fichero)){ 
					
						if(SubirFtp($sync) == TRUE){
							@unlink($sync . ".sql");
						}
				
			}
  
    } 
    unset($sync); 
    $aw->close();


/////////// RESPALDAR ////////

include_once '../system/sync/Push.php';
$pushed =  new Push;
$sync = $pushed->Execute($_REQUEST["corte"]);

if($sync != NULL){
	if(SubirFtp($sync) == TRUE){
		@unlink($sync . ".sql");
	}
} 


$data =  file_get_contents('https://datos.hibridosv.com/sync/import_i.php?x=' . $_SESSION["temporal_td"]);
$datos = json_decode($data, true);


unset($_SESSION["temporal_td"]);





function SubirFtp($sync){
	include_once '../system/sync/Ftp.php';
		$subir =  new Ftp;
		if($subir->Servidor("access862695802.webspace-data.io",
						"u103976998-upcozto",
						"Hibrido007125-",
						$sync,
						"/sync/database/",
						"C:/AppServ/www/cozto/sync/". $sync .".sql") == TRUE){
						return TRUE;
		} else {
			return FALSE;
		}
}


if($_REQUEST["corte"] != NULL){
	echo '<script>
			window.location.href="?corte";
	</script>';
}

?>