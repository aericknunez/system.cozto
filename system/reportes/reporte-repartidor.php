<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'application/common/Alerts.php';
include_once 'system/ventas/Repartidor.php';
$repartidor = new Repartidor();
?>


<form name="form-repartidores" method="post" id="form-repartidores">
    <div class="row justify-content-center border">
    <div class="col-4">
      <input placeholder="Seleccione una Fecha" type="text" id="fecha" name="fecha" class="form-control datepicker my-2">
    </div>
    <div class="col-4">
    <?php
    $repartidor->RepartidorLista();
    ?>
    </div>
    <div class="col-4">
      <button class="btn btn-info my-2 btn-rounded btn-sm waves-effect" type="submit" id="btn-repartidores" name="btn-repartidores">Mostra Datos</button>
    </div>
    </div>
</form> 

<div id="contenido" class="mt-5"> </div>
