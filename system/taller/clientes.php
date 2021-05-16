<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'application/common/Alerts.php';
include_once 'system/taller/Taller.php';
$taller = new Taller(); 
?>

<div id="msj"></div>

<div class="clearfix">
  <h2 class="h2-responsive float-left">CLIENTES</h2> 
  <h2 class="h2-responsive float-right"><a id="addcliente" class="btn-floating btn-info btn-sm mb-3" title="Nuevo Cliente"><i class="fas fa-plus"></i></a></h2>
</div>




<div id="contenido">
   <?php 
   $taller->VerClientes(1, "id", "desc"); ?>
</div>




<!-- Nueva cuenta -->
<div class="modal" id="ModalAddCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="false">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
         NUEVO CLIENTE</h5>
      </div>
      <div class="modal-body">
<!-- ./  content -->

  <form id="form-cliente">

  <div class="form-row">
    
    <div class="col-md-12 mb-0 md-form">
      <label for="cliente">* Cliente</label>
      <input type="text" class="form-control" id="cliente" name="cliente" required>
    </div>

  </div>


  <div class="form-row">
    
    <div class="col-md-12 mb-0 md-form">
      <label for="direccion">* Dirección</label>
      <input type="text" class="form-control" id="direccion" name="direccion" required>
    </div>

  </div>


  <div class="form-row">
    
    <div class="col-md-6 mt-0 md-form">
      <select class="mdb-select md-form colorful-select dropdown-dark" id="departamento" name="departamento">
        <option selected disabled>Departamento</option>
        <option value="1">Departamento</option>
      </select>
    </div>


    <div class="col-md-6 mt-0 md-form">
      <select class="mdb-select md-form colorful-select dropdown-dark" id="municipio" name="municipio">
        <option selected disabled>Municipio</option>
        <option value="1">Municipio</option>
      </select>
    </div>

  </div>




  <div class="form-row">
    
    <div class="col-md-4 mb-1 md-form">
      <label for="email">Email</label>
      <input type="text" step="any" class="form-control" id="email" name="email" required>
    </div>

    <div class="col-md-4 mb-1 md-form">
      <label for="telefono1">* Teléfono</label>
      <input type="text" class="form-control" id="telefono1" name="telefono1" required>
    </div>
  
    <div class="col-md-4 mb-1 md-form">
      <label for="telefono2">* Celular</label>
      <input type="text" class="form-control" id="telefono2" name="telefono2" required>
    </div>

  </div>



  <div class="form-row">
    
    <div class="col-md-4 mb-1 md-form">
      <label for="giro">Giro</label>
      <input type="text" step="any" class="form-control" id="giro" name="giro" required>
    </div>

    <div class="col-md-4 mb-1 md-form">
      <label for="registro">* No Registro</label>
      <input type="text" class="form-control" id="registro" name="registro" required>
    </div>
  
    <div class="col-md-4 mb-1 md-form">
      <label for="nit">* NIT</label>
      <input type="text" class="form-control" id="nit" name="nit" required>
    </div>

  </div>



    <div class="form-row">
    
    <div class="col-md-12 mt-0 md-form">
      <textarea id="comentarios" name="comentarios" class="md-textarea form-control" rows="3"></textarea>
      <label for="comentarios">Comentarios</label>
    </div>

  </div>






  <div class="form-row mt-5">
    <div class="col-md-12 md-form text-center">
     <button class="btn btn-info" type="submit" id="btn-cliente"><i class="fas fa-save mr-1"></i> Guardar</button>

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
















<!-- modal para ver el cuenta -->
<div class="modal" id="ModalVer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="false">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
         DETALLES MANTENIMIENTO</h5>
      </div>
      <div class="modal-body">
<!-- ./  content -->

        <div id="vista_ver"> AQUI VA EL CONTENIDO DE LOS DETALLES</div>

<!-- ./  content -->
      </div>
      <div class="modal-footer">

        <a class="btn btn-primary btn-rounded" data-dismiss="modal">Regresar</a>  
    
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
        <a id="borrar-cuenta" class="btn  btn-outline-danger">Eliminar</a>
        <a type="button" class="btn  btn-danger waves-effect" data-dismiss="modal">No</a>
      </div>
    </div>
    <!--/.Content-->
  </div>
</div>
<!--Modal: modalConfirmDelete-->

