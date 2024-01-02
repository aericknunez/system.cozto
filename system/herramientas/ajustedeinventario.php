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

<!-- modal para buscar el producto -->
<div class="modal" id="BuscadorProductos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="false">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
         BUSCAR PRODUCTO</h5>
      </div>
      <div class="modal-body">
<!-- ./  content -->

<div align="center">
  <div class="col-md-12 z-depth-2 justify-content-center">
      <div class="md-form mt-0">
        <form id="form-busqueda">
        <input class="form-control" type="text" placeholder="Buscar Producto" aria-label="Search" id="key" name="key" autofocus>

        <button class="btn btn-info my-2 btn-rounded btn-sm waves-effect" type="submit" id="btn-busqueda" name="btn-busqueda">Buscar</button>


        </form>
      </div>
  </div>
  <div class="col-md-12 z-depth-2 justify-content-center" id="muestra-busqueda"></div>
</div>

<div id="muestra-busqueda"> </div>

<!-- ./  content -->
      </div>
      <div class="modal-footer">

<!-- <a href="?modal=abonos<?php echo $url; ?>" class="btn btn-secondary btn-rounded">Realizar Abonos</a> -->
<a id="cerrarmodal" class="btn btn-primary btn-rounded" data-dismiss="modal">Regresar</a>

          
    
      </div>
    </div>
  </div>
</div>
<!-- ./  Modal -->