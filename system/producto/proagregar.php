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


if($dependiente == "on"){
 Alerts::Mensajex("No se puede modificar cantidades del producto por que es un producto dependiente","info");
} elseif($compuesto == "on"){
 Alerts::Mensajex("No se puede modificar cantidades del producto por que es un producto compuesto","info");
} elseif($servicio == "on"){
 Alerts::Mensajex("No se puede modificar cantidades de registro por que es un servicio","info");
} else {


if($cod != NULL){

echo '<h2 class="h2-responsive">'.$descripcion .'</h2>';
  ?>

<div class="row">
    <div class="col-md-6 btn-outline-black z-depth-2" id="origencategoria">
            
<div id="msj"></div>

  <form id="form-productoagrega">
  
  <div class="form-row">
    <div class="col-md-4 mb-2 md-form">
      <label for="cod">* Codigo Producto</label>
      <input type="text" class="form-control" id="cod" name="cod" readonly value="<?php echo $cod; ?>">
    </div>

  <div class="col-md-8 mb-2 md-form">
      <label for="descripcion">* Descripci&oacuten</label>
      <input type="text" id="descripcion" name="descripcion" class="form-control" value="<?php echo $descripcion; ?>" readonly>
    </div>

  </div>



  <div class="form-row">
    
    <div class="col-md-6 mb-1 md-form">
      <label for="cantidad">* Precio de Costo</label>
      <input type="number" step="any" class="form-control" id="precio" name="precio" required>
    </div>

    <div class="col-md-6 mb-1 md-form">
      <label for="cantidad">* Cantidad</label>
      <input type="number" step="any" class="form-control" id="cantidad" name="cantidad" required>
    </div>

  </div>


  <div class="form-row">
<?php if($caduca == "on"){ ?>
    <div class="col-md-6 mb-1 md-form">
   <input placeholder="Fecha de Caducidad" type="text" id="caduca" name="caduca" class="form-control datepicker">
    </div>
<?php } ?>
  </div>
  

<?php 

$producto-> CompruebaCaracteristicas($cod);

$producto-> ListarUbicaciones();

 ?>

    <div class="col-md-12 mb-1 md-form">
      <div class="row">
        <div class="col-6">
          <select class="mdb-select md-form colorful-select dropdown-dark" id="proveedor" name="proveedor">
        <?php echo Helpers::SelectData("* Proveedor", "proveedores", "hash", "nombre"); ?>
      </select>
        </div>

        <div class="col-6 mt-3">
          <input type="text" class="form-control" id="documento" name="documento" placeholder="Documento">
        </div>

      </div>       
    </div>

    <div class="col-md-12 mb-1 md-form">
      <div class="row">

        <div class="col-6 mt-3">
          <input type="number" step="any" class="form-control" id="precio_venta" name="precio_venta" placeholder="Precio Venta">
        </div>

      </div>       
    </div>


  <div class="form-row">
    
    <div class="col-md-12 mb-1 md-form">
      <textarea id="comentarios" name="comentarios" class="md-textarea form-control" rows="3"></textarea>
      <label for="comentarios">Comentarios..</label>
    </div>

  </div>




  <div class="form-row">
    <div class="col-md-12 my-6 md-form text-center">
     <button class="btn btn-info my-4" type="submit" id="btn-productoagrega"><i class="fa fa-save mr-1"></i> Guardar</button>

    </div>
  </div>

</form>

<!-- TERMINA FORMULARIO PRINCIPAL -->

    </div>
    
    <div class="col-md-6 btn-outline-black z-depth-2" id="destinoproductoagrega">
          <?php $producto->VerAgrega($cod); ?>
    </div>
   
</div>  <!-- row -->

<? } else {
 echo "No se ha encontrado este producto";
}

} 

}
?>