<?
/// crea un backup en el sistema es elemental 

include_once '../common/Helpers.php';
include_once '../common/Fechas.php';
include_once '../includes/variables_db.php';
include_once '../common/Mysqli.php';
$db = new dbConn();

include_once '../../system/bdbackup/Backup.php';
  $back = new BackUp();
  $back-> Crear($_REQUEST["x"]);

?>