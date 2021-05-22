<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'application/common/Alerts.php';
include_once 'system/herramientas/Herramientas.php';
$herramienta = new Herramientas(); 
include_once 'system/producto/Productos.php';
?>

<div id="msj"></div>
<h2 class="h2-responsive">Ajuste de Inventario</h2>


<div id="contenido">
<?php 
  if($herramienta->ComprobarAjuste() == TRUE){
    
    $herramienta->AjustedeInventario(1, "id", "asc"); 

  } else {

    Alerts::Mensajex("No se ha iniciado el ajuste de inventario. Con esta herramienta podrá ajustar su inventario con los datos reales","info", '<a id="iniciarajuste" class="btn btn-primary btn-rounded">Iniciar</a>');


    $herramienta->AjustesRealizados();
  }

?>
</div>


<!-- Ver producto -->
<div class="modal" id="ModalCantidad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="false">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
         DETALLES PRODUCTO</h5>
      </div>
      <div class="modal-body">
<!-- ./  content -->

<div id="cantproducto"></div>


  <form id="form-ajustari">
  
  <div class="form-row justify-content-center">
    
    <div class="col-md-12 mb-1 md-form">
      <input type="hidden"  id="cod" name="cod" value="">
      <small >* Nueva cantidad</small>
      <input type="number" step="any" class="form-control" id="cantidad" name="cantidad" required>
    </div>

  </div>


  <div class="form-row">
    <div class="col-md-12 my-6 md-form text-center">
     <button class="btn btn-info my-4" type="submit" id="btn-ajustari"><i class="fa fa-save mr-1"></i> Ingresar</button>

    </div>
  </div>

</form>
<!-- ./  content -->
      </div>
      <div class="modal-footer">
<a id="cerrarmodal" class="btn btn-primary btn-rounded" data-dismiss="modal">Regresar</a>

      </div>
    </div>
  </div>
</div>
<!-- ./  Modal -->

