<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'application/common/Fechas.php';
include_once 'application/common/Alerts.php';
include_once 'system/producto/ProductoOtros.php';
$producto = new ProductoOtros(); 
?>

<div id="msj"></div>
<h2 class="h2-responsive">PRODUCTOS CON VENCIMIENTO PROXIMO ( <?php echo $_SESSION['config_dias_vencimiento'] . " dias"; ?>)</h2>


<div id="CargaContenido"></div>

<div id="MensajeCarga" class="row d-flex justify-content-md-center">
  <?php Alerts::Mensajex("Por favor espere... Este proceso puede tardar unos segundos","danger"); ?>
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
