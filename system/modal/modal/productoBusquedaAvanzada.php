<div class="modal bounceIn" id="<? echo $_GET["modal"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="false">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
          BUSCAR PRODUCTO</h5>
      </div>
      <div class="modal-body">
<!-- ./  content -->



<div class="text-center">

  <div class="col-md-12 z-depth-2 justify-content-center">
      <div class="md-form mt-0">
        <form id="p-busqueda">

       <input class="form-control" type="text" placeholder="Buscar Producto" aria-label="Search" id="key" name="key" autofocus>
        </form>
      </div>
  </div>
  <div class="col-md-12 z-depth-2 justify-content-center" id="muestra-busqueda"></div>

  <div class="mb-1 md-form">
      <div class="row">

    <div class="col-6 col-md-4 mb-1 md-form">
      <label for="criterio1">* Criterio</label>
      <input type="text" step="any" class="form-control" id="criterio1" name="criterio1">
    </div>

    <div class="col-6 col-md-4 mb-1 md-form">
      <label for="criterio2">* Criterio</label>
      <input type="text" step="any" class="form-control" id="criterio2" name="criterio2">
    </div>

    <div class="col-6 col-md-4 mb-1 md-form">
      <label for="criterio3">* Criterio</label>
      <input type="text" step="any" class="form-control" id="criterio3" name="criterio3">
    </div>

      </div>
  </div>

  
</div>

<div id="contenido">
  
</div>


<!-- ./  content -->
      </div>
      <div class="modal-footer">
<?php 
        // if($_SERVER['HTTP_REFERER'] != XSERV . "?modal=productoBusquedaTaller"){
        //   $url = $_SERVER['HTTP_REFERER'];
        // } else{
        //   $url = "?";
        // }

        $url = "?";
 ?>
          <a id="deleteAll" class="btn btn-secondary btn-rounded btn-sm">Limpiar</a>
          <a href="<?php echo $url; ?>" class="btn btn-primary btn-rounded">Regresar</a>
    
      </div>
    </div>
  </div>
</div>
<!-- ./  Modal -->








<!-- Ver producto -->
<div class="modal" id="ModalVer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="false">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
         DETALLES PRODUCTO</h5>
      </div>
      <div class="modal-body">
<!-- ./  content -->

<div id="vista"></div>


<div class="row">
<div class="col-md-12">
    <div id="mdb-lightbox-ui"></div>
    <div class="mdb-lightbox">
      <div id="contenido-img"></div>
</div>
 </div>
 </div>
<!-- ./  content -->
      </div>
      <div class="modal-footer">
<?php if($_SESSION["tipo_cuenta"] != 4) { ?>
<a href="" id="btn-pro" class="btn btn-secondary btn-rounded">Modificar Datos</a>
<? } ?>
<a id="cerrarmodal" class="btn btn-primary btn-rounded" data-dismiss="modal">Regresar</a>

          
    
      </div>
    </div>
  </div>
</div>
<!-- ./  Modal -->


