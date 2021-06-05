<?php
include_once 'application/common/Alerts.php';
include_once 'system/cuentas/Cuentas.php';
$cuenta = new Cuentas(); 


include_once 'system/gastos/Gasto.php';
$gasto = new Gastos();
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
if($_SESSION["caja_apertura"] != NULL){ // comprobacion de corte
?>


<?php 
$cuenta->VerCuenta($_REQUEST["cuenta"]);
?>
<hr>
<div class="row">

    <div class="col-md-6" id="origen">
        <form class="text-center border border-light p-2" id="form-abono" name="form-abono"> 




<select class="browser-default custom-select mb-3" id="pago" name="pago">
  <option value="1" selected>EFECTIVO</option>
  <option value="2">CHEQUE</option>
  <option value="3">TRANSFERENCIA</option>
  <option value="4">TARJETA</option>
  <option value="5">CAJA CHICA</option>
</select>


<div id="muestra_b" class="row">
  <div id="muestra_banco" class="col-10">

<?php 
echo $gasto::MostarBancos(1); ?>

  </div>
  <div class="col-2 mt-0">
    <a id="addbanco"><i class="fas fa-plus-circle fa-2x green-text"></i></a>
  </div>
</div>






        <input type="hidden" id="cuenta" name="cuenta" value="<?php echo $_REQUEST["cuenta"]; ?>"> 
        <input type="number" step="any" id="abono" name="abono" autocomplete="off" class="form-control mb-3" placeholder="0.00">

<!-- <div class="text-right"><small><a id="adddetalles">Agregar Detalles</a></small></div> -->

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









<!-- Ver add BANCO -->
<div class="modal" id="ModalAddBanco" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
         AGREGAR CUENTA BANCARIA</h5>
      </div>
      <div class="modal-body">
<!-- ./  content -->

<div id="formulario">
  <form id="form-banco" name="form-banco" class="md-form">

<select class="browser-default custom-select mb-3" id="tipo" name="tipo">
  <option value="2">CHEQUERA</option>
  <option value="3" selected>CUENTA BANCARIA</option>
  <option value="4">TARJETA DE CREDITO</option>
  <option value="5">CAJA CHICA</option>
</select>


<input type="text"  id="nocuenta" name="nocuenta" class="form-control mb-3" placeholder="Numero de Cuenta">

<input type="text"  id="banco" name="banco" class="form-control mb-3" placeholder="Banco">

<input type="number" step="any" id="saldo" name="saldo" class="form-control mb-3" placeholder="Saldo Inicial">


<div class="text-center">
  <button class="btn btn-outline-info btn-rounded z-depth-0 my-2 waves-effect" type="submit" id="btn-banco" name="btn-banco">Agregar Cuenta</button>
</div>
    </form>
</div>


<div id="vista_banco">
</div>

<!-- ./  content -->
      </div>
      <div class="modal-footer">
   <a id="cerrarmodal" class="btn btn-primary btn-rounded" data-dismiss="modal">Cerrar</a>
   
      </div>
    </div>
  </div>
</div>
<!-- ./  Modal -->
