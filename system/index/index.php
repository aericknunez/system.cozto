<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'application/common/Alerts.php';
include_once 'application/common/Fechas.php';
include_once 'system/index/Inicio.php';
include_once 'system/corte/Corte.php';
$cut = new Corte();


// Alerts::Mensajex("Estimado cliente, en este momento estamos presentando problemas con nuestro proveedor de servicios y nuestro servidor principal, es posible que su sistema no funcione adecuadamente. 
//   Estamos trabajando para poder correjirlo. Disculpe las molestias", "danger");

$datalive = TRUE; /// para saber que estoy en index

if($_SESSION["cotizacion"]){
Alerts::Mensajex("ADVERTENCIA! Se detecto una cotizaci&oacuten sin concluir. Debe guardarla o eliminarla antes de continuar", "danger", '<a href="?cotizar" class="btn btn-danger">ir a Cotizaciones</a>');
}


echo '<div id="msj_agrupado">'; if($_SESSION["venta_agrupado"]){
Alerts::Mensajex("ADVERTENCIA! Se detecto activo la opción de producto agrupado. Todos los productos que agregue en este momento no tendran el precio establecido, sino que serán cobrados de manera especial", "danger", '<a id="agrupado" class="btn btn-danger">Desactivar</a>');
} echo '</div>';



if($_SESSION["precio_mayorista_activo"] == TRUE){
Alerts::Mensajex("ADVERTENCIA! Esta activado el precio de mayoreo", "success");
}

echo '<div id="ventana"></div>';

if($_SESSION["caja_apertura"] != NULL or $_SESSION["caja_soloagregar"] != NULL){ // apertura de caja
	if($_SESSION["tipo_inicio"] == 2){ 	include_once 'system/ventas/venta_lenta.php'; } 
	else { include_once 'system/ventas/venta_rapida.php'; }

} else { /// termina comprobacion de corte
	Alerts::Mensajex("Para poder realizar ventas debe aperturar la caja", "danger", 
    '<a id="abrirCaja" class="btn btn-info my-4" ><i class="fas fa-donate mr-1"></i> Abrir Caja</a>', 
    '<a id="cambiar" op="74" class="small" ><i class="fas fa-chalkboard mr-1"></i> Generar Ordenes</a>');
}


// print_r($_SESSION);

if($_SESSION["caja_apertura"] == NULL){
?>






<!-- Ver modal -->
<div class="modal" id="ModalAbrirCaja" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="false">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
         ABRIR CAJA</h5>
      </div>
      <div class="modal-body">
<!-- ./  content -->
  <form id="form-abrircaja">
  
  <div class="form-row justify-content-center">
    
    <div class="col-md-12 mb-1 md-form">
      <small >* Cantidad de Apertura</small>
      <input type="number" step="any" class="form-control" id="efectivo" name="efectivo" required>
    </div>

  </div>


  <div class="form-row">
    <div class="col-md-12 my-6 md-form text-center">
     <button class="btn btn-info my-4" type="submit" id="btn-abrircaja" cod=""><i class="fa fa-save mr-1"></i> Ingresar</button>

    </div>
  </div>

</form>

<div id="verabrircaja"></div>
<!-- ./  content -->
      </div>
      <div class="modal-footer">

    <a id="cerrar" class="btn btn-primary btn-rounded" data-dismiss="modal">Regresar</a>

      </div>
    </div>
  </div>
</div>
<!-- ./  Modal -->





<div class="modal" id="ModalMensaje" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="false">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
         CAJA APERTURADA</h5>
      </div>
      <div class="modal-body" align="center">
<!-- ./  content -->
<?php 
Alerts::Mensajex("CAJA APERTURADA CORRECTAMENTE","success", '<a href="?" class="btn btn-primary btn-rounded">Comenzar</a>');

 ?>

<!-- ./  content -->
      </div>
    </div>
  </div>
</div>
<!-- ./  Modal -->

<?php } ?>


<div class="modal" id="ModalTicket" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
         SELECCIONE TIPO DE DOCUMENTO</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" align="center">
<!-- ./  content -->
<div id="contenidomticket">
</div>
<!-- ./  content -->
      </div>

<div class="modal-footer">
<a id="cerrarmodal" class="btn btn-primary btn-rounded" data-dismiss="modal">Regresar</a>
</div>

    </div>
  </div>
</div>
<!-- ./  Modal -->
