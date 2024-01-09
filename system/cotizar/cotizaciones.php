<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'application/common/Alerts.php';
include_once 'application/common/Fechas.php';
include_once 'system/cotizar/CotizarR.php';

$cot = new Cotizar(); 
?>

<div id="msj"></div>
<h2 class="h2-responsive">COTIZACIONES EMITIDAS</h2>


<div id="contenido">
   <?php $cot->TodasCotizaciones(1, "correlativo", "desc"); ?>
</div>


<!-- Ver producto -->
<div class="modal" id="ModalVer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="false">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
         DETALLES DE LA COTIZACION</h5>
      </div>
      <div class="modal-body">
<!-- ./  content -->

<div id="vista"></div>

<!-- ./  content -->
      </div>
      <div class="modal-footer">

<a id="facturar" op="162" class="btn btn-secondary btn-rounded">Facturar</a>

<a id="activar_cotizacion" op="161" class="btn-floating btn-sm red"><i class="fas fa-edit"></i></a>

<a id="imprimir" class="btn-floating btn-sm blue-gradient"><i class="fa fa-print"></i></a>

<a id="cerrarmodal" class="btn btn-primary btn-rounded" data-dismiss="modal">Regresar</a>

          
    
      </div>
    </div>
  </div>
</div>
<!-- ./  Modal -->



<!-- Ver imagenes -->
<div class="modal" id="ModalAddImg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
         IMAGENES COTIZACION</h5>
      </div>
      <div class="modal-body">
<!-- ./  content -->

<div id="formulario">
  <form id="form-img" name="form-img" class="md-form">

    <div class="file-field">
        <a class="btn-floating blue-gradient mt-0 float-left">
            <i class="fas fa-paperclip" aria-hidden="true"></i>
            <input type="file" id="archivo" name="archivo">
        </a>
        <div class="file-path-wrapper">
           <input class="file-path validate" type="text" placeholder="Agregue su imagen">
        </div>
    </div>

  <div class="md-form my-2 ">
      <textarea type="text" id="materialContactFormMessage" class="form-control md-textarea" rows="2" id="descripcion" name="descripcion"></textarea>
      <label for="materialContactFormMessage">Descripci&oacuten de la imagen</label>
  </div>

<input type="hidden" id="codigo" name="codigo" value="">
   
<div class="text-center">
  <button class="btn btn-outline-info btn-rounded z-depth-0 my-2 waves-effect" type="submit" id="btn-img" name="btn-img">Subir Imagen</button>
</div>
    </form>
</div>

<div id="imagenCot">

</div>

<!-- ./  content -->
      </div>
      <div class="modal-footer">
    <a id="showform" class="btn btn-danger btn-rounded">Agregar</a>
   <a id="cerrarmodal" class="btn btn-primary btn-rounded" data-dismiss="modal">Cerrar</a>
   
      </div>
    </div>
  </div>
</div>
<!-- ./  Modal -->
