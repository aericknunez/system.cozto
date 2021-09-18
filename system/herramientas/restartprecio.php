<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'application/common/Alerts.php';
include_once 'system/herramientas/RestablecerPrecio.php';
$restart = new RestablecerPrecio(); 
?>

<div id="msj"></div>
<h2 class="h2-responsive">Restablecer Precios</h2>

<div align="center">
  <div class="col-md-6 z-depth-2 justify-content-center">
      <div class="md-form mt-0">
        <input class="form-control" type="text" placeholder="Buscar" aria-label="Search" id="producto-busqueda" name="producto-busqueda" autofocus>
      </div>
  </div>
  <div class="col-md-6 z-depth-2 justify-content-center" id="muestra-busqueda"></div>
</div>


<?php
    if ($_REQUEST["key"]) {
?>


<div id="contenido">
       <?php
            $restart->DetallesProducto($_REQUEST["key"]);
       ?>
</div>


<?php
    }
?>
<!-- Ver producto -->
<div class="modal" id="ModalVer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="false">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
         CAMBIAR PRECIO ESTABLECIDO</h5>
      </div>
      <div class="modal-body">
<!-- ./  content -->

<div id="vista_ver">

    <form class="text-center border border-light p-3" id="form-cambiaprecio" name="form-cambiaprecio">

    <input type="number" step="any" id="cantidad" name="cantidad" class="form-control mb-3" placeholder="Cantidad">
    <input type="hidden" id="iden" name="iden" value="">
    <button class="btn btn-info my-4" type="submit" id="btn-cambiaprecio" name="btn-cambiaprecio">Agregar Cantidad</button>
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




