<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'application/common/Alerts.php';
include_once 'system/facturar/Search.php';
$busqueda = new Search();
?>

<div class="clearfix">
  <h2 class="h2-responsive float-left">BUSCAR <?php echo strtoupper($_SESSION["root_extra"]) ?></h2> 
  <h2 class="h2-responsive float-right"><a id="buscarComentatarios" class="btn-floating btn-info btn-sm mb-3" title="Buscar"><i class="fas fa-search"></i></a></h2>
</div>

<div class="row d-flex justify-content-center">
  <div class="col-12 col-md-8" id="contenido">

<?php 
// $busqueda->BusquedaPorOpciones($_SESSION["search"]);
?>

  </div>
</div>

<!-- modal para buscar el producto -->
<div class="modal" id="BuscadorComentarios" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="false">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
         BUSCAR <?php echo strtoupper($_SESSION["root_extra"]) ?></h5>
      </div>
      <div class="modal-body">
<!-- ./  content -->

<div align="center">
  <div class="col-md-12 z-depth-2 justify-content-center">
      <div class="md-form mt-0">
        <form id="form-busqueda">
        <input class="form-control" type="text" placeholder="Buscar" aria-label="Search" id="key" name="key" autofocus>

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