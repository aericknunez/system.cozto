<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'system/bdbackup/Backup.php';
include_once 'application/common/Encrypt.php';

include_once 'application/common/Alerts.php';


if ($_SESSION["tipo_cuenta"] == 1) {
?>

<div class="row d-flex justify-content-center">
  <div class="col-md-8">



<div class="text-center">
	<h1 class="h1-responsive">ELIMINAR DATOS</h1>
	

	<div id="vista">

<?php 

Alerts::Mensajex("IMPORTANTE: Esta a punto de eliminar todos los datos del sistema y éste quedará en limpio. si continua no puede deshacer esta acción","danger");
 ?>		

<p class="note note-info"><strong>Eliminar Datos:</strong> Eliminará todos los datos que se han generado en el sistema (Mentiene intactos los usuarios y configuraciones de la cuenta) <br>
<a id="deleteall" class="btn  btn-success">Eliminar Datos</a></p>

<p class="note note-primary"><strong>Eliminar con configuraciones:</strong> Eliminará todos los datos incluidos las configuraciones (Mentiene intactos los usuarios de la cuenta) <br>
<a id="deleteallconfig" class="btn  btn-warning">Eliminar daos</a></p>

<p class="note note-secondary"><strong>Eliminar con Usuarios:</strong> Eliminará todos los datos incluidos las configuraciones y cuentas de usuario de la cuenta <br>
<a id="deletealluser" class="btn  btn-danger">Eliminar Todo</a>
</p>






	</div>

</div>




  </div>
</div>


<?php } else {
Alerts::Mensajex("ERROR: Su cuenta de usuario no tiene permisos para estar en esta sección!","danger");
} ?>