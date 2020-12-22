<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
include_once 'application/common/Alerts.php';
include_once 'system/herramientas/Herramientas.php';
$producto = new Herramientas(); 

Alerts::Mensajex("El ingreso de productos no es recomentado ya que sólo se registran los datos mas importantes, no olvide posteriormente actualizar los datos del producto","warning");
?>


<div id="msj"></div>
<div id="verexistencia"></div>


<div id="formulariox">
	<form id="form-proadd">
  

  <div class="form-row">
    <div class="col-md-4 mb-2 md-form">
      <label for="cod">* Codigo Producto</label>
      <input type="text" class="form-control" id="cod" name="cod" value="<?= $codigox ?>" required>
    </div>

  <div class="col-md-8 mb-2 md-form">
      <label for="descripcion">* Descripci&oacuten</label>
      <input type="text" class="form-control" id="descripcion" name="descripcion" required>
    </div>

  </div>

  
<div class="form-row d-flex justify-content-center">


    <div class="col-md-3 mb-1 md-form">
      <label for="cantidad">Cantidad</label>
      <input type="number" step="any" class="form-control" id="cantidad" name="cantidad" required>
    </div>

    <div class="col-md-3 mb-1 md-form">
      <label for="precio_costo">Precio Costo</label>
      <input type="number" step="any" class="form-control" id="precio_costo" name="precio_costo" required>
    </div>


    <div class="col-md-3 mb-1 md-form">
      <label for="precio">* Precio de Venta</label>
      <input type="number" step="any" class="form-control" id="precio" name="precio" required>
    </div>


    <div class="col-md-3 mb-4 md-form">
    <input placeholder="Fecha de vencimiento" type="text" id="caduca" name="caduca" class="form-control datepicker my-2">
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

<div id="ultimosproductos" class="mt-3">
<?php 
$producto->UltimosProductos();
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
