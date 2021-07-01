<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'application/common/Alerts.php';
include_once 'system/transferencias/Transferencias.php';
$transferencias = new Transferencias(); 
?>

<div id="msj"></div>

<div class="clearfix">
  <h2 class="h2-responsive float-left">TRANSFERENCIAS POR ACEPTAR</h2> 
  <h2 class="h2-responsive float-right"><a id="nueva_tranferencia" class="btn-floating btn-info btn-sm mb-3" title="Nueva Transferencia"><i class="fas fa-plus"></i></a></h2>
</div>
<hr class="z-depth-1-half mb-3">




<div id="contenido">
   <?php 
   $transferencias->OrdenesPendientes(URL_TRANSFERENCIA .'?op=10&iden=' . $_SESSION["td"]); 
   ?>


</div>






<!-- modal para nueva tranferencia -->
<div class="modal" id="ModalNuevo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="false">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
         NUEVA TRANFERENCIA</h5>
      </div>
      <div class="modal-body">
<!-- ./  content -->

<div align="center" id="formulario_b">
  <div class="col-md-12 z-depth-2 justify-content-center">
      <div class="md-form mt-0">
        <form id="p-busqueda">
        <input class="form-control" type="text" placeholder="Buscar Producto" aria-label="Search" id="key" name="key" autofocus>

        </form>
      </div>
  </div>
  <div class="col-md-12 z-depth-2 justify-content-center" id="muestra-busqueda"></div>
</div>

<div id="muestra-busqueda"> </div>



<form id="form-add" name="form-add">
<div id="vista_form"></div>

<input type="number" step="any" id="cantidad" name="cantidad" class="form-control mb-3" placeholder="Cantidad">
<button class="btn btn-info my-4" type="submit" id="btn-add" name="btn-add">Agregar Producto</button>

</form>



<div id="vista_ver"></div>
<!-- ./  content -->
      </div>
      <div class="modal-footer">

<a id="cerrar_modal" class="btn btn-primary btn-rounded">Regresar</a>
  
      </div>
    </div>
  </div>
</div>
<!-- ./  Modal -->