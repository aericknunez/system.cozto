<?php
    include_once 'application/common/Alerts.php'; 
 ?>
 <div class="modal" id="<? echo $_GET["modal"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
          VENTA AGRUPADA</h5>
      </div>
      <div class="modal-body">

<?php  

$a = $db->query("SELECT cod FROM ticket WHERE cod = '8888888' and orden = ".$_SESSION["orden"]." and tx = ".$_SESSION["tx"]." and td = ".$_SESSION["td"]."");
$cantidad = $a->num_rows;
$a->close();


if($cantidad > 0){ ?>

<div class="row d-flex justify-content-center">
  <div class="col-md-12">

<?php Alerts::Mensajex("Sólo se puede agregar un producto agrupado por factura","danger") ?>

  </div>
</div>

<?php } else { ?>

<!-- ./  content -->
<div class="row d-flex justify-content-center">
  <div class="col-md-12">
<form class="text-center border border-light p-3" id="form-agrupado" name="form-agrupado">

<input type="text" name="producto" id="producto" class="form-control mb-3" placeholder="Nombre del producto">
<input type="hidden" name="agrupado" id="agrupado" value="agrupado">

<input type="number" step="any" id="precio" name="precio" class="form-control mb-3" placeholder="Precio">
<button class="btn btn-info my-4" type="submit" id="btn-agrupado" name="btn-agrupado">Agregar Producto</button>
 </form>

  </div>
</div>

<?php } ?>
<div id="msj"></div>
<!-- ./  content -->
      </div>
      <div class="modal-footer">

          <a href="?" class="btn btn-primary btn-rounded">Regresar</a>
    
      </div>
    </div>
  </div>
</div>
<!-- ./  Modal -->