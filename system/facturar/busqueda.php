<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'application/common/Alerts.php';
include_once 'system/facturar/Search.php';
$busqueda = new Search();

$_SESSION["search"] = $_POST["search"];
?>

<div id="msjreload"></div>


<div class="row d-flex justify-content-center">
  <div class="col-12 col-md-8" id="detallesf">

<?php 
$busqueda->DestalleFactura($_SESSION["search"]);
?>

  </div>

  <div class="col-12 col-md-4" id="mensajef">

<?php 

$busqueda->BotonesFactura($_SESSION["search"]);
 ?>
  </div>
</div>






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

        Si elimina la factura todos los productos se devolverán al inventario
        <br>
        <i class="fas fa-times fa-4x animated rotateIn"></i>

      </div>

      <!--Footer-->
      <div class="modal-footer flex-center">
        <a id="borrar-factura" op="" factura="<?php echo $_POST["search"] ?>" class="btn btn-outline-danger">Eliminar</a>
        <a type="button" class="btn  btn-danger waves-effect" data-dismiss="modal">No</a>
      </div>
    </div>
    <!--/.Content-->
  </div>
</div>
<!--Modal: modalConfirmDelete-->









<div class="modal" id="ModalTicket" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
         SELECCIONE TIPO DE DOCUMENTO</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" align="center">
<!-- ./  content -->
<div id="contenidomticket">
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
