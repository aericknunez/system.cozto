<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
include_once 'application/common/Alerts.php';


?>


<div id="msj"></div>
<div id="contenido"></div>
	




<?php 
if($_SESSION["root_autoparts"] == "on"){
 ?>
<!-- para agregar los detalles de autoparts -->
<!-- modal para ver el credito -->
<div class="modal" id="AddAutoParts" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="false">
  <div class="modal-dialog modal-lg z-depth-5" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
         AGREGAR DETALLES</h5>
      </div>
      <div class="modal-body">
<!-- ./  content -->

<div id="vista"></div>

<!-- ./  content -->
      </div>
      <div class="modal-footer">

        <a id="eliminardatos" op="525" class="btn-floating btn-sm btn-secondary"><i class="fas fa-trash"></i></a>
        <a id="cerrarDetalles" class="btn btn-danger btn-rounded">Omitir Estos Datos</a>
 
   
      </div>
    </div>
  </div>
</div>
<!-- ./  Modal -->
<?php 
} else {
  Alerts::Mensajex("no tienes permisos para estar aqui","danger");
}
 ?>



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

<div id="vista-producto"></div>

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






<!-- Ver producto -->
<div class="modal" id="ModalAgregar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="false">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
         DETALLES PRODUCTO</h5>
      </div>
      <div class="modal-body">
<!-- ./  content -->



  <form id="form-productoagrega">
  

  <div id="datosproducto"></div>




  <div class="form-row">
    
    <div class="col-md-6 mb-1 md-form">
      <label for="cantidad">* Precio de Costo</label>
      <input type="number" step="any" class="form-control" id="precio" name="precio" required>
    </div>

    <div class="col-md-6 mb-1 md-form">
      <label for="cantidad">* Cantidad</label>
      <input type="number" step="any" class="form-control" id="cantidad" name="cantidad" required>
    </div>

  </div>

  
  <div class="form-row">
    
    <div class="col-md-12 mb-1 md-form">
      <textarea id="comentarios" name="comentarios" class="md-textarea form-control" rows="3"></textarea>
      <label for="comentarios">Comentarios..</label>
    </div>

  </div>




  <div class="form-row">
    <div class="col-md-12 my-6 md-form text-center">
     <button class="btn btn-info my-4" type="submit" id="btn-productoagrega" cod=""><i class="fa fa-save mr-1"></i> Guardar</button>

    </div>
  </div>

</form>




<div id="destinoproductoagrega"></div>
<!-- ./  content -->
      </div>
      <div class="modal-footer">


<a id="cerrar" class="btn btn-primary btn-rounded" data-dismiss="modal">Regresar</a>

          
    
      </div>
    </div>
  </div>
</div>
<!-- ./  Modal -->


<!-- Ver producto -->
<div class="modal" id="ModalCambiarPrecio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="false">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
         CAMBIAR PRECIO</h5>
      </div>
      <div class="modal-body">
<!-- ./  content -->

 <form id="form-modprecio">
  

<div id="vista-precio"></div>


  <div class="form-row">
    <div class="col-md-12 my-6 md-form text-center">
     <button class="btn btn-info my-4" type="submit" id="btn-modprecio" cod=""><i class="fa fa-save mr-1"></i> Guardar</button>

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
