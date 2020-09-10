<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'application/common/Alerts.php';
include_once 'system/ecommerce/Movimientos.php';
$ecommerce = new Movimientos();

?>

<div id="msj"></div>
<h2 class="h2-responsive">Todos los Productos</h2>


<div id="contenido">
   <?php $ecommerce->CategoriasPronombre(); ?>
</div>


<!-- Ver AGREGAR -->
<div class="modal" id="ModalCambiarPronombre" tabindex="-1" role="dialog" aria-labelledby="ModalCambiarPronombre" aria-hidden="true"  data-backdrop="false">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
         CAMBIAR NOMBRE</h5>
      </div>
      <div class="modal-body">
<!-- ./  content -->

<div id="cat"></div>
<hr>
<div id="vista_pronombre">
       
<form id="form-pronombre" name="form-pronombre">
<input type="hidden" name="hash" id="hash" />
<input type="text" step="any" name="pronombre" id="pronombre" class="my-2 form-control" placeholder="Nombre en Ecommerce"/>

<div align="center"><button class="btn btn-outline-info btn-rounded z-depth-0 my-4 waves-effect" type="submit" id="btn-pronombre" name="btn-pronombre">Registrar</button> </div>
</form>


</div>

<!-- ./  content -->
      </div>
      <div class="modal-footer">

<a id="cerrarmodal" class="btn btn-primary btn-rounded" data-dismiss="modal">Regresar</a>
         
    
      </div>
    </div>
  </div>
</div>
<!-- ./  Modal -->