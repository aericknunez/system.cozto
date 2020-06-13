<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'application/common/Alerts.php';
include_once 'system/cliente/Cliente.php';
$cliente = new Clientes(); 

?>

<div id="msj"></div>
<h2 class="h2-responsive">FACTURAS REGISTRADAS AL CLIENTE</h2>


<div id="destinocliente">
   <?php $cliente->ClienteFacturas($_REQUEST["key"]); ?>
</div>


<!-- /// modal ver cleinte -->

<div class="modal" id="ModalVerCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="false">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
         DETALLES DE LA FACTURA</h5>
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
