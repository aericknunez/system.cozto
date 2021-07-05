<?php
    include_once 'application/common/Alerts.php';
    include_once 'system/taller/Taller.php';
    $taller = new Taller(); 

?>

<div class="modal" id="<? echo $_GET["modal"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="false">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
          Editar Vehiculo</h5>
      </div>
      <div class="modal-body">
<!-- ./  content -->
<?php if($_REQUEST["key"] != NULL){ 
  $key = $_REQUEST["key"];
  if ($r = $db->select("*", "taller_vehiculo", "WHERE hash = '$key' and td = ".$_SESSION["td"]."")) { 

$hash = $r["hash"];
$cliente = $r["cliente"];
$placa = $r["placa"];
$marca = $r["marca"];
$ano = $r["ano"]; 
$modelo = $r["modelo"];
$clase = $r["clase"]; 
$tipo = $r["tipo"];
$color = $r["color"];
$chasis_gravado = $r["chasis_gravado"];
$chasis_vin = $r["chasis_vin"];
$no_motor = $r["no_motor"];
$detalles = $r["detalles"];
  }  unset($r); ?>

<div id="destinocliente">
  
</div>


<?php 
    $a = $db->query("SELECT hash, cliente FROM taller_cliente WHERE td = ".$_SESSION["td"]."");

     $c = $db->query("SELECT hash, marca FROM autoparts_marca WHERE td = ".$_SESSION["td"]."");

?>  
  <form id="form-vehiculo">

<div id="datos_cliente">
  <?php $taller->DatosCliente($cliente); ?>
</div>


  <div class="form-row">
    
    <div class="col-md-6 mb-1 md-form">
      <label for="placa">* Placa</label>
      <input type="text" step="any" class="form-control" id="placa" name="placa" value="<?= $placa ?>" required>
    </div>

<!--     <div class="col-md-4 mb-1 md-form">
      <select class="mdb-select md-form colorful-select dropdown-dark mt-1" id="marca" name="marca">
        <option selected disabled>Marca</option>
        <?php foreach ($c as $d) {
        echo '<option value="'. $d["hash"] .'">'. $d["marca"] .'</option>'; 
        } $a->close(); ?>
      </select>
    </div> -->
  
    <div class="col-md-6 mb-1 md-form">
      <label for="ano">* Año</label>
      <input type="text" class="form-control" id="ano" name="ano" value="<?= $ano ?>" required>
    </div>

  </div>



  <div class="form-row">
    
<!--     <div class="col-md-3 mb-1 md-form">
      <select class="mdb-select md-form colorful-select dropdown-dark mt-1" id="modelo" name="modelo">
            <option selected disabled>Modelo</option>  
      </select>
    </div> -->

    <div class="col-md-4 mb-1 md-form">
      <label for="clase">Clase</label>
      <input type="text" class="form-control" id="clase" name="clase" value="<?= $clase ?>" required>
    </div>
  
    <div class="col-md-4 mb-1 md-form">
      <label for="tipo">Tipo</label>
      <input type="text" class="form-control" id="tipo" name="tipo" value="<?= $tipo ?>" required>
    </div>

    <div class="col-md-4 mb-1 md-form">
      <label for="color">Color</label>
      <input type="text" class="form-control" id="color" name="color" value="<?= $color ?>" required>
    </div>

  </div>




  <div class="form-row">
    
    <div class="col-md-4 mb-1 md-form">
      <label for="chasis_gravado">Chasis Gravado</label>
      <input type="text" step="any" class="form-control" id="chasis_gravado" name="chasis_gravado" value="<?= $chasis_gravado ?>" required>
    </div>

    <div class="col-md-4 mb-1 md-form">
      <label for="chasis_vin">Chasis Vin</label>
      <input type="text" class="form-control" id="chasis_vin" name="chasis_vin" value="<?= $chasis_vin ?>" required>
    </div>
  
    <div class="col-md-4 mb-1 md-form">
      <label for="no_motor">No Motor</label>
      <input type="text" class="form-control" id="no_motor" name="no_motor" value="<?= $no_motor ?>" required>
    </div>

  </div>





    <div class="form-row">
    
    <div class="col-md-12 mt-0 md-form">
      <textarea id="detalles" name="detalles" class="md-textarea form-control" rows="3"><?= $detalles ?></textarea>
      <label for="detalles">Detalles</label>
    </div>

  </div>





  <div class="form-row mt-5">
    <div class="col-md-12 md-form text-center">
     <button class="btn btn-info" type="submit" id="btn-vehiculo"><i class="fas fa-save mr-1"></i> Guardar</button>

    </div>
  </div>

</form>

<!-- TERMINA FORMULARIO PRINCIPAL -->
<? } ?>
<!-- ./  content -->
      </div>
      <div class="modal-footer">

          <a href="?vehiculos" class="btn btn-primary btn-rounded">Regresar</a>
    
      </div>
    </div>
  </div>
</div>
<!-- ./  Modal -->