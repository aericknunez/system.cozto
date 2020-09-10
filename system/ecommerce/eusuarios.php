<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'application/common/Encrypt.php';
include_once 'application/common/Alerts.php';
include_once 'system/ecommerce/Movimientos.php';
$ecommerce = new Movimientos();

?>


<div id="msj"></div>

<div id="contenido">
  <?php 

  $ecommerce->ListarUsuarios();

   ?>
</div>






<!-- Ver productos -->
<div class="modal" id="ModalVer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="false">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
         DATOS GENERALES DEL USUARIO</h5>
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
