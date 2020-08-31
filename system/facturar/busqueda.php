<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'application/common/Alerts.php';
include_once 'system/facturar/Search.php';
$busqueda = new Search();

?>




<div class="row d-flex justify-content-center">
  <div class="col-12 col-md-8">

<?php 
$busqueda->DestalleFactura($_POST["search"]);
?>

  </div>

  <div class="col-12 col-md-4">

<?php 

$busqueda->BotonesFactura($_POST["search"]);
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