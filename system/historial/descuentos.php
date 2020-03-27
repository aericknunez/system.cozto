<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'application/common/Alerts.php';
include_once 'system/historial/Historial.php';

?>

  <div class="row justify-content-center">
    <div class="col-12 col-md-auto">
     <form name="form-descuentos" method="post" id="form-descuentos">
    <input placeholder="Seleccione una fecha" type="text" id="fecha" name="fecha" class="form-control datepicker my-2">
    </div>
  </div>

<div class="row justify-content-center">
  <button class="btn btn-info my-2 btn-rounded btn-sm waves-effect" type="submit" id="btn-descuentos" name="btn-descuentos">Mostra Datos</button>
  </form> 
</div>



<div class="row justify-content-md-center" id="loaderx">
	<img src="assets/img/loading.gif" alt=""></div>

<div id="contenido" class="mt-5">
<?php 
	$historial = new Historial;
	$historial->Descuentos(date("d-m-Y"));

 ?>
</div>