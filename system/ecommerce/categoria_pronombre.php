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


<!-- Ver AGREGAR PRONOMBRE -->
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











<!-- Ver Agregar Imagen -->
<div class="modal" id="ModalImagen" tabindex="-1" role="dialog" aria-labelledby="ModalImagen" aria-hidden="true"  data-backdrop="false">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
         AGREGAR IMAGEN CATEGORIA</h5>
      </div>
      <div class="modal-body">
<!-- ./  content -->
<div id="verimg" class="text-center mb-4"></div>


<div id="verformularioimg">
    <form id="form-img" name="form-img" class="md-form">

    <div class="file-field">
        <a class="btn-floating blue-gradient mt-0 float-left">
            <i class="fas fa-paperclip" aria-hidden="true"></i>
            <input type="file" id="archivo" name="archivo">
        </a>
        <div class="file-path-wrapper">
           <input class="file-path validate" type="text" placeholder="Agregue su imagen">
        </div>
    </div>


<input type="hidden" id="hash_cat" name="hash_cat" value="">
   
<div class="text-center">
  <button class="btn btn-outline-info btn-rounded z-depth-0 my-2 waves-effect" type="submit" id="btn-img" name="btn-img">Subir Imagen</button>
</div>
    </form>
</div>

<div id="verbtnimg">
  <a id="mostraradd" class="btn btn-secondary btn-rounded btn-sm">Agregar Imagen</a>
</div>
<div id="mostrarvinculo">
  <a id="ocultaradd">Ocultar Formulario</a>
</div>

<div id="vista_imagen"></div>
<!-- ./  content -->
      </div>
      <div class="modal-footer">

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
        <a id="edelorden" class="btn  btn-outline-danger">Eliminar</a>
        <a type="button" class="btn  btn-danger waves-effect" data-dismiss="modal">No</a>
      </div>
    </div>
    <!--/.Content-->
  </div>
</div>
<!--Modal: modalConfirmDelete-->
