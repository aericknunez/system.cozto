<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'application/common/Alerts.php';
include_once 'system/taller/Taller.php';
$taller = new Taller(); 
?>

<div id="msj"></div>

<div class="clearfix">
  <h2 class="h2-responsive float-left">MANTENIMIENTO</h2> 
  <h2 class="h2-responsive float-right"><a id="addmantenimiento" class="btn-floating btn-info btn-sm mb-3" title="Nuevo Mantenieminto"><i class="fas fa-plus"></i></a></h2>
</div>




<div id="contenido">
   <?php 
   $taller->VerMantenimiento(1, "id", "desc"); ?>
</div>




<!-- Nueva cuenta -->
<div class="modal" id="ModalAddMantenimiento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="false">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
        NUEVA NOTA DE MANTENIMIENTO</h5>
      </div>
      <div class="modal-body">
<!-- ./  content -->

  <form id="form-mantenimiento">

<?php 
    $a = $db->query("SELECT hash, placa FROM taller_vehiculo WHERE td = ".$_SESSION["td"]."");
?> 

  <div class="form-row">
    
    <div class="col-md-12 mt-0 md-form">
      <select class="mdb-select md-form colorful-select dropdown-dark" id="vehiculo" name="vehiculo">
        <option selected disabled>Placa</option>
        <?php foreach ($a as $b) {
        echo '<option value="'. $b["hash"] .'">'. $b["placa"] .'</option>'; 
        } $a->close(); ?>
      </select>
    </div>

  </div>


<div id="datos_src"></div>


  <div class="form-row">
    
    <div class="col-md-12 mb-0 md-form mt-0">
      <label for="direccion">* Millaje de ingreso</label>
      <input type="text" class="form-control" id="millaje" name="millaje" required>
    </div>

  </div>



    <div class="form-row">
    
    <div class="col-md-12 mt-0 md-form mt-0">
      <textarea id="motivo" name="motivo" class="md-textarea form-control" rows="3"></textarea>
      <label for="motivo">Motivo de Ingreso</label>
    </div>

  </div>



  <div class="form-row mt-0">
    <div class="col-md-12 md-form text-center">
     <button class="btn btn-info" type="submit" id="btn-mantenimiento"><i class="fas fa-save mr-1"></i> Guardar Ingreso </button>

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










<!-- modal para ver el cuenta -->
<div class="modal" id="ModalVer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="false">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
         DETALLES MANTENIMIENTO</h5>
      </div>
      <div class="modal-body">
<!-- ./  content -->

        <div id="vista_ver"> </div>

<!-- ./  content -->
      </div>
      <div class="modal-footer">

        <a class="btn btn-primary btn-rounded" data-dismiss="modal">Regresar</a>  
    
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

