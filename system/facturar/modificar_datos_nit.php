<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'application/common/Alerts.php';
include_once 'system/facturar/CambioDatosCliente.php';
$client = new CambioDatosCliente();
?>

<div id="msj"></div>

<div class="clearfix">
  <h2 class="h2-responsive float-left">CLIENTES FACTURA</h2> 
  <h2 class="h2-responsive float-right"><a href="?modal=dfactura&add" class="btn-floating btn-info btn-sm mb-3" title="Nuevo Cliente"><i class="fas fa-plus"></i></a></h2>
</div>

<div id="contenido">
    <?php
        $client->VerClientes(1, "id", "asc");
    ?>
</div>





<!-- MODAL PARA CONFIRMAR ELIMINACION -->

<div class="modal fade" id="ConfirmDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
    <!--Content-->
    <div class="modal-content text-center">
      <!--Header-->
      <div class="modal-header d-flex justify-content-center">
        <p class="heading">Seguro que desea eliminar este elemento?</p>
      </div>

      <!--Body-->
      <div class="modal-body">

        <i class="fas fa-times fa-4x animated rotateIn"></i>

      </div>

      <!--Footer-->
      <div class="modal-footer flex-center">
        <a id="borrar-cliente" class="btn  btn-outline-danger">Eliminar</a>
        <a type="button" class="btn  btn-danger waves-effect" data-dismiss="modal">No</a>
      </div>
    </div>
    <!--/.Content-->
  </div>
</div>
<!--Modal: modalConfirmDelete-->