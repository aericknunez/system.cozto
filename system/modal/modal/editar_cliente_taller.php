<div class="modal" id="<? echo $_GET["modal"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="false">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
          Editar Cliente</h5>
      </div>
      <div class="modal-body">
<!-- ./  content -->
<?php if($_REQUEST["key"] != NULL){ 
  $key = $_REQUEST["key"];
  if ($r = $db->select("*", "taller_cliente", "WHERE hash = '$key' and td = ".$_SESSION["td"]."")) { 

$hash = $r["hash"];
$cliente = $r["cliente"];
$dui = $r["dui"];
$direccion = $r["direccion"]; 
$municipio = $r["municipio"];
$departamento = $r["departamento"]; 
$email = $r["email"];
$giro = $r["giro"];
$registro = $r["registro"];
$nit = $r["nit"];
$telefono1 = $r["telefono1"];
$telefono2 = $r["telefono2"];
$comentarios = $r["comentarios"]; 
  }  unset($r); ?>

<div id="destinocliente">
  
</div>

  <form id="form-cliente">

  <div class="form-row">
    
    <div class="col-md-8 mb-0 md-form">
      <label for="cliente">* Cliente</label>
      <input type="text" class="form-control" id="cliente" name="cliente" value="<?= $cliente ?>" required>
    </div>

    <div class="col-md-4 mb-0 md-form">
      <label for="dui">DUI</label>
      <input type="text" class="form-control" id="dui" name="dui" value="<?= $dui ?>">
    </div>

  </div>


  <div class="form-row">
    
    <div class="col-md-12 mb-0 md-form">
      <label for="direccion">Dirección</label>
      <input type="text" class="form-control" id="direccion" name="direccion" value="<?= $direccion ?>" required>
    </div>

  </div>


  <div class="form-row">
    
    <div class="col-md-6 mt-0 md-form">
      <!-- <select class="mdb-select md-form colorful-select dropdown-dark" id="departamento" name="departamento">
        <option selected disabled>Departamento</option>
        <option value="1">Departamento</option>
      </select> -->
      <label for="departamento">Departamento</label>
      <input type="text" class="form-control" id="departamento" name="departamento" value="<?= $departamento ?>">
    </div>


    <div class="col-md-6 mt-0 md-form">
      <!-- <select class="mdb-select md-form colorful-select dropdown-dark" id="municipio" name="municipio">
        <option selected disabled>Municipio</option>
        <option value="1">Municipio</option>
      </select> -->
      <label for="municipio">Municipio</label>
      <input type="text" class="form-control" id="municipio" name="municipio" value="<?= $municipio ?>">
    </div>

  </div>




  <div class="form-row">
    
    <div class="col-md-4 mb-1 md-form">
      <label for="email">Email</label>
      <input type="text" step="any" class="form-control" id="email" name="email" value="<?= $email ?>" required>
    </div>

    <div class="col-md-4 mb-1 md-form">
      <label for="telefono1">Teléfono</label>
      <input type="text" class="form-control" id="telefono1" name="telefono1" value="<?= $telefono1 ?>" required>
    </div>
  
    <div class="col-md-4 mb-1 md-form">
      <label for="telefono2">* Celular</label>
      <input type="text" class="form-control" id="telefono2" name="telefono2" value="<?= $telefono2 ?>" required>
    </div>

  </div>



  <div class="form-row">
    
    <div class="col-md-4 mb-1 md-form">
      <label for="giro">Giro</label>
      <input type="text" step="any" class="form-control" id="giro" name="giro" value="<?= $giro ?>" required>
    </div>

    <div class="col-md-4 mb-1 md-form">
      <label for="registro">No Registro</label>
      <input type="text" class="form-control" id="registro" name="registro" value="<?= $registro ?>" required>
    </div>
  
    <div class="col-md-4 mb-1 md-form">
      <label for="nit">NIT</label>
      <input type="text" class="form-control" id="nit" name="nit" value="<?= $nit ?>" required>
    </div>

  </div>



    <div class="form-row">
    
    <div class="col-md-12 mt-0 md-form">
      <textarea id="comentarios" name="comentarios" class="md-textarea form-control" rows="3"><?= $comentarios ?></textarea>
      <label for="comentarios">Comentarios</label>
    </div>

  </div>






  <div class="form-row mt-5">
    <div class="col-md-12 md-form text-center">
     <button class="btn btn-info" type="submit" id="btn-cliente"><i class="fas fa-save mr-1"></i> Guardar</button>

    </div>
  </div>

</form>

<!-- TERMINA FORMULARIO PRINCIPAL -->
<? } ?>
<!-- ./  content -->
      </div>
      <div class="modal-footer">

          <a href="?clientes" class="btn btn-primary btn-rounded">Regresar</a>
    
      </div>
    </div>
  </div>
</div>
<!-- ./  Modal -->