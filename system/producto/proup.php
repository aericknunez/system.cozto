<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<div align="center">
  <div class="col-md-6 z-depth-2 justify-content-center">
      <div class="md-form mt-0">
        <input class="form-control" type="text" placeholder="Buscar" aria-label="Search" id="producto-busqueda" name="producto-busqueda" autofocus>
      </div>
  </div>
  <div class="col-md-6 z-depth-2 justify-content-center" id="muestra-busqueda"></div>
</div>



<div id="contenido">
<?php 
$_SESSION["producto_mod"] = $_REQUEST["key"];

if($_REQUEST["key"] != NULL){ 
  if ($r = $db->select("*", "producto", "WHERE cod = '".$_REQUEST["key"]."' and td = ".$_SESSION["td"]."")) { 

$cod = $r["cod"];
$descripcion = $r["descripcion"];  
$cantidad = $r["cantidad"];
$existencia_minima = $r["existencia_minima"]; 
$gravado = $r["gravado"];
$receta = $r["receta"];
$servicio = $r["servicio"]; 
$compuesto = $r["compuesto"];
$caduca = $r["caduca"]; 
$dependiente = $r["dependiente"];
$informacion = $r["informacion"]; 
$proveedor = $r["proveedor"]; 
$categoria = $r["categoria"];
$medida = $r["medida"]; 
$promocion = $r["promocion"]; 
$verecommerce = $r["verecommerce"]; 
$ilimitado = $r["ilimitado"]; 
  }  unset($r); 


$xmedida = Helpers::GetData("taller_medida", "medida", "producto", $cod);

if($cod != NULL){

  ?>
  <div id="msj"></div>

  <form id="form-proup">
  
  <div class="form-row">
    <div class="col-md-4 mb-2 md-form">
      <label for="cod">* Codigo Producto</label>
      <input type="text" class="form-control" id="cod" name="cod" readonly value="<?php echo $cod; ?>">
    </div>

  <div class="col-md-8 mb-2 md-form">
      <label for="descripcion">* Descripci&oacuten</label>
      <input type="text" class="form-control" id="descripcion" name="descripcion" required value="<?php echo $descripcion; ?>">
    </div>

  </div>


  <div class="form-row">


    <div class="col-md-4 mb-1 md-form">
      <div class="row">
        <div class="col-10">
      <select class="browser-default custom-select" id="proveedor" name="proveedor">
        <?php 
        echo Helpers::SelectData("Proveedor", "proveedores", "hash", "nombre", $proveedor); 
        ?>
      </select>
        </div>
        <div class="col-2">
          <i class="fas fa-plus-circle fa-2x green-text"></i>
        </div>
      </div>
    </div>


    <div class="col-md-4 mb-1 md-form">
      <div class="row">
        <div class="col-10">
        <select class="browser-default custom-select" id="categoria" name="categoria">     
        <?php 
       echo Helpers::SelectDataMultiple("* Categorias", 
        "producto_categoria", "hash", "categoria", 
        "categoria",
        "producto_categoria_sub", "hash", "subcategoria", 
        $categoria); 
        ?>
      </select>
        </div>
        <div class="col-2">
          <i class="fas fa-plus-circle fa-2x green-text"></i>
        </div>
      </div>
    </div>

    <div class="col-md-4 mb-1 md-form">
      <div class="row">
        <div class="col-10">
      <select class="browser-default custom-select" id="medida" name="medida">
      <?php 
        echo Helpers::SelectData("* Unidad de Medida", "producto_unidades", "hash", "nombre", $medida); 
        ?>         
      </select>
        </div>
        <div class="col-2">
          <i class="fas fa-plus-circle fa-2x green-text"></i>
        </div>
      </div>
    </div>


  </div>

  <div class="form-row">
    <div class="col-md-4 mb-1 md-form">
      
<?php if($_SESSION["tipo_cuenta"] == 5 or $_SESSION["tipo_cuenta"] == 1){
 echo '<label for="cantidad"><a id="modificarcantidad" op="569" key="'.$cod.'">* Cantidad</a></label>';
} else {
 echo '<label for="cantidad">* Cantidad</label>';
} ?>

      <input type="number" step="any" class="form-control" id="cantidad" name="cantidad" readonly value="<?php echo $cantidad; ?>">
    </div>

    <div class="col-md-4 mb-1 md-form">
      <label for="existencia_minima">* Existencia Minima</label>
      <input type="number" class="form-control" id="existencia_minima" name="existencia_minima" required value="<?php echo $existencia_minima; ?>">
    </div>
  


    <?php if($_SESSION["root_taller"] == "on"){ // si esta activada la opcion en root ?>
    <div class="col-6 col-md-2 mb-1 md-form">
      <label for="xmedida">Medida</label>
      <input type="text" class="form-control" id="xmedida" name="xmedida" required value="<?php echo $xmedida; ?>">
    </div>
<?php } ?>

<?php if($_SESSION["config_descuento"] == "on"){ // si esta activada la opcion en las configuraciones ?>
    <div class="col-6 col-md-2 mb-1 md-form">
      <label for="descuento">Descuento %</label>
      <input type="number" step="any" class="form-control" id="descuento" name="descuento">
    </div>
<?php } ?>


  <div class="col-6 col-md-2 mb-1 md-form">
        <div class="switch">
            <label>
            * Gravado
              <input type="checkbox" id="gravado" <?php if($gravado == "on") echo "checked"; ?> name="gravado">
              <span class="lever"></span>
            </label>
          </div>
    </div>
<?php if($_SESSION["root_receta"] == "on"){ // si esta activada la opcion en root ?>
  <div class="col-6 col-md-2 mb-1 md-form">
        <div class="switch">
            <label>
            * Receta
              <input type="checkbox" id="receta" <?php if($receta == "on") echo "checked"; ?> name="receta">
              <span class="lever"></span>
            </label>
          </div>
    </div>
<?php } ?>
  </div>

  <div class="form-row mt-4">
    
    <div class="col-md-12 mb-1 md-form">
      <textarea id="informacion" name="informacion" class="md-textarea form-control" rows="3"><?php echo $informacion; ?></textarea>
      <label for="informacion">Informaci&oacuten adicional</label>
    </div>

  </div>





  <?php 
if($_SESSION["root_taller"] == "on"){
 ?>
<div class="row mt-5"> 
  <div class="col-6">
    <div class="h2-responsive">Años del producto <a id="AddOpcionesTaller" op="627"><i class="fas fa-plus-circle green-text"></i></a></div>
    <div id="aniosAgregados"></div>
  </div>

  <div class="col-6">
    <div class="h2-responsive">Marcas Aceptadas <a id="AddOpcionesTaller" op="622"><i class="fas fa-plus-circle green-text"></i></a></div>
    <div id="modelosAgregados"></div>
  </div>

</div>
<?php } ?>


  <div class="form-row">
  
  <div class="col-6 col-md-3 mb-1 md-form">
        <div class="switch">
            <label>
             Servicio ||  Off
              <input type="checkbox" id="servicio" <?php if($servicio == "on") echo "checked"; ?> name="servicio">
              <span class="lever"></span> On 
            </label>
          </div>
    </div>

  <div class="col-6 col-md-3 mb-1 md-form">
        <div class="switch">
            <label>
             Compuesto ||  Off
              <input type="checkbox" id="compuesto" <?php if($compuesto == "on") echo "checked"; ?> name="compuesto">
              <span class="lever"></span> On 
            </label>
          </div>
    </div>

   <div class="col-6 col-md-3 mb-1 md-form">
        <div class="switch">
            <label>
             Caduca ||  Off
              <input type="checkbox" id="caduca" <?php if($caduca == "on") echo "checked"; ?> name="caduca">
              <span class="lever"></span> On 
            </label>
          </div>
    </div>

    <div class="col-6 col-md-3 mb-1 md-form">
        <div class="switch">
            <label>
             Dependiente ||  Off
              <input type="checkbox" id="dependiente" <?php if($dependiente == "on") echo "checked"; ?> name="dependiente">
              <span class="lever"></span> On 
            </label>
          </div>
    </div>

  </div>






<!-- solo si tiene activo la opcion de ecommerce se mostrara esta parte -->
<?php 

if($_SESSION['root_ecommerce'] == "on"){
?>
  <div class="form-row mt-5">
  
  <div class="col-4 col-md-4 mb-1 md-form">
        <div class="switch">
            <label>
             Ver en Ecommerce ||  Off
              <input type="checkbox" id="verecommerce" <?php if($verecommerce == "on") echo "checked"; ?> name="verecommerce">
              <span class="lever"></span> On 
            </label>
          </div>
    </div>

  <div class="col-4 col-md-4 mb-1 md-form">
        <div class="switch">
            <label>
             Mostrar Promoción ||  Off
              <input type="checkbox" id="promocion" <?php if($promocion == "on") echo "checked"; ?> name="promocion">
              <span class="lever"></span> On 
            </label>
          </div>
    </div>


  <div class="col-4 col-md-4 mb-1 md-form">
        <div class="switch">
            <label>
             Mostrar Ilimitado ||  Off
              <input type="checkbox" id="ilimitado" <?php if($ilimitado == "on") echo "checked"; ?> name="ilimitado">
              <span class="lever"></span> On 
            </label>
          </div>
    </div>


  </div>

<?php }

 ?>






  <div class="form-row  mt-4">
    <div class="col-md-12 my-6 md-form text-center">
     <button class="btn btn-info my-4" type="submit" id="btn-proup"><i class="fa fa-save mr-1"></i> Guardar y continuar</button>

    </div>
  </div>

</form>

<!-- TERMINA FORMULARIO PRINCIPAL -->
<? } else {
 echo "No se ha encontrado este producto";
}

} 
?>
</div> <!-- TERMINA CONTENIDO -->



