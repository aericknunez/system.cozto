<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
$venta = TRUE;
$tventa = 1;

include_once 'system/ventas/VentasR.php';
$ventas = new Ventas(); 

?>
<div align="center">
  <div class="col-md-6 z-depth-2 justify-content-center">
      <div class="md-form mt-0">
      	<form id="form-busquedaR">
        <input class="form-control" type="text" placeholder="Codigo del Producto" aria-label="Search" id="cod" name="cod" autofocus>
         <button class="btn aqua-gradient btn-rounded btn-sm" type="submit" id="btn-busquedaR" name="btn-busquedaR">Buscar</button>
        </form>
      </div>
  </div>
</div>
<!-- hasta aqui llega la busqueda -->



<div id="ver">
<?php 
$ventas->VerProducto();	
print_r($_SESSION);
// echo Helpers::UUID();
 ?>
</div>  <!--  Aqui ira el resultado de lo precesado -->



<!-- Modal -->
<div class="modal bounceIn" id="ModalBusqueda" tabindex="-1" role="dialog" aria-labelledby="ModalBusqueda"
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
      	<form id="p-busqueda">
        <input class="form-control" type="text" placeholder="Buscar Producto" aria-label="Search" id="producto-busqueda" name="producto-busqueda" autofocus>
        </form>
      </div>
  </div>
  <div class="col-md-12 z-depth-2 justify-content-center" id="muestra-busqueda"></div>
</div>

        <!-- Default switch -->
          <div class="switch">
            Busqueda por Tags
            <label>
             Off
              <input type="checkbox" id="busquedaTags" name="busquedaTags" >
              <span class="lever"></span> 
             On 
            </label>
          </div>
<!-- CONTENIDO -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>




<!-- Modal -->
<div class="modal bounceIn" id="ModalCantidad" tabindex="-1" role="dialog" aria-labelledby="ModalCantidad"
  aria-hidden="true" data-backdrop="false">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">CAMBIAR CANTIDAD</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
<!-- CONTENIDO -->
<div align="center">
  <div class="col-md-12 z-depth-2 justify-content-center">
      <div class="md-form mt-0">
        <form id="form-Ccantidad">
        <input class="form-control form-control-lg" type="number" step="any" min="1" placeholder="Cantidad" id="cantidad" name="cantidad" value="" autofocus>
        <input type="hidden" id="codigox" name="codigox" value="">
         <button class="btn aqua-gradient btn-rounded btn-sm" type="submit" id="btn-Ccantidad" name="btn-Ccantidad">Agregar</button>
        </form>
      </div>
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
<div id="load"></div>

        <input class="form-control form-control-lg" type="number" step="any" min="1" placeholder="Descuento" id="descuento" name="descuento" autofocus>
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