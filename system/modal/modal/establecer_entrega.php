<?php
    include_once 'application/common/Alerts.php'; 
 ?>
<div class="modal" id="<? echo $_GET["modal"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
          FECHA DE ENTREGA</h5>
      </div>
      <div class="modal-body">
<!-- ./  content -->

<!-- <input type="date" /> -->

<!-- date  -->
<div class="row justify-content-center">
    <div class="col-12 col-md-auto">
     <form name="form-fecha" method="post" id="form-fecha">
      <input placeholder="Seleccione una fecha" type="text" id="fecha" name="fecha" class="form-control datepicker my-2">
      <button class="btn btn-info my-2 btn-rounded btn-sm waves-effect" type="submit" id="btn-fecha" name="btn-fecha">Establecer fecha de Entrega</button>
     </form> 
    </div>

</div>
<div id="contenido" class="row justify-content-center h2"></div>

<!-- ./  content -->
      </div>
      <div class="modal-footer">
            <a href="?modal=add_repartidor" class="btn btn-danger btn-rounded btn-sm">Repartidor</a>
          <a href="?" class="btn btn-primary btn-rounded">Regresar</a>
    
      </div>
    </div>
  </div>
</div>
<!-- ./  Modal -->