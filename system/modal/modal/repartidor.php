<?php
    include_once 'application/common/Alerts.php'; 
 ?>
<div class="modal" id="<? echo $_GET["modal"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
          ASIGNAR <?php
          echo strtoupper(Helpers::RepartidorOrEmpleado());
          ?></h5>
      </div>
      <div class="modal-body">
<!-- ./  content -->
<?php
echo Helpers::RepartidorOrEmpleado();
?>
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
      $texto = Helpers::RepartidorOrEmpleado() . ' asignado para la Factura: ' . $_SESSION['repartidor_asig']. ".";
    Alerts::Mensajex($texto,"danger",'<a id="quitar-repartidorA" op="707" class="btn btn-danger btn-rounded">Quitar '. Helpers::RepartidorOrEmpleado() .'</a>',$boton2);
}
 ?>  
</div>

<!-- ./  content -->
      </div>
      <div class="modal-footer">
      
      <?php
            if (!$_SESSION["root_asignar_empleado"]) { ?>
              <a href="?modal=add_fecha" class="btn btn-danger btn-rounded btn-sm">Entrega</a>
              <a href="?addempleado" class="btn btn-secondary btn-rounded">Nuevo Empleado</a>
      <?php
        }
      ?>
          
          <a href="?" class="btn btn-primary btn-rounded">Regresar</a>
    
      </div>
    </div>
  </div>
</div>
<!-- ./  Modal -->