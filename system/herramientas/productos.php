<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'application/common/Alerts.php';
include_once 'system/herramientas/Herramientas.php';
$herramienta = new Herramientas(); 
include_once 'system/producto/Productos.php';
?>

<div id="msj"></div>
<h2 class="h2-responsive">Todos los Productos</h2>


<div id="contenido">
   <?php $herramienta->TodosProductosOpciones(1, "producto.id", "asc"); ?>
</div>



<!-- Ver producto -->
<div class="modal" id="ModalVer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="false">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
         DETALLES PRODUCTO</h5>
      </div>
      <div class="modal-body">
<!-- ./  content -->

<div id="vista"></div>


<div class="row">
<div class="col-md-12">
    <div id="mdb-lightbox-ui"></div>
    <div class="mdb-lightbox">
      <div id="contenido-img"></div>
</div>
 </div>
 </div>
<!-- ./  content -->
      </div>
      <div class="modal-footer">
<?php if($_SESSION["tipo_cuenta"] != 4) { ?>
<a href="" id="btn-pro" class="btn btn-secondary btn-rounded">Modificar Datos</a>
<? } ?>
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
        <p class="heading">Seguro que desea eliminar este producto?</p>
      </div>

      <!--Body-->
      <div class="modal-body">

        <i class="fas fa-times fa-4x animated rotateIn"></i>
<p><strong>Advertencia: </strong> Si continúa se borrará permanentemente todo lo relacionado al producto</p>
      </div>

      <!--Footer-->
      <div class="modal-footer flex-center">
        <a id="borrar-producto" class="btn  btn-outline-danger">Eliminar</a>
        <a type="button" class="btn  btn-danger waves-effect" data-dismiss="modal">No</a>
      </div>
    </div>
    <!--/.Content-->
  </div>
</div>
<!--Modal: modalConfirmDelete-->







<!-- Ver producto -->
<div class="modal" id="ModalMarcaAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="false">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
         CAMBIAR MARCA AL PRODUCTO</h5>
      </div>
      <div class="modal-body">
<!-- ./  content -->

<select class="mdb-select md-form colorful-select dropdown-dark" id="marca" name="marca">
<?php echo Helpers::SelectData("* Marca", "marcas", "hash", "marca"); ?>
</select>

<div id="vistamarca">
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