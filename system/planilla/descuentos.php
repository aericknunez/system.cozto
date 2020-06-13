<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'application/common/Alerts.php';
include_once 'system/planilla/Planilla.php';
$planilla = new Planilla(); 

?>

<div id="msj"></div>
<h2 class="h2-responsive">Descuentos</h2>



  <nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
      <a class="nav-item nav-link active" id="nav-descuentos-tab" data-toggle="tab" href="#nav-descuentos" role="tab"
        aria-controls="nav-descuentos" aria-selected="true">Descuentos</a>
      <a class="nav-item nav-link" id="nav-asignados-tab" data-toggle="tab" href="#nav-asignados" role="tab"
        aria-controls="nav-asignados" aria-selected="false">Asignados</a>
    </div>
  </nav>
  <div class="tab-content" id="nav-tabContent">

    <div class="tab-pane fade show active" id="nav-descuentos" role="tabpanel" aria-labelledby="nav-descuentos-tab">
    <?php Alerts::Mensajex("Agregue los descuentos a registrar. Estos son los descuentos Globales que se aplicar&aacuten a todas las planillas","info"); ?>
    

<div class="row">
    <div class="col-md-6 btn-outline-black z-depth-2">

<form class="text-center border border-light p-3" id="form-adddescuento" name="form-adddescuento">

Descripci&oacuten
<textarea type="text" id="descuento" name="descuento" class="form-control mb-3"></textarea>

<input type="number" step="any" id="porcentaje" name="porcentaje" class="form-control mb-3" placeholder="Porcentaje">
<button class="btn btn-info my-4" type="submit" id="btn-adddescuento" name="btn-adddescuento">Agregar Descuento</button>
 </form>
<!-- TERMINA FORMULARIO PRINCIPAL -->

    </div>
    
    <div class="col-md-6 btn-outline-black z-depth-2" id="contenido">
          <?php $planilla->VerDescuentos(); ?>
    </div>
   
</div>  <!-- row -->



          
    </div>
    <div class="tab-pane fade" id="nav-asignados" role="tabpanel" aria-labelledby="nav-asignados-tab">
   <?php Alerts::Mensajex("Descuentos Asignados a cada empleado","success"); ?>
   


   <div class="row">
    <div class="col-md-6 btn-outline-black z-depth-2">

 <form id="form-asignardescuento" name="form-asignardescuento" class="text-center border border-light p-3">
  
      <div class="form-row">

<div class="col-md-6 mb-2 md-form" id="select-descuento">
<?php   $planilla->SelectDescuento(); ?>
</div>
<div class="col-md-6 mb-2 md-form" id="select-empleado">
<?php   $planilla->SelectEmpleado(); ?>
</div>



      </div>
<button class="btn btn-info my-4" type="submit" id="btn-asignardescuento" name="btn-asignardescuento">Agregar Descuento</button>
  </form>
<!-- TERMINA FORMULARIO PRINCIPAL -->

    </div>
    
    <div class="col-md-6 btn-outline-black z-depth-2" id="contenidoasig">
          <?php $planilla->VerDescuentosAsig(); ?>
    </div>
   
</div>  <!-- row -->



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

        <i class="fas fa-times fa-4x animated rotateIn"></i>

      </div>

      <!--Footer-->
      <div class="modal-footer flex-center">
        <a id="deldescuento" class="btn  btn-outline-danger">Eliminar</a>
        <a type="button" class="btn  btn-danger waves-effect" data-dismiss="modal">No</a>
      </div>
    </div>
    <!--/.Content-->
  </div>
</div>
<!--Modal: modalConfirmDelete-->


  <!-- MODAL PARA CONFIRMAR ELIMINACION -->

<div class="modal fade" id="ConfirmDeleteAsig" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
        <a id="deldescuentoasig" class="btn  btn-outline-danger">Eliminar</a>
        <a type="button" class="btn  btn-danger waves-effect" data-dismiss="modal">No</a>
      </div>
    </div>
    <!--/.Content-->
  </div>
</div>
<!--Modal: modalConfirmDelete-->

