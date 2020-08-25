<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'application/common/Alerts.php';
include_once 'system/ecommerce/Movimientos.php';
$ecommerce = new Movimientos();

?>


<div id="msj"></div>

<div id="contenido">
  <?php 

  $ecommerce->VerTodosLosPedidos(1, "id", "desc");

   ?>
</div>






<!-- Ver productos -->
<div class="modal" id="ModalVer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="false">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
         DETALLES DE LA ORDEN</h5>
      </div>
      <div class="modal-body">
<!-- ./  content -->

<div id="vista"></div>

<!-- ./  content -->
      </div>
      <div class="modal-footer">

<a id="cerrarmodal" class="btn btn-primary btn-rounded" data-dismiss="modal">Regresar</a>
   
      </div>
    </div>
  </div>
</div>
<!-- ./  Modal -->






<!-- Ver estado de la orden -->
<div class="modal" id="ModalEstado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="false">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
         ESTADO DE LA ORDEN</h5>
      </div>
      <div class="modal-body">
<!-- ./  content -->
<form id="form-cambiaedo">
  <div class="input-group">
<div id="vistaestado"></div>
  <div class="input-group-append">
    <a id="btn-cambiaedo" orden="" user="" class="btn btn-md btn-outline-mdb-color m-0 px-3 py-2 z-depth-0 waves-effect">Cambiar</a>
  </div>
</div>
</form>
<!-- ./  content -->
      </div>
      <div class="modal-footer">

<a id="cerrarmodal" class="btn btn-primary btn-rounded" data-dismiss="modal">Regresar</a>
   
      </div>
    </div>
  </div>
</div>
<!-- ./  Modal -->
