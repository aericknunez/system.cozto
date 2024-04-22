<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'application/common/Alerts.php';
include_once 'system/facturar/CambioDatosCliente.php';
$client = new CambioDatosCliente();
?>

<div id="msj"></div>

<div class="clearfix">
  <h2 class="h2-responsive float-left">CLIENTES CREDITO FISCAL</h2> 
  <h2 class="h2-responsive float-right"><a href="?modal=dfactura&add" class="btn-floating btn-info btn-sm mb-3" title="Nuevo Cliente"><i class="fas fa-plus"></i></a></h2>
  <h2 class="h2-responsive float-right"><a id="buscarCliente" class="btn-floating btn-info btn-sm mb-3" title="Buscar"><i class="fas fa-search"></i></a></h2>
</div>


<div id="contenido">
    <?php
        $client->VerClientes(1, "id", "asc");
    ?>
</div>


<!-- /// modal ver cliente -->

<div class="modal" id="ModalVerCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="false">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
         DETALLES CLIENTE</h5>
      </div>
      <div class="modal-body">
<!-- ./  content -->

<div id="vista"></div>

<!-- ./  content -->
      </div>
      <div class="modal-footer">

<a href="" id="btn-pro" class="btn btn-secondary btn-rounded">Modificar Datos</a>
<a id="cerrarmodal" class="btn btn-primary btn-rounded" data-dismiss="modal">Regresar</a>

          
    
      </div>
    </div>
  </div>
</div>
<!-- ./  Modal -->


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

<!-- modal para buscar el Cliente -->
<div class="modal" id="ModalBuscarCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="false">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
         BUSCAR CLIENTE</h5>
      </div>
      <div class="modal-body">
<!-- ./  content -->

<div align="center">
  <div class="col-md-12 z-depth-2 justify-content-center">
      <div class="md-form mt-0">
        <form id="form-busqueda">
        <input class="form-control" type="text" placeholder="Buscar Cliente" aria-label="Search" id="clienteSearch" name="clienteSearch" autofocus>

        <button class="btn btn-info my-2 btn-rounded btn-sm waves-effect" type="submit" id="btn-busqueda" name="btn-busqueda">Buscar</button>


        </form>
      </div>
  </div>
</div>
      </div>
      <div class="modal-footer p-0">
<a id="cerrarmodal" class="btn btn-primary btn-rounded" data-dismiss="modal">Regresar</a>

          
    
      </div>
    </div>
  </div>
</div>
<!-- ./  Modal -->