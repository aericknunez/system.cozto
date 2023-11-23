<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
$venta = TRUE;
$tventa = 2;

include_once 'system/ventas/VentasL.php';
$ventas = new Ventas(); 

?>
<div align="center">
  <div class="col-md-6 z-depth-2 justify-content-center">
      <div class="md-form mt-0">
      	<form id="p-busqueda">
        <input class="form-control" type="text" placeholder="Buscar Producto" aria-label="Search" id="producto-busqueda" name="producto-busqueda" autofocus>
        </form>
      </div>
  </div>
  <div class="col-md-6 z-depth-2 justify-content-center" id="muestra-busqueda"></div>
</div>
<!-- hasta aqui llega la busqueda -->



<form id="form-addform">

<div id="temp-productos"></div> <!--  producto que viende despues de la busqueda -->


<div align="center">
  <button class="btn btn-info my-0 invisible" type="submit" id="btn-addform"><i class="fas fa-save mr-1"></i> Guardar</button>

<a id="cancel-x" class="btn btn-danger my-0 invisible"><i class="fas fa-ban mr-1"></i> Cancelar</a>
</div>

</form>


<div id="ver">
<?php 
$ventas->VerProducto();	
// print_r($_SESSION);
 ?>
</div>  <!--  Aqui ira el resultado de lo precesado -->








<!-- Modal -->
<div class="modal bounceIn" id="ModalDescuento" tabindex="-1" role="dialog" aria-labelledby="ModalDescuento"
  aria-hidden="true" data-backdrop="false">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">DESCUENTO A PRODUCTO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
<!-- CONTENIDO -->
<div align="center">
  <div class="col-md-12 z-depth-2 justify-content-center">
      <div class="md-form mt-0">
        <form id="form-Ddescuento">

<div class="mb-5 row">
            <div class="switch">
            <label>
             Porcentaje
              <input type="checkbox" <?php if($_SESSION['tipo_descuento'] == "1") echo 'checked = "checked"'; ?> id="prop" name="prop" >
              <span class="lever"></span> 
             Cantidad 
            </label>
          </div>

</div>


        <input class="form-control form-control-lg" type="number" step="any" min="1" placeholder="Descuento %" id="descuento" name="descuento" autofocus>
        <?php
          if ($_SESSION['config_restringir_descuento']) {
        ?>
        <input class="form-control form-control-lg" type="text" id="codigo_seguridad" name="codigo_seguridad" placeholder="Codigo de Seguridad">
        <?php
          }
        ?>

        <input type="hidden" id="dcantidad" name="dcantidad" value="">
        <input type="hidden" id="dcodigo" name="dcodigo" value="">
         <button class="btn aqua-gradient btn-rounded btn-sm" type="submit" id="btn-Ddescuento" name="btn-Ddescuento">Agregar</button>
        </form>
      </div>
  </div>
</div>
<div id="ver-descuento"></div>
<div id="ver-btndescuento" align="center"></div>
<!-- CONTENIDO -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>





<?php 

if($_SESSION["config_pesaje"] == "on"){
 ?>


<!-- Modal -->
<div class="modal bounceIn" id="ModalBalanza" tabindex="-1" role="dialog" aria-labelledby="ModalBusqueda"
  aria-hidden="true" data-backdrop="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">BUSCAR PRODUCTO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
<!-- CONTENIDO -->
<div align="center">
  <div class="col-md-12 z-depth-2 justify-content-center">
      <div class="md-form mt-0">
        <form id="form-balanza">
        <input class="form-control" type="text" placeholder="Buscar Producto" aria-label="Search" id="probal" name="probal" autofocus>

<button class="btn aqua-gradient btn-rounded btn-sm waves-effect waves-light" type="submit" id="btn-balanza" name="btn-balanza">Buscar</button>
        </form>
      </div>
  </div>
</div>

<div id="productos_bal"></div>

<!-- CONTENIDO -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>




 <?php } ?>

 <!-- Modal -->
<div class="modal bounceIn" id="ModalComentario" tabindex="-1" role="dialog" aria-labelledby="ModalComentario"
  aria-hidden="true" data-backdrop="false">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">AGREGAR <?php echo strtoupper($_SESSION["root_extra"]) ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
<!-- CONTENIDO -->
  <div class="col-md-12 z-depth-2 justify-content-center">
  <div id="msj_comment" class="mt-2 font-weight-bold red-text"></div>

      <div class="md-form mt-0">
        <form id="form-comment">
        <input type="hidden" id="iden" name="iden" value="">
        <input class="form-control form-control-lg" type="text" placeholder="<?php echo $_SESSION["root_extra"] ?>" id="comentario" name="comentario" autofocus>
        <div class="align-right">
         <button class="btn aqua-gradient btn-rounded btn-sm" type="submit" id="btn-comment" name="btn-comment">Agregar</button>
        </div>
        </form>
      </div>
  </div>

<!-- CONTENIDO -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>