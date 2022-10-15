<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'application/common/Alerts.php';
include_once 'system/ventas/Repartidor.php';
$repartidor = new Repartidor();
?>




<div class="row justify-content-md-center">
    <div class="col-12 col-md-auto">
        <form name="form-repartidores" method="post" id="form-repartidores">
        <input placeholder="Seleccione una Fecha" type="text" id="fecha" name="fecha" class="form-control datepicker my-2">
        <select class="browser-default form-control my-2" name="tipo" id="tipo">
            <option value="1">Repartidor</option>
            <option value="2">Vendedor</option>
        </select>
        <div id="userlista">
        <?php
            $repartidor->UserLista();
        ?>
        </div>
        <div id="repartidorLista">
        <?php
            $repartidor->RepartidorLista();
        ?>
        </div>

    </div>
  </div>


  <div class="row justify-content-md-center">
    <div class="col-12 col-md-auto text-center">
    <button class="btn btn-info my-2 btn-rounded btn-sm waves-effect" type="submit" id="btn-repartidores" name="btn-repartidores">Mostra Datos</button>
      </form> 
    </div>
  </div>

<div id="contenido" class="mt-5"> </div>