<?php 
if($_SESSION["root_taller"] == "on"){
 ?>
<!-- para agregar los detalles de autoparts -->
<!-- modal para ver el credito -->
<div class="modal" id="AddTaller" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="false">
  <div class="modal-dialog modal-lg z-depth-5" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
         AGREGAR DETALLES</h5>
      </div>
      <div class="modal-body">
<!-- ./  content -->

<div id="vistataller"></div>
<div id="vistataller_detalles"></div>
<!-- ./  content -->
      </div>
      <div class="modal-footer">

        <a id="cerrarModal" class="btn btn-danger btn-rounded">Cerrar</a>
 
   
      </div>
    </div>
  </div>
</div>
<!-- ./  Modal -->
<?php 
}
 ?>





















<!-- Ver producto -->
<div class="modal" id="ModalCantidad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  data-backdrop="false">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
         DETALLES PRODUCTO</h5>
      </div>
      <div class="modal-body">
<!-- ./  content -->

<div id="cantproducto"></div>


  <form id="form-ajustari">
  
  <div class="form-row justify-content-center">
    
    <div class="col-md-12 mb-1 md-form">
      <input type="hidden"  id="codx" name="codx" value="">
      <small >* Nueva cantidad</small>
      <input type="number" step="any" class="form-control" id="cantidadx" name="cantidadx" required>
    </div>

  </div>


  <div class="form-row">
    <div class="col-md-12 my-6 md-form text-center">
     <button class="btn btn-info my-4" type="submit" id="btn-ajustari"><i class="fa fa-save mr-1"></i> Ingresar</button>

    </div>
  </div>

</form>
<!-- ./  content -->
      </div>
      <div class="modal-footer">
<a id="cerrarmodal" class="btn btn-primary btn-rounded" data-dismiss="modal">Regresar</a>

      </div>
    </div>
  </div>
</div>
<!-- ./  Modal -->
