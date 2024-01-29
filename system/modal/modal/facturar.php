<?php 
    include_once 'system/ventas/Laterales.php';
    $lateral = new Laterales(); 

if ($_REQUEST["t"] == 1) {
  $_SESSION["tcredito"] = 2;
  $dir = "?modal=facturar";
  $txt = "Pago en Efectivo";
} else {
  if(isset($_SESSION["tcredito"])) unset($_SESSION["tcredito"]);
  $dir = "?modal=facturar&t=1";
  $txt = "Pago con " . $_SESSION['root_tarjeta'];
}
 ?><div class="modal" id="<? echo $_GET["modal"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
          FACTURAR VENTA</h5>
      </div>
      <a href="?">
      <div class="modal-body">
<!-- ./  content -->

<?php if($lateral->ContarProducto($_SESSION["orden"]) != 0){ ?>
<div id="formularios">
<?php 
$total = $lateral->ObtenerTotal($_SESSION["orden"]);

echo '<p class="text-center font-weight-bold">TOTAL:</p>';
echo '<div class="display-4 text-center font-weight-bold">'. Helpers::Dinero($total) .'</div> <hr>';

 ?>
</a>
<div align="center">
   <form id="form-facturar" name="form-facturar">
     
     <?php if(isset($_SESSION["cliente_c"])) { ?>
      <?php if($_SESSION['aplicar_credito_sin_factura'] == 1) { 
      $imagen = "assets/img/imagenes/credito2.png" ;
      $mensaje = "Efectuar Credito sin factura" ;
     }else{
      $imagen = "assets/img/imagenes/credito.png" ;
      $mensaje = "Efectuar nota de credito" ;
     } ?>
     <div class="form-group row justify-content-center align-items-center">
      <div class="col-xs-2">
        <label for="ex1"><?php echo $mensaje ?></label>
        <input name="efectivo" type="hidden" id="efectivo" size="8" />
      </div>
    </div>
    
    <input type="image" src="<?php echo $imagen ?>"  id="btn-facturar" name="btn-facturar" >
    
    <?php if($_SESSION['aplicar_credito_sin_factura'] == 1) { echo '<div class="text-danger font-weight-bold">
      Este credito se facturará al final de la cancelación</div>'; } ?>
    
    
     <?php } elseif(isset($_SESSION["tcredito"])) { ?>

     <div class="form-group row justify-content-center align-items-center">
      <div class="col-xs-2">
        <label for="ex1">APLICAR PAGO</label>
        <input name="efectivo" type="hidden" id="efectivo" size="8" />
      </div>
    </div>
    <input type="image" src="assets/img/imagenes/tarjeta.png"  id="btn-facturar" name="btn-facturar" >
    

    <?php } else { ?>
     
     <div class="form-group row justify-content-center align-items-center">
      <?php
        if ($_SESSION["tipoticket"] != 8) {
      ?>
      <div class="col-xs-2">
        <label for="ex1">Efectivo</label>
        <input name="efectivo" type="number" id="efectivo" size="8" maxlength="8" class="form-control" placeholder="0.00" step="any" required autofocus />
      </div>
      <?php
        }
      ?>
    </div>
    <input type="image" src="assets/img/imagenes/print.png"  id="btn-facturar" name="btn-facturar" >
    
    <?php } ?>

    </form>
</div>

</div>
<?php } else {
  echo '<p class="text-center font-weight-bold">No se encuentran productos pendientes a facturar en esta orden</p></a>';
} ?>
<a href="?" id="link-to">
<div id="resultado"></div>
</a>
<!-- ./  content -->
      </div>
    
      <div class="clearfix modal-footer">
        
        <div id="botones-imprimir" class="float-left">
        <?php if(!isset($_SESSION["cliente_c"]) and $_SESSION["tipoticket"] != 8) { ?>
          <a href="<?php echo $dir; ?>" id="btn-te" class="btn btn-secondary btn-rounded"><?php echo $txt; ?></a>
        <?php } ?>
        </div>
        <div class="float-right">
          <a href="?" id="btn-regresar" class="btn btn-primary btn-rounded">Regresar</a>
        </div>
    
      </div>
    </div>
  </div>
</div>
<!-- ./  Modal -->