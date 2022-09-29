<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

include_once 'application/common/Alerts.php';
include_once 'system/producto/ProUpdate.php';
$producto = new ProUpdate(); 

include_once 'system/ventas/Productos.php';
$opciones = new Productos(); 
?>


<div align="center">
  <div class="col-md-6 z-depth-2 justify-content-center">
      <div class="md-form mt-0">
        <input class="form-control" type="text" placeholder="Buscar" aria-label="Search" id="producto-agregar-busqueda" name="producto-agregar-busqueda" autofocus>
      </div>
  </div>
  <div class="col-md-6 z-depth-2 justify-content-center" id="muestra-agregar-busqueda"></div>
</div>




<?php if($_REQUEST["key"] != NULL){ 
  
  if ($r = $db->select("*", "producto", "WHERE cod = '".$_REQUEST["key"]."' and td = ".$_SESSION["td"]."")) { 

$cod = $r["cod"];
$descripcion = $r["descripcion"];  
$caduca = $r["caduca"]; 
$dependiente = $r["dependiente"]; 
$compuesto = $r["compuesto"]; 
$servicio = $r["servicio"]; 
}  unset($r); 


if($dependiente == "on" or $compuesto == "on" or $servicio == "on"){
  Alerts::Mensajex("Este producto no tiene costo de compra","danger");
} else {


if($cod != NULL){

echo '<h2 class="h2-responsive">'.$descripcion .'</h2>';
  ?>

<div class="row">
    <div class="col-md-6 btn-outline-black z-depth-2" id="origencategoria">         
    <div id="msj"></div>


    </div>
    <div class="col-md-6 btn-outline-black z-depth-2" id="destinoproductoagrega">

  </div>
   
</div>  <!-- row -->

<? } else {
 echo "No se ha encontrado este producto";
}

} 

}
?>