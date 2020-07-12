<?php
include_once 'application/common/Alerts.php';
include_once 'system/cuentas/Cuentas.php';
$cuenta = new Cuentas(); 
?>
<div class="modal" id="<? echo $_GET["modal"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="false">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
          ABONOS REALIZADOS</h5>
      </div>
      <div class="modal-body">
<!-- ./  content -->

<?php  
include_once 'system/corte/Corte.php';
$cut = new Corte();
if($cut->UltimaFecha() != date("d-m-Y")){ // comprobacion de corte
?>


<?php 
$cuenta->VerCuenta($_REQUEST["cuenta"]);
?>
<hr>
<div class="row">

    <div class="col-md-6" id="origen">
        <form class="text-center border border-light p-2" id="form-abono" name="form-abono"> 

        <input type="hidden" id="cuenta" name="cuenta" value="<?php echo $_REQUEST["cuenta"]; ?>"> 
        <input type="number" step="any" id="abono" name="abono" autocomplete="off" class="form-control mb-3" placeholder="0.00">
        <button class="btn btn-info my-2" type="submit" id="btn-abono" name="btn-abono">AGREGAR ABONO</button>
        </form>
    </div>



    <?php 
      $creditos = $cuenta->ObtenerTotal($_REQUEST["cuenta"]);
      $abonos = $cuenta->TotalAbono($_REQUEST["cuenta"]);
     ?>
    <div class="col-md-6" id="destino">
        <div class="text-center border border-light">
          Total del credito:
          <h3><?php echo Helpers::Dinero($creditos); ?></h3>
        </div>
        <div class="text-center border border-light">
         Total Abonado:
          <h3 id="data-abonos"><?php echo Helpers::Dinero($abonos); ?></h3>
        </div>
        <div class="text-center border border-light text-danger">
         Total pendiente:
          <h3 id="data-total"><?php echo Helpers::Dinero($creditos - $abonos); ?></h3>
        </div>
    </div>
   
</div>


<div id="contenido" class="mt-4">
<?php 
$cuenta->VerAbonos($_REQUEST["cuenta"]);
?>
</div>


<?php 
} else { /// termina comprobacion de corte
  Alerts::CorteEcho("Abonos");
}
 ?>

<!-- ./  content -->
      </div>
      <div class="modal-footer">


<a href="?cuentas" class="btn btn-primary btn-rounded">Regresar</a>
      </div>
    </div>
  </div>
</div>
<!-- ./  Modal -->