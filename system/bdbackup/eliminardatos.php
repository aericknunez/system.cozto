<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'system/bdbackup/Backup.php';
include_once 'application/common/Encrypt.php';

include_once 'application/common/Alerts.php';

?>

<div class="row d-flex justify-content-center">
  <div class="col-md-8">



<div class="text-center">
	<h1 class="h1-responsive">ELIMINAR DATOS</h1>
	

	<div id="vista">

<?php 

Alerts::Mensajex("IMPORTANTE: Esta a punto de eliminar todos los datos del sistema y éste quedará en limpio. si continua no puede deshacer esta acción","danger", '<a id="deleteall" class="btn  btn-danger">Eliminar</a>');
 ?>		


	</div>

</div>




  </div>
</div>