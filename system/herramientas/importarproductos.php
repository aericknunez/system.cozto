<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'application/common/Alerts.php';
include_once 'system/herramientas/Importar.php';
$import = new Importar(); 
?>

<div id="msj"></div>
<h2 class="h2-responsive">Importar productos a Inventario  <?php 
// echo '<a href="downloader.php?data=Formato_importar.xlsx&name=Formato_importar&type=3" data-toggle="tooltip" data-html="true" title="<b>DESCARGAR FORMATO EXCEL</b>"><i class="fas fa-cloud-download-alt fa-lg red-text"></i></a>'; 

echo '<a href="downloader.php?data=Formato_importar.xlsx&name=Formato_importar&type=3" data-toggle="tooltip" data-html="true" title="<b>DESCARGAR FORMATO EXCEL</b>"><i class="fas fa-cloud-download-alt fa-lg red-text"></i></a>'; 

      ?></h2>


<div class="row d-flex justify-content-center" id="formulario">
  <div class="col-md-6">
      <form id="form-file" name="form-file" class="md-form">

    <div class="file-field">
        <a class="btn-floating blue-gradient mt-0 float-left">
            <i class="fas fa-paperclip" aria-hidden="true"></i>
            <input type="file" id="archivo" name="archivo">
        </a>
        <div class="file-path-wrapper">
           <input class="file-path validate" type="text" placeholder="Agregue su archivo">
        </div>
    </div>

<div class="text-center">
  <button class="btn btn-outline-info btn-rounded z-depth-0 my-2 waves-effect" type="submit" id="btn-file" name="btn-file">Subir Archivo</button>
</div>
    </form>
  </div>
</div>



<div id="contenido">

</div>