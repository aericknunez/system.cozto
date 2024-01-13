<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'application/common/Alerts.php';
include_once 'system/facturar/ReportesFacturas.php';
$fac = new ReportesFacturas();
?>

  <div class="row justify-content-md-center">
    <div class="col-12 col-md-auto">
        <form name="form-reportef" method="post" id="form-reportef">
    <input placeholder="Seleccione una fecha" type="text" id="fecha1" name="fecha1" class="form-control datepicker my-2">
    <input placeholder="Seleccione una fecha" type="text" id="fecha2" name="fecha2" class="form-control datepicker my-2">

<?php 
  $fac->TiposTicketActivos();
 ?>

    </div>
  </div>


  <div class="row justify-content-md-center">
    <div class="col-12 col-md-auto text-center">
    <button class="btn btn-info my-2 btn-rounded btn-sm waves-effect" type="submit" id="btn-reportef" name="btn-reportef">Mostra Datos</button>
      </form> 
    </div>
  </div>

<div id="contenido" class="mt-5">

</div>


<!-- Modal -->
<div class="modal bounceIn" id="ModalVerFactura" tabindex="-1" role="dialog" aria-labelledby="ModalBusqueda"
  aria-hidden="true" data-backdrop="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">DETALLES DOCUMENTO ELECTRONICO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
<!-- CONTENIDO -->
        <div id="detalles">

        </div>
<!-- CONTENIDO -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>