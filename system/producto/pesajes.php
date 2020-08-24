<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
include_once 'system/producto/Pesaje.php';
$peso = new Pesaje();
?>


<div class="row d-flex justify-content-center" align="center">
  
<div class="col-md-6 col-sm-12">


  <div class="col-12 z-depth-2 ">
      <div class="md-form mt-0">
        <form id="p-busqueda">
        <input class="form-control" type="text" placeholder="Buscar Producto" aria-label="Search" id="key" name="key" autofocus>

        <button class="btn aqua-gradient btn-rounded btn-sm" type="submit" id="btn-busqueda" name="btn-busqueda">Buscar</button>
        </form>
      </div>
  </div>

  <div class="col-12 z-depth-2 " id="muestra-busqueda"></div>  

</div>


</div>




<!-- aqui irá lo que retorna de la busqueda -->
<form id="form-registrar" name="form-registrar">

<div class="row d-flex justify-content-center">
  <div class="col-md-6 col-sm-12" id="retorno"></div>
</div>

<div class="row d-flex justify-content-center">
<button class="btn btn-primary invisible" id="btn-registrar"><i class="fas fa-save mr-1"></i> Guardar Peso</button>
</div>
</form>





<div class="row d-flex justify-content-center">
  <div class="col-12" id="contenido">
    <?php 
        $peso->VerPesos(1, "id", "desc");
     ?>
  </div>
</div>