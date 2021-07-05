<div class="modal bounceIn" id="<? echo $_GET["modal"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="false">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
          BUSCAR PRODUCTO</h5>
      </div>
      <div class="modal-body">
<!-- ./  content -->



<div align="center">

    <div class="mb-1 md-form">
      <div class="row">


        <div class="col-md-4">
      <select class="mdb-select md-form colorful-select dropdown-dark" id="modelos" name="modelos">
       <?php 
       echo Helpers::SelectDataMultiple("* Seleccione un Modelo", 
        "autoparts_marca", "hash", "marca", 
        "marca",
        "autoparts_modelo", "hash", "modelo", 
          NULL); 
        ?>
      </select>
        </div>

        <div class="col-md-4">
        <select class="mdb-select md-form colorful-select dropdown-dark" id="anio" name="anio">
        <?php 
                echo '<option value="" selected >Seleccione un Año</option>'; 
                for ($i = date("Y"); $i >= 2000; $i--) {    
                  echo '<option value="'.$i.'">'.$i.'</option>';      
                  }

        ?>
      </select>
        </div>

    <div class="col-6 col-md-4 mb-1 md-form">
      <label for="medida">* Medida</label>
      <input type="text" step="any" class="form-control" id="medida" name="medida" required>
    </div>

      </div>
  </div>


  <div class="col-md-12 z-depth-2 justify-content-center">
      <div class="md-form mt-0">
        <form id="p-busqueda">

       <input class="form-control" type="text" placeholder="Buscar Producto" aria-label="Search" id="key" name="key" autofocus>
        </form>
      </div>
  </div>
  <div class="col-md-12 z-depth-2 justify-content-center" id="muestra-busqueda"></div>
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