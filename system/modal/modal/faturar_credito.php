<?php
    include_once 'application/common/Alerts.php';
    include_once 'system/credito/Creditos.php';
    $credito = new Creditos(); 

    if ($r = $db->select("nombre", "creditos", "WHERE hash = '".$_REQUEST["cre"]."' and td = ".$_SESSION["td"]."")) { 
        $nombre = $r["nombre"];
    } unset($r);  


?>
<div class="modal" id="<? echo $_GET["modal"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="false">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
          FACTURAR CREDITO</h5>
      </div>
      <div class="modal-body">
<!-- ./  content -->

<?php  
include_once 'system/corte/Corte.php';
$cut = new Corte();
if($_SESSION["caja_apertura"] != NULL){ // comprobacion de corte
?>


<div class="row">
    <div class="col-md-12">
    <?php 
      $creditos = $credito->ObtenerTotal($_REQUEST["factura"], $_REQUEST["tx"], $_REQUEST["orden"]);
      $abonos = $credito->TotalAbono($_REQUEST["cre"]);
     ?>
     <div class="text-center">
     Seleccione el tipo de pago para el credito de <strong><?php echo $nombre; ?></strong> <br>


     <?php 

if($_SESSION["tx"] == 0){

    if ($r = $db->select("nota_envio, ninguno, ax0, bx0, dx0, ex0, fx0, gx0", "facturar_opciones", "WHERE td = ".$_SESSION["td"]."")) { 
        $envio = $r["nota_envio"]; $ninguno = $r["ninguno"]; $ax = $r["ax0"]; $bx = $r["bx0"]; $dx = $r["dx0"]; $ex = $r["ex0"]; $fx = $r["fx0"]; $gx = $r["gx0"];
    } unset($r);  

} else {
    
    if ($r = $db->select("nota_envio, ninguno, ax1, bx1, dx1, ex1, fx1, gx1", "facturar_opciones", "WHERE td = ".$_SESSION["td"]."")) { 
        $envio = $r["nota_envio"]; $ninguno = $r["ninguno"]; $ax = $r["ax1"]; $bx = $r["bx1"]; $dx = $r["dx1"]; $ex = $r["ex1"]; $fx = $r["fx1"]; $gx = $r["gx1"];
    } unset($r);  
}

if($ax == 1){
echo '<a href="application/src/routes.php?op=722&tipo=1&orden='.$_REQUEST["orden"].'&factura='.$_REQUEST["factura"].'&tx='.$_REQUEST["tx"].'" class="btn btn-cyan">Ticket</a>';
}
if($ex == 1){
echo '<a href="application/src/routes.php?op=722&tipo=3&orden='.$_REQUEST["orden"].'&factura='.$_REQUEST["factura"].'&tx='.$_REQUEST["tx"].'" class="btn btn-brown">Credito Fiscal</a>';
}
if($fx == 1){
echo '<a href="application/src/routes.php?op=722&tipo=12&orden='.$_REQUEST["orden"].'&factura='.$_REQUEST["factura"].'&tx='.$_REQUEST["tx"].'" class="btn btn-success">Factura 2</a>';
}

if($gx == 1){
echo '<a href="application/src/routes.php?op=722&tipo=13&orden='.$_REQUEST["orden"].'&factura='.$_REQUEST["factura"].'&tx='.$_REQUEST["tx"].'" class="btn btn-danger">Credito Fiscal 2</a>';
}

if($bx == 1){
echo '<a href="application/src/routes.php?op=722&tipo=2&orden='.$_REQUEST["orden"].'&factura='.$_REQUEST["factura"].'&tx='.$_REQUEST["tx"].'" class="btn btn-indigo">Factura</a>';
}
if($dx == 1){
echo '<a href="application/src/routes.php?op=722&tipo=4&orden='.$_REQUEST["orden"].'&factura='.$_REQUEST["factura"].'&tx='.$_REQUEST["tx"].'" class="btn btn-secondary">Exportación</a>';
}

if($ninguno == 1){
	echo '<a href="application/src/routes.php?op=722&tipo=0&orden='.$_REQUEST["orden"].'&factura='.$_REQUEST["factura"].'&tx='.$_REQUEST["tx"].'" class="btn btn-elegant">Ninguno</a>';
}

if($envio == 1){
	echo '<a href="application/src/routes.php?op=722&tipo=8&orden='.$_REQUEST["orden"].'&factura='.$_REQUEST["factura"].'&tx='.$_REQUEST["tx"].'" class="btn btn-success">Nota Envio</a>';
}

     ?>
     </div>
    </div>
</div>




<?php 
} else { /// termina comprobacion de corte
  Alerts::CorteEcho("facturacion de credito");
}
 ?>

<!-- ./  content -->
      </div>
      <div class="modal-footer">

<?php 
$url = "&cre=" . $_REQUEST["cre"] . "&factura=" . $_REQUEST["factura"]. "&tx=" . $_REQUEST["tx"]. "&orden=" . $_REQUEST["orden"];
 ?>
<a href="?creditos" class="btn btn-primary btn-rounded">Regresar</a>
      </div>
    </div>
  </div>
</div>
<!-- ./  Modal -->