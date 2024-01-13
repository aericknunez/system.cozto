<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'application/common/Alerts.php';
include_once 'system/cliente/Cliente.php';
$cliente = new Clientes(); 

?>

<div id="msj"></div>
<h2 class="h2-responsive">Nuevo Cliente</h2>
<div class="row">
    <div class="col-md-6 btn-outline-black z-depth-2">
            

  <form id="form-addcliente">
  
  <div class="form-row">

  <div class="col-md-12 mb-2 md-form">
      <label for="nombre">* Nombre</label>
      <input type="text" class="form-control" id="nombre" name="nombre">
   </div>
  </div>


  <div class="form-row">

<div class="col-md-6 mb-2 md-form">
    <label for="codigo">Codigo</label>
    <input type="text" class="form-control" id="codigo" name="codigo">
 </div>

  <div class="col-md-6 mb-2 md-form">
    <label for="cod">Documento</label>
    <input type="text" class="form-control" id="documento" name="documento">
  </div>

</div>


  <div class="form-row">

   <div class="col-md-6 mb-2 md-form">
      <label for="descripcion">* Tel&eacutefono</label>
      <input type="text" class="form-control" id="telefono" name="telefono">
    </div>

    <div class="col-md-6 mb-2 md-form">
      <label for="descripcion">* Direcci&oacuten</label>
      <input type="text" class="form-control" id="direccion" name="direccion">
    </div>

  </div>


  <div class="form-row">

    <div class="col-md-6 mb-2 md-form">
      <label for="cod">Departamento</label>
      <?
        echo Helpers::generarSelectDepartamentos();
      ?>
    </div>

  <div class="col-md-6 mb-2 md-form">
      <label for="descripcion">Municipio</label>
      <select class="mdb-select md-form colorful-select dropdown-dark" name="municipio" id="municipio">
      <option>Municipio</option>
      </select>
    </div>

  </div>


 

  <div class="form-row">

    <div class="col-md-6 mb-2 md-form">
      <label for="cod">Email</label>
      <input type="text" class="form-control" id="email" name="email">
    </div>

  <div class="col-md-6 mb-2 md-form">
      <input placeholder="Fecha de Nacimiento" type="text" id="nacimiento" name="nacimiento" class="form-control datepicker">
    </div>

  </div>



  <div class="form-row">

    <div class="col-md-12 mb-1 md-form">
      <textarea id="comentarios" name="comentarios" class="md-textarea form-control" rows="3"></textarea>
      <label for="comentarios">Comentarios..</label>
    </div>

  </div>

  <div class="form-row">

    <div class="col-md-12 mb-1 md-form">
    <input class="form-check-input" type="checkbox" value="1" name="tipo_contribuyente" id="tipo_contribuyente" >
    <label class="form-check-label" for="tipo_contribuyente">
    Gran Contribuyente
    </label>
    </div>

  </div>



  <div class="form-row">
    <div class="col-md-12 my-6 md-form text-center">
     <button class="btn btn-info my-4" type="submit" id="btn-addcliente"><i class="fa fa-save mr-1"></i> Guardar</button>

    </div>
  </div>

</form>

<!-- TERMINA FORMULARIO PRINCIPAL -->

    </div>
    
    <div class="col-md-6 btn-outline-black z-depth-2" id="destinocliente">
          <?php $cliente->Verclientes(); ?>
    </div>
   
</div>  <!-- row -->



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
        <a id="delcliente" class="btn  btn-outline-danger">Eliminar</a>
        <a type="button" class="btn  btn-danger waves-effect" data-dismiss="modal">No</a>
      </div>
    </div>
    <!--/.Content-->
  </div>
</div>
<!--Modal: modalConfirmDelete-->
