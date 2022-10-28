<?php
    include_once 'application/common/Alerts.php'; 
 ?>
<div class="modal" id="<? echo $_GET["modal"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
          ASIGNAR REPARTIDOR</h5>
      </div>
      <div class="modal-body">
<!-- ./  content -->
Repartidor:
<div align="center">
  <div class="col-md-12 z-depth-2 justify-content-center">
      <div class="md-form mt-0">
        <form id="c-busquedaR">
        <input class="form-control" type="text" placeholder="Buscar Empleado" aria-label="Search" id="repartidor-busquedaR" name="repartidor-busquedaR" autofocus>
        </form>
      </div>
  </div>
  <div class="col-md-12 z-depth-2 justify-content-center" id="muestra-busquedaR"></div>
</div>

<div id="ver">
<?php 
if($_SESSION['repartidor_asig']){
      $texto = 'Repartidor asignado para la Factura: ' . $_SESSION['repartidor_asig']. ".";
    Alerts::Mensajex($texto,"danger",'<a id="quitar-repartidorA" op="707" class="btn btn-danger btn-rounded">Quitar Repartidor</a>',$boton2);
}
 ?>  
</div>
<!-- ./  content -->
      </div>
      <div class="modal-footer">
          <a href="?addempleado" class="btn btn-secondary btn-rounded">Agregar Empleado</a>
          <a href="?" class="btn btn-primary btn-rounded">Regresar</a>
    
      </div>
    </div>
  </div>
</div>
<!-- ./  Modal -->