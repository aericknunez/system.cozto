<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
include_once 'application/common/Alerts.php';

?>


<div id="msj"></div>
<div id="verexistencia"></div>


<div id="formulariox">
	<form id="form-proadd">
  

  <div class="form-row">

    <div class="col-md-12 mb-2 md-form">
      <label for="descripcion">* Descripci&oacuten</label>
      <input type="text" class="form-control" id="busqueda" name="busqueda" placeholder="Descripción del producto" aria-label="Search" autofocus>

      <input type="hidden" id="descripcion" name="descripcion" value="" class="form-control">

      <div class="col-md-12 z-depth-2 justify-content-center" id="muestra-busqueda"></div>
    </div>


</div>

  
<input type="hidden" id="cod" name="cod" value="">   
<input type="hidden" id="categoria" name="categoria" value="">   


<div class="form-row d-flex justify-content-center">


    <div class="col-md-4 mb-1 md-form">
      <label for="cantidad">* Cantidad</label>
      <input type="number" step="any" class="form-control" id="cantidad" name="cantidad" required>
    </div>

    <div class="col-md-4 mb-1 md-form">
      <label for="precio_costo">* Precio Costo</label>
      <input type="number" step="any" class="form-control" id="precio_costo" name="precio_costo" required>
    </div>


    <div class="col-md-4 mb-1 md-form">
      <label for="precio">* Precio de Venta</label>
      <input type="number" step="any" class="form-control" id="precio" name="precio" required>
    </div>


  </div>










  <div class="form-row mt-5">
  	<div class="col-md-12 md-form text-center">
  	 <button class="btn btn-info" type="submit" id="btn-proadd"><i class="fas fa-save mr-1"></i> GUARDAR PRODUCTO</button>

  	</div>
  </div>

</form>
</div>
<!-- TERMINA FORMULARIO PRINCIPAL -->





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
}
 ?>