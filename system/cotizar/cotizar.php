<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
include_once 'application/common/Alerts.php';
include_once 'system/cotizar/CotizarR.php';
$cotiza = TRUE;
$cot = new Cotizar(); 

Alerts::Mensajex("Advertencia! Esta en modo de cotizaci&oacuten, los productos agregados no afectaran el inventario","danger");

if($_SESSION["cotizacion"] != NULL){
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
$cot->VerProducto();	
 ?>
</div>  <!--  Aqui ira el resultado de lo precesado -->


<?php } else {
?>
 <!-- aqui va el  formulario para iniciar una cotizacion -->
<!-- ./  content -->
<div align="center">
  <div class="col-md-6 z-depth-2 justify-content-center">
      <div class="md-form mt-0">
        <form id="c-busqueda">
        <input class="form-control" type="text" placeholder="Buscar Cliente" aria-label="Search" id="cliente-busqueda" name="cliente-busqueda" autofocus>
        </form>
      </div>
  </div>
  <div class="col-md-6 z-depth-2 justify-content-center" id="muestra-busqueda"></div>
</div>

<div id="ver">

</div>
<!-- ./  content -->


<?php
} ?>





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
<!-- CONTENIDO -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>







<!-- Ver producto -->
<div class="modal" id="ModalVer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="false">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
         DETALLES DE LA COTIZACION</h5>
      </div>
      <div class="modal-body">
<!-- ./  content -->

<div id="vista"></div>

<!-- ./  content -->
      </div>
      <div class="modal-footer">


<a id="facturar" op="162" class="btn btn-secondary btn-rounded">Facturar</a>

<a id="activar_cotizacion" op="161" class="btn-floating btn-sm red"><i class="fas fa-edit"></i></a>

<a id="imprimir" class="btn-floating btn-sm blue-gradient"><i class="fa fa-print"></i></a>

<a id="cerrarmodal" class="btn btn-primary btn-rounded" data-dismiss="modal">Regresar</a>

          
    
      </div>
    </div>
  </div>
</div>
<!-- ./  Modal -->
