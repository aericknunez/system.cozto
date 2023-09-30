<?php
    include_once 'application/common/Alerts.php'; 
 ?>
 <div class="modal" id="<? echo $_GET["modal"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
          DATOS DEL CREDITO FISCAL</h5>
      </div>
      <div class="modal-body">
<!-- ./  content -->
<?php if($_REQUEST["key"] != NULL){ 
  $key = $_REQUEST["key"];
  if ($r = $db->select("*", "facturar_documento", "WHERE documento = '$key' and td = ".$_SESSION["td"]."")) { 
   
$documento = $r["documento"]; 
$cliente = $r["cliente"];
$giro = $r["giro"];
$registro = $r["registro"];
$direccion = $r["direccion"]; 
$departamento = $r["departamento"]; 
$tipoContribuyente = $r["tipo_contribuyente"];
$hash = $r["hash"];
if($tipoContribuyente == 1){
    $checked  = "checked";
} else {
    $checked = "";
}
  }}  unset($r); ?>

<h3>EDITAR</h3>

<form class="text-center border border-light p-3" id="form-documento" name="form-documento"> 
<input type="text" id="cliente" name="cliente" autocomplete="off" class="form-control mb-3" placeholder="Cliente" value="<?php echo $cliente ;?>">  
<input type="text" id="documento" name="documento" autocomplete="off" class="form-control mb-3" placeholder="<?php echo $_SESSION['config_nombre_documento']; ?>" value="<?php echo $documento ;?>">

<input type="text" id="giro" name="giro" autocomplete="off" class="form-control mb-3" placeholder="Giro" value="<?php echo $giro ;?>"> 
<input type="text" id="registro" name="registro" autocomplete="off" class="form-control mb-3" placeholder="Registro" value="<?php echo $registro ;?>"> 

<input type="text" id="direccion" name="direccion" autocomplete="off" class="form-control mb-3" placeholder="Direccion" value="<?php echo $direccion ;?>"> 
<input type="text" id="departamento" name="departamento" autocomplete="off" class="form-control mb-3" placeholder="Departamento" value="<?php echo $departamento ;?>"> 
  <input class="form-check-input" type="checkbox" value="1" name="tipo_contribuyente" id="tipo_contribuyente"  <?php echo $checked ;?>>
  <label class="form-check-label" for="tipo_contribuyente">
    Gran Contribuyente
  </label>
<input type="hidden" name="hash" id="hash" value="<?php echo $hash ;?>">


<button class="btn btn-info btn-block my-4" type="submit" id="btn-documento" name="btn-documento"><i class="fa fa-save mr-1"></i> Guardar</button>

</form>
<div id="ver" class="my-4 text-center">
</div>


      </div>
      <div class="modal-footer">
       <a href="?mod_nit" class="btn btn-primary btn-rounded">Regresar</a>
    
      </div>
    </div>
  </div>
</div>
<!-- ./  Modal -->