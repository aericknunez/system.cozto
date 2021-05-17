<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'application/common/Alerts.php';
include_once 'system/taller/Taller.php';
$taller = new Taller(); 
?>

<div id="msj"></div>

<div class="clearfix">
  <h2 class="h2-responsive float-left">VEHICULOS</h2> 
  <h2 class="h2-responsive float-right"><a id="addvehiculo" class="btn-floating btn-info btn-sm mb-3" title="Nueva Cuenta"><i class="fas fa-plus"></i></a></h2>
</div>




<div id="contenido">
   <?php 
   $taller->VerVehiculos(1, "id", "desc"); ?>
</div>




<!-- Nueva cuenta -->
<div class="modal" id="ModalAddVehiculo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
         NUEVO VEHICULO</h5>
      </div>
      <div class="modal-body">
<!-- ./  content -->

<?php 
    $a = $db->query("SELECT hash, cliente FROM taller_cliente WHERE td = ".$_SESSION["td"]."");

     $c = $db->query("SELECT hash, marca FROM autoparts_marca WHERE td = ".$_SESSION["td"]."");

?>  
  <form id="form-vehiculo">

  <div class="form-row">
    
    <div class="col-md-12 mt-0 md-form">
      <select class="mdb-select md-form colorful-select dropdown-dark" id="cliente" name="cliente">
        <option selected disabled>Cliente</option>
        <?php foreach ($a as $b) {
        echo '<option value="'. $b["hash"] .'">'. $b["cliente"] .'</option>'; 
        } $a->close(); ?>
      </select>
    </div>

  </div>


<div id="datos_cliente"></div>


  <div class="form-row">
    
    <div class="col-md-4 mb-1 md-form">
      <label for="placa">* Placa</label>
      <input type="text" step="any" class="form-control" id="placa" name="placa" required>
    </div>

    <div class="col-md-4 mb-1 md-form">
      <select class="mdb-select md-form colorful-select dropdown-dark mt-1" id="marca" name="marca">
        <option selected disabled>Marca</option>
        <?php foreach ($c as $d) {
        echo '<option value="'. $d["hash"] .'">'. $d["marca"] .'</option>'; 
        } $a->close(); ?>
      </select>
    </div>
  
    <div class="col-md-4 mb-1 md-form">
      <label for="ano">* Año</label>
      <input type="text" class="form-control" id="ano" name="ano" required>
    </div>

  </div>



  <div class="form-row">
    
    <div class="col-md-3 mb-1 md-form">
      <select class="mdb-select md-form colorful-select dropdown-dark mt-1" id="modelo" name="modelo">
            <option selected disabled>Modelo</option>  
      </select>
    </div>

    <div class="col-md-3 mb-1 md-form">
      <label for="clase">* Clase</label>
      <input type="text" class="form-control" id="clase" name="clase" required>
    </div>
  
    <div class="col-md-3 mb-1 md-form">
      <label for="tipo">* Tipo</label>
      <input type="text" class="form-control" id="tipo" name="tipo" required>
    </div>

    <div class="col-md-3 mb-1 md-form">
      <label for="color">* Color</label>
      <input type="text" class="form-control" id="color" name="color" required>
    </div>

  </div>




  <div class="form-row">
    
    <div class="col-md-4 mb-1 md-form">
      <label for="chasis_gravado">* Chasis Gravado</label>
      <input type="text" step="any" class="form-control" id="chasis_gravado" name="chasis_gravado" required>
    </div>

    <div class="col-md-4 mb-1 md-form">
      <label for="chasis_vin">* Chasis Vin</label>
      <input type="text" class="form-control" id="chasis_vin" name="chasis_vin" required>
    </div>
  
    <div class="col-md-4 mb-1 md-form">
      <label for="no_motor">* No Motor</label>
      <input type="text" class="form-control" id="no_motor" name="no_motor" required>
    </div>

  </div>





    <div class="form-row">
    
    <div class="col-md-12 mt-0 md-form">
      <textarea id="detalles" name="detalles" class="md-textarea form-control" rows="3"></textarea>
      <label for="detalles">Detalles</label>
    </div>

  </div>





  <div class="form-row mt-5">
    <div class="col-md-12 md-form text-center">
     <button class="btn btn-info" type="submit" id="btn-vehiculo"><i class="fas fa-save mr-1"></i> Guardar</button>

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
















<!-- /// modal ver cleinte -->

<div class="modal" id="ModalVerDetalles" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
         DETALLES</h5>
      </div>
      <div class="modal-body">
<!-- ./  content -->

<div id="vista_detalles"></div>

<!-- ./  content -->
      </div>
      <div class="modal-footer">

<a href="" id="btn-pro" class="btn btn-secondary btn-rounded">Modificar Datos</a>
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
        <p class="heading">Seguro que desea eliminar este elemento?</p>
      </div>

      <!--Body-->
      <div class="modal-body">

        <i class="fas fa-times fa-4x animated rotateIn"></i>

      </div>

      <!--Footer-->
      <div class="modal-footer flex-center">
        <a id="borrar-cuenta" class="btn  btn-outline-danger">Eliminar</a>
        <a type="button" class="btn  btn-danger waves-effect" data-dismiss="modal">No</a>
      </div>
    </div>
    <!--/.Content-->
  </div>
</div>
<!--Modal: modalConfirmDelete-->

